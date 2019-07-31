<?php
    include_once("../Controller/ControllerCard.php");
    include_once("../Controller/ControllerAlternativa.php");
    // Instancia a classe ControllerCard
    $controllerCard = new ControllerCard();
    // Instancia a classe ControllerAlternativa
    $controllerAlternativa = new ControllerAlternativa();

    // Recebe o retorno do método consultarCard
    $listaCards = $controllerCard->consultarCard();
    // Recebe o retorno do método consultarCard
    $listaAlternativas = $controllerAlternativa->consultarAlternativa();

    
    foreach ($listaCards as $obj) {
        echo "<input type='checkbox' name='cards[]' value='{$obj->getId()}'><b>{$obj->getDescricao()}</b><br/>";

        foreach ($listaAlternativas as $alternativa) {
            echo "<input type='radio' name='altCard[][{$obj->getId()}]' value='{$alternativa->getId()}'>{$alternativa->getDescricao()}<br/>";
        }
    }
    

?>