<?php

 include_once("../Controller/ItemCronogramaCRUD.php");
 include_once("verificaUsuarioLogado.php");   


            $id = $_POST['cod_item'];
            $nome = $_POST['nome_item'];
            $horarioitem = $_POST['horario_item'];
            
                $mandardados = new ItemCronogramaCRUD();
                $resultado = $mandardados->EditarItem($id, $nome, $horarioitem);

                if($resultado){
            echo "<script> Alert.render('<h1>Item editado com sucesso!</h1>')</script>";
              
        }else{
            
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o item...</h1>')</script>";  
        }

include_once("viewConsultarItensCronograma.php");
?>
