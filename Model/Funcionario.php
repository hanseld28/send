<?php
include_once("Pessoa.php");

/**
 * Description of Funcionario
 *
 * @author laris
 */
class Funcionario extends Pessoa{
    //Classe funcionario com seus atributos e métodos
    
    private $cpf;
    private $cargos;
    private $usuario;
    private $datacadastro;
    private $email;
    
    
    
    function getCargos() {
        return $this->cargos;
    }

    function getEmail() {
        return $this->email;
    }

    function setCargos($cargos) {
        $this->cargos = $cargos;
    }

        
    
    function getCpf() {
        return $this->cpf;
    }
    
    function getDatacadastro() {
        return $this->datacadastro;
    }
    
    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    
    function getUsuario() {
        return $this->usuario;
    }
    
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }
}
