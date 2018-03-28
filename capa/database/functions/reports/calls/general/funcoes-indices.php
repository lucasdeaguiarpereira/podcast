<?php

/**
 * calcula o percentual do índice avancino de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (e.avaliacao_colaborador = 'Ótimo' OR e.avaliacao_colaborador = 'Bom')
  			AND ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS indice_avancino";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * calcula o percentual do índice de satisfação geral do atendimento de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function calculaPercentualDoIndiceGeral($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (e.avaliacao_atendimento = 'Ótimo' OR e.avaliacao_atendimento = 'Bom')
  			AND ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS indice_geral";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}
