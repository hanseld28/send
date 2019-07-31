<?php 

include_once("../DAO/Conexao.php");
$nomeAtividade = "%".$_POST['txAtividade']."%";
?>
<!--<h3 class="tituloConsultaCadAux">Atividade Extra Curricular</h3>-->
<div class="div-resultAtividade" >
  <div class="div-itens-consulta">
    <?php 
          // Abre a conexão com o banco de dados
    $pdo = Conexao::conexao();
        // Prepara a consulta de pesquisa 

         //PAGINAÇÃO//
    $i = 1;
    $listaratividade_pg=$pdo->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbatividadeextracurricular");
    $listaratividade_pg->execute();

    $count = $listaratividade_pg->rowCount();
    $calculo = ceil(($count/5));
    

    while ($i <= $calculo) {
      $i++;
    }

    $url = 0;
    $mody =0;
    if (isset($_GET['pageAtividade']) == $i) {
     $url= $_GET['pageAtividade'];
     $mody = $url*5-5;
   }
   
      //PAGINAÇÃO//
   
   $cmd = $pdo->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbatividadeextracurricular where descAtividadeExtraCurricular like :nomeAtividade LIMIT 5 OFFSET {$mody}");

        // Substitui os parâmetros/pseudônomes pelo valor da variável 
   $cmd->bindParam(":nomeAtividade", $nomeAtividade, PDO::PARAM_STR); 
        // Executa a consulta
   $cmd->execute();     
        // Fecha a conexão com o banco de dados  
   Conexao::desconexao();


   echo("<table class='bordasimples' cellspacing='0'>");
   echo("<thead>");
   echo("<tr>");
   /*echo("<td>Código</td>");*/
   echo("<td class='tituloTabelaCadAux'>Descrição</td>");
   echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
   
   echo("</tr>");
   echo("</thead>");
   echo("<tbody>");

   while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {				 
    echo("<tr>");

    echo("<td class='linhaTabelaCadAux'>");
    echo($reg["descAtividadeExtraCurricular"]);
    echo("</td>");

    echo("<td class='tdAcoes'>");
    
    echo("<div class='iconTabela'>");
    
    echo("<a href='#' name='editar' value='' id='editar' onclick='editaratividade(".$reg["codAtividadeExtraCurricular"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
    echo(" ");
    echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluiratividade(".$reg["codAtividadeExtraCurricular"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
    
    echo("<a href='../Reports/reportsAtividadeExtraCurricular.php?key_rpt_atividade=especific&id_atividade={$reg['codAtividadeExtraCurricular']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
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
echo "<ul class='paginacaoCadAux'>"; 

if(empty($_GET['pgatividade'])){} else { $pagina = $_GET['pgatividade'];}
if(isset($pagina)){ $pagina = $_GET['pgatividade'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
 echo "<li>"; 
 echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$voltar')"."><</a>";
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
   text-decoration: none;
   border: 1px solid rgba(9, 132, 227, 1.0);";
 }
 ?>

 <li <?php echo $estilo;?>>
  <?php
  echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$i')".">$i</a>";
  $i++;
  if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$valorAtual')".">$valorAtual</a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$seguir')".">$seguir</a>";
      echo "</li>"; 
    }
    break;
  }    

}
echo("</ul>");

?>