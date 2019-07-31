<?php
    include_once("..\Controller\ControllerPeriodo.php");
    // Instancia a classe ControllerTipoUsuario
    $controller = new ControllerPeriodo();
    // Recebe o retorno do método listarTipoUsuario
    $lista = $controller->consultarPeriodo();
    
    // Inclui o select com os tipos de usuário na página
    echo "<p>Período</p>";
    
    echo "<select name='periodo' id='periodo'>";
    foreach ($lista as $obj) {
        echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
    }

    echo "</select>";
?>