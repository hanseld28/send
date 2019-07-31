<?php

$nomeProfTurma = "%".$_POST['txProfTurma']."%";
include_once("../DAO/Conexao.php");


?>

<?php 

	    // Abre a conexão com o banco de dados
$pdo = Conexao::conexao();
		// Prepara a consulta de pesquisa 

    //PAGINAÇÃO//
$i = 1;
$listarprofturma_pg=$pdo->prepare("SELECT codprofessorTurma, codTurma, codUsuario FROM tbprofessorturma");
$listarprofturma_pg->execute();

$count = $listarprofturma_pg->rowCount();
$calculo = ceil(($count/5));


$url = 0;
$mody =0;
if (isset($_GET['pageProfTurma']) == $i) {
	$url= $_GET['pageProfTurma'];
	$mody = ($url*5)-5;
}
      //PAGINAÇÃO//


$cmd = $pdo->prepare("SELECT codprofessorTurma, nomeTurma, nomeUsuario FROM tbprofessorturma
	INNER JOIN tbTurma ON tbprofessorturma.codTurma = tbturma.codTurma
	INNER JOIN tbusuario ON tbprofessorturma.codUsuario = tbusuario.codUsuario where nomeTurma LIKE :nomeProfTurma or nomeUsuario LIKE :nomeProfTurma LIMIT 5 OFFSET {$mody}");

		// Substitui os parâmetros/pseudônomes pelo valor da variável 
$cmd->bindParam(":nomeProfTurma", $nomeProfTurma, PDO::PARAM_STR); 
	    // Executa a consulta
$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
Conexao::desconexao();


echo("<div class='div-result'>");
echo("<div class='div-itens-consulta'>");


echo("<table class='bordasimples' cellspacing='0'>");
echo("<thead>");
echo ("<tr>");
echo ("<td class='tituloTabelaCadAux'>Nome da turma</td>");
echo ("<td class='tituloTabelaCadAux'>Nome do professor</td>");
echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
echo ("</tr>");
echo ("</thead>");
echo (" <tbody>");

while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {						 
	echo("<tr>");

        // echo("<td>");
        // echo ($reg["codTurma"]);
        // echo("</td>"); 

	echo("<td class='linhaTabelaCadAux'>");
	echo($reg["nomeTurma"]);
	echo("</td>");

	echo("<td class='linhaTabelaCadAux'>");
	echo($reg["nomeUsuario"]);
	echo("</td>");

	echo("<td class='tdAcoes'>");

	echo("<div class='iconTabela'>");
	echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$reg["codprofessorTurma"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
	echo(" ");

	echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$reg["codprofessorTurma"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

	echo("<a href='../Reports/reportsProfessorTurma.php?key_rpt_profturma=especific&id_profturma={$reg['codprofessorTurma']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");


	echo("</td>");

	echo("</tr>");
	echo("</div>");
}
echo("</tbody>");
echo("</table>");

echo("</div>");
echo("</div>");
?>


<?php

echo("<ul class='paginacaoCadAux'>");
if(empty($_GET['pageProfTurma'])){} else { $pagina = $_GET['pageProfTurma'];}
if(isset($pagina)){ $pagina = $_GET['pageProfTurma'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
	echo "<li>"; 
	echo "<a href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=$voltar')"."><</a>";
	echo "</li>";
}else{}

         // $pg =  $_POST["pageProfTurma"];
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
		echo "<a  href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=$i')".">$i</a>";
		echo("</li>");
		$i++;
		if($i > 10){
			echo "<li>"; 
			echo "<a>...</a>";
			echo "</li>"; 

			if(@$pagina > 11){
				echo "<li>"; 
				echo "<a  href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=$valorAtual')".">$valorAtual </a>";
				echo "</li>"; 
			}else{
				echo "<li>"; 
				echo "<a  href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=11')".">11</a>";
				echo "</li>"; 
			}
			if (@$pagina <  ($calculo +5)) {
				echo "<li>"; 
				echo "<a  href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=$seguir')".">></a>";
				echo "</li>"; 
			}
			break;
		}  

	}
	echo("</ul>");
	?>
