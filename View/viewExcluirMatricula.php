<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerMatricula.php");

    $cod = $_POST['id'];
        
        $crud = new ControllerMatricula();
        $resultado = $crud->excluirMatricula($cod);

       if($resultado == "true"){
            echo "<script> Alert.render('<h1>Cargo excluído com sucesso!</h1>')</script>";
        }else if($resultado == "false"){
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir o cargo...</h1>')</script>";
        }else{

        	echo "<script> AlertdeErro.render('<h1>".$resultado."</h1>')</script>";

        }
            
            
include("viewConsultarMatricula.php");
            
            
        ?>





