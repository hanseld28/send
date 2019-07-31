<?php
	include_once("verificaUsuarioLogado.php");
	include_once("..\Controller\ControllerGrauEscolar.php");

	

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["nome_grau"]) && isset($_POST['periodo_grau'])){
                //header("Location: viewConsultarTipoUsuario.php");
                
                $descGrauEscolar = trim($_POST["nome_grau"]); 
                $codGrauEscolar = $_POST['cod_grau'];
                $periodo = $_POST['periodo_grau'];
                
       			$controllerGrauEscolar = new ControllerGrauEscolar();

                $resposta = $controllerGrauEscolar->editarGrauEscolar($codGrauEscolar, $descGrauEscolar, $periodo);
                
               if($resposta){
	            	echo "<script> Alert.render('<h1>Grau escolar editado com sucesso!</h1>')</script>";
	            }else{
	            	"<script> AlertdeErro.render('<h1>Grau já Existe...</h1>')</script>";
	           	}
	        }	
		}

        include_once("viewConsultarGrauEscolar.php");


?>