<?php

/*
 * cria um array modelo para receber os dados do usuário
 */
function criaModeloDeUsuario()
{
  $usuario = array(
    'id'        => 0,
    'nome'      => '',
    'sobrenome' => '',
    'email'     => '',
    'nivel'     => '',
    'usuario'   => '',
    'ramal'     => ''
  );

  return $usuario;

}