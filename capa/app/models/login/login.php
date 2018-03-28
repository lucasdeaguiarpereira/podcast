<?php

/*
 * cria um array modelo para receber os dados do formulário de login
 */
function criaModeloDeLogin()
{
  $login = array(
    'email'      => '',
    'senha'      => '',
    'senha_hash' => ''
  );

  return $login;
}
