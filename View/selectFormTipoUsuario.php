<?php
    include_once("..\Controller\ControllerTipoUsuario.php");
    // Instancia a classe ControllerTipoUsuario
    $controllerTipoUsuario = new ControllerTipoUsuario();
    // Recebe o retorno do método listarTipoUsuario
    $listaTiposUsuario = $controllerTipoUsuario->consultarTipoUsuario();
    
    // Inclui o select com os tipos de usuário na página

    echo "<div class='mesmalinha'>";
    echo "<p class='pPersonalizado'>Selecione o Tipo do Usuário</p>";
    
    echo "<div class='selectMenor'>";
    echo "<select class='select-regular' name='tipoUsuario' id='tipoUsuario'>";     
    foreach ($listaTiposUsuario as $obj) {
      echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";   
    }
    echo "</select>";
    echo "</div>";
    echo "</div>";

?>