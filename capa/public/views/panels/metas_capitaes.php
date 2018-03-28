<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('metas_capitaes.php', $_SESSION['usuario']['id'])) : ?>

<?php

  require DIRETORIO_MODULES . 'panels/modulo_metas_capitaes.php';

  # recuperando dados da sessão
  $dados = $_SESSION['painel']['metas_capitaes']['dados'];
  $data1 = $_SESSION['painel']['metas_capitaes']['data1'];
  $data2 = $_SESSION['painel']['metas_capitaes']['data2'];

  $contador = count($dados);
  $bandeira = false;

  $totalPerdaProp  = 0.0;
  $totalFilaProp   = 0.0;  
  $totalDemandados = 0;
  $totalPerda      = 0.0;
  $totalFila       = 0.0;

  # verificando se o array modelo de dados contém todos os times (false = um time / true = todos os times)
  if ($contador > 1)

    $bandeira = true;

  unset($_SESSION['painel']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Painel Metas Capitães</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/panels/tabela_metas_capitaes.css">
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Painel Metas Capitães</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>
        
        <div class="row">
          <div class="col-sm-12">
            <div class="text-right">
              <p>
                <a class="text-right btn btn-primary btn-sm" href="<?php echo BASE_URL; ?>public/views/panels/metas_capitaes_selecao.php">
                  <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Página Anterior
                </a>                
              </p>
            </div>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <div class="text-center">
              <p class="alert alert-warning" role="alert">
                Período de <strong><?php echo $data1; ?></strong> até <strong><?php echo $data2; ?></strong>
              </p>
            </div>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-sm-12">            
            <?php if (! $bandeira) : ?><!-- exibindo um time -->

              <?php

                # verificando se o time selecionado foi os templários
                if (isset($dados['2']))
                  $time = 'Os Templários';
                
                # verificando se o time selecionado foi o divergente
                if (isset($dados['3']))
                  $time = 'Divergente';

                # verificando se o time selecionado foi o gulliver
                if (isset($dados['4']))
                  $time = 'Gulliver';
                
                # verificando se o time selecionado foi o avalanche
                if (isset($dados['5']))
                  $time = 'Avalanche';

              ?>

              <h3 class="text-center"><?php echo $time; ?></h3>

              <br>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Colaborador</th>
                    <th class="text-center">Demandados</th>
                    <th class="text-center">Perc. de Perda</th>
                    <th class="text-center">Perc. de Fila 15 min</th>
                    <th class="text-center">Perc. de Perda Prop.</th>
                    <th class="text-center">Perc. de Fila 15 min Prop.</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($dados as $chave1 => $valor1) : ?>

                  <?php foreach ($valor1 as $chave2 => $valor2) : ?>
                    
                    <?php if (isset($valor2['nome']) AND isset($valor2['sobrenome'])) : ?>
                    <tr>
                      <td class="text-left" width="15%"><?php echo $valor2['nome'] . ' ' . $valor2['sobrenome']; ?></td>
                    <?php endif; ?>
                    <?php if (isset($valor2['demandados'])) : ?>
                      <td class="text-center" width="15%"><?php echo $valor2['demandados'];?></td>                      
                    <?php endif; ?>
                    <?php if (isset($valor2['perc_perda'])) : ?>
                      <td class="text-center" width="15%"><?php echo $valor2['perc_perda']; ?>%</td>
                    <?php endif; ?>
                    <?php if (isset($valor2['perc_fila'])) : ?>
                      <td class="text-center" width="15%"><?php echo $valor2['perc_fila']; ?>%</td>
                    <?php endif; ?>
                    <?php if (isset($valor2['perc_perda_prop'])) : ?>
                      <td class="text-center" width="15%"><?php echo $valor2['perc_perda_prop']; ?>%</td>
                    <?php endif; ?>
                    <?php if (isset($valor2['perc_fila_prop'])) : ?>
                      <td class="text-center" width="15%"><?php echo $valor2['perc_fila_prop']; ?>%</td>
                    </tr>
                    <?php endif; ?>

                    <?php 

                      # verificando se a posição percorrida é a do total de perda proporcional
                      if (isset($valor2['total_perda_prop']))
                        
                        # gravando total de perda proporcional em uma variável
                        $totalPerdaProp = $valor2['total_perda_prop'];                                        

                      # verificando se a posição percorrida é a do total de fila proporcional
                      if (isset($valor2['total_fila_prop']))

                        # gravando total de fila proporcional em uma variável
                        $totalFilaProp = $valor2['total_fila_prop'];                    

                      # verificando se a posição percorrida é a do total de demandados
                      if (isset($valor2['total_demandados']))

                        # gravando total de demandados em uma variável
                        $totalDemandados = $valor2['total_demandados'];                    

                      # verificando se a posição percorrida é a do total de perda
                      if (isset($valor2['total_perda']))

                        # gravando total de perda em uma variável
                        $totalPerda = $valor2['total_perda'];                    

                      # verificando se a posição percorrida é a do total de fila
                      if (isset($valor2['total_fila']))

                        # gravando total de fila em uma variável
                        $totalFila = $valor2['total_fila'];                    

                    ?>

                  <?php endforeach; ?>

                <?php endforeach; ?>
                  <tr class="linha-totais"><!-- exibindo totais -->
                    <td class="text-center negrito">Totais</td>
                    <td class="text-center"><?php echo $totalDemandados; ?></td>
                    <td class="text-center perc-total-perda negrito"><?php echo $totalPerda; ?>%</td>
                    <td class="text-center perc-total-fila negrito"><?php echo $totalFila; ?>%</td>
                    <td class="text-center"><?php echo $totalPerdaProp; ?>%</td>
                    <td class="text-center"><?php echo $totalFilaProp; ?>%</td>
                  </tr><!-- exibindo totais -->
                </tbody>
              </table>
            <?php else : ?><!-- exibindo todos os times -->          
              <h3 class="text-center">Os Templários</h3>

              <br>

              <table class="table table-bordered"><!-- tabela do time os templários -->
                <thead>
                  <tr>
                    <th class="text-center">Colaborador</th>
                    <th class="text-center">Demandados</th>
                    <th class="text-center">Perc. de Perda</th>
                    <th class="text-center">Perc. de Fila 15 min</th>
                    <th class="text-center">Perc. de Perda Prop.</th>
                    <th class="text-center">Perc. de Fila 15 min Prop.</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($dados['2'] as $chave => $valor) : ?>
                  
                  <?php if (isset($valor['nome']) AND isset($valor['sobrenome'])) : ?>
                  <tr>
                    <td class="text-left" width="15%"><?php echo $valor['nome'] . ' ' . $valor['sobrenome']; ?></td>
                  <?php endif; ?>
                  <?php if (isset($valor['demandados'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['demandados'];?></td>                      
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda_prop']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila_prop']; ?>%</td>
                  </tr>
                  <?php endif; ?>

                  <?php 

                    # verificando se a posição percorrida é a do total de perda proporcional
                    if (isset($valor['total_perda_prop']))
                      
                      # gravando total de perda proporcional em uma variável
                      $totalPerdaProp = $valor['total_perda_prop'];                                        

                    # verificando se a posição percorrida é a do total de fila proporcional
                    if (isset($valor['total_fila_prop']))

                      # gravando total de fila proporcional em uma variável
                      $totalFilaProp = $valor['total_fila_prop'];                    

                    # verificando se a posição percorrida é a do total de demandados
                    if (isset($valor['total_demandados']))

                      # gravando total de demandados em uma variável
                      $totalDemandados = $valor['total_demandados'];                    

                    # verificando se a posição percorrida é a do total de perda
                    if (isset($valor['total_perda']))

                      # gravando total de perda em uma variável
                      $totalPerda = $valor['total_perda'];                    

                    # verificando se a posição percorrida é a do total de fila
                    if (isset($valor['total_fila']))

                      # gravando total de fila em uma variável
                      $totalFila = $valor['total_fila'];                    

                  ?>

                <?php endforeach; ?>
                <tr class="linha-totais"><!-- exibindo totais -->
                  <td class="text-center negrito">Totais</td>
                  <td class="text-center"><?php echo $totalDemandados; ?></td>
                  <td class="text-center perc-total-perda negrito"><?php echo $totalPerda; ?>%</td>
                  <td class="text-center perc-total-fila negrito"><?php echo $totalFila; ?>%</td>
                  <td class="text-center"><?php echo $totalPerdaProp; ?>%</td>
                  <td class="text-center"><?php echo $totalFilaProp; ?>%</td>
                </tr><!-- exibindo totais -->
                </tbody>
              </table><!-- tabela do time os templários -->

              <br>

              <h3 class="text-center">Divergente</h3>

              <br>

              <table class="table table-bordered"><!-- tabela do time divergente -->
                <thead>
                  <tr>
                    <th class="text-center">Colaborador</th>
                    <th class="text-center">Demandados</th>
                    <th class="text-center">Perc. de Perda</th>
                    <th class="text-center">Perc. de Fila 15 min</th>
                    <th class="text-center">Perc. de Perda Prop.</th>
                    <th class="text-center">Perc. de Fila 15 min Prop.</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($dados['3'] as $chave => $valor) : ?>
                                    
                  <?php if (isset($valor['nome']) AND isset($valor['sobrenome'])) : ?>
                  <tr>
                    <td class="text-left" width="15%"><?php echo $valor['nome'] . ' ' . $valor['sobrenome']; ?></td>
                  <?php endif; ?>
                  <?php if (isset($valor['demandados'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['demandados'];?></td>                      
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda_prop']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila_prop']; ?>%</td>
                  </tr>
                  <?php endif; ?>

                  <?php 

                    # verificando se a posição percorrida é a do total de perda proporcional
                    if (isset($valor['total_perda_prop']))
                      
                      # gravando total de perda proporcional em uma variável
                      $totalPerdaProp = $valor['total_perda_prop'];                                        

                    # verificando se a posição percorrida é a do total de fila proporcional
                    if (isset($valor['total_fila_prop']))

                      # gravando total de fila proporcional em uma variável
                      $totalFilaProp = $valor['total_fila_prop'];                    

                    # verificando se a posição percorrida é a do total de demandados
                    if (isset($valor['total_demandados']))

                      # gravando total de demandados em uma variável
                      $totalDemandados = $valor['total_demandados'];                    

                    # verificando se a posição percorrida é a do total de perda
                    if (isset($valor['total_perda']))

                      # gravando total de perda em uma variável
                      $totalPerda = $valor['total_perda'];                    

                    # verificando se a posição percorrida é a do total de fila
                    if (isset($valor['total_fila']))

                      # gravando total de fila em uma variável
                      $totalFila = $valor['total_fila'];                    

                  ?>

                <?php endforeach; ?>
                <tr class="linha-totais"><!-- exibindo totais -->
                  <td class="text-center negrito">Totais</td>
                  <td class="text-center"><?php echo $totalDemandados; ?></td>
                  <td class="text-center perc-total-perda negrito"><?php echo $totalPerda; ?>%</td>
                  <td class="text-center perc-total-fila negrito"><?php echo $totalFila; ?>%</td>
                  <td class="text-center"><?php echo $totalPerdaProp; ?>%</td>
                  <td class="text-center"><?php echo $totalFilaProp; ?>%</td>
                </tr><!-- exibindo totais -->
                </tbody>
              </table><!-- tabela do time divergente -->

              <br>

              <h3 class="text-center">Gulliver</h3>

              <br>

              <table class="table table-bordered"><!-- tabela do time gulliver -->
                <thead>
                  <tr>
                    <th class="text-center">Colaborador</th>
                    <th class="text-center">Demandados</th>
                    <th class="text-center">Perc. de Perda</th>
                    <th class="text-center">Perc. de Fila 15 min</th>
                    <th class="text-center">Perc. de Perda Prop.</th>
                    <th class="text-center">Perc. de Fila 15 min Prop.</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($dados['4'] as $chave => $valor) : ?>
                  
                  <?php if (isset($valor['nome']) AND isset($valor['sobrenome'])) : ?>
                  <tr>
                    <td class="text-left" width="15%"><?php echo $valor['nome'] . ' ' . $valor['sobrenome']; ?></td>
                  <?php endif; ?>
                  <?php if (isset($valor['demandados'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['demandados'];?></td>                      
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda_prop']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila_prop']; ?>%</td>
                  </tr>
                  <?php endif; ?>                  

                  <?php 

                    # verificando se a posição percorrida é a do total de perda proporcional
                    if (isset($valor['total_perda_prop']))
                      
                      # gravando total de perda proporcional em uma variável
                      $totalPerdaProp = $valor['total_perda_prop'];                                        

                    # verificando se a posição percorrida é a do total de fila proporcional
                    if (isset($valor['total_fila_prop']))

                      # gravando total de fila proporcional em uma variável
                      $totalFilaProp = $valor['total_fila_prop'];                    

                    # verificando se a posição percorrida é a do total de demandados
                    if (isset($valor['total_demandados']))

                      # gravando total de demandados em uma variável
                      $totalDemandados = $valor['total_demandados'];                    

                    # verificando se a posição percorrida é a do total de perda
                    if (isset($valor['total_perda']))

                      # gravando total de perda em uma variável
                      $totalPerda = $valor['total_perda'];                    

                    # verificando se a posição percorrida é a do total de fila
                    if (isset($valor['total_fila']))

                      # gravando total de fila em uma variável
                      $totalFila = $valor['total_fila'];                    

                  ?>

                <?php endforeach; ?>
                <tr class="linha-totais"><!-- exibindo totais -->
                  <td class="text-center negrito">Totais</td>
                  <td class="text-center"><?php echo $totalDemandados; ?></td>
                  <td class="text-center perc-total-perda negrito"><?php echo $totalPerda; ?>%</td>
                  <td class="text-center perc-total-fila negrito"><?php echo $totalFila; ?>%</td>
                  <td class="text-center"><?php echo $totalPerdaProp; ?>%</td>
                  <td class="text-center"><?php echo $totalFilaProp; ?>%</td>
                </tr><!-- exibindo totais -->
                </tbody>
              </table><!-- tabela do time gulliver -->

              <br>

              <h3 class="text-center">Avalanche</h3>

              <br>

              <table class="table table-bordered"><!-- tabela do time avalanche -->
                <thead>
                  <tr>
                    <th class="text-center">Colaborador</th>
                    <th class="text-center">Demandados</th>
                    <th class="text-center">Perc. de Perda</th>
                    <th class="text-center">Perc. de Fila 15 min</th>
                    <th class="text-center">Perc. de Perda Prop.</th>
                    <th class="text-center">Perc. de Fila 15 min Prop.</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($dados['5'] as $chave => $valor) : ?>
                                  
                  <?php if (isset($valor['nome']) AND isset($valor['sobrenome'])) : ?>
                  <tr>
                    <td class="text-left" width="15%"><?php echo $valor['nome'] . ' ' . $valor['sobrenome']; ?></td>
                  <?php endif; ?>
                  <?php if (isset($valor['demandados'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['demandados'];?></td>                      
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_perda_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_perda_prop']; ?>%</td>
                  <?php endif; ?>
                  <?php if (isset($valor['perc_fila_prop'])) : ?>
                    <td class="text-center" width="15%"><?php echo $valor['perc_fila_prop']; ?>%</td>
                  </tr>
                  <?php endif; ?>

                  <?php 

                    # verificando se a posição percorrida é a do total de perda proporcional
                    if (isset($valor['total_perda_prop']))
                      
                      # gravando total de perda proporcional em uma variável
                      $totalPerdaProp = $valor['total_perda_prop'];                                        

                    # verificando se a posição percorrida é a do total de fila proporcional
                    if (isset($valor['total_fila_prop']))

                      # gravando total de fila proporcional em uma variável
                      $totalFilaProp = $valor['total_fila_prop'];                    

                    # verificando se a posição percorrida é a do total de demandados
                    if (isset($valor['total_demandados']))

                      # gravando total de demandados em uma variável
                      $totalDemandados = $valor['total_demandados'];                    

                    # verificando se a posição percorrida é a do total de perda
                    if (isset($valor['total_perda']))

                      # gravando total de perda em uma variável
                      $totalPerda = $valor['total_perda'];                    

                    # verificando se a posição percorrida é a do total de fila
                    if (isset($valor['total_fila']))

                      # gravando total de fila em uma variável
                      $totalFila = $valor['total_fila'];                    

                  ?>

                <?php endforeach; ?>
                <tr class="linha-totais"><!-- exibindo totais -->
                  <td class="text-center negrito">Totais</td>
                  <td class="text-center"><?php echo $totalDemandados; ?></td>
                  <td class="text-center perc-total-perda negrito"><?php echo $totalPerda; ?>%</td>
                  <td class="text-center perc-total-fila negrito"><?php echo $totalFila; ?>%</td>
                  <td class="text-center"><?php echo $totalPerdaProp; ?>%</td>
                  <td class="text-center"><?php echo $totalFilaProp; ?>%</td>
                </tr><!-- exibindo totais -->
                </tbody>
              </table><!-- tabela do time avalanche -->
            <?php endif; ?>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  
  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/destaca_resultados.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
