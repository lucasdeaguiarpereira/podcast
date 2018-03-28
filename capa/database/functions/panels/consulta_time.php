<?php 

/**
 * consulta o id do time atual do capitão
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat do capitão
 */
function consultaTimeDoCapitaoLogado($db, $id)
{
  $query =
    "SELECT    
      id_times    
    FROM av_dashboard_colaborador_times 
    WHERE (data_saida IS NULL) 
      AND (id_colaborador = $id)";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando id do time
    $time = $resultado->fetch_row();
    $time = $time[0];

  }

  return $time;

}