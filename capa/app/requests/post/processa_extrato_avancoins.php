<?php

# verificando se foi enviado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require DIRETORIO_MODULES . 'avancoins/avancoins.php';

  $form = array(
    'colaborador' => '',
    'tipo' => '',
    'data_inicial' => '',
    'data_final' => ''
  );

  # recuperando dados do formulário de extrato avancoins
  $form['colaborador']  = isset($_POST['form']['colaborador'])  ? $_POST['form']['colaborador']  : null;
  $form['tipo']         = isset($_POST['form']['tipo'])         ? $_POST['form']['tipo']         : null;
  $form['data_inicial'] = isset($_POST['form']['data_inicial']) ? $_POST['form']['data_inicial'] : '';
  $form['data_final']   = isset($_POST['form']['data_final'])   ? $_POST['form']['data_final']   : '';

  # verificando se todos os dados obrigatórios foram enviados
  if (! empty($form['colaborador']) AND ! empty($form['tipo'])) {

    # verificando se o usuário deseja o relatório completo
    if ($form['data_inicial'] == '' AND $form['data_final'] == '') {

      $form['data_inicial'] = '2018-01-01';
      $form['data_final']   = date('Y-m-d');

    }

    # chamando função responsável por gerar o extrato avancoins (simples ou detalhado)
    geraExtratoAvancoins($form);

  }

}
