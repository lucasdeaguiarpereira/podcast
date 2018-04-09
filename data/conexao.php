<?php
 $conexao = mysqli_connect('localhost','root','super');
 $banco = mysqli_select_db($conexao,'podcast');
 mysqli_set_charset($conexao,'utf8');
 
?>
