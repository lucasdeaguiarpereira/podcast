$('document').ready(function() {

  // percorrendo as colunas de total perda e fila de uma ou todas as tabelas de times
  $('.linha-totais').each(function() {

    // recuperando totais de perda e fila
    var percTotalPerda = parseFloat($(this).find('td:nth-child(3)').html());
    var percTotalFila  = parseFloat($(this).find('td:nth-child(4)').html());

    // verificando se o total de perda é menor do que 15
    if (percTotalPerda <= 15) {

      // alterando a cor de fundo da célula para verde
      $(this).find('.perc-total-perda').css('background', '#00FF00');

    } else {

      // alterando a cor de fundo da célula para vermelho
      $(this).find('.perc-total-perda').css('background', '#FE2E2E');
      
    }

    // verificando se o total de fila é maior ou igual a 85
    if (percTotalFila >= 85.0) {

      // alterando a cor de fundo da célula para verde
      $(this).find('.perc-total-fila').css('background', '#00FF00');

    } else {

      // alterando a cor de fundo da célula para vermelho
      $(this).find('.perc-total-fila').css('background', '#FE2E2E');

    }

  });

});