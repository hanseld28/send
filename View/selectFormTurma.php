<?php
    include_once("..\Controller\ControllerTurma.php");
    // Instancia a classe ControllerTipoUsuario
    $controller = new ControllerTurma();
    // Recebe o retorno do método listarTipoUsuario
    $lista = $controller->consultarTurma();
    
    // Inclui o select com os tipos de usuário na página
     echo "<label class='labelCadAux'>Turma</label>";
    echo "<br>";
    
    echo "<select class='select-regular' name='cod_turma' id='cod_turma'>";
    foreach ($lista as $obj) {
        echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";
    }

    echo "</select>";
?>