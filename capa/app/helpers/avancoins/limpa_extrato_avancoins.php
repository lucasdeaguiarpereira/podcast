<?php

require '../../../init.php';

# verifcando se a sessão do módulo avancoins existe
if (isset($_SESSION['avancoins'])) {

  unset($_SESSION['avancoins']);

}

# redirecionando usuário para página de extrato
header('Location: ' . BASE_URL . 'public/views/avancoins/extrato.php');
