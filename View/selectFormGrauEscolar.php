<?php
    include_once("..\Controller\ControllerGrauEscolar.php");
    // Instancia a classe ControllerTipoUsuario
    $controllerGrauEscolar = new ControllerGrauEscolar();
    // Recebe o retorno do método listarTipoUsuario
    $listaGrausEscolares = $controllerGrauEscolar->consultarGrauEscolar2();
    
    // Inclui o select com os tipos de usuário na página
    echo "<label class='labelCadAux'>Grau Escolar</label>";
    echo "<br>";
    
    echo "<select class='select-regular' name='grauTurma' id='grauTurma'>";
    foreach ($listaGrausEscolares as $obj) {
        echo "<option value='{$obj->getId()}'>{$obj->getDescricao()} - {$obj->periodo->getDescricao()}</option>";
    }

    echo "</select>";
?>