$('document').ready(function() {

  // ocultando bloco despesas
  $('#remoto').click(function() {

    $('#bloco-despesas').addClass('hidden');

  });

  // exibindo bloco despesas
  $('#in-loco').click(function() {

    $('#bloco-despesas').removeClass('hidden');

    $('#total-despesas').val(0);
    $('#deslocamento').val(0);
    $('#alimentacao').val(0);
    $('#hospedagem').val(0);

  });
  
});