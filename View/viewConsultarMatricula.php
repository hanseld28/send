<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php



include_once("../Controller/ControllerMatricula.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
$controller = new ControllerMatricula();
    // Recebe o retorno do método consultarPeriodo
$lista = $controller->consultarMatricula();


      //Paginação
$db = Conexao::conexao();
$i = 1;
$listarmatricula_pg=$db->prepare("SELECT codMatricula, dataMatricula, codAluno, codTurma FROM tbmatricula");
$listarmatricula_pg->execute();

$count = $listarmatricula_pg->rowCount();
$calculo = ceil(($count/8));

Conexao::desconexao();

       //Paginação 
?>
<div class="cimaPesquisa">
 <div class="barraPesquisaGeral">
  <label>Matrícula</label>
  <form autocomplete="off">
    <input type="text" placeholder="Pesquisar..." id="txMatricula" name="txMatricula" class="barraPesquisa">
    <div class="barraPesquisaBotao"> <img src="../Imagens/magnifying-glasslll.png" alt=""></div>
  </form>
</div>
</div>

<a href='../Reports/reportsMatricula.php?key_rpt_matricula=all' target="_blank"><div class="abrirAbaCadastro"><img src="../Imagens/printer.png" alt=""></div></a>

<div id="div-resultMatricula" class="div-result">

  <table class="bordasimples2" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux">Data</td>
        <td class="tituloTabelaCadAux">Número</td>
        <td class="tituloTabelaCadAux">Aluno</td>
        <td class="tituloTabelaCadAux">Turma</td>
        <!--<td class="tituloTabelaCadAux">Nº Matrícula</td>-->
        <td class="tituloAcoesTabelaCadAux">Ações</td>
      </tr>
    </thead>
    <tbody>



      <?php

      foreach ($lista as $obj) {
        echo("<tr>");

        /*echo("<td class='linhaTabela'>");
        echo ($obj->getId());
        echo("</td>");*/
        $aux = str_replace('-', '/', $obj->getData());
        $data = date('d/m/Y', strtotime($aux));
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($data);
        echo("</td>");

        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getNumero());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->aluno->getNome());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->turma->getDescricao());
        echo("</td>");
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarmatricula(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirmatricula(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        
        echo("<a href='../Reports/reportsMatricula.php?key_rpt_matricula=especific&id_matricula={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>  ");
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");
      }
      ?>
    </tbody>
  </table>

  <?php

  echo("<ul class='paginacaoCadAux'>");

  if(empty($_GET['pageMatricula'])){} else { $pagina = $_GET['pageMatricula'];}
  if(isset($pagina)){ $pagina = $_GET['pageMatricula'];}else{$pagina =1;}

  $voltar = $pagina - 1;
  $seguir = $pagina + 1;
  $valorAtual = $pagina;

  if( $pagina !=  1){
   echo "<li>"; 
   echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$voltar')"."><</a>";
   echo "</li>";
 }else{}

         // $pg =  $_POST["pageAluno"];
 while ($i <= $calculo) {
  $estilo= "";
  if($pagina == $i){
   $estilo = "div style='position: relative;
   display: block;
   width: 35px;
   height: 35px;
   font-size: 20px;
   text-align: center;
   line-height: 35px;
   background-color: rgba(9, 132, 227, 1.0);
   color: white;
   margin-top:0px;
   text-decoration: none;
   border-radius: 0px;
   border: 1px solid rgba(9, 132, 227, 1.0);";
 }
 ?>
 <li <?php echo $estilo;?>>
   <?php                 
   echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$i')".">$i</a>";
   echo "</li>";

   $i++;
   if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$valorAtual')".">$valorAtual</a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }    
}

echo "</ul>";


?>
</div>





<script type="text/javascript" language="javascript">
        //Paginação
        function pgmatricula(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
        //Paginação


        function excluirmatricula(id) {
         
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
              url: "viewExcluirMatricula.php",
              dataType: "html",
              type: "POST",
              data: {
                id: id
              },
              success: function(data) {
                $('#painelAbas').html(data);
              },
            });
      
        } 
      });
      }
      
      
      

      function editarmatricula(id) {
        $.ajax({

          asyn: false,
          url: "edicaoMatricula.php",
          datatype: "html",
          type: "POST",
          data: {
            id: id
          },
          success: function(data) {
            $('#painelAbas').html(data);
          },
        });
      }

    </script>
