<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Model/Aluno.php");

    session_start();
    $codUsuario = $_SESSION['codUsuario'];
    
    $alunos = new Aluno();

    $consulta = new ControllerUsuario();
     
    $listaCriancas = $consulta->consultarFilhosResponsavel($codUsuario);    

    ?>
       
    <?php
        foreach($listaCriancas as $crianca){
            //$date = $aluno->getDatanascimento();
            //$aux = str_replace('-', '/', $date);
            //$dataNascAluno = date('d-m-Y', strtotime($aux));
            echo($crianca->getNome()."<a href='viewConsultarRotinaCriancaResponsavel.php?nomeAluno={$crianca->getNome()}'>Visualizar Agenda</a>");
            
            echo("<br/>");
        }

    ?>
