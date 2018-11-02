<?php
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	require 'data/conexao.php';



	$sql = "INSERT INTO `users` (`id`, `nome`, `email`, `senha`) VALUES ('', '$nome', '$email', sha1('$senha'));"; 

	mysqli_query($conexao,$sql) or die("Erro ao tentar cadastrar registro");

	$url = 'index.php';
	echo'<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
	
?>