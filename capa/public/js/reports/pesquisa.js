$('document').ready(function() {

  const BASE_URL = '../../../../';

  var myEfficientFn = debounce(function() {

    $('#bloco').empty(); //limpando o bloco da tabela se a pesquisa for vazia
    
    var pesquisa = $('#pesquisa').val();

    if (pesquisa != '') {

      $.ajax({
        type: 'post',
        url: BASE_URL + 'app/requests/post/processa_pesquisa.php?pesquisa=' + pesquisa,
        dataType: 'html',
        beforeSend: function() {
          $('#loader').removeClass('hidden');
        },
        success: function(tabela)
        {
          if (tabela === 'erro') {

            alert('Ops! Houve um erro durante a execução da consulta de pesquisa.');

          } else {

            $('#loader').addClass('hidden');
            
            $('#bloco').html(tabela);

            // paginando a tabela
            $('#tabela').dataTable({
               "oLanguage" : {
                 "sEmptyTable": "Nenhum registro encontrado",
                 "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                 "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                 "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                 "sInfoPostFix": "",
                 "sInfoThousands": ".",
                 "sLengthMenu": "_MENU_ Contratos exibidos por página",
                 "sLoadingRecords": "Carregando...",
                 "sProcessing": "Processando...",
                 "sZeroRecords": "Nenhum registro encontrado",
                 "sSearch": "Pesquisar",
                 "oPaginate": {
                   "sNext": "Próximo",
                   "sPrevious": "Anterior",
                   "sFirst": "Primeiro",
                   "sLast": "Último"
                 },
                 "oAria": {
                   "sSortAscending": ": Ordenar colunas de forma ascendente",
                   "sSortDescending": ": Ordenar colunas de forma descendente"
                 }
               },
               "bFilter": false //removendo a pesquisa
            });

          }

        },
        error: function(tabela)
        {
          alert(tabela);
        }
      });

    } else {

      $('#bloco').empty(); //limpando o bloco da tabela se a pesquisa for vazia

    }

  }, 1000);

  $('#pesquisa').keyup(myEfficientFn);

});

/* função que retorna o resultado da busca do nome da razão social após o usuário parar de digitar */
function debounce(func, wait, immediate) {

  var timeout;

  return function() {

    var context = this, args = arguments;

    var later = function() {

      timeout = null;

      if (!immediate) func.apply(context, args);

    };

    var callNow = immediate && !timeout;

    clearTimeout(timeout);

    timeout = setTimeout(later, wait);

    if (callNow) func.apply(context, args);

  };
  
};