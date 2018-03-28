<?php

/**
 * consulta o id do chat dos colaboradores de um time
 * @param - objeto com uma conexão aberta
 * @param - string com o código do time
 */
function consultaIdDosColaboradoresDoTime($db, $time)
{
  $ids = array();

  # verificando se o usuário selecionou um ou todos os times
  if ($time != '1') {
    
    $query = 
      "SELECT 
        id_colaborador AS id
      FROM av_dashboard_colaborador_times 
      WHERE (data_saida IS NULL) 
        AND (id_times = $time)
      ORDER BY id_colaborador";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      # recuperando id do chat dos colaboradores de um time
      while ($registro = $resultado->fetch_assoc()) {

        $ids[$time][] = $registro['id'];

      }

    }

  } else {

    $query =
      "SELECT
        id_colaborador AS id,
        id_times AS time
      FROM av_dashboard_colaborador_times
      WHERE (data_saida IS NULL)
      ORDER BY id_times, id_colaborador";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      # recuperando id do chat dos colaboradores de todos os times
      while ($registro = $resultado->fetch_assoc()) {
        
        # verificando se o id do chat do colaborador pertence ao time os templários
        if ($registro['time'] == '2') {

          $ids['2'][] = $registro['id'];
        
        # verificando se o id do chat do colaborador pertence ao time divergente
        } elseif ($registro['time'] == '3') { 

          $ids['3'][] = $registro['id'];
        
        # verificando se o id do chat do colaborador pertence ao time gulliver
        } elseif ($registro['time'] == '4') {

          $ids['4'][] = $registro['id'];
        
        # verificando se o id do chat do colaborador pertence ao time avalanche
        } elseif ($registro['time'] == '5') {

          $ids['5'][] = $registro['id'];

        }

      }

    }

  }

  return $ids;

}

/**
 * consulta os resultados de um período dos colaboradores de um time
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat dos colaboradores
 * @param - string com a data inicial
 * @param - string com a data final
 * @param - array modelo de dados do painel metas capitães 
 */
