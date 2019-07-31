<?php  

$nome = "%".$_POST['txNome']."%";

include_once("../DAO/Conexao.php");
include_once("../Controller/AlunoCRUD.php");


$listadealunos = array();

$aluno = new Aluno();
$crudaluno = new AlunoCRUD();

$listadealunos = $crudaluno->ListarAluno();

$aluno = $listadealunos;

     //Paginação
$db = Conexao::conexao();
$i = 1;
$listaraluno_pg=$db->prepare("SELECT codAluno, nomeAluno, rgAluno, cidadeAluno, logradouroAluno, numCasaAluno, dataNascAluno, cepAluno, complementoAluno FROM tbaluno");
$listaraluno_pg->execute();

$count = $listaraluno_pg->rowCount();
$calculo = ceil(($count/8));

Conexao::desconexao();

$url = 0;
$mody =0;
if (isset($_GET['pageAluno']) == $i) {
	$url= $_GET['pageAluno'];
	$mody = ($url*8)-8;
}

     //Paginação
?>	

<div class="div-result">
	<div class="div-itens-consulta">
		<?php 
		// // Abre a conexão com o banco de dados
		$pdo = Conexao::conexao();
		// // Prepara a consulta de pesquisa  
		$cmd = $pdo->prepare("SELECT codAluno, nomeAluno, logradouroAluno, complementoAluno, cepAluno, cidadeAluno, rgAluno, numCasaAluno, dataNascAluno FROM tbaluno 
			WHERE nomeAluno like :nome
			or logradouroAluno like :nome 
			or complementoAluno like :nome 
			or cepAluno like :nome
			or cidadeAluno like :nome
			or rgAluno like :nome 
			or numCasaAluno like :nome
			or dataNascAluno like :nome LIMIT 8 OFFSET {$mody}");



		
		// Substitui os parâmetros/pseudônomes pelo valor da variável 
		$cmd->bindParam(":nome", $nome, PDO::PARAM_STR); 
	    // Executa a consulta
		$cmd->execute(); 
        // Fecha a conexão com o banco de dados  
		Conexao::desconexao();

		echo("<table class='bordasimples4' cellspacing='0'>");
		echo("<thead>");
		echo ("<tr");
		/*echo   ("<th>Código do aluno</th>");*/

		echo("<td></td>");
		echo("<td class='tituloTabelaCadAux'>Nome</td>");
		echo("<td class='tituloTabelaCadAux'>RG</td>");
		echo("<td class='tituloTabelaCadAux'>Data de Nascimento</td>");
		echo("<td class='tituloTabelaCadAux'>Logradouro</td>");
		echo("<td class='tituloTabelaCadAux'>Complemento</td>");
		echo("<td class='tituloTabelaCadAux'>Nº Casa</td>");
		echo("<td class='tituloTabelaCadAux'>CEP</td>");
		echo("<td class='tituloTabelaCadAux'>Cidade</td>");
		echo("<td class='tituloTabelaCadAux'>Responsável</td>");
		echo("<td class='tituloTabelaCadAux'>Ações</td>");

		echo ("</tr>");
		echo ("</thead>");
		echo (" <tbody>");

	// Recebe os registros encontrados no banco de dados em forma de Array
		while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {



			echo("<tr>");

		/*echo("<td>");
		echo($reg["codAluno"]);
		echo("</td>");*/

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["nomeAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["rgAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["dataNascAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["logradouroAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["complementoAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["numCasaAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cepAluno"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cidadeAluno"]);
		echo("</td>");



		$responsavel;
		$pesqresp = new AlunoCRUD();
		$resp = $pesqresp->ConsultarResponsavel($reg["codAluno"]);
		
		echo("<td class='linhaTabelaCadAux'>");
		echo($resp);
		echo("</td>");
		
		
		echo("<td>");
		
		echo("<div class='iconTabela'>");

		echo("<a href='#'>
			<div class='iconTabela'><img class='imgverMais' src='../Imagens/none.png'></div></a>");
		
		echo("<a href='#' name='editar' value='' id='editar' onclick='editaraluno(".$reg["codAluno"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
		echo(" ");
		echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluiraluno(".$reg["codAluno"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
		echo(" ");
		
		echo("<a href='#' name='prontuario' value='' id='prontuario' onclick='abrirprontuario(".$reg["codAluno"].")'><div class='iconTabela'><img class='imgProntuario' src='../Imagens/none.png'></div></a>");


		echo("<a href='../Reports/reportsAluno.php?key_rpt_aluno=especific&id_aluno={$reg['codAluno']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
		echo("</td>");
		
		echo("</td>");


		echo("</tr>");


		echo("</div>");

	}
	echo ("</table>");
	
	
    //PAGINAÇÃO
	echo "<ul class='paginacaoCadAux'>"; 

	if(empty($_GET['pageAluno'])){} else { $pagina = $_GET['pageAluno'];}
	if(isset($pagina)){ $pagina = $_GET['pageAluno'];}else{$pagina =1;}

	$voltar = $pagina - 1;
	$seguir = $pagina + 1;
	$valorAtual = $pagina;

	if( $pagina !=  1){
		echo "<li>"; 
		echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$voltar')"."><</a>";
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
			border-radius: 0px;
			border: 1px solid rgba(9, 132, 227, 1.0);";
		}
		?>
		<li <?php echo $estilo;?>>
			<?php                 

			echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$i')".">$i</a>";
			echo "</li>"; 
			$i++;
			if($i > 10){
				echo "<li>"; 
				echo "<a>...</a>";
				echo "</li>"; 

				if(@$pagina > 11){
					echo "<li>"; 
					echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$valorAtual')".">$valorAtual</a>";
					echo "</li>"; 
				}else{
					echo "<li>"; 
					echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=11')".">11</a>";
					echo "</li>"; 
				}
				if (@$pagina <  ($calculo +5)) {
					echo "<li>"; 
					echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$seguir')".">></a>";
					echo "</li>"; 
				}
				break;
			}    
		}
		
		echo "</ul>";
            //PAGINAÇÃO
		?>
	</div>
</div>		
