<?php
    include_once("../Controller/AlunoCRUD.php");
	include_once("../Controller/ControllerProntuario.php");
    include_once("../Controller/ControllerMatricula.php");
    include_once("../Controller/ControllerTurma.php");
    include_once("../Controller/ControllerGrauEscolar.php");
    include_once("verificaUsuarioLogado.php");
    include_once("../Model/Aluno.php");

    $codAluno = (isset($_POST['id'])) ? intval($_POST['id']) : null; 

    $controllerProntuario = new ControllerProntuario();
    $codProntuario = $controllerProntuario->pesquisarProntuarioAluno($codAluno);

    $controllerMatricula = new ControllerMatricula();
    $matricula = $controllerMatricula->preencherMatriculaPorAluno($codAluno);

    $listaProntuario = $controllerProntuario->consultarProntuario($codProntuario);
    $tipoSanguineo = $listaProntuario->getTiposanguineo();

    $controllerAluno = new AlunoCRUD();
    $listaAluno = $controllerAluno->ConsultaAluno($codAluno);

    $turma = new Turma();
    $turma->setId(intval($matricula->turma->getId()));

    

       if($turma->getId() <= 0)
       {       
            $turma->setDescricao("Não está em nenhuma turma");
            
            $grauEscolar = new GrauEscolar();
            $grauEscolar->setDescricao("Indefinido");
            $turma->addGrauEscolar($grauEscolar);
            
       }
       else
       {   
            $controllerTurma = new ControllerTurma();

            $turma = $controllerTurma->preencherTurma($turma->getId());
            
            $controllerGrauEscolar = new ControllerGrauEscolar();
            $grauEscolar = $controllerGrauEscolar->preencherGrauEscolar($turma->grauEscolar->getId());
            
            $turma->addGrauEscolar($grauEscolar);
        }

        foreach($listaAluno as $aluno)
        {
            $nome_foto = $aluno->getFoto();
            $nome_aluno = $aluno->getNome();
            $data_aluno = $aluno->getDatanascimento();
            $sexo_aluno = $aluno->getSexo();
            $numMatricula_aluno = $matricula->getNumero();      
        }

        $deficiencia = $listaProntuario->getDeficiencia(); 
        $problema = $listaProntuario->getProblemasaude();
        $doenca = $listaProntuario->getDoencacontagiosa();
        $tratamento = $listaProntuario->getTratamentocirurgico();
        $alergia = $listaProntuario->getAlergia();
        $medicacao = $listaProntuario->getMedicacao();

        if($deficiencia == "" || $deficiencia == ",0" || $deficiencia == "0"){
          $deficiencia = "Nenhuma";
        }else{
            $deficiencia = str_replace(',', '', $deficiencia);
        }

        if($problema == "" || $problema == ",0" || $problema == "0"){
          $problema = "Nenhum";
        }else{
            $problema = str_replace(',', '', $problema);
        }

        if($doenca == "" || $doenca == ",0" || $doenca == "0"){
          $doenca = "Nenhuma";
        }else{
            $doenca = str_replace(',', '', $doenca);
        }

        if($tratamento == "" || $tratamento == ",0" || $tratamento == "0"){
          $tratamento = "Nenhum";
        }else{
            $tratamento = str_replace(',', '', $tratamento);
        }

        if($alergia == "" || $alergia == ",0" || $alergia == "0"){
          $alergia = "Nenhuma";
        }else{
            $alergia = str_replace(',', '', $alergia);
        }

        if($medicacao == "" || $medicacao == ",0" || $medicacao == "0"){
          $medicacao = "Nenhuma";
        }else{
            $medicacao = str_replace(',', '', $medicacao);
        }

?>

<!--<table>
        <thead>
            <tr>
                <th>Código</th>  
                <th>Características</th>
   
            </tr>
        </thead>
        <tbody>-->
        
<link rel="stylesheet" type="text/css" href="../css/styleConsultaProntuarioFilho.css">        


<?php

$aux = str_replace('-', '/', $data_aluno);
$dataNascAluno = date('d/m/Y', strtotime($aux));

echo "<div class='visualizacaoProntuarioFilho'>";

    echo "<div class='divTopoVoltarCardFilho'>";

        echo "<a class='iconeRetornarCardFilho' href='#' id='dirFilhos' name='dirFilhos' onclick="."voltarDirFilhos('viewConsultarFilhosResponsavel.php')>";

            echo "<img class='iconSetaRetorno' src='../Imagens/iconeProntuarioSetaRetornoCardFilho.png'>";

        echo"</a>";

        echo "<div class='iconeEprontuario'>";
            
            echo "";
            
            echo "<h1 class=''><img class='' src='../Imagens/iconeProntuarioVisualizacao.png'>Prontuário</h1>";
            
        echo "</div>";

    echo "</div>";

echo "<div class='informacoesProntuario'>";

        echo "<div class='areaInformacoesFilho'>";

            echo "<div class='fotoDePerfilFilhoFichaMedica'>";

                echo "<img class='iconFotoFilho' src='../fotos/".$nome_foto."'>";

            echo "</div>";

            echo "<p class='pNomeFP'>- Nome: {$nome_aluno}</p>";

            echo "<label class='lblFMturma'>- Turma: {$turma->getDescricao()}</label>";

            echo "<label class='lblFMgrau'>- Grau: {$turma->grauEscolar->getDescricao()}</label>";

            echo "<label class='lblDFMnasc'>- Data de nascimento: {$dataNascAluno}</label>";

            echo "<label class='lblSexoFMs'>- Sexo: {$sexo_aluno}</label>";

            echo "<label class='lblNFMm'>- N° de matricula: {$numMatricula_aluno}</label>";

                       
        echo "</div>";

        echo "<div class='areaFichaMedica'>";

           echo "<label class='lblFichaMedica'>Ficha médica</label>";

            echo "<img class='icontiposangue' src='../Imagens/iconetipodesanguineo.png'>";

           echo "<label class='lblTS'>Tipo sanguineo: {$tipoSanguineo}</label>";

            echo "<img class='iconOutrosAtributosMedicos3' src='../Imagens/iconeOutrosAtribuosMedicos.png'>";

           echo "<label class='lblDC'>Doenças contagiosas: {$doenca}</label>";

            echo "<img class='iconMedicacoes' src='../Imagens/iconeMedicacoes.png'>";

           echo "<label class='lblM'>Medicações: {$medicacao}</label>";

            echo "<img class='iconDeficiencias' src='../Imagens/iconeDeficiencia.png'>";

           echo "<label class='lblD'>Deficiências: {$deficiencia}</label>";

            echo "<img class='icontratamentoscirurgicos' src='../Imagens/iconetratamentoscirurgicos.png'>";

           echo "<label class='lblTC'>Tratamentos cirúrgicos: {$tratamento}</label>";

            echo "<img class='iconOutrosAtributosMedicos' src='../Imagens/iconeProblemasDeSaude.png'>";

           echo "<label class='lblPDS'>Problemas de saúde: {$problema}</label>";

            echo"<img class='iconOutrosAtributosMedicos2' src='../Imagens/iconeOutrosAtribuosMedicos.png'>";

           echo "<label class='lblAlergias'>Alergias: {$alergia}</label>";

        echo "</div>";


echo "</div>";

echo "</div>";
?>

<script type="text/javascript" language="javascript">                
       
    function voltarDirFilhos(pagina){
        // Carrega os dados de: pagina_conteudo.php na div id="conteudo"
        $("#painel").load(pagina);        
    };     

</script>


 <!--</tbody>
</table>-->
