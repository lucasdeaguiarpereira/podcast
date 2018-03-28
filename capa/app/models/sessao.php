<?php

/*
 * cria um array modelo para receber as mensagens de erro ou sucesso
 */
function criaModeloDeSessaoParaMensagens()
{
  $_SESSION['mensagens'] = array(

    'mensagem' => '',
    'tipo' => '',
    'exibe' => false

  );

}

/*
 * cria um array modelo para receber os dados do módulo avancoins
 */
function criaModeloDeSessaoParaAvancoins()
{
  # verificando se existem dados na sessão do módulo avnacoins
  if (isset($_SESSION['avancoins'])) {

    unset($_SESSION['avancoins']);

  }

  $_SESSION['avancoins'] = array(
    'form' => array(
      'colaborador'  => $_POST['form']['colaborador'],
      'tipo'         => $_POST['form']['tipo'],
      'data_inicial' => $_POST['form']['data_inicial'],
      'data_final'   => $_POST['form']['data_final']
    ),
    'extrato' => array(
      'diaria'     => '',
      'mensal'     => '',
      'esporadica' => ''
    )
  );

}

/**
 * grava os dados do módulo avancoins na sessão
 * @param - string com uma tabela html
 * @param - string com o tipo de tabela html (pode ser diária, mensal, esporádica ou totais)
 */
function gravaModeloDeSessaoAvancoins($tabela, $tipo)
{
  # separando extratos por tipo
  switch ($tipo) {

    case 'compra':
      $_SESSION['avancoins']['extrato']['compra']     = $tabela;
        break;

    case 'diaria':
      $_SESSION['avancoins']['extrato']['diaria']     = $tabela;
        break;

    case 'mensal':
      $_SESSION['avancoins']['extrato']['mensal']     = $tabela;
        break;

    case 'esporadica':
      $_SESSION['avancoins']['extrato']['esporadica'] = $tabela;
        break;

    case 'totais':
      $_SESSION['avancoins']['extrato']['totais']     = $tabela;
        break;

  }

}
