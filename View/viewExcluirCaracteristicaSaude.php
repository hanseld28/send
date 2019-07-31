<?php
include_once("../Controller/ControllerCaracteristicaSaude.php");

	try {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			    	if(isset($_POST['id'])){
			        	$cod = intval($_POST['id']); 

			            $controller = new ControllerCaracteristicaSaude();

			            $resposta = $controller->excluirCaracteristicaSaude($cod);

			    		//var_dump($resposta);        
			            if($resposta){
			            	//header("Location: pageCadastroPeriodo.php");
			                echo "<script> Alert.render('<h1>Característica de saúde excluída com sucesso!</h1>')</script>";
			            }else{
			            	 echo "<script> AlertErro.render('<h1>Ocorreu um erro ao tentar excluir a característica de saúde...</h1>')</script>";
			            }
			            
			        }
			    
			
		}	  

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarCaracteristicaSaude.php");
		 
?>