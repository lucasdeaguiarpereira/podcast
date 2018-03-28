<?php

/**
 * responsável por gravar uma nova atividade esporádica na tabela de ações esporádicas
 * @param - array com os dados do formulário de nova atividade
 */
function gravaNovaAtividadeEsporadica($form)
{
  require DIRETORIO_FUNCTIONS . 'avancoins/atividades.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que insere uma nova atividade na tabela de ações esporádicas
  $resultado = insereNovaAtividadeEsporadica($db, $form);

  # verificando se a consulta foi executada
  if ($resultado == true) {

    # gerando mensagem de sucesso
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> A atividade foi cadastrada com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

  } else {

    # gerando mensagem de erro
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A atividade não foi cadastrada! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  fecha_conexao($db);

  # redirecionando usuário para página de nova atividade
  header ('Location: ' . BASE_URL . '../capa/public/views/avancoins/nova_atividade.php');

}

/**
 * responsável por gerar o extrato avancoins (simples ou detalhado)
 * @param - array com os dados do formulário de nova atividade
 */
function geraExtratoAvancoins($form)
{
  require DIRETORIO_FUNCTIONS . 'avancoins/colaboradores.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/relatorio_simplificado.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/relatorio_detalhado.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/tabelas_relatorios.php';
  require DIRETORIO_MODELS    . 'sessao.php';

  $compras          = array();
  $acoesDiarias     = array();
  $acoesMensais     = array();
  $acoesEsporadicas = array();

  $valoresTotaisDasAcoes = array(

    'compras'           => 0,
    'acoes_diarias'     => 0,
    'acoes_mensais'     => 0,
    'acoes_esporadicas' => 0

  );

  $nivel = $_SESSION['usuario']['nivel'];

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # verificando se o usuário é um supervisor, caso seja, recuperando o nome e sobrenome do colaborador selecionado
  if ($nivel == 2) {

    # chamando funções que retoram nome e sobrenome do colaborador selecionado
    $nome      = consultaNomeDoColaborador($db, $_POST['form']['colaborador']);
    $sobrenome = consultaSobrenomeDoColaborador($db, $_POST['form']['colaborador']);

  }

  # chamando função que cria um array modelo para receber os dados do módulo avancoins
  criaModeloDeSessaoParaAvancoins();

  # verificando se o usuário solicitou um relatório simples ou detalhado (1 - Simples 2 - Detalhado)
  if ($form['tipo'] == 1) {

    # chamando funções que geram extratos das ações registradas nas tabelas de logs
    $valoresTotaisDasAcoes['compras']           = geraExtratoDeComprasSimplificado($db, $form);
    $valoresTotaisDasAcoes['acoes_diarias']     = geraExtratoDeAcoesDiariasSimplificado($db, $form);
    $valoresTotaisDasAcoes['acoes_mensais']     = geraExtratoDeAcoesMensaisSimplificado($db, $form);
    $valoresTotaisDasAcoes['acoes_esporadicas'] = geraExtratoDeAcoesEsporadicasSimplificado($db, $form);

    # chamando função que cria uma tabela de extrato com os totais das ações do colaborador
    $tabelaTotais = criaTabelaDeTotais($valoresTotaisDasAcoes, $nivel, $nome, $sobrenome);

    # chamando função que grava os dados do módulo avancoins na sessão
    gravaModeloDeSessaoAvancoins($tabelaTotais, 'totais');

  } elseif ($form['tipo'] == 2) {

    # chamando funções que geram extratos das ações registradas nas tabelas de logs
    $compras          = geraExtratoDeComprasDetalhado($db, $form);
    $acoesDiarias     = geraExtratoDeAcoesDiariasDetalhado($db, $form);
    $acoesMensais     = geraExtratoDeAcoesMensaisDetalhado($db, $form);
    $acoesEsporadicas = geraExtratoDeAcoesEsporadicasDetalhado($db, $form);

    # chamando função que soma os valores das ações registradas nas tabelas de logs
    $valoresTotaisDasAcoes['compras']           = somaValoresDasAcoes($compras);
    $valoresTotaisDasAcoes['acoes_diarias']     = somaValoresDasAcoes($acoesDiarias);
    $valoresTotaisDasAcoes['acoes_mensais']     = somaValoresDasAcoes($acoesMensais);
    $valoresTotaisDasAcoes['acoes_esporadicas'] = somaValoresDasAcoes($acoesEsporadicas);

    # chamando funções que criam tabelas de extratos com os totais das ações do colaborador
    $tabelaCompra     = criaTabelaDeCompras($compras, $valoresTotaisDasAcoes['compras']);
    $tabelaDiaria     = criaTabelaDeAcoesDiarias($acoesDiarias, $valoresTotaisDasAcoes['acoes_diarias']);
    $tabelaMensal     = criaTabelaDeAcoesMensais($acoesMensais, $valoresTotaisDasAcoes['acoes_mensais']);
    $tabelaEsporadica = criaTabelaDeAcoesEsporadicas($acoesEsporadicas, $valoresTotaisDasAcoes['acoes_esporadicas']);
    $tabelaTotais     = criaTabelaDeTotais($valoresTotaisDasAcoes, $nivel, $nome, $sobrenome);

    # chamando função que grava os dados do módulo avancoins na sessão
    gravaModeloDeSessaoAvancoins($tabelaCompra, 'compra');
    gravaModeloDeSessaoAvancoins($tabelaDiaria, 'diaria');
    gravaModeloDeSessaoAvancoins($tabelaMensal, 'mensal');
    gravaModeloDeSessaoAvancoins($tabelaEsporadica, 'esporadica');
    gravaModeloDeSessaoAvancoins($tabelaTotais, 'totais');

  }

  fecha_conexao($db);

  # redirecionando usuário para a página de extrato.
  header('Location: ' . BASE_URL . 'public/views/avancoins/extrato.php');

}
