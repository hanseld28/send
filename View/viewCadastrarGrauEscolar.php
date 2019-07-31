<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerGrauEscolar.php");

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Valida cadastro do Tipo Usuário
        try {
            if(isset($_POST["nome_grau"]) && isset($_POST["periodo_grau"])):    
                //header("Location: ..\index.php");

                $descGrauEscolar = $_POST["nome_grau"];
                $periodo = $_POST["periodo_grau"];
           
               $controllerGrauEscolar = new ControllerGrauEscolar();

                $resposta = $controllerGrauEscolar->cadastrarGrauEscolar($descGrauEscolar, $periodo);
                if($resposta):
                    //header("Location: pageCadastroGrauEscolar.php");
                 echo "<script> Alert.render('<h1>Grau Escolar cadastrado!</h1>')</script>";
                    
                else:
                    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o Grau Escolar...</h1>')</script>";
                endif;

            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include_once("viewConsultarGrauEscolar.php");
?>

