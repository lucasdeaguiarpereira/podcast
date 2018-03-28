$('document').ready(function() {

  $('form').submit(function() {

    var contador = 0;

    $('input.required').each(function() {

      if ($(this).val() == '') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    $('select.required').each(function() {

      if ($(this).val() == '0') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    $('textarea.required').each(function() {

      if ($(this).val() == '') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    
    if (contador > 0) {

      alert('Por favor, Preencha os campos em destaque!')

      return false;
    }

  });

});
