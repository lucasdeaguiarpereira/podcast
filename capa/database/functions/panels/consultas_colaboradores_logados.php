<?php

/**
 * consulta a quantidade de clientes que estão em atendimento
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaAtendimentosEmAndamento($painel, $db)
{
  # consultando clientes que estão em atendimento
    for ($i = 0; $i < count($painel); $i++) {

      $query =
        "SELECT
        	COUNT(c.id) AS em_atendimento
        FROM lh_chat AS c
        WHERE (c.dep_id = {$painel[$i]['departamento']})
        	AND (c.status = 1)
          AND (c.user_status = 0)
        	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') = CURRENT_DATE())";

      if ($resultado = $db->query($query)) {

        $linha = mysqli_fetch_row($resultado);

        $painel[$i]['atendimento'] = $linha[0];

      }

    }

  return $painel;
}

/**
 * consulta a quantidade de clientes que estão em espera
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaAtendimentosEmEspera($painel, $db)
{
  # consultando clientes que estão em espera
  for ($i = 0; $i < count($painel); $i++) {

    $query =
      "SELECT
      	COUNT(c.id) AS em_espera
      FROM lh_chat AS c
      WHERE (c.dep_id = {$painel[$i]['departamento']})
      	AND (c.status = 0)
        AND (c.user_status = 0)
      	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') = CURRENT_DATE())";

    if ($resultado = $db->query($query)) {

      $linha = mysqli_fetch_row($resultado);

      $painel[$i]['espera'] = $linha[0];

    }

  }

  return $painel;
}

/**
 * consulta a quantidade de clientes que estão em espera acima de 10 minutos
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaAtendimentosEmEsperaAcimaDe10Minutos($painel, $db)
{
  # consultando clientes que estão em espera
  for ($i = 0; $i < count($painel); $i++) {

    $query =
      "SELECT
        COUNT(a.id) espera_acima_10_min
      FROM 
        (SELECT
          c.id,		
          TIMEDIFF(CURRENT_TIME(), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS tempo_espera
        FROM lh_chat AS c
        WHERE (c.dep_id = {$painel[$i]['departamento']})
          AND (c.status = 0)
          AND (c.user_status = 0)	
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') = CURRENT_DATE())) AS a
        WHERE (a.tempo_espera > '00:10:00')";

    if ($resultado = $db->query($query)) {

      while ($registro = $resultado->fetch_assoc()) {

        $painel[$i]['espera_acima_10_min'] = $registro['espera_acima_10_min'];

      }

    }

  }
  
  return $painel;
}

/**
 * consulta id, departamento, nome e sobrenome dos colaboradores
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaDadosDosColaboradores($painel, $db)
{
  $query =
    "SELECT
      t.id,
      t.nome,
      t.sobrenome,
      t.departamento,
      CASE
        WHEN (t.data = CURRENT_DATE() AND t.diferenca <= '00:40:00')
          THEN 'Sim'
        WHEN (t.data = CURRENT_DATE() AND t.diferenca > '00:40:00')
			    THEN 'Não'
        WHEN (t.data <> CURRENT_DATE())
          THEN 'Não'
      END AS logado,
      CASE
        WHEN (t.status = 1)
          THEN 'Offline'
        WHEN (t.status <> 1)
          THEN 'Online'
      END AS status
    FROM
      (SELECT
        u.user_id AS id,
        s.name AS nome,
        s.surname AS sobrenome,
        u.dep_id AS departamento,
        FROM_UNIXTIME(u.last_activity, '%Y-%m-%d') AS data,    
        FROM_UNIXTIME(u.last_activity, '%H:%i:%s') AS horario_saida,    
        TIMEDIFF(FROM_UNIXTIME(u.last_activity, '%T'), CURRENT_TIME()) AS diferenca,
        u.hide_online AS status
      FROM lh_userdep AS u
      INNER JOIN lh_users AS s
        ON s.id = u.user_id
      INNER JOIN lh_departament AS d
        ON d.id = u.dep_id
      WHERE NOT
        (u.user_id = 1   OR
        u.user_id  = 2  OR
        u.user_id  = 3  OR
        u.user_id  = 4  OR
        u.user_id  = 5  OR
        u.user_id  = 6  OR
        u.user_id  = 42 OR
        u.user_id  = 44 OR
        u.user_id  = 61)
        AND (u.dep_id > 0)
        AND NOT (d.disabled = 1)
        AND NOT (s.disabled = 1)
        AND NOT (TIMEDIFF(CURRENT_TIME(),FROM_UNIXTIME(u.last_activity, '%T')) > '00:00:00')
      
      UNION
      
      SELECT
        u.user_id AS id,
        s.name AS nome,
        s.surname AS sobrenome,
        u.dep_id AS departamento,
        FROM_UNIXTIME(u.last_activity, '%Y-%m-%d') AS data,    
        FROM_UNIXTIME(u.last_activity, '%H:%i:%s') AS horario_saida,        
        TIMEDIFF(CURRENT_TIME(),FROM_UNIXTIME(u.last_activity, '%T')) AS diferenca,
        u.hide_online AS status
      FROM lh_userdep AS u
      INNER JOIN lh_users AS s
        ON s.id = u.user_id
      INNER JOIN lh_departament AS d
        ON d.id = u.dep_id
      WHERE NOT
        (u.user_id = 1   OR
        u.user_id  = 2  OR
        u.user_id  = 3  OR
        u.user_id  = 4  OR
        u.user_id  = 5  OR
        u.user_id  = 6  OR
        u.user_id  = 42 OR
        u.user_id  = 44 OR
        u.user_id  = 61)
        AND (u.dep_id > 0)
        AND NOT (d.disabled = 1)
        AND NOT (s.disabled = 1)
        AND NOT (TIMEDIFF(CURRENT_TIME(),FROM_UNIXTIME(u.last_activity, '%T')) < '00:00:00')) AS t;";

    if ($resultado = $db->query($query)) {

      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $painel[] = array(

          'id'                  => $registro['id'],
          'nome'                => $registro['nome'],
          'sobrenome'           => $registro['sobrenome'],
          'departamento'        => $registro['departamento'],
          'atendimento'         => 0,
          'espera'              => 0,
          'espera_acima_10_min' => 0,
          'logado'              => $registro['logado'],
          'status'              => $registro['status'],
          'exibir'              => false

        );

      }

      # chamando função que consulta a quantidade de clientes em atendimento
      $painel = consultaAtendimentosEmAndamento($painel, $db);

      # chamando função que consulta a quantidade de clientes em espera
      $painel = consultaAtendimentosEmEspera($painel, $db);

      # chamando função que consulta a quantidade de clientes em espera acima de 10 minutos
      $painel = consultaAtendimentosEmEsperaAcimaDe10Minutos($painel, $db);

    }

    return $painel;
}

/**
 * consulta id dos colaboradores do time do capitão logado no portal avanção
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de dados de opções
 */
function consultaIdDosColaboradoresDoTime($db, $dados)
{
  $query =
  "SELECT 
    id_colaborador 
  FROM av_dashboard_colaborador_times 
  WHERE (data_saida IS NULL) 
    AND (id_times = {$dados['time']})";

  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_assoc()) {

      $dados['id'][] = $registro['id_colaborador'];

    }

  }
  
  return $dados;

}

/**
 * consulta id de todos os colaboradores do chat
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de dados de opções
 */
function consultaIdDeTodosOsColaboradores($db, $dados)
{
  $query =
    "SELECT
      id
    FROM lh_users
    WHERE NOT 
      (id = 1  OR
       id = 2  OR
       id = 3  OR
       id = 4  OR
       id = 5  OR
       id = 6  OR
       id = 36 OR
       id = 37 OR
       id = 38 OR
       id = 39 OR
       id = 40 OR
       id = 41 OR
       id = 42 OR
       id = 44 OR
       id = 61)
      AND NOT (disabled = 1)";

  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_assoc()) {

      $dados['id'][] = $registro['id'];

    }

  }
  
  return $dados;

}