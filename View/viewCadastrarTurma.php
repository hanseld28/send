<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerTurma.php");
include_once("../Controller/CronogramaCRUD.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Valida cadastro do Turma
        try {
            if(isset($_POST["nome_turma"]) and isset($_POST["grau_turma"])):    
                //header("Location: ..\index.php");
                $nomeTurma = $_POST["nome_turma"];            
    			$codGrauEscolar = intval($_POST["grau_turma"]);

                $controllerTurma = new ControllerTurma();

                $resposta = $controllerTurma->cadastrarTurma($nomeTurma, $codGrauEscolar);

                if($resposta):
                    //header("Location: pageCadastroTurma.php");
                    echo "<script> Alert.render('<h1>Turma cadastrada com sucesso!</h1>')</script>";
                     $resposta2 = $controllerTurma->PesquisarUltimaTurma();
                     $controllercronograma = new CronogramaCRUD();
                     $controllercronograma->CadastrarCronograma($resposta2);

                else:
                echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar a turma...</h1>')</script>";
                endif;
            
               
               


            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include_once("viewConsultarTurma.php");
?>
