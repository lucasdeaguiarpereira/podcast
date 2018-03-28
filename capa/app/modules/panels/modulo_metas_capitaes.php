<?php 

/**
 * responsável por buscar os dados para o painel de meta capitães
 * @param - string com o código do time
 * @param - string com a data inicial
 * @param - string com a fata final
 */
function buscaDadosDoPainelMetaCapitaes($time, $data1, $data2)
{
  
  require DIRETORIO_MODELS    . 'panels/modelo_metas_capitaes.php';
  require DIRETORIO_FUNCTIONS . 'panels/consultas_metas_capitaes.php';
  require DIRETORIO_HELPERS   . 'painels/calcula_resultados.php';

  # chamando função que retorna o modelo de dados do painel de metas capitães
  $dados = criaModeloDoPainelMetasCapitaes();

  $db = abre_conexao();
  $colaboradores = '';

  # chamando função que consulta o id do chat dos colaboradores de um ou todos os times
  $ids = consultaIdDosColaboradoresDoTime($db, $time);

  # montando parte da consulta de resultados 
  foreach ($ids as $id) {
    
    foreach ($id as $chave => $valor) {
      
      # montando string com os ids do chat dos colaboradores
      $colaboradores .= 'u.id = ' . $valor . ' OR ';

    }

  }

  # retirando último espaço e OR da string
  $colaboradores = substr($colaboradores, 0, -4);

  # chamando função que consulta os resultados dos colaboradores
  $dados = consultaResultadosDosColaboradores($db, $colaboradores, $data1, $data2, $dados);

  # verificando se existe resultados do time os templários no array
  if (isset($dados['2']))

    # chamando função que calcula os resultados totais
    $dados = calculaResultadosTotais('2', count($dados['2']), $dados);

  # verificando se existe resultados do time divergente no array
  if (isset($dados['3']))

    # chamando função que calcula os resultados totais
    $dados = calculaResultadosTotais('3', count($dados['3']), $dados);

  # verificando se existe resultados do time gulliver no array
  if (isset($dados['4']))

    # chamando função que calcula os resultados totais
    $dados = calculaResultadosTotais('4', count($dados['4']), $dados);

  # verificando se existe resultados do time avalanche no array
  if (isset($dados['5']))

    # chamando função que calcula os resultados totais
    $dados = calculaResultadosTotais('5', count($dados['5']), $dados);
  
  # chamando função que altera o formato da data para dd/mm/aaaa
  $data1 = formataDataParaExibir($data1);
  $data2 = formataDataParaExibir($data2);

  # gravando dados na sessão
  $_SESSION['painel']['metas_capitaes']['dados'] = $dados;
  $_SESSION['painel']['metas_capitaes']['data1'] = $data1;
  $_SESSION['painel']['metas_capitaes']['data2'] = $data2;

  fecha_conexao($db);

  unset($dados, $data1, $data2, $time, $colaboradores);
  
  # redirecionando usuário para a página do painel de meta capitães
  header('Location: ' . BASE_URL . 'public/views/panels/metas_capitaes.php');

  exit;

}