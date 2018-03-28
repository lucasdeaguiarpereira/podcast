/*
 * exibe um aviso e só exclui o ticket caso clique em Ok
 */
function confirmaExclusaoTicket()
{
  var ticket = 0;

  // recuperando o número do ticket
  ticket = $('.table tbody tr').find('td:nth-child(2)').html();

  // vericando se o número do ticket é maior que zero
  if (ticket > 0) {

    // exibindo aviso de confirmação de exclusão do ticket
    var resposta = confirm('Confirma a exclusão do Ticket: ' + ticket + '?');

    // verificando se o usuário cancelou a exclusão ou confirmou a exclusão
    if (resposta) {

      // recuperando endereço do recurso atual
      var uri = window.location.href;

      // separando endereço do recurso atual
      var arr = uri.split('/');

      // montando url do recurso que deleta o ticket
      var url = arr[0]+'//'+arr[2]+'/'+arr[3]+'/'+arr[4]+'/app/requests/get/processa_ticket.php?ticket='+ticket+'&funcao=deleta';

      // chamando url montada
      window.location.href = url;

    } else {

      // recarregando página atual
      window.location.reload(true);

    }

  } else {

    console.log('Não foi possível recuperar o número do Ticket!');

    alert('Erro ao recuperar o número do Ticket!');

  }

}
