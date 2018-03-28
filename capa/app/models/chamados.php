<?php

/**
 * define um array modelo com os índices de resultados do atendimento
 */
function defineArrayDeRelatorioDeChamados()
{
  $resultados = array(
    # departamento auge + integral + parceiros
    'geral' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # departamento auge
    'auge' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # departamento integral
    'integral' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # departamento parceiros
    'parceiros' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # departamento novo erp
    'novo_erp' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # departamento tecnologia
    'tecnologia' => array(
      'demandas' => array(
        'demanda_total' => '',
        'atendidos'     => '',
        'perdidos'      => '',
        'taxa_de_perda' => '',
        'tma'           => '',
        'tme'           => ''
      ),
      'triagem' => array(
        'ate_15_minutos'        => '',
        'entre_15_e_30_minutos' => '',
        'acima_de_30_minutos'   => ''
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => '',
        'entre_10_e_20_minutos' => '',
        'acima_de_20_minutos'   => ''
      ),
      'indices' => array(
        'avancino' => '',
        'geral'    => ''
      )
    ),

    # comentários
    'comentarios' => array(
      'satisfeitos' => '',
      'insatisfeitos' => ''
    )
  );

  return $resultados;
}
