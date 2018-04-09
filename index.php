<?php require 'data/conexao.php' ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Podcast do Pereirinha</title>

  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap-3.3.7.min.css">
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="libs/main.css">
</head>
<body>
<div class="container">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Podcast do Pereirinha</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="textos.php">Textos<span class="sr-only">(current)</span></a></li>
          <li><a href="coments.php">Comentários</a></li>
        </ul>
        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Digite aqui idiota">
          </div>
          <button type="submit" class="btn btn-default">Pesquisar</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuário <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="login.php">Login</a></li>
              <li><a href="cadastro.php">Cadastro</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="deslogar.php">Deslogar</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <?php
    echo" Bem vindo $logado";
    ?>
    </td>
  <h1 class="text-center">Podcasts</h1>
   <div class="row">
     <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Primeiro Podcast</h3>
          </div>
          <div class="panel-body painel">
            <audio controls>
              <source src="teste.mp3" type="audio/mpeg">
              Seu navegador não suporta áudio tag.
            </audio>
          </div>
        </div>
     </div>
     <div class="col-md-4">
       <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Primeiro Podcast</h3>
          </div>
          <div class="panel-body painel">
            <audio controls>
              <source src="teste.mp3" type="audio/mpeg">
              Seu navegador não suporta áudio tag.
            </audio>
          </div>
        </div>
     </div>
     <div class="col-md-4">
       <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Primeiro Podcast</h3>
          </div>
          <div class="panel-body painel">
            <audio controls>
              <source src="teste.mp3" type="audio/mpeg">
              Seu navegador não suporta áudio tag.
            </audio>
          </div>
        </div>
     </div>
   </div>
</div>
 
<script src="libs/jquery/js/jquery-3.2.1.min.js"></script>
<script src="libs/bootstrap/js/bootstrap-3.3.7.min.js"></script>
<script src="libs/bootstrap/js/npm.js"></script>

</body>
</html>
