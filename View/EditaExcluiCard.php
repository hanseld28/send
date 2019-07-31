 <?php 

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCard.php");

    $cod = $_POST['id'];
        
        $crud = new ControllerCard();
        $resultado = $crud->excluirCard($cod);

         if($resultado == "true"){
            echo "<script> Alert.render('<h1>Categoria excluída com sucesso!</h1>')</script>";
        }else if($resultado == "false"){
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir a categoria...</h1>')</script>";
        }else{

        	echo "<script> AlertdeErro.render('<h1>".$resultado."</h1>')</script>";

        }
            
            
include("viewConsultarCard.php");
            
            
        ?>





