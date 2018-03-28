<?php

/**
 * altera o status do usuário do chat para offline
 * @param - objeto com uma conexão aberta
 * @param - string com o id do usuário do chat
 * @param - array com os dados do painel de colaboradores logados
 */
function alteraStatusParaOffline($db, $id)
{
  $query = "UPDATE lh_userdep SET hide_online = 1 WHERE (user_id = $id);";
  
  $db->query($query);

  $query = "UPDATE lh_users SET hide_online = 1 WHERE (id = $id);";

  $db->query($query);

}

/**
 * altera o status do usuário do chat para online
 * @param - objeto com uma conexão aberta
 * @param - string com o id do usuário do chat
 * @param - array com os dados do painel de colaboradores logados
 */
function alteraStatusParaOnline($db, $id)
{
  $query = "UPDATE lh_userdep SET hide_online = 0 WHERE (user_id = $id);";
  
  $db->query($query);

  $query = "UPDATE lh_users SET hide_online = 0 WHERE (id = $id);";

  $db->query($query);

}