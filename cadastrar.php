<?php
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$data = $_POST['data'];
	$senha = $_POST['senha'];

	require 'database/conexao.php';



	$sql = "INSERT INTO `usuario` (`email`, `senha`) VALUES (NULL, '$nome', '$data', '$email', sha1($senha));"; 
	mysqli_query($conexao,$sql) or die("Erro ao tentar cadastrar registro");
	
	
?>