<?php
	include_once("../Controller/ProfessorTurmaCRUD.php");
    include_once("../Controller/AlunoCRUD.php");
    include_once("../Controller/ControllerRotina.php");
    include_once("verificaUsuarioLogado.php");		

	session_start();

	$codUsuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;


	$codigoturma = isset($_POST['codigoturma']) ? intval($_POST['codigoturma']) : null ;

    $controllerProfessorTurma = new ProfessorTurmaCRUD();
    $nomeTurma = $controllerProfessorTurma->consultarNomeTurma($codigoturma);

    $listaAlunosTurma = $controllerProfessorTurma->consultarAlunosTurma($codigoturma);

    $total_alunos_turma = count($listaAlunosTurma);

	$i = 1;

    $controllerRotina = new ControllerRotina();

    $dadosRotina = $controllerRotina->dadosAnaliticosRotinasTurma($codigoturma);
    $dadosRotina['restantes'] = count($listaAlunosTurma) - $dadosRotina['enviadas'];

?>

<div class="telaVisualizarAlunos">
            <div class="topoTelaVisualizarAlunos">
               <?php 
                echo"<a class='iconeRetornoAbaAlunos' href='#' onclick='voltarPageAnterior({$codUsuario})'>";
                echo "<img class='iconSetaRetornoAbaAlunos' src='../Imagens/iconeSetaRetornoAbaTurmas.png'>";
                echo "</a>";
                
                ?>
                <div class="iconeElabelAlunos">
                    <img class="iconTopoAlunos" src="../Imagens/iconePainelAlunos.png">
                    <label class="lblTopoAlunos">Alunos</label>
                </div>
            </div>
            <div class="conteudoAlunos">
               
               <?php
                echo "<div class='linha1T'>";
                
                echo "<article class='artC1'>";
                
	            echo("<label class='lblTurmaAlunoT'>Turma: {$nomeTurma}</label>");
	            echo("<label class='lbltotalAlunosT'>Total de alunos: {$total_alunos_turma}</label>");
                
                echo "</article>";
                
                if ($dadosRotina['restantes'] > 0)
                {
                    echo("<article class='artC2'>");

                        echo("<label class='lblRoEnviadas'>Enviadas: {$dadosRotina['enviadas']}</label>"); 

                        echo("<label class='lblRoFaltam'>Restantes: {$dadosRotina['restantes']}</label>");

                    echo("</article>");
                } 
                else
                {
                    echo("<article class='artC2'>");
                    
                        echo("Rotinas diárias enviadas: {$dadosRotina['enviadas']}/{$dadosRotina['enviadas']}");
                
                    echo("</article>");
                }
                
                
                // echo "<a class='iconeGerarPdfTurma1' href=''>";
                
                // echo "<img class='' src='../Imagens/ImagensRotinaProfessor/printer.png'>";
                
                // echo "</a>";
                
                
                echo "</div>";
                ?>
                
                <div class="linha2T">
                
                <article class="artCC1">
                
                <table class="tabelaAlunosTurmaProf">
    <thead>
        <tr>
        	<td class="tituloAlunosT">Nº</td>
            <td class="tituloAlunosT">Aluno</td>
            <td class="tituloAlunosT">Status da Rotina</td>
        </tr>
    </thead>
        
    <tbody>

		<?php
			$num_aluno = 1;

			foreach ($listaAlunosTurma as $aluno) 
			{
		        $controllerAluno = new AlunoCRUD();
		        $codAluno = intval($aluno['codAluno']);

		        $nomeAluno = $controllerAluno->pesqAlunoPorCodigo($codAluno);
		                
		        $codAgendaAluno = intval($controllerAluno->AgendaAlunoPorCodigo($codAluno));

		        // Validar Rotinas enviadas
		        $rotinaEnviada = $controllerRotina->checarRotinaEnviada($codAgendaAluno);


		        echo("<tr class='infoAlunosT'>");

		        	echo("<td class='linhaATP'>{$num_aluno}</td>");
		        	echo("<td class='linhaATP'>{$nomeAluno}</td>");

		        	echo("<td class='linhaATPS'>");

		        		if ($rotinaEnviada)
                        {
                            echo "<img class='iconConfirmacaoR' src='../Imagens/iconeConfirmacaoR.png'>";
                            echo("<label class='lblEnviada'>Enviada</label>");
                        }
                        else
                        {
                            echo "<img class='iconPendeR' src='../Imagens/iconeRelogio.png'>";
                            echo("<label class='lblPendente'>Pendente</label>");
                        }

		        	echo("</td>");

		        echo("</tr>");

		        $num_aluno++;
		    }
		?>

	</tbody>

</table>
              </article>
               </div>
               <div class="linha3T">
                  <article class="artCCC1">
                      
                  </article>
               </div>
                
            </div>
        </div>
<script type="text/javascript">
	
	// Voltar
    function voltarPageAnterior(codUsuario)
    {
        $.ajax({ 
            asyn: false,
            url: "viewTurmasProfessor.php",
            dataType: "html",
            type: "POST",
            data: { id: codUsuario},
            success: function(data){
                $('#painelAbas').html(data);
            },
        });
    }    


</script>