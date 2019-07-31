<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
    //Includes do Cargo
include_once("../Controller/ItemCronogramaCRUD.php"); 
?>

<!-- Edição do cargo-->


<?php
$codigo = $_POST['id'];


?>

<div class="barraPesquisaCadAux"></div>

<a href="#" id="abavoltarcronogramaturma" name="abavoltarcronogramaturma"onclick="abavoltarcronogramaturma('viewConsultarCronogramaTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>


<div class="FormCadastroAtividade">
	        <form action="" method="post">
             <fieldset>
        <legend>Edição Cronograma</legend>  
 <div class="caixaTexto">

   <?php
   
                                // Instancia a classe ControllerTipoUsuario
   $controller = new ItemCronogramaCRUD();
                                // Recebe o retorno do método listarTipoUsuario
   $lista = $controller->ListarItensCronograma();

                                // Inclui o select com os tipos de usuário na página

   
   echo "<select class='select-regular' name='item' id='item'>";    
   foreach ($lista as $obj) {
    echo "<option value='{$obj->getCodigo()}'>{$obj->getNome()} - {$obj->getHorario()}</option>";
}
     



echo "</select>";
echo("<br>");   
echo('<input class="btnProxPasso13" type="button" value="Editar" onclick="editarCronogramaTurma('.$codigo.')">');

  
?>  
                 </div>
               <img src="../Imagens/cronograma.png" alt="">
                </fieldset>
                
    </form>
</div>


<script type="text/javascript" language="javascript">

   function abavoltarcronogramaturma(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };
        
        function editarCronogramaTurma(cod)
        {
            var valorCombo = document.getElementById("item").value;

            $.ajax({
                asyn: false,
                type: "POST",
                url: "CorreioCronogramaTurma2.php",
                data:{
                    select: valorCombo,
                    cod: cod
                },
                success: function(data){
                    $('#painelCadAuxliar').html(data);  
                }
            });
        }

    </script>
            <script type="text/javascript">
         function cancelare(pagina){
          swal({
            title: "Deseja Cancelar?(As alterações não serão salvas)",
            icon: "warning",
            buttons: [
            'Não',
            'Sim'
            ],
            dangerMode: true,
          }).then(function(isConfirm) { 
            if (isConfirm) {

              $("#painelCadAuxliar").load(pagina); 

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