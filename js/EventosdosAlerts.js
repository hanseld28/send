function AlertSucesso(){
    this.render = function(dialog){
        var modal= document.getElementById('modal');
        var caixaDialogo= document.getElementById('caixaDialogo');
        
        modal.style.display = "block";
        caixaDialogo.style.display = "block";

        
        
        document.getElementById('caixaDialogoCorpo').innerHTML = dialog;
        document.getElementById('caixaDialogoRodape').innerHTML = '<button onclick="Alert.ok()">OK</button>';

    }
    this.ok = function(){
        document.getElementById('modal').style.display = "none";
        document.getElementById('caixaDialogo').style.display = "none";
    }
}
var Alert = new AlertSucesso();



function AlertErro(){
    this.render = function(dialog){
        var modal= document.getElementById('modalErro');
        var caixaDialogo= document.getElementById('caixaDialogoErro');
        
        modalErro.style.display = "block";
        caixaDialogoErro.style.display = "block";

        
        
        document.getElementById('caixaDialogoCorpoErro').innerHTML = dialog;
        document.getElementById('caixaDialogoRodapeErro').innerHTML = '<button onclick="AlertdeErro.okErro()">OK</button>';

    }
    this.okErro = function(){
        document.getElementById('modalErro').style.display = "none";
        document.getElementById('caixaDialogoErro').style.display = "none";
    }
}
var AlertdeErro = new AlertErro();

