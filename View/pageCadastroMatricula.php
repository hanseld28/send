<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
include_once("../cab.php");
include_once("../Controller/AlunoCRUD.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Model/Usuario.php");
include_once("verificaUsuarioLogado.php");

$num = 0;

if(isset($_SESSION['numeroMatriculaAluno'])){
    $num = $_SESSION['numeroMatriculaAluno'];
}else{
    $num = 0000;
}


// Data/Horário atual do Servidor Host
#######################################################
date_default_timezone_set("America/Araguaina");
#######################################################
?>

  <script type="text/javascript">  
    $('#txtdata').mask('00/00/0000'); 
  </script>


<!-- =================================================================================== -->

<div class="cimaPesquisaAluno">
 <div class="passosCadastros">
  <ul class="barraProgresso">
    <li class="ativo">Aluno</li>
    <li class="ativo2">Responsável</li>
    <li>Matrícula</li>
    <li>Prontuário</li>
    <li>Revisão</li>
  </ul>
</div>
</div>



<div class="formCadastroMatricula">
  <fieldset>
    <legend><h4>Cadastro da Matrícula</h4></legend>
    <form action="" method="post">

      <div class="caixaTexto">
       <p class="labelsMatricula">Data</p>
       <input type='text' name='txtdata' id='txtdata' class="regular-input-text-logradouro">
     </div>

     <div class="caixaTexto">
       <p class="labelsMatricula">Número da Matrícula</p>
       <input type='text' name='txtnumero' id='txtnumero' value='<?php echo($num); ?>' class='regular-input-text-logradouro' disabled>
     </div>



     <?php
     include_once("..\Controller\ControllerTurma.php");
    // Instancia a classe ControllerTipoUsuario
     $controller = new ControllerTurma();
    // Recebe o retorno do método listarTipoUsuario
     $lista = $controller->consultarTurma();

    // Inclui o select com os tipos de usuário na página
     echo "<p class='labelsMatricula'>Turma</p>";
     echo "<select class='select-regular' name='turma1' id='turma1'>";
     foreach ($lista as $obj) {
      echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
    }

    echo "</select>";
    
    

    echo "</select>";
    ?>
    <?php

    include("..\Controller\ControllerAtividadeExtraCurricular.php");
    $control = new ControllerAtividadeExtraCurricular();
    $listaatividade = $control->consultarAtividadeExtraCurricular();

    echo "<p class='labelsMatricula'>Atividade Extra Curricular</p>";

    foreach ($listaatividade as $atividades){

      echo("<nobr><input class='checkbox-regular' type='checkbox' id='ckbAtividade' name='ckbAtividade' value='".$atividades->getId()."'> ".$atividades->getDescricao()."</nobr>");

    }


    ?>

  </form>
  <img src="../Imagens/registration(2).png" alt="">
  <input class="btnProxPasso"type="button" value="Próximo passo" onclick="carregarMatricula()">
</fieldset> 

</div>

<script type="text/javascript" language="javascript">

  function carregarMatricula(){

    if(document.getElementById("txtdata").value != "" &&
     document.getElementById("txtnumero").value != "" ){    

    var arr = [];
    var data = document.getElementById('txtdata').value;

    var objDate = new Date();
    objDate.setYear(data.split("/")[2]);
              objDate.setMonth(data.split("/")[1]  - 1);//- 1 pq em js é de 0 a 11 os meses
              objDate.setDate(data.split("/")[0]);

              if(objDate.getTime() > new Date().getTime()){
                AlertdeErro.render('<h1>A data da matrícula não pode ser maior que a data atual</h1>');
                document.getElementById('txtdata').focus();
                return false;

              }


              $("input:checkbox[name=ckbAtividade]:checked").each(function(){
                arr.push($(this).val());
              });


              var turmaaluno = document.getElementById("turma1").value;

              $.ajax({

                asyn: false,
                type: "POST",
                url: "CorreioMatricula.php",
                data:{
                  numeroM: $('#txtnumero').val(),
                  datam: $('#txtdata').val(),
                  turma: turmaaluno,
                  atividades: arr

                },
                success: function(data){
                  $('#painelAbas').html(data);  
                }
              });
            }else{e
              AlertdeErro.render('<h1>Preencha todos os campos!</h1>')
            }
          }
        </script>
        




        <?php
        include_once("../rod.php");
        ?>