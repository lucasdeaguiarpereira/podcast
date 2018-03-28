<?php 

/**
 * consulta o último id de issue inserido na tabela de issues
 */
function consultaUltimoId($db)
{
  $query = "SELECT id FROM av_registro_horas_issues ORDER BY id DESC";

  if ($resultado = $db->query($query)) {

    $resultado = $resultado->fetch_row();

    $id = (int)$resultado[0];

  }

  return $id;

}