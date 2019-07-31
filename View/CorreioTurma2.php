<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerTurma.php");

	try {
	
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_turma"]) and isset($_POST["grau_turma"])){
                //header("Location: viewConsultarTurma.php");

                $descTurma = trim($_POST["nome_turma"]); 
                $codGrauEscolar = intval($_POST["grau_turma"]);
                $codTurma = $_POST['cod_turma'];

                //var_dump($codTurma);
                //var_dump($descTurma);
                //var_dump($codGrauEscolar);

       			$controllerTurma = new ControllerTurma();

                $resposta = $controllerTurma->editarTurma($codTurma, $descTurma, $codGrauEscolar);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>turma editada com sucesso!</h1>')</script>";
	            }else{
	            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar a turma...</h1>')</script>";
	           	}
	        }	
		}

	} catch (Exception $e) {   
		echo $e->getMessage();
	}

include_once("viewConsultarTurma.php");
?>


