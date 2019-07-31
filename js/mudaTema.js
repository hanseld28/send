/*Muda tema do Administrador*/

function applyTheme (theme) {
   "use strict"
    document.getElementById("mypage").className = theme;
    localStorage.setItem ("theme", theme);

   // altera o texto do botão para o outro tema
   document.getElementById("b1").textContent = (theme == "Ativado" ? "Desativado" : "Ativado");
}

function addButtonLestenrs () {
   "use strict"
   document.getElementById("b1").addEventListener("click", function(){
      applyTheme(document.getElementById("mypage").className == "Ativado" ? "Desativado" : "Ativado");
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

/*Fim muda tema do administrador*/


