<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/FuncionarioCRUD.php");

// Instancia a classe ControllerPeriodo
$controller = new FuncionarioCRUD();

// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['key_rpt_func'])) 
{
	if ($_GET['key_rpt_func'] == 'all') 
	{

		$mpdf = new mPDF(); 

			// Recebe o retorno do método relatorioGeralPeriodo
		$lista = $controller->relatorioGeralFuncionario();

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
				<p>Data: 14/05/2018</p>
				</div>
				<div class='traco'></div>
				<h1>Relatório Geral - Funcionários Cadastrados</h1>
				<table>
				<thead>
				<tr>
				<th>Nome</th>
				<th>RG</th>
				<th>CPF</th>
				<th>Logradouro</th>
				<th>Complemento</th>
				<th>NºCasa</th>
				<th>CEP</th>
				<th>Cidade</th>
				<th>Data de Cadastro</th>
				</tr>
				</thead>
				<tbody>";
			}

			if($linha_atual <=  $total_registros) {
				
				$page_yes = false;
				$html .= "
				<tr>
				<td>{$obj->getNome()}</td>
				<td>{$obj->getRg()}</td>
				<td>{$obj->getCpf()}</td>
				<td>{$obj->getLogradouro()}</td>
				<td>{$obj->getComplemento()}</td>
				<td>{$obj->getNumcasa()}</td>
				<td>{$obj->getCep()}</td>
				<td>{$obj->getCidade()}</td>
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

				$mpdf->SetTitle("relatorio-geral-func-cadastrados");

				$mpdf->WriteHTML($html);

				$mpdf->Output("relatorio-geral-func.pdf", "I");

				exit();	
			}
		}
	}
	else if ($_GET['key_rpt_func'] == 'especific') 
	{
		if(isset($_GET['id_func']))
		{
			$pagina_atual = 1;

			$total_registros = 1;

			$id_func = intval($_GET['id_func']);
				// Recebe o retorno do método relatorioEspecificoPeriodo
			$func = $controller->relatorioEspecificoFuncionario($id_func);

			$html = "
			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
			<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data: 14/05/2018</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório Específico - Funcionário Cadastrado</h1>
			<table>
			<thead>
			<tr>
			<th>Nome</th>
			<th>RG</th>
			<th>CPF</th>
			<th>Logradouro</th>
			<th>Complemento</th>
			<th>NºCasa</th>
			<th>CEP</th>
			<th>Cidade</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$func->getNome()}</td>
			<td>{$func->getRg()}</td>
			<td>{$func->getCpf()}</td>
			<td>{$func->getLogradouro()}</td>
			<td>{$func->getComplemento()}</td>
			<td>{$func->getNumcasa()}</td>
			<td>{$func->getCep()}</td>
			<td>{$func->getCidade()}</td>
			<td>{$func->getDatacadastro()}</td>
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

			$mpdf->SetTitle("relatorio-especifico-func-cadastrado");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-func.pdf", "I");

			exit();
		}

	}
}

