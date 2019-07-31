<?php 
	include_once("verificaUsuarioLogado.php");
	include_once("../Controller/ControllerComunicado.php");
	include_once("../Controller/ProfessorTurmaCRUD.php");	

	if (!isset($_SESSION))
	{
		session_start();
	}

	//$turma_professor = (isset($_POST['idTurmaProfessor'])) ? intval($_POST['idTurmaProfessor']) : null ;

	$filtro_data = (isset($_POST['filtro_data'])) ? $_POST['filtro_data'] : null ;
	$ordenar_por = (isset($_POST['ordenarPor'])) ? intval($_POST['ordenarPor']) : null ;

	$limite = (isset($_POST['verQtdRegistros'])) ? intval($_POST['verQtdRegistros']) : null ;

	$id_usuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;

	$codTurma = (isset($_POST['codTurma'])) ? intval($_POST['codTurma']) : null ;

	$controllerProfessor = new ProfessorTurmaCRUD();
	$nomeTurma = $controllerProfessor->consultarNomeTurma($codTurma);  

	$controllerComunicado = new ControllerComunicado();
	
	if(!is_null($limite) || !is_null($filtro_data) || !is_null($ordenar_por))
	{

		if ($filtro_data == "intervalo_data")
	    {

	    	$data_de = (isset($_POST['data_de'])) ? $_POST['data_de'] : null ;
	    	$data_ate = (isset($_POST['data_ate'])) ? $_POST['data_ate'] : null ;

	    	if(!is_null($data_de) && !is_null($data_ate))
	    	{
	    		$resultadoConsulta = $controllerComunicado->visualizarComunicadosEnviadosIntervaloData($id_usuario, $data_de, $data_ate, $nomeTurma);

				$listaComunicadosEnviadosIntervaloData = (!$resultadoConsulta) ? null : $resultadoConsulta;

				if (is_null($listaComunicadosEnviadosIntervaloData)) 
				{

					echo("<label class='lblnaoEncontrado'>Não foi encontrado nenhum comunicado enviado...</label>");	
					
			    }
			    else
			    {
			    	echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
					echo("<thead>");
                      echo("<tr>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>N°</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Descrição</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Data</td>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>Hora</td>");
    	               echo("</tr>");
                  	echo("</thead>");

			    	$i = 1;
					foreach ($listaComunicadosEnviadosIntervaloData as $key => $comunicadoEnviado) 
					{
						$dataCompleta = explode(" ", $comunicadoEnviado->getDataCadastro());
						$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
						$horario = $dataCompleta[1];

						echo("<tr class='linhaComunicado'>");

							echo("<td class='linhaComuT'>");

			                	echo("{$i}");

			                echo("</td>");

			                echo("<td class='linhaComuT'>");

			                $breve_descricao = substr($comunicadoEnviado->getDescricao(), 0, 15);
							$assunto = substr($comunicadoEnviado->getAssunto(), 0, 25); 

							echo("<b>{$assunto}</b> - {$breve_descricao}");

			                echo("</td>");

			                echo("<td class='linhaComuT'>");

			                	echo("{$data}");

			                echo("</td>");

			                echo("<td class='linhaComuT'>");

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
	    	$resultadoConsulta = $controllerComunicado->visualizarTodosComunicadosEnviados($id_usuario, $nomeTurma);

			$listaComunicadosEnviadasMaisRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta;

			if (is_null($listaComunicadosEnviadasMaisRecentes)) 
			{

				echo("<label class='lblnaoEncontrado'>Não foi encontrado nenhum comunicado enviado...</label>");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
					echo("<thead>");
                      echo("<tr>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>N°</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Descrição</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Data</td>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>Hora</td>");
    	               echo("</tr>");
                  	echo("</thead>");
		    	
		    	$i = 1;
				foreach ($listaComunicadosEnviadasMaisRecentes as $key => $comunicadoEnviado) 
				{
					$dataCompleta = explode(" ", $comunicadoEnviado->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr class='linhaComunicado'>");

						echo("<td class='linhaComuT'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                $breve_descricao = substr($comunicadoEnviado->getDescricao(), 0, 15);
						$assunto = substr($comunicadoEnviado->getAssunto(), 0, 25); 

						echo("<b>{$assunto}</b> - {$breve_descricao}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                	echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                	echo("{$horario}");

		                echo("</td>");
		        
		            echo("</tr>");

		            $i++;
		        }

		        	echo("</tbody>");
		        echo("</table>");
		    }

	    }
	    else if ($ordenar_por == 1) // Mais antigo
	    {
	    	$resultadoConsulta = $controllerComunicado->visualizarComunicadosMaisAntigos($id_usuario, $nomeTurma);

			$listaComunicadosMaisAntigos = (!$resultadoConsulta) ? null : $resultadoConsulta;

			if (is_null($listaComunicadosMaisAntigos)) 
			{

				echo("<label class='lblnaoEncontrado'>Não foi encontrado nenhum comunicado enviado...</label>");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
					echo("<thead>");
                      echo("<tr>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>N°</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Descrição</td>");
            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Data</td>");
                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>Hora</td>");
    	               echo("</tr>");
                  	echo("</thead>");
		    	
		    	$i = 1;
				foreach ($listaComunicadosMaisAntigos as $key => $comunicadoEnviado) 
				{
					$dataCompleta = explode(" ", $comunicadoEnviado->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr class='linhaComunicado'>");

						echo("<td class='linhaComuT'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                $breve_descricao = substr($comunicadoEnviado->getDescricao(), 0, 15);
						$assunto = substr($comunicadoEnviado->getAssunto(), 0, 25); 

						echo("<b>{$assunto}</b> - {$breve_descricao}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                	echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                	echo("{$horario}");

		                echo("</td>");
		        
		            echo("</tr>");

		            $i++;
		        }

		        	echo("</tbody>");
		        echo("</table>");
		    }

	    }
	    else if ($limite > 0)
	    {
	    	$resultadoConsulta = $controllerComunicado->visualizarComunicadosRecentes($id_usuario, $nomeTurma, $limite);

			$listaComunicadosRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta;

			if (is_null($listaComunicadosRecentes)) 
			{

				echo("<label class='lblnaoEncontrado'>Não foi encontrado nenhum comunicado enviado...</label>");	
				
		    }
		    else
		    {
		    	echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
						echo("<thead>");
	                      echo("<tr>");
	                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>N°</td>");
	            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Descrição</td>");
	            		     echo("<td class='tituloComunicado1' id='tituloCdTurma'>Data</td>");
	                         echo("<td class='tituloComunicado1' id='tituloCdTurma'>Hora</td>");
	    	               echo("</tr>");
	                  	echo("</thead>");
			    	
		    	$i = 1;
				foreach ($listaComunicadosRecentes as $key => $comunicadoEnviado) 
				{
					$dataCompleta = explode(" ", $comunicadoEnviado->getDataCadastro());
					$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
					$horario = $dataCompleta[1];

					echo("<tr class='linhaComunicado'>");

						echo("<td class='linhaComuT'>");

		                	echo("{$i}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                $breve_descricao = substr($comunicadoEnviado->getDescricao(), 0, 25);
		                	echo("{$breve_descricao}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

		                	echo("{$data}");

		                echo("</td>");

		                echo("<td class='linhaComuT'>");

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
