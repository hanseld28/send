<?php
include_once("../Controller/ControllerTipoUsuario.php");

	try {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			    	if(isset($_POST['id'])){
			        	$codTipoUsuario = intval($_POST['id']); 

			            $controllerTipoUsuario = new ControllerTipoUsuario();

			            $resposta = $controllerTipoUsuario->excluirTipoUsuario($codTipoUsuario);

			    		//var_dump($resposta);        
			            if($resposta){
			            	//header("Location: pageCadastroTipoUsuario.php");
			            	
			            	 echo "<script> Alert.render('<h1>Tipo de usuário excluído com sucesso!</h1>')</script>";
			            }else{
			            	echo "<script> Alert.render('<h1>Ocorreu um erro ao tentar excluir o tipo de usuário...</h1>')</script>";
			            }
			            
			        }
		}	  

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarTipoUsuario.php");
		 
?>