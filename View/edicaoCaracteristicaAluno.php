<?php
    include_once("../cab.php");
    include_once("verificaUsuarioLogado.php");
    //Includes do Cargo
    include_once("../Controller/ControllerCaracteristicaSaude.php"); 
?>

<!-- Edição do cargo-->

     
     <?php
         $codigo = $_POST['id'];

        
     ?>
     <form action="" method="post">

     <?php
                            
                                // Instancia a classe ControllerTipoUsuario
                                $controller = new ControllerCaracteristicaSaude();
                                // Recebe o retorno do método listarTipoUsuario
                                $lista = $controller->consultarCaracteristicaSaude();

                                // Inclui o select com os tipos de usuário na página


                                echo "<select name='caracteristica' id='cara'>";    
                                foreach ($lista as $obj) {
                                    echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
                                }

                                echo('<input type="button" value="Editar" onclick="editarCaracteristicaAluno('.$codigo.')">');

                                

                                echo "</select>";
                            ?>  
</form> 
    
     <script type="text/javascript" language="javascript">
            function editarCaracteristicaAluno(cod)
            {
                var valorCombo = document.getElementById("cara").value;

                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioCaracteristicaAluno2.php",
                    data:{
                        select: valorCombo,
                        prontuario: cod
                    },
                    success: function(data){
                        $('#painelAbas').html(data);  
                    }
                });
            }

        </script>

 


    <!-- Ferramentas -->

<!-- Ferramentas -->
<!-- Edição do cargo-->
<!-- ================================================================================================================= -->

<?php
  include_once("../rod.php");
 ?>