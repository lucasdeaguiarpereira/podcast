<?php

# definindo constante com o path absoluto do projeto no servidor web
if (! defined('ABS_PATH'))
  define('ABS_PATH', dirname(__DIR__ . '../') . '/');

# definindo constante com o path do diretório raíz do projeto no servidor web
if (! defined('BASE_URL'))
  define('BASE_URL', '/avanco/capa/');
