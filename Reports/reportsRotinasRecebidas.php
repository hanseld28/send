<?php 
	include_once("../Controller/ControllerRotina.php");
	include_once("../Controller/ControllerUsuario.php");
	include_once("../Controller/AlunoCRUD.php");
	include_once("../MPDF/mpdf.php");
    include_once("../View/funcoesUtilitarias.php");

	$codAgenda = (isset($_GET['id_agenda'])) ? intval($_GET['id_agenda']) : null ;
    $codRotina = (isset($_GET['id_rotina'])) ? intval($_GET['id_rotina']) : null ;

    date_default_timezone_set('America/Sao_Paulo');

	$mpdf = new mPDF(); 
	// Recebe o retorno do método relatorioGeralPeriodo


    // Data atual do Servidor Host
    $data_atual = date("Y-m-d");

    // Instancia a classe ControllerRotina
    $controllerRotina = new ControllerRotina();

    $controllerUsuario = new ControllerUsuario();

    $controllerAluno = new AlunoCRUD();

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
					    <p>Data: {$data_atual}</p>
					</div>
		            <div class='traco'></div>
		            <h1>Relatório Geral - Rotinas Recebida</h1>
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

			    $dataCompleta = explode(" ", $rotina->getDataCadastro());
				$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
				$horarioEnvio = str_replace(":", "h", date('H:i', strtotime($rotina->getHorarioEnvio())))."min";

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
            
			$html .= "<div class='dadosCadastros'><p>Número de Registros por página: 20 e total de cadastros: 100</p></div>";

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
		else if ($_GET['key_rpt_rotina'] == 'especifica') 
		{
		
			// Recebe o retorno do método relatorioGeralRotina
		    $rotina = $controllerRotina->relatorioRotinaEspecificaCrianca($codAgenda, $codRotina);

		    $aluno = $controllerUsuario->pesquisarAlunoAgenda($codAgenda);

		    $codAluno = $controllerAluno->AlunoAgendaPorCodigo($codAgenda);

		    $nomeAluno = $controllerAluno->pesqAlunoPorCodigo($codAluno);

		    $dataCompleta = explode(" ", $rotina->getDataCadastro());
			$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
			$horarioEnvio = str_replace(":", "h", date('H:i', strtotime($rotina->getHorarioEnvio())))."min";

			$ocorr = "";

			$cards = "";

		    if($rotina->ocorrencias->count() == 0)
            {

                $ocorr .= "Não houve ocorrências...";             
            }
            else
            {
                $i = 0;
                foreach ($rotina->ocorrencias as $ocorrencia) 
                {
                    $i++;
                    $ocorr .= "<h6>{$i}. {$ocorrencia->getDescricao()}</h6>";
                }
            }

            $i = 0;
            foreach ($rotina->cards as $card) 
            {
            	$i++;
                $cards .= "<h6>{$i}. {$card->getDescricao()}: {$card->alternativa->getDescricao()}</h6>";
            }

		    $html = "<div class='logo'>
					<img src='../Imagens/curumim_logo.png'>
					</div>
					<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>

					<div class='dadosEmissao'>
					    <p>Data: {$data_atual}</p>
					</div>
		            <div class='traco'></div>
		            <h1>Relatório Específico - Rotina Recebida</h1>
				    <h5>Criança: {$nomeAluno}</h5>
				    <h5>Turma: {$rotina->turma->getDescricao()}</h5>
				    <h5>Ocorrências:</h5>
				    {$ocorr}
				    <h6>Rotinas: </h6>
				    {$cards}
				    <h6>Enviada por: {$rotina->professor->getNome()}</h6>
				    <h6>Horário de envio: {$horarioEnvio}</h6>
				    <h6>Data de Cadastro: {$data}</h6>";
				              
            
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
			
			//echo($html);
		}
			
	}



?>