function consultaResultadosDosColaboradores($db, $colaboradores, $data1, $data2, $dados)
{ 
  $query =
    "SELECT 	
      u.id,
      t.id_times AS time,
      u.name AS nome,
      u.surname AS sobrenome,
      COALESCE(d.demandados, 0) AS demandados,
      COALESCE(
        ROUND(100 * (COALESCE(p.perdidos, 0) / COALESCE(d.demandados, 0)), 0), 0) AS percentual_perda,
      COALESCE(
        ROUND(100 * (COALESCE(r.realizados_15_min, 0) / COALESCE(d.demandados, 0)), 0), 0) AS percentual_fila_15_min
    FROM lh_users AS u
    INNER JOIN av_dashboard_colaborador_times AS t
      ON t.id_colaborador = u.id
    LEFT JOIN
      (SELECT
        a.user_id,
        COUNT(a.id) AS perdidos
      FROM
        (SELECT
          c.user_id,
          c.id,
          TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS espera
        FROM lh_chat AS c
        WHERE (c.chat_duration = 0)
          AND (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '$data1' AND '$data2')) AS a
      WHERE (a.espera >= '00:03:00')
      GROUP BY a.user_id) AS p
    ON p.user_id = u.id
    LEFT JOIN
      (SELECT
        a.user_id,
        COUNT(a.id) AS demandados
      FROM
        (SELECT
          c.user_id,
          c.id,
          c.chat_duration,
          TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS espera
        FROM lh_chat AS c
        WHERE (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '$data1' AND '$data2')) AS a
      WHERE NOT (a.espera < '00:03:00' AND a.chat_duration = 0)
      GROUP BY a.user_id) AS d
    ON d.user_id = u.id
    LEFT JOIN
      (SELECT
        a.user_id,
        COUNT(a.id) AS realizados_15_min
      FROM
        (SELECT
          c.id,
          c.user_id,
          c.chat_duration,
          TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
        FROM lh_chat AS c
        WHERE (c.wait_time < 900)
          AND (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '$data1' AND '$data2')) AS a
      WHERE NOT (a.time_diff < '00:03:00' AND a.chat_duration = 0)
      GROUP BY a.user_id) AS r
    ON r.user_id = u.id
    WHERE (t.data_saida IS NULL)
      AND ($colaboradores)
    ORDER BY t.id_times, u.id";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando resultados e separando as informações por times
    while ($registro = $resultado->fetch_assoc()) {

      # alterando o tipo de dados 
      settype($registro['demandados'], 'integer');
      settype($registro['percentual_perda'], 'float');
      settype($registro['percentual_fila_15_min'], 'float');

      # verificando se o id do chat do colaborador pertence ao time os templários
      if ($registro['time'] == '2') {

        # adicionando os índices retornados pela consulta e calculando os percentuais proporcionais
        $dados['2'][] = array(

          'id'              => $registro['id'],
          'nome'            => $registro['nome'],
          'sobrenome'       => $registro['sobrenome'],
          'demandados'      => $registro['demandados'],
          'perc_perda'      => $registro['percentual_perda'],
          'perc_fila'       => $registro['percentual_fila_15_min'],
          'perc_perda_prop' => $registro['demandados'] * $registro['percentual_perda'] / 100,
          'perc_fila_prop'  => $registro['demandados'] * $registro['percentual_fila_15_min'] / 100

        );
      
      # verificando se o id do chat do colaborador pertence ao time divergente
      } elseif ($registro['time'] == '3') {

        # adicionando os índices retornados pela consulta e calculando os percentuais proporcionais
        $dados['3'][] = array(

          'id'              => $registro['id'],
          'nome'            => $registro['nome'],
          'sobrenome'       => $registro['sobrenome'],
          'demandados'      => $registro['demandados'],
          'perc_perda'      => $registro['percentual_perda'],
          'perc_fila'       => $registro['percentual_fila_15_min'],
          'perc_perda_prop' => $registro['demandados'] * $registro['percentual_perda'] / 100,
          'perc_fila_prop'  => $registro['demandados'] * $registro['percentual_fila_15_min'] / 100

        );

      # verificando se o id do chat do colaborador pertence ao time gulliver
      } elseif ($registro['time'] == '4') {

        # adicionando os índices retornados pela consulta e calculando os percentuais proporcionais
        $dados['4'][] = array(

          'id'              => $registro['id'],
          'nome'            => $registro['nome'],
          'sobrenome'       => $registro['sobrenome'],
          'demandados'      => $registro['demandados'],
          'perc_perda'      => $registro['percentual_perda'],
          'perc_fila'       => $registro['percentual_fila_15_min'],
          'perc_perda_prop' => $registro['demandados'] * $registro['percentual_perda'] / 100,
          'perc_fila_prop'  => $registro['demandados'] * $registro['percentual_fila_15_min'] / 100

        );

      # verificando se o id do chat do colaborador pertence ao time avalanche
      } elseif ($registro['time'] == '5') {

        # adicionando os índices retornados pela consulta e calculando os percentuais proporcionais
        $dados['5'][] = array(

          'id'              => $registro['id'],
          'nome'            => $registro['nome'],
          'sobrenome'       => $registro['sobrenome'],
          'demandados'      => $registro['demandados'],
          'perc_perda'      => $registro['percentual_perda'],
          'perc_fila'       => $registro['percentual_fila_15_min'],
          'perc_perda_prop' => $registro['demandados'] * $registro['percentual_perda'] / 100,
          'perc_fila_prop'  => $registro['demandados'] * $registro['percentual_fila_15_min'] / 100

        );

      }

    }

    # verificando se existe resultados do time os templários no array
    if (isset($dados['2'])) {

      # adicionando os índices de totais
      $dados['2'][] = array(

        'total_perda_prop' => 0.0,
        'total_fila_prop'  => 0.0,
        'total_demandados' => 0,
        'total_perda'      => 0.0,
        'total_fila'       => 0.0
  
      );

    }
    
    # verificando se existe resultados do time divergente no array
    if (isset($dados['3'])) {

      # adicionando os índices de totais
      $dados['3'][] = array(

        'total_perda_prop' => 0.0,
        'total_fila_prop'  => 0.0,
        'total_demandados' => 0,
        'total_perda'      => 0.0,
        'total_fila'       => 0.0
  
      );

    }    

    # verificando se existe resultados do time gulliver no array
    if (isset($dados['4'])) {
      
      # adicionando os índices de totais
      $dados['4'][] = array(

        'total_perda_prop' => 0.0,
        'total_fila_prop'  => 0.0,
        'total_demandados' => 0,
        'total_perda'      => 0.0,
        'total_fila'       => 0.0
  
      );

    }    

    # verificando se existe resultados do time avalanche no array
    if (isset($dados['5'])) {
      
      # adicionando os índices de totais
      $dados['5'][] = array(

        'total_perda_prop' => 0.0,
        'total_fila_prop'  => 0.0,
        'total_demandados' => 0,
        'total_perda'      => 0.0,
        'total_fila'       => 0.0
  
      );

    }
    
  }

  return $dados;

}