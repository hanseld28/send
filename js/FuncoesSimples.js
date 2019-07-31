/*Função Para a troca de cor dos Botões (Pesquisar e Cadastrar)*/

/*Fim Função Para a troca de cor dos Botões (Pesquisar e Cadastrar)*/


/*Função Para mostrar os itens de info, ajuda e contato media queries em max-width 1500px*/
var veri = 1;
var trigger = document.getElementById('expandItensLateral').addEventListener("click", function () {
    var menu = document.getElementById('rodape');
    if (veri == 1) {
        menu.style.left = "4%";
        veri = 0;
    } else {
        menu.style.left = "-60%";
        veri = 1;
    }
})
/*FIM Função Para mostrar os itens de info, ajuda e contato media queries em max-width 1500px*/


/*Função de mover a div de ajuda*/

$(document).ready(function () {
    $("#ajuda").draggable({
        containment: "parent"
    });
});

/*FIM Função de mover a div de ajuda*/

/*Função de abrir e fechar a div de ajuda*/
$(function () {
    $('.fecharAjuda').click(function () {
        $('#ajuda').hide();
    })
    $('.btn-ajuda').click(function () {
        $('#ajuda').show();
    })
        $('.demaisCadastros').click(function () {
        $('#painelGeralCadastrosAuxiliares').show();
    })
        $('.fecharCadastrosAuxiliares').click(function () {
        $('#painelGeralCadastrosAuxiliares').hide();
    })
})
/*FIM Função de abrir e fechar a div de ajuda*/


/*Função para aparecer e desaparecer a mensagem de boas vindas*/
function mensagemBoasVindas() {
    $('#balao').fadeIn(2000);
    $('#balao').delay(2200);
    $('#balao').fadeOut(1000);
}

/*Fim Função para aparecer e desaparecer a mensagem de boas vindas*/

/*Função para Abrir e Fechar informações*/
$(function () {
    $('.fecharInfo, .modalInfo').click(function () {
        $('.modalInfo').hide();
    })
    $('.btn-info').click(function () {
        $('.modalInfo').show();
    })
})

/*FIM Função para Abrir e Fechar informações*/

/*Função para Abrir e Fechar jogo*/
$(function () {
    $('.fecharGame, #modalGame').click(function () {
        $('#modalGame').hide();
    })
    $('.game').click(function () {
        $('#modalGame').show();
    })
})

/*FIM Função para Abrir e Fechar jogo*/

/*Função Relógio*/
var clock = document.getElementById('real-clock');


setInterval(function () {
    clock.innerHTML = ((new Date).toLocaleString().substr(11, 8));
}, 1000);

