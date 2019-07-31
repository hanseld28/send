<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/FuncionarioCRUD.php");
                    
    $cod = $_POST['id'];
        
        $crud = new FuncionarioCRUD();
        $resultado = $crud->ExcluirFuncionario($cod);

        if($resultado == "true"){
                        echo "<script> Alert.render('<h1>Funcionário excluído com sucesso!</h1>')</script>";
                    }else if($resultado == "false"){
                        echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir o Funcionário...</h1>')</script>";
                    }else{
            echo "<script> AlertdeErro.render('<h1>".$resultado."</h1>')</script>";
        }
 
include_once("viewConsultarFuncionario.php");
?>       
                    
                
            
            
        

