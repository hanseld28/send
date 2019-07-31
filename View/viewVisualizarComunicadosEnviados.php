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

$resultadoConsulta = $controllerComunicado->visualizarTodosComunicadosEnviados($id_usuario, $nomeTurma);
$listaTodosComunicadosEnviados = (!$resultadoConsulta) ? null : $resultadoConsulta;


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
    
    <div class="caixaTabelaTodosOsComunicados">
    
    <div class="linhaLabelTodos">
        <label class="lblTodosT">Todos Comunicados</label>
        
<!--          <div class='iconeGerarPdfTurma1'>
                
            <img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'>
                
         </div> -->
    </div>
    
    <div class="linhaDeAteSelectTodosErelatorio">

		<label class="lblDeTabelaTodosOsComunicados">De</label>
		<input class="inpDeTabelaTodosOsComunicados" type="date" <?php echo("value='{$data_atual}'"); echo ("max='{$data_atual}'"); ?> name="datepicker_de" id="datepicker_de" required="required">
		<label class="lblAteTabelaTodosOsComunicados">Até</label>
		<input class="inpAteTabelaTodosOsComunicados" type="date" name="datepicker_ate" id="datepicker_ate" <?php echo("value='{$data_atual}'"); echo ("max='{$data_atual}' required='required'>");?>
		
		<input class="btnTodosComunicados" type="button" name="todos" value="Todos" onclick="filtrarTodosComunicadosEnviados(<?php echo($codTurma); ?>)">
		
		<input class="btnBuscarTodosComunicados" type="button" value="buscar" name="intervalo_data" onclick="filtrarComunicadosIntervaloData(this, <?php echo($codTurma); ?>)">
		
			<label class="lblOrdernarPorTabelaTodosOsComunicados">Ordenar por
			
				<div class="divSelectOrdenarTodosComunicados">
			
					<select id="selectOrdenar" onchange="ordenarComunicadosEnviados(<?php echo($codTurma); ?>)">
						<option value="0">Data mais recente</option>
						<option value="1">Data mais antiga</option>
					</select>  
					
				</div>
			</label>

	</div>
			
	<div class="caixaTabelaTodosComunicadosDeterminadaTurma">

		<div id="conteudoPageComunicado">
		<?php
			if(!is_null($listaTodosComunicadosEnviados))
			{
				echo("<table class='tabelaComunicadoTurma' id='tabelaTodosComunicadosDeterminadaTurma'>");
				
					echo("<thead>");
						echo("<tr>"); 
							echo("<td class='tituloComunicado1' id='tituloComunicado'>N°</td>");
							echo("<td class='tituloComunicado1' id='tituloComunicado'>Descrição</td>");
							echo("<td class='tituloComunicado1' id='tituloComunicado'>Data</td>");
							echo("<td class='tituloComunicado1' id='tituloComunicado'>Hora</td>");
						echo("</tr>");
					echo("</thead>");

						
					$i = 1;
					foreach ($listaTodosComunicadosEnviados as $key => $comunicadoEnviado) 
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
</div>

<script type="text/javascript">

	function filtrarTodosComunicadosEnviados(codTurma){

		$.ajax({
			asyn: false,
			url: "viewVisualizarComunicadosEnviados.php",
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

	function filtrarComunicadosIntervaloData(filtro, codigoturma) 
	{
		//alert(filtro.name + "  " + codigoturma + " data_de: " + $("#datepicker_de").val() + " data_ate: " + $("#datepicker_ate").val());
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
				$('#conteudoPageComunicado').html(data);
			}
		});

		//alert("De: " + data_de + " Até: " + data_ate);
		
	}

	function ordenarComunicadosEnviados(codigoturma)
	{
		var ordenar_por;

		$("#selectOrdenar option").each(function() {

			if($(this).prop("selected"))
			{
				ordenar_por = $(this).val();
			}

		});

		$.ajax({
			asyn: false,
			url: "viewFiltrarComunicadosEnviados.php",
			dataType: "html",
			type: "POST",
			data: 
			{
				ordenarPor: ordenar_por, 
				codTurma: codigoturma
			},
			success: function(data)
			{
				$('#conteudoPageComunicado').html(data);
			}
		});

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

	<script type="text/javascript">
	  //Paginação
	  function pgTodosComunicados(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
            };
    //Paginação
</script>
