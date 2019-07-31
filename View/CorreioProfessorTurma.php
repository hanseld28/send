<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ProfessorTurmaCRUD.php");


    $prof = $_POST['professor'];
    $turma = $_POST['turma'];


        $crud2 = new ProfessorTurmaCRUD();
        $resposta = $crud2->cadastrarProfessorTurma($turma, $prof);

        if($resposta){
            echo "<script> Alert.render('<h1> Sala cadastrada com sucesso!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar a sala...</h1>')</script>";
        }

include_once("viewConsultarProfessorTurma.php");

?>