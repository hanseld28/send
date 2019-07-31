<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 
<?php

    include_once("../Controller/ProfessorTurmaCRUD.php");
    include_once("verificaUsuarioLogado.php");
    
    // Controle de URL da Pagina
    //session_start();

    //$bkp_url = $_SESSION['URL_CONTROL'];

    //$_SESSION['URL_CONTROL'] = $bkp_url." \ Turma";
    // --------------------------    


    $codigo = $_POST['id'];
    $lista = array();
    $pt = new ProfessorTurma();
    $crud = new ProfessorTurmaCRUD();
    $lista = $crud->consultarTurmasProfessor($codigo);
    $pt = $lista;

?>
        <div class="telaVisualizarTurmas">
            <div class="topoTelaVisualizarTurmas">
                <div class="iconelabelTurmas">
                   
                    <img class="iconTopoTurmas" src="../Imagens/iconeDeTurmasPofessor.png">
                    <label class="lblTopoTurmas">Turmas</label>
                    
                </div>
                
                <a href="#" class="iconeRetornaparaabaPrincipal" onclick="voltarPageAnterior(<?php echo($codigo); ?>)">
                    <img src="../Imagens/iconeSetaRetornoAbaTurmas.png" class="iconSetaRetornaparaabaPrincipal">
                </a>
            </div>
            <div class="conteudoTurmas">
                <div class="caixaTabelaTurmasT">
                   <div class="linhaTabelaTurmas1">
                       <article class="artTabelaTurmas1">
                          
                          <table class="tabelaTurmasT">
        <thead>
            <tr>
                <td class="tituloTurmasT">Turma</td>
                <td class="tituloTurmasT">Nova</td>
                <td class="tituloTurmasT">Novo</td>
                <td class="tituloTurmasT">Visualizar</td>
            </tr>
        </thead>
        <tbody>
        
       
         <?php 

            foreach ($pt as $turmas)
            {              
                echo("<tr class='infoTurmasT'>");
                        $pesqnometurma = new ProfessorTurmaCRUD();
                        $resultado = $pesqnometurma->consultarNomeTurma($turmas->getCodigoturma());

                        echo("<td class='linhaTurmasT'>");
                        echo($resultado);
                        echo("</td>");

                        
                        echo("<td class='linhaTurmasT'>");
                        echo("<a class='btnNovaRotina' href='#' name='criarRotina' id='criarRotina' onclick='criar_rotina({$turmas->getCodigoturma()})'>Rotina</a>");
                
                        echo("</td>");
                
                        echo("<td class='linhaTurmasT'>");
                
                        echo("<a class='btnNovoComunicadoTurma' href='#' name='telaComunicado' value='' id='telaComunicado' onclick='tela_comunicado({$turmas->getCodigoturma()})'>Comunicado</a>");

                        echo("</td>");
                
                       echo("<td class='linhaTurmasT'>");
                
                        echo("<a class='btnVisualizarAlunos' href='#' onclick='ver_alunos_turma({$turmas->getCodigoturma()})'>Alunos</a>");

                        echo("</td>");


                
                echo("</tr>");
            }
            
        ?>
                 
        </tbody>
    </table>
                           
                       </article>
                   </div>
                   <div class="linhaTabelaTurmas2">
                       <article class="artTabelaTurmas2">
                           
                       </article>
                   </div>
            </div>
        </div>


    <script type="text/javascript" language="javascript">
    
        function criar_rotina(codturma)
        {
            $.ajax({ 
                asyn: false,
                url: "viewEnviarRotinaAlunos.php",
                dataType: "html",
                type: "POST",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: { codigoturma: codturma },
                success: function(data)
                {
                    $('#painelAbas').html(data);
                },
            });
        }

        function tela_comunicado(codturma)
        {
            $.ajax({ 
                asyn: false,
                url: "viewComunicado.php",
                dataType: "html",
                type: "POST",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: { codigoturma: codturma },
                success: function(data)
                {
                    $('#painelAbas').html(data);
                },
            });
        }

        function ver_alunos_turma(codturma) 
        {
            $.ajax({
                asyn: false,
                url: "viewVisualizarAlunosTurma.php",
                dataType: "html",
                type: "POST",
                beforeSend: function(){
                    $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
                },
                data: { codigoturma: codturma },
                success: function(data)
                {
                    $('#painelAbas').html(data);
                },
            });        
        }
            

        //Controle de URL
        function carrega_url_rotina(codTurma)
        {
            $.ajax({
                asyn: false,
                url: "controle_url_painel_professor.php",
                dataType: "html",
                type: "POST",
                data: { url_request: "<a href='#' id='link_rotina' onclick='criar_rotina(" + codTurma + ")'; controle_url(this.id);>Rotina</a>" },
                success: function(data){
                    $("#url_controle_painel").html(data);
                }
            });
            
        }    
        
        // Voltar
        function voltarPageAnterior(codUsuario)
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

        /*
        function controle_url()
        {
            $("#url_controle_painel a:last").remove();
        } 
        */

    </script>
    