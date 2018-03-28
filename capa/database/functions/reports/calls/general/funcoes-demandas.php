<?php

/**
 * retorna a quantidade de demanda total de chamados de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function retornaDemandaTotal($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	COUNT(id) AS demanda_total
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')";

  $resultado = mysqli_query($conexao, $sql);
  
  $valor = mysqli_fetch_row($resultado);

  return $valor[0];
}

/**
 * retorna a quantidade de chamados atendidos de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function retornaChamadosAtendidos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendidos
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (chat_duration > 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * retorna a quantidade de chamados perdidos de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function retornaChamadosPerdidos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	COUNT(id) AS perdidos
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (chat_duration = 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * calcula o percentual de taxa de perda dos chamados de um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 */
function calculaTaxaDePerda($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id) AS taxa_de_perdidos
  		FROM lh_chat
  		WHERE (status = 2)
  			AND ({$departamento})
  			AND (chat_duration = 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(id) AS demanda_total
  		FROM lh_chat
  		WHERE (status = 2)
  			AND ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS taxa_de_perda";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}
