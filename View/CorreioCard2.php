 <?php

 include_once("../Controller/ControllerCard.php");
 include_once("verificaUsuarioLogado.php");   
    
            
            $id = $_POST['cod_card'];
            $nome = $_POST['nome_card'];

                $mandardados = new ControllerCard();
                $resultado = $mandardados->editarCard($id, $nome);
                
                 if($resultado){
            echo "<script> Alert.render('<h1>Categoria editada com sucesso!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar a categoria...</h1>')</script>";
        }

            
include_once("viewConsultarCard.php");
?>
