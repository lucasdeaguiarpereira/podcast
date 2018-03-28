<?php

require DIRETORIO_HELPERS . 'datas.php';

/**
 * soma os valores das ações registradas nas tabelas de logs
 * @param - array com as ações registradas nas tabelas de logs
 */
function somaValoresDasAcoes($acoes)
{
  $soma = 0;

  settype($acoes['valor'], 'integer');

  # somando todos os valores do array
  foreach ($acoes as $acao) {

    $soma += $acao['valor'];

  }

  return $soma;

}

/**
 * gera um extrato com as compras na loja detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeComprasDetalhado($db, $form)
{
  $query =
    "SELECT
      ahc.data_compra,
      ahc.horario_compra,
      ap.descricao,
      ap.valor
    FROM av_avancoins_historico_compras AS ahc
    INNER JOIN av_avancoins_produtos AS ap
      ON ap.id = ahc.id_produto
    WHERE (ahc.id_colaborador = {$form['colaborador']})
      AND (ahc.data_compra BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
    ORDER BY ahc.data_compra DESC, ahc.horario_compra DESC;";

  if ($resultado = $db->query($query)) {

    $compras = array();

    while ($registro = $resultado->fetch_assoc()) {

      $compras[] = array(

        'data_compra'    => formataDataParaExibir($registro['data_compra']),
        'horario_compra' => $registro['horario_compra'],        
        'descricao'      => $registro['descricao'],
        'valor'          => $registro['valor']

      );

    }

  }

  return $compras;

}

/**
 * gera um extrato com as ações diárias detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesDiariasDetalhado($db, $form)
{
  $query =
    "SELECT
      DATE_FORMAT(adl.data_acao, '%Y-%m-%d') AS data_acao,
      adl.horario_acao,
      adl.id_chat,
      ad.descricao,
      ad.valor
    FROM av_avancoins_acoes_diarias_logs AS adl
    INNER JOIN av_avancoins_acoes_diarias AS ad
      ON ad.id = adl.id_acao_diaria
    WHERE (adl.id_colaborador = {$form['colaborador']})
      AND (adl.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
    ORDER BY adl.data_acao DESC, adl.horario_acao DESC;";

  if ($resultado = $db->query($query)) {

    $acoesDiarias = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesDiarias[] = array(

        'data_acao'    => formataDataParaExibir($registro['data_acao']),
        'horario_acao' => $registro['horario_acao'],
        'id_chat'      => $registro['id_chat'],
        'descricao'    => $registro['descricao'],
        'valor'        => $registro['valor']

      );

    }

  }

  return $acoesDiarias;

}

/**
 * gera um extrato com as ações mensais detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesMensaisDetalhado($db, $form)
{
  $query =
    "SELECT
      DATE_FORMAT(aml.data_acao, '%Y-%m-%d') AS data_acao,
      aml.horario_acao,
      am.descricao,
      am.valor
    FROM av_avancoins_acoes_mensais_logs AS aml
    INNER JOIN av_avancoins_acoes_mensais AS am
      ON am.id = aml.id_acao_mensal
    WHERE (aml.id_colaborador = {$form['colaborador']})
      AND (aml.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
    ORDER BY aml.data_acao DESC;";

  if ($resultado = $db->query($query)) {

    $acoesMensais = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesMensais[] = array(

        'data_acao'    => formataDataParaExibir($registro['data_acao']),
        'horario_acao' => $registro['horario_acao'],
        'descricao'    => $registro['descricao'],
        'valor'        => $registro['valor']

      );

    }

  }

  return $acoesMensais;

}

/**
 * gera um extrato com as ações esporádicas detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesEsporadicasDetalhado($db, $form)
{
  $query =
    "SELECT
      t.data_acao,
      t.horario_acao,
      t.supervisor,
      t.data_registro,
      t.observacao,
      t.descricao,
      CASE 
        WHEN (t.id = 3) 
          THEN ((t.horario_acao_minutos / 30) * t.valor)
        ELSE (t.valor)
      END AS valor
    FROM
      (SELECT
        DATE_FORMAT(ael.data_acao, '%Y-%m-%d') AS data_acao,
        ae.id,
        ael.horario_acao,
        CONCAT(lu.name, ' ', lu.surname) AS supervisor,
        DATE_FORMAT(ael.data_registro, '%Y-%m-%d') AS data_registro,
        ael.observacao,
        ae.descricao,	
        TIME_TO_SEC(ael.horario_acao) / 60 AS horario_acao_minutos,
        ae.valor
      FROM av_avancoins_acoes_esporadicas_logs AS ael
      INNER JOIN av_avancoins_acoes_esporadicas AS ae
        ON ae.id = ael.id_acao_esporadica
      INNER JOIN lh_users AS lu
        ON lu.id = ael.id_supervisor
      WHERE (ael.id_colaborador = {$form['colaborador']})  		
        AND (ael.data_registro BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')) AS t
      ORDER BY t.data_registro DESC;";

  if ($resultado = $db->query($query)) {

    $acoesEsporadicas = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesEsporadicas[] = array(

        'data_acao'     => formataDataParaExibir($registro['data_acao']),
        'horario_acao'  => $registro['horario_acao'],
        'supervisor'    => $registro['supervisor'],
        'data_registro' => formataDataParaExibir($registro['data_registro']),
        'observacao'    => $registro['observacao'],
        'descricao'     => $registro['descricao'],
        'valor'         => (int)$registro['valor']

      );

    }

  }

  return $acoesEsporadicas;

}
