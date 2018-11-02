<?php	
	$email = $_POST['email'];
	$senha = sha1($_POST['senha']);

	require 'data/conexao.php';

	$sql = mysqli_query($conexao,"SELECT * FROM `users` WHERE email='$email' AND senha='$senha'") or die("Erro");
	$dados=mysqli_fetch_assoc($sql);

	session_start();
	
	if($dados!=null)
	{	
		$_SESSION["id"] = $dados["id"];
		$_SESSION["nome"] = $dados["nome"];
		$_SESSION['login'] = $dados["email"];
		$_SESSION['senha'] = $dados["senha"];
		header('location:index.php');
	}
	else{
		unset ($_SESSION["id"]);
		unset ($_SESSION["nome"]);
		unset ($_SESSION['login']);
		unset ($_SESSION['senha']);
		header('location:login.php');
     
    }

	
?>