$('document').ready(function() {
  // alterando os ícones de setas da barra lateral e cabeçalho
  $('a').click(function() {

    $(this).find("#seta").toggleClass('fa-angle-double-right fa-angle-double-left');

    });


  $('a').click(function() {

    $(this).find("#setinha").toggleClass('fa-caret-down fa-caret-up');

  });


  $('a').click(function() {

    $(this).find("#setauser").toggleClass('fa-caret-down fa-caret-up');

  });

});
