
<?php

require ABS_PATH . 'app/models/departamentos.php';
require ABS_PATH . 'app/models/chamados.php';

require ABS_PATH . 'database/functions/reports/calls/general/funcoes-demandas.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-triagem.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-indices.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-comentarios.php';

require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-comentarios.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-demandas.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-triagem.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-indices.php';

/**
 * gera o relatório geral (de todos os Cnpjs) dos chamados de um período ou uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e data final
 */
function geraRelatorioGeralDeChamados($conexao, $datas)
{
  # criando array com o modelo de departamentos
  $departamento = defineArrayDeDepartamentos();

  # criando array com o modelo do relatório de chamados
  $arr = defineArrayDeRelatorioDeChamados();


  /*
   * departamento auge + integral + parceiros
   */

  # gerando resultados geral da departamento auge + integral + parceiros
  $arr['geral']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['geral']);
  $arr['geral']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['geral']);
  $arr['geral']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['geral']);
  $arr['geral']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['geral']);

  # gerando resultados de triagem da departamento auge + integral + parceiros
  $arr['geral']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['geral']);
  $arr['geral']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['geral']);
  $arr['geral']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['geral']);

  # gerando resultados de índices da departamento auge + integral + parceiros
  $arr['geral']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['geral']);
  $arr['geral']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['geral']);

  /*
   * departamento auge
   */

  # gerando resultados geral da departamento auge
  $arr['auge']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['auge']);
  $arr['auge']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['auge']);
  $arr['auge']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['auge']);
  $arr['auge']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['auge']);

  # gerando resultados de triagem da departamento auge
  $arr['auge']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['auge']);
  $arr['auge']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['auge']);
  $arr['auge']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['auge']);

  # gerando resultados de índices da departamento auge
  $arr['auge']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['auge']);
  $arr['auge']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['auge']);

  /*
   * departamento integral
   */

  # gerando resultados geral da departamento integral
  $arr['integral']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['integral']);
  $arr['integral']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['integral']);
  $arr['integral']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['integral']);
  $arr['integral']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['integral']);

  # gerando resultados de triagem da departamento integral
  $arr['integral']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['integral']);
  $arr['integral']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['integral']);
  $arr['integral']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['integral']);

  # gerando resultados de índices da departamento integral
  $arr['integral']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['integral']);
  $arr['integral']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['integral']);

  /*
   * departamento parceiros
   */

  # gerando resultados geral da departamento parceiros
  $arr['parceiros']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['parceiros']);
  $arr['parceiros']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['parceiros']);
  $arr['parceiros']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['parceiros']);
  $arr['parceiros']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['parceiros']);

  # gerando resultados de triagem da departamento parceiros
  $arr['parceiros']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['parceiros']);
  $arr['parceiros']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['parceiros']);
  $arr['parceiros']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['parceiros']);

  # gerando resultados de índices da departamento parceiros
  $arr['parceiros']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['parceiros']);
  $arr['parceiros']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['parceiros']);

  /*
   * departamento novo erp
   */

  # gerando resultados geral da departamento novo erp
  $arr['novo_erp']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['novo_erp']);
  $arr['novo_erp']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['novo_erp']);
  $arr['novo_erp']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['novo_erp']);
  $arr['novo_erp']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['novo_erp']);

  # gerando resultados de triagem da departamento novo erp
  $arr['novo_erp']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['novo_erp']);
  $arr['novo_erp']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['novo_erp']);
  $arr['novo_erp']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['novo_erp']);

  # gerando resultados de índices da departamento novo erp
  $arr['novo_erp']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['novo_erp']);
  $arr['novo_erp']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['novo_erp']);

  /*
   * departamento tecnologia
   */

  # gerando resultados geral da departamento tecnologia
  $arr['tecnologia']['demandas']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamento['tecnologia']);
  $arr['tecnologia']['demandas']['atendidos']     = retornaChamadosAtendidos($conexao, $datas, $departamento['tecnologia']);
  $arr['tecnologia']['demandas']['perdidos']      = retornaChamadosPerdidos($conexao, $datas, $departamento['tecnologia']);
  $arr['tecnologia']['demandas']['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamento['tecnologia']);

  # gerando resultados de triagem da departamento tecnologia
  $arr['tecnologia']['triagem']['ate_15_minutos']        = calculaPercentualAte15Minutos($conexao, $datas,$departamento['tecnologia']);
  $arr['tecnologia']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento['tecnologia']);
  $arr['tecnologia']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento['tecnologia']);

  # gerando resultados de índices da departamento tecnologia
  $arr['tecnologia']['indices']['avancino'] = calculaPercentualDoIndiceAvancino($conexao, $datas, $departamento['tecnologia']);
  $arr['tecnologia']['indices']['geral']    = calculaPercentualDoIndiceGeral($conexao, $datas, $departamento['tecnologia']);

  # comentários satisfeitos
  $arr['comentarios']['satisfeitos'] = retornaComentariosSatisfeitos($conexao, $datas);

  # comentários insatisfeitos
  $arr['comentarios']['insatisfeitos'] = retornaComentariosInsatisfeitos($conexao, $datas);

  # criando sessão com o array dos resultados do relatório
  $_SESSION['relatorios']['chamados']['geral']    = $arr;
  $_SESSION['relatorios']['exibir']['geral']      = true;
  $_SESSION['relatorios']['exibir']['especifico'] = false;
}

