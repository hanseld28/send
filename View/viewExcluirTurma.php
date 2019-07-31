<?php
include_once("../Controller/ControllerTurma.php");

	try {
		
			if(isset($_POST['id'])){
			        	$codTurma = intval($_POST['id']); 

			            $controllerTurma = new ControllerTurma();

			            $resposta = $controllerTurma->excluirTurma($codTurma);

			    		//var_dump($resposta);        
			            if($resposta == "true"){
			            	//header("Location: pageCadastroTurma.php");
			            	
			            	echo "<script> Alert.render('<h1>Turma excluída com sucesso!</h1>')</script>";
			            }else if($resposta == "false"){
			            	 echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar excluir a turma...</h1>')</script>";
			            }else{
			            	echo "<script> AlertdeErro.render('<h1>".$resposta."</h1>')</script>";

			            }
			        }	  

	} catch (Exception $e) {
		echo $e->getMessage();
	}
include_once("viewConsultarTurma.php");
		 
?>