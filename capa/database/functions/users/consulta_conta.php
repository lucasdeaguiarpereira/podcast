<?php 

/**
 * consulta o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da conta do usuário
 */
function retornaRamalDoUsuario($db, $usuario)
{  
  $query = "SELECT ramal FROM av_usuarios_login WHERE (id = {$usuario['id']});";
  
  $ramal = null;
  
  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $ramal = $resultado->fetch_row();
    $ramal = $ramal[0];

  }

  return $ramal;

}

/**
 * retorna todos os ramais dos usuários
 * @param - objeto com uma conexão aberta 
 */
function retornaTodosOsRamaisDosUsuarios($db)
{
  $query = 
    "SELECT 
      id,
      nome,
      sobrenome,
      email,
      ramal
    FROM av_usuarios_login
    ORDER BY nome;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arr = array('suporte' => array(), 'comercial' => array(), 'rh' => array());

    # recuperando dados da tabela de usuários do capa
    while ($registro = $resultado->fetch_assoc()) {

      switch ($registro['id']) {

        case '1':
        case '4':

          $arr['comercial'][] = array(
            
            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']
    
          );

          break;
        
        case '3':

          $arr['rh'][] = array(

            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']
    
          );

          break;

        case '2':
        case '5':
        case '6':
        case '7':
        case '9':
        case '10':
        case '11':
        case '13':
        case '14':
        case '15':
        case '16':
        case '17':
        case '18':
        case '19':
        case '21':
        case '22':
        case '23':
        case '24':
        case '25':
        case '26':
        case '27':
        case '28':
        case '29':
        case '30':

          $arr['suporte'][] = array(

            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']
    
          );

          break;

      }      

    }

  }

  return $arr;

}