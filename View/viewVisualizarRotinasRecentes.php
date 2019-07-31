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

$resultadoConsulta = $controllerRotina->visualizarTodasRotinasRecentes($id_usuario, $nomeTurma);

$listaRotinasRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta ;

// Data atual do Servidor Host
date_default_timezone_set("America/Araguaina");
$data_atual = date("Y-m-d");

?>



<div id="conteudoTurmaProfessor">

	<div class="painelRecentesRotinasEnviadas">
		<div class="caixaRotinaEspecificaCampoPesquisaEtabelaRecentesRotina">
			<div class="localDeterminadaTurmaR">
				<label class="lblDeterminadaTurmaR">Turma: <?php echo($nomeTurma); ?></label>
			</div>

			<div class="caixaTabelaRecentesRotina">
				<div class='iconeGerarPdfTurma'>
					<a href="#" onclick="gerarRelatorioGeralRotinasRecentes(<?php echo($id_usuario); ?>, '<?php echo($nomeTurma); ?>')">    
						<img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'>
					</a>
				</div>

				<div class="caixaTabelaRecentesRotina">

					<?php
					if(!is_null($listaRotinasRecentes))
					{
						echo("<table class='tabelaRecentesRotinaDeterminadaTurma' cellspacing='0'>");
						echo("<thead>");
						echo("<tr>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Nº</td>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Aluno</td>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Turma</td>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Data</td>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Horário</td>");
						echo("<td class='tituloCdRecentesRotinaTurma'>Ações</td>");
						echo("</tr>");
						echo("</thead>");
						echo("<tbody>");							

						$i = 1;
						foreach ($listaRotinasRecentes as $key => $rotinaRecente) 
						{
							$dataCompleta = explode(" ", $rotinaRecente->getDataCadastro());
							$data = $dataCompleta[0];
							$horario = $dataCompleta[1];

							echo("<tr>");

							echo("<td class='linhaCdRecentesRotinaTurma'>");

							echo("{$i}");

							echo("</td>");

							echo("<td class='linhaCdTRotinaTurma'>");

							echo("{$rotinaRecente->aluno->getNome()}");

							echo("</td>");

							echo("<td class='linhaCdRecentesRotinaTurma'>");

							echo("{$rotinaRecente->turma->getDescricao()}");

							echo("</td>");

							echo("<td class='linhaCdRecentesRotinaTurma'>");

							echo("{$data}");

							echo("</td>");

							echo("<td class='linhaCdRecentesRotinaTurma'>");

							echo("{$horario}");

							echo("</td>");

							echo("<td class='linhaCdTRotinaTurma'>");
							//echo("<div class='iconeGerarPdfTurma'>");
							?>
							<a href="#" onclick="gerarRelatorioEspecificoRotina(<?php echo($id_usuario)?>, '<?php echo($nomeTurma); ?>', <?php echo($rotinaRecente->getId()); ?>)">    

								<img src="../Imagens/printer-.png" alt=""> <!-- <img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'> -->

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
		</div>

	</div>

	<?php

//Paginação
	$i = 1;
	$calculo = ($_POST['calculoRotinas']) ? $_POST['calculoRotinas'] : null;

	echo "<ul class='paginacaoCadAux'>";
	if(empty($_GET['pageRecentesRotinas'])){} else { $pagina = $_GET['pageRecentesRotinas'];}
	if(isset($pagina)){ $pagina = $_GET['pageRecentesRotinas'];}else{$pagina =1;}

	$voltar = $pagina - 1;
	$seguir = $pagina + 1;
	$valorAtual = $pagina;

	if( $pagina !=  1){
		echo "<li>"; 
		echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasRecentes.php?pageRecentesRotinas=$voltar')"."><</a>";
		echo "</li>";
	}else{}

         // $pg =  $_POST["pageRecentesRotinas"];
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
			border: 1px solid rgba(9, 132, 227, 1.0);";
		}
		?>
		<li <?php echo $estilo;?>>
			<?php
			echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasRecentes.php?pageRecentesRotinas={$i}')".">$i</a>";
			$i++;
			if($i > 10){
				echo "<li>"; 
				echo "<a>...</a>";
				echo "</li>"; 

				if(@$pagina > 11){
					echo "<li>"; 
					echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasRecentes.php?pageRecentesRotinas=$valorAtual')".">$valorAtual </a>";
					echo "</li>"; 
				}else{
					echo "<li>"; 
					echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasRecentes.php?pageRecentesRotinas=11')".">11</a>";
					echo "</li>"; 
				}
				if (@$pagina <  ($calculo +5)) {
					echo "<li>"; 
					echo "<a href='#' id='pgRotinasEnviadas' name='pgRotinasEnviadas' onclick="."pgRotinasEnviadas('viewVisualizarRotinasRecentes.php?pageRecentesRotinas=$seguir')".">></a>";
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


    //	Relatórios das rotinas recentes
    function gerarRelatorioGeralRotinasRecentes(codUsuario, nomeTurma)
    {
    	

    	swal({
    		title: "Tem certeza que deseja gerar um relatório geral das rotinas recentes?",
    		icon: "warning",
    		buttons: [
    		'Não',
    		'Sim'
    		],
    		dangerMode: true,
    	}).then(function(isConfirm) { 
    		if (isConfirm) {
    			window.open('../Reports/reportsRotinasEnviadas.php?key_rpt_rotina=recentes&id_usuario='+codUsuario+'&nome_turma='+nomeTurma, '_blank');
    		} 
    	});	
    }

        //	Relatórios das rotinas recentes
    function gerarRelatorioEspecificoRotina(codUsuario, nomeTurma, codigo)
    {
    	

    	swal({
    		title: "Tem certeza que deseja gerar um relatório geral das rotinas recentes?",
    		icon: "warning",
    		buttons: [
    		'Não',
    		'Sim'
    		],
    		dangerMode: true,
    	}).then(function(isConfirm) { 
    		if (isConfirm) {
    			window.open('../Reports/reportsRotinasEnviadas.php?key_rpt_rotina=especifico&id_usuario='+codUsuario+'&nome_turma='+nomeTurma+'&id_rotina='+codigo, '_blank');
    		} 
    	});	
    }

</script>


