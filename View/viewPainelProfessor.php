<?php
    include_once("..\cab.php");

        //$url_atual = $_SERVER["REQUEST_URI"];
    if(!isset($_SESSION))
    {
        session_start();
    }

    if(isset($_SESSION['codUsuario'])) 
    {
        $codigouser = $_SESSION['codUsuario'];
    }

    if(isset($_POST['id']))
    {
        $codigouser = $_POST['id'];
    }

        // Controle de URL
    // $caminho = "Meu Painel";
    // $url_control = "<a href='#' id='link_painel' onclick='controle_url(this.id)'>{$caminho}</a>";

    // $lista_urls = new ArrayObject();

    // $lista_urls->append($url_control);

    // $_SESSION['lista_urls'] = $lista_urls;
?>  
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEND - Agenda Online</title>
    <link rel="stylesheet" href="../Estilos/EstilosProfessor.css">
    <link rel="stylesheet" href="../Estilos/EstiloForms.css">
    <link rel="stylesheet" href="../Estilos/Responsividade.css">
    <link rel="stylesheet" href="../Estilos/EstiloAlert.css">
    <link rel="stylesheet" href="../css/syleViewEnviarRotinaAlunos.css">
    <link rel="stylesheet" href="../css/syleViewEnviarRotinaAlunosPt2.css">
    <link rel="stylesheet" href="../css/styleViewTurmasProfessor.css">
    <link rel="stylesheet" href="../css/syleViewRotinaRecentesAlunos.css">
    <link rel="stylesheet" href="../css/syleViewRotinaTodasAlunos.css">
    <!-- <link rel="stylesheet" href="../css/styleTelaEnviarComunicado.css"> -->
    <!-- <link rel="stylesheet" href="css/styleTelaEnviarComunicadoFormularioComunicado.css">
    <link rel="stylesheet" href="../css/styleTelaEnviarComunicadoTabelaTodos.css">
    <link rel="stylesheet" href="../css/styleTelaEnviarComunicadoTabelaRecentes.css"> -->
    <link rel="stylesheet" href="../css/styleTelaAlunosTurma.css">
    <link rel="stylesheet" href="../Estilos/EstilosInicialProf.css">
    <link rel="stylesheet" href="../Estilos/EstiloPaginacao.css">
    <link rel="stylesheet" href="../Estilos/EstiloTelasProfessor.css">
    <link rel="stylesheet" href="../Estilos/EstilosModoNoturnoProf.css">
    <link rel="stylesheet" href="../Estilos/limiteTelaProf.css">
    <!--<script src="../Js/ChamadaDasForms.js"></script>-->
    <script type="../text/javascript" src="js/jquery-3.3.1.js.js"></script>
    <script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
</head>

