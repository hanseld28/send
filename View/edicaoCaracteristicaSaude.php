<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCaracteristicaSaude.php");
?>


<?php

$codigo = $_POST['id'];

$caracteristica = new CaracteristicaSaude();

$crud = new ControllerCaracteristicaSaude();

$resultado = $crud->PreencherCaracteristicaSaude($codigo);
$caracteristica = $resultado;


$desc = $caracteristica->getDescricao();


?>


<!-- Edição do cargo-->
<div class="barraPesquisaCadAux">

</div>

<div class="FormCadastroAtividade">
 <fieldset>
  <legend>Edição Características de Saúde</legend>
  <form method="post" action="#">
    <label class="labelCadAux">Descrição</label>
    <div class="caixaTexto">
      <?php

      echo("<input class='regular-input-text' type='text' name='desc' id='desc' value='".$desc."'>");

      $cod = $codigo;

      echo('<input class="btnProxPasso1" type="button" value="Editar" onclick="editarcaracteristica('.$cod.')">');

      ?>
    </div>
  </form> 
  <img src="../Imagens/ImagensCadastrosAuxiliares/CaracteristicaSaude.png" alt="">
</fieldset>
</div>

<script type="text/javascript" language="javascript">
  function editarcaracteristica(cod)
  {
    if(document.getElementById("desc").value != ""){
      $.ajax({
        asyn: false,
        type: "POST",
        url: "CorreioCaracteristicaSaude2.php",
        data:{
          desc: $('#desc').val(),
          cod: cod
        },
        success: function(data){
          $('#painelCadAuxliar').html(data);  
        }
      });
      else{
       AlertdeErro.render('<h1>Preencha todos os campos!</h1>');
     }

   }

 </script>

 <?php
 include_once("../rod.php");
 ?>