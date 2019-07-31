<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerRotina.php");
include_once("../Controller/ProfessorTurmaCRUD.php");

session_start();

$id_usuario = (isset($_POST['id'])) ? intval($_POST['id']) : null ;

$codTurma = (isset($_POST['codigoturma'])) ? intval($_POST['codigoturma']) : null ;


$controllerProfessor = new ProfessorTurmaCRUD();
$nomeTurma = $controllerProfessor->consultarNomeTurma($codTurma);  

$controllerRotina = new ControllerRotina();

$resultadoConsulta = $controllerRotina->visualizarTodasRotinasEnviadas($id_usuario, $nomeTurma);

$listaTodasRotinasEnviadas = (!$resultadoConsulta) ? null : $resultadoConsulta ;


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


<div class="caixaGlobalTodasRotinasEnviadas">
	<div class="caixaTurmaTodasDataIntervaloEbusca">
		<div class="localDeteminadaTurmaT">
			<label class="lblDeteminadaTurmaT">Turma: <?php echo($nomeTurma); ?></label>
		</div>
		<input class="checkbox-regularTodas" type="checkbox" name="todas" id="todas" onclick="filtrarTurmaProfessorTodas(<?php echo($id_usuario.", ".$codTurma); ?>)"/>
		<label class="lblFiltrarTodas">Todas</label>
		<label class="lblDe">De</label>
		<input class="inpDe" type="date" <?php echo("value='{$data_atual}'"); echo ("max='{$data_atual}'"); ?> name="datepicker_de" id="datepicker_de" required="required">
		<label class="lblAte">Até</label>
		<input class="inpAte" type="date" name="datepicker_ate" id="datepicker_ate" <?php echo("value='{$data_atual}'"); echo ("max='{$data_atual}' required='required'>");?>
		<input class="bntBuscar" type="button" value="buscar" name="intervalo_data" onclick="filtrarTurmaProfessorIntervaloData(this, <?php echo($codTurma); ?>)">
		<label class="lblOrdenarPor">Ordenar por
			<div class="div-selectOrdenacao">
				<select id="selectOrdenar" onchange="ordenarRotinasEnviadas(<?php echo($codTurma); ?>)">
					<option value="0">Data Mais recente</option>
					<option value="1">Data Mais antiga</option>
				</select>
			</div>
		</label>
	</div>
	<div class='iconeGerarPdfTurma'>
		<a href="#" onclick="gerarRelatorioGeralRotinasEnviadas(<?php echo($id_usuario); ?>, '<?php echo($nomeTurma); ?>')">    
			<img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'>
		</a>
	</div>

	<div id="conteudoTurmaProfessor" class="caixaTabelaTodasRotina">
		<?php
		if(!is_null($listaTodasRotinasEnviadas))
		{
			echo("<table class='tabelaTodasRotinaDeterminadaTurma' cellspacing='0'>");
			echo("<thead>");
			echo("<tr>");
			echo("<td class='tituloCdTRotinaTurma'>Nº</td>");
			echo("<td class='tituloCdTRotinaTurma'>Aluno</td>");
			echo("<td class='tituloCdTRotinaTurma'>Turma</td>");
			echo("<td class='tituloCdTRotinaTurma'>Data</td>");
			echo("<td class='tituloCdTRotinaTurma'>Horário</td>");
			echo("<td class='tituloCdTRotinaTurma'>Ações</td>");
			echo("</tr>");
			echo("</thead>");
			echo("<tbody>");

			$i = 1;
			foreach ($listaTodasRotinasEnviadas as $key => $rotinaEnviada) 
			{
				$dataCompleta = explode(" ", $rotinaEnviada->getDataCadastro());
				$data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
				$horario = $dataCompleta[1];

				echo("<tr id={$rotinaEnviada->getId()}>");

				echo("<td class='linhaCdTRotinaTurma'>");

				echo("{$i}");

				echo("</td>");

				echo("<td class='linhaCdTRotinaTurma'>");

				echo("{$rotinaEnviada->aluno->getNome()}");

				echo("</td>");

				echo("<td class='linhaCdTRotinaTurma'>");

				echo("{$rotinaEnviada->turma->getDescricao()}");

				echo("</td>");

				echo("<td class='linhaCdTRotinaTurma'>");

				echo("{$data}");

				echo("</td>");

				echo("<td class='linhaCdTRotinaTurma'>");

				echo("{$horario}");

				echo("</td>");

				echo("<td class='linhaCdTRotinaTurma'>");

					//echo("<div class='iconeGerarPdfTurma'>");
				?>
				<a href="#" onclick="gerarRelatorioEspecificoRotina(<?php echo($id_usuario)?>, '<?php echo($nomeTurma); ?>', <?php echo($rotinaEnviada->getId()); ?>)"> 

					<img src="../Imagens/printer-.png" alt=""><!-- <img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'> -->

				</a>

				<?php
			        //echo("</div>");

				echo("</td>");

				echo("</tr>");

				$i++;
			}

			echo("</tbody>");
			echo("</table>");
		}
		else
		{
			echo("<div class='RotinaEnviadaNaoEncontrada'>Não foi encontrado nenhuma rotina enviada...</div>");	
		}	
		?>
	</div>
