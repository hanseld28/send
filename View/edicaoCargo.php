<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
?>
<?php
include_once("verificaUsuarioLogado.php");
    //Includes do Cargo
include_once("../Controller/CargoCRUD.php"); 

?>
<!-- Edição do cargo-->


<?php
$codigo = $_POST['cod'];


$cargo = new Cargo();
$crud = new CargoCRUD();
$resultado = array();

$resultado = $crud->ConsultaCargo($codigo);
$cargo = $resultado;


?>
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultacar" name="abaconsultacar"onclick="abaconsultacar('viewConsultarCargoFuncionario.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="FormCadastroAtividade">
    <fieldset>
        <legend>Edição Cargo do Funcionário</legend>
        <form method="post" action="#">
         <label class="labelCadAux">Descrição</label>
         <div class="caixaTexto">
            <?php

            foreach ($cargo as $obj){
                echo("<input class='regular-input-text' type='text' name='txtCargo' id='txtCargo' value='".$obj->getNome()."'>");
                $cod = $obj->getCodigo();

            }
            echo("<p class=''>"); 
            echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarcargo('.$cod.')">');
            echo("</p");

            echo("<p class=''>");    
            echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarCargoFuncionario.php')".">");
            echo("</p");

            ?>
        </div> 
    </form>
    <img src="../Imagens/ImagensCadastrosAuxiliares/Cargo.png" alt="">    
</fieldset>
</div>

<script type="text/javascript" language="javascript">

    function abaconsultacar(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function editarcargo(cod)
        {
            if(document.getElementById("txtCargo").value != ""){
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioCargo2.php",
                    data:{
                        nome_cargo: $('#txtCargo').val(),
                        cod_cargo: cod
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
            }
            else{
               AlertdeErro.render('<h1>Preencha todos os campos!</h1>');
           }
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