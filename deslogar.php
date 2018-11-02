<?php
session_start();

unset ($_SESSION["id"]);
unset ($_SESSION["nome"]);
unset ($_SESSION['login']);
unset ($_SESSION['senha']);
header('location:index.php');
?>