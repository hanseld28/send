<?php
    
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ItemCronogramaCRUD.php");
    
    $cod = $_POST['id'];
        
        $crud = new ItemCronogramaCRUD();
        $resultado = $crud->ExcluirItensCronograma($cod);

        if($resultado == "true"){
            echo "<script> Alert.render('<h1>Item excluído com sucesso!</h1>')</script>";
              
        }else if($resultado == "false"){
            
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir o item...</h1>')</script>";  
        }else{

        	echo "<script> AlertdeErro.render('<h1>".$resultado."</h1>')</script>";

        }
include_once("viewConsultarItensCronograma.php");
?>
                    
                
            
            
        

