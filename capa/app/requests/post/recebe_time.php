<?php

# verificando se foi enviado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # recuperando dados enviados pelo formulário
  $time  = isset($_POST['time'])   ? $_POST['time']   : null;
  $data1 = isset($_POST['data-1']) ? $_POST['data-1'] : null;
  $data2 = isset($_POST['data-2']) ? $_POST['data-2'] : null;

  # verificando se todos os dados foram enviados
  if (! empty($time) AND ! empty($data1) AND ! empty($data2)) {
    
    require '../../../init.php';    
    require DIRETORIO_HELPERS . 'datas.php';
    require DIRETORIO_MODULES . 'panels/modulo_metas_capitaes.php';

    # chamando função que altera o formato da data aaaa-mm-dd
    $data1 = formataDataUnicaParaMysql($data1);
    $data2 = formataDataUnicaParaMysql($data2);

    # chamando função responsável por buscar os dados para o painel de metas capitães
    buscaDadosDoPainelMetaCapitaes($time, $data1, $data2);

  }

}