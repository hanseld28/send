 <?php 

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ResponsavelCRUD.php");

    $codigo = $_POST['id'];

        $crud = new ResponsavelCRUD();
        $resultado = $crud->VerificaResponsavel($codigo);


if($resultado > 0){
    echo "<script> AlertdeErro.render('<h1>Existe um aluno cadastrado com este responsável...</h1>')</script>";

                    }else {
                            $crud2 = new ResponsavelCRUD();
                            $resposta = $crud2->ExcluirResponsavel($codigo);
                                if($resposta){
                                    echo "<script> Alert.render('<h1>Responsável excluído com sucesso!</h1>')</script>";
                                }else{
                                    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao excluir o responsável...</h1>')</script>";
                                }
                            
                    }

include_once("viewConsultarResponsavel.php");

?>