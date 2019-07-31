<?php

class CaracteristicaSaude {
    private $id;
    private $descricao;
    private $datacadastro;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }
    function getDatacadastro() {
        return $this->datacadastro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }


}

?>