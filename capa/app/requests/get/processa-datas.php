<?php

require ABS_PATH . 'app/helpers/datas.php';
require ABS_PATH . 'app/modules/reports/calls/chamados.php';
require ABS_PATH . 'database/functions/reports/calls/funcoes-clientes.php';

# verificando se existe requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $datas = array();

  # verificando se foi informado as datas, caso contrário, será utilizado a data atual
  $datas['inicial'] = isset($_GET['datas']['inicial']) ? $_GET['datas']['inicial'] : date('Y-m-d');
  $datas['final']   = isset($_GET['datas']['final'])   ? $_GET['datas']['final']   : date('Y-m-d');

  # chamando função que verifica o formato da data enviada
  $datas = formataDataParaMysql($datas);

  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que busca os clientes e gera as opções para o HTML
  geraOpcoesClientes($conexao);

  # verificando se o relatório será de um cliente especifíco ou geral
  if (isset($_GET['cnpj']) && $_GET['cnpj'] != '0') {

    # chamando função que gera o relatório de chamados específico
    geraRelatorioEspecificoDeChamados($conexao, $datas, $_GET['cnpj']);

  } else {
    
    # chamando função que gera o relatório de chamados geral
    geraRelatorioGeralDeChamados($conexao, $datas);

  }
}
