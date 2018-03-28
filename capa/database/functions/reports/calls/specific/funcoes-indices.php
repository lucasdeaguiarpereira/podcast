<?php

/**
 * calcula o percentual do índice avancino de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 * @param - variável com o cnpj de um cliente específico
 */
function calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento, $cnpj)
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
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))), 1) AS indice_avancino";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}

/**
 * calcula o percentual do índice de satisfação geral do atendimento de um cliente específico em um departamento específico durante um período ou uma data especifíca
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com um departamento especifíco
 * @param - variável com cnpj de um cliente específico
 */
function calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento, $cnpj)
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
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE ({$departamento})
  			AND (DATE_FORMAT(data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')
        AND (SUBSTRING_INDEX(SUBSTR(additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',additional_data)+ 29)),'\"',1) LIKE '%$cnpj%'))), 1) AS indice_geral";

    $resultado = mysqli_query($conexao, $sql);

    $valor = mysqli_fetch_row($resultado);

    return $valor[0];
}
