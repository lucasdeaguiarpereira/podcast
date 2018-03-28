<?php 

/**
 * consulta as mensagens de um id de chat
 * @param - objeto com uma conexão aberta
 * @param - array com os índices de conversa
 * @param - string com o id do chat
 */
function consultaMensagensDoChat($db, $conversa, $chat)
{
  $query =
    "SELECT 
      FROM_UNIXTIME(m.time, '%d/%m/%Y %T') AS data,       
      m.msg AS mensagem,
      CASE 
        WHEN (m.user_id = -1) 
          THEN 'Ação do Técnico'
        WHEN (m.user_id = 0)
          THEN 'Cliente'
        WHEN (m.user_id <> -1 AND m.user_id <> 0)
          THEN m.name_support
      END AS suporte
    FROM lh_msg AS m
    WHERE (m.chat_id = $chat)";

  # verificando se a consulta pode se executada
  if ($resultado = $db->query($query)) {

    # recuperando as mensagens do id do chat
    while ($registro = $resultado->fetch_assoc()) {
      
      $conversa[] = array(

        'data'     => $registro['data'],
        'suporte'  => $registro['suporte'],
        'mensagem' => $registro['mensagem']

      );

    }

    return $conversa;

  }

}