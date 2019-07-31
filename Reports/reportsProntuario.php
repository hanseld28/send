<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ControllerProntuario.php");

	// Instancia a classe ControllerPeriodo



	// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['id_pront'])){

	if ($_GET['key_rpt_pront'] == 'especific'){
			$mpdf = new mPDF(); 

			$data = date('d/m/Y');
			
			$pagina_atual = 1;

			$total_registros = 1;

			$id_pront = intval($_GET['id_pront']);
			// Recebe o retorno do método relatorioEspecificoPeriodo

			$controller = new ControllerProntuario();

			$pront = $controller->relatorioEspecificoProntuario($id_pront);

			$html = "
			<div class='logo'>
			<img src='../Imagens/curumim_logo.png'>
			</div>
			<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

			<div class='dadosEmissao'>
			<p>Data:".$data."</p>
			</div>
			<div class='traco'></div>
			<h1>Relatório - Prontuário aluno</h1>
			<table>
			<thead>
			<tr>
			<th>Nome</th>
			<th>Tipo Sanguíneo</th>
			<th>Deficiência</th>
			<th>Problema Saúde</th>
			<th>Doença Contagiosa</th>
			<th>Tratamento Cirurgico</th>
			<th>Alergia</th>
			<th>Medicação</th>
			<th>Data de Cadastro</th>
			</tr>
			</thead>

			<tbody>
			<tr>
			<td>{$pront->aluno->getNome()}</td>
			<td>{$pront->getTiposanguineo()}</td>
			<td>{$pront->getDeficiencia()}</td>
			<td>{$pront->getProblemasaude()}</td>
			<td>{$pront->getDoencacontagiosa()}</td>
			<td>{$pront->getTratamentocirurgico()}</td>
			<td>{$pront->getAlergia()}</td>
			<td>{$pront->getMedicacao()}</td>
			<td>{$pront->getDatacadastro()}</td>
			</tr>             
			</tbody>	
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

			$mpdf->SetTitle("relatorio-especifico-aluno-cadastrado");

			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-prontuario.pdf", "I");

			exit();
		}
}



?>