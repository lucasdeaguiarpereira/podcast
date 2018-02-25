<?php require 'database/conexao.php' ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>BAUC</title>

  <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap-3.3.7.min.css">
  <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../libs/normalize/css/normalize-7.0.0.css">
</head>
<body>
<div class="container">
	 <div class="header">
	   <h1>BAUC - Informações dos Usuários</h1>
	   <nav>
	    <ul>
	      <li><a href="cadastro.php">Cadastro</a></li>
	      <li><a href="login.php">Login</a></li>
	    </ul>
	   </nav>
	 </div>
	 <div class="row">
	 	<?php
	      $sql = mysqli_query($conexao,"select * from usuario") or die("Erro");
	      while($dados=mysqli_fetch_assoc($sql))
	      {
	        echo $dados['cod_usuario'].' - '.$dados['nome'].' - '.$dados['data_nascimento'].' - '.$dados['email'].' - '.$dados['senha'].'<br><br>';
	      }
	 	?>
	 </div>
</div>

<script src="../libs/bootstrap/js/bootstrap-3.3.7.min.js"></script>
<script src="../libs/bootstrap/js/npm.js"></script>
<script src="../libs/jquery/js/jquery-3.2.1.min.js"></script>
</body>
</html>