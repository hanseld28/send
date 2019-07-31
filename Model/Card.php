<?php

class Card {
    private $id;
    private $descricao;
    public $alternativa; 
    private $dataCadastro;

    public function addAlternativa($objAlternativa) {
        $this->alternativa = $objAlternativa;
    }

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }


}
