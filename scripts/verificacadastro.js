function validar() {
var nome = cadastro.nome.value;
var email = cadastro.email.value;
var senha = cadastro.senha.value;
 
if (nome == "") {
alert('Preencha o campo com seu nome');
cadastro.nome.focus();
return false;
}

if (email == "") {
alert('Preencha o campo com seu email');
cadastro.email.focus();
return false;
}

if (senha == "") {
alert('Preencha o campo com sua senha');
cadastro.senha.focus();
return false;
}

}