<body id='mypageProf'> <!-- onselectstart="return false" -->

    <input type="checkbox" id="btn-menu-lateral">
    <label for="btn-menu-lateral">&#9776;</label>
    <div class="balao" id="balao">

        <img src="../Imagens/recommended.png" alt="">
        <script LANGUAGE="JavaScript">
            d = new Date();
            hour = d.getHours();
            if (hour < 5) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Noite!</p>");
            } else
            if (hour < 8) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Dia!</p>");
            } else
            if (hour < 12) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Bom Dia!</p>");
            } else
            if (hour < 18) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Tarde!</p>");
            } else {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Noite!</p>");
            }
        </script>
        
        <?php
        echo "<h3>";
        echo "<a href='#''>"; 
        if(isset($_SESSION["statusUsuario"])): 
            if($_SESSION["statusUsuario"]):
                echo "Status do usuário: <b>Online</b>";
            else:
                echo "Status do usuário: <b>Offline</b>";
            endif;
        endif; 
        echo "</a>"; 

      
        echo "<a href='logout.php'>Sair</a>";
        echo "</h3>";
        ?>  
        
    </div>
    
    <script>

        function mensagemBoasVindas(){
            $('#balao').fadeIn(2000); 
            $('#balao').delay(2200);
            $('#balao').fadeOut(1000);
        }

    </script>
    
    
   <nav id="menu-cima">
        <ul class="icones-menu-cima">
            <!-- <li  class="perfil-usuario"><a href="#"><img class='imgPerfilProf' src="../Imagens/none.png" alt="Icone-User"></a><span class="toolTipTextoPerfil">Perfil do Usuário</span></li>
            <li class="btn-notificacao"><a href="#"><img class='imgNotificacaoProf' src="../Imagens/none.png" alt="Icone-Notificacao"></a> <span class="toolTipTextoNotificacao">Notificações</span></li> -->
             <li class="btn-configuracao"><img class='imgConfigProf' src="../Imagens/none.png"> <span class="toolTipTextoConfig">Configuração</span></li>
            <li class="btn-sair"><a href="logout.php"><img class='imgSairProf' src="../Imagens/none.png" alt="Icone-Sair"></a> <span class="toolTipTextoSair">Sair</span></li>
        </ul>
    </nav>

    <aside id="logo">

        <div class="telaPadrao">
            <img class="iconeSend" src="../Imagens/send%20(1).png">
            <label class="lblTelaPadrao">.Sen</label>
        </div>
    </aside>


    <section id="menu-lateral">
        <div class="viewPerfil">
            <div class="iconePerfil">
                <img src="../Imagens/user%20(5).png" alt="">
                <h1><?php echo($_SESSION["nomeUsuario"]); ?></h1>
                <div class="traco"></div>
                <h2>Professor</h2>
            </div>
        </div>
        <ul class="icones-menu-lateral">
            <li id="btnCadastroFuncionario"><a href="#" id="carregaturmas" name="carregaturmas" onclick="carregaturmas(<?php echo($codigouser); ?>); carrega_url_turmas(<?php echo($codigouser); ?>)"><span><img class="imgTurma" src="../Imagens/none.png" alt=""></span><p>Turmas</p></a></li>
            
        </ul>
        
       <!--  <div id="expandItensLateral1"><img src="../Imagens/right-arrow.png" alt=""></div>
        <div id="rodape">
            <ul id="lista">
                <li class="btn-contato1"><a href="#"><span><img src="../Imagens/call-answer.png" alt=""></span><p></p></a><span class="toolTipTextoContato1">Contato</span></li>
        
                <li class="btn-info1"><img src="../Imagens/info-button%20(1).png" alt=""></li>
        
                <li class="btn-ajuda1"><img src="../Imagens/question-mark%20(1).png" alt=""></li>
            </ul>
        
        </div>
        
        <div id="rodape1">
            <ul id="lista">
                <li class="btn-contato"><a href="#"><span><img src="../Imagens/call-answer.png" alt=""></span></a></li>
        
                <li class="btn-info"><img src="../Imagens/info-button%20(1).png" alt=""></li>
        
                <li class="btn-ajuda"><img src="../Imagens/question-mark%20(1).png" alt=""></li>
            </ul>
        </div> -->



    </section>
           
            <div id="menu-config">
            <legend> <img class='imgConfigMenor' src="../Imagens/none.png" alt=""> <p>Configurações</p></legend>
            <div class="tema">
               <img class='imgLua' src="../Imagens/none.png" alt="">
               <p>Tela Escuro&nbsp;&nbsp;  </p>
               <button id="btnProf"></button>
           </div>
       </div>
   
    <div class="conteudo">

        <header id="cabecalho">
            <div class="titulo" id="url_controle_painel">

                <a href="#" id="link_painel" onclick="voltarPageInicial(<?php echo($codigouser); ?>)">Meu Painel</a>
                
            </div>
        </header>
        <div id="conteudo1">
            <div class="painelAbas" id="painelAbas">
                    
                <?php  
                    include_once("viewTelaInicialPainelProfessor.php");
                ?>

            </div>
        </div>
    </div>


    <!-- ===========================================ALERT========================================================== -->
    <div id="modal">
        <div class="caixaDialogo" id="caixaDialogo">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="512px" height="512px">
          <g>
            <g>
              <path d="m40.5,61.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l18.9,18.9c0.8,0.8 1.8,1.2 2.9,1.2 0.1,0 0.1,0 0.2,0 1.1-0.1 2.2-0.6 3-1.5l47.3-56.7c1.4-1.7 1.2-4.3-0.5-5.8-1.7-1.4-4.3-1.2-5.8,0.5l-44.5,53.3-15.7-15.7z" fill="#91DC5A"/>
              <path d="m95.1,15.3c-23-14.4-52.5-11-71.7,8.2-22.6,22.6-22.6,59.5 7.10543e-15,82.1 11.3,11.3 26.2,17 41,17s29.7-5.7 41-17c19.3-19.3 22.6-48.9 8.1-71.9-1.2-1.9-3.7-2.5-5.6-1.3-1.9,1.2-2.5,3.7-1.3,5.6 12.5,19.8 9.6,45.2-7,61.8-19.4,19.4-51.1,19.4-70.5,0-19.4-19.4-19.4-51.1 0-70.5 16.6-16.5 41.9-19.4 61.7-7.1 1.9,1.2 4.4,0.6 5.6-1.3 1.2-1.9 0.6-4.4-1.3-5.6z" fill="#91DC5A"/>
          </g>
      </g>
  </svg>
  <div class="caixaDialogoCorpo" id="caixaDialogoCorpo">

  </div>
  <div class="caixaDialogoRodape" id="caixaDialogoRodape">
  </div>
