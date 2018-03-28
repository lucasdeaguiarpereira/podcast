<?php require '../../../../init.php'; ?>

<?php if (verificaUsuarioLogado('consulta_atendimentos.php')) : ?>

<?php 

  # array com o perído atual
  $periodo = array(
    'data1' => date('Y-m-d'), 
    'data2' => date('Y-m-d')
  );


  # verificando se existe uma sessão com o relatório
  if (isset($_SESSION['relatorios']['consulta_atendimentos'])) {

    $atendimentos = array();
    
    # recuperando dados da sessão
    $mensagem     = $_SESSION['relatorios']['mensagem'];
    $atendimentos = $_SESSION['relatorios']['consulta_atendimentos'];

    unset($_SESSION['relatorios']);
    
  }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta de Atendimentos</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">  
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/reports/tabela_atendimentos.css">  
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Consulta de Atendimentos</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="<?php echo BASE_URL; ?>app/requests/post/processa_consulta_atendimentos.php" method="post">
          
          <!-- teste -->
          <div class="jumbotron">            
            <h3>Filtros</h3><hr>            

            <div class="row">
              <div class="form-inline">
                <div class="col-sm-3">
                  <div class="form-group">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <input class="form-control" type="date" name="form[data-1]" value="<?php echo $periodo['data1']; ?>">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <i class="fa fa-calendar" aria-hidden="true"></i> 
                    <input class="form-control" type="date" name="form[data-2]" value="<?php echo $periodo['data2']; ?>">
                  </div>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="form-inline">
                <div class="col-sm-3">
                  <div class="form-group">
                    <i class="fa fa-filter" aria-hidden="true"></i>                
                    <select class="form-control" name="form[tipo]" id="tipo">
                      <option value="1">Empresa</option>
                      <option value="2">Colaborador</option>
                      <option value="3">Ambos</option>
                    </select>
                  </div>
                </div>
              </div>              
            </div>

            <br>
            
            <div class="row">
              <div class="col-sm-3 col-sm-offset-1">
                <div class="form-group" id="bloco-filtro">                  
                  <label class="radio-inline">
                    <input type="radio" name="form[filtro]" value="cnpj"checked> CNPJ
                  </label>                                     
                  <label class="radio-inline">
                    <input type="radio" name="form[filtro]" value="contrato"> Contrato
                  </label>
                </div>
              </div>
            </div>            
            
            <div class="row">
              <div class="form-inline">
                <div class="col-sm-12">
                  <div class="form-group" id="bloco-pesquisa">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input class="form-control" type="text" id="pesquisa" placeholder="Pesquise por CNPJ ou Razão Social">
                  </div>

                  <div class="form-group hidden espaco" id="bloco-colaborador">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <select class="form-control" id="colaborador" name="form[colaborador]">
                      <option value="0" selected>Selecione um Colaborador</option>
                    </select>
                  </div>                  
                </div>                
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-inline">
                  <div class="form-group">
                    <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/reports/calls/consulta_atendimentos.php">Limpar</a>                
                    <button class="btn btn-primary" type="submit">Buscar</button>
                  </div>
                </div>
              </div>              
            </div>
          </div>
          <!-- teste -->

          <div class="row hidden"><!-- campos do cliente -->
            <div class="col-sm-5">
              <div class="form-group">
                <label for="razao-social">Razão Social</label>
                <input class="form-control required" id="razao-social" type="text" name="form[razao-social]" value="" placeholder="Razão Social" readonly="true">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input class="form-control required" id="cnpj" type="text" name="form[cnpj]" value="" placeholder="CNPJ" readonly="true">
              </div>
            </div>
          
            <div class="col-sm-3">
              <div class="form-group">
                <label for="conta-contrato">Conta Contrato</label>
                <input class="form-control required" id="conta-contrato" type="text" name="form[conta-contrato]" value="" placeholder="Conta Contrato" readonly="true">
              </div>
            </div>
          </div><!-- campos do cliente -->

        </form>

        <br>

        <div class="row">
          <div class="col-sm-12">
            <div id="bloco">
            </div><!-- bloco da tabela de clientes -->

            <div class="hidden text-center" id="loader">
              <img src="<?php echo BASE_URL; ?>public/img/others/loader.gif" alt="loader" width="10%" height="10%">
            </div>
          </div><!-- coluna -->
        </div><!-- linha -->

        <br>

        <?php if (isset($atendimentos) AND ! $mensagem) : ?><!-- exibindo tabela de atendimentos -->
        <div class="row">
          <div class="col-sm-12">
            <h3 class="text-center">Atendimentos</h3>
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">Data</th>
                  <th class="text-center">Chat Id</th>
                  <th class="text-center">Colaborador</th>
                  <th class="text-center">Razão Social</th>
                  <th class="text-center">CNPJ</th>
                  <th class="text-center">Contrato</th>
                  <th class="text-center">Produto</th>
                  <th class="text-center">Demanda</th>
                  <th class="text-center">Cliente</th>
                  <th class="text-center">Contato</th>
                  <th class="text-center">Opções</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($atendimentos as $atendimento) :  ?>
                <tr>
                  <td class="text-center"><?php echo $atendimento['data']; ?></td>
                  <td class="text-center"><?php echo $atendimento['chat_id']; ?></td>
                  <td class="text-left"><?php echo $atendimento['colaborador']; ?></td>
                  <td class="text-left"><?php echo $atendimento['razao_social']; ?></td>
                  <td class="text-center"><?php echo $atendimento['cnpj']; ?></td>
                  <td class="text-center"><?php echo $atendimento['conta_contrato']; ?></td>
                  <td class="text-left"><?php echo $atendimento['produto']; ?></td>
                  <td class="text-left"><?php echo $atendimento['demanda']; ?></td>
                  <td class="text-center"><?php echo $atendimento['cliente']; ?></td>
                  <td class="text-center"><?php echo $atendimento['contato']; ?></td>
                  <td class="text-center">
                    <a class="btn btn-success btn-sm" href="<?php echo BASE_URL; ?>app/requests/get/recebe_chat_id.php?chat=<?php echo $atendimento['chat_id']; ?>" target="_blank">Conversa</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div><!-- coluna -->
        </div><!-- linha -->
        <?php elseif (isset($mensagem) AND $mensagem) : ?><!-- exibindo mensagem de registro não encontrado -->

          <p class="text-center alert alert-warning" role="alert"><strong>Ops!</strong> Nenhum registro encontrado!</p>

        <?php endif; ?><!-- exibindo tabela de atendimentos -->

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>    
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/pt-br.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
  
  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script> 
  <script src="<?php echo BASE_URL; ?>public/js/reports/paginacao.js"></script> 
  <script src="<?php echo BASE_URL; ?>public/js/reports/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/reports/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/reports/seleciona.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/reports/filtros.js"></script>  
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
