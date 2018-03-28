<?php 

# verificando se existe uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  # recuperando id do chat
  $chat = isset($_GET['chat']) ? $_GET['chat'] : null;

  # verificando se o id do chat não foi enviado
  if (! empty($chat)) {

    require '../../../init.php';
    require DIRETORIO_MODULES . 'talks/modulo_mensagens.php';    

    # chamando função responsável por buscar as mensagens do id do chat
    buscaMensagensDoChat($chat);

  } else {

    # não foi enviado o id do chat
    echo 'Erro: O id do chat não foi enviado!';
    
    exit;

  }

}