</div>
</div>



<div id="modalErro">
 <div class="caixaDialogoErro" id="caixaDialogoErro">    
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_2" x="0px" y="0px" viewBox="0 0 475.2 475.2" style="enable-background:new 0 0 475.2 475.2;" xml:space="preserve" width="512px" height="512px">
        <g>
            <g>
                <path d="M405.6,69.6C360.7,24.7,301.1,0,237.6,0s-123.1,24.7-168,69.6S0,174.1,0,237.6s24.7,123.1,69.6,168s104.5,69.6,168,69.6    s123.1-24.7,168-69.6s69.6-104.5,69.6-168S450.5,114.5,405.6,69.6z M386.5,386.5c-39.8,39.8-92.7,61.7-148.9,61.7    s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7,0-297.8C128.5,48.9,181.4,27,237.6,27s109.1,21.9,148.9,61.7    C468.6,170.8,468.6,304.4,386.5,386.5z" fill="#f70f39"/>
                <path d="M342.3,132.9c-5.3-5.3-13.8-5.3-19.1,0l-85.6,85.6L152,132.9c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1    l85.6,85.6l-85.6,85.6c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.6-85.6l85.6,85.6c2.6,2.6,6.1,4,9.5,4    c3.5,0,6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1l-85.4-85.6l85.6-85.6C347.6,146.7,347.6,138.2,342.3,132.9z" fill="#f70f39"/>
            </g>
        </g>
    </svg>

    <div class="caixaDialogoCorpoErro" id="caixaDialogoCorpoErro">

    </div>
    <div class="caixaDialogoRodapeErro" id="caixaDialogoRodapeErro">
    </div>
</div>
</div>

<!-- ===========================================ALERT========================================================== -->



<?php
include_once("../rod.php");
?>




<script type="text/javascript" language="javascript">


    // function controle_url(id_link)
    // {
    //     $('#painelAbas').html("");

    //     var count_links = 0;
    //     $("#url_controle_painel a").each(function(){
    //         count_links++;
    //     });

    //     var last_link = $("#url_controle_painel a:last");

    //     if (count_links > 1 && id_link != last_link.prop('id'))
    //     {
    //         $("#url_controle_painel #" + id_link + " ~ a").each(function(){
    //             $(this).remove();
    //         }); 

    //         var id_remove = last_link.prop('id');
    //     }

    // } 

    // function carrega_url_turmas(idUsuario)
    // {
    //     $.ajax({
    //         asyn: false,
    //         url: "controle_url_painel_professor.php",
    //         dataType: "html",
    //         type: "POST",
    //         data: { url_request: "<a href='#' id='link_turma' onclick='carregaturmas(" + idUsuario + "); controle_url(this.id);'>Turmas</a>" },
    //         success: function(data){
    //             $("#url_controle_painel").html(data);
    //         }
    //     });
        
    // }

    // function carrega_url_comunicado(idTurma)
    // {
    //     $.ajax({
    //         asyn: false,
    //         url: "controle_url_painel_professor.php",
    //         dataType: "html",
    //         type: "POST",
    //         data: { url_request: "<a href='#' id='link_comunicado' onclick='tela_comunicado(" + idTurma + "); controle_url(this.id);'>Comunicado</a>" },
    //         success: function(data){
    //             $("#url_controle_painel").html(data);
    //         }
    //     });
        
    // }

    function carregaturmas(idUsuario)
    {
        $.ajax({ 
            asyn: false,
            url: "viewTurmasProfessor.php",
            dataType: "html",
            type: "POST",
            beforeSend: function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            },
            data: { id: idUsuario},
            success: function(data){
                $('#painelAbas').html(data);
            }
        });

    }

    function tela_comunicado(codturma)
    {
        $.ajax({ 
            asyn: false,
            url: "viewComunicado.php",
            dataType: "html",
            type: "POST",
            data: { codigoturma: codturma},
            success: function(data){
                $('#painelAbas').html(data);
            },
        });
    }

    function voltarPageInicial(codUsuario)
    {
      $.ajax({ 
        asyn: false,
        url: "viewTelaInicialPainelProfessor.php",
        dataType: "html",
        type: "POST",
        data: { id: codUsuario},
        success: function(data){
          $('#painelAbas').html(data);
        },
      });
    } 
    
</script>


<script src="../js/funcoesProf.js"></script>
<script src="../js/mudaTemaProf.js"></script>