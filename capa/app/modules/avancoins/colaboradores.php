<?php

/*
 * responsável por criar as opções com os dados dos colaboradores
 */
function criaOpcoesDeColaboradores()
{
  require '../../../init.php';

  require DIRETORIO_FUNCTIONS . '/avancoins/colaboradores.php';

  $db = abre_conexao();

  $options = '';

  # chamando função que consulta e retorna as opções dos colaboradores existentes no chat
  $options = consultaColaboradores($options, $db);

  # ecoando as opções para o formulário de novo ticket
  echo $options;

}
