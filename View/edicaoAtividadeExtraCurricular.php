<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");
?>


<?php

$codigo = $_POST['id'];

            //$atividade = new AtividadeExtraCurricular();

$crud = new ControllerAtividadeExtraCurricular();

$resultado = $crud->preencherAtividadeExtraCurricular($codigo);
$descatividade = $resultado;



?>


<!-- Edição do cargo-->

<div class="barraPesquisaCadAux">

</div>




<a href="#" id="abaconsultaatv" name="abaconsultaatv"onclick="abaconsultaatv('viewConsultarAtividadeExtraCurricular.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>


<div class="FormCadastroAtividade">
 <fieldset>
  <legend>Edição Atividade Extra Curricular</legend>
  <form method="post" action="#">
    <label class="labelCadAux">Descrição</label>

    <div class="caixaTexto">
      <?php

      echo("<input class='regular-input-text' type='text' name='txtatividade' id='txtatividade' value='".$descatividade."'>");
      $cod = $codigo;
      
      echo("<p class=''>");   
      echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editaratividade('.$cod.')">');
      echo("</p");
      
      echo("<p class=''>");    
      echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarAtividadeExtraCurricular.php')".">");
      echo("</p");

      ?>
    </div>
  </form> 
  <img src="../Imagens/ImagensCadastrosAuxiliares/AtividadeExtraCurricular2.png" alt="">
</fieldset>
</div>

<script type="text/javascript" language="javascript">

  function abaconsultaatv(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
          };

          function editaratividade(cod)
          {
            if(document.getElementById("txtatividade").value != ""){   
              $.ajax({
                asyn: false,
                type: "POST",
                url: "CorreioAtividadeExtraCurricular2.php",
                data:{
                  nome_atividade: $('#txtatividade').val(),
                  cod_atividade: cod
                },
                success: function(data){
                  $('#painelCadAuxliar').html(data);  
                }
              });
            }else{
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


      <?php
      include_once("../rod.php");
      ?>