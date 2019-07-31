<?php
include_once("config.php");
###########################################
# Funções para controle de includes
###########################################

function verificarArquivo($pasta, $arquivo, $flag, $p_barra){
	$diretorio = "";
	$include = "";

	## VERIFICA OS PARÂMETROS/MONTA O ARQUIVO ## 	
	// Está dentro de uma pasta - Necessita sair da pasta 
	if($flag == true and $p_barra == true)
	{
		$diretorio = "../{$pasta}/{$arquivo}";
	}
	// Está na mesma pasta mãe -- Não necessita sair da pasta
	else if($flag == true and $p_barra == false)
	{	
		$diretorio = "./{$pasta}/{$arquivo}";
			
	}else{
		$diretorio = "{$arquivo}";
	}
	
	## VERIFICA O ARQUIVO/PERMITE A INCLUSÃO ##
	if(file_exists($diretorio))
	{
		$include = "include_once('{$diretorio}');";
	}
	
	return $include;
}
/*
	$arqConexao = "Conexao.php";
	$arqModelTipoUsuario = "..\Model\TipoUsuario.php";

	$resp1 = file_exists($arqConexao);
	$resp2 = file_exists($arqModelTipoUsuario);

	if($resp1): 
		include_once("Conexao.php");
		echo $resp1;
	else:
		include_once("DAO\Conexao.php");
		var_dump($resp1);
	endif; 

	if($resp2): 
		include_once("..\Model\TipoUsuario.php");
		echo $resp2;
	else:
		include_once("Model\TipoUsuario.php");
		var_dump($resp2);
	endif;
*/
?>