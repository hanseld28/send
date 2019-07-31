$(document).ready(function () {
    
    $("input").on("focus", function(event) {//foca na caixa de texto...
        
    const div = $(this).parent(".caixaTexto");//criei duas constantes...pai e a filha
    const label = div.children("label");
    
    label.css("margin-left", "16.5%");//quando focar na caixa de texto, a label sobe e fica a esquerda;
    label.css("margin-top", "-10.5%");
  });
  
  $("input").on("blur", function(event) {//quando a caixa de texto não ficar focada...
      
    const div = $(this).parent(".caixaTexto");//msm coisa ...criei duas constantes...pai e a filha
    const label = div.children("label");
    
    if ($(this).val().length == 0) {
      label.css("margin-left", "18%");//as label voltam as suas posições originais...
      label.css("margin-top", "-6.5%");
    }
  });
});



//Inicio - Método: chamar a div de formulário
function formResp(){
document.getElementById('fundoResp').style.display = "block";
}

function formTipoUsuario(){
document.getElementById('fundoTipoUser').style.display = "block";
}

function formFuncionario(){
document.getElementById('fundoFunc').style.display = "block";
}

function formFuncionarioCargo(){
document.getElementById('fundoCargoFunc').style.display = "block";
}

function formAluno(){
document.getElementById('fundoAluno').style.display = "block";
}

function formGrauEscolar(){
document.getElementById('fundoGrauEscolar').style.display = "block";
}

function formCaracteristicaSaude(){
document.getElementById('fundoCaracteristicaSaude').style.display = "block";
}

function formPeriodo(){
document.getElementById('fundoPeriodo').style.display = "block";
}

function formAtividadeExtraCurricular(){
document.getElementById('fundoAtividadeExtraCurricular').style.display = "block";
}

function formAgenda(){
document.getElementById('fundoAgenda').style.display = "block";
}

function formCronograma(){
document.getElementById('fundoCronograma').style.display = "block";
}

function formItensCronograma(){
document.getElementById('fundoItensCronograma').style.display = "block";
}


function formItensPorCronograma(){
document.getElementById('fundoItensPorCronograma').style.display = "block";
}

function formProntuarioAluno(){
document.getElementById('fundoProntuarioAluno').style.display = "block";
}

function formMatricula(){
document.getElementById('fundoMatricula').style.display = "block";
}

function formTurma(){
document.getElementById('fundoTurma').style.display = "block";
}

function formCadastrarUsuario(){
    document.getElementById('fundoCadastrarUsuario').style.display = "block";
}