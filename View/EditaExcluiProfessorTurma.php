   <?php 
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ProfessorTurmaCRUD.php");  
                    
                    $cod = $_POST['cod'];

                        $crud = new ProfessorTurmaCRUD();
                        $resposta = $crud->excluirProfessorTurma($cod);

            if($resposta){
            echo "<script> Alert.render('<h1> Sala excluída com sucesso!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir a sala...</h1>')</script>";
        }

include_once("viewConsultarProfessorTurma.php");

?>