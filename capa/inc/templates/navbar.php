<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>../capa/public/home.php">
        <img id="logo" src="<?php echo BASE_URL; ?>../capa/public/img/logo.png" alt="Novo Capa">
        <p id="novo-capa">
          Portal Avanção
        </p>
      </a>
      <a href="#menu-toggle" title="Menu Lateral" id="menu-toggle">
        <i id="seta" class="fa fa-angle-double-right fa-2x" aria-hidden="true"></i>
      </a>


      <button type="button" class="navbar-toggle collapsed visible-xs" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <ul class="dropdown-menu" id="bs-example-navbar-collapse-1">
        <li class="dropdown-header text-center">Acesso</li>
        <li class="divider"></li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/public/views/login/form_login.php">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Logar
          </a>
        </li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/app/modules/logout/logout.php">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Deslogar
          </a>
        </li>
      </ul>
     
    </div>
    <ul class="nav navbar-nav navbar-right dropdown hidden-xs">
      <a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown">
        <i class="fa fa-user fa-2x navbar-brand espacouser entreicons hidden-xs" aria-hidden="true"></i>
        <i id="setauser" class="fa fa-caret-down fa-1x navbar-brand espacoseta entreicons hidden-xs" aria-hidden="true"></i>
      </a>
      <ul class="dropdown-menu">
        <li class="dropdown-header text-center">Acesso</li>
        <li class="divider"></li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/public/views/login/form_login.php">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Logar
          </a>
        </li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/app/modules/logout/logout.php">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Deslogar
          </a>
        </li>
      </ul>
    </ul>        
    <?php if (isset($_SESSION['usuario']) AND $_SESSION['usuario']['logado'] == true) : ?>
    <p id="saudacao" class="text-right">      
      <small>Bem vindo,
        <?php echo $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome']; ?>!
      </small>
    </p>
    <?php endif; ?>
  </div>
</nav>
