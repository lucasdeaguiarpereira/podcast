<?php 

# verificando se existe uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  # verificando se o id do chat e o status foram enviados
  if (isset($_GET['id']) AND isset($_GET['status'])) {

    # recuperando id do chat e status
    $id     = $_GET['id'];
    $status = $_GET['status'];

    require '../../../init.php';    
    require DIRETORIO_MODULES . 'panels/modulo_colaboradores_logados.php';

    # chamando função responsável por alterar o status do usuário no chat
    alteraStatus($id, $status);

  }

}