<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ProfessorTurmaCRUD.php");

    $prof = $_POST['professor'];
    $turma = $_POST['turma'];
    $cod = $_POST['codigo'];


        $crud2 = new ProfessorTurmaCRUD();
        $resposta = $crud2->editarProfessorTurma($turma, $prof, $cod);

        if($resposta){
            echo "<script> Alert.render('<h1> Sala editado com sucesso!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar a sala...</h1>')</script>";
        }

include_once("viewConsultarProfessorTurma.php");

?>