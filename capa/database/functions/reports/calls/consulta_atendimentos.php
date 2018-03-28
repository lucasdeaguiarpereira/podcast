<?php 

/**
 * consulta os atendimentos em um período e com os filtros desejados
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário
 */
function consultaAtendimentos($db, $dados)
{
  # verificando se a consulta será realizada por empresa
  if ($dados['tipo'] == '1') {

    # verificando se a consulta será realizada pelo cnpj da empresa
    if ($dados['filtro'] == 'cnpj') {

      $query =
        "SELECT
          FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data,
          c.id AS chat_id,
          CONCAT(u.name , ' ', u.surname) AS colaborador,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) AS conta_contrato,
          e.nome_equipe,
	        d.nome_demanda,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"',c.additional_data)+ 26)),'\"',1) AS contato
        FROM lh_chat AS c
        INNER JOIN lh_users AS u
          ON u.id = c.user_id
        INNER JOIN av_questionario_interno AS i
          ON i.id_chat = c.id
        INNER JOIN av_base_equipe AS e
          ON e.cod_equipe = i.equipe
        INNER JOIN av_base_demanda AS d
          ON d.cod_demanda = i.demanda
        WHERE (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$dados['periodo']['data1']}' AND '{$dados['periodo']['data2']}')
          AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = '{$dados['cnpj']}')
        ORDER BY data;";

    # verificando se a consulta será realizada pela conta contrato da empresa
    } elseif ($dados['filtro'] == 'contrato') {

      $query =
        "SELECT
          FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data,
          c.id AS chat_id,
          CONCAT(u.name , ' ', u.surname) AS colaborador,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) AS conta_contrato,
          e.nome_equipe,
	        d.nome_demanda,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"',c.additional_data)+ 26)),'\"',1) AS contato
        FROM lh_chat AS c
        INNER JOIN lh_users AS u
          ON u.id = c.user_id
        INNER JOIN av_questionario_interno AS i
          ON i.id_chat = c.id
        INNER JOIN av_base_equipe AS e
          ON e.cod_equipe = i.equipe
        INNER JOIN av_base_demanda AS d
          ON d.cod_demanda = i.demanda
        WHERE (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$dados['periodo']['data1']}' AND '{$dados['periodo']['data2']}')
          AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) = '{$dados['contrato']}')
        ORDER BY data;";

    }
  
  # verificando se a consulta será realizada por colaborador
  } elseif ($dados['tipo'] == '2') {

    $query =
      "SELECT
        FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data,
        c.id AS chat_id,
        CONCAT(u.name , ' ', u.surname) AS colaborador,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) AS conta_contrato,
        e.nome_equipe,
        d.nome_demanda,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"',c.additional_data)+ 26)),'\"',1) AS contato
      FROM lh_chat AS c
      INNER JOIN lh_users AS u
        ON u.id = c.user_id
      INNER JOIN av_questionario_interno AS i
        ON i.id_chat = c.id
      INNER JOIN av_base_equipe AS e
        ON e.cod_equipe = i.equipe
      INNER JOIN av_base_demanda AS d
        ON d.cod_demanda = i.demanda
      WHERE (c.status = 2)
        AND (c.user_id = {$dados['colaborador']})
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$dados['periodo']['data1']}' AND '{$dados['periodo']['data2']}')	
      ORDER BY data;";

  # verificando se a consulta será realizada por ambos (empresa e colaborador)
  } elseif ($dados['tipo'] == '3') {

    # verificando se a consulta será realizada por ambos pelo cnpj da empresa
    if ($dados['filtro'] == 'cnpj') {

      $query =
        "SELECT
          FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data,
          c.id AS chat_id,
          CONCAT(u.name , ' ', u.surname) AS colaborador,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) AS conta_contrato,
          e.nome_equipe,
	        d.nome_demanda,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"',c.additional_data)+ 26)),'\"',1) AS contato
        FROM lh_chat AS c
        INNER JOIN lh_users AS u
          ON u.id = c.user_id
        INNER JOIN av_questionario_interno AS i
          ON i.id_chat = c.id
        INNER JOIN av_base_equipe AS e
          ON e.cod_equipe = i.equipe
        INNER JOIN av_base_demanda AS d
          ON d.cod_demanda = i.demanda
        WHERE (c.status = 2)
          AND (c.user_id = {$dados['colaborador']})
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$dados['periodo']['data1']}' AND '{$dados['periodo']['data2']}')
          AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = '{$dados['cnpj']}')	
        ORDER BY data;";

    # verificando se a consulta será realizada por ambos pela conta contrato
    } elseif ($dados['filtro'] == 'contrato') {

      $query =
        "SELECT
          FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data,
          c.id AS chat_id,
          CONCAT(u.name , ' ', u.surname) AS colaborador,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) AS conta_contrato,
          e.nome_equipe,
	        d.nome_demanda,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
          SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"',c.additional_data)+ 26)),'\"',1) AS contato
        FROM lh_chat AS c
        INNER JOIN lh_users AS u
          ON u.id = c.user_id
        INNER JOIN av_questionario_interno AS i
          ON i.id_chat = c.id
        INNER JOIN av_base_equipe AS e
          ON e.cod_equipe = i.equipe
        INNER JOIN av_base_demanda AS d
          ON d.cod_demanda = i.demanda
        WHERE (c.status = 2)
          AND (c.user_id = {$dados['colaborador']})
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$dados['periodo']['data1']}' AND '{$dados['periodo']['data2']}')
          AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"contaContratoContato\"', c.additional_data)+ 38)),'\"',1) = '{$dados['contrato']}')	
        ORDER BY data;";

    }

  }

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    require DIRETORIO_HELPERS . 'diversas.php';
    require DIRETORIO_HELPERS . 'datas.php';

    $atendimentos = array();

    # recuperando dados da consulta
    while ($registro = $resultado->fetch_assoc()) {

      $registro['data']         = formataDataParaExibir($registro['data']);
      $registro['razao_social'] = strtoupper(decodificaCaracteresJSON($registro['razao_social']));
      $registro['cliente']      = ucwords(strtolower(decodificaCaracteresJSON($registro['cliente'])));

      $atendimentos[] = array(

        'data'           => $registro['data'],
        'chat_id'        => $registro['chat_id'],
        'colaborador'    => $registro['colaborador'],
        'razao_social'   => $registro['razao_social'],
        'cnpj'           => $registro['cnpj'],
        'conta_contrato' => $registro['conta_contrato'],
        'produto'        => $registro['nome_equipe'],
        'demanda'        => $registro['nome_demanda'],
        'cliente'        => $registro['cliente'],
        'contato'        => $registro['contato']

      );

    }

  }

  return $atendimentos;

}