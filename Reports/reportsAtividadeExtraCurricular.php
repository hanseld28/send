<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");

	// Instancia a classe ControllerPeriodo
$controller = new ControllerAtividadeExtraCurricular();
// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

$mpdf = new mPDF(); 

if (isset($_GET['key_rpt_atividade'])) 
{
	if ($_GET['key_rpt_atividade'] == 'all') 
	{
			// Recebe o retorno do método relatorioGeralPeriodo
		$lista = $controller->relatorioGeralAtividade();

		 // Total de registros
		$total_registros = $lista->count();

		$html = "﻿ <div class='logo'>
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
				<h1>Relatório Geral - Atividades Cadastradas</h1>
				<table class='tabelaResp'>
				<thead>
				<tr>
				<th>Descrição</th>
				<th>Data de Cadastro</th>
				</tr>
				</thead>";
			}

			if($linha_atual <=  $total_registros) {

				$page_yes = false;
				$html .= "<tr>
				<td>{$obj->getDescricao()}</td>
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

            //FIM Adicionando Css nos relatórios

				$mpdf->SetTitle("relatorio-geral-atividade-cadastrados");

				$mpdf->WriteHTML($html);

				$mpdf->Output("relatorio-geral-atividade.pdf", "I");

				exit();	
			}
		}
	}


	else if ($_GET['key_rpt_atividade'] == 'especific') 
	{
		if(isset($_GET['id_atividade']))
		{
			$pagina_atual = 1;

			$total_registros = 1;

			$id_atividade = intval($_GET['id_atividade']);
				// Recebe o retorno do método relatorioEspecificoPeriodo
			$atividade = $controller->relatorioEspecificoAtividade($id_atividade);

			$html = "
			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
			<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data: 14/05/2018</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório Específico - Atividade Cadastrada</h1>
			<table class='tabelaPequena'>
			<thead>
			<tr>
			<th>Descrição</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$atividade->getDescricao()}</td>
			<td>{$atividade->getDatacadastro()}</td>
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

            //FIM Adicionando Css nos relatórios

			$mpdf->SetTitle("relatorio-especifico-atividade-cadastrado");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-atividade.pdf", "I");

			exit();
		}

	}
}

