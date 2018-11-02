<?php 
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset ($_SESSION["id"]);
	unset ($_SESSION["nome"]);
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
 	echo "Usuario";   
}else
{
	echo $_SESSION['nome'];
}
?>