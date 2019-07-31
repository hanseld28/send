<?php
include_once("..\cab.php");
include_once("..\Controller\ControllerTipoUsuario.php");
include_once("..\Model\TipoUsuario.php");
session_start();
?>	
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>SEND - Agenda Online</title>
    
    <link rel="stylesheet" type="text/css" href="../Estilos/Estilos.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstiloForms.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/Responsividade.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstiloAlert.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstiloItensForms.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstiloTabelas.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstiloPaginacao.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstilosNovasForms.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EstilosCards.css">
    <link rel="stylesheet" type="text/css" href="../css/demo.css">
    <link rel="stylesheet" type="text/css" href="../css/theme1.css">
    <link rel="stylesheet" href="../Estilos/EstilosModoNoturno.css">
    <link rel="stylesheet" href="../Estilos/limiteTelaAdmin.css">
    
    <!--<script src="../Js/ChamadaDasForms.js"></script>-->
    
    <script type="text/javascript" src="../js/jsCalendar.js"></script>
    <script type="text/javascript" src="../js/jquery-3.3.1.js.js"></script>
    <script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
    <script type="text/javascript" src="../js/funcaoToggle.js"></script>

    
</head>

<body id="mypage">

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
      echo " ------------------------------------------------------------------------------------------------------------------------------------ ";
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
   <a href="" id="abririnicio" name="abririnicio"><img src="../Imagens/none.png" alt="" class="imgHome"></a>  <!-- onclick="abririnicio('viewPainel2.php')" -->


   <ul class="icones-menu-cima">
    <li class="perfil-usuario"><a href="#"><img class='imgPerfilUsuario' src="../Imagens/none.png" alt="Icone-User" onclick="abrirpainelperfil('viewConsultarPerfil.php')"></a><span class="toolTipTextoPerfil">Perfil do Usuário</span></li>

    <li class="btn-notificacao"><a href="#"><img class='imgNotificacao' src="../Imagens/none.png" alt="Icone-Notificacao"></a><span class="toolTipTextoNotificacao">Configurações</span></li>


    <li class="btn-sair"><a href="logout.php"><img class='imgSair' src="../Imagens/none.png" alt="Icone-Sair"></a>
        <span class="toolTipTextoSair">Sair</span>
    </li>
</ul>


</nav>
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
<aside id="logo">

    <div class="telaPadrao">
       <a href="viewPainel2.php">

          <img class="iconeSend" src="../Imagens/send.png">
          <label class="lblTelaPadrao">.Sen</label> 
      </a>

  </div>
</aside>

