<?php

/**
 * consulta todos os tickets gerados
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de dados de tickets
 */
function consultaTodosOsTicketsGerados($db, $tickets)
{
  $query =
    "SELECT
    	DATE_FORMAT(t.data_hora, '%d/%m/%Y') AS data,
    	t.ticket,
    	CASE
    		WHEN (t.chat_id IS NULL)
    			THEN 0
    		ELSE
    			t.chat_id
    	END AS chat_id,
    	CASE
    		WHEN (t.validade = 0)
    			THEN 'Vencido'
    		WHEN (t.validade = 1)
    			THEN 'Válido'
    	END AS validade,
    	t.contato,
    	t.cnpj,
    	t.conta_contrato,
    	t.razao_social,
      t.telefone,
    	CONCAT(s.name, ' ', s.surname) AS supervisor,
    	CONCAT(c.name, ' ', c.surname) AS colaborador,
    	p.nome AS produto,
    	m.nome AS modulo,
    	t.assunto
    FROM av_tickets AS t
    INNER JOIN
    	(SELECT
    		u.id,
    		u.name,
    		u.surname
    	FROM lh_users AS u) AS s
    ON s.id = t.supervisor
    INNER JOIN
    	(SELECT
    		u.id,
    		u.name,
    		u.surname
    	FROM lh_users AS u) AS c
    ON c.id = t.colaborador
    INNER JOIN av_dashboard_produtos AS p
    ON p.id = t.produto
    INNER JOIN av_dashboard_modulos AS m
    ON m.id = t.modulo
    ORDER BY t.data_hora DESC";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $tickets[] = array(

        'data'           => $registro['data'],
        'ticket'         => $registro['ticket'],
        'chat_id'        => $registro['chat_id'],
        'validade'       => $registro['validade'],
        'contato'        => $registro['contato'],
        'cnpj'           => $registro['cnpj'],
        'conta_contrato' => $registro['conta_contrato'],
        'razao_social'   => $registro['razao_social'],
        'telefone'       => $registro['telefone'],
        'supervisor'     => $registro['supervisor'],
        'colaborador'    => $registro['colaborador'],
        'produto'        => $registro['produto'],
        'modulo'         => $registro['modulo'],
        'assunto'        => $registro['assunto']

      );

    }

  }

  return $tickets;

}

/**
 * deleta um ticket
 * @param - objeto com uma conexão aberta
 * @param - string com o número do ticket que será deletado
 */
function deletaTicketNoBancoDeDados($db, $ticket)
{
  $query = "DELETE FROM av_tickets WHERE ticket = $ticket";

  $db->query($query);

}

/**
 * invalida um ticket
 * @param - objeto com uma conexão aberta
 * @param - string com o número do ticket que será invalidado
 */
function invalidaTicketNoBancoDeDados($db, $ticket)
{
  $query = "UPDATE av_tickets SET validade = 0 WHERE ticket = $ticket";

  $db->query($query);

}
