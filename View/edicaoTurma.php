<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
?>
<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerGrauEscolar.php");
include_once("../Controller/ControllerTurma.php");

?>


<?php

$codigo = $_POST['id'];

            //$turma = new Turma();

$crud = new ControllerTurma();

$resultado = $crud->PreencherTurma($codigo);
$turma = $resultado;
$grau = $turma->grauEscolar->getId();

    $controllerGrauEscolar = new ControllerGrauEscolar();
    // Recebe o retorno do método listarTipoUsuario
    $listaGrausEscolares = $controllerGrauEscolar->consultarGrauEscolar();


?>
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultaturma" name="abaconsultaturma"onclick="abaconsultaturma('viewConsultarTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="FormCadastroPeriodo">
    <fieldset>
        <legend>Edição Turma</legend>
        <form action="#" method="post">
            <div class="caixaTexto">
                <label class="labelCadAux">Descrição</label>
                <br>
                <?php
                
                echo("<input class='regular-input-text' type='text' name='txtturma' id='txtturma' value='".$turma->getDescricao()."'>");
                
                
                    //echo("<input type='text' name='txtgrau' id='txtgrau' value='".$grau."'>");
                $cod = $codigo;
                echo("<br>");
                
                echo(" <label class='labelCadAux'>Grau Escolar</label>");
                echo("<br>");
                  echo "<select class='select-regular' name='grauTurma' id='grauTurma'>";
                    foreach ($listaGrausEscolares as $obj) {
                        
                        if($grau == $obj->getId()){
                        echo "<option value='{$obj->getId()}' selected='selected'>{$obj->getDescricao()} - {$obj->periodo->getDescricao()}</option>";
                        }else{
                        echo "<option value='{$obj->getId()}'>{$obj->getDescricao()} - {$obj->periodo->getDescricao()}</option>";
                            
                        }
                    }

                    echo "</select>";
                
                

                echo("<p class=''>");
                echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarturma('.$cod.')">');
                echo("</p");

                echo("<p class=''>");
                echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarTurmas.php')".">");
                echo("</p");
                
                ?>
            </div>
        </form>
        <img  class="TurmaImg" src="../Imagens/ImagensCadastrosAuxiliares/Turma.png" alt="">
    </fieldset>
</div>

<script type="text/javascript" language="javascript">

    function abaconsultaturma(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function editarturma(cod)
        {
            var valorCombo = document.getElementById("grauTurma").value;

            $.ajax({
                asyn: false,
                type: "POST",
                url: "CorreioTurma2.php",
                data:{
                    nome_turma: $('#txtturma').val(),
                    grau_turma: valorCombo,
                    cod_turma: cod
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




 <?php
 include_once("../rod.php");
 ?>