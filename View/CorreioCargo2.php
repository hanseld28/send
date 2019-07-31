<?php

 include_once("../Controller/CargoCRUD.php");
 include_once("verificaUsuarioLogado.php");   
    
            
            $id = $_POST['cod_cargo'];
            $nome = $_POST['nome_cargo'];

                $mandardados = new CargoCRUD();
                $resultado = $mandardados->EditarCargo($id, $nome);
                
                 if($resultado){
            echo "<script> Alert.render('<h1>Cargo editado com sucesso!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o Cargo...</h1>')</script>";
        }

            
include_once("viewConsultarCargoFuncionario.php");
?>
