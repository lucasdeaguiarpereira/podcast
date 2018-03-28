<?php

# verificando se foi enviado requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../modules/avancoins/colaboradores.php';

  # chamando função responsável por criar as opções com os dados dos colaboradores
  criaOpcoesDeColaboradores();

}
