const buttonSubmit = document.querySelector("#submit");

window.onload = function(){
    document.forms.formAcad.onsubmit = validaForm;
    $("#area-mensagem").hide();
    $("select").change(function (){
        $("#area-mensagem").show();
        var selecao = document.forms.formAcad.contactAbout.value;
        if(selecao == "reclamacao"){
            $("textarea").attr("placeholder", "Digite sua Reclamação");
        }
        if(selecao == "duvida"){
            $("textarea").attr("placeholder", "Digite sua Dúvida");
        }
        if(selecao == "sugestao"){
            $("textarea").attr("placeholder", "Digite sua Sugestão");
        }
    });
};

function validaForm(e) {
    var form = e.target;
    let formValido = true;
    let mensagem = "";
    let spanText = form.nome.nextElementSibling;
    spanText.textContent = "";
    if(form.nome.value == ""){
        spanText.textContent = "Nome Vazio";
        formValido = false;
    }else{
        if (form.nome.value[0] == " "){
            spanText.textContent = "Nome não pode começar com espaço";
            form.nome.style.border = "2px solid red";
            formValido = false;
        }else{
            let index = form.nome.value.indexOf(" ");
            if(index == -1){
                spanText.textContent = "Escreva nome e sobrenome";
                form.nome.style.border = "2px solid red";
                formValido = false;
            }else if(form.nome.value.charAt(index+1) == ""){
                spanText.textContent = "Escreva nome e sobrenome";
                form.nome.style.border = "2px solid red";
                formValido = false;
            }
        }
    }
    if(formValido){
        mensagem += "Nome: " + form.nome.value + "\n";
    }
    

    spanText = form.cpf.nextElementSibling;
    spanText.textContent = "";

    if(form.cpf.value == ""){
        spanText.textContent = "CPF Vazio";
        form.cpf.style.border = "2px solid red";
        formValido = false;
    }else if(form.cpf.value.length != 11){
        spanText.textContent = "CPF precisa conter 11 digitos, sem ponto nem traço";
        form.cpf.style.border = "2px solid red";
        formValido = false;
    }
    if(formValido){
        mensagem += "CPF: " + form.cpf.value + "\n";
    }
    

    spanText = form.email.nextElementSibling;
    spanText.textContent = "";

    let index = form.email.value.indexOf("@");

    if(index < 1){
        spanText.textContent = "Email inexistente";
        form.email.style.border = "2px solid red";
        formValido = false;
    }else if(form.email.value.indexOf(".", index) <= index+3){
        spanText.textContent = "Dominio de email inexistente";
        form.email.style.border = "2px solid red";
        formValido = false;
    }
    

    if(formValido){
        mensagem += "Email: " + form.email.value + "\n";
        mensagem += "Data Nascimento: " + form.dataNasc.value + "\n";
        mensagem += "Telefone: " + form.telefone.value + "\n";
        mensagem += "Aluno da Academia?: " + form.aluno.value + "\n";
    }
    
    let textoAtividade = document.getElementById("activiti");
    textoAtividade.textContent = "";

    let checkboxMalhacao = document.querySelector("#malhacao");
    let checkboxPilates = document.querySelector("#pilates");
    let checkboxZumba = document.querySelector("#zumba");

    // Verifica se a checkbox está marcada
    if (!checkboxMalhacao.checked && !checkboxPilates.checked && !checkboxZumba.checked) {
        textoAtividade.textContent = "Você não selecionou nenhuma atividade";
    }
    spanText = form.nextElementSibling;
    spanText.textContent = "";

    if(formValido){
        mensagem += "Atividade(s): " + form.atividade.value + "\n";
        mensagem += "Assunto: " + form.contactAbout.value + "\n";
        mensagem += "Mensagem: " + form.msg.value + "\n";
        spanText.textContent = mensagem;
    }else{
        e.preventDefault();
    }
    e.preventDefault();
}
