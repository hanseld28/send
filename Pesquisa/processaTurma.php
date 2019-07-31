<?php 

include_once("../DAO/Conexao.php");
$nomeTurma = "%".$_POST['txTurma']."%";


 //Paginação
$db = Conexao::conexao();
$i = 1;
$listarturma_pg=$db->prepare("SELECT codTurma, nomeTurma, codGrauEscolar FROM tbturma");
$listarturma_pg->execute();

$count = $listarturma_pg->rowCount();
$calculo = ceil(($count/5));


$url = 0;
$mody =0;
if (isset($_GET['pageTurma']) == $i) {
 $url= $_GET['pageTurma'];
 $mody = ($url*5)-5;
}
Conexao::desconexao();
 //Paginação

?>
<div class="div-itens-consulta">
  <div class="div-resultTurma">
    <?php 

        // Abre a conexão com o banco de dados
    $pdo = Conexao::conexao();
        // Prepara a consulta de pesquisa 

    $cmd = $pdo->prepare("SELECT codTurma, nomeTurma, descGrauEscolar FROM tbturma 
     INNER JOIN tbGrauEscolar on tbGrauEscolar.codGrauEscolar = tbturma.codGrauEscolar where nometurma like :nomeTurma 
     or descGrauEscolar like :nomeTurma LIMIT 5 OFFSET {$mody}");

        // Substitui os parâmetros/pseudônomes pelo valor da variável 
    $cmd->bindParam(":nomeTurma", $nomeTurma, PDO::PARAM_STR); 
        // Executa a consulta
    $cmd->execute();     
        // Fecha a conexão com o banco de dados  
    Conexao::desconexao();


    echo("<table class='bordasimples' cellspacing='0'>");
    echo("<thead>");
    echo("<tr>");
    /*echo("<td>Código</td>");*/
    echo("<td  class='tituloTabelaCadAux'>Turma</td>");
    echo("<td  class='tituloTabelaCadAux'>Grau</td>");
    echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
    echo("</tr>");
    echo("</thead>");
    echo("<tbody>");

    while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {				 
      echo("<tr>");

        /*echo("<td>");
        echo ($reg["codTurma"]);
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($reg["nomeTurma"]);
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>"); 
        echo($reg["descGrauEscolar"]);
        echo("</td>");
        
        echo("<td class='tdAcoesTurma'>");
        echo("<div class='iconTabela'>");
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarturma(".$reg["codTurma"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluirturma(".$reg["codTurma"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='cronograma' value='' id='cronograma' onclick='abrircronograma(".$reg['codTurma'].")'>Visualizar Cronograma da turma</a>");

        echo("<a href='../Reports/reportsTurma.php?key_rpt_turma=especific&id_turma={$reg['codTurma']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");
   
        echo("</td>");

        

        echo("</tr>");
        echo("</div>");
      }
      echo("</tbody>");
      echo("</table>");
      ?>
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
