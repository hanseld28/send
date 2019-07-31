<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerPeriodo.php");
?>


<?php

$codigo = $_POST['id'];

$periodo = new Periodo();

$crud = new ControllerPeriodo();

$resultado = $crud->PreencherPeriodo($codigo);
$periodo = $resultado;


$desc = $periodo->getDescricao();
$horario = $periodo->getHorario();

?>


<!-- Edição do cargo-->
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultaperiodo" name="abaconsultaperiodo"onclick="abaconsultaperiodo('viewConsultarPeriodo.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="FormCadastroPeriodo">
  <fieldset>
    <legend>Edição Período</legend>
    <form method="post" action="#">
      
      <?php
      
      
      echo("<div class='caixaTexto'>");
      echo("<label class='labelCadAux'>Descrição</label>");
      echo("<br>");
      echo("<input class='regular-input-text' type='text' name='txtperiodo' id='txtperiodo' value='".$desc."'>");
      echo("</div>");
      
      
      echo("<div class='caixaTexto'>");
      echo("<label class='labelCadAux'>Período</label>");
      echo("<br>");
      echo("<input class='regular-input-text-mesma-linha' type='text' name='txthorarioperi' id='txthorarioperi' value='".$horario."'>");
      echo("</div>");
      $cod = $codigo;

      echo("<div class='praBaixo'>");
      echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarperiodo('.$cod.')">');
      
      echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarPeriodo.php')".">");
      echo("</div");




      ?>
      
    </form> 

    <img src="../Imagens/ImagensCadastrosAuxiliares/Periodo.png" alt="">
  </fieldset>
</div>


<script type="text/javascript" language="javascript">

  function abaconsultaperiodo(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
          };

          function editarperiodo(cod)
          {
           if(document.getElementById("txtperiodo").value != "" && 
            document.getElementById("txthorarioperi").value != ""){

            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioPeriodo2.php",
              data:{
                nome_periodo: $('#txtperiodo').val(),
                horario_periodo: $('#txthorarioperi').val(),
                cod_periodo: cod
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

  <?php
  include_once("../rod.php");
  ?>