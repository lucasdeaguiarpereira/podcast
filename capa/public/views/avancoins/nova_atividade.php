<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('nova_atividade.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Nova Atividade</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/avancoins/nova_atividade.css">
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Nova Atividade</h2>
          </div>
        </div>

        <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_nova_atividade.php" method="post" accept-charset="utf-8">

          <hr>

          <div class="row">
            <div class="col-sm-12">
              <label for="colaborador">Colaborador*</label>
              <select class="form-control required" id="colaborador" name="form[colaborador]">
                <option value="0" selected>Selecione um Colaborador</option>
              </select>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-4">
              <label for="atividade">Atividade*</label>
              <select class="form-control required" id="atividade" name="form[atividade]">
                <option value="0" selected>Selecione uma Atividade</option>
                <option value="1">Visita em Cliente</option>
                <option value="2">Artigo Postado no InfoVarejo</option>
                <option value="3">Atendimento Remoto com Relatório</option>
                <option value="4">Documento Postado na Base de Conhecimento</option>
                <option value="5">Ausência na Gestão do Conhecimento</option>
                <option value="6">SLA fora da Meta (por Protocolo)</option>
                <option value="7">Issue (Aguardando Cliente) fora do Padrão</option>
                <option value="8">Evento Especial</option>
              </select>
            </div>

            <div class="col-sm-4">
              <label for="data">Data*</label>
              <input class="form-control required" type="date" name="form[data]">
            </div>

            <div class="col-sm-4">
              <label for="horario">Horas/Horário*</label>
              <input class="form-control required" type="time" name="form[horario]">
              <p id="aviso">
                <small>Atendimento Remoto com Relatório é igual a horas trabalhadas.</small>
              </p>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-12">
              <label for="observacao">Observação</label>
              <textarea class="form-control required" id="observacao" name="form[observacao]" rows="3" cols="30" placeholder="Descreva a observacao..."></textarea>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-12">
              <input class="form-control required" type="hidden" name="form[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 text-right">
              <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/avancoins/nova_atividade.php">
                Limpar Tela
              </a>
              <button class="btn btn-primary" type="submit">
                Gravar Atividade
              </button>
            </div>
          </div>
        </form>

        <br>

        <div class="row">
          <div class="col-sm-12">
          <?php if (! empty($_SESSION['mensagens']['mensagem']) AND $_SESSION['mensagens']['exibe'] == true) : ?>

            <div class="alert alert-<?php echo $_SESSION['mensagens']['tipo']; ?>" role="alert">
              <?php echo $_SESSION['mensagens']['mensagem']; ?>
              <?php unset($_SESSION['mensagens']['mensagem'], $_SESSION['mensagens']['tipo']); ?>
            </div>

          <?php endif; ?>
          </div>
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/validacao.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
