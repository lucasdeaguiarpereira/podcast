<?php 

/**
 * responsável por buscar as mensagens do id do chat
 * @param - string com o id do chat
 */
function buscaMensagensDoChat($chat)
{
  require DIRETORIO_MODELS    . 'talks/modelo_mensagens.php';
  require DIRETORIO_FUNCTIONS . 'talks/consulta_mensagens.php';

  $conversa = criaModeloDeConversa();
  $db       = abre_conexao();

  # chamando função que consulta as mensagens de um id do chat
  $conversa = consultaMensagensDoChat($db, $conversa, $chat);

  # enviando mensagens da conversa para a sessão
  $_SESSION['conversa'] = $conversa;

  # redirecionando usuário para página de conversa
  header('Location: ' . BASE_URL . 'public/views/talks/conversa.php');

}