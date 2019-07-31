<?php  

$nomeResp = "%".$_POST['txResp']."%";

include_once("../DAO/Conexao.php");


	   //Paginação
$db = Conexao::conexao();
$i = 1;

$listarresp_pg=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel FROM tbresponsavel ");
$listarresp_pg->execute();

$count = $listarresp_pg->rowCount();
$calculo = ceil(($count/8));

$url = 0;
$mody =0;
if (isset($_GET['pageResp']) == $i) {
	$url= $_GET['pageResp'];
	$mody = ($url*8)-8;
}


Conexao::desconexao();
        //Paginação
?>	


<div class="div-result">
	<?php 
	 // Abre a conexão com o banco de dados
	$pdo = Conexao::conexao();
	// Prepara a consulta de pesquisa 
	$cmd = $pdo->prepare("SELECT  codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel FROM tbresponsavel 
		where nomeResponsavel like :nomeResp 
		or cpfResponsavel like :nomeResp or nacionalidadeResponsavel like :nomeResp or rgResponsavel like :nomeResp or dataNascResponsavel like :nomeResp or sexoResponsavel like :nomeResp or profissaoResponsavel like :nomeResp or enderecoTrabalho like :nomeResp  or telefoneResidencialResponsavel like :nomeResp  or telefoneCelularResponsavel like :nomeResp  or telefoneTrabalhoResponsavel like :nomeResp  or grauParentescoResponsavel like :nomeResp  LIMIT 8 OFFSET {$mody}");

    // Substitui os parâmetros/pseudônomes pelo valor da variável 
	$cmd->bindParam(":nomeResp", $nomeResp, PDO::PARAM_STR); 
	// Executa a consulta
	$cmd->execute();     
	// Fecha a conexão com o banco de dados  
	Conexao::desconexao();

	echo("<div class='div-itens-consulta'>");
	echo("<table class='bordasimples4' cellspacing='0'>");
	echo("<thead>");
	echo("<tr>");
	/*echo("<td>Código</td>");*/
	echo("<td class='tituloTabelaCadAux'>Nome</td>");
	echo("<td class='tituloTabelaCadAux'>CPF</td>");
	echo("<td class='tituloTabelaCadAux'>RG</td>");
	echo("<td class='tituloTabelaCadAux'>Data nascimento</td>");
	// echo("<td class='tituloTabelaCadAux'>Profissão</td>");
	echo("<td class='tituloTabelaCadAux'>End. do trabalho</td>");
	echo("<td class='tituloTabelaCadAux'>Telefone</td>");
	echo("<td class='tituloTabelaCadAux'>Celular</td>");
	echo("<td class='tituloTabelaCadAux'>Telefone do trabalho</td>");
	echo("<td class='tituloTabelaCadAux'>Grau de parentesco</td>");
	echo("<td class='tituloTabelaCadAux'>Ações</td>");
	echo("</tr>");
	echo("</thead>");
	echo("<tbody>");

	while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {
		echo("<tr>");

		/*echo("<td>");
		echo ($reg["codResponsavel"]);
		echo("</td>");*/

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["nomeResponsavel"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cpfResponsavel"]);
		echo("</td>");

		// echo("<td class='linhaTabelaCadAux'>");
		// echo($reg["nacionalidadeResponsavel"]);
		// echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["rgResponsavel"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["dataNascResponsavel"]);
		echo("</td>");

		// echo("<td class='linhaTabelaCadAux'>");
		// echo($reg["sexoResponsavel"]);
		// echo("</td>");

		// echo("<td class='linhaTabelaCadAux'>");
		// echo($reg["profissaoResponsavel"]);
		// echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["enderecoTrabalho"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["telefoneResidencialResponsavel"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["telefoneCelularResponsavel"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["telefoneTrabalhoResponsavel"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["grauParentescoResponsavel"]);
		echo("</td>");


		echo("<td>");

		echo("<div class='iconTabela'>");

		echo("<a href='#' name='vermais' id='vermais' onclick='vermais(".$reg["codResponsavel"].")'><div class='iconTabela'><img class='imgverMais' src='../Imagens/none.png'></div></a>");

		echo("<a href='#' name='editar' value='' id='editar' onclick='editarresponsavel(".$reg["codResponsavel"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
		echo(" ");

		
		echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluirresponsavel(".$reg["codResponsavel"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
		echo(" ");

		echo("<a href='../Reports/reportsResponsavel.php?key_rpt_resp=especific&id_resp={$reg['codResponsavel']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>  ");
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
        //Paginação
	echo("<ul class='paginacaoCadAux'>");
	if(empty($_GET['pageResp'])){} else { $pagina = $_GET['pageResp'];}
	if(isset($pagina)){ $pagina = $_GET['pageResp'];}else{$pagina =1;}

	$voltar = $pagina - 1;
	$seguir = $pagina + 1;
	$valorAtual = $pagina;

	if( $pagina !=  1){
		echo "<li>"; 
		echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$voltar')"."><</a>";
		echo "</li>";
	}else{}

         // $pg =  $_POST["pageResp"];
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
			border-radius: 0px;
			border: 1px solid rgba(9, 132, 227, 1.0);";
		}
		?>
		<li <?php echo $estilo;?>>
			<?php                 
			echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$i')".">$i</a>";
			echo("</li>");
			$i++;
			if($i > 10){
				echo "<li>"; 
				echo "<a>...</a>";
				echo "</li>"; 

				if(@$pagina > 11){
					echo "<li>"; 
					echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$valorAtual')".">$valorAtual </a>";
					echo "</li>"; 
				}else{
					echo "<li>"; 
					echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=11')".">11</a>";
					echo "</li>"; 
				}
				if (@$pagina <  ($calculo +5)) {
					echo "<li>"; 
					echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$seguir')".">></a>";
					echo "</li>"; 
				}
				break;
			}  
		}
		echo("</ul>");
    //Paginação
		?>
	</div>
