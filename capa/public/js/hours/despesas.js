$('document').ready(function() {
  
  // somando despesas
  $('#deslocamento, #alimentacao, #hospedagem').keyup(function() {

    var deslocamento = 0;
    var alimentacao  = 0;
    var hospedagem   = 0;
    var total        = 0;
        
    if ($('#deslocamento').val() != '') {

      deslocamento = parseFloat($('#deslocamento').val());

    }

    if ($('#alimentacao').val() != '') {

      alimentacao  = parseFloat($('#alimentacao').val());

    }

    if ($('#hospedagem').val() != '') {

      hospedagem   = parseFloat($('#hospedagem').val());

    }

    total = deslocamento + alimentacao + hospedagem;

    $('#total-despesas').val(total);

  });

});