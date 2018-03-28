$('document').ready(function() {

  $('#lancamentos').on('keyup', '#valor-horas', function() {
    
    var valorHora      = 0;
    var horasFaturadas = 0;
    var minutos        = 0;
    var total          = 0;

    var numero = $(this).attr('numero');

    if ($('#valor-horas[numero="'+numero+'"]').val() != '') {

      valorHora = parseFloat($('#valor-horas[numero="'+numero+'"]').val());
      
    }

    if ($('#horas-faturadas[numero="'+numero+'"]').val() != '') {

      horasFaturadas = $('#horas-faturadas[numero="'+numero+'"]').val();
      
      var arr = horasFaturadas.split(':', 2);
      
      var horas   = parseInt(arr[0]);
      var minutos = parseInt(arr[1]);

      minutos += (horas * 60);
      
    }
    
    total = (valorHora / 60) * minutos

    var valorTotal = parseFloat(total.toFixed(2));

    $('#valor-total[numero="'+numero+'"]').val(valorTotal);

  });

  $('#lancamentos').on('keyup', '#valor-total', function() {
    
    var valorHora      = 0;
    var horasFaturadas = 0;
    var minutos        = 0;
    var total          = 0;

    var numero = $(this).attr('numero');

    if ($('#valor-total[numero="'+numero+'"]').val() != '') {

      total = parseFloat($('#valor-total[numero="'+numero+'"]').val());

    }

    if ($('#horas-faturadas[numero="'+numero+'"]').val() != '') {

      horasFaturadas = $('#horas-faturadas[numero="'+numero+'"]').val();

      var arr = horasFaturadas.split(':', 2);
      
      var horas   = parseInt(arr[0]);
      var minutos = parseInt(arr[1]);

      minutos += (horas * 60);

    }

    valorHora = (total / minutos) * 60;

    var hora = parseFloat(valorHora.toFixed(2));

    $('#valor-horas[numero="'+numero+'"]').val(hora);

  });

});