/**
 * gera o relatório específico (de um Cnpj específico) dos chamados de um período ou uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com a data inicial e data final
 * @param - variável com o cnpj de um Cnpj específico
 */
function geraRelatorioEspecificoDeChamados($conexao, $datas, $cnpj)
{
  # criando array com o modelo de departamentos
  $departamento = defineArrayDeDepartamentos();

  # criando array com o modelo do relatório de chamados
  $arr = defineArrayDeRelatorioDeChamados();

  /*
   * departamento auge + integral + parceiros
   */

  # gerando resultados geral da departamento auge + integral + parceiros
  $arr['geral']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['geral'], $cnpj);
  $arr['geral']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['geral'], $cnpj);
  $arr['geral']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['geral'], $cnpj);
  $arr['geral']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['geral'], $cnpj);

  # gerando resultados de triagem da departamento auge + integral + parceiros
  $arr['geral']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['geral'], $cnpj);
  $arr['geral']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['geral'], $cnpj);
  $arr['geral']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['geral'], $cnpj);

  # gerando resultados de índices da departamento auge + integral + parceiros
  $arr['geral']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['geral'], $cnpj);
  $arr['geral']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['geral'], $cnpj);

  /*
   * departamento auge
   */

  # gerando resultados geral da departamento auge
  $arr['auge']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['auge'], $cnpj);
  $arr['auge']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['auge'], $cnpj);
  $arr['auge']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['auge'], $cnpj);
  $arr['auge']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['auge'], $cnpj);

  # gerando resultados de triagem da departamento auge
  $arr['auge']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['auge'], $cnpj);
  $arr['auge']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['auge'], $cnpj);
  $arr['auge']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['auge'], $cnpj);

  # gerando resultados de índices da departamento auge
  $arr['auge']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['auge'], $cnpj);
  $arr['auge']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['auge'], $cnpj);

  /*
   * departamento integral
   */

  # gerando resultados geral da departamento integral
  $arr['integral']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['integral'], $cnpj);
  $arr['integral']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['integral'], $cnpj);
  $arr['integral']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['integral'], $cnpj);
  $arr['integral']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['integral'], $cnpj);

  # gerando resultados de triagem da departamento integral
  $arr['integral']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['integral'], $cnpj);
  $arr['integral']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['integral'], $cnpj);
  $arr['integral']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['integral'], $cnpj);

  # gerando resultados de índices da departamento integral
  $arr['integral']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['integral'], $cnpj);
  $arr['integral']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['integral'], $cnpj);

  /*
   * departamento parceiros
   */

  # gerando resultados geral da departamento parceiros
  $arr['parceiros']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);
  $arr['parceiros']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);
  $arr['parceiros']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);
  $arr['parceiros']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);

  # gerando resultados de triagem da departamento parceiros
  $arr['parceiros']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['parceiros'], $cnpj);
  $arr['parceiros']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);
  $arr['parceiros']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);

  # gerando resultados de índices da departamento parceiros
  $arr['parceiros']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);
  $arr['parceiros']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['parceiros'], $cnpj);

  /*
   * departamento novo erp
   */

  # gerando resultados geral da departamento novo erp
  $arr['novo_erp']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);

  # gerando resultados de triagem da departamento novo erp
  $arr['novo_erp']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);

  # gerando resultados de índices da departamento novo erp
  $arr['novo_erp']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);
  $arr['novo_erp']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['novo_erp'], $cnpj);

  /*
   * departamento tecnologia
   */

  # gerando resultados geral da departamento tecnologia
  $arr['tecnologia']['demandas']['demanda_total'] = retornaDemandaTotalCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['demandas']['atendidos']     = retornaChamadosAtendidosCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['demandas']['perdidos']      = retornaChamadosPerdidosCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['demandas']['taxa_de_perda'] = calculaTaxaDePerdaCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);

  # gerando resultados de triagem da departamento tecnologia
  $arr['tecnologia']['triagem']['ate_15_minutos']        = calculaPercentualAte15MinutosCnpj($conexao, $datas,$departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['triagem']['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['triagem']['acima_de_30_minutos']   = calculaPercentualAcimaDe30MinutosCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);

  # gerando resultados de índices da departamento tecnologia
  $arr['tecnologia']['indices']['avancino'] = calculaPercentualDoIndiceAvancinoCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);
  $arr['tecnologia']['indices']['geral']    = calculaPercentualDoIndiceGeralCnpj($conexao, $datas, $departamento['tecnologia'], $cnpj);

  # comentários satisfeitos
  $arr['comentarios']['satisfeitos'] = retornaComentariosSatisfeitosCnpj($conexao, $datas, $cnpj);

  # comentários insatisfeitos
  $arr['comentarios']['insatisfeitos'] = retornaComentariosInsatisfeitosCnpj($conexao, $datas, $cnpj);

  # criando sessão com o array dos resultados do relatório
  $_SESSION['relatorios']['chamados']['especifico'] = $arr;
  $_SESSION['relatorios']['exibir']['especifico']   = true;
  $_SESSION['relatorios']['exibir']['geral']        = false;
}
