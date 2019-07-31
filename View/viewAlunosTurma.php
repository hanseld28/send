<?php

include_once("../Controller/ProfessorTurmaCRUD.php");
include_once("../Controller/AlunoCRUD.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCard.php");
include_once("../Controller/ControllerAlternativa.php");

        if(isset($_POST['codigoturma'])): $codigoturma = $_POST['codigoturma']; endif;
        
        $lista = array();
        $pt = new ProfessorTurma();
        $crud = new ProfessorTurmaCRUD();
        $lista = $crud->consultarAlunosTurma($codigoturma);
        $pt = $lista;

        ?>
               
        <script src="../js/add-fields.js"></script>

            <h1>Cadastro de Rotina</h1>

             <form action="#" method="post">
             
                 <div class="caixaTexto">
                   <input type='text' name='txtRotina' id='txtRotina'>
                   <label>Descrição</label>
                 </div>
                

                <h3>Cards (Categorias)</h3>
                <?php
                    // Instancia a classe ControllerCard
                    $controllerCard = new ControllerCard();
                    // Instancia a classe ControllerAlternativa
                    $controllerAlternativa = new ControllerAlternativa();

                    // Recebe o retorno do método consultarCard
                    $listaCards = $controllerCard->consultarCard();
                    // Recebe o retorno do método consultarCard
                    $listaAlternativas = $controllerAlternativa->consultarAlternativa();


                    foreach ($listaCards as $obj) {
                        
                        echo('<form action="#" method="post">');
                        echo "<input type='checkbox' name='cards' id='cards' value='{$obj->getId()}'><b>{$obj->getDescricao()}</b><br/>";

                        foreach ($listaAlternativas as $alternativa) {
                            echo "<input type='radio' name='altCard' id='altCard' value='{$alternativa->getId()}'>{$alternativa->getDescricao()}<br/>";
                        }
                        
                        echo('</form>');
                        
                    }
                 
                 

                ?>              

                <br/>
                
                
                <div class="input_fields_wrap">
                    <h3>Ocorrências</h3>
                    <div>
                        <input type="text" name="ocorrencias"> <button class="add_field_button">Adicionar</button>
                    </div>
                </div>  
                
                <br/>

                <input type="button" value="Enviar" onclick="mandarRotina(<?php echo($codigoturma); ?>)">
                 
         </form>
         
          

         <table>
        <thead>
            <tr>
                <th>Nome</th>
               
            </tr>
        </thead>
        <tbody>
        
       
         <?php foreach($pt as $aluno){
    
    
            $alu = new AlunoCRUD();
            $nomealuno = $alu->pesqAlunoPorCodigo($aluno['codAluno']);
            $codigodoaluno = $aluno['codAluno'];
            //$mano = new AlunoCRUD();
            $codAgendaAluno = $alu->AgendaAlunoPorCodigo($codigodoaluno);
            
            
            
            echo("<tr>");
    
                    echo("<td>");
                    echo("<nobr><input type='checkbox' id='ckbAluno' name='ckbAluno' value='{$codAgendaAluno}'></nobr>");
                    echo($nomealuno);
                    echo("</td>");

                    
                    //echo("<td>");
                    //echo("<a href='#' name='ver' value='' id='ver' onclick='veragenda("")'>Ver Alunos</a>");
                    //echo("</td>");
    
    
            
            echo("</tr>");
            
            
            
        }?>
       
                 
        </tbody>
    </table>
    
    <script type="text/javascript" language="javascript">
            function mandarRotina(codturma)
            {
                var listaAgendas = [];
                var listaCards = [];
                var listaAlternativasCard = [];
                var listaOcorrencias = [];

                $("input:checkbox[name=ckbAluno]:checked").each(function(){
                    listaAgendas.push($(this).val());
                });

                $("input:checkbox[name=cards]:checked").each(function(){
                    listaCards.push($(this).val());
                });

                $("input:radio[name=altCard]:checked").each(function(){
                    listaAlternativasCard.push($(this).val());
                });

                $("input:text[name=ocorrencias]").each(function(){
                    listaOcorrencias.push($(this).val());
                });
                
                
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarRotina.php",
                    data:{
                        txtRotina: $('#txtRotina').val(),
                        agendas: listaAgendas,
                        cards: listaCards,
                        altCard: listaAlternativasCard,
                        ocorrencias: listaOcorrencias,
                        codTurma: codturma
                    },
                    success: function(data){
                        $('#painelAbas').html(data);  
                    }
                });
            }

            
    </script>  


     