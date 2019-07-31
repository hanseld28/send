<?php

$nomeItens = "%".$_POST['txItens']."%";

include_once("../DAO/Conexao.php");

?>

<div class="div-result">

	<?php 
	
	    // Abre a conexão com o banco de dados
	$pdo = Conexao::conexao();
		// Prepara a consulta de pesquisa


		 //PAGINAÇÃO
	$i = 1;
	$listarItemCronograma_pg=$pdo->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma");
	$listarItemCronograma_pg->execute();

	$count = $listarItemCronograma_pg->rowCount();
	$calculo = ceil(($count/5));

	while ($i <= $calculo) {
		$i++;
	}

	$_POST['calculoItensCronograma'] = $calculo;

	$url = 0;
	$mody =0;
	if (isset($_GET['pageItensCronograma']) == $i) {
		$url= $_GET['pageItensCronograma'];
		$mody = ($url*5)-5;
	}
//PAGINAÇÃO 

	$cmd = $pdo->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma where descItensCronograma LIKE :nomeItens or horarioCronograma LIKE :nomeItens LIMIT 5 OFFSET {$mody}");

		// Substitui os parâmetros/pseudônomes pelo valor da variável 
	$cmd->bindParam(":nomeItens", $nomeItens, PDO::PARAM_STR); 
	    // Executa a consulta
	$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
	Conexao::desconexao();



	echo("<table class='bordasimples' cellspacing='0'>");
	echo("<thead>");
	echo ("<tr>");
	echo ("<td class='tituloTabelaCadAux'>Descrição</td>");
	echo ("<td class='tituloTabelaCadAux'>Horário</td>");
  echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
  echo ("</tr>");
  echo ("</thead>");
  echo ("<tbody>");

  while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {						 
    echo("<tr>");

        // echo("<td>");
        // echo ($reg["codTurma"]);
        // echo("</td>"); 

    echo("<td class='linhaTabelaCadAux'>");
    echo($reg["descItensCronograma"]);
    echo("</td>");

    echo("<td class='linhaTabelaCadAux'>");
    echo($reg["horarioCronograma"]);
    echo("</td>");
    
    echo("<td class='tdAcoes'>");
    
    echo("<div class='iconTabela'>");
    echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$reg["codItensCronograma"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
    echo(" ");
                        //echo("<a href='editaExcluiCargo.php?acao=excluir&codcargo=".$obj->getCodigo()."'>Excluir</a>");
    echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$reg["codItensCronograma"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

    echo("<a href='../Reports/reportsItensCronograma.php?key_rpt_itenscronograma=especific&id_itenscronograma={$reg['codItensCronograma']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");

                        //echo("<a href='#' id='".$obj->getCodigo()."' class='deleta'>Excluir</a>");
    echo("</td>");



    echo("</tr>");
  }
  echo("</tbody>");
  echo("</table>");
  ?>
</div>

<?php	
    //Paginação
$i = 1;
$calculo = ($_POST['calculoItensCronograma']) ? $_POST['calculoItensCronograma'] : null;

echo("<ul class='paginacaoCadAux'>");
if(empty($_GET['pageItensCronograma'])){} else { $pagina = $_GET['pageItensCronograma'];}
if(isset($pagina)){ $pagina = $_GET['pageItensCronograma'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
 echo "<li>"; 
 echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$voltar')"."><</a>";
 echo "</li>";
}else{}

         // $pg =  $_POST["pageItensCronograma"];
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
  echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma={$i}')".">$i</a>";
  $i++;
  if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$valorAtual')".">$valorAtual </a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }  
}
echo("</ul>");

        //Paginação