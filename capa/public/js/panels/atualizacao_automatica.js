/* função que atualiza a página */
function atualizacaoAutomatica() {

    setTimeout(function () {

        window.location.reload(true);

    }, 120000);

}

/* executando evento ao recarregar a página a função de atualização é chamada em loop */
window.onload = function () {

  atualizacaoAutomatica();
  
}
