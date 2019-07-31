<?php 	
	include_once("../MPDF/mpdf.php");
	include_once("../Controller/ControllerRotina.php");
	include_once("../Controller/AlunoCRUD.php");

	
	$codUsuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null ;
	$nomeTurma = (isset($_GET['nome_turma'])) ? $_GET['nome_turma'] : null ;

	date_default_timezone_set('America/Sao_Paulo');

	$mpdf = new mPDF(); 
	// Recebe o retorno do método relatorioGeralPeriodo


	// Instancia a classe ControllerRotina
    $controllerRotina = new ControllerRotina();

	if (isset($_GET['key_rpt_rotina'])) 
	{
		if ($_GET['key_rpt_rotina'] == 'all') 
		{
			// Recebe o retorno do método relatorioGeralRotina
		    $listaRotinas = $controllerRotina->relatorioGeralTodasRotinasEnviadas($codUsuario, $nomeTurma);

		    $controllerAluno = new AlunoCRUD();

		    $html = "<div class='logo'>
					<img src='../Imagens/curumim_logo.png'>
					</div>
					<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

					<div class='dadosEmissao'>
					    <p>Data: 14/05/2018</p>
					</div>
		            <div class='traco'></div>
		            <h1>Relatório Geral - Rotinas Enviadas</h1>
							<table class='tabelaPequena'>
							
				                <thead>
				                    <tr>
				                        <th>Aluno</th>
				                        <th>Turma</th>
				                        <th>Total de Ocorrências</th>
				                        <th>Total de Rotinas[Boas]</th>
				                        <th>Total de Rotinas[Regulares]</th>
				                        <th>Total de Rotinas[Ruins]</th>
				                        <th>Enviada por</th>
				                        <th>Horário de envio</th>
				                        <th>Data de Cadastro</th>
				                    </tr>
				                </thead>";
				                
		    foreach ($listaRotinas as $obj) {

			    $codAluno = $controllerAluno->AlunoAgendaPorCodigo($obj->agendas[0]->getId());

			    $nomeAluno = $controllerAluno->pesqAlunoPorCodigo($codAluno);

			    $dataCompleta = explode(" ", $obj->getDataCadastro());
				$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
				//$horario = $dataCompleta[1];

				$ocorrencia = ($obj->qtdOcorrencias > 0) ? $obj->qtdOcorrencias : "Nenhuma" ;
							
		        $html .= "<tbody>
							<tr>
								<td>{$nomeAluno}</td>
								<td>{$obj->turma->getDescricao()}</td>
								<td>{$ocorrencia}</td>
								<td>{$obj->qtdAlternativas['Bom']}</td>
								<td>{$obj->qtdAlternativas['Regular']}</td>
								<td>{$obj->qtdAlternativas['Ruim']}</td>
								<td>{$obj->professor->getNome()}</td>
								<td>{$obj->getHorarioEnvio()}</td>
								<td>{$data}</td>
							</tr>              
						  </tbody>";	
		
			}

            $html .= "</table>";
            
            $html .= "<div class='traco'></div>";
            
			
			$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';
			$mpdf->setFooter($rodape);
			$mpdf->SetDisplayMode('fullpage');
			
			$mpdf->allow_charset_conversion = true;

			$mpdf->charset_in = 'UTF-8';
            
            //Adicionando Css nos relatórios
            $css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
            $mpdf->WriteHTML($css,1);

			$mpdf->SetTitle("relatorio-geral-rotinas-enviadas");
			
			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-geral-rotinas-enviadas.pdf", "I");

			exit();	

		}
		else if ($_GET['key_rpt_rotina'] == 'recentes') 
		{
		
			// Recebe o retorno do método relatorioGeralRotina
		    $listaRotinas = $controllerRotina->relatorioGeralRotinasRecentes($codUsuario, $nomeTurma);

		    $controllerAluno = new AlunoCRUD();

		    $html = "<div class='logo'>
					<img src='../Imagens/curumim_logo.png'>
					</div>
					<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

					<div class='dadosEmissao'>
					    <p>Data: 14/05/2018</p>
					</div>
		            <div class='traco'></div>
		            <h1>Relatório Geral - Rotinas Recentes</h1>
							<table class='tabelaPequena'>
							
				                <thead>
				                    <tr>
				                        <th>Aluno</th>
				                        <th>Turma</th>
				                        <th>Total de Ocorrências</th>
				                        <th>Total de Rotinas[Boas]</th>
				                        <th>Total de Rotinas[Regulares]</th>
				                        <th>Total de Rotinas[Ruins]</th>
				                        <th>Enviada por</th>
				                        <th>Horário de envio</th>
				                        <th>Data de Cadastro</th>
				                    </tr>
				                </thead>";
				                
		    foreach ($listaRotinas as $obj) {

			    $codAluno = $controllerAluno->AlunoAgendaPorCodigo($obj->agendas[0]->getId());

			    $nomeAluno = $controllerAluno->pesqAlunoPorCodigo($codAluno);

			    $dataCompleta = explode(" ", $obj->getDataCadastro());
				$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
				//$horario = $dataCompleta[1];

				$ocorrencia = ($obj->qtdOcorrencias > 0) ? $obj->qtdOcorrencias : "Nenhuma" ;
							
		        $html .= "<tbody>
							<tr>
								<td>{$nomeAluno}</td>
								<td>{$obj->turma->getDescricao()}</td>
								<td>{$ocorrencia}</td>
								<td>{$obj->qtdAlternativas['Bom']}</td>
								<td>{$obj->qtdAlternativas['Regular']}</td>
								<td>{$obj->qtdAlternativas['Ruim']}</td>
								<td>{$obj->professor->getNome()}</td>
								<td>{$obj->getHorarioEnvio()}</td>
								<td>{$data}</td>
							</tr>              
						  </tbody>";	
		
			}

            $html .= "</table>";
            
            $html .= "<div class='traco'></div>";
            
			
			$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';
			$mpdf->setFooter($rodape);
			$mpdf->SetDisplayMode('fullpage');
			
			$mpdf->allow_charset_conversion = true;

			$mpdf->charset_in = 'UTF-8';
            
            //Adicionando Css nos relatórios
            $css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
            $mpdf->WriteHTML($css,1);

			$mpdf->SetTitle("relatorio-geral-rotinas-recentes");
			
			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-geral-rotinas-recentes.pdf", "I");

			exit();	
		}
		else if ($_GET['key_rpt_rotina'] == 'especifico') 
		{
			$codRotina = (isset($_GET['id_rotina'])) ? $_GET['id_rotina'] : null ;

			// Recebe o retorno do método relatorioGeralRotina
		    $rotina = $controllerRotina->relatorioEspecificoRotina($codUsuario, $nomeTurma, $codRotina);

		    $controllerAluno = new AlunoCRUD();

		    $html = "<div class='logo'>
					<img src='../Imagens/curumim_logo.png'>
					</div>
					<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

					<div class='dadosEmissao'>
					    <p>Data: 14/05/2018</p>
					</div>
		            <div class='traco'></div>
		            <h1>Relatório Específico - Rotina Enviada</h1>
							<table class='tabelaPequena'>
							
				                <thead>
				                    <tr>
				                        <th>Aluno</th>
				                        <th>Turma</th>
				                        <th>Total de Ocorrências</th>
				                        <th>Total de Rotinas[Boas]</th>
				                        <th>Total de Rotinas[Regulares]</th>
				                        <th>Total de Rotinas[Ruins]</th>
				                        <th>Enviada por</th>
				                        <th>Horário de envio</th>
				                        <th>Data de Cadastro</th>
				                    </tr>
				                </thead>";
			
		    $codAluno = $controllerAluno->AlunoAgendaPorCodigo($rotina->agendas[0]->getId());

		    $nomeAluno = $controllerAluno->pesqAlunoPorCodigo($codAluno);

		    $dataCompleta = explode(" ", $rotina->getDataCadastro());
			$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
			//$horario = $dataCompleta[1];

			$ocorrencia = ($rotina->qtdOcorrencias > 0) ? $rotina->qtdOcorrencias : "Nenhuma" ;
						
	        $html .= "<tbody>
						<tr>
							<td>{$nomeAluno}</td>
							<td>{$rotina->turma->getDescricao()}</td>
							<td>{$ocorrencia}</td>
							<td>{$rotina->qtdAlternativas['Bom']}</td>
							<td>{$rotina->qtdAlternativas['Regular']}</td>
							<td>{$rotina->qtdAlternativas['Ruim']}</td>
							<td>{$rotina->professor->getNome()}</td>
							<td>{$rotina->getHorarioEnvio()}</td>
							<td>{$data}</td>
						</tr>              
					  </tbody>";	
	

            $html .= "</table>";
            
            $html .= "<div class='traco'></div>";
            
			
			$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';
			$mpdf->setFooter($rodape);
			$mpdf->SetDisplayMode('fullpage');
			
			$mpdf->allow_charset_conversion = true;

			$mpdf->charset_in = 'UTF-8';
            
            //Adicionando Css nos relatórios
            $css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
            $mpdf->WriteHTML($css,1);

			$mpdf->SetTitle("relatorio-especifico-rotina-enviada");
			
			$mpdf->WriteHTML($html);

			$mpdf->Output("relatorio-especifico-rotina-enviada.pdf", "I");

			exit();
		}
			
	}
	

	

?>