<section id="menu-lateral">
    <div class="viewPerfil">
        <div class="iconePerfil">
            <img src="../Imagens/user%20(5).png" alt="">
            <h1><?php echo($_SESSION["nomeUsuario"]); ?></h1>
            <div class="traco"></div>
            <h2><?php 
            $cod = $_SESSION["codTipoUsuario"];
            $controller = new ControllerTipoUsuario();
            $nometipousuario = $controller->preencherTipoUsuario($cod);
            echo($nometipousuario);
            
            ?></h2>
        </div>
    </div>
    <ul class="icones-menu-lateral">

        <li id="btnCadastroAluno" class="btnCadastrarAluno"><a  href="#" id="aluno" name="aluno" onclick="mostrapainelaluno('viewConsultarAluno.php')" ><span><img class="imgAluno" src="../Imagens/none.png" alt=""></span><p>Alunos</p></a><span class="toolTipTextoAluno">Aluno</span></li>
        
        <li id="btnResponsavel" class="btnCadastrarResp"><a  href="#" id="resp" name="resp" onclick="mostrapainelresponsavel('viewConsultarResponsavel.php')"><span><img class="imgResp" src="../Imagens/none.png" alt=""></span><p>Responsáveis</p></a>
            <span class="toolTipTextoResponsaveis">Responsáveis</span></li>
            
            <li id="btnMatricula" class="btnCadastrarMatricula"><a  href="#" id="matricula" name="matricula" onclick="mostrapainelmatricula('viewConsultarMatricula.php')"><span><img class="imgMatricula" src="../Imagens/none.png" alt=""></span><p>Matrículas</p></a>  <span class="toolTipTextoMatricula">Matrículas</span></li>
            
            <li id="btnCadastroFuncionario" class="btnCadastroFuncionario"><a href="#" id="func" name="func" onclick="mostrapainelfunc('viewConsultarFuncionario.php')"><img class="imgFunc" src="../Imagens/none.png" alt=""><p>Funcionários</p></a><span class="toolTipTextoFunc">Funcionários</span></li>
            
            
            <li id="btnCadastroAluno" class="btnCadastrarUsers"><a  href="#" id="user" name="user" onclick="mostrapainelUsuario('viewConsultarUsuario.php')" ><span><img class="imgUser" src="../Imagens/none.png" alt=""></span><p>Usuários</p></a><span class="toolTipTextoUsers">Usuários</span></li>
            
            
            <li class="demaisCadastros"><a href="#" onclick="mostrapainelaux('viewCadastrosAuxiliares.php')" ><span><img class="imgDemaisCadastros" src="../Imagens/none.png" alt=""></span>
                <p>Cadastros Auxiliares</p></a><span class="toolTipTextoCadastrosAuxiliares">Cadastros Auxiliares</span></li>

                <ul>


                   <!--<li id="btnCadastroAgenda"><a  href="#"><p>Agenda</p></a></li>-->
                <!--<li id="btnCronograma"><a  href="#"><p>Cronograma</p></a></li>
                <li id="btnProntuarioAluno"><a  href="#"><p>ProntuarioAluno</p></a></li>
                
            -->
        </ul>
        
    </ul>

    
    <script type="text/javascript" language="javascript">


        function mostrapainelcargo(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelitem(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelfunc(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };
            
            function mostrapainelaluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };
            
            function mostrapainelgrau(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelperiodo(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapaineltipousuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelUsuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };
            
            function mostrapainelatividade(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelresponsavel(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function mostrapainelcategoria(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelcaracteristica(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
            
            function mostrapainelmatricula(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };
            
            function mostrapainelprofessorturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };

            function mostrapainelaux(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function abrirpainelperfil(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function abrirfunc(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function abriraluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function abricadaux(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

            function abririnicio(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").before(function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                });
                $("#painelAbas").load(pagina);
            };

        </script>
        
        <div id="menu-config">
            <legend> <img class='imgConfigMenor' src="../Imagens/none.png" alt=""> <p>Configurações</p></legend>
            <div class="tema">
               <img class='imgLua' src="../Imagens/none.png" alt="">
               <p>Tela Escuro&nbsp;&nbsp;  </p>
               <button id="b1"></button>
           </div>
       </div>

       <!-- <div id="expandItensLateral"><img src="../Imagens/right-arrow.png" alt=""></div>
       <div id="rodape">
        <ul id="lista">
            <li class="btn-contato1"><a href="#"><span><img src="../Imagens/call-answer.png" alt=""></span><p></p></a><span class="toolTipTextoContato1">Contato</span></li>
       
            <li class="btn-info1"><img src="../Imagens/info-button%20(1).png" alt=""><span class="toolTipTextoInfo1">Informações</span></li>
       
            <li class="btn-ajuda1"><img src="../Imagens/question-mark%20(1).png" alt=""><span class="toolTipTextoAjuda1">Ajuda</span></li>
        </ul>
       
           </div>
       
           <div id="rodape1">
        <ul id="lista">
            <li class="btn-contato"><a href="#"><span><img src="../Imagens/call-answer.png" alt=""></span></a><span class="toolTipTextoContato">Contato</span></li>
       
            <li class="btn-info"><img src="../Imagens/info-button%20(1).png" alt=""><span class="toolTipTextoInfo">Informações</span></li>
       
            <li class="btn-ajuda"><img src="../Imagens/question-mark%20(1).png" alt=""><span class="toolTipTextoAjuda">Ajuda</span></li>
        </ul>
           </div> -->

</section>

<div class="conteudo">
    <header id="cabecalho">
        <div class="titulo">
            Painel do Administrador
        </div>
    </header>
    <section id="conteudo1">

        <div class="painelAbas" id="painelAbas">
           
           <div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

           <div class="conteudoCard">
            <div class="embrulhoCards">
                <section class="caixas">   
                    <div class="caixa">
                     <a href="#" id="abriraluno" name="abriraluno" onclick="abriraluno('viewConsultarAluno.php')">
                        <div class="cor1">
                           <img src="../Imagens/ImagensCards/IconeAlunoInicio.png" alt="">
                           <p>Aluno</p>
                       </div>
                   </a>
               </div>
               <div class="caixa">
                  <a href="#" id="abrirfunc" name="abrirfunc" onclick="abrirfunc('viewConsultarFuncionario.php')">
                    <div class="cor2">
                       <img src="../Imagens/ImagensCards/funcionarioIcone.png" alt="">
                       <p>Funcionário</p>
                   </div>
               </a>
           </div>
           <div class="caixa">
              <a href="#" id="abrircadaux" name="abricadaux" onclick="abricadaux('viewCadastrosAuxiliares.php')">
                <div class="cor3">
                    <img src="../imagens/ImagensCards/IconeCadAuxInicio.png" alt="">
                    <p>Cadastros Auxiliares</p>
                </div>
            </a>
        </div>
        <div class="caixa">
            <section class="clock">

              <img src="../Imagens/ImagensCards/IconeHoraInicio.png" alt="">                
              <time class="clock__time">
                 <span id="js-clock"></span>
             </time>

         </section>
     </div>

 </section>
 <section class="conteudoTopoMensagens">
    <div class="topoMensagens1">
        <h1><sub><img src="../Imagens/ImagensCards/Widgets.png" alt=""></sub>  Widgets </h1>
    </div>
</section>
<section class="top-conteudoCard">
    <header class="miniCard1">                            
       <a  class="tempoFrame" target="_blank" href="http://ibooked.com.br/weather/sao-paulo-18266"><img src="https://w.bookcdn.com/weather/picture/32_18266_1_8_e67e22_250_d35401_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=585&anc_id=14071"  alt="booked.net"/>    
       </a>
       <figure>
        <img src="../Imagens/ImagensCards/IconeNuvem.png" alt="">
        <figcaption>São Paulo</figcaption>
    </figure>
</header>

<header class="miniCard2">
    <div class="cardTopo">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. bbbbbbbbbbbbbbbbbbb</p>
        <script Language="JavaScript">
            mydate = new Date();
            myday = mydate.getDay();
            mymonth = mydate.getMonth();
            myweekday = mydate.getDate();
            myyear = mydate.getFullYear();
            weekday = myweekday;

            if (myday == 0)
                day = " Domingo "

            else if (myday == 1)
                day = " Segunda - Feira "

            else if (myday == 2)
                day = " Terça - Feira "
            else if (myday == 3)
                day = " Quarta - Feira "

            else if (myday == 4)
                day = " Quinta - Feira "

            else if (myday == 5)
                day = " Sexta - Feira "

            else if (myday == 6)
                day = " Sábado "
            if (mymonth == 0)
                month = "Janeiro "

            else if (mymonth == 1)
                month = "Fevereiro "
            else if (mymonth == 2)
                month = "Março "

            else if (mymonth == 3)
                month = "Abril "

            else if (mymonth == 4)
                month = "Maio "

            else if (mymonth == 5)
                month = "Junho "

            else if (mymonth == 6)
                month = "Julho "

            else if (mymonth == 7)
                month = "Agosto "

            else if (mymonth == 8)
                month = "Setembro "
            else if (mymonth == 9)
                month = "Outubro "

            else if (mymonth == 10)
                month = "Novembro "

            else if (mymonth == 11)
                month = "Dezembro "


            document.write("<h1>" + myweekday + " de " + month + " de " + myyear + "</h1>");

            document.write("<h2>" + day + "</h2>");


        </script>

        <div class="imgCard"><img src="../Imagens/ImagensCards/IconeRelogio.png" alt=""></div>

    </div>


</header>

                        <!--            
                                <header class="miniCard4">
                                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. bbbbbbbbbbbbbbbbbbb
                                                          </header>  -->

                                                          <div class="topo-caixa top-caixa1">
                            <!--   <div class="cardTopo">
                                  
                              </div>bbbbb
                          -->
                          <div id = "calcFrame">
                              <div id = "outLine">
                               <input name = "output" value = "0" id = "output">
                           </div>
                           <div id = "divLine">
                               <input type = "button" value = "AC" id = "ac" onclick = "AC()">
                               <input type = "button" value = "+/-" id = "plusMinus" onclick = "plusMinus()">
                               <input type = "button" value = "%" id = "percent" onclick = "percent()">
                               <input type = "button" value = "&divide;" id = "divide" onclick = "divide()">
                           </div>
                           <div id = "multLine">
                               <input type = "button" value = "7" id = "seven" onclick = "seven()">
                               <input type = "button" value = "8" id = "eight" onclick = "eight()">
                               <input type = "button" value = "9" id = "nine" onclick = "nine()">
                               <input type = "button" value = "&times;" id = "multiply" onclick = "multiply()">
                           </div>
                           <div id = "subLine">
                               <input type = "button" value = "4" id = "four" onclick = "four()">
                               <input type = "button" value = "5" id = "five" onclick = "five()">
                               <input type = "button" value = "6" id = "six" onclick = "six()">
                               <input type = "button" value = "-" id = "minus" onclick = "subtract()">
                           </div>
                           <div id = "plusLine">
                               <input type = "button" value = "1" id = "one" onclick = "one()">
                               <input type = "button" value = "2" id = "two" onclick = "two()">
                               <input type = "button" value = "3" id = "three" onclick = "three()">
                               <input type = "button" value = "+" id = "add" onclick = "add()">
                           </div>
                           <div id = "equalsLine">
                               <input type = "button" value = "0" id = "zero" onclick = "zero()">
                               <input type = "button" value = "." id = "decimal" onclick = "decimal()">
                               <input type = "button" value = "=" id = "equals" onclick = "equals()">
                           </div>
                       </div>
                   </div>

                   <div class="topo-caixa top-caixa2">
                    <div id="caleandar">

                    </div>








                    <div class="cardPrevisao">

                    </div>

                </div>

            </section>


            <section class="conteudoRodape">
                <div class="rodape">
                    Polaris &copy; 2018 
                </div>
            </section>



        </div>
    </div>  



</div>
</section>      

</div>



<div id="ajuda">
    <div class="ajudaTitulo">
        Ajuda
        <div class="fecharAjuda">x</div>
    </div>
    <div class="ajudaConteudo">
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>
        <div class="ajudinha">
            <h1>Como eu faço para cadastrar um aluno?</h1>
            <p>Para cadastrar um aluno vc precisa ir no botão alunos localizado no menu lateral e preencher o formulário que aparecerá.</p>
        </div>

    </div>
</div>

<script>
    /*Deficiência*/

    $(function(){
       $(".simDeficiencia").click(function(){
          $(".divDeficiencia").show(600); 
      }); 
   });
    
    $(function(){
       $(".naoDeficiencia").click(function(){
          $(".divDeficiencia").hide(500); 
      }); 
   });


</script>

<script type="text/javascript" src="../js/FuncoesSimples.js"></script>
<script type="text/javascript" src="../js/FuncoesCardsAdmin.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/voltaPraCima.js"></script>
<script type="text/javascript" src="../js/caleandar.js"></script>
<script type="text/javascript" src="../js/demo.js"></script>
<script type="text/javascript" src="../js/funcaoToggle.js"></script>
<script type="text/javascript" src="../js/mudaTema.js"></script>
<script type="text/javascript" src="../js/FuncoesCardsAdmin.js"></script>
<script type="text/javascript" src="../js/funcoesAdmin.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>

<?php
include_once("../rod.php");
?>
