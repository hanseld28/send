<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ItemCronogramaCRUD.php");
include_once("../Controller/CronogramaCRUD.php");

    $codturma = $_POST['cod'];
    $itemcronograma = $_POST['select'];


        $crud = new CronogramaCRUD();
        $codcronograma = $crud->pesquisarCronogramaTurma($codturma);


            $crud2 = new ItemCronogramaCRUD();
            $crud2->cadastrarCronogramaTurma($codcronograma, $itemcronograma);

include_once("viewConsultarTurma.php");
?>