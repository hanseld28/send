<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ControllerAtividadeExtraCurricular.php");


	try {
		
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_atividade"])){
                //header("Location: viewConsultarTipoUsuario.php");

                $descAtividade = trim($_POST["nome_atividade"]); 
                $codAtividade = $_POST['cod_atividade'];

       			$controlleratividade = new ControllerAtividadeExtraCurricular();

                $resposta = $controlleratividade->editarAtividadeExtraCurricular($codAtividade, $descAtividade);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>Atividade editada com sucesso!</h1>')</script>";
	            }else{
	            	echo "<script> AlertdeErro.render('<h1>Atividade já Cadastrada</h1>')</script>";
	           	}
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarAtividadeExtraCurricular.php");
?>