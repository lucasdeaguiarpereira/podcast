<?php

/**
 * retorna todos os comentários satisfeitos de um cliente específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - variável com o cnpj de um cliente específico
 */
function retornaComentariosSatisfeitosCnpj($conexao, $datas, $cnpj)
{
  $sql =
  "SELECT
  	FROM_UNIXTIME(c.time, '%d-%m-%Y %H:%i:%s') AS data_e_hora,
  	c.id AS chat_id,
  	d.name AS departamento,
  	CONCAT(u.name, ' ', u.surname) AS atendente,
  	SUBSTRING_INDEX(SUBSTR(c.additional_data, (LOCATE('\"key\":\"nomeContato\"', c.additional_data) + 29)), '\"', 1) AS nome_do_contato,
  	SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data) + 32)),'\"',1) AS razao_social,
  	e.comentario,
  	f.feedback
  FROM lh_chat AS c
  INNER JOIN lh_users AS u
  	ON u.id = c.user_id
  INNER JOIN lh_departament AS d
  	ON d.id = c.dep_id
  INNER JOIN av_questionario_externo AS e
  	ON e.id_chat = c.id
  LEFT JOIN av_feedback AS f
  	ON f.id_chat = c.id
  WHERE (c.status = 2)
  	AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
  	AND (e.comentario <> '')
  	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
    AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',c.additional_data)+ 29)),'\"',1) LIKE '%$cnpj%')";

  $resultado = mysqli_query($conexao, $sql);

  $comentarios = mysqli_fetch_all($resultado);

  return $comentarios;
}

/**
 * retorna todos os comentários insatisfeitos de um cliente durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - variável com o cnpj de um cliente específico
 */
function retornaComentariosInsatisfeitosCnpj($conexao, $datas, $cnpj)
{
  $sql =
  "SELECT
  	FROM_UNIXTIME(c.time, '%d-%m-%Y %H:%i:%s') AS data_e_hora,
  	c.id AS chat_id,
  	d.name AS departamento,
  	CONCAT(u.name, ' ', u.surname) AS atendente,
  	SUBSTRING_INDEX(SUBSTR(c.additional_data, (LOCATE('\"key\":\"nomeContato\"', c.additional_data) + 29)), '\"', 1) AS nome_do_contato,
  	SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data) + 32)),'\"',1) AS razao_social,
  	e.comentario,
  	f.feedback
  FROM lh_chat AS c
  INNER JOIN lh_users AS u
  	ON u.id = c.user_id
  INNER JOIN lh_departament AS d
  	ON d.id = c.dep_id
  INNER JOIN av_questionario_externo AS e
  	ON e.id_chat = c.id
  LEFT JOIN av_feedback AS f
  	ON f.id_chat = c.id
  WHERE (c.status = 2)
  	AND (e.avaliacao_colaborador = 'Ruim' OR e.avaliacao_colaborador = 'Pessimo')
  	AND (e.comentario <> '')
  	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
    AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',c.additional_data)+ 29)),'\"',1) LIKE '%$cnpj%')";

  $resultado = mysqli_query($conexao, $sql);

  $comentarios = mysqli_fetch_all($resultado);

  return $comentarios;
}
