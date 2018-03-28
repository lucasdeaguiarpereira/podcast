<?php 

/**
 * atualiza o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da conta do usuário
 */
function atualizaRamalDoUsuario($db, $usuario)
{  
  $query =
    "UPDATE av_usuarios_login
      SET ramal = {$usuario['ramal']}
    WHERE (id = {$usuario['id']});";
  
  # verificando se a consulta pode ser executada
  if ($db->query($query)) {

    $resultado = true;

  }

  return $resultado;

}