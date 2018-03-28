<?php 

/**
 * responsável por buscar os atendimentos de acordo com os filtros enviados
 * @param - array com os dados do formulário
 */
function buscaAtendimentos($dados)
{
  require DIRETORIO_FUNCTIONS . 'reports/calls/consulta_atendimentos.php';

  $atendimentos = array();
  $db = abre_conexao();
  
  # chamando função que consulta os atendimentos
  $atendimentos = consultaAtendimentos($db, $dados);

  $contador = count($atendimentos);

  $_SESSION['relatorios']['mensagem'] = false;

  # verificando se o número de registro retornados é zero
  if ($contador == 0) {

    $_SESSION['relatorios']['mensagem'] = true;

  }

  # repassando os atendimentos para a sessão
  $_SESSION['relatorios']['consulta_atendimentos'] = $atendimentos;

  unset($dados);

  fecha_conexao($db);

  # redirecionando usuário
  header('Location: '. BASE_URL . 'public/views/reports/calls/consulta_atendimentos.php');

}