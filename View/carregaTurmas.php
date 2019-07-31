<?php
    include_once("..\Controller\ControllerTurma.php");
    // Instancia a classe ControllerTurma
    $controllerTurma = new ControllerTurma();
    // Recebe o retorno do método listarTurma
    $listaTurmas = $controllerTurma->consultarTurma();

    echo "<select name='selectTurma'>";     
    foreach ($listaTurmas as $obj) {
      echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";   
    }
    echo "</select>";
?>