<?php	
	$email = $_POST['email'];
	$senha = sha1($_POST['senha']);

	require '../database/conexao.php';

	$sql = mysqli_query($conexao,"SELECT email, senha FROM `usuario` WHERE email='$email'") or die("Erro");
	$dados=mysqli_fetch_assoc($sql);

	if(($dados['email']==$email)&&($dados['senha']==$senha))
	{
		echo "logado";
	}
	else
	{
		echo "não logado";
	}


	      
?>