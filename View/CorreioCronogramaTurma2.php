<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ItemCronogramaCRUD.php");


	try {
		
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["select"]) and isset($_POST["cod"])){
                //header("Location: viewConsultarTipoUsuario.php");
                
                $select = $_POST["select"];
                $cronograma = $_POST['cod'];
                
                
                $crud = new ItemCronogramaCRUD();
                $crud->EditarCronogramaTurma($cronograma, $select);

               //echo($select);
               //echo($caracteristica);
	        }	
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}

include_once("viewConsultarTurma.php");
?>