<?php

/**
 * responsável por realizar o login do usuário na aplicação
 * @param - array com email, senha digitada pelo usuário e senha criptografada
 * @param - array com o modelo para receber os dados do usuário
 */
function realizaLoginNaAplicacao($login, $usuario)
{
  # abrindo conexão
  $db = abre_conexao();

  $controle = NULL;

  # chamando função que irá consultar a base de dados
  $controle = consultaDadosDoUsuario($login, $usuario, $db);

  # verificando se o usuário forneceu email e senha válidos
  if ($controle) {

    # redirecionando usuário para a página home da aplicação
    header('Location: ' . PAGE_HOME);

  } else {

    # redirecionando usuário para o formulário de login
    header('Location: ' . FORM_LOGIN);

  }

}
