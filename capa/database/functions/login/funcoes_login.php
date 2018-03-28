<?php

/**
 * consulta se o usuário possui id cadastrado no chat
 * @param - array com com os dados do usuário
 * @param - objeto com uma conexão aberta
 */
function consultaIdDoUsuarioNoChat($usuario, $db)
{
  $query =
    "SELECT
    	id
    FROM lh_users
    WHERE username = '{$usuario['usuario']}';";

  if ($resultado = $db->query($query)) {

    if ($resultado->num_rows > 0) {

      $registro = $resultado->fetch_array();

      $usuario['id'] = $registro['id'];

    }

  }

  return $usuario;
}

/**
 * verifica na base de dados se email e senha repassados estão corretos
 * @param - array com email, senha e senha criptografada
 * @param - array com o modelo de dados de usuário
 * @param - uma conexão aberta
 */
function consultaDadosDoUsuario($login, $usuario, $db)
{
  require DIRETORIO_MODELS . 'sessao.php';

  criaModeloDeSessaoParaMensagens();

  $query =
    "SELECT
      id,
      nome,
      sobrenome,
      usuario,
      email,
      nivel
    FROM av_usuarios_login
    WHERE (email = '{$login['email']}')
      AND (senha = '{$login['senha_hash']}')
      AND (ativo = true);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # verificando se existe um usuário com email e senha criptografada enviados pelo formulário de login
    if ($resultado->num_rows > 0) {

      # recuperando dados do usuário
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $usuario['id_capa']   = $registro['id'];
        $usuario['nome']      = $registro['nome'];
        $usuario['sobrenome'] = $registro['sobrenome'];
        $usuario['usuario']   = $registro['usuario'];
        $usuario['email']     = $registro['email'];
        $usuario['nivel']     = $registro['nivel'];        

      }

      # chamando função que consulta se o usuário possui id cadastrado no chat
      $usuario = consultaIdDoUsuarioNoChat($usuario, $db);

      # criando variáveis de sessão com os dados do usuário
      $_SESSION['usuario']['id']        = $usuario['id'];
      $_SESSION['usuario']['id_capa']   = $usuario['id_capa'];
      $_SESSION['usuario']['nome']      = $usuario['nome'];
      $_SESSION['usuario']['sobrenome'] = $usuario['sobrenome'];
      $_SESSION['usuario']['email']     = $usuario['email'];
      $_SESSION['usuario']['nivel']     = $usuario['nivel'];      
      $_SESSION['usuario']['usuario']   = $usuario['usuario'];
      $_SESSION['usuario']['logado']    = true;

      return true;

    } else {

      # criando variáveis de sessão com as mensagens
      $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> email ou senha não confere.</p>';
      $_SESSION['mensagens']['tipo']     = 'danger';
      $_SESSION['mensagens']['exibe']    = true;

      return false;

    }

  }

  fecha_conexao($db);

}
