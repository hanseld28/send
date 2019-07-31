<?php
include_once("../Controller/ControllerAtividadeExtraCurricular.php");

	try {
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

			    	if(isset($_POST['id'])){
			        	$codAtividade = intval($_POST['id']); 

			            $controlleratividade = new ControllerAtividadeExtraCurricular();

			            $resposta = $controlleratividade->excluirAtividadeExtraCurricular($codAtividade);

			    		//var_dump($resposta);        
			            if($resposta == "true"){
			            	//header("Location: pageCadastroPeriodo.php");
			            	   echo "<script> Alert.render('<h1>Atividade excluida com sucesso!</h1>')</script>";
			            }else if($resposta == "false"){
			            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar excluir a atividade...</h1>')</script>";
			            }else{


			            	echo "<script> AlertdeErro.render('<h1>".$resposta."</h1>')</script>";


			            }
			            
			        }
		}	  

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarAtividadeExtraCurricular.php");
		 
?>