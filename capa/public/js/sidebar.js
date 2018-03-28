$('document').ready(function() {

  $("#menu-toggle").click(function(e) {

      e.preventDefault();

      // ocultando a barra lateral
      $("#wrapper").toggleClass("toggled");

  });

});
