<?php

require '../../modules/hours/pesquisa.php';

# verificando se foi enviado requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # recuperando dados digitados na barra de pesquisa do formulário de novo ticket
  $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : NULL;

  # verificando se algum dado foi digitado
  if (! empty($pesquisa)) {

    # chamando função responsável por criar as linhas da tabela dinâmica de clientes
    criaLinhasParaTabelaDinamicaDeClientes($pesquisa);

  }

}
