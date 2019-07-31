<?php

class Turma {
    private $id;
    private $descricao;
    public $grauEscolar;
    private $dataCadastro;

    public function addGrauEscolar($objGrauEscolar){
        $this->grauEscolar = $objGrauEscolar;
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

?>