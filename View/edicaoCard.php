<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
 <?php
 include_once("../cab.php");
 ?>
 <?php
 include_once("verificaUsuarioLogado.php");
    //Includes do Cargo
 include_once("../Controller/ControllerCard.php"); 

 ?>
 <!-- Edição do cargo-->


 <?php
 $codigo = $_POST['cod'];


 $card = new Card();
 $crud = new ControllerCard();
 $resultado = array();

 $resultado = $crud->preencherCard($codigo);
 $card = $resultado;


 ?>
 <div class="barraPesquisaCadAux">

 </div>

 <a href="#" id="abaconsultacard" name="abaconsultacard"onclick="abaconsultacard('viewConsultarCard.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

 <div class="FormCadastroAtividade">
    <fieldset>
        <legend>Edição Categoria da rotina</legend>
        <form method="post" action="#">
           <label class="labelCadAux">Descrição</label>
           <div class="caixaTexto">
            <?php


            echo("<input class='regular-input-text' type='text' name='txtCard' id='txtCard' value='".$card->getDescricao()."'>");
            $cod = $card->getId();


            echo("<p class=''>"); 
            echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarcard('.$cod.')">');
            echo("</p");

            echo("<p class=''>");    
            echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarCard.php')".">");
            echo("</p");

            ?>
        </div> 
    </form>
    <img src="../Imagens/ImagensCadastrosAuxiliares/rotina.png" alt="">    
</fieldset>
</div>

<script type="text/javascript" language="javascript">

    function abaconsultacard(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function editarcard(cod)
        {
            if(document.getElementById("txtCard").value != ""){
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioCard2.php",
                    data:{
                        nome_card: $('#txtCard').val(),
                        cod_card: cod
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