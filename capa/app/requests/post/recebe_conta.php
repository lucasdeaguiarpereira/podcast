<?php 

# verificando se existe requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require DIRETORIO_MODELS  . 'users/usuario.php';  
  require DIRETORIO_MODULES . 'users/usuario.php';

  # chamando função que cria o modelo de usuário  
  $usuario = criaModeloDeUsuario();

  # recuperando dados do formulário de conta
  $usuario['id']    = isset($_POST['form']['id'])    ? $_POST['form']['id']    : NULL;  
  $usuario['ramal'] = isset($_POST['form']['ramal']) ? $_POST['form']['ramal'] : NULL;
  
  # verificando se os dados do formulário de conta não estão vazios
  if (! empty($usuario['id']) OR ! empty($usuario['ramal'])) {

    # chamando função responsável por realizar atualizar os dados do usuário
    atualizaContaDoUsuario($usuario);

  }

}
