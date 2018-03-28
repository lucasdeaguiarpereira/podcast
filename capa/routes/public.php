<?php

# definindo constante com o path do diretório public
if (! defined('DIRETORIO_PUBLIC'))
  define('DIRETORIO_PUBLIC', BASE_URL . 'public/');

# definindo constante com o path do formulário de login
if (! defined('FORM_LOGIN'))
  define('FORM_LOGIN', BASE_URL . 'public/views/login/form_login.php');

# definindo constante com o path da página de home
if (! defined('PAGE_HOME'))
  define('PAGE_HOME', BASE_URL . 'public/home.php');
