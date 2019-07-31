<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
?>
<?php
include_once("verificaUsuarioLogado.php");
  //Includes do Item do Cronograma
include_once("../Controller/ItemCronogramaCRUD.php");

?>
<!-- Edição do cargo-->


<?php
$codigo = $_POST['cod'];



$itens = new ItemCronograma();
$consulta = new ItemCronogramaCRUD();
$result = array();
$result = $consulta->consultaItensCronograma($codigo);
$itens = $result;


?>

<a href="#" id="abaconsultaitens" name="abaconsultaitens"onclick="abaconsultaitens('viewConsultarItensCronograma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="barraPesquisaCadAux">

</div>

<div class="FormCadastroPeriodo">
    <fieldset>
        <legend>Edição Itens do Cronograma</legend>
        <form method="post" action="CorreioItemCronograma2.php">
            <div class="caixaTexto">
                <?php
                foreach ($itens as $obj){

                    echo("<label class='labelCadAux'>Descrição</label>");
                    echo("<br>");
                    echo("<input class='regular-input-text' type='text' name='txtItem' id='txtItem' value='".$obj->getNome()."'>");
                    echo("</div>");
                }
                ?>


                <div class="caixaTexto">
                    <?php
                    foreach ($itens as $obj){
                        echo("<label class='labelCadAux'>Horário</label>");
                        echo("<br>");
                        echo("<input class='regular-input-text-mesma-linha' type='text' name='txtHorarioItem' id='txtHorarioItem' value='".$obj->getHorario()."'>");


                    }
                    echo("<p class=''>");
                    echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editaritem('.$codigo.')">');
                    echo("</p");
                    
                    echo("<p class=''>");
                    echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarItensCronograma.php')".">");
                    echo("</p");


                    
                    ?>
                </div>
                <img src="../Imagens/ImagensCadastrosAuxiliares/ItensCronograma.png" alt="">
            </div>

        </form>

    </fieldset>
</div>


<script type="text/javascript" language="javascript">
    function abaconsultaitens(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function editaritem(cod)
        {
            if(document.getElementById("txtItem").value != "" && document.getElementById("txtHorarioItem").value != ""){ 
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioItemCronograma2.php",
                    data:{
                        nome_item: $('#txtItem').val(),
                        cod_item: cod,
                        horario_item: $('#txtHorarioItem').val()
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
            }
            else{
                AlertdeErro.render('<h1>Preencha todos os campos!</h1>')
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