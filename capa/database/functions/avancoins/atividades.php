<?php

/**
 * insere uma nova atividade esporádica na tabela de ações esporádicas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de nova atividade
 */
function insereNovaAtividadeEsporadica($db, $form)
{
  $colunas = null;
  $valores = null;

  # inserindo atividade esporádica
  foreach ($form as $chave => $valor) {

    $colunas .= trim($chave, "'") . ', ';
    $valores .= "'$valor', ";

  }

  $colunas = rtrim($colunas, ', ');
  $valores = rtrim($valores, ', ');

  $query = '';
  $query = "INSERT INTO av_avancoins_acoes_esporadicas_logs " . "($colunas)" . " VALUES " . "($valores);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    return $resultado;

  }

}
