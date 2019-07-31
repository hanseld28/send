<?php

$nomeTipo = "%".$_POST['txTipo']."%";

include_once("../DAO/Conexao.php");

?>

<div class="div-result">

	<?php 
	
	    // Abre a conexão com o banco de dados
	$pdo = Conexao::conexao();
		// Prepara a consulta de pesquisa 

	$cmd = $pdo->prepare("SELECT codTipoUsuario, descTipoUsuario FROM tbtipousuario where descTipoUsuario LIKE :nomeTipo");

		// Substitui os parâmetros/pseudônomes pelo valor da variável 
	$cmd->bindParam(":nomeTipo", $nomeTipo, PDO::PARAM_STR); 
	    // Executa a consulta
	$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
	Conexao::desconexao();



	echo("<table class='bordasimples' cellspacing='0'>");
	echo("<thead>");
	echo ("<tr>");
	echo ("<td class='tituloTabelaCadAux'>Tipo usuário</th>");
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
		echo($reg["descTipoUsuario"]);
		echo("</td>");

		echo("<td class='linhaTabelaCadAux'>");
		echo("</td>");
		echo("<td class='tdAcoes'>");
		echo("<div class='iconTabela'>");
		echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$reg["codTipoUsuario"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
		echo(" ");

		echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$reg["codTipoUsuario"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

		echo("<a href='../Reports/reportsTipoUsuario.php?key_rpt_type_user=especific&id_type_user={$reg['codTipoUsuario']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");

		echo("</td>");



		echo("</tr>");
	}
	echo("</tbody>");
	echo("</table>");
	?>
</div>	