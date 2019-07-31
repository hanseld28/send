<?php

$nomeCaracteristicas = "%".$_POST['txCaracteristicas']."%";
//var_dump($nomeCaracteristicas);

include_once("../DAO/Conexao.php");

?>

<div class="div-result">

	<?php 
	
	    // Abre a conexão com o banco de dados
	$pdo = Conexao::conexao();
		// Prepara a consulta de pesquisa 

	$cmd = $pdo->prepare("SELECT codCaracteristicaSaude, descCaracteristicaSaude FROM tbcaracteristicasaude where descCaracteristicaSaude LIKE :nomeCaracteristicas");

		// Substitui os parâmetros/pseudônomes pelo valor da variável 
	$cmd->bindParam(":nomeCaracteristicas", $nomeCaracteristicas, PDO::PARAM_STR); 
	    // Executa a consulta
	$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
	Conexao::desconexao();

     //Paginação
	$db = Conexao::conexao();
	$i = 1;
	$listaraluno_pg=$db->prepare("SELECT codAluno, nomeAluno, rgAluno, cidadeAluno, logradouroAluno, numCasaAluno, dataNascAluno, cepAluno, complementoAluno FROM tbaluno");
	$listaraluno_pg->execute();

	$count = $listaraluno_pg->rowCount();
	$calculo = ceil(($count/5));

	Conexao::desconexao();

	$url = 0;
	$mody =0;
	if (isset($_GET['pageAluno']) == $i) {
		$url= $_GET['pageAluno'];
		$mody = ($url*5)-5;
	}
     //Paginação


	echo("<table class='bordasimples' cellspacing='0'>");
	echo("<thead>");
	echo ("<tr>");
	echo("<td class='tituloTabelaCadAux'>Descrição</td>");
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
		echo($reg["descCaracteristicaSaude"]);
		echo("</td>");

		echo("<td class='tdAcoes'>");
		echo("<div class='iconTabela'>");
		echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$reg["codCaracteristicaSaude"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
		echo(" ");
                        //echo("<a href='editaExcluiCargo.php?acao=excluir&codcargo=".$obj->getCodigo()."'>Excluir</a>");
		echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$reg["codCaracteristicaSaude"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

		echo("<a href='../Reports/reportsCargo.php?key_rpt_cargo=especific&id_caracteristica={$reg['codCaracteristicaSaude']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");

                        //echo("<a href='#' id='".$obj->getCodigo()."' class='deleta'>Excluir</a>");
		echo("</td>");



		echo("</tr>");
	}
	echo("</tbody>");
	echo("</table>");
	?>
</div>	

<?php
echo "<ul class='paginacaoCadAux'>"; 
if(empty($_GET['pageCaracteristicaSaude'])){} else { $pagina = $_GET['pageCaracteristicaSaude'];}
if(isset($pagina)){ $pagina = $_GET['pageCaracteristicaSaude'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
	echo "<li>"; 
	echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$voltar')"."><</a>";
	echo "</li>";
}else{}

         // $pg =  $_POST["pageCaracteristicaSaude"];
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

		echo "<a  href='#' id='pgcaracteristica' name='pgcaracteristica' onclick="."pgcaracteristica('viewConsultarCaracteristicaSuade.php?pageCaracteristica=$i')".">$i</a>";
		echo "</li>";
		$i++;
		if($i > 10){
			echo "<li>"; 
			echo "<a>...</a>";
			echo "</li>"; 

			if(@$pagina > 11){
				echo "<li>"; 
				echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$valorAtual')".">$valorAtual </a>";
				echo "</li>"; 
			}else{
				echo "<li>"; 
				echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=11')".">11</a>";
				echo "</li>"; 
			}
			if (@$pagina <  ($calculo +5)) {
				echo "<li>"; 
				echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$seguir')".">></a>";
				echo "</li>"; 
			}
			break;
		}
		echo "</ul>"; 
	}
 //Paginação
