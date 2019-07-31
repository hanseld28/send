<?php 
include_once("../Controller/ControllerPeriodo.php");

	try {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			    	if(isset($_POST['id'])){
			        	$codPeriodo = intval($_POST['id']); 

			            $controllerPeriodo = new ControllerPeriodo();

			            $resposta = $controllerPeriodo->excluirPeriodo($codPeriodo);

			    		//var_dump($resposta);        
			            if($resposta == "true"){
			            	//header("Location: pageCadastroPeriodo.php");
			            	echo "<script> Alert.render('<h1>Período excluído com sucesso!</h1>')</script>";
			            }else if($resposta == "false"){
			            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar excluir o período...</h1>')</script>";
			            }else{
			            	echo "<script> AlertdeErro.render('<h1>".$resposta."</h1>')</script>";

			            }
			            
			        }
		}	  

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarPeriodo.php");
		 
?>