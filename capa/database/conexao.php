<?php

mysqli_report(MYSQLI_REPORT_STRICT);

/**
 * abre uma conexão com a base de dados MYSQL
 */
function abre_conexao()
{
  try {

    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    mysqli_set_charset($conexao, 'utf8');

    return $conexao;

  } catch(Exception $e) {

      echo $e->getMessage();

      return null;

  }
}

/**
 * fecha uma conexão com a base de dados MYSQL
 * @param - uma conexão aberta
 */
function fecha_conexao($conexao)
{
  try {

    mysqli_close($conexao);

  } catch (Exception $e) {

      echo $e->getMessage();

  }
}
