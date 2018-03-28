<?php

/**
 * calcula os resultados totais de um ou vários times
 * @param - string com o código do time
 * @param - inteiro com o tamanho do array
 * @param - array modelo de dados do painel metas capitães 
 */
function calculaResultadosTotais($time, $contador, $dados)
{
  $totalPerdaProp  = 0.0;
  $totalFilaProp   = 0.0;  
  $totalDemandados = 0;
  $totalPerda      = 0.0;
  $totalFila       = 0.0;

  # percorrendo o array e calculando os totais
  for ($i = 0; $i < $contador; $i++) {

    # verificando se existe o índice demandados na posição percorrida
    if (isset($dados[$time][$i]['demandados']))

      # somando atendimentos demandados dos colaboradores do time
      $totalDemandados += $dados[$time][$i]['demandados'];

    # verificando se existe o índice percentual de perda proporcional na posição percorrida
    if (isset($dados[$time][$i]['perc_perda_prop']))

      # somando percentual de perda proporcional dos colaboradores do time
      $totalPerdaProp += $dados[$time][$i]['perc_perda_prop'];

    # verificando se existe o índice percentual de fila proporcional na posição percorrida
    if (isset($dados[$time][$i]['perc_fila_prop']))

      # somando percentual de fila proporcional dos colaboradores do time
      $totalFilaProp += $dados[$time][$i]['perc_fila_prop'];

    # verificando se existe o índice total do percentual de perda proporcional na posição percorrida
    if (isset($dados[$time][$i]['total_perda_prop']) AND $totalPerdaProp > 0)

      # repassando o total do percentual de perda proporcional para o array modelo de dados
      $dados[$time][$i]['total_perda_prop'] = $totalPerdaProp;

    # verificando se existe o índice total do percentual de fila proporcional na posição percorrida
    if (isset($dados[$time][$i]['total_fila_prop']) AND $totalFilaProp > 0)

      # repassando o total do percentual de fila proporcional para o array modelo de dados
      $dados[$time][$i]['total_fila_prop']  = $totalFilaProp;

    # verificando se existe o índice total de demandados na posição percorrida
    if (isset($dados[$time][$i]['total_demandados']) AND $totalDemandados > 0) {
      
      # repassando o total de atendimentos demandados para o array modelo de dados
      $dados[$time][$i]['total_demandados'] = $totalDemandados;

      # calculando os totais dos percentuais de perda e fila do time
      $totalPerda = round(($totalPerdaProp / $totalDemandados) * 100, 2);
      $totalFila  = round(($totalFilaProp  / $totalDemandados) * 100, 2);

    }

    # verificando se existe o índice total do percentual de perda na posição percorrida
    if (isset($dados[$time][$i]['total_perda']) AND $totalPerda > 0)

      # repassando o total do percentual de perda para o array modelo de dados
      $dados[$time][$i]['total_perda'] = $totalPerda;

    # verificando se existe o índice total do percentual de fila na posição percorrida
    if (isset($dados[$time][$i]['total_fila']) AND $totalFila > 0)

      # repassando o total do percentual de fila para o array modelo de dados
      $dados[$time][$i]['total_fila']  = $totalFila;

  }

  return $dados;

}