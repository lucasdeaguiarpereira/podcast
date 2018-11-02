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
  <?php  include 'nav.php';?>
	 <div class="row">
	 	<div class="col-md-6 col-md-offset-3">
	 		<h1 class="text-center">Login</h1>
			<form action="logar.php" method="post">
			    <div class="form-group">
			        <label class="control-label" for="email">E-mail:</label>
			        <input class="form-control" type="email" id="email" name="email" />
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="senha">Senha:</label>
			        <input class="form-control" type="password" id="senha" name="senha" />
			    </div>
			    <input class="btn btn-default" type="submit" name="enviar" value="Enviar">
			</form>

		</div>
	 </div>
</div>

<script src="libs/jquery/js/jquery-3.2.1.min.js"></script>
<script src="libs/bootstrap/js/bootstrap-3.3.7.min.js"></script>
<script src="libs/bootstrap/js/npm.js"></script>
</body>
</html>