<?php

# verificando se foi enviado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require DIRETORIO_MODULES . 'avancoins/avancoins.php';

  $form = array(
    'id_colaborador' => '',
    'id_acao_esporadica' => '',
    'id_supervisor' => '',
    'data_registro' => date('Y-m-d'),
    'data_acao' => '',
    'horario_acao' => '',
    'observacao' => ''
  );

  # recuperando dados do formulário de nova atividade
  $form['id_colaborador']     = isset($_POST['form']['colaborador']) ? $_POST['form']['colaborador'] : null;
  $form['id_acao_esporadica'] = isset($_POST['form']['atividade'])   ? $_POST['form']['atividade']   : null;
  $form['id_supervisor']      = isset($_POST['form']['supervisor'])  ? $_POST['form']['supervisor']  : null;
  $form['data_acao']          = isset($_POST['form']['data'])        ? $_POST['form']['data']        : null;
  $form['horario_acao']       = isset($_POST['form']['horario'])     ? $_POST['form']['horario']     : null;  
  $form['observacao']         = isset($_POST['form']['observacao'])  ? addslashes($_POST['form']['observacao'])  : '';

  # verificando se todos os dados obrigatórios foram enviados
  if
    (! empty($form['id_colaborador'])     AND
     ! empty($form['id_acao_esporadica']) AND
     ! empty($form['id_supervisor'])      AND
     ! empty($form['data_acao'])          AND
     ! empty($form['horario_acao'])) {

       # concatenando os segundos no horário
       $form['horario_acao'] .= ':00';

       # retirando quebras de linhas da observação
       $form['observacao'] = preg_replace('/[\n|\r|\n\r|\r\n]{2,}/',' ', $form['observacao']);

       $form['observacao'] = ucwords($form['observacao']);

       # chamando função responsável por gravar uma nova atividade esporádica na tabela de ações esporádicas
       gravaNovaAtividadeEsporadica($form);

  }

}
