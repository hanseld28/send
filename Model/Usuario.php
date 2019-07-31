<?php

class Usuario {
    private $id;
    private $nome;
    private $login;
    private $senha;
    public $tipoUsuario;
    private $dataCadastro;
//    private $status;

    public function addTipoUsuario($tipoUsuario){
        $this->tipoUsuario = $tipoUsuario;
    }

    function getId() {
        return $this->id;
    }
    function getNome() {
            return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }
}
