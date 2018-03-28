$('document').ready(function() {

  $('table tbody tr').each(function() {

    var logado = $(this).find('td:nth-child(6)').html();
    var status = $(this).find('td:nth-child(7)').html();
    var classe = $(this).find('td:nth-child(8)').attr('class');
    
    if (logado == 'Não') {

      $(this).find('td').addClass('warning');

    } else if (logado == 'Sim' && status == 'Offline') {

      $(this).find('td').addClass('danger');

    } else {

      $(this).find('td').addClass('success');

    }

    if (classe == 'opcao text-center') {

      $(this).find('td.opcao').removeClass('warning');
      $(this).find('td.opcao').removeClass('danger');
      $(this).find('td.opcao').removeClass('success');
      
    }

  });

});
