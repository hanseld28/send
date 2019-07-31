   <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
   <script src="../css/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
   <?php
   include_once("../Controller/ControllerUsuario.php");
   include_once("funcoesUtilitarias.php");

   $codAgenda = (isset($_GET['idAgenda'])) ? intval($_GET['idAgenda']) : null ;
   $codRotina = (isset($_POST['idRotina'])) ? intval($_POST['idRotina']) : null ;


   echo "<div class='visualizacaoRotinaEspecifica'>";

   echo "<div class='divTopoVoltarAgendaFilho'>";

   echo "<a class='iconeRetornarAgenda' href='#' id='dirRotinas' name='dirAgenda' onclick="."voltarDirAgenda('viewConsultarRotinasCrianca.php?url_id_agenda={$codAgenda}')>";

   echo "<img class='iconSetaRetorno' src='../Imagens/iconeSetaRetornoAgendaFilho.png'>";

   echo"</a>";

   echo "<div class='iconeErotina'>";

   echo "<img class='iconAgendaRotina' src='../Imagens/iconeRotinaFilho.png'>";

   echo "<label class='lblRotina'>Rotina</label>";

   echo "</div>";

   echo "</div>";
    //fecha a div que tem o icone de voltar e label rotina;

   $controllerUsuario = new ControllerUsuario();

   $aluno = $controllerUsuario->pesquisarAlunoAgenda($codAgenda);

   $rotina = $controllerUsuario->consultarRotinaEspecificaCrianca($codAgenda, $codRotina);

   if (!is_null($codAgenda)) 
   {
    if (!is_null($codRotina)) 
    {       
        if(is_object($rotina)) 
        {
            $dataCompleta = explode(" ", $rotina->getDataCadastro());
            $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
            $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";
            $diaSemana = calculaDiaSemana($data);

                //informações rotina;
            echo"<div class='embrulho'>";
            echo "<div class='informacoesRotina'>";

                //Area informações des, ocorrencias;

                //areaInformacoesDadosDaRotinaDofilho;

            echo "<div class='areaInformacoesDadosDaRotinaDofilho'>";

            echo "<div class='caixaDataDaRotina'>";

            echo "<label class='lblDataTDaRotina'>Rotina de {$diaSemana} - <label>{$data}</label>&nbsp; &nbsp; </label>";

            echo "<label class='lblHorarioQueArotinaFoiEnviada'>Enviada às {$horario}</label>";


            echo "</div>";

            echo "<div class='caixaNomeDoFilhoEturmaDoFilho'>";

            echo "<img class='iconGerarPdfRotinaEspecifica' onclick='gerarRelatorioEspecificoRotinaRecebida({$codAgenda}, {$codRotina})' src='../Imagens/ImagensRotinaProfessor/printer.png'>";

            echo "<label class='lblNomeDoFilhoNaRotina'>Nome</label>";

            echo "<p class='pNomeDoFilho'>- {$aluno->getNome()}</p>";

            echo "<label class='lblTurmaNaRotina'>Turma</label>";

            echo "<p class='pTurmaDoFilho'>- {$rotina->turma->getDescricao()}</p>";

            echo "<label class='lblTProfessorNaRotina'>Prof°</label>";

            echo "<p class='pProfessorDoFilho'>- {$rotina->professor->getNome()}</p>";

            echo "</div>";

            echo "<div class='caixaOcorrenciasDofilho'>";

            $ocorr = "<label class='lblOcorrenciasDofilho'>Ocorrências</label>";

            if($rotina->ocorrencias->count() == 0)
            {
                $ocorr .= "<p class='pOcorrenciaRelatada'>Não houve ocorrências...<p>";             
            }
            else
            {
                $i = 0;
                foreach ($rotina->ocorrencias as $ocorrencia) 
                {
                    $i++;
                    $ocorr .= "<p class='pOcorrenciaRelatada'>$i. {$ocorrencia->getDescricao()}</p>";
                }
            }

            echo $ocorr;

            echo "</div>";

            echo "</div>";

                //fecha areaInformacoesDadosDaRotinaDofilho;


                //cards rotina;

            echo "<div class='areaCardsDaRotinaDofilho'>";

            $url_emoji = "";
            $class_color_react = "";

            foreach ($rotina->cards as $card) 
            {

                if($card->alternativa->getId() == 1){

                    $url_emoji = "reacaoAlternativaBom.png";

                    $class_color_react = "alternativaBoa";


                }else if($card->alternativa->getId() == 2){

                    $url_emoji = "reacaoAlternativaRegular.png";

                    $class_color_react = "alternativaRegular";

                }
                else if($card->alternativa->getId() == 3){

                    $url_emoji = "reacaoAlternativaRuim.png";

                    $class_color_react = "alternativaRuim";

                }

                echo "<div class='cardCategorias' id='{$class_color_react}'>";

                echo "<div class='caixaLabelCategoria'>";

                echo "<label class='lbTituloCategoria'>- {$card->getDescricao()}</label>";

                echo "</div>";

                echo "<div class='caixaAlternativa'>";

                echo "<img class='iconReacao' src='../Imagens/{$url_emoji}'>";

                echo "<label class='lbTituloAlernativa'>{$card->alternativa->getDescricao()}</label>";

                echo "</div>";


                echo "</div>";
            }

            
            
            echo "</div>";

                //fecha informações rotina;

        }
        
    }
    else
    {
        echo "Rotina não encontrada...";
    }
}

echo "</div>";echo "</div>";

?>

<script type="text/javascript" language="javascript">

    function voltarDirAgenda(pagina){
        // Carrega os dados de: pagina_conteudo.php na div id="conteudo"
        $("#painel").load(pagina);     
    };
    
    function gerarRelatorioEspecificoRotinaRecebida(codAgenda, codRotina)
    {

               window.open('../Reports/reportsRotinasRecebidas.php?key_rpt_rotina=especifica&id_agenda='+codAgenda+'&id_rotina='+codRotina, '_blank');
        };
</script>
