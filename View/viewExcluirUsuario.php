<?php
include_once("../Controller/ControllerUsuario.php");
	try {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

		 

			     

   	if(isset($_POST['id'])){
			        	$codUsuario = intval($_POST['id']); 

			            $controllerUsuario = new ControllerUsuario();

			            $resposta = $controllerUsuario->excluirUsuario($codUsuario);

			    		//var_dump($resposta);        
			            if($resposta == "true"){
			            	//header("Location: pageCadastroUsuario.php");
			            	
			            	 echo "<script> Alert.render('<h1>Usuário excluído com sucesso!</h1>')</script>";
			            }else if($resposta == "false"){
			            	 echo "<script> Alert.render('<h1>Houve um erro ao tentar excluir o usuário...</h1>')</script>";
			            
			        }else{

			        	echo "<script> AlertdeErro.render('<h1> ".$resposta."</h1>')</script>";


			        }
			    
			
		}

	} }catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarUsuario.php");
		 
?>