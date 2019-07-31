<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ControllerPeriodo.php");


	try {
		
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_periodo"]) and isset($_POST["horario_periodo"])){
                //header("Location: viewConsultarTipoUsuario.php");

                $descPeriodo = trim($_POST["nome_periodo"]); 
                $horarioPeriodo = trim($_POST["horario_periodo"]);

                $codPeriodo = $_POST['cod_periodo'];

       			$controllerPeriodo = new ControllerPeriodo();

                $resposta = $controllerPeriodo->editarPeriodo($codPeriodo, $descPeriodo, $horarioPeriodo);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>Período editado com sucesso!</h1>')</script>";
	            }else{
	            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar Cadastrar Período</h1>')</script>";
	           	}
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarPeriodo.php");

?>