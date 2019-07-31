<?php
    include_once("..\Controller\ControllerCaracteristicaSaude.php");
    // Instancia a classe ControllerTipoUsuario
    $controller = new ControllerCaracteristicaSaude();
    // Recebe o retorno do método listarTipoUsuario
    $lista = $controller->consultarCaracteristicaSaude();
    
    // Inclui o select com os tipos de usuário na página
    
    
    echo "<select name='caracteristica' id='caracteristica'>";
    foreach ($lista as $obj) {
        echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
    }

    echo "</select>";
?>