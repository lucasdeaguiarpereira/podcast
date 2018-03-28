<?php

/*
 * reponsável por consultar e recuperar todos os tickets gerados pelo sistema
 */
function recuperaTodosOsTicketsGerados()
{
  require DIRETORIO_MODELS    . 'tickets/modelo_tickets.php';
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # chamando função que cria o modelo de dados de tickets
  $tickets = criaModeloDeTickets();

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que consulta todos os tickets gerados
  $tickets = consultaTodosOsTicketsGerados($db, $tickets);

  fecha_conexao($db);

  return $tickets;

}

/**
 * responsável por deletar um ticket
 * @param - string com o número do ticket que será deletado
 */
function deletaTicket($ticket)
{
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que deleta um ticket no banco de dados
  deletaTicketNoBancoDeDados($db, $ticket);

  fecha_conexao($db);

  # redirecionando usuário para a página de consulta de tickets
  header('Location: ' . BASE_URL . 'public/views/tickets/consulta_tickets.php');

  exit;

}

/**
 * responsável por invalidar um ticket
 * @param - string com o número do ticket que será invalidado
 */
function invalidaTicket($ticket)
{
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que invalida um ticket no banco de dados
  invalidaTicketNoBancoDeDados($db, $ticket);

  fecha_conexao($db);

  # redirecionando usuário para a página de consulta de tickets
  header('Location: ' . BASE_URL . 'public/views/tickets/consulta_tickets.php');

  exit;

}
