<?php

/**
 * responsável por criar as linhas da tabela dinâmica de clientes
 * @param - string com o cnpj ou razão social do cliente desejado
 */
function criaLinhasParaTabelaDinamicaDeClientes($pesquisa)
{
  require '../../../init.php';
  require DIRETORIO_FUNCTIONS . '/hours/consulta_clientes.php';

  $db     = abre_conexao();
  $tabela = '';

  # verificando se está sendo pesquisado um cnpj ou uma razão social ($tipo = true -> cnpj ou $tipo = false -> razão social)
  $tipo = is_numeric($pesquisa);

  # chamando função que consulta os atendimentos do chat e retorna as linhas da tabela dinâmica de clientes para o formulário de novo ticket
  $tabela = consultaDadosCadastraisDosClientes($pesquisa, $tipo, $tabela, $db);

  # ecoando tabela para o navegador
  echo $tabela;
}
