
<?php
  include_once("verificaUsuarioLogado.php"); 
   include_once("../Controller/ResponsavelCRUD.php"); 
    
  if(!isset($_SESSION))
  {
        session_start();
        $codUsuario = $_SESSION['codUsuario'];
        

    $resp = new Responsavel();
    $crud = new ResponsavelCRUD();
    $resp = $crud->ConsultaDadosResponsavel($codUsuario);
    $foto = $resp->getFoto();
      
    $_SESSION['resp'] = $resp->getCodigo();
  }



?>
    <html>

    <head>
        <meta charset="utf-8">

        <title>Send - Área Responsável</title>
        
        <link rel="stylesheet" href="../Estilos/ResponsividadeResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../Estilos/EstilosResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleMenuLateralResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleTelaPadraoResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleTelaResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleTelaFilhosResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleConsultaDadosResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleConsultaAgendaFilhosResponsavel.css">
        
        <link rel="stylesheet" type="text/css" href="../css/styleVisualizarComunicadoFilho.css">

        <link rel="stylesheet" type="text/css" href="../css/styleConsultaRotinaEspecificaFilhosResponsavel.css">

        <link rel="stylesheet" type="text/css" href="../css/styleConsultaProntuarioFilho.css">

          <link rel="stylesheet" type="text/css" href="../Estilos/EstiloAlert.css">

          <script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
          
          <link rel="stylesheet" href="../Estilos/EstilosModoNoturnoResp.css">
          
          <link rel="stylesheet" href="../Estilos/EstilosInicialResp.css">
          
          <link rel="stylesheet" href="../Estilos/limiteTelaResp.css">
        <!-- Arquivos responsividade -->
        <!--
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadeMenuLateral.css">
        
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadeMenuTopo.css">
        
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadePadrao.css">
        
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadeTelaVisualizacaoFilhos.css">
        
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadeVisualizar1filho.css">
        
        <link rel="stylesheet" type="text/css" href="css/responsividade/responsividadeVisualizar2filho.css">
        -->
        <!--  -->

        <!-- Arquivos javascript, jquery -->

        <script src="../js/jquery-3.3.1.js.js"></script>
        <!--<script type="text/javascript" src="../js/efeitosJsTelaVisualizacaoFilhos.js"></script>-->

        <!-- ---------------------------- -->

    </head>

     <body id="mypageResp">

<div class="menuLateralHamburguer">
    <span></span>
    <span></span>
    <span></span>
</div>


