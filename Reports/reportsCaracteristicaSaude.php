<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ControllerCaracteristicaSaude.php");

	// Instancia a classe ControllerPeriodo
$controller = new ControllerCaracteristicaSaude();

$mpdf = new mPDF(); 

if (isset($_GET['key_rpt_caracteristica'])) 
{
	if ($_GET['key_rpt_caracteristica'] == 'all') 
	{
			// Recebe o retorno do método relatorioGeralPeriodo
		$lista = $controller->relatorioGeralCaracteristicaSaude();

		$html = "﻿
		<div class='logo'>
		<img src='../Imagens/curumim_logo.png'>
		</div>
		<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

		<div class='dadosEmissao'>
		<p>Data: 14/05/2018</p>
		</div>
		<div class='traco'></div>
		<h1>Relatório Geral - Características de saúde Cadastradas</h1>
		<table class='tabelaPequena'>
		<thead>
		<tr>
		<th>Descrição</th>
		<th>Data de Cadastro</th>
		</tr>
		</thead>";

		foreach ($lista as $obj) {

			$html .= "<tbody>
			<tr>
			<td>{$obj->getDescricao()}</td>
			<td>{$obj->getDatacadastro()}</td>
			</tr>              
			</tbody>";	
			
		}

		$html .= "</table>";

		$html .= "<div class='traco'></div>";

		$html .= "<div class='dadosCadastros'><p>Número de Registros por página: {$qtd_registros_page} | Total de registros: {$total_registros}</p></div> 
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

		$mpdf->SetTitle("relatorio-geral-caracteristica-cadastrados");

		$mpdf->WriteHTML($html);

		$mpdf->Output("relatorio-geral-caracteristica.pdf", "I");

		exit();	
	}
	else if ($_GET['key_rpt_caracteristica'] == 'especific') 
	{
		if(isset($_GET['id_caracteristica']))
		{
			$id_caracteristica = intval($_GET['id_caracteristica']);
				// Recebe o retorno do método relatorioEspecificoPeriodo
			$cara = $controller->relatorioEspecificoCaracteristicaSaude($id_caracteristica);

			$html = "
			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
		    <h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data: 14/05/2018</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório Específico - Características de saúde Cadastrado</h1>
			<table class='tabelaPequena'>
			<thead>
			<tr>
			<th>Descrição</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$cara->getDescricao()}</td>
			<td>{$cara->getDataCadastro()}</td>
			</tr>              
			</tbody>	
			</table>";

			$mpdf = new mPDF(); 

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->allow_charset_conversion = true;

			$mpdf->charset_in = 'UTF-8';

                    //Adicionando Css nos relatórios
			$css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
			$mpdf->WriteHTML($css,1);

            //FIM Adicionando Css nos relatórios

			$mpdf->SetTitle("relatorio-especifico-caracteristica-cadastrado");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-caracteristica.pdf", "I");

			exit();
		}

	}
}

