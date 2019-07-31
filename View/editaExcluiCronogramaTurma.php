<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ItemCronogramaCRUD.php");
include_once("../Controller/CronogramaCRUD.php");

                    
    $coditem = $_POST['id'];

        $controller = new ItemCronogramaCRUD();
        $controller->ExcluirCronogramaTurma($coditem);

include_once("viewConsultarTurma.php");  
?>





