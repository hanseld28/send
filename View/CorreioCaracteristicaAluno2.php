<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ControllerCaracteristicaSaude.php");


	try {
		
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["select"]) and isset($_POST["prontuario"])){
                //header("Location: viewConsultarTipoUsuario.php");
                
                $select = $_POST["select"];
                $prontuario = $_POST['prontuario'];
                
                
                $crud = new ControllerCaracteristicaSaude();
                $crud->EditarCaracteristicaAluno($prontuario, $select);

               //echo($select);
               //echo($caracteristica);
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarAluno.php");
?>