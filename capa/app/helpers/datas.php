<?php

/**
 * formata uma data única para aaaa-mm-dd caso ela esteja no formato dd/mm/aaaa
 * @param - array com a data inicial e a data final
 */
function formataDataUnicaParaMysql($data)
{
  $a = '';

  # quebrando data onde possui /
  $a = explode('/', $data);
  
  # formatando data para aaaa-mm-dd
  $data = "{$a[2]}-{$a[1]}-{$a[0]}";

  return $data;

}

/**
 * formata a data para aaaa-mm-dd caso ela esteja no formato dd/mm/aaaa
 * @param - array com a data inicial e a data final
 */
function formataDataParaMysql($datas)
{
  $arr = array();

  # quebrando data onde possui /
  $arr['inicial'] = explode('/', $datas['inicial']);
  $arr['final']   = explode('/', $datas['final']);

  # verificando se a data foi quebrada, caso contrário a data não será formatada
  if (count($arr['inicial']) == 1 && count($arr['final']) == 1) {

    return $datas;

  } else {

    # formatando data para aaaa-mm-dd
    $datas['inicial'] = "{$arr['inicial'][2]}-{$arr['inicial'][1]}-{$arr['inicial'][0]}";
    $datas['final']   = "{$arr['final'][2]}-{$arr['final'][1]}-{$arr['final'][0]}";

    return $datas;

  }
}

/**
 * formata data para dd-mm-aaaa
 * @param - array com apenas uma data, seja inicial ou final
 */
function formataDataParaExibir($datas)
{
  $arr = array();

  # quebrando data onde possui -
  $arr = explode('-', $datas);

  # formatando data para dd-mm-aaaa
  $datas = "{$arr[2]}/{$arr[1]}/{$arr[0]}";

  return $datas;

}
