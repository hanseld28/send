<?php

    include_once("verificaUsuarioLogado.php");
    //Includes do Aluno
    include_once("../Controller/AlunoCRUD.php");

            
                    $cod = $_POST['id'];
                    
                    //Header("Location: painelAdm.php");
                    
                    $crud = new AlunoCRUD();
                    $resultado = $crud->ExcluirAluno($cod); 
                    if($resultado){
                      echo "<script> Alert.render('<h1>Aluno excluído com sucesso!</h1>')</script>";
                    }else {
                        echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir o aluno...</h1>')</script>"; 
                    }
                
                
                    include("viewConsultarAluno.php");
        
        
    

?>