<?php

/**
 * define um array modelo com os códigos dos departamentos da Avanço
 */
function defineArrayDeDepartamentos()
{
  $departamentos = array(
    # departamento auge + integral + parceiros
    'geral' => '
      dep_id = 3 OR
      dep_id = 4 OR
      dep_id = 6 OR
      dep_id = 7 OR
      dep_id = 9 OR
      dep_id = 10
    ',

    # departamento auge
    'auge' => '
      dep_id = 4 OR
      dep_id = 7 OR
      dep_id = 10
    ',

    # departamento integral
    'integral' => '
      dep_id = 3 OR
      dep_id = 9
    ',

    # departamento novo erp
    'novo_erp' => '
      dep_id = 11
    ',

    # departamento parceiros
    'parceiros' => '
      dep_id = 6
    ',

    # departamento tecnologia
    'tecnologia' => '
      dep_id = 2
    ',
  );

  return $departamentos;
}
