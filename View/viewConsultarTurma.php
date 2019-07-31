<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php
include_once("../Controller/ControllerTurma.php");

	// Instancia a classe ControllerTipoUsuario
$controllerTurma = new ControllerTurma();
    // Recebe o retorno do método listarTipoUsuario
$listaTurmas = $controllerTurma->consultarTurma();


      //PAGINAÇÃO//
$db = Conexao::conexao();
$i = 1;
$listarturma_pg=$db->prepare("SELECT codTurma, codTurma, codGrauEscolar FROM tbturma");
$listarturma_pg->execute();

$count = $listarturma_pg->rowCount();
$calculo = ceil(($count/5));

Conexao::desconexao();
       //PAGINAÇÃO//

?>

<div class="barraPesquisaCadAux">
  <form autocomplete="off">
   <input type="text" placeholder="Pesquisar..." id="txTurma" name="txTurma" class="barraPesquisa">

   <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
 </form> 
</div>



<a  href="#" id="abacadastroturma" name="abacadastroturma" onclick="abacadastroturma('pageCadastroTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>

<a href='../Reports/reportsTurma.php?key_rpt_turma=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>
<h3 class="tituloConsultaCadAux">Turma</h3>
<div class="div-itens-consulta">
  <div id="div-resultTurma">


   <table class="bordasimples" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux">Turma</td>
        <td class="tituloTabelaCadAux">Grau</td>
        <td class="tituloAcoesTabelaCadAux">Ações</td>

      </tr>
    </thead>
    <tbody>


      <?php

      foreach ($listaTurmas as $obj) {

        echo("<tr>");
        
        /*echo("<td>");
        echo ($obj->getId());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getDescricao());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->grauEscolar->getDescricao());
        echo("</td>");
        
        echo("<td class='tdAcoesTurma'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarturma(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluirturma(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        echo(" ");
        
        echo("<a href='../Reports/reportsTurma.php?key_rpt_turma=especific&id_turma={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");
        echo("<a href='#' name='cronograma' value='' id='cronograma' onclick='abrircronograma(".$obj->getId().")'>Visualizar Cronograma da turma</a>");
        
        
        
        echo("</td>");
        
        
        
        echo("</tr>");
        
        echo("</div>");
      }



      echo("</tbody>");
      echo("</table>");
      ?>

    </div>
  </div>

  <?php

  echo("<ul class='paginacaoCadAux'>");
  if(empty($_GET['pageTurma'])){} else { $pagina = $_GET['pageTurma'];}
  if(isset($pagina)){ $pagina = $_GET['pageTurma'];}else{$pagina =1;}

  $voltar = $pagina - 1;
  $seguir = $pagina + 1;
  $valorAtual = $pagina;

  if( $pagina !=  1){
   echo "<li>"; 
   echo "<a href='#' id='pgturma' name='pgturma' onclick="."pgturma('viewConsultarTurma.php?pageTurma=$voltar')"."><</a>";
   echo "</li>";
 }else{}

         // $pg =  $_POST["pageTurma"];
 while ($i <= $calculo) {
  $estilo= "";
  if($pagina == $i){
   $estilo =  "div style='position: relative;
   display: block;
   width: 35px;
   height: 35px;
   font-size: 20px;
   text-align: center;
   line-height: 35px;
   background-color: rgba(9, 132, 227, 1.0);
   color: white;
   text-decoration: none;
   border: 1px solid rgba(9, 132, 227, 1.0);";
 }
 ?>
 <li <?php echo $estilo;?>>
  <?php 
  echo "<a href='#' id='pgturma' name='pgturma' onclick="."pgturma('viewConsultarTurma.php?pageTurma=$i')".">$i</a>";
  echo "</li>"; 
  $i++;
  if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a href='#' id='pgturma' name='pgturma' onclick="."pgturma('viewConsultarTurma.php?pageTurma=$valorAtual')".">$valorAtual </a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a href='#' id='pgturma' name='pgturma' onclick="."pgturma('viewConsultarTurma.php?pageTurma=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a href='#' id='pgturma' name='pgturma' onclick="."pgturma('viewConsultarTurma.php?pageTurma=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }  


}
echo("</ul>");



?>
<script type="text/javascript" language="javascript">
  function abacadastroturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);                   
                
              };
              


        //Paginação
        function pgturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };
        //Paginação
        
        function excluirturma(id){
         swal({
          title: "Deseja Excluir?",
          icon: "warning",
          buttons: [
          'Cancelar',
          'Excluir'
          ],
          dangerMode: true,
        }).then(function(isConfirm) { 
          if (isConfirm) {
           $.ajax({ 
            asyn: false,
            url: "viewExcluirTurma.php",
            dataType: "html",
            type: "POST",
            data: { id: id},
            success: function(data){
              $('#painelCadAuxliar').html(data);
            },
          }); 
         } 
      });
      }



      function editarturma(id){
        $.ajax({

          asyn: false,
          url: "edicaoTurma.php",
          datatype: "html",
          type:"POST",
          data: {id: id},
          success: function(data){
            $('#painelCadAuxliar').html(data);
          },
        });
      }

      function abrircronograma(cod){
        $.ajax({

          asyn: false,
          url: "viewConsultarCronogramaTurma.php",
          datatype: "html",
          type:"POST",
          data: {codigo: cod},
          success: function(data){
            $('#painelCadAuxliar').html(data);
          },
        });
      }


    </script>


    <script type="text/javascript">
    //oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
    $(document).ready(function(){       
      $('#txTurma').keyup(function(event){                
        $('form').submit(function(){
          var dados = $(this).serialize();

          $.ajax({

            url:'../Pesquisa/processaTurma.php',
            type: 'POST',
            dataType: 'html',
            data: dados,
            success:function(data){
              $('#div-resultTurma').empty().html(data);
            }                   
          });
          return false;
        });

        $('form').trigger('submit');            
      });     
    });
//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
</script>

