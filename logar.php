<?php	
	$email = $_POST['email'];
	$senha = sha1($_POST['senha']);

	require 'data/conexao.php';

	$sql = mysqli_query($conexao,"SELECT * FROM `user` WHERE email='$email' AND senha='$senha'") or die("Erro");
	$dados=mysqli_fetch_assoc($sql);

	
	if($dados!=null)
	{
		$_SESSION['login'] = $email;
		$_SESSION['senha'] = $senha;
		header('location:index.php');
	}
	else{
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    header('location:login.php');
     
    }

	      
?>