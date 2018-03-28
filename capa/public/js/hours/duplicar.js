$('document').ready(function() {

  var i = 1;

  $('#botao').click(function() {
    
    $('#lancamentos').append(
    
    "<div class='row'><div class='col-sm-12'><div class='row'><div class='col-sm-2'><label for='data'>Data</label><input class='form-control required' id='data' type='date' name='lancamentos["+i+"][data]' numero="+i+"></div></div><br><div class='row'><div class='col-sm-2'><label for='produto'>Produto</label><select class='form-control required' id='produto' name='lancamentos["+i+"][produto]' numero="+i+"><option value='0'>Selecione um Produto</option><option value='1'>Integral</option><option value='2'>Frente de Loja</option><option value='3'>Gestor</option><option value='4'>Novo ERP</option></select></div></div><br> <div class='row'><div class='col-sm-2'><label for='horas-trabalhadas'>Horas Trabalhadas</label><input class='form-control required' id='horas-trabalhadas' type='time' name='lancamentos["+i+"][horas-trabalhadas]' numero="+i+"></div><div class='col-sm-2'><label for='horas-faturadas'>Horas Faturadas</label><input class='form-control required' id='horas-faturadas' type='time' name='lancamentos["+i+"][horas-faturadas]' numero="+i+"></div></div><br><div class='row'><div class='col-sm-2'><label for='valor-horas'>Valor Horas</label><input class='form-control required' id='valor-horas' type='text' name='lancamentos["+i+"][valor-horas]' value='0' numero="+i+"></div><div class='col-sm-2'><label for='valor-toral'>Valor Total</label><input class='form-control required' id='valor-total' type='text' name='lancamentos["+i+"][valor-total]' value='0' numero="+i+"></div></div></div></div><hr>");

    i++;
    
  });

});