</div>

<?php

//Paginação
$i = 1;
$calculo = ($_POST['calculoTodasRotinas']) ? $_POST['calculoTodasRotinas'] : null;

echo "<ul class='paginacaoCadAux'>";
if(empty($_GET['pageTodasRotinas'])){} else { $pagina = $_GET['pageTodasRotinas'];}
if(isset($pagina)){ $pagina = $_GET['pageTodasRotinas'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
	echo "<li>"; 
	echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasEnviadas.php?pageTodasRotinas=$voltar')"."><</a>";
	echo "</li>";
}else{}

         // $pg =  $_POST["pageTodasRotinas"];
while ($i <= $calculo) {
	$estilo= "";
	if($pagina == $i){
		$estilo =  "div style='position: relative;
		display: block;
		width: 35px;
		height: 35px;
		font-size: 20px;
		text-align: center;
		line-height: 35px;
		background-color: rgba(9, 132, 227, 1.0);
		color: white;
		border-radius: 3px;
		text-decoration: none;
		top: -50px;
		cursor;pointer;
		border: 1px solid rgba(9, 132, 227, 1.0);";
	}
	?>
	<li <?php echo $estilo;?>>
		<?php
		echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasEnviadas.php?pageTodasRotinas={$i}')".">$i</a>";
		$i++;
		if($i > 10){
			echo "<li>"; 
			echo "<a>...</a>";
			echo "</li>"; 

			if(@$pagina > 11){
				echo "<li>"; 
				echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasEnviadas.php?pageTodasRotinas=$valorAtual')".">$valorAtual </a>";
				echo "</li>"; 
			}else{
				echo "<li>"; 
				echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasEnviadas.php?pageTodasRotinas=11')".">11</a>";
				echo "</li>"; 
			}
			if (@$pagina <  ($calculo +5)) {
				echo "<li>"; 
				echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasEnviadas.php?pageTodasRotinas=$seguir')".">></a>";
				echo "</li>"; 
			}
			break;
		}  

	}
	echo("</ul>");
 //Paginação
	?>

	<script type="text/javascript">
	  //Paginação
	  function pgRotinasEnviadas(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
            };
    //Paginação
</script>


<script type="text/javascript">
	
	function filtrarTurmaProfessorTodas(idUsuario, codTurma){
		
		$.ajax({
			asyn: false,
			url: "viewVisualizarRotinasEnviadas.php",
			dataType: "html",
			type: "POST",
			data: { 
				id: idUsuario,
				codigoturma: codTurma
			},
			success: function(data)
			{
				$('#conteudoPageRotina').html(data);
			}
		});
		
	}	

	function filtrarTurmaProfessorIntervaloData(filtro, codigoturma) 
	{
		$.ajax({
			asyn: false,
			url: "viewFiltrarRotinasEnviadas.php",
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

	function ordenarRotinasEnviadas(codigoturma)
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
			url: "viewFiltrarRotinasEnviadas.php",
			dataType: "html",
			type: "POST",
			data: 
			{
				ordenarPor: ordenar_por, 
				codTurma: codigoturma
			},
			success: function(data)
			{
				$('#conteudoTurmaProfessor').html(data);
			}
		});
	}




	//	Relatórios das rotinas enviadas
	function gerarRelatorioGeralRotinasEnviadas(codUsuario, nomeTurma)
	{
		swal({
			title: "Tem certeza que deseja gerar um relatório geral de todas as rotinas enviadas?",
			icon: "warning",
			buttons: [
			'Não',
			'Sim'
			],
			dangerMode: true,
		}).then(function(isConfirm) { 
			if (isConfirm) {
				window.open('../Reports/reportsRotinasEnviadas.php?key_rpt_rotina=all&id_usuario='+codUsuario+'&nome_turma='+nomeTurma, '_blank');
			} 
		});	
	}
	
	function gerarRelatorioEspecificoRotina(codUsuario, nomeTurma, codRotina)
	{
			
		swal({
			title: "Tem certeza que deseja gerar um relatório específico desta rotina?",
			icon: "warning",
			buttons: [
			'Não',
			'Sim'
			],
			dangerMode: true,
		}).then(function(isConfirm) { 
			if (isConfirm) {
				window.open('../Reports/reportsRotinasEnviadas.php?key_rpt_rotina=especifico&id_usuario='+codUsuario+'&id_rotina='+codRotina+'&nome_turma='+nomeTurma, '_blank');
			} 
		});	
	}	


</script>

