<?php 
include_once("../MPDF/mpdf.php");
include_once("../Controller/ControllerUsuario.php");

	// Instancia a classe ControllerRelatorio
$controllerUsuario = new ControllerUsuario();

// Define o Numero Maximo de registros por pagina
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['key_rpt_user'])) 
{
	if ($_GET['key_rpt_user'] == 'all') 
	{
		$mpdf = new mPDF(); 

			// Recebe o retorno do método relatorioGeralUsuario
		$listaUsuarios = $controllerUsuario->relatorioGeralUsuario();

				 // Total de registros
		$total_registros = $listaUsuarios->count();

		$html = "﻿
		<div class='logo'>
		<img src='../Imagens/curumim_logo.png'>
		</div>
		<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>";

		foreach ($listaUsuarios as $obj) {

			if($page_yes){
				$data = date('d/m/Y');
				$html .="<div class='dadosEmissao'>
				<p>Data: 14/05/2018</p>
				</div>
				<div class='traco'></div>
				<h1>Relatório Geral - Usuários Cadastrados</h1>
				<table>
				<thead>
				<tr>
				<th>Nome</th>
				<th>Login</th>
				<th>Tipo de Usuário</th>
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
				<td>{$obj->getLogin()}</td>
				<td>{$obj->tipoUsuario->getDescricao()}</td>
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

            //FIM Adicionando Css nos relatórios

				$mpdf->SetTitle("Relatório Geral - Usuários Cadastrados");			

				$mpdf->WriteHTML($html);

				$mpdf->Output("relatorio-geral-usuarios-cadastrados.pdf", "I");

				exit();	
			}
		}
	}
			else if ($_GET['key_rpt_user'] == 'especific') 
			{
				if(isset($_GET['id_user']))
				{

					$pagina_atual = 1;

					$total_registros = 1;

					$id_user = intval($_GET['id_user']);
				// Recebe o retorno do método relatorioGeralUsuario
					$usuario = $controllerUsuario->relatorioEspecificoUsuario($id_user);

					$html = "
					<div class='logo'>
					<img src='../Imagens/curumim_logo.png'>
					</div>
					<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

					<div class='dadosEmissao'>
					<p>Data: 14/05/2018</p>
					</div>
					<div class='traco'></div>
					<h1>Relatório Específico - Usuário Cadastrado</h1>
					<table>
					<thead>
					<tr>
					<th>Nome</th>
					<th>Login</th>
					<th>Tipo de Usuário</th>
					<th>Data de Cadastro</th>
					</tr>
					</thead>

					<tbody>
					<tr>
					<td>{$usuario->getNome()}</td>
					<td>{$usuario->getLogin()}</td>
					<td>{$usuario->tipoUsuario->getDescricao()}</td>
					<td>{$usuario->getDataCadastro()}</td>
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

					$mpdf->SetTitle("Relatório Específico - Usuário cadastrado");

					$mpdf->WriteHTML($html);

					$mpdf->Output("relatorio-especifico-usuario.pdf", "I");

					exit();
				}

			}
		}

