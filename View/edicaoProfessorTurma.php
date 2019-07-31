<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("..\Controller\ControllerTurma.php");
include_once("..\Controller\ControllerUsuario.php");
include_once("..\Controller\ProfessorTurmaCRUD.php");
include_once("../cab.php");

$codigo = $_POST['cod'];


?>
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultaprofturma" name="abaconsultaprofturma"onclick="abaconsultaprofturma('viewConsultarProfessorTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="FormCadastroPeriodo">
    <fieldset>
        <legend>Edição Professor por Turma</legend>
        <form action="#" method="post">
            <div class="caixaTexto">
                <?php
                
                $crud = new ProfessorTurmaCRUD();
                $profturmas = $crud->consultarProfessorTurma($codigo);
                
                foreach($profturmas as $profturma){
                    
                    $codTurma = $profturma->getCodigoturma();
                    $codProf = $profturma->getCodigoprofessor();
                    
                }
                
                        // Instancia a classe ControllerTipoUsuario
                $controller = new ControllerTurma();
                        // Recebe o retorno do método listarTipoUsuario
                $lista = $controller->consultarTurma();

                        // Inclui o select com os tipos de usuário na página
                echo "<label class='labelCadAux'>Turma</label>";
                echo"<br>";
                echo "<select class='select-regular' name='turm' id='turm'>";
                foreach ($lista as $obj) {
                    if($codTurma == $obj->getId()){
                        echo "<option  value='{$obj->getId()}' selected='selected'>{$obj->getDescricao()}</option>";
                    }else{
                        echo "<option  value='{$obj->getId()}'>{$obj->getDescricao()}</option>"; 
                    }
                }
                echo "</select>";
                
                

                        // Instancia a classe ControllerTipoUsuario
                $control = new ControllerUsuario();
                        // Recebe o retorno do método listarTipoUsuario
                $list = $control->consultarUsuarioProfessor();

                        // Inclui o select com os tipos de usuário na página
                echo"<br>";
                echo "<label class='labelCadAux'>Professor</label>";
                echo"<br>";
                echo "<select class='select-regular' name='professores' id='professores'>";
                foreach ($list as $prof) {
                    if($prof->getId() == $codProf){
                        echo "<option value='{$prof->getId()}' selected='selected'>{$prof->getNome()}</option>";
                    }else{
                        echo "<option value='{$prof->getId()}'>{$prof->getNome()}</option>";
                    }
                    
                }
                echo "</select>";
                

                ?>
                
                
                <?php
                
                echo("<div class='praBaixo2'>");
                echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editaProfessorTurma('.$codigo.')">');
                
                echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarProfessorTurma.php')".">");
                echo("</div");
                ?>
                
            </div>

        </form>
        
        <img src="../Imagens/ImagensCadastrosAuxiliares/Professores%20Por%20Turma.png" alt="">
    </fieldset>
</div>

<script type="text/javascript" language="javascript">

    function abaconsultaprofturma(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };
        function editaProfessorTurma(cod)
        {
            var turmas = document.getElementById("turm").value; 
            var professores = document.getElementById("professores").value; 

            $.ajax({
                asyn: false,
                type: "POST",
                url: "CorreioProfessorTurma2.php",
                data:{
                    turma : turmas,
                    professor: professores,
                    codigo: cod

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