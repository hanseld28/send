<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php
include_once("verificaUsuarioLogado.php");
  //include_once("../Controller/ControllerComunicado.php");
include_once("../Controller/ProfessorTurmaCRUD.php");

if(!isset($_SESSION))
{
  session_start();
}

$id_usuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;
$nome_usuario = (isset($_SESSION['nomeUsuario'])) ? $_SESSION['nomeUsuario'] : null ;

$id_turma = (isset($_POST['codigoturma'])) ? intval($_POST['codigoturma']) : null ;

$controllerProfessor = new ProfessorTurmaCRUD();
$nomeTurma = $controllerProfessor->consultarNomeTurma($id_turma); 

?>


<html>
<meta charset="utf-8">
<head>
    <title></title>
    
    
    <script>
    
    $('.btnVerTodasRotinasDeterminadaTurma').click(function(){
       if($('.btnVerTodasRotinasDeterminadaTurma').css('background-color')=='transparent'){
          $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','#ffffff');
         $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','transparent');
         $('.btnNovoComunicado').css('background-color','transparent');
    }else{
         $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','#ffffff');
         $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','transparent');  
         $('.btnNovoComunicado').css('background-color','transparent');  
    }
})
    
$('.btnVerComunicadosRecentesDeterminadaTurma').click(function(){
       if($('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color')=='#ffffff'){
          $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','transparent');
          $('.btnNovoComunicado').css('background-color','transparent');
         $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','#ffffff');
    }else{
         $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','#ffffff');
         $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','transparent');  
         $('.btnNovoComunicado').css('background-color','transparent');  
    }
})
   
$('.btnNovoComunicado').click(function(){
       if($('.btnNovoComunicado').css('background-color')=='#ffffff'){
          $('.btnNovoComunicado').css('background-color','transparent');
          $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','transparent');
         $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','#ffffff');
    }else{
         $('.btnNovoComunicado').css('background-color','#ffffff');
         $('.btnVerTodasRotinasDeterminadaTurma').css('background-color','transparent');  
         $('.btnVerComunicadosRecentesDeterminadaTurma').css('background-color','transparent');  
    }
})
  s

</script>

   
</head>
<body>
    <div class="telaComunicado">
        <div class="topoTelaComunicado">
            <div class="iconeComunicadoElabel">
                <img class="iconComunicado" src="../Imagens/iconeComunicadoProfessor.png"><label class="lblTopoComunicado">Comunicado</label>
            </div>
            <a href="#" class="iconeRetornaparaabasturmasalunos" onclick="voltarPageAnterior(<?php echo($id_usuario); ?>)">
                <img src="../Imagens/iconeSetaRetornoAbaTurmas.png" class="iconSetaRetornaparaabasturmasalunos">
            </a>
        </div>
        <div class="conteudoTelaComunicado">
            <div class="menuComunicado">
                <a class="btnNovoComunicado" href="#" onclick="carregaNovoComunicado(<?php echo($id_turma); ?>)">
                    <img class="iconNovoComunicado" src="../Imagens/iconeNovoComunicado.png">
                    <label class="lblNovoComunicado">Novo</label>
                </a>

                <a class="btnVerTodasRotinasDeterminadaTurma" href="#" onclick="carregaComunicadosEnviados(<?php echo($id_usuario); ?>, <?php echo($id_turma); ?>)">
                    <img class="iconTodosComunicados" src="../Imagens/iconeTodosComunicadosDeterminadaTurma.png">
                    <label class="lblTodosComunicadosDeterminadaTurma">Todos</label>
                </a>
                <a class="btnVerComunicadosRecentesDeterminadaTurma" href="#" onclick="carregaComunicadosRecentes(<?php echo($id_turma); ?>)">
                    <img class="iconRecentesComunicados" src="../Imagens/iconeDeComunicadosRecentes.png">
                    <label class="lblRecentesComunicadosDeterminadaTurma">Recentes</label>
                </a>

            </div>
            <div class="localComunicados" id="localComunicados">
                <?php
                include_once("viewNovoComunicado.php");
                ?>
            </div>
        </div>
    </div>
</body>
</html>


<script type="text/javascript">

    function alterarDestinatario()
    {
      var id_destinatario = $('#selectDestinatario :selected').val(); 
      var txt_destinatario = $('#selectDestinatario :selected').text();     
      
      $("#lblTurmaComunicado").attr("value", id_destinatario);
      $("#lblTurmaComunicado").text(txt_destinatario);

  } 

  function enviar_comunicado(codTurma)
  { 
      swal({
        title: "Tem certeza que deseja enviar este comunicado?",
        icon: "warning",
        buttons: [
        'Não',
        'Sim'
        ],
        dangerMode: true,
    }).then(function(isConfirm) { 
        if (isConfirm) {
            var idProfessorUsuario = $('#lblProfessorComunicado').attr("value");
            var txtAssunto = $('#txtAssunto').val();
            var txtComunicado = $('#txtComunicado').val();

            $.ajax({
                asyn: false,
                type: "POST",
                url: "viewEnviarComunicado.php",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Enviando...</label></div>");
                },
                data:{
                    id_professor_usuario: idProfessorUsuario,
                    id_turma: codTurma,
                    txt_assunto: txtAssunto,
                    txt_comunicado: txtComunicado
                },
                success: function(data){
                    $('#localComunicados').html(data);  
                }
            });

        } 
    }); 
}

function carregaNovoComunicado(codTurma)
{
    $.ajax({
        asyn: false,
        url: "viewNovoComunicado.php",
        dataType: "html",
        type: "POST",
        data: { 
            codigoturma: codTurma
        },
        success: function(data)
        {
            $('#localComunicados').html(data);
        }
    });   
}

function carregaComunicadosEnviados(idUsuario, codTurma)
{
    $.ajax({
        asyn: false,
        url: "viewVisualizarComunicadosEnviados.php",
        dataType: "html",
        type: "POST",
        data: { 
            id: idUsuario,
            codigoturma: codTurma
        },
        success: function(data)
        {
            $('#localComunicados').html(data);
        }
    });   
}

function carregaComunicadosRecentes(codTurma)
{
    $.ajax({
        asyn: false,
        url: "viewVisualizarComunicadosRecentes.php",
        dataType: "html",
        type: "POST",
        data: { 
            codigoturma: codTurma
        },
        success: function(data)
        {
            $('#localComunicados').html(data);
        }
    });   
}


    // Voltar
    function voltarPageAnterior(codUsuario)
    {
      $.ajax({ 
        asyn: false,
        url: "viewTurmasProfessor.php",
        dataType: "html",
        type: "POST",
        data: { id: codUsuario},
        success: function(data){
          $('#painelAbas').html(data);
      },
  });
  }  


</script>