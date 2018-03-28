<?php require '../../../init.php'; ?>

<?php require DIRETORIO_MODULES . 'users/usuario.php'; ?>

<?php 

  # chamando função que consulta todos os ramais 
  $ramais = consultaRamaisDosUsuarios(); 
  
  # separando dados por setor
  $suporte   = $ramais['suporte'];
  $comercial = $ramais['comercial'];
  $rh        = $ramais['rh'];
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Painel Ramais</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/panels/tabela_ramais.css">  
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Painel Ramais</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <h4 class="text-center">Atendimento</h4>

            <br>

            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="text-left" width="40%">Nome</th>                  
                  <th class="text-left" width="50%">Email</th>
                  <th class="text-left">Ramal</th>                  
                </tr>
              </thead>
              <tbody>
              <?php foreach($suporte as $suporte) : ?>
                <tr>
                  <td class="text-left"><?php echo $suporte['nome'] . ' ' . $suporte['sobrenome']; ?></td>                  
                  <td class="text-left"><?php echo $suporte['email']; ?></td>
                  <td class="text-left"><?php echo $suporte['ramal']; ?></td>                  
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->
          </div>
        </div><!-- linha -->

        <div class="row">
          <div class="col-sm-12">
            <h4 class="text-center">Comercial</h4>

            <br>

            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="text-left" width="40%">Nome</th>                  
                  <th class="text-left" width="50%">Email</th>
                  <th class="text-left">Ramal</th>                  
                </tr>
              </thead>
              <tbody>
              <?php foreach($comercial as $comercial) : ?>
                <tr>
                  <td class="text-left"><?php echo $comercial['nome'] . ' ' . $comercial['sobrenome']; ?></td>                  
                  <td class="text-left"><?php echo $comercial['email']; ?></td>
                  <td class="text-left"><?php echo $comercial['ramal']; ?></td>                  
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->
          </div>
        </div><!-- linha -->

        <div class="row">
          <div class="col-sm-12">
            <h4 class="text-center">RH</h4>

            <br>

            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="text-left" width="40%">Nome</th>                  
                  <th class="text-left" width="50%">Email</th>
                  <th class="text-left">Ramal</th>                  
                </tr>
              </thead>
              <tbody>
              <?php foreach($rh as $rh) : ?>
                <tr>
                  <td class="text-left"><?php echo $rh['nome'] . ' ' . $rh['sobrenome']; ?></td>                  
                  <td class="text-left"><?php echo $rh['email']; ?></td>
                  <td class="text-left"><?php echo $rh['ramal']; ?></td>                  
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->
          </div>
        </div><!-- linha -->
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
</body>
</html>
