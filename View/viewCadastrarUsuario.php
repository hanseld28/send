<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerUsuario.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Valida cadastro do Turma
        try {
            if(isset($_POST["nome_usuario"]) and isset($_POST["login_usuario"]) and isset($_POST["senha_usuario"]) and isset($_POST["tipo_usuario"])):    

                $nomeUsuario = trim($_POST["nome_usuario"]);
                $loginUsuario = trim($_POST["login_usuario"]);
                $senhaUsuario = trim($_POST["senha_usuario"]);            
    			$codTipoUsuario = intval($_POST["tipo_usuario"]);

                $controllerUsuario = new ControllerUsuario();
                $resposta = $controllerUsuario->cadastrarUsuario($nomeUsuario, $loginUsuario, $senhaUsuario, $codTipoUsuario);

                if($resposta):
                    //header("Location: pageCadastroUsuario.php");
                   echo "<script> Alert.render('<h1>Usuário cadastrado!</h1>')</script>";
                else:
                   echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o usuário...</h1>')</script>";
                endif;


            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }
include_once("viewConsultarUsuario.php");
?>
