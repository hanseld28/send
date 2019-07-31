<?php

include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerCaracteristicaSaude.php");
include_once("../Controller/ControllerProntuario.php");
                    
                    
     $codCaracteristica = $_POST['id'];

        
        $controller = new ControllerCaracteristicaSaude();
        $controller->ExcluirCaracteristicaAluno($codCaracteristica);

            
            
include_once("viewConsultarAluno.php");
            
            
        ?>





