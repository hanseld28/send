/*Muda tema do Professor*/

function applyTheme (theme) {
   "use strict"
    document.getElementById("mypageProf").className = theme;
    localStorage.setItem ("theme", theme);

   // altera o texto do botão para o outro tema
   document.getElementById("btnProf").textContent = (theme == "Ativado" ? "Desativado" : "Ativado");
}

function addButtonLestenrs () {
   "use strict"
   document.getElementById("btnProf").addEventListener("click", function(){
      applyTheme(document.getElementById("mypageProf").className == "Ativado" ? "Desativado" : "Ativado");
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