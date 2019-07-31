<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerTipoUsuario.php");


	try {
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_usuario"])){
                //header("Location: viewConsultarTipoUsuario.php");

                $descTipoUsuario = trim($_POST["nome_usuario"]); 

                $codTipoUsuario = $_POST['cod_usuario'];

       			$controllerTipoUsuario = new ControllerTipoUsuario();

                $resposta = $controllerTipoUsuario->editarTipoUsuario($codTipoUsuario, $descTipoUsuario);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>Tipo de usuário editado com sucesso!</h1>')</script>";
	            }else{
	            		echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar editar Tipo Usuário</h1>')</script>";
	           	}
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarTipoUsuario.php");
?>