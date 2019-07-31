<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCaracteristicaSaude.php");
include_once("../Controller/ControllerProntuario.php");
include_once("../Controller/AlunoCRUD.php");

    $codaluno = $_POST['cod'];
    $caracteristica = $_POST['select'];


        $crud = new ControllerProntuario();
        $codprontuario = $crud->pesquisarProntuarioAluno($codaluno);
        
        echo($codprontuario);
    
            $crud2 = new ControllerCaracteristicaSaude();
            $crud2->cadastrarCaracteristicaPorAluno($codprontuario, $caracteristica);

include_once("viewConsultarAluno.php");
?>