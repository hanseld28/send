<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerUsuario.php");

	try {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_usuario"]) and isset($_POST["login_usuario"]) and isset($_POST["senha_usuario"]) and isset($_POST["tipo_usuario"])){
             	//header("Location: viewConsultarUsuario.php");

				$codUsuario = intval($_POST['cod_usuario']);
                $nomeUsuario = trim($_POST["nome_usuario"]);
                $loginUsuario = trim($_POST["login_usuario"]);
                $senhaUsuario = trim($_POST["senha_usuario"]);            
    			$codTipoUsuario = intval($_POST["tipo_usuario"]);

       			$controllerUsuario = new ControllerUsuario();

                $resposta = $controllerUsuario->editarUsuario($codUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario, $codTipoUsuario);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>Usuário editado com sucesso!</h1>')</script>";
	            }else{
	            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o Usuário...</h1>')</script>";
	           	}
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}	

include_once("viewConsultarUsuario.php");
?>