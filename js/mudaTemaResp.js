/*Muda tema do Professor*/

function applyTheme (theme) {
   "use strict"
    document.getElementById("mypageResp").className = theme;
    localStorage.setItem ("theme", theme);

   // altera o texto do botão para o outro tema
   document.getElementById("btnResp").textContent = (theme == "Ativado" ? "Desativado" : "Ativado");
}

function addButtonLestenrs () {
   "use strict"
   document.getElementById("btnResp").addEventListener("click", function(){
      applyTheme(document.getElementById("mypageResp").className == "Ativado" ? "Desativado" : "Ativado");
   });
}

function initiate(){
   "use strict"

    if(typeof(localStorage)===undefined)
        alert("Essa Função não Funciona neste Navegador");
    else{
      applyTheme( localStorage.getItem("theme") ? localStorage.getItem("theme") : "Desativado" );
    }
    addButtonLestenrs();
}

initiate();

/*Fim muda tema do Professor*/