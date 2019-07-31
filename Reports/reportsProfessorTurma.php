<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ProfessorTurmaCRUD.php");

	// Instancia a classe ControllerPeriodo
$controller = new ProfessorTurmaCRUD();

// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['key_rpt_profturma'])) 
{
	if ($_GET['key_rpt_profturma'] == 'all') 
	{
		$mpdf = new mPDF(); 

			// Recebe o retorno do método relatorioGeralPeriodo
		$lista = $controller->relatorioGeralProfessorTurma();

		 // Total de registros
		$total_registros = $lista->count();

		$html = "﻿
		<div class='logo'>
		<img src='../Imagens/curumim_logo.png'>
		</div>
		<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>";

		foreach ($lista as $obj) {

			if($page_yes){
				$data = date('d/m/Y');
				$html .= "<div class='dadosEmissao'>
				<p>Data:".$data."</p>
				</div>
				<div class='traco'></div>
				<h1>Relatório Geral - Professores por turma Cadastrados</h1>
				<table class='tabelaResp'>
				<thead>
				<tr>
				<th>Nome da turma</th>
				<th>Nome do professor</th>
				<th>Data de Cadastro</th>
				</tr>
				</thead>
				<tbody>";
			}

			if($linha_atual <=  $total_registros) {

				$page_yes = false;
				$html .= "<tr>
				<td>{$obj->getNometurma()}</td>
				<td>{$obj->getNomeprofessor()}</td>
				<td>{$obj->getDatacadastro()}</td>
				</tr>";             
				$linha_atual++;	
			}


			if($linha_atual == $linhas_por_pagina || $linha_atual  >= $total_registros){

				$page_yes = true;

				$pagina_atual++;

				$mpdf->AddPage();

				$html .= "</tbody>
				</table>";

				$html .= "<div class='traco'></div>";

				$html .= "<div class='dadosCadastros'><p>Número de Registros por página: {$linhas_por_pagina} | Total de registros: {$total_registros}</p></div> 
				<br>";

				$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';

				$mpdf->SetFooter($rodape);	
				$mpdf->SetDisplayMode('fullpage');

				$mpdf->allow_charset_conversion = true;

				$mpdf->charset_in = 'UTF-8';

                 //Adicionando Css nos relatórios
				$css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
				
				$mpdf->WriteHTML($css,1);

				$mpdf->SetTitle("relatorio-geral-profturma-cadastrados");

				$mpdf->WriteHTML($html);

				$mpdf->Output("relatorio-geral-profturma.pdf", "I");

				exit();	
			}
		}
	}
	else if ($_GET['key_rpt_profturma'] == 'especific') 
	{
		if(isset($_GET['id_profturma']))
		{
			$pagina_atual = 1;

			$total_registros = 1;
			
			$id_profturma = intval($_GET['id_profturma']);
				// Recebe o retorno do método relatorioEspecificoPeriodo
			$profturma = $controller->relatorioEspecificoProfessorTurma($id_profturma);

			$html = "
			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
			<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data: 14/05/2018</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório Específico - Professor por turma Cadastrado</h1>
			<table class='tabelaResp'>
			<thead>
			<tr>
			<th>Nome da turma</th>
			<th>Nome do professor</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$profturma->getNometurma()}</td>
			<td>{$profturma->getNomeprofessor()}</td>
			<td>{$profturma->getDataCadastro()}</td>
			</tr>              
			</tbody>	
			</table>";

			$mpdf = new mPDF(); 

			$html .= "<div class='traco'></div>";

			$html .= "<div class='dadosCadastros'><p>Número de Registros por página: {$linhas_por_pagina} | Total de registros: {$total_registros}</p></div> 
			<br>";

			$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';

			$mpdf->SetFooter($rodape);	

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->allow_charset_conversion = true;

			$mpdf->charset_in = 'UTF-8';
                            //Adicionando Css nos relatórios
			$css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");

			$mpdf->WriteHTML($css,1);

			$mpdf->SetTitle("relatorio-especifico-profturma-cadastrado");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-profturma.pdf", "I");

			exit();
		}

	}
}

