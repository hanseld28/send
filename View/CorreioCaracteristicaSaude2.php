<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ControllerCaracteristicaSaude.php");


	try {
		
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["desc"]) and isset($_POST["cod"])){
                //header("Location: viewConsultarTipoUsuario.php");

                $desc = trim($_POST["desc"]); 
                $cod = $_POST['cod'];

       			$controller = new ControllerCaracteristicaSaude();

                $resposta = $controller->editarCaracteristicaSaude($cod, $desc);
                
                if($resposta){
	            	echo "<script> Alert.render('<h1>Característica de saúde editada com sucesso!</h1>')</script>";
	            }else{
	            	echo "Ocorreu um erro ao tentar editar caracterítica de saúde...";
	           	}
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarCaracteristicaSaude.php");
?>