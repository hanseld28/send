<?php
  include_once("../cab.php");


?>


  <!-- =================================================================================== -->
                    <div class="barraPesquisaCadAux">

</div>
       
        <a  href="#" id="abaconsulta" name="abaconsulta" onclick="abaconsulta('viewConsultarProfessorTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
        
           <script type="text/javascript" language="javascript">
                function abaconsulta(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
            
        </script>

<div class="FormCadastroPeriodo">
    <fieldset>
        <legend>Cadastro Professor por Turma</legend>
           <form action="#" method="post">
              <div class="caixaTexto">
                 <label class="labelCadAux">Turma</label>
                   <br>
           
                             <?php
                        include_once("..\Controller\ControllerTurma.php");
                        include_once("..\Controller\ControllerUsuario.php");
                
                        // Instancia a classe ControllerTipoUsuario
                        $controller = new ControllerTurma();
                        // Recebe o retorno do método listarTipoUsuario
                        $lista = $controller->consultarTurma();

                        // Inclui o select com os tipos de usuário na página
    
                        echo "<select class='select-regular' name='turm' id='turm'>";
                        foreach ($lista as $obj) {
                            echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
                        }
                        echo "</select>";
                
                
                        
                        // Instancia a classe ControllerTipoUsuario
                        $control = new ControllerUsuario();
                        // Recebe o retorno do método listarTipoUsuario
                        $list = $control->consultarUsuarioProfessor();
                        echo"<br>";
                        // Inclui o select com os tipos de usuário na página
                        echo "<label class='labelCadAux'>Professor</label>";
                        echo"<br>";
                        echo "<select class='select-regular' name='professores' id='professores'>";
                        foreach ($list as $prof) {
                            echo "<option value='{$prof->getId()}'>{$prof->getNome()}</option>";
                        }
                        echo "</select>";
                
                        
                    ?>
            

			<?php echo('<input class="btnProxPasso1" type="button" value="Cadastrar" onclick="carregaProfessorTurma()">') ?>
               </div>
               <img src="../Imagens/ImagensCadastrosAuxiliares/Professores%20Por%20Turma.png" alt="">
	     </form>
	     
    </fieldset>
</div>
	


    <script type="text/javascript" language="javascript">
            function carregaProfessorTurma()
            {
                var turmas = document.getElementById("turm").value; 
                var professores = document.getElementById("professores").value; 
                
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioProfessorTurma.php",
                    data:{
                        turma : turmas,
                        professor: professores
 
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
            }
            
          

            
        </script>
	
	

<?php
  include_once("../rod.php");
?>