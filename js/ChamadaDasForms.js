var cadastroAluno;
var cadastroFuncionario;
var cadastroAgenda;
var cadastroAtividadeExtraCurricular;
var cadastroCaracteristicaSaude;
var cadastroCargoFuncionario;
var cadastroCronograma;
var cadastroGrauEscolar;
var cadastroItensDeCronograma;
var cadastroItensPorCronograma;
var cadastroMatricula;
var cadastroPeriodo;
var cadastroProntuarioAluno;
var cadastroResponsavel;
var cadastroTipoUsuario;
var cadastroTurma;

/*Edicao*/

var edicaoAluno;
var edicaoFuncionario;
var edicaoAgenda;
var edicaoAtividadeExtraCurricular;
var edicaoCaracteristicaSaude;
var edicaoCargoFuncionario;
var edicaoCronograma;
var edicaoGrauEscolar;
var edicaoItensDeCronograma;
var edicaoItensPorCronograma;
var edicaoMatricula;
var edicaoPeriodo;
var edicaoProntuarioAluno;
var edicaoResponsavel;
var edicaoTipoUsuario;
var edicaoTurma;


window.onload = function () {
    cadastroAluno = document.getElementById("cadastroAluno");
    cadastroFuncionario = document.getElementById("cadastroFuncionario");
    cadastroAgenda = document.getElementById("cadastroAgenda");
    cadastroAtividadeExtraCurricular = document.getElementById("cadastroAtividadeExtraCurricular");
    cadastroCaracteristicaSaude = document.getElementById("cadastroCaracteristicaSaude");
    cadastroCargoFuncionario = document.getElementById("cadastroCargoFuncionario");
    cadastroCronograma = document.getElementById("cadastroCronograma");
    cadastroGrauEscolar = document.getElementById("cadastroGrauEscolar");
    cadastroItensDeCronograma = document.getElementById("cadastroItensDeCronograma");
    cadastroItensPorCronograma = document.getElementById("cadastroItensPorCronograma");
    cadastroMatricula = document.getElementById("cadastroMatricula");
    cadastroPeriodo = document.getElementById("cadastroPeriodo");
    cadastroProntuarioAluno = document.getElementById("cadastroProntuarioAluno");
    cadastroResponsavel = document.getElementById("cadastroResponsavel");
    cadastroTipoUsuario = document.getElementById("cadastroTipoUsuario");
    cadastroTurma = document.getElementById("cadastroTurma");
    
    /*edicao*/
    
    edicaoAluno = document.getElementById("edicaoAluno");
    
    edicaoFuncionario = document.getElementById("edicaoFuncionario");
    
    edicaoAgenda = document.getElementById("edicaoAgenda");
    
    edicaoAtividadeExtraCurricular = document.getElementById("edicaoAtividadeExtraCurricular");
    
    edicaoCaracteristicaSaude = document.getElementById("edicaoCaracteristicaSaude");
    
    edicaoCargoFuncionario = document.getElementById("edicaoCargoFuncionario");
    
    edicaoCronograma = document.getElementById("edicaoCronograma");
    
    edicaoGrauEscolar = document.getElementById("edicaoGrauEscolar");
    
    edicaoItensDeCronograma = document.getElementById("edicaoItensDeCronograma");
    
    edicaoItensPorCronograma = document.getElementById("edicaoItensPorCronograma");
    
    edicaoMatricula = document.getElementById("edicaoMatricula");
    
    edicaoPeriodo = document.getElementById("edicaoPeriodo");
    
    edicaoProntuarioAluno = document.getElementById("edicaoProntuarioAluno");
    
    edicaoResponsavel = document.getElementById("edicaoResponsavel");
    
    edicaoTipoUsuario = document.getElementById("edicaoTipoUsuario");
    
    edicaoTurma = document.getElementById("edicaoTurma");
    
    /*------*/

    var btnCadastroAluno = document.getElementById("btnCadastroAluno");
    btnCadastroAluno.onclick = mostraCadastroAluno;

    var btnCadastroFuncionario = document.getElementById("btnCadastroFuncionario");
    btnCadastroFuncionario.onclick = mostraCadastroFuncionario;

    var btnCadastroAgenda = document.getElementById("btnCadastroAgenda");
    btnCadastroAgenda.onclick = mostraCadastroAgenda;

    var btnCadastroAtividadeExtraCurricular = document.getElementById("btnCadastroAtividadeExtraCurricular");
    btnCadastroAtividadeExtraCurricular.onclick = mostraCadastroAtividadeExtraCurricular;

    var btnCaracteristicaSaúde = document.getElementById("btnCaracteristicaSaúde");
    btnCaracteristicaSaúde.onclick = mostraCaracteristicaSaúde;

    var btnCargoFuncionario = document.getElementById("btnCargoFuncionario");
    btnCargoFuncionario.onclick = mostraCargoFuncionario;

    var btnCronograma = document.getElementById("btnCronograma");
    btnCronograma.onclick = mostraCronograma;

    var btnGrauEscolar = document.getElementById("btnGrauEscolar");
    btnGrauEscolar.onclick = mostraGrauEscolar;

    var btnItensDoCronograma = document.getElementById("btnItensDoCronograma");
    btnItensDoCronograma.onclick = mostraItensDoCronograma;

    var btnItensPorCronograma = document.getElementById("btnItensPorCronograma");
    btnItensPorCronograma.onclick = mostraItensPorCronograma;

    var btnMatricula = document.getElementById("btnMatricula");
    btnMatricula.onclick = mostraMatricula;

    var btnPeriodo = document.getElementById("btnPeriodo");
    btnPeriodo.onclick = mostraPeriodo;

    var btnProntuarioAluno = document.getElementById("btnProntuarioAluno");
    btnProntuarioAluno.onclick = mostraProntuarioAluno;

    var btnResponsavel = document.getElementById("btnResponsavel");
    btnResponsavel.onclick = mostraResponsavel;

    var btnTipoUsuario = document.getElementById("btnTipoUsuario");
    btnTipoUsuario.onclick = mostraTipoUsuario;

    var btnTurma = document.getElementById("btnTurma");
    btnTurma.onclick = mostrabtnTurma;
    
    /*edicao*/
    
    var btnEdicaoAluno = document.getElementById("btnEdicaoAluno");
    btnEdicaoAluno.onclick = mostraEdicaoAluno;
    
    var btnEditarFuncionario = document.getElementById("btnEditarFuncionario");
    btnEditarFuncionario.onclick = mostraEdicaoFuncionario;
    
    var btnEditarAgenda = document.getElementById("btnEditarAgenda");
    btnEditarAgenda.onclick = mostraEdicaoAgenda;
    
    var btnEditarAtividadeExtraCurricular = document.getElementById("btnEditarAtividadeExtraCurricular");
    btnEditarAtividadeExtraCurricular.onclick = mostraEdicaoAtividadeExtraCurricular;
    
    var btnEditarCaractSaude = document.getElementById("btnEditarCaractSaude");
    btnEditarCaractSaude.onclick = mostraEdicaoCaractSaude;
    
    var btnEditarCargoFuncionario = document.getElementById("btnEditarCargoFuncionario");
    btnEditarCargoFuncionario.onclick = mostraEdicaoCargoFuncionario;
    
    var btnEditarCronograma = document.getElementById("btnEditarCronograma");
    btnEditarCronograma.onclick = mostraEdicaoCronograma;
    
    var btnEditarGrauEscolar = document.getElementById("btnEditarGrauEscolar");
    btnEditarGrauEscolar.onclick = mostraEdicaoGrauEscolar;
    
    var btnEditarItensCronograma = document.getElementById("btnEditarItensCronograma");
    btnEditarItensCronograma.onclick = mostraEdicaoItensCronograma;
    
    var btnEditarItensPorCronograma = document.getElementById("btnEditarItensPorCronograma");
    btnEditarItensPorCronograma.onclick = mostraEdicaoItensPorCronograma;
    
    var btnEditarMatricula = document.getElementById("btnEditarMatricula");
    btnEditarMatricula.onclick = mostraEdicaoMatricula;
    
    var btnEditarPeriodo = document.getElementById("btnEditarPeriodo");
    btnEditarPeriodo.onclick = mostraEdicaoPeriodo;
    
    var btnEditarProntuarioAluno = document.getElementById("btnEditarProntuarioAluno");
    btnEditarProntuarioAluno.onclick = mostraEdicaoProntuarioAluno;
    
    var btnEditarResponsavel = document.getElementById("btnEditarResponsavel");
    btnEditarResponsavel.onclick = mostraEdicaoResponsavel;
    
    var btnEditarTipoUsuario = document.getElementById("btnEditarTipoUsuario");
    btnEditarTipoUsuario.onclick = mostraEdicaoTipoUsuario;
    
    var btnEditarTurma = document.getElementById("btnEditarTurma");
    btnEditarTurma.onclick = mostraEdicaoTurma;
    
    
    /*------*/

    cadastroAluno.classList.add("escondido");
    cadastroFuncionario.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");
    
    /*edicao*/
    
    edicaoAluno.classList.add("escondido");
    
    edicaoFuncionario.classList.add("escondido");
    
    edicaoAgenda.classList.add("escondido");
    
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    
    edicaoCaracteristicaSaude.classList.add("escondido");
    
    edicaoCargoFuncionario.classList.add("escondido");
    
    edicaoCronograma.classList.add("escondido");
    
    edicaoGrauEscolar.classList.add("escondido");
    
    edicaoItensDeCronograma.classList.add("escondido");
    
    edicaoItensPorCronograma.classList.add("escondido");
    
    edicaoMatricula.classList.add("escondido");
    
    edicaoPeriodo.classList.add("escondido");
    
    edicaoProntuarioAluno.classList.add("escondido");
    
    edicaoResponsavel.classList.add("escondido");
    
    edicaoTipoUsuario.classList.add("escondido");
    
    edicaoTurma.classList.add("escondido");
    
    /*------*/

}

