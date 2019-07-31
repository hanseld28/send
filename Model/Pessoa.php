<?php


/**
 * Description of Pessoa
 *
 * @author laris
 */
class Pessoa {
    //classe pessoa onde aluno e funcionario herdam
    
    private $codigo;
    private $nome;
    private $rg;  
    private $logradouro;
    private $complemento;
    private $numcasa;
    private $cep;
    private $cidade;
    
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function getRg() {
        return $this->rg;
    }
    
    function getLogradouro() {
        return $this->logradouro;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getNumcasa() {
        return $this->numcasa;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }
    

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setNumcasa($numcasa) {
        $this->numcasa = $numcasa;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
}
