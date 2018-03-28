<?php

# verificando se existe requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require DIRETORIO_MODELS  . 'login/login.php';
  require DIRETORIO_MODELS  . 'users/usuario.php';
  require DIRETORIO_MODULES . 'login/login.php';

  # chamando função que cria os modelos de login e usuário
  $login   = criaModeloDeLogin();
  $usuario = criaModeloDeUsuario();

  # recuperando dados do formulário de login
  $login['email'] = isset($_POST['form']['email']) ? $_POST['form']['email'] : NULL;
  $login['senha'] = isset($_POST['form']['senha']) ? $_POST['form']['senha'] : NULL;

  # verificando se os dados do formulário de login não estão vazios
  if (! empty($login['email']) OR ! empty($login['senha'])) {

    # chamando função criptografada a senha do formulário de login
    $login['senha_hash'] = criaCodigoHash($login['senha']);

    # chamando função responsável por realizar o login do usuário na aplicação
    realizaLoginNaAplicacao($login, $usuario);

  }

}