function mostraCadastroAluno() {
    cadastroAluno.classList.remove("escondido");
    cadastroFuncionario.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");
    edicaoFuncionario.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}

function mostraCadastroFuncionario() {
    cadastroFuncionario.classList.remove("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}

function mostraCadastroAgenda(){
    cadastroAgenda.classList.remove("escondido");
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}

function mostraCadastroAtividadeExtraCurricular(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.remove("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraCaracteristicaSaúde(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.remove("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}

function mostraCargoFuncionario(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.remove("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraCronograma(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.remove("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraGrauEscolar(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.remove("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraItensDoCronograma(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.remove("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraItensPorCronograma(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.remove("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraMatricula(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.remove("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraPeriodo(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.remove("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraProntuarioAluno(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.remove("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraResponsavel(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.remove("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.add("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostraTipoUsuario(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.remove("escondido");
    cadastroTurma.classList.add("escondido"); 
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTurma.classList.add("escondido");
}
function mostrabtnTurma(){
    cadastroFuncionario.classList.add("escondido");
    cadastroAluno.classList.add("escondido");
    cadastroAgenda.classList.add("escondido");
    cadastroAtividadeExtraCurricular.classList.add("escondido");
    cadastroCaracteristicaSaude.classList.add("escondido");
    cadastroCargoFuncionario.classList.add("escondido");
    cadastroCronograma.classList.add("escondido");
    cadastroGrauEscolar.classList.add("escondido");
    cadastroItensDeCronograma.classList.add("escondido");
    cadastroItensPorCronograma.classList.add("escondido");
    cadastroMatricula.classList.add("escondido");
    cadastroPeriodo.classList.add("escondido");
    cadastroProntuarioAluno.classList.add("escondido");
    cadastroResponsavel.classList.add("escondido");
    cadastroTipoUsuario.classList.add("escondido");
    cadastroTurma.classList.remove("escondido");  
    edicaoFuncionario.classList.add("escondido");
    edicaoAluno.classList.add("escondido");
    edicaoAgenda.classList.add("escondido");
    edicaoAtividadeExtraCurricular.classList.add("escondido");
    edicaoCaracteristicaSaude.classList.add("escondido");
    edicaoCargoFuncionario.classList.add("escondido");
    edicaoCronograma.classList.add("escondido");
    edicaoGrauEscolar.classList.add("escondido");
    edicaoItensDeCronograma.classList.add("escondido");
    edicaoItensPorCronograma.classList.add("escondido");
    edicaoMatricula.classList.add("escondido");
    edicaoPeriodo.classList.add("escondido");
    edicaoProntuarioAluno.classList.add("escondido");
    edicaoResponsavel.classList.add("escondido");
    edicaoTipoUsuario.classList.add("escondido");
}

/*edicao*/

function mostraEdicaoAluno() {
    edicaoAluno.classList.remove("escondido");
}

function mostraEdicaoFuncionario() {
    edicaoFuncionario.classList.remove("escondido");
}

function mostraEdicaoAgenda() {
    edicaoAgenda.classList.remove("escondido");
}

function mostraEdicaoAtividadeExtraCurricular() {
    edicaoAtividadeExtraCurricular.classList.remove("escondido");
}

function mostraEdicaoCaractSaude(){
    edicaoCaracteristicaSaude.classList.remove("escondido");
}

function mostraEdicaoCargoFuncionario(){
    edicaoCargoFuncionario.classList.remove("escondido");
}

function mostraEdicaoCronograma(){
    edicaoCronograma.classList.remove("escondido");
}

function mostraEdicaoGrauEscolar(){
    edicaoGrauEscolar.classList.remove("escondido");
}

function mostraEdicaoItensCronograma(){
    edicaoItensDeCronograma.classList.remove("escondido");
}

function mostraEdicaoItensPorCronograma(){
    edicaoItensPorCronograma.classList.remove("escondido");
}

function mostraEdicaoMatricula(){
    edicaoMatricula.classList.remove("escondido");
}

function mostraEdicaoPeriodo(){
    edicaoPeriodo.classList.remove("escondido");
}

function mostraEdicaoProntuarioAluno(){
    edicaoProntuarioAluno.classList.remove("escondido");
}

function mostraEdicaoResponsavel(){
    edicaoResponsavel.classList.remove("escondido");
}

function mostraEdicaoTipoUsuario(){
    edicaoTipoUsuario.classList.remove("escondido");
}

function mostraEdicaoTurma(){
    edicaoTurma.classList.remove("escondido");
}


/*-----*/