<script>
$(document).ready(function(){
    $(".menuLateralHamburguer").click(function(){
        $(".menuLateralHamburguer").toggleClass("ativaMenu")
    })
        $(".menuLateralHamburguer").click(function(){
        $(".menuCanto").toggleClass("ativaMenu")
    })
  
})        
</script>

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
        <!-- Menu de cima -->

        <nav class="menuCima">

            <!-- localização do logo -->

            <div class="localizacaoLogo">

                <img class="iconeLogoSendTopo" src="../Imagens/sendLogoTopo.png">

                <label class="lblLogoTopo">.Sen</label>

            </div>

         

            <!-- fim localização logo -->

            <!-- Menu topo -->

   <ul class="iconesMenuCima">
                <!-- <li class="btnNotificaoLista">
                    <img class="iconNotificacoes" src="../Imagens/none.png"> 
                    <div class="numNotificacao"><p>2</p></div>
                
                    <span class="tooltipNotificacoes">Notificações</span>
                
                </li> -->
                <li class="btnConfigResp">
                    <img class="iconConfiResp" src="../Imagens/none.png"> 

                    <span class="tooltipNotificacoes">Configuração</span>

                </li>
                <li>
                    <a href="logout.php">
                    
                    <img class="iconSair" src="../Imagens/none.png">
                    
                    <span class="tooltipSaida">Sair</span>
                    
                    </a>
                </li>
                
            </ul>



            <!-- fim menu topo -->

        </nav>
        


        <!-- fim menu de cima --> 

        <!-- Menu lateral -->

        <nav class="menuCanto">
   <a href="" onclick="carregaPainelResponsavel('viewPainelResponsavel.php')"><div class="iconeHome">
       <img class="" src="../Imagens/homeResp.png">
   </div></a>
            <div class="PerfilDoResponsavel"> 
               
                <div class="FotoResponsavel">
                  
                   <fieldset>
                     
                      <div class="trocaFotoenuLateral" id="trocaFotoenuLateral" name="trocaFotoenuLateral">
                      
                       <img class="" src="../fotos/<?php echo($foto); ?>">
                       
                       
                    <legend>
                    
                    <p><?php echo($_SESSION["nomeUsuario"]); ?></p>
                    
                    </legend>
                    
                    
                        
                <form id="formulario" name="formulario" method="post" enctype="multipart/form-data" action="upload.php">
                   <label for="imagem"><div class="iconTrocaFoto">
                       <img class="iconPF" src="../Imagens/camera.png" alt="">
                   </div></label>
                    <input class="btnTrocaFoto" type="file" name="imagem" id="imagem" name="imagem">
                    </form>
                    
                    </div>
                    

                    </fieldset>
                </div>
                <div class="funcionalidades">
                   <a href="#" id="resp" name="resp" onclick="mostrapainelresponsavel('viewConsultarDadosResponsavel.php')">
                        <div class="iconeVisu">
                           <div class="iconeBolinha">
                               <img class="iconPerfilResp" src="../Imagens/iconeVisualizarPerfil.png">
                           </div>
                           <label class="lblVisualizar">Meu perfil</label>
                        </div>
                    </a>
                    <a href="#" id="aluno" name="aluno" onclick="mostrapainelalunos('viewConsultarFilhosResponsavel.php')">
                        <div class="visualizarCardsFilho">
                           <div class="iconeBolinha">
                               <img class="icones" src="../Imagens/iconeVisualizarFilhos.png">
                           </div>
                            <label class="lblVisualizar">Meus filhos</label>
                        </div>
                    </a>
                </div>
            </div>

        </nav>
               <div id="menu-config">
            <legend> <img class='imgConfigMenor' src="../Imagens/none.png" alt=""> <p>Configurações</p></legend>
            <div class="tema">
               <img class='imgLua' src="../Imagens/none.png" alt="">
               <p>Tela Escuro&nbsp;&nbsp;  </p>
               <button id="btnResp"></button>
           </div>
       </div>

        <!-- fim menu lateral -->

        <!-- Area do conteudo -->



        <!-- fundo visualização filho 1 -->

        <div class="conteudoAtalhos">

            <div class="caixapainelAtalhos">
               
            </div>
            <div class="caixaPainel">
               
                <div class="caixaDosAtalhosEdastelas" id="painel">
                        <div class="conteudoCardResp">
                <div class="embrulhoCardsResp">

      
                    <section class="conteudoTopoMensagensResp">
                        <div class="topoMensagensGame1">
                            <h1> <img src="ImagensJogos/joystick.png" alt="">Jogos</h1>
                        </div>
                    </section>
                    
                    
                    <section class="top-conteudoGame">
                        <div class="topo-caixa top-caixaGame1">
                            <a href="../Jogos/TicTacToe/index.html" target="_blank">
                             <div class="hovergame">
                                
                            
                             <div class="descricaoJogo">
                                 <h1>Tic-Tac-Toe</h1>
                                 <h2>Criado Por: REast CodePen</h2>
                             </div>
                             
                              </div>
                            </a>
                             	
                        </div>
                        
                        

                        <div class="topo-caixa top-caixaGame2">
                             <a href="../Jogos/RotationGame/index.html" target="_blank">
                             <div  class="hovergame">
                                
                            
                             <div class="descricaoJogo">
                                 <h1>Rotation Game</h1>
                                 <h2>Criado Por: LoueeD CodePen</h2>
                             </div>
                             
                              </div>
                              </a>
                        </div>
                        
                        

                    </section>

              <section class="caixasGame">
                           
                        <div class="caixaGame1">
                            <a href="../Jogos/PingPongGame/index.html" target="_blank" class="">
                               <div class="hoverCaixa">
                                <div class="descricaoGameCaixa">
                                    <h1>Ping Pong Game</h1>
                                    <h2>Criado Por: Gdube Code Pen</h2>
                                </div>
                               </div> 
                            </a>
                            
                        </div>
                        
                        <div class="caixaGame2">
                            <a href="../Jogos/SnakeGame/index.html" target="_blank" class="">
                               <div class="hoverCaixa">
                                <div class="descricaoGameCaixa">
                                    <h1>Snake Game</h1>
                                    <h2>Criado Por: b-ouachem Code Pen</h2>
                                </div>
                               </div> 
                            </a>
                        </div>
                        <div class="caixaGame3">
                            <a href="../Jogos/AGenericInfiniteRunnerGame/index.html" target="_blank" class="">
                               <div class="hoverCaixa">
                                <div class="descricaoGameCaixa">
                                    <h1>A Generic Infinite Runner</h1>
                                    <h2>Criado Por: EduardoLopes Code Pen</h2>
                                </div>
                               </div> 
                            </a>
                        </div>


                    </section>
                    <section class="conteudoRodapeGame">
                        <div class="rodapeGame">
                            Polaris &copy; 2018 
                        </div>
                    </section>



                </div>
            </div>  
                        <div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

                </div>
            </div>
        </div>

        <!-- fim fundo visulização filho 1 -->


        
        <div class="centraldenotificacao">
           
                <legend>
                    Notificações
                </legend>
                <ul>
                    <li><h1>Comunicado</h1><p>Festa Junina Hoje as 14:00 horas, leva sua melhor roupa</p></li>
                    <li><h1>Comunicado</h1><p>Festa Junina Hoje as 14:00 horas, leva sua melhor roupa</p></li>
                    <li><h1>Comunicado</h1><p>Festa Junina Hoje as 14:00 horas, leva sua melhor roupa</p></li>
                    <li><h1>Comunicado</h1><p>Festa Junina Hoje as 14:00 horas, leva sua melhor roupa</p></li>
                    <li><h1>Comunicado</h1><p>Festa Junina Hoje as 14:00 horas, leva sua melhor roupa</p></li>
                    
     
                </ul>
           
        </div>

        <!-- fim conteudo -->

    </body>

    </html>



    <script type="text/javascript" language="javascript">
        
        function carregaPainelResponsavel(pagina)
        {
            $("#painel").load(pagina);  // Conteudo ira aparecer na tela inicial
        }

        function mostrapainelalunos(pagina) 
        {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painel").before(function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            });
            $("#painel").load(pagina);

        }

        function mostrapainelresponsavel(pagina) 
        {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painel").before(function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            });
            $("#painel").load(pagina);
        }

        function visualizarComunicados(pagina) 
        {
            $("#painel").before(function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            });
            $("#painel").load(pagina);
        }

    $(document).ready(function(){
   /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
   $('input:file[name="imagem"]').change(function(){
    
    var formdata = new FormData($("form[name='formulario']")[0]);
    
    $('#trocaFotoenuLateral').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
    /* Efetua o Upload sem dar refresh na pagina */
    $.ajax({
      type: "POST",
      url: "upload2.php",
      enctype: "multpart/form-data",
      async: false,
      beforeSend: function(){
         $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
      },
      data: formdata,
            processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"
            cache: false, // desabilitar o "cache"
            
            success: function(data) {
              $('#trocaFotoenuLateral').html(data);
            }
          });
    
  });
 });

    </script>


<script src="../js/funcoesResp.js"></script>
<script src="../js/mudaTemaResp.js"></script>