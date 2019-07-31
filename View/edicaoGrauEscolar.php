<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerGrauEscolar.php"); 
include_once("../Controller/ControllerPeriodo.php");
?>

<?php

$crudperiodo = new ControllerPeriodo();
$periodos = $crudperiodo->consultarPeriodo();

$codigo = $_POST['id'];
$grau = new GrauEscolar();
$crud = new ControllerGrauEscolar();

$graus = $crud->PreencherGrauEscolar($codigo);

?>
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultagrau" name="abaconsultagrau"onclick="abaconsultagrau('viewConsultarGrauEscolar.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>


<div class="FormCadastroAtividade">
    <fieldset>
        <legend>Edição Grau Escolar</legend>
        <form method="post" action="#">
            <label class="labelCadAux">Descrição</label>
            <div class="caixaTexto">
                <?php

                $descricao = $graus->getDescricao();
                $nomePeriodo = $graus->periodo->getDescricao();
                
                echo("<input class='regular-input-text' type='text' name='txtGrau' id='txtGrau' value='".$descricao."'>");
                $cod = $codigo;

                echo('<br>');
 
                
                echo('<label class="labelCadAux">Período</label>');
                echo('<br>');
                echo('<select class="select-regular" name="periodo_grau" id="periodo_grau">');
                foreach ($periodos as $list){
                   if($list->getDescricao()==$nomePeriodo)
                      echo"<option value='{$list->getId()}' selected='selected'>$nomePeriodo</option>";
                  else
                      echo"<option value='{$list->getId()}'>{$list->getDescricao()}</option>";
              }
              echo('</select>');
                
                echo("<p class=''>"); 
                echo ("<input class='btnProxPasso14' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarGrauEscolar.php')".">");
                
                echo("</p>"); 
                
                echo("<p class=''>"); 
                echo('<input class="btnProxPasso13" type="button" value="Editar" onclick="editargrau('.$cod.')">');
               echo("</p>"); 
              ?>

          </div>
      </form>
      <img src="../Imagens/ImagensCadastrosAuxiliares/Grau%20Escolar.png" alt="">
  </fieldset>
</div>

<script type="text/javascript" language="javascript">
    function abaconsultagrau(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function editargrau(cod)
        {
            if(document.getElementById("txtGrau").value != "" && periodo != ""){
                var periodo = document.getElementById("periodo_grau").value;

                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioGrau2.php",
                    data:{
                        nome_grau: $('#txtGrau').val(),
                        cod_grau: cod,
                        periodo_grau: periodo,
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
            }else{
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


   <?php include_once("../rod.php");
   ?>