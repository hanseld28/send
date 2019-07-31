<?php
  include_once("../cab.php");

  $cod = $_POST['id'];
?>


  <!-- =================================================================================== -->
            <div class="cimaPesquisa">
       <h2 class="tituloTop">Cadastrar Prontuário</h2>
</div>
        <a  href="#" id="abaconsultaprontuario" name="abaconsultaprontuario" onclick="abrirprontuario('<?php echo($cod); ?>')"><div class="abrirAbaCadastro"><img src="../Imagens/loupe.png"alt=""></div></a>
        
            <div class="FormEditarAluno">

	  
	        <form action="" method="post">
	            <div class="caixaTexto">
                   <label>Característica</label>
                               <br>
                                <?php
                                include_once("..\Controller\ControllerCaracteristicaSaude.php");
                                // Instancia a classe ControllerTipoUsuario
                                $controller = new ControllerCaracteristicaSaude();
                                // Recebe o retorno do método listarTipoUsuario
                                $lista = $controller->consultarCaracteristicaSaude();

                                // Inclui o select com os tipos de usuário na página


                                echo "<select class='select-regular' name='caracteristica' id='cara'>";    
                                foreach ($lista as $obj) {
                                    echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
                                }

                                echo "</select>";
                            ?>
          
	           <br>
                </div>
			<?php echo('<input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaCaracteristicaAluno('.$cod.')">') ?>
	     </form>
</div>


    <script type="text/javascript" language="javascript">
            function carregaCaracteristicaAluno(cod)
            {
                var valorCombo = document.getElementById("cara").value; 
                
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarCaracteristicaAluno.php",
                    data:{
                        select: valorCombo,
                        cod: cod
                        
 
                    },
                    success: function(data){
                        $('#painelAbas').html(data);  
                    }
                });
            }
        
             function abrirprontuario(cod){


                $.ajax({ 
                    url: "viewConsultarProntuario.php",
                    dataType: "html",
                    type: "POST",
                    data: { codigo: cod},
                    success: function(data){
                        $('#painelAbas').html(data);
                    },
                });
                
            }
            
          

            
        </script>
        
     
	
	

<?php
  include_once("../rod.php");
?>