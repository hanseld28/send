<?php

include_once("../Controller/ControllerProntuario.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Controller/AlunoCRUD.php");
include_once("../Model/Usuario.php");
include_once("verificaUsuarioLogado.php");
session_start();

		$controlleraluno = new AlunoCRUD();
		$codaluno = $controlleraluno->UltimoAluno();

	    $arrdeficiencia = array(); 
	    $arrdoenca = array();
	    $arrproblema = array();
	    $doenca = "";
	    $deficiencia  = "";
	    $problema = "";

		$tipo = (isset($_POST['tipoSanguineo'])) ? $_POST['tipoSanguineo'] : null;
		$arrdeficiencia = (isset($_POST['deficiencias'])) ? $_POST['deficiencias'] : null;
		$arrdoenca = (isset($_POST['doencasContagiosas'])) ? $_POST['doencasContagiosas'] : null;
		$arrproblema = (isset($_POST['problemassaude'])) ? $_POST['problemassaude'] : null;
		$descDoenca = (isset($_POST['descDoenca'])) ? $_POST['descDoenca'] : null;
		$descDeficiencia = (isset($_POST['descDeficiencia'])) ? $_POST['descDeficiencia'] : null;
		$descProblema = (isset($_POST['descProblema'])) ? $_POST['descProblema'] : null;
		$descCirurgia = (isset($_POST['descCirurgia'])) ? $_POST['descCirurgia'] : null;
		$descAlergia = (isset($_POST['descAlergia'])) ? $_POST['descAlergia'] : null;
		$descMedicacoes = (isset($_POST['descMedicacoes'])) ? $_POST['descMedicacoes'] : null;

		if($arrdeficiencia != null){
		foreach ($arrdeficiencia as $def){

			$deficiencia = $deficiencia.",".$def;
		}}

		    if($descDeficiencia != null){
		    	$deficiencia = $deficiencia.",".$descDeficiencia;
		    }


		if($arrdoenca != null){
		foreach ($arrdoenca as $doe){

			$doenca = $doenca.",".$doe;
		}}
		
		    if($descDoenca != null){
		    	$doenca = $doenca.",".$descDoenca;
		    }
		

		if($arrproblema != null){
		foreach ($arrproblema as $pro){

			$problema = $problema.",".$pro;
		}}
		
		    if($descProblema != null){
		    	$problema = $problema.",".$descProblema;
		    }

		if(!is_null($descCirurgia)){
			$tratamento = $descCirurgia;
		}else{
			$tratamento = "Sem Tratamento Cirurgico";
		}

		if(!is_null($descAlergia)){
			$alergia = $descAlergia;
		}else{
			$alergia = "Sem Alergias";
		}

		if(!is_null($descMedicacoes)){
			$medicacao = $descMedicacoes;
		}else{
			$medicacao = "Sem Medicações";
		}

        //var_dump($alergia);

        $mandardados = new ControllerProntuario();
        $resultado = $mandardados->cadastrarProntuario($codaluno, $tipo, $deficiencia, $problema, $doenca, $tratamento, $alergia, $medicacao);


        
        if($resultado){
           ?>
           <?php

           	echo "<script> Alert.render('<h1>Ficha médica cadastrada com sucesso</h1>')</script>";

           	$_SESSION['tipo'] = $tipo; 
           	$_SESSION['deficiencia'] = $deficiencia;
           	$_SESSION['problema'] = $problema;
           	$_SESSION['doenca'] = $doenca; 
           	$_SESSION['tratamento'] = $tratamento;
           	$_SESSION['alergia'] = $alergia;
           	$_SESSION['medicacao'] = $medicacao;
            
            include_once("pageRevisaoDados.php");
        
             }else {
                echo "<script> AlertdeErro.render('<h1>Erro ao cadastrar a ficha médica</h1>')</script>";
               }

 
include_once("pageRevisaoDados.php");
?>

      
  
          




           
        