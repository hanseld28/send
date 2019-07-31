<?php

class ContatoEmergencia {
    private $id;
    private $nome;
    private $telefone;
    private $idaluno;
    private $datacadastro;
    
    function getId() {
        return $this->id;
    }
    
    function getNome() {
        return $this->nome;
    }
    
    function getTelefone() {
        return $this->telefone;
    }
    function getIdaluno() {
        return $this->idaluno;
    }
    function getDatacadastro() {
        return $this->datacadastro;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }
    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
    }
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }
    
    
    
}



?>