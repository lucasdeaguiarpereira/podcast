<?php require '../../../init.php'; ?>

<?php 

  $conversa = array();

  # recuperando conversa que está na sessão
  $conversa = $_SESSION['conversa'];

  unset($_SESSION['conversa']);
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Conversas</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
  
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/talks/tabela_conversa.css">
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>../capa/public/home.php">
          <img id="logo" src="<?php echo BASE_URL; ?>../capa/public/img/logo.png" alt="Novo Capa">
          <p id="novo-capa">Portal Avanção</p>
        </a>        
      </div>      
    </div>    
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center">
          Conversa<br>
          <small>Confira abaixo todo o bate-papo entre atendente e cliente!</small>
        </h2>        
      </div>
    </div>
    
    <br>

    <div class="row">
      <div class="col-sm-12">      
        <table class="table">
          <thead>
            <tr>
              <th class="text-left">Data/Horário</th>
              <th class="text-left">Técnico/Cliente</th>
              <th class="text-center">Mensagens</th>
            </tr>
          </thead>

          <tbody> 
            <?php foreach ($conversa as $conversa) : ?>
              <tr>
                <td class="text-left" width="18%"><?php echo $conversa['data']; ?></td>
                <td class="text-left" width="18%"><?php echo $conversa['suporte']; ?></td>
                <td class="text-justify" width="64%"><?php echo $conversa['mensagem']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>          
        </table>      
      </div>
    </div>        
  </div><!-- container -->

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script> 
</body>
</html>