/*Fim Função Relógio*/

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(E($){$.14.q=E(1s){m o=$.1S({},$.14.q.1q,1s);l(o.s==\'B\'){m Z=[\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'-\',\'+\',\'*\',\'/\',\'(\',\')\',\'^\',\'%\']}p{m Z=[\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'-\',\'+\',\'*\',\'/\']}l(!o.1l){m N=\'<1k f="1j" s="Q/v" g="\'+o.v+\'1T.v" />\';N+=\'<!--[l 1V 1X 9]><1k f="1j" s="Q/v" g="\'+o.v+\'1B.v" />\';N+=\'<t s="Q/v">\';N+=\'.16 a, .16, .16 D 1h[s=Q] { 20:21("\'+o.v+\'22.1z"); 1g:1G; }\';N+=\'</t><![1H]-->\';$(\'1I\').1f(N)}m D=\'<D 1O="1Q" 1R="h:j(0)" 1e="1W"><1d>\';D+=\'<1t 19="q">\'+o.G.b+\'</1t>\';D+=\'<1h s="Q" 1A="q" 1e="q"/></1d></D>\';$(R).1C(\'q\');$(R).1D(D);m e=\'<a g="h:j(0)" k="\'+o.G.18+\'" t="F:1n; K:0;" f="<">&2h;</a>\';l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="\'+o.G.M+\'" f="c">C</a>\';e+=\'<a g="h:j(0)" k="(" f="(">(</a>\';e+=\'<a g="h:j(0)" k=")" f=")">)</a>\'}p{e+=\'<a g="h:j(0)" k="\'+o.G.M+\'" f="c" t="F:1U;">\'+o.G.M+\'</a>\'}e+=\'<a g="h:j(0)" k="7" t="K:0;" f="7">7</a>\';e+=\'<a g="h:j(0)" k="8" f="8">8</a>\';e+=\'<a g="h:j(0)" k="9" f="9">9</a>\';l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="/" f="/">/</a>\';e+=\'<a g="h:j(0)" k="%" f="%">%</a>\'}p{e+=\'<a g="h:j(0)" k="/" f="/" t="F:X;">/</a>\'}e+=\'<a g="h:j(0)" k="4" t="K:0;" f="4">4</a>\';e+=\'<a g="h:j(0)" k="5" f="5">5</a>\';e+=\'<a g="h:j(0)" k="6" f="6">6</a>\';l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="*" f="*">*</a>\';e+=\'<a g="h:j(0)" k="15" f="15">y<1c>x</1c></a>\'}p{e+=\'<a g="h:j(0)" k="*" f="*" t="F:X;">*</a>\'}e+=\'<a g="h:j(0)" k="1" t="K:0;" f="1">1</a>\';e+=\'<a g="h:j(0)" k="2" f="2">2</a>\';e+=\'<a g="h:j(0)" k="3" f="3">3</a>\';l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="-" f="-">-</a>\'}p{e+=\'<a g="h:j(0)" k="-" f="-" t="F:X;">-</a>\'}e+=\'<11 1m="M"></11>\';l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="0" t="F:1n; K:0;" f="0">0</a>\'}p{e+=\'<a g="h:j(0)" k="0" f="0" t="K:0;">0</a>\'}e+=\'<a g="h:j(0)" k="," f=",">,</a>\';l(o.s==\'1r\'){e+=\'<a g="h:j(0)" k="=" f="=">=</a>\'}l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="+" f="+">+</a>\'}p{e+=\'<a g="h:j(0)" k="+" f="+" t="F:X;">+</a>\'}l(o.s==\'B\'){e+=\'<a g="h:j(0)" k="=" f="=" t="25:2b; 2c-2d:2f;\'+\'1g:1u; 1v:1w; 1x:1y;">=</a>\'}e+=\'<11 1m="M"></11>\';$(R).1f(e);l(o.1a){$(\'.q\').1b(E(17){m u=L.1E(17.1F);m b=$(\'#q\').z();l(!13(Z,u)){H I}})}p{$(\'#q\').1b(E(17){H I})}$(\'.q a\').1K(E(){m u=$(R).1L(\'f\');m b=$(\'#q\').z();l(13(Z,u)){$(\'#q\').z(b+u)}p{l(u==\'c\'){$(\'#q\').z(1M)}p l(u==\'15\'){$(\'#q\').z(b+\'^\')}p l(u==\'<\'){$(\'#q\').z(b.1N(0,b.W-1))}p l(u==\'%\'){$(\'#q\').z(b+\'%\')}p l(u==\',\'){$(\'#q\').z(b+\'.\')}p l(u==\'=\'){1P{m 10=/\\d+\\^\\d+/;O(J(b,\'^\',0)){l(10.V(b)){m w=L(b.T(10));m n=w.P(\'^\');b=b.A(10,1Y.1Z(n[0],n[1]))}p{U}}m r=/\\d+\\*\\d+\\%/;O(J(b,\'%\',0)){l(r.V(b)){m w=L(b.T(r));m n=w.P(\'*\');n[1]=n[1].A(\'%\',\'\');b=b.A(r,n[0]*(n[1]/Y))}p{U}}r=/\\d+\\+\\d+\\%/;O(J(b,\'%\',0)){l(r.V(b)){m w=L(b.T(r));m n=w.P(\'+\');n[1]=n[1].A(\'%\',\'\');b=b.A(r,1o(n[0])+(n[0]*(n[1]/Y)))}p{U}}r=/\\d+\\-\\d+\\%/;O(J(b,\'%\',0)){l(r.V(b)){m w=L(b.T(r));m n=w.P(\'-\');n[1]=n[1].A(\'%\',\'\');b=b.A(r,1o(n[0])-(n[0]*(n[1]/Y)))}p{U}}r=/\\d+\\/\\d+\\%/;O(J(b,\'%\',0)){l(r.V(b)){m w=L(b.T(r));m n=w.P(\'/\');n[1]=n[1].A(\'%\',\'\');b=b.A(r,n[0]/(n[1]/Y))}p{U}}$(\'#q\').z(23(b))}24(1p){26(1p.27)}}}});H R};$.14.q.1q={s:\'1r\',1a:I,1l:I,v:\'v/\',G:{b:\'28\',18:\'29\',M:\'2a\'}};E 13(S,12){m W=S.W;19(m i=0;i<W;i++){l(S[i]==12)H 2e}H I};E J(S,12,1i){m i=(S+\'\').2g(12,(1i||0));H i===-1?I:i}})(1J);',62,142,'|||||||||||value|||lines|rel|href|javascript||void|title|if|var|numbers|settings|else|blackCalculator|percentPattern|type|style|button|css|elements|||val|replace|advanced||form|function|width|language|return|false|strpos|margin|String|clear|styles|while|split|text|this|haystack|match|break|test|length|57px|100|whiteList|powPattern|div|needle|inArray|fn|yx|calculator|event|backspace|for|allowKeyboard|keypress|sup|fieldset|id|append|position|input|offset|stylesheet|link|cssManual|class|58px|parseFloat|err|defaults|simple|options|label|absolute|bottom|1px|right|14px|htc|name|black_calculator_ie|addClass|prepend|fromCharCode|charCode|relative|endif|head|jQuery|click|attr|null|substr|method|try|post|action|extend|black_calculator|101px|lt|blackCalculatorForm|IE|Math|pow|behavior|url|PIE|eval|catch|height|alert|message|Value|Backspace|Clear|40px|padding|top|true|35px|indexOf|lArr'.split('|'),0,{}))

    
        window.addEventListener('load', function() {
            vanillaCalendar.init({
                disablePastDays: true
            });
        })
    
    
        $(document).ready(function() {
            var langs = {
                value: 'Valor',
                clear: 'Limpar',
                backspace: 'Voltar'
            };
            $('.calculator').blackCalculator({
                type: 'simple',
                allowKeyboard: true,
                language: langs
            });
        });
 



/**
 * Simple JS Clock
 */
(function() {

  var Clock = function () {
    
    var el = document.querySelector('#js-clock');
    
    /**
     * Time Format
     */
    var timeFormat = new Date().toLocaleTimeString([], {
      hour: '2-digit',
      minute:'2-digit',
      
    });
     
    /** 
     * Render Util
     */
    render = function(template, node) {
      
      if (!node) return;
      node.innerHTML = (typeof template === 'function' ? template() : template);
      
      var event = new CustomEvent('elementRenderer', {
        bubbles: true
      });
      
      node.dispatchEvent(event);
      return node;
    };
    
    /**
     * Pass vars to out Render Util
     */
    render(timeFormat, el);
  }
  
  /**
   * Start the Clock Interval
   */
  window.setInterval(Clock, 1000);

}());


var reset = true;
function zero() {
	if (reset) {
		document.getElementById("output").value = "0";
		reset = false;
	}
	else {
		document.getElementById("output").value += "0";
	}
}
function one() {
	if (reset) {
		document.getElementById("output").value = "1";
		reset = false;
	}
	else {
		document.getElementById("output").value += "1";
	}
}
function two() {
	if (reset) {
		document.getElementById("output").value = "2";
		reset = false;
	}
	else {
		document.getElementById("output").value += "2";
	}
}
function three() {
	if (reset) {
		document.getElementById("output").value = "3";
		reset = false;
	}
	else {
		document.getElementById("output").value += "3";
	}
}
function four() {
	if (reset) {
		document.getElementById("output").value = "4";
		reset = false;
	}
	else {
		document.getElementById("output").value += "4";
	}
}
function five() {
	if (reset) {
		document.getElementById("output").value = "5";
		reset = false;
	}
	else {
		document.getElementById("output").value += "5";
	}
}
function six() {
	if (reset) {
		document.getElementById("output").value = "6";
		reset = false;
	}
	else {
		document.getElementById("output").value += "6";
	}
}
function seven() {
	if (reset) {
		document.getElementById("output").value = "7";
		reset = false;
	}
	else {
		document.getElementById("output").value += "7";
	}
}
function eight() {
	if (reset) {
		document.getElementById("output").value = "8";
		reset = false;
	}
	else {
		document.getElementById("output").value += "8";
	}
}
function nine() {
	if (reset) {
		document.getElementById("output").value = "9";
		reset = false;
	}
	else {
		document.getElementById("output").value += "9";
	}
}
function decimal() {
	if (reset) {
		document.getElementById("output").value = ".";
		reset = false;
	}
	else {
		document.getElementById("output").value += ".";
	}
}
function AC() {
	document.getElementById("output").value = "0";
	reset = true;
}
function plusMinus() {
	document.getElementById("output").value = -(document.getElementById("output").value);
	reset = true;
}
function percent() {
	document.getElementById("output").value = document.getElementById("output").value / 100;
	reset = true;
}
function add() {
	document.getElementById("output").value += "+";
	reset = false;
}
function subtract() {
	document.getElementById("output").value += "-";
	reset = false;
}
function multiply() {
	document.getElementById("output").value += "*";     //"\xD7";
	reset = false;
}
function divide() {
	document.getElementById("output").value += "/";  //"\xF7";
	reset = false;
}
function equals() {
	var result = eval(document.getElementById("output").value);
	document.getElementById("output").value = result;
	reset = true;
}







       


