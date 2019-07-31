<?php
    $codigo = (isset($_POST['cod'])) ? intval($_POST['cod']) : null;

    include_once("verificaUsuarioLogado.php");
    //Includes do Aluno
    include_once("../Controller/AlunoCRUD.php");
    include_once("../Model/Aluno.php");

    include_once("../Controller/ControllerMatricula.php");
    include_once("../Model/Matricula.php");

    include_once("../Controller/ControllerTurma.php");
    include_once("../Model/Turma.php");

    include_once("../Controller/ControllerPeriodo.php");
    include_once("../Model/Periodo.php");

  
    $aluno = new Aluno();
    $crudaluno = new AlunoCRUD();
    $resultado = array();
    
    $resultado = $crudaluno->ConsultaAluno($codigo);
    $aluno = $resultado;
?>
              Dados do Aluno
               Nome:
               <?php foreach($aluno as $alunos){ echo( $alunos->getNome());} ?>
               <br>
               RG:
               <?php foreach($aluno as $alunos){echo( $alunos->getRg());}?>
               <br>
            
               Data de Nascimento:
               <?php foreach($aluno as $alunos){echo( $alunos->getDataNascimento());} ?>
               <br>
               <br>
               Dados da Matrícula
               <br>
               
                <?php

                    $controllerMatricula = new ControllerMatricula();
                    $matricula = $controllerMatricula->preencherMatriculaPorAluno(intval($codigo));

                    $data = $matricula->getData();
                    $turma = $matricula->turma->getId();
                    $periodo = $matricula->periodo->getId();
                    $turm = new Turma();
                    $crudturma = new ControllerTurma();
                    $descTurma = $crudturma->preencherTurma($turma);

                    $peri = new Periodo();
                    $crudperiodo = new ControllerPeriodo();
                    $resultadoperiodo = $crudperiodo->preencherPeriodo($periodo);
                    
                    echo("Data da Matricula: ");
                    echo($data);
                    echo("<br>");
                    echo("Turma: ");
                    echo($descTurma);
                    echo("<br>");
                    echo("Período: ");
                    echo($resultadoperiodo->getDescricao());

                ?>   


