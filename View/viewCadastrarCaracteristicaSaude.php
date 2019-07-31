<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCaracteristicaSaude.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Valida cadastro do Tipo Usuário
        try {
            if(isset($_POST["nome"])):    
                //header("Location: ..\index.php");

                $descCaracteristica = trim($_POST["nome"]);            
    	        

                $controller = new ControllerCaracteristicaSaude();

                $resposta = $controller->cadastrarCaracteristicaSaude($descCaracteristica);

                if($resposta):
                    //header("Location: pageCadastroPeriodo.php");
                    echo "<script> Alert.render('<h1>Caracteristica cadastrada!</h1>')</script>";
                else:
                     echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar...</h1>')</script>";
                endif;

            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include("viewConsultarCaracteristicaSaude.php");
?>
