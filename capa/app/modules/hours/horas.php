<?php 

/**
 * responsável por gravar os registros de horas na base de dados
 */
function gravaRegistroDeHoras($issues, $despesas, $lancamentos)
{
  require DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';

  $db = abre_conexao();

  $issues['id'] = consultaUltimoId($db);
  $issues['id'] += 1;

  $retorno = insereRegistroDeIssues($db, $issues);

  if ($retorno) {

    $retorno = insereRegistroDeLancamentos($db, $lancamentos, $issues['id']);
    
    if ($retorno) {

      if ($issues['tipo'] == 'in-loco' AND $despesas['total-despesas'] > 0) {
        
        $retorno = insereRegistroDeDespesas($db, $despesas, $issues['id']);

        if ($retorno) {

          # registrou despesa
          $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Registro gravado com sucesso.</p>';
          $_SESSION['mensagens']['tipo']     = 'success';
          $_SESSION['mensagens']['exibe']    = true;

        } else {

          # erro ao insetir a despesa
          $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A despesa não foi gravada! Houve erro de SQL.</p>';
          $_SESSION['mensagens']['tipo']     = 'danger';
          $_SESSION['mensagens']['exibe']    = true;
        }
        
      } else {

        # todos os registros foram gravados com sucesso
        $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Registro gravado com sucesso.</p>';
        $_SESSION['mensagens']['tipo']     = 'success';
        $_SESSION['mensagens']['exibe']    = true;

      }
      
    } else {

      # erro ao inserir algum registro de lançamento      
      $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Algum lançamento não foi gravado! Houve erro de SQL.</p>';
      $_SESSION['mensagens']['tipo']     = 'danger';
      $_SESSION['mensagens']['exibe']    = true;
    }

  } else {

    # erro ao inserir o registro de issue
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A issue não foi gravada! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  header('Location: ' . BASE_URL . 'public/views/hours/registro_horas.php');
  
}