<?php

/**
 * cria as opções (options) para o select da página de relatórios com o cnpj e razão social dos clientes
 * @param - uma conexão aberta
 */
function geraOpcoesClientes($conexao)
{
  session_start();

  $query =
    "SELECT
      T.cnpj,
      T.razao_social
    FROM
      (SELECT DISTINCT
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
        SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"empresaContato\"', c.additional_data)+ 32)),'\"',1) AS razao_social
      FROM lh_chat AS c
      WHERE (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '2017-06-01' AND CURRENT_DATE())) AS T
    WHERE (T.cnpj <> '')
      AND (LENGTH(T.cnpj) = 14)
        ORDER BY T.razao_social";

  $resultado = mysqli_query($conexao, $query);

  if ($resultado->num_rows > 0) {

    $options = '';

    while ($option = mysqli_fetch_array($resultado)) {

      $options .= '<option value="' . $option['cnpj'] . '"> ' . $option['razao_social'] . '</option>';

    }

    # criando sessão que guarda os clientes
    $_SESSION['clientes'] = $options;
  }
}
