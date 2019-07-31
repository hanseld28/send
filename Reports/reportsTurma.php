<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ControllerTurma.php");

	// Instancia a classe ControllerTurma
$controllerTurma = new ControllerTurma();

// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['key_rpt_turma'])) 
{
	if ($_GET['key_rpt_turma'] == 'all') 
	{
		$mpdf = new mPDF(); 

			// Recebe o retorno do método relatorioGeralTurma
		$listaTurmas = $controllerTurma->relatorioGeralTurma();

		 // Total de registros
		$total_registros = $listaTurmas->count();

		$html = "﻿
		<div class='logo'>
		<img src='../Imagens/curumim_logo.png'>
		</div>
		<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>";

		foreach ($listaTurmas as $obj) {

			if($page_yes){
				$data = date('d/m/Y');
				$html .= "<div class='dadosEmissao'>
				<p>Data:".$data." </p>
				</div>
				<div class='traco'></div>
				<h1>Relatório Geral - Turmas Cadastrados</h1>
				<table class='tabelaResp'>
				<thead>
				<tr>
				<th>Descrição</th>
				<th>Grau Escolar</th>
				<th>Data de Cadastro</th>
				</tr>
				</thead>
				<tbody>";
			}
			if($linha_atual <=  $total_registros) {

				$page_yes = false;
				$html .= "
				<tr>
				<td>{$obj->getDescricao()}</td>
				<td>{$obj->grauEscolar->getDescricao()}</td>
				<td>{$obj->getDataCadastro()}</td>
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

				$mpdf->SetTitle("relatorio-geral-turmas-cadastradas");

				$mpdf->WriteHTML($html);

				$mpdf->Output("relatorio-geral-turmas.pdf", "I");

				exit();	
			}
		}
	}
	
	else if ($_GET['key_rpt_turma'] == 'especific') 
	{
		if(isset($_GET['id_turma']))
		{
			$pagina_atual = 1;

			$total_registros = 1;

			$id_turma = intval($_GET['id_turma']);
				// Recebe o retorno do método relatorioEspecificoTurma
			$turma = $controllerTurma->relatorioEspecificoTurma($id_turma);

			$html = "

			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
			<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data: 14/05/2018</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório Específico - Turma Cadastrada</h1>
			<table class='tabelaResp'>
			<thead>
			<tr>
			<th>Descrição</th>
			<th>Grau Escolar</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$turma->getDescricao()}</td>
			<td>{$turma->grauEscolar->getDescricao()}</td>
			<td>{$turma->getDataCadastro()}</td>
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

			$mpdf->SetTitle("relatorio-especifico-turma-cadastrada");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-turma.pdf", "I");

			exit();
		}

	}
}

