<?php  

$nomeFunc = "%".$_POST['txFunc']."%";	

include_once("../DAO/Conexao.php");
include_once '../Controller/FuncionarioCRUD.php';
include_once '../Model/Funcionario.php';

        //instancia a classe crud
$list = new FuncionarioCRUD();
        //cria um array
$listagem = array();
        //instancia um novo funcionario
$funcionario = new Funcionario();

        //o array recebe o retorno do metodo listar funcionario
$listagem = $list->ListarFuncionario();

        //o funcionario recebe a lista de funcionarios
$funcionario = $listagem;


       //Paginação
$db = Conexao::conexao();
$i = 1;
$listarfunc_pg=$db->prepare("SELECT codFuncionario, nomeFuncionario, logradouroFuncionario, complementoFuncionario, cepFuncionario, cidadeFuncionario, rgFuncionario, cpfFuncionario, numCasaFuncionario FROM tbfuncionario");
$listarfunc_pg->execute();

$count = $listarfunc_pg->rowCount();
$calculo = ceil(($count/8));

Conexao::desconexao();

$url = 0;
$mody =0;
if (isset($_GET['pageFunc']) == $i) {
	$url= $_GET['pageFunc'];
	$mody = ($url*8)-8;
}


     //Paginação

?>	
<div class="div-itens-consulta">
	<div class="div-result">
		
		<?php 
	 	// Abre a conexão com o banco de dados
		$pdo = Conexao::conexao();
		// Prepara a consulta de pesquisa 
		$cmd = $pdo->prepare("SELECT codFuncionario, nomeFuncionario, logradouroFuncionario, complementoFuncionario, cepFuncionario, cidadeFuncionario, rgFuncionario, cpfFuncionario, numCasaFuncionario FROM tbfuncionario 
			WHERE nomeFuncionario like :nomeFunc
			or numCasaFuncionario like :nomeFunc 
			or logradouroFuncionario like :nomeFunc 
			or complementoFuncionario like :nomeFunc 
			or cepFuncionario like :nomeFunc
			or cpfFuncionario like :nomeFunc
			or cidadeFuncionario like :nomeFunc
			or rgFuncionario like :nomeFunc LIMIT 8 OFFSET {$mody}");
		// Substitui os parâmetros/pseudônomes pelo valor da variável 
		$cmd->bindParam(":nomeFunc", $nomeFunc, PDO::PARAM_STR); 
	    // Executa a consulta
		$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
		Conexao::desconexao();

		echo("<table class='bordasimples3' cellspacing='0'>");
		echo("<thead>");
		echo("<tr>");
		/*echo("<td>Código</td>");*/
		echo("<td class='tituloTabelaCadAux'>Nome</td>");
		echo("<td class='tituloTabelaCadAux'>Rg</td>");
		echo("<td class='tituloTabelaCadAux'>Cpf</td>");
		echo("<td class='tituloTabelaCadAux'>Logradouro</td>");
		echo("<td class='tituloTabelaCadAux'>Complemento</td>");
		echo("<td class='tituloTabelaCadAux'>Nº Casa</td>");
		echo("<td class='tituloTabelaCadAux'>CEP</td>");
		echo("<td class='tituloTabelaCadAux'>Cidade</td>");
		echo("<td class='tituloTabelaCadAux'>Cargo</td>");
		echo("<td class='tituloTabelaCadAux'>Ações</td>");
		echo("</tr>");
		echo("</thead>");

		echo("<tbody>");


		while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {		

			echo("<tr>");

		/*echo("<td>");
		echo($reg["codFuncionario"]);
		echo("</td>");*/

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["nomeFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["rgFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cpfFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo( $reg["logradouroFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["complementoFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["numCasaFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cepFuncionario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo($reg["cidadeFuncionario"]);
		echo("</td>");

		$cargos;
		$pesqcargos = new FuncionarioCRUD();
		$lista = $pesqcargos->ConsultarCargos($reg["codFuncionario"]);

		echo("<td class='linhaTabelaCadAux'>");
		foreach($lista as $cargos){
			echo($cargos);
			echo("<br>");
		}
		echo("</td>");




		echo("<td>");
		echo("<a href='#'>
			<div class='iconTabela'><img class='imgverMais' src='../Imagens/none.png'></div></a>");
		
		echo("<div class='iconTabela'>");
		echo("<a href='#' name='editar' value='' id='editar' onclick='editarfunc(".$reg["codFuncionario"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
		echo(" ");
		
		echo("<a href='#' name='button' value='' id='button' onclick='excluirfunc(".$reg["codFuncionario"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

		echo("<a href='../Reports/reportsFuncionario.php?key_rpt_func=especific&id_func={$reg['codFuncionario']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>");
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
if(empty($_GET['pageFunc'])){} else { $pagina = $_GET['pageFunc'];}
if(isset($pagina)){ $pagina = $_GET['pageFunc'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
	echo "<li>"; 
	echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageFunc=$voltar')"."><</a>";
	echo "</li>";
}else{}

                      // $pg =  $_POST["pageFunc"];
while ($i  <= $calculo) {
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
		echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$i')".">$i</a>";
		$i++;
		if($i > 10){
			echo "<li>"; 
			echo "<a>...</a>";
			echo "</li>"; 

			if(@$pagina > 11){
				echo "<li>"; 
				echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$valorAtual')".">$valorAtual </a>";
				echo "</li>"; 
			}else{
				echo "<li>"; 
				echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=11')".">11</a>";
				echo "</li>"; 
			}
			if (@$pagina <  ($calculo +5)) {
				echo "<li>"; 
				echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$seguir')".">></a>";
				echo "</li>"; 
			}
			break;
		}    
	}
	echo("</ul>");
                //Paginação 
	?>


</li>
</div>
