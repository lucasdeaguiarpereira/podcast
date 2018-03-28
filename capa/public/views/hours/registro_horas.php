<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('registro_horas.php')) : ?>

<?php

  $id = '';

  # recuperando id do chat do supervisor que está logado
  $id = $_SESSION['usuario']['id'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <title>Portal Avanção - Registro Horas</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/hours/validacao.css">
  
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php'; ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php'; ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Registro Horas</h2>

            <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_horas.php" method="post" accept-charset="utf-8">

              <hr>

              <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <div class="input-group h2">
                    <input class="form-control" id="pesquisa" type="text" placeholder="Pesquise por CNPJ ou Razão Social">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                      </button>
                    </span>
                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-sm-12">
                  <div id="bloco">
                    
                  </div>
                  
                  <div class="hidden text-center" id="loader">
                    <img src="<?php echo BASE_URL; ?>../tickets/public/img/others/loader.gif" alt="loader" width="10%" height="10%">
                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="razao-social">Razão Social</label>
                    <input class="form-control required" id="razao-social" type="text" name="issues[razao-social]" value="" placeholder="Razão Social" readonly="true">
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input class="form-control required" id="cnpj" type="text" name="issues[cnpj]" value="" placeholder="CNPJ" readonly="true">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="conta-contrato">Conta Contrato</label>
                    <input class="form-control required" id="conta-contrato" type="text" name="issues[conta-contrato]" value="" placeholder="Conta Contrato" readonly="true">
                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-sm-6">
                
                  <div class="row">
                    <div class="col-sm-12">                      
                      <label class="radio-inline">
                        <input type="radio" name="issues[tipo]" id="remoto" value="remoto" checked> Atendimento Remoto
                      </label>                                    
                      <label class="radio-inline">
                        <input type="radio" name="issues[tipo]" id="in-loco" value="in-loco"> Atendimento In-Loco
                      </label>                      
                    </div>
                  </div>

                  <br> 

                  <div class="row"> 
                    <div class="col-sm-3">
                      <label for="issue">Issue</label>
                        <input class="form-control required" type="text" name="issues[issue]" placeholder="Número da Issue">
                    </div>
                  </div>

                  <br> 

                  <div class="row">          
                    <div class="col-sm-4">
                      <label for="colaborador">Colaborador</label>
                      <select class="form-control required" id="colaborador" name="issues[colaborador]">
                        <option value="0">Selecione um Colaborador</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">          
                    <div class="col-sm-4">                      
                      <input id="supervisor" type="hidden" name="issues[supervisor]" value="<?php echo $id; ?>">
                    </div>
                  </div>

                </div><!-- coluna 1 -->

                <div class="col-sm-6">

                  <div class="hidden" id="bloco-despesas">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="total-despesas">Total Despesas</label>
                          <input class="form-control" id="total-despesas" type="text" name="despesas[total-despesas]" value="0" readonly="true">
                        </div>
                      </div> 
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="deslocamento">Deslocamento</label>
                          <input class="form-control" id="deslocamento" type="text" name="despesas[deslocamento]" value="0">
                        </div>
                      </div> 
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="alimentacao">Alimentação</label>
                          <input class="form-control" id="alimentacao" type="text" name="despesas[alimentacao]" value="0">
                        </div>
                      </div> 
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="hospedagem">Hospedagem</label>
                          <input class="form-control" id="hospedagem" type="text" name="despesas[hospedagem]" value="0">
                        </div>
                      </div> 
                    </div>
                  </div>

                </div><!-- coluna 2 -->                
              </div><!-- linha -->

              <br> 

              <div class="row">
                <div class="col-sm-1 col-sm-offset-11">
                  <button class="btn btn-primary btn-block" id="botao" type="button">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </button>                  
                </div>
              </div>
              
              <hr> 
              
              <div id="lancamentos">
                <div class="row">                
                  <div class="col-sm-12"> 
                                
                    <div class="row"> 
                      <div class="col-sm-2">
                        <label for="data">Data</label>
                        <input class="form-control required" id="data" type="date" name="lancamentos[0][data]" numero="0">
                      </div>
                    </div>

                    <br> 

                    <div class="row">
                      <div class="col-sm-2">
                        <label for="produto">Produto</label>
                        <select class="form-control required" id="produto" name="lancamentos[0][produto]" numero="0">
                          <option value="0">Selecione um Produto</option>
                          <option value="1">Integral</option>
                          <option value="2">Frente de Loja</option>
                          <option value="3">Gestor</option>
                          <option value="4">Novo ERP</option>
                        </select>
                      </div>
                    </div>

                    <br> 

                    <div class="row"> 
                      <div class="col-sm-2">
                        <label for="horas-trabalhadas">Horas Trabalhadas</label>
                        <input class="form-control required" id="horas-trabalhadas" type="time" name="lancamentos[0][horas-trabalhadas]" numero="0">
                      </div>

                      <div class="col-sm-2">
                        <label for="horas-faturadas">Horas Faturadas</label>
                        <input class="form-control required" id="horas-faturadas" type="time" name="lancamentos[0][horas-faturadas]" numero="0">
                      </div>                    
                    </div>

                    <br> 

                    <div class="row"> 
                      <div class="col-sm-2">
                        <label for="valor-horas">Valor Horas</label>
                        <input class="form-control required" id="valor-horas" type="text" name="lancamentos[0][valor-horas]" value="0" numero="0">
                      </div>

                      <div class="col-sm-2">
                        <label for="valor-toral">Valor Total</label>
                        <input class="form-control required" id="valor-total" type="text" name="lancamentos[0][valor-total]" value="0" numero="0">
                      </div>
                    </div>

                  </div><!-- coluna dos dados do lançamento -->                
                </div><!-- linha de lançamento -->

                <hr>
              </div> 

              <div class="row">
                <div class="col-sm-12 text-right">
                  <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/hours/registro_horas.php">
                    Limpar Registro
                  </a>
                  <button class="btn btn-primary" type="submit">
                    Gravar Registro
                  </button>
                </div>
              </div>
            </form>

            <br> 

            <div class="row">
              <div class="col-sm-12">
              <?php if (! empty($_SESSION['mensagens']['mensagem']) AND $_SESSION['mensagens']['exibe'] == true) : ?>

                <div class="alert alert-<?php echo $_SESSION['mensagens']['tipo']; ?>" role="alert">
                  <?php echo $_SESSION['mensagens']['mensagem']; ?>
                  <?php unset($_SESSION['mensagens']['mensagem'], $_SESSION['mensagens']['tipo']); ?>
                </div>

              <?php endif; ?>
              </div>
            </div>
          </div><!-- coluna -->
        </div><!-- linha -->
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/seleciona.js"></script>
  <script src="<?php echo BASE_URL; ?>/public/js/hours/validacao.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/lancamentos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/hours/despesas.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/tipo_atendimento.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/duplicar.js"></script>  
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
