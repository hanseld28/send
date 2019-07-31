<?php

/**
 * Description of Aluno
 *
 * @author laris
 */
class Aluno{
    
    //atributos e métodos do aluno
    private $codigo;
    private $nome;
    private $datanascimento;
    private $nacionalidade;
    private $sexo;
    private $cor;
    private $rg;
    private $certidao;
    private $logradouro;
    private $numcasa;
    private $complemento;
    private $cep;
    private $bairro;
    private $cidade;
    private $responsavel;
    private $foto;
    private $datacadastro;
    
   
    function getSexo() {
        return $this->sexo;
    }
    function getCor() {
        return $this->cor;
    }
    function getCertidao() {
        return $this->certidao;
    }
    function getBairro() {
        return $this->bairro;
    }
    function getFoto() {
        return $this->foto;
    }
    function getNacionalidade() {
        return $this->nacionalidade;
    }
    function getDatanascimento() {
        return $this->datanascimento;
    }
    
      function getResponsavel() {
        return $this->responsavel;
    }
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
    
    function getDatacadastro() {
        return $this->datacadastro;
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
    
     function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }
    
    
    function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }

    
    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }
    
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }
    
     function setSexo($sexo) {
        $this->sexo = $sexo;
    }
    function setCor($cor) {
        $this->cor = $cor;
    }
    function setCertidao($certidao) {
        $this->certidao = $certidao;
    }
    function setBairro($bairro) {
        $this->bairro = $bairro;
    }
    function setFoto($foto) {
        $this->foto = $foto;
    }
    
}
