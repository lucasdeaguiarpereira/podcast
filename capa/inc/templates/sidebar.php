<div id="wrapper">
  <div id="sidebar-wrapper"><!-- sidebar -->
    <ul class="nav sidebar-nav">
      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu1">
          <span class="nav-header-primary">
            <i class="fa fa-user" aria-hidden="true"></i> Usuário
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu1">
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/users/conta.php">
              <p>Conta<p>
            </a>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
          <span class="nav-header-primary">
            <i class="fa fa-id-card-o" aria-hidden="true"></i> Dashboard
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu2">
        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 1) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../dashboard/public/views/profile/colaborador.php" target="_blank">
              <p>Colaborador<p>
            </a>
          </li>
        <?php elseif(isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../dashboard/public/views/profile/administrador.php" target="_blank">
              <p>Administrador<p>
            </a>
          </li>
        <?php endif; ?>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu3">
          <span class="nav-header-primary">
            <i class="fa fa-money" aria-hidden="true"></i> Avancoins
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu3">
        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 1) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/extrato.php">
              <p>Extrato<p>
            </a>
          </li>
        <?php elseif(isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/nova_atividade.php">
              <p>Atividade<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/extrato.php">
              <p>Extrato<p>
            </a>
          </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo BASE_URL; ?>../dashboard/public/views/store/loja.php" target="_blank">
            <p>Loja<p>
          </a>
        </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu4">
          <span class="nav-header-primary">
            <i class="fa fa-tags" aria-hidden="true"></i> Tickets
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu4">
          <li><a href="<?php echo BASE_URL; ?>../tickets/public/views/screen/novo_ticket.php"><p>Novo<p></a></li>
          <li><a href="<?php echo BASE_URL; ?>../capa/public/views/tickets/consulta_tickets.php"><p>Consultar<p></a></li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu5">
          <span class="nav-header-primary">
            <i class="fa fa-calendar" aria-hidden="true"></i> Registro
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu5">
          <li><a href="<?php echo BASE_URL; ?>../capa/public/views/hours/registro_horas.php"><p>Horas<p></a></li>          
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu6">
          <span class="nav-header-primary">
            <i class="fa fa-television" aria-hidden="true"></i> Painéis
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu6">        
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/metas_capitaes_selecao.php">
              <p>Metas<p>
            </a>
          </li>        
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/colaboradores_logados.php">
              <p>Logados<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/ramais.php">
              <p>Ramais<p>
            </a>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu7">
          <span class="nav-header-primary">
            <i class="fa fa-bar-chart" aria-hidden="true"></i> Relatórios
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>

        <ul class="nav collapse"  id="submenu7">        
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/reports/calls/consulta_atendimentos.php">
              <p>Atendimentos<p>
            </a>
          </li>                  
        </ul>        
      </li>


    </ul>
  </div><!-- sidebar -->

  <div id="page-content-wrapper"><!-- conteúdo da página -->
    <div class="container-fluid"><!-- container -->
