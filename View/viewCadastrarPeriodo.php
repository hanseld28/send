<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerPeriodo.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Valida cadastro do Tipo Usuário
        try {
            if(isset($_POST["nome_periodo"]) and isset($_POST["horario_periodo"])):    
                //header("Location: ..\index.php");

                $descPeriodo = trim($_POST["nome_periodo"]);            
    	        $horarioPeriodo = trim($_POST["horario_periodo"]);

                $controllerPeriodo = new ControllerPeriodo();

                $resposta = $controllerPeriodo->cadastrarPeriodo($descPeriodo, $horarioPeriodo);

                if($resposta):
                    //header("Location: pageCadastroPeriodo.php");
                    echo "<script> Alert.render('<h1>Periodo cadastrado!</h1>')</script>";
                else:
                    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o Periodo...</h1>')</script>";
                endif;

            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include_once("viewConsultarPeriodo.php");
?>
