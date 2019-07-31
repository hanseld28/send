<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerTipoUsuario.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Valida cadastro do Tipo Usuário
        try {
            if(isset($_POST["nome_usuario"])):    
                

                $descTipoUsuario = $_POST["nome_usuario"];            
    				            
                $controllerTipoUsuario = new ControllerTipoUsuario();

                $resposta = $controllerTipoUsuario->cadastrarTipoUsuario($descTipoUsuario);

                if($resposta):
                    //header("Location: pageCadastroTipoUsuario.php");
                    echo "<script> Alert.render('<h1>Tipo de usuário cadastrado!</h1>')</script>";
                else:
                    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o Tipo de Usuário...</h1>')</script>";
                endif;


            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include("viewConsultarTipoUsuario.php");
?>
