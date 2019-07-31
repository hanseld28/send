<?php 

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerComunicado.php");
include_once("../Controller/ProfessorTurmaCRUD.php");

if(!isset($_SESSION))
{
	session_start();
}

$id_usuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;
  	//$nome_usuario = (isset($_SESSION['nomeUsuario'])) ? $_SESSION['nomeUsuario'] : null ;

$codTurma = (isset($_POST['codigoturma'])) ? intval($_POST['codigoturma']) : null ;

$controllerProfessor = new ProfessorTurmaCRUD();
$nomeTurma = $controllerProfessor->consultarNomeTurma($codTurma);  

$controllerComunicado = new ControllerComunicado();

$resultadoConsulta = $controllerComunicado->visualizarComunicadosRecentes($id_usuario, $nomeTurma, 10);

$listaComunicadosRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta;

// Data atual do Servidor Host
date_default_timezone_set("America/Araguaina");
$data_atual = date("Y-m-d");

?>



<style type="text/css">
#datepicker_de::-webkit-inner-spin-button {
	-webkit-appearance: none;
	display: none;
}
#datepicker_ate::-webkit-inner-spin-button {
	-webkit-appearance: none;
	display: none;
}

</style>

<div class="caixaTabelaRecentesOsComunicados">

	<div class="caixaTabelaRecentesComunicadosDeterminadaTurma" id="conteudoPageComunicado">
	
	<div class="linhaLabelRe">
        <label class="lblTodosR">Comunicados Recentes</label>
    </div>

	<?php
		if(!is_null($listaComunicadosRecentes))
		{
			echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
				echo("<thead>");
					echo("<tr>"); 
						echo("<td class='tituloComunicado2' id='tituloCdTurma'>N°</td>");
						echo("<td class='tituloComunicado2' id='tituloCdTurma'>Descrição</td>");
						echo("<td class='tituloComunicado2' id='tituloCdTurma'>Data</td>");
						echo("<td class='tituloComunicado2' id='tituloCdTurma'>Hora</td>");
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

			echo("</table>");
		}
		else
		{
			echo("<label class='lblnaoEncontrado'>Não foi encontrado nenhum comunicado enviado...</label>");
		}		
	?>

	</div>
</div>


<script type="text/javascript">
	
	function filtrarTodosComunicadosEnviados(codTurma){
		
		$.ajax({
			asyn: false,
			url: "viewVisualizarComunicadosRecentes.php",
			dataType: "html",
			type: "POST",
			data: { 
				codigoturma: codTurma
			},
			success: function(data)
			{
				$('#localComunicados').html(data);
			}
		});
		
	}	

	function filtrarTurmaProfessorIntervaloData(filtro, codigoturma) 
	{
		$.ajax({
			asyn: false,
			url: "viewFiltrarComunicadosEnviados.php",
			dataType: "html",
			type: "POST",
			data: 
			{
				data_de: $("#datepicker_de").val(), 
				data_ate: $("#datepicker_ate").val(),
				filtro_data: filtro.name,
				codTurma: codigoturma
			},
			success: function(data)
			{
				$('#conteudoTurmaProfessor').html(data);
			}
		});

		//alert("De: " + data_de + " Até: " + data_ate);
		
	}

	function verComunicadosRecentesPorLimite(codigoturma)
	{
		var ver_qtd;

		$("#selectVerRegistros option").each(function() {

			if($(this).prop("selected"))
			{
				ver_qtd = $(this).val();
			}

		});

		//alert(ver_qtd);

		$.ajax({
			asyn: false,
			url: "viewFiltrarComunicadosEnviados.php",
			dataType: "html",
			type: "POST",
			data: 
			{
				verQtdRegistros: ver_qtd, 
				codTurma: codigoturma
			},
			success: function(data)
			{
				$('#conteudoPageComunicado').html(data);
			}
		});

	}

</script>

