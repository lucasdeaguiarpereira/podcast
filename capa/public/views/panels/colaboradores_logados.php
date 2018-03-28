<?php require '../../../init.php'; ?>
<?php require DIRETORIO_MODULES . 'panels/modulo_colaboradores_logados.php'; ?>

<?php

  # recuperando id do chat do usuário logado no chat
  $id = $_SESSION['usuario']['id'];

  # verificando o nível de permissão do usuário logado no portal avanção
  $nivel = $_SESSION['usuario']['nivel'];

  $dados = '';

  # chamando funçao que recupera os dados para o painel de colaboradores logados
  $paineis = retornaDadosParaPainelDeColaboradoresLogados();

  # chamando função que retorna os colaboradores integrantes do time do capitão que está logado no portal avanção
  $dados = retornaIdDosColaboradoresDoTime($id, $nivel, $dados);

  # verificando se o usuário que está logado no portal avanção pode alterar o status de algum colaborador
  if ($dados['exibir_opcoes']) {

    # repassando colaboradores que podem ter seu status alterado para o array com os colaboradores do suporte
    for ($i = 0; $i < count($dados['id']); $i++) {

      for ($j = 0; $j < count($paineis['suporte']); $j++) {
  
        if ($paineis['suporte'][$j]['id'] == $dados['id'][$i]) {
                    
          $paineis['suporte'][$j]['exibir'] = true;
  
        }
  
      }
  
    }

  }

?>

<?php if (verificaUsuarioLogado('colaboradores_logados.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Painel Colaboradores Logados</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/panels/tabela_logados.css">  
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Painel Colaboradores Logados</h2>
            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <h3 class="text-center">Interno</h3>

            <br>

            <table class="table" id="tabela-suporte"><!-- painel do suporte -->
              <thead>
                <tr>  
                  <th class="text-center">Id</th>              
                  <th class="text-center">Colaborador</th>
                  <th class="text-center">Em Atendimento</th>
                  <th class="text-center">Em Espera</th>
                  <th class="text-center">Em Espera Acima 10 Min</th>
                  <th class="text-center">Logado</th>
                  <th class="text-center">Status</th>

                <?php if ($dados['exibir_opcoes']) : ?>
                  <th class="text-center">Opções</th>
                <?php endif; ?>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($paineis['suporte'] as $suporte) : ?>
                <tr>                  
                  <td class="text-center"><?php echo $suporte['id']; ?></td>
                  <td class="text-center"><?php echo $suporte['nome'] . ' ' . $suporte['sobrenome']; ?></td>
                  <td class="text-center"><?php echo $suporte['atendimento']; ?></td>
                  <td class="text-center"><?php echo $suporte['espera']; ?></td>
                  <td class="text-center"><?php echo $suporte['espera_acima_10_min']; ?></td>
                  <td class="text-center"><?php echo $suporte['logado']; ?></td>
                  <td class="text-center"><?php echo $suporte['status']; ?></td>

                <?php if ($dados['exibir_opcoes']) : ?>

                  <?php if ($suporte['exibir']) : ?>

                    <?php if ($suporte['status'] == 'Offline') : ?>
                    <td class="opcao text-center" width="10%">                  
                      <a class="btn btn-xs btn-success" href="<?php echo BASE_URL; ?>app/requests/get/recebe_status.php?id=<?php echo $suporte['id']; ?>&status=0">
                        <i class="fa fa-eye" aria-hidden="true"></i> Ativar
                      </a>                    
                    </td> 
                    <?php elseif ($suporte['status'] == 'Online') : ?>
                    <td class="opcao text-center" width="10%">                  
                      <a class="btn btn-xs btn-danger" href="<?php echo BASE_URL; ?>app/requests/get/recebe_status.php?id=<?php echo $suporte['id']; ?>&status=1">
                        <i class="fa fa-eye-slash" aria-hidden="true"></i> Inativar
                      </a>                    
                    </td>                                  
                    <?php endif; ?><!-- status --> 

                  <?php elseif ($suporte['exibir'] == false) : ?>
                    <td class="opcao text-center" width="10%"></td>                       
                  <?php endif; ?><!-- exibir -->

                <?php endif; ?><!-- dados -->
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->                        
          </div>
        </div>

        <br> 

        <div class="row">
          <div class="col-sm-12">          
            <h3 class="text-center">Externo</h3>

            <br>

            <table class="table" id="tabela-externo"><!-- painel do externo -->
              <thead>
                <tr> 
                  <th class="text-center">Id</th>                 
                  <th class="text-center">Colaborador</th>
                  <th class="text-center">Em Atendimento</th>
                  <th class="text-center">Em Espera</th>
                  <th class="text-center">Em Espera Acima 10 Min</th>
                  <th class="text-center">Logado</th>
                  <th class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($paineis['externo'] as $externo) : ?>
                <tr>                  
                  <td class="text-center"><?php echo $externo['id']; ?></td>
                  <td class="text-center"><?php echo $externo['nome'] . ' ' . $externo['sobrenome']; ?></td>
                  <td class="text-center"><?php echo $externo['atendimento']; ?></td>
                  <td class="text-center"><?php echo $externo['espera']; ?></td>
                  <td class="text-center"><?php echo $externo['espera_acima_10_min']; ?></td>
                  <td class="text-center"><?php echo $externo['logado']; ?></td>
                  <td class="text-center"><?php echo $externo['status']; ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do externo -->
          </div>
        </div>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/paginacao_tabela.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/destaca_tabela_colaboradores_logados.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/panels/atualizacao_automatica.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
