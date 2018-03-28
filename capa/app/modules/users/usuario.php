<?php 

/**
 * responsável por atualizar os dados do usuário 
 * @param - array com os dados do formulário de conta
 */
function atualizaContaDoUsuario($usuario)
{
  require DIRETORIO_FUNCTIONS . 'users/atualiza_conta.php';

  $db = abre_conexao();

  # chamando função que atualiza o ramal do usuário
  $resultado = atualizaRamalDoUsuario($db, $usuario);

  # verificando se a consulta foi executada com sucesso
  if ($resultado) {

    # gerando mensagem de sucesso
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Dados atualizados com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

  } else {

    # gerando mensagem de erro
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Os Dados não foram atualizados! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  fecha_conexao($db);

  # redirecionando usuário para página de conta
  header('Location: ' . BASE_URL . 'public/views/users/conta.php');

}

/**
 * responsável por consultar o ramal do usuário 
 * @param - array com os dados do formulário de conta
 */
function consultaRamalDoUsuario($usuario)
{
  require DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

  $db = abre_conexao();

  # chamando função que retorna o ramal do usuário
  $ramal = retornaRamalDoUsuario($db, $usuario);

  fecha_conexao($db);

  return $ramal;

}

/**
 * responsável por consultar e retornar todos os ramais dos usuários 
 * @param - array com os dados do formulário de conta
 */
function consultaRamaisDosUsuarios()
{
  require DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

  $db = abre_conexao();

  # chamando função que retorna todos os ramais dos usuários
  $ramais = retornaTodosOsRamaisDosUsuarios($db);

  fecha_conexao($db);

  return $ramais;
  
}