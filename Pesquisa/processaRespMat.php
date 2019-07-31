<?php  

// if(empty($_POST["txRespMat"])){} else { $parametro= "%".$_POST['txRespMat']."%";}
// if(isset($parametro)){ $parametro = "%".$_POST['txRespMat']."%";}else{$parametro = "%".$_POST['txRespMat']."%";}
$parametro = isset($_POST['txRespMat']) ? "%".$_POST['txRespMat']."%" : null;


include_once("../DAO/Conexao.php");


	   //Paginação
$db = Conexao::conexao();
$i = 1;

$listarresp_pg=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel FROM tbresponsavel");
$listarresp_pg->execute();

$count = $listarresp_pg->rowCount();
$calculo = ceil(($count/3));

$url = 0;
$mody =0;
if (isset($_GET['pageResp']) == $i) {
	$url= $_GET['pageResp'];
	$mody = ($url*3)-3;
}


Conexao::desconexao();
        //Paginação
?>	


<div class="div-resultRespMat">
	<div class="div-itens-consulta">
		<?php 
	 // Abre a conexão com o banco de dados
		$pdo = Conexao::conexao();
	// Prepara a consulta de pesquisa 
		$cmd = $pdo->prepare("SELECT  codResponsavel, nomeResponsavel, cpfResponsavel, rgResponsavel, dataNascResponsavel, telefoneResidencialResponsavel FROM tbresponsavel 
			where nomeResponsavel like :parametro 
			or cpfResponsavel like :parametro or nacionalidadeResponsavel like :parametro or rgResponsavel like :parametro or dataNascResponsavel like :parametro LIMIT 3 OFFSET {$mody}");

    // Substitui os parâmetros/pseudônomes pelo valor da variável 
		$cmd->bindParam(":parametro", $parametro, PDO::PARAM_STR); 
	// Executa a consulta
		$cmd->execute();     
	// Fecha a conexão com o banco de dados  
		Conexao::desconexao();


		echo("<table class='bordasimples5' cellspacing='0'>");
		echo("<thead>");
		echo("<tr>");

		echo("<td class='tituloTabelaCadAux2'>Selecionar</td>");
		echo("<td class='tituloTabelaCadAux1'>Nome</td>");
		echo("<td class='tituloTabelaCadAux1'>CPF</td>");
		echo("<td class='tituloTabelaCadAux1'>RG</td>");
		echo("<td class='tituloTabelaCadAux1'>Data de Nascimento</td>");
		echo("<td class='tituloTabelaCadAux1'>Telefone Fixo</td>");

		echo("</tr>");
		echo("</thead>");
		echo("<tbody>");

		while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {
			echo("<tr>");

			echo("<td class='linhaTabelaCadAux2'>");
			echo ("<input type='radio' class='radio-regular' name='radioresp' id='radioresp' value='{$reg['codResponsavel']}'>");
			echo("</td>");


			echo("<td class='linhaTabelaCadAux1'>");
			echo($reg["nomeResponsavel"]);
			echo("</td>");

			echo("<td class='linhaTabelaCadAux1'>");
			echo($reg["cpfResponsavel"]);
			echo("</td>");


			echo("<td class='linhaTabelaCadAux1'>");
			echo($reg["rgResponsavel"]);
			echo("</td>");

			echo("<td class='linhaTabelaCadAux1'>");
			echo($reg["dataNascResponsavel"]);
			echo("</td>");


			echo("<td class='linhaTabelaCadAux1'>");
			echo($reg["telefoneResidencialResponsavel"]);
			echo("</td>");


			echo("<td>");

			echo("<div class='iconTabela'>");


			echo("<a href='#' name='editar' value='' id='editar' onclick='editarresponsavel(".$reg["codResponsavel"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
			echo(" ");


			echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluirresponsavel(".$reg["codResponsavel"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
			echo(" ");

			echo("<a href='../Reports/reportsResponsavel.php?key_rpt_resp=especific&id_resp=(".$reg['codResponsavel'].")' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>  ");
			echo("</td>");

			echo("</tr>");	

		}

		echo("</tbody>");
		echo("</table>");
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
			echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=$voltar')"."><</a>";
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
				echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=$i')".">$i</a>";
				echo("</li>");
				$i++;
				if($i > 10){
					echo "<li>"; 
					echo "<a>...</a>";
					echo "</li>"; 

					if(@$pagina > 11){
						echo "<li>"; 
						echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=$valorAtual')".">$valorAtual </a>";
						echo "</li>"; 
					}else{
						echo "<li>"; 
						echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=11')".">11</a>";
						echo "</li>"; 
					}
					if (@$pagina <  ($calculo +5)) {
						echo "<li>"; 
						echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=$seguir')".">></a>";
						echo "</li>"; 
					}
					break;
				}  
			}
			echo("</ul>");
    //Paginação
			?>
		</div>
	</div>
