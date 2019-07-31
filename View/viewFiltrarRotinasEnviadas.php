<?php
	include_once("verificaUsuarioLogado.php");
	include_once("../Controller/ControllerRotina.php");
	include_once("../Controller/ProfessorTurmaCRUD.php");	

	session_start();
	//$turma_professor = (isset($_POST['idTurmaProfessor'])) ? intval($_POST['idTurmaProfessor']) : null ;

	$filtro_data = (isset($_POST['filtro_data'])) ? $_POST['filtro_data'] : null ;
	$ordenar_por = (isset($_POST['ordenarPor'])) ? intval($_POST['ordenarPor']) : null ;

	$id_usuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;

	$codTurma = (isset($_POST['codTurma'])) ? intval($_POST['codTurma']) : null ;

	$controllerProfessor = new ProfessorTurmaCRUD();
	$nomeTurma = $controllerProfessor->consultarNomeTurma($codTurma);  

	$controllerRotina = new ControllerRotina();
	
	
	if(!is_null($filtro_data) || !is_null($ordenar_por))
	{
		if ($filtro_data == "hoje") 
		{
			$resultadoConsulta = $controllerRotina->visualizarRotinasEnviadasTodas($id_usuario, $nomeTurma);

			$listaRotinasEnviadasDataAtual = (!$resultadoConsulta) ? null : $resultadoConsulta ;

			if (is_null($listaRotinasEnviadasDataAtual)) 
			{

				echo("<div class='RotinaEnviadaNaoEncontrada'>Não foi encontrado nenhuma rotina enviada...</div>");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaRecentesRotinaDeterminadaTurma' cellspacing='0'>");
	    			echo("<thead>");
	        			echo("<tr>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Nº</td>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Aluno</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Turma</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Data</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Horário</td>");
	        				echo("</tr>");
	    			echo("</thead>");
	    			echo("<tbody>");	
		    	$i = 1;
				foreach ($listaRotinasEnviadasDataAtual as $key => $rotinaEnviada) 
				{
					$dataCompleta = explode(" ", $rotinaEnviada->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr>");

						echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaCdTRotinaTurma'>");

						echo("{$rotinaRecente->aluno->getNome()}");

						echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$rotinaEnviada->turma->getDescricao()}");

		                echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

	                		echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$horario}");

		                echo("</td>");
		        
		            echo("</tr>");

		            $i++;
		        }

		        	echo("</tbody>");
		        echo("</table>");
		    }    
	    }
	    else if ($filtro_data == "intervalo_data")
	    {
	    	$data_de = (isset($_POST['data_de'])) ? $_POST['data_de'] : null ;
	    	$data_ate = (isset($_POST['data_ate'])) ? $_POST['data_ate'] : null ;

	    	if(!is_null($data_de) && !is_null($data_ate))
	    	{
	    		$resultadoConsulta = $controllerRotina->visualizarRotinasEnviadasIntervaloData($id_usuario, $data_de, $data_ate, $nomeTurma);

				$listaRotinasEnviadasIntervaloData = (!$resultadoConsulta) ? null : $resultadoConsulta;

				if (is_null($listaRotinasEnviadasIntervaloData)) 
				{

					echo("Não foi encontrado nenhuma rotina enviada...");	
					
			    }
			    else
			    {
			    	echo("<table class='tabelaRecentesRotinaDeterminadaTurma' cellspacing='0'>");
		    			echo("<thead>");
		        			echo("<tr>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Nº</td>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Aluno</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Turma</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Data</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Horário</td>");
		        				echo("</tr>");
		    			echo("</thead>");
		    			echo("<tbody>");	
			    	$i = 1;
					foreach ($listaRotinasEnviadasIntervaloData as $key => $rotinaEnviada) 
					{
						$dataCompleta = explode(" ", $rotinaEnviada->getDataCadastro());
						$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
						$horario = $dataCompleta[1];

						echo("<tr>");

						   echo("<td class='linhaCdRecentesRotinaTurma'>");

			               echo("{$i}");

			               echo("</td>");

			               echo("<td class='linhaCdTRotinaTurma'>");

						   echo("{$rotinaEnviada->aluno->getNome()}");

						   echo("</td>");

			               echo("<td class='linhaCdRecentesRotinaTurma'>");

			                	echo("{$rotinaEnviada->turma->getDescricao()}");

			                echo("</td>");

			               echo("<td class='linhaCdRecentesRotinaTurma'>");

		                		echo("{$data}");

			                echo("</td>");

			                echo("<td class='linhaCdRecentesRotinaTurma'>");

			                	echo("{$horario}");

			                echo("</td>");
			        
			            echo("</tr>");

			            $i++;
			        }

			        	echo("</tbody>");
			        echo("</table>");
			    }    	
	    	}
	    }
	    else if ($ordenar_por == 0) // Mais recente
	    {
	    	$resultadoConsulta = $controllerRotina->visualizarTodasRotinasEnviadas($id_usuario, $nomeTurma);

			$listaRotinasEnviadasMaisRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta;

			if (is_null($listaRotinasEnviadasMaisRecentes)) 
			{

				echo("Não foi encontrado nenhuma rotina enviada...");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaRecentesRotinaDeterminadaTurma' cellspacing='0'>");
	    			echo("<thead>");
	        			echo("<tr>");
	        			echo("<td class='tituloCdRecentesRotinaTurma'>Nº</td>");
	 		       			echo("<td class='tituloCdRecentesRotinaTurma'>Aluno</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Turma</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Data</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Horário</td>");
	        				echo("</tr>");
	    			echo("</thead>");
	    			echo("<tbody>");	
		    	$i = 1;
				foreach ($listaRotinasEnviadasMaisRecentes as $key => $rotinaEnviada) 
				{
					$dataCompleta = explode(" ", $rotinaEnviada->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr>");

						echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaCdTRotinaTurma'>");

						echo("{$rotinaEnviada->aluno->getNome()}");

						echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$rotinaEnviada->turma->getDescricao()}");

		                echo("</td>");

		               	echo("<td class='linhaCdRecentesRotinaTurma'>");

	                		echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$horario}");

		                echo("</td>");
		        
		            echo("</tr>");

		            $i++;
		        }

		        	echo("</tbody>");
		        echo("</table>");
		    }
	    }
	    else if ($ordenar_por == 1) // Mais antiga
	    {
	    	$resultadoConsulta = $controllerRotina->visualizarTodasRotinasEnviadasMaisAntigas($id_usuario, $nomeTurma);

			$listaRotinasEnviadasMaisAntigas = (!$resultadoConsulta) ? null : $resultadoConsulta;

			if (is_null($listaRotinasEnviadasMaisAntigas)) 
			{

				echo("Não foi encontrado nenhuma rotina enviada...");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaRecentesRotinaDeterminadaTurma' cellspacing='0'>");
	    			echo("<thead>");
	        			echo("<tr>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Nº</td>");
	        				echo("<td class='tituloCdRecentesRotinaTurma'>Aluno</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Turma</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Data</td>");
	            			echo("<td class='tituloCdRecentesRotinaTurma'>Horário</td>");
	        				echo("</tr>");
	    			echo("</thead>");
	    			echo("<tbody>");	
		    	$i = 1;
				foreach ($listaRotinasEnviadasMaisAntigas as $key => $rotinaEnviada) 
				{
					$dataCompleta = explode(" ", $rotinaEnviada->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr>");

						echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaCdTRotinaTurma'>");

						echo("{$rotinaEnviada->aluno->getNome()}");

						echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$rotinaEnviada->turma->getDescricao()}");

		                echo("</td>");

		               	echo("<td class='linhaCdRecentesRotinaTurma'>");

	                		echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaCdRecentesRotinaTurma'>");

		                	echo("{$horario}");

		                echo("</td>");
		        
		            echo("</tr>");

		            $i++;
		        }

		        echo("</tbody>");
		        echo("</table>");
		    }
	    }
	}
?>


