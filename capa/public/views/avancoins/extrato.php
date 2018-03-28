<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('extrato.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Extrato de Avancoins</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/avancoins/extrato.css">
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Extrato Avancoins</h2>
          </div>
        </div>

        <form action="<?php echo BASE_URL; ?>app/requests/post/processa_extrato_avancoins.php" method="post" accept-charset="utf-8">

          <hr>

          <?php if ($_SESSION['usuario']['nivel'] == 1) : ?>
            <div class="row">
              <div class="col-sm-6">
                <label for="tipo">Tipo*</label>
                <?php if (isset($_SESSION['avancoins']['form'])) : ?>

                  <?php if ($_SESSION['avancoins']['form']['tipo'] == '1') : ?>
                    <select class="form-control required" name="form[tipo]">
                      <option value="0">Selecione o Tipo do Relatório</option>
                      <option value="1" selected>Relatório Simplificado</option>
                      <option value="2">Relatório Detalhado</option>
                    </select>

                  <?php elseif ($_SESSION['avancoins']['form']['tipo'] == '2') : ?>
                    <select class="form-control required" name="form[tipo]">
                      <option value="0">Selecione o Tipo do Relatório</option>
                      <option value="1">Relatório Simplificado</option>
                      <option value="2" selected>Relatório Detalhado</option>
                    </select>

                  <?php endif; ?>

                <?php else : ?>
                  <select class="form-control required" name="form[tipo]">
                    <option value="0" selected>Selecione o Tipo do Relatório</option>
                    <option value="1">Relatório Simplificado</option>
                    <option value="2">Relatório Detalhado</option>
                  </select>
                <?php endif; ?>

                <p id="aviso">
                  <small>Para emitir o extrato desde o início não preencha as datas inicial e final.</small>
                </p>
              </div>

              <?php if (isset($_SESSION['avancoins']['form'])) : ?>
                <div class="col-sm-3">
                  <label for="data_inicial">Data Inicial</label>
                  <input class="form-control" type="date" name="form[data_inicial]" value="<?php echo $_SESSION['avancoins']['form']['data_inicial']; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="data_final">Data Final</label>
                  <input class="form-control" type="date" name="form[data_final]" value="<?php echo $_SESSION['avancoins']['form']['data_final']; ?>">
                </div>
              </div>

            <?php else : ?>
              <div class="col-sm-3">
                <label for="data_inicial">Data Inicial</label>
                <input class="form-control" type="date" name="form[data_inicial]">
              </div>

              <div class="col-sm-3">
                <label for="data_final">Data Final</label>
                <input class="form-control" type="date" name="form[data_final]">
              </div>
            </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-sm-12">
                <input class="form-control" type="hidden" name="form[colaborador]" value="<?php echo $_SESSION['usuario']['id']; ?>">
              </div>
            </div>
          <?php elseif ($_SESSION['usuario']['nivel'] == 2) : ?>
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
              <div class="col-sm-6">
                <label for="tipo">Tipo*</label>
                <?php if (isset($_SESSION['avancoins']['form'])) : ?>

                  <?php if ($_SESSION['avancoins']['form']['tipo'] == '1') : ?>
                    <select class="form-control required" name="form[tipo]">
                      <option value="0">Selecione o Tipo do Relatório</option>
                      <option value="1" selected>Relatório Simplificado</option>
                      <option value="2">Relatório Detalhado</option>
                    </select>

                  <?php elseif ($_SESSION['avancoins']['form']['tipo'] == '2') : ?>
                    <select class="form-control required" name="form[tipo]">
                      <option value="0">Selecione o Tipo do Relatório</option>
                      <option value="1">Relatório Simplificado</option>
                      <option value="2" selected>Relatório Detalhado</option>
                    </select>

                  <?php endif; ?>

                <?php else : ?>
                  <select class="form-control required" name="form[tipo]">
                    <option value="0" selected>Selecione o Tipo do Relatório</option>
                    <option value="1">Relatório Simplificado</option>
                    <option value="2">Relatório Detalhado</option>
                  </select>
                <?php endif; ?>

                <p id="aviso">
                  <small>Para emitir o extrato desde o início não preencha as datas inicial e final.</small>
                </p>
              </div>

              <?php if (isset($_SESSION['avancoins']['form'])) : ?>
                <div class="col-sm-3">
                  <label for="data_inicial">Data Inicial</label>
                  <input class="form-control" type="date" name="form[data_inicial]" value="<?php echo $_SESSION['avancoins']['form']['data_inicial']; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="data_final">Data Final</label>
                  <input class="form-control" type="date" name="form[data_final]" value="<?php echo $_SESSION['avancoins']['form']['data_final']; ?>">
                </div>
              </div>

            <?php else : ?>
              <div class="col-sm-3">
                <label for="data_inicial">Data Inicial</label>
                <input class="form-control" type="date" name="form[data_inicial]">
              </div>

              <div class="col-sm-3">
                <label for="data_final">Data Final</label>
                <input class="form-control" type="date" name="form[data_final]">
              </div>
            </div>
            <?php endif; ?>

          <?php endif; ?>

          <br>

          <div class="row">
            <div class="col-sm-12 text-right">
              <a class="btn btn-default" href="<?php echo BASE_URL; ?>app/helpers/avancoins/limpa_extrato_avancoins.php">
                Limpar Extrato
              </a>
              <button class="btn btn-primary" type="submit">
                Gerar Extrato
              </button>
            </div>
          </div>
        </form>

        <br>

        <div class="row">
          <div class="col-sm-12">
            <?php if (isset($_SESSION['avancoins'])) : ?>

              <?php echo ($_SESSION['avancoins']['extrato']['totais']); ?>

              <?php if (isset($_SESSION['avancoins']['extrato']['compra'])     AND
                        isset($_SESSION['avancoins']['extrato']['esporadica']) AND
                        isset($_SESSION['avancoins']['extrato']['mensal'])     AND
                        isset($_SESSION['avancoins']['extrato']['diaria'])) : ?>

                <?php echo ($_SESSION['avancoins']['extrato']['compra']); ?>
                <?php echo ($_SESSION['avancoins']['extrato']['esporadica']); ?>
                <?php echo ($_SESSION['avancoins']['extrato']['mensal']); ?>
                <?php echo ($_SESSION['avancoins']['extrato']['diaria']); ?>

              <?php endif; ?>
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
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/validacao_extrato_avancoins.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
