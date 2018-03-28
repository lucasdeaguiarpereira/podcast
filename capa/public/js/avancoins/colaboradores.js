$('document').ready(function() {

  const BASE_URL = '../../../';

  $.ajax({
    type: 'post',
    url: BASE_URL + 'app/requests/post/processa_colaboradores.php',
    dataType: 'html',
    success: function(colaboradores)
    {
      if (colaboradores === 'erro') {

        alert('Ops! Houve um erro durante a execução da consulta de colaboradores.');

      } else {

        $('#colaborador').html(colaboradores);

      }

    },
    error: function(colaboradores)
    {

      alert(colaboradores);

    }

  });

});
