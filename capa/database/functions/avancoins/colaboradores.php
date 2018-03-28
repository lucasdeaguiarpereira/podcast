<?php

/**
 * consulta e retorna um array com id, nome e sobrenome dos colaboradores existentes no chat
 * @param - string vazia que receberá os dados
 * @param - objeto com uma conexão aberta
 */
function consultaColaboradores($options, $db)
{
  # recuperando nível de acesso do usuário
  $nivel = $_SESSION['usuario']['nivel'];

  # verificando se o usuário é um colaborador
  if ($nivel == 1) {

    # recuperando id do chat do colaborador
    $id = $_SESSION['usuario']['id'];

    # criando query que retorna os dados do chat do colaborador
    $query =
      "SELECT
      	id,
      	name AS nome,
      	surname AS sobrenome
      FROM lh_users
      WHERE id = $id";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        # montando option do select com os dados do colaborador
        while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

          $options .= "<option value='{$registro['id']}'>{$registro['nome']} {$registro['sobrenome']}</option>";

        }

      } else {

        #erro durante a execução da consulta
        echo 'erro';

      }

    } else {

      # criando query que retorna os dados do chat de todos os colaboradores
      $query =
        "SELECT
        	id,
        	name AS nome,
        	surname AS sobrenome
        FROM lh_users
        WHERE (disabled = 0)
        	AND NOT (id = 1 OR id = 2 OR id = 3 OR id = 4 OR id = 5 OR id = 6 OR id = 42 OR id = 43 OR id = 44 OR id = 61)
        ORDER BY nome";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $options .= '<option value="0" selected>Selecione um Colaborador</option>';

        # montando options do select com os dados de todos os colaboradores
        while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

          $options .= "<option value='{$registro['id']}'>{$registro['nome']} {$registro['sobrenome']}</option>";

        }

      } else {

        #erro durante a execução da consulta
        echo 'erro';

      }

    }

  $db->close();

  return $options;

}

/**
 * consulta e retorna nome colaborador
 * @param - objeto com uma conexão aberta
 * @param - string com o id do colaborador
 */
function consultaNomeDoColaborador($db, $id)
{
  $query =
    "SELECT
      name AS nome
    FROM lh_users
    WHERE id = $id";

  if ($resultado = $db->query($query)) {

    $nome = $resultado->fetch_row();
    $nome = $nome[0];

  }

  return $nome;

}

/**
 * consulta e retorna sobrenome colaborador
 * @param - objeto com uma conexão aberta
 * @param - string com o id do colaborador
 */
function consultaSobrenomeDoColaborador($db, $id)
{
  $query =
    "SELECT
      surname AS sobrenome
    FROM lh_users
    WHERE id = $id";

  if ($resultado = $db->query($query)) {

    $sobrenome = $resultado->fetch_row();
    $sobrenome = $sobrenome[0];

  }

  return $sobrenome;

}
