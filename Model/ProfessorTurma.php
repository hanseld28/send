<?php

class ProfessorTurma{
    private $codigoprofessorturma;
    private $codigoturma;
    private $codigoprofessor;
    private $nometurma;
    private $nomeprofessor;
    private $datacadastro;
    
    
    function getCodigoturma() {
        return $this->codigoturma;
    }
    
    function setCodigoturma($codigoturma) {
        $this->codigoturma = $codigoturma;
    }
    
    function getCodigoprofessor(){
        return $this->codigoprofessor;
    }
    function getDatacadastro(){
        return $this->datacadastro;
    }
    function setCodigoprofessor($codigoprofessor){
        $this->codigoprofessor = $codigoprofessor;
    }
    function getCodigoprofessorturma(){
        return $this->codigoprofessorturma;
    }
    function setCodigoprofessorturma($codigoprofessorturma){
        $this->codigoprofessorturma = $codigoprofessorturma;
    }
    
    function getNometurma(){
        return $this->nometurma;
    }
    function setNometurma($nometurma){
        $this->nometurma = $nometurma;
    }
    function getNomeprofessor(){
        return $this->nomeprofessor;
    }
    function setNomeprofessor($nomeprofessor){
        $this->nomeprofessor = $nomeprofessor;
    }
    function setDatacadastro($datacadastro){
        $this->datacadastro = $datacadastro;
    }
    
    
    
}

?>