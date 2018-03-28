<?php

/**
 * gera um extrato com as compras na loja simplificado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeComprasSimplificado($db, $form)
{
  $query =
    "SELECT
      SUM(ap.valor)
    FROM av_avancoins_historico_compras AS ahc
    INNER JOIN av_avancoins_produtos AS ap
      ON ap.id = ahc.id_produto
    WHERE (ahc.id_colaborador = {$form['colaborador']})
      AND (ahc.data_compra BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}');";
  
  if ($resultado = $db->query($query)) {

    $valor = $resultado->fetch_row();

    $compras = $valor[0];

    settype($compras, 'integer');

  }

  return $compras;

}

/**
 * gera um extrato com as ações diárias simplificado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesDiariasSimplificado($db, $form)
{
  $query =
    "SELECT
    	SUM(ad.valor)
    FROM av_avancoins_acoes_diarias_logs AS adl
    INNER JOIN av_avancoins_acoes_diarias AS ad
    	ON ad.id = adl.id_acao_diaria
    WHERE (adl.id_colaborador = {$form['colaborador']})
    	AND (adl.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}');";

  if ($resultado = $db->query($query)) {

    $valor = $resultado->fetch_row();

    $acoesDiarias = $valor[0];

    settype($acoesDiarias, 'integer');

  }

  return $acoesDiarias;

}

/**
 * gera um extrato com as ações mensais simplificado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesMensaisSimplificado($db, $form)
{
  $query =
    "SELECT
    	SUM(am.valor)
    FROM av_avancoins_acoes_mensais_logs AS aml
    INNER JOIN av_avancoins_acoes_mensais AS am
    	ON am.id = aml.id_acao_mensal
    WHERE (aml.id_colaborador = {$form['colaborador']})
    	AND (aml.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}');";

  if ($resultado = $db->query($query)) {

    $valor = $resultado->fetch_row();

    $acoesMensais = $valor[0];

    settype($acoesMensais, 'integer');

  }

  return $acoesMensais;

}

/**
 * gera um extrato com as ações esporádicas simplificado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesEsporadicasSimplificado($db, $form)
{
  $query =
    "SELECT
      SUM(a.valor)
    FROM
      (SELECT	
        CASE 
          WHEN (t.id = 3) 
            THEN ((t.horario_acao_minutos / 30) * t.valor)
          ELSE (t.valor)
        END AS valor	
      FROM
        (SELECT		
          ae.id,		
          TIME_TO_SEC(ael.horario_acao) / 60 AS horario_acao_minutos,
          ae.valor
        FROM av_avancoins_acoes_esporadicas_logs AS ael
        INNER JOIN av_avancoins_acoes_esporadicas AS ae
          ON ae.id = ael.id_acao_esporadica
        INNER JOIN lh_users AS lu
          ON lu.id = ael.id_supervisor
        WHERE (ael.id_colaborador = {$form['colaborador']})  		
          AND (ael.data_registro BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')) AS t) AS a;";

  if ($resultado = $db->query($query)) {

    $valor = $resultado->fetch_row();

    $acoesEsporadicas = $valor[0];

    settype($acoesEsporadicas, 'integer');

  }

  return $acoesEsporadicas;

}
