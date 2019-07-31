<?php
  include_once("../cab.php");

  $cod = $_POST['id'];
?>


  <!-- =================================================================================== -->
                    <div class="barraPesquisaCadAux">

</div>

<a href="#" id="abavoltarcronogramaturma" name="abavoltarcronogramaturma"onclick="abavoltarcronogramaturma('viewConsultarCronogramaTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>


	    <div class="FormCadastroAtividade">
	        <form action="" method="post">
             <fieldset>
        <legend>Cadastro Cronograma</legend>  
	           
                                <?php
                                include_once("..\Controller\ItemCronogramaCRUD.php");
                                // Instancia a classe ControllerTipoUsuario
                                $controller = new ItemCronogramaCRUD();
                                // Recebe o retorno do método listarTipoUsuario
                                $lista = $controller->ListarItensCronograma2();

                                // Inclui o select com os tipos de usuário na página


                                echo "<select class='select-regular' name='itens' id='itens'>";    
                                foreach ($lista as $obj) {
                                    echo "<option value='{$obj->getCodigo()}'>{$obj->getNome()} - {$obj->getHorario()}</option>";
                                }

                                echo "</select>";
                            ?>
           
	           <br>

                 <img src="../Imagens/cronograma.png" alt="">
                </fieldset>
                			<?php echo('<input class="btnProxPasso" type="button" value="Adicionar" onclick="carregaCronogramaTurma('.$cod.')">') ?>
	     </form>
</div>


    <script type="text/javascript" language="javascript">

                function abavoltarcronogramaturma(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };
            function carregaCronogramaTurma(codigo)
            {
                var valorCombo = document.getElementById("itens").value; 
                
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarCronogramaTurma.php",
                    data:{
                        select: valorCombo,
                        cod: codigo
                        
 
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