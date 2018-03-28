<?php

/*
 * consulta e retorna os dados do painel de colaboradores logados
 */
function retornaDadosParaPainelDeColaboradoresLogados()
{
  require DIRETORIO_MODELS    . 'panels/modelo_colaboradores_logados.php';
  require DIRETORIO_FUNCTIONS . 'panels/consultas_colaboradores_logados.php';

  $painel = criaModeloDeColaboradoresLogados();
  $paineis = array('suporte' => array(), 'externo' => array());
  $db = abre_conexao();

  # chamando função que consulta id, departamento, nome e sobrenome dos colaboradores
  $painel = consultaDadosDosColaboradores($painel, $db);

  # separando colaboradores do suporte e do externo
  for ($i = 0; $i < count($painel); $i++) {

    if
      ($painel[$i]['id'] == 36 OR
       $painel[$i]['id'] == 37 OR
       $painel[$i]['id'] == 38 OR
       $painel[$i]['id'] == 39 OR
       $painel[$i]['id'] == 40 OR
       $painel[$i]['id'] == 41) {

         $paineis['externo'][] = $painel[$i];

       } else {

         $paineis['suporte'][] = $painel[$i];

       }
  }

  unset($painel);

  fecha_conexao($db);

  return $paineis;
}

/**
 * consulta e retorna os colaboradores integrantes do time do capitão qu está logado no portal avanção
 * @param - string com o id do chat do usuário logado no portal avanção
 * @param - string com o nível de permissão de acesso do usuário logado no portal avanção
 * @param - array com o modelo de dados de opções
 */
function retornaIdDosColaboradoresDoTime($id, $nivel, $dados)
{
  $dados = criaModeloDeDadosDeOpcoes();
  $db    = abre_conexao();

  # verificando se um capitão está logado no portal avanção
  if ($nivel == 1) {

    # verificando qual é o id do time do capitão que está logado
    switch ($id) {

      case '14':
  
        $dados['time']    = 3;
        $dados['exibir_opcoes'] = true; # permitindo exibição das opções offline/online dos colaboradores do time divergente
  
          break;
  
      case '17':
  
        $dados['time']    = 2;
        $dados['exibir_opcoes'] = true; # permitindo exibição das opções offline/online dos colaboradores do time os templários
  
          break;
  
      case '20':
  
        $dados['time']    = 5;
        $dados['exibir_opcoes'] = true; # permitindo exibição das opções offline/online dos colaboradores do time avalanche
          break;
  
      case '25':
  
        $dados['time']    = 4;
        $dados['exibir_opcoes'] = true; # permitindo exibição das opções offline/online dos colaboradores do time gulliver
          
          break;

    }

    # verificando se o usuário logado no portal avanção é capitão de algum time
    if ($dados['time'] != 0) {
      
      # chamando função que retorna os ids do chat dos integrantes do time do capitão logado no portal avanção
      $dados = consultaIdDosColaboradoresDoTime($db, $dados);

    }

  } elseif ($nivel == 2) { # verificando se o usuário logado no portal avanção é um supervisor
    
    # chamando função que retorna todos os ids do chat dos colaboradores do suporte
    $dados = consultaIdDeTodosOsColaboradores($db, $dados);

    # permitindo exibição das opções offline/online de todos os colaboradores
    $dados['exibir_opcoes'] = true;

  }

  return $dados;

}

/**
 * responsável por alterar o status de um usuário do chat para offline ou online
 * @param - string com o id do chat
 * @param - string com o status (0 - online / 1 - offline)
 */
function alteraStatus($id, $status)
{
  require DIRETORIO_FUNCTIONS . 'panels/atualiza_colaboradores_logados.php';

  $db = abre_conexao();

  # verificando se foi solicitado a alteração para offline/online
  if ($status) {

    # chamando função que altera o status do usuário do chat para offline
    alteraStatusParaOffline($db, $id);

  } else {

    # chamando função que alterar o status do usuário do chat para online
    alteraStatusParaOnline($db, $id);

  }

  fecha_conexao($db);

  # redirecionando usuário para o painel de logados
  header('Location: ' . BASE_URL . 'public/views/panels/colaboradores_logados.php');

  exit;

}