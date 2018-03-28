<?php

/**
 * retorna a demanda total de chamados de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 * @param - variável com o cnpj de um cliente específico
 */
function retornaDemandaTotalCnpj($conexao, $datas, $departamento, $cnpj)
{
  $sql =
  "SELECT
  	COUNT(id) AS demanda_total
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
    AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%')";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  return $valor[0];
}

/**
 * retorna a quantidade de chamados atendidos de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 * @param - variável com o cnpj de um cliente específico
 */
function retornaChamadosAtendidosCnpj($conexao, $datas, $departamento, $cnpj)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendidos
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (chat_duration > 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
    AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%')";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * retorna a quantidade de chamados perdidos de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 * @param - variável com o cnpj de um cliente específico
 */
function retornaChamadosPerdidosCnpj($conexao, $datas, $departamento, $cnpj)
{
  $sql =
  "SELECT
  	COUNT(id) AS perdidos
  FROM lh_chat
  WHERE (status = 2)
  	AND ({$departamento})
  	AND (chat_duration = 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
    AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%')";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * calcula o percentual de taxa de perda dos chamados de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 * @param - variável com o cnpj de um cliente específico
 */
function calculaTaxaDePerdaCnpj($conexao, $datas, $departamento, $cnpj)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id) AS perdidos
  		FROM lh_chat
  		WHERE (status = 2)
  			AND ({$departamento})
  			AND (chat_duration = 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))

  		/

  		(SELECT
  			COUNT(id) AS demanda_total
  		FROM lh_chat
  		WHERE (status = 2)
  			AND ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))), 1) AS taxa_de_perda";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}
