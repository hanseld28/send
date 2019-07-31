<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerMatricula.php");
include_once("../Controller/ControllerTurma.php");
include_once("../Model/Turma.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");
include_once("../Controller/AlunoCRUD.php");
$turmas = "";
$nomeatividade = "";
$codMatricula = 0;
$nomet = "";
if(isset($_POST['id'])){
  $codMatricula = $_POST['id'];
  $crud = new ControllerMatricula();
  $matricula = $crud->preencherMatricula($codMatricula);

  $codAluno = $matricula->aluno->getCodigo();

  $crudaluno = new AlunoCRUD();
  $dadoaluno = $crudaluno->ConsultaAluno($codAluno); 

  $controller = new ControllerAtividadeExtraCurricular();
  $atividades = $controller->consultarPorMatricula($codMatricula);
  
  $consultaatividades = $controller->consultarAtividadeExtraCurricular();
  
  $codturma = $matricula->turma->getId();
  $crud2 = new ControllerTurma();
  $crud3 = new ControllerTurma();
  $turma = $crud2->preencherTurma($codturma);
  $turmas = $crud3->consultarTurma();
  

  foreach($atividades as $atividade){
    $nomeatividade = $nomeatividade.",".$atividade->getDescricao();   
  }


  $nomet = $turma->getDescricao();


}else{}

?>

<a href="#" id="abaconsultamatri" name="abaconsultamatri" onclick="abaconsultama('viewConsultarMatricula.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png" alt=""></div></a>
<div class="cimaPesquisa">
 <h2 class="tituloTop">Editar Matrícula</h2>
</div>

<script type="text/javascript" language="javascript">

  function abaconsultama(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };

          function editarMatricula(codigo)
          {
            arr = [];
            $("input:checkbox[name=ckbAtividade]:checked").each(function(){
              arr.push($(this).val());
            });


            var turma = document.getElementById("cod_turma").value;
            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioMatricula2.php",
              data:{
                turma_matricula: turma,
                data_matricula: $('#data').val(),
                numero_matricula: $('#num').val(),
                cod_matricula: codigo,
                atividades_matricula: arr,
              },
              success: function(data){
                $('#painelAbas').html(data);  
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

             $("#painelAbas").load(pagina); 

           } 
        });
        }

      </script>

      <div class="FormEditarAlunoMatriculaEdit">
       <div class="fotoDePerfilAlunoMatricula" id='visualizar'>
         <h1>
          <?php
          foreach($dadoaluno as $dado){
            $nome_foto = $dado->getFoto();
            $nome = $dado->getNome();
          }
          echo "<img src='../fotos/".$nome_foto."' id='previsualizar'>";
          echo("<br>");
          echo($nome);
          ?>
        </h1>
      </div>
      <form method="post" action="#">
       <div class="caixaTexto">
         <label>Número da Matrícula</label>
         <br>
         <input class="regular-input-text-logradouro" type="text" value="<?php echo($matricula->getNumero()); ?>" id="num" name="num" class="data">
       </div>



       <label>Turma</label>
       <br>   
       <select class="select-regular" name='cod_turma' id='cod_turma'>

         <?php
         foreach ($turmas as $t){

           if($t->getDescricao() == $nomet){
             echo "<option value='{$t->getid()}' selected='selected'>{$t->getDescricao()}</option>";   
           }else{
             echo "<option value='{$t->getId()}' >{$t->getDescricao()}</option>";   
           }
         }
         ?>

       </select>

       <br>

       <?php

       $atividades = $nomeatividade;

       function no_array($valor) {
        global $atividades;

        $Array = $atividades;
        $Array = explode(',', $atividades);
        if(in_array($valor, $Array)) {
          return "checked='checked'";

        }
      }
      ?>
      
      <?php

      foreach ($consultaatividades as $lista ){
       $variavel = $lista->getDescricao();
       $codatv = $lista->getId(); 
       $retorno = no_array($variavel);    
       echo(" <input class='checkbox-regular' type='checkbox' name='ckbAtividade' id='ckbAtividade' value='".$codatv."' ".$retorno."> ".$variavel." ");
     }


     ?>
     <br>
     <br>
     <div class="caixaTexto">
       <label>Data Matrícula</label>
       <?php
       $aux = str_replace('-', '/', $matricula->getData());
       $data = date('d/m/Y', strtotime($aux));
       ?>
       <br>  
       <input class="regular-input-text-logradouro" type="text" value="<?php echo($data); ?>" id="data" name="data" class="data">
     </div>


     <br>  
     <?php
     echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarMatricula.php')".">");


     echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarMatricula('.$codMatricula.')">');

     ?>
   </form>
 </div>



 <?php
 include_once("../rod.php");
 ?>