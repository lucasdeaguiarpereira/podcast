<?php 

# verificando se houve requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';
  require DIRETORIO_MODULES . 'reports/calls/modulo_atendimentos.php';

  # array modelo que receberá os dados do fomulário
  $dados = array(

    'periodo'     => array(

      'data1' => '',
      'data2' => ''

    ),
    'tipo'        => '',
    'filtro'      => '',
    'cnpj'        => '',
    'contrato'    => '',
    'colaborador' => '0'

  );

  # recuperando dados enviados pelo formulário
  $dados['periodo']['data1'] = isset($_POST['form']['data-1'])         ? $_POST['form']['data-1']         : '';  
  $dados['periodo']['data2'] = isset($_POST['form']['data-2'])         ? $_POST['form']['data-2']         : '';
  $dados['tipo']             = isset($_POST['form']['tipo'])           ? $_POST['form']['tipo']           : '';
  $dados['filtro']           = isset($_POST['form']['filtro'])         ? $_POST['form']['filtro']         : '';
  $dados['cnpj']             = isset($_POST['form']['cnpj'])           ? $_POST['form']['cnpj']           : '';
  $dados['contrato']         = isset($_POST['form']['conta-contrato']) ? $_POST['form']['conta-contrato'] : '';
  $dados['colaborador']      = isset($_POST['form']['colaborador'])    ? $_POST['form']['colaborador']    : '';

  # chamando função que busca os atendimentos de acordo com os filtros do formulário
  buscaAtendimentos($dados);


}