<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('metas_capitaes_selecao.php', $_SESSION['usuario']['id'])) : ?>

<?php 

  require DIRETORIO_FUNCTIONS . 'panels/consulta_time.php';

  # recuperando id do chat do usuário logado
  $id = $_SESSION['usuario']['id'];
  
  $periodo = array('data_1' => '', 'data_2' => '');

  $db = abre_conexao();

  # verificando se o usuário logado é um capitão
  if ($id == 14 OR $id == 17 OR $id == 20 OR $id == 25)
    
    # chamando função que retorna o id do time atual do capitão
    $time = consultaTimeDoCapitaoLogado($db, $id);

  # recuperando a data do dia
  $periodo['data_1'] = $periodo['data_2'] = date('d/m/Y');

  fecha_conexao($db);
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Portal Avanção - Seleção Times</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <style>

    form {
      margin: 10% 0 0 0;
    }    

    .col-sm-1 {
      margin-right: 1%;
    }
  </style>
</head>

<body>
  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Período dos Resultados</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

      <?php if ($_SESSION['usuario']['nivel'] == 1) : ?>
        <form class="form-horizontal" action="<?php echo BASE_URL; ?>app/requests/post/recebe_time.php" method="post">

          <div class="row">          
            <div class="col-sm-2 col-sm-offset-4">
              <div class="form-inline input-daterange">
                <div class="form-group">
                  <i class="fa fa-calendar" aria-hidden="true">
                    <span class="calendario">De: </span>
                  </i>

                  <input type="text" class="form-control" id="data1" name="data-1" value="<?php echo $periodo['data_1']; ?>">
                </div>
              </div>
            </div><!-- coluna 1 -->

            <div class="col-sm-2">
              <div class="form-inline input-daterange">
                <div class="form-group">
                  <i class="fa fa-calendar" id="icone-2" aria-hidden="true">
                    <span class="calendario">Até: </span>
                  </i>

                  <input type="text" class="form-control" id="data2" name="data-2" value="<?php echo $periodo['data_2']; ?>">
                </div>
              </div>
            </div><!-- coluna 2 -->
          </div><!-- linha -->
          
          <br>

          <div class="row"> 
            <div class="col-sm-2 col-sm-offset-5">
              <div class="form-group">
                <div class="text-center">
                  <input type="hidden" name="time" value="<?php echo $time; ?>">

                  <button class="btn btn-primary btn-block" type="submit">Gerar Relatório</button>
                </div>              
              </div>
            </div><!-- coluna -->
          </div><!-- linha -->
      <?php elseif ($_SESSION['usuario']['nivel'] == 2) : ?>
        <form class="form-horizontal" action="<?php echo BASE_URL; ?>app/requests/post/recebe_time.php" method="post">

          <div class="row">          
            <div class="col-sm-2 col-sm-offset-4">   
              <div class="form-inline input-daterange">
                <div class="form-group">
                  <i class="fa fa-calendar" aria-hidden="true">
                    <span class="calendario">De: </span>
                  </i>

                  <input type="text" class="form-control" id="data1" name="data-1" value="<?php echo $periodo['data_1']; ?>">
                </div>
              </div>            
            </div><!-- coluna 1 -->

            <div class="col-sm-2">
              <div class="form-inline input-daterange">
                <div class="form-group">
                  <i class="fa fa-calendar" id="icone-2" aria-hidden="true">
                    <span class="calendario">Até: </span>
                  </i>

                  <input type="text" class="form-control" id="data2" name="data-2" value="<?php echo $periodo['data_2']; ?>">
                </div>
              </div>
            </div><!-- coluna 2 -->
          </div><!-- linha -->

          <br>

          <div class="row">
            <div class="col-sm-2 col-sm-offset-5">
              <div class="form-group">
                <h3 class="text-center">Time</h3>              
              </div>            
            </div><!-- coluna 1 -->                
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-1 col-sm-offset-5">            
              <div class="form-group">
                <select class="form-control" name="time">
                  <option value="1" checked>Todos</option>
                  <option value="2">Os Templários</option>
                  <option value="3">Divergente</option>
                  <option value="4">Gulliver</option>
                  <option value="5">Avalanche</option>                                            
                </select>                
              </div>                                     
            </div>

            <div class="col-sm-1">
              <div class="form-group">
                <button class="btn btn-primary" type="submit">Gerar Relatório</button>
              </div>
            </div>
          </div>
        </form>
      <?php endif; ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>../dashboard/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>../dashboard/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <script src="<?php echo BASE_URL; ?>../dashboard/public/js/bootstrap-datepicker/calendario.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>