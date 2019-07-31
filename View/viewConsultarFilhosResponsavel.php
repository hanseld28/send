<?php
session_start();
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Controller/ControllerAgenda.php");
include_once("../Model/Aluno.php");
include_once("../DAO/Conexao.php");

    $codUsuario = intval($_SESSION['codUsuario']);
    
    $consulta = new ControllerUsuario();
     
    $listaCriancas = $consulta->consultarFilhosResponsavel($codUsuario);    

    $controllerAgenda = new ControllerAgenda();

    

    ?>
    <div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 
    
    <div class="telaDeVisualizarOsFilhos">

        <div class="topotelaDeVisualizarOsFilhos">

            <a class="iconeReAbasCardsFilhos" href="">
          
           <img class="iconSetaRetorno" src="../Imagens/iconeDeRePerfilResp.png">
           
       </a>

            <div class="iconeElabelFilhos">
                
                <h1 class=""><img src="../Imagens/iconeTopoFilhos.png" class=""> Filhos</h1>
            </div>

        </div>

        <div class="conteudotelaDeVisualizarOsFilhos">


            <?php

      

        foreach($listaCriancas as $crianca){
            //$date = $aluno->getDatanascimento(); 
            //$aux = str_replace('-', '/', $date);
            //$dataNascAluno = date('d-m-Y', strtotime($aux));
            $agenda = $controllerAgenda->pesquisarAgendaAluno($crianca->getCodigo());

            
              echo "<div class='cardsFilhos'>";
       
               echo "<div class='localFotoFilho'>";
            
                  echo "<img class='iconFotoFilho' src='../fotos/{$crianca->getFoto()}' id='fotoFilho'>";

                  echo "<ul>";

                  echo "<li>";

                  echo "<a class='iconeVisualizarAgenda' href='#' name='prontuario' value='' id='prontuario' onclick='mostrarAgenda({$agenda->getId()})'>";
                  
                  echo "<img class='iconAgenda' src='../Imagens/iconeAgendaFilho.png'>";
            
                  echo "<label class='lblIconAgenda'>Agenda</label>";

                  
                echo "</a>";

                echo "</li>";

                echo "<li>";
           
                echo "<a class='iconeVisualizarProntuario' href='#' onclick='abrirprontuario({$crianca->getCodigo()})'>";
            
                
                 echo "<img class='iconProntuario' src='../Imagens/iconeProntuarioFilho.png'>";
            
                 echo "<label class='lblIconProntuario'>Prontuário</label>";
                  
               echo "</a>";

               echo "</li>";

               echo "</ul>";
           
               echo "</div>";
       
             echo "<div class='localNomeAgendaEprontuario'>";
         
             echo "<p class='pNomeMeuFilho'> {$crianca->getNome()}</p>";
                  
            echo "</div>";
        
          echo "</div>";
                
        }
         
    ?>
        <?php
    //PAGINAÇÃO//

        echo "<ul class='paginacaoCards'>";

       $i = 1;

       $calculo = ($_POST['calculoFilhos']) ? $_POST['calculoFilhos'] : null;
       //var_dump($calculo);
       //PAGINAÇÃO
       while ($i <= $calculo) {
           
           echo "<li>";
           
           echo "<a  href='#' id='pgfilhos' name='pgfilhos' onclick="."pgfilhos('viewConsultarFilhosResponsavel.php?pageFilhos={$i}')".">$i</a>";
           
           $i++;
           
           echo "</li>";
        }

        echo "</ul>";
       //PAGINAÇÃO


?>

        </div>


    </div>



    <script type="text/javascript" language="javascript">
        
        
        function mostrarAgenda(codAgenda) {
            $.ajax({
                asyn: false,
                url: "viewConsultarRotinasCrianca.php",
                dataType: "html",
                type: "POST",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: {
                    idAgenda: codAgenda
                },
                success: function(data) {
                    $('#painel').html(data);
                },
            });

        }

        function carregaDadosAluno(codigo) {

            $.ajax({
                asyn: false,
                type: "POST",
                url: "viewConsultarDadosAluno.php",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: {
                    cod: codigo

                },
                success: function(data) {
                    $('#painel').html(data);
                }
            });
        }

        function abrirprontuario(cod) {

            $.ajax({
                url: "viewConsultarProntuarioAluno.php",
                dataType: "html",
                type: "POST",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: {
                    id: cod
                },
                success: function(data) {
                    $('#painel').html(data);
                },
            });

        }

        //Paginação
        function pgfilhos(pagina) {
            // Carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painel").before(function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            });
            $("#painel").load(pagina);
        };

    </script>
