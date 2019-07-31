<?php

class Rotina {
    private $id;
    private $descricao;
    private $horarioEnvio;
    private $dataCadastro;
    public $aluno;
    public $turma;
    public $professor;
    public $cards;
    public $ocorrencias;
    public $agendas;
    public $qtdOcorrencias;
    public $qtdAlternativas;
    

    public function Rotina() {
        $this->cards = new ArrayObject();
        $this->ocorrencias = new ArrayObject();
        $this->agendas = new ArrayObject();
        $this->qtdAlternativas = array();
    }

    public function addAgenda($objAgenda){
        $this->agendas[] = $objAgenda;
    }

    public function addAluno($objAluno){
        $this->aluno = $objAluno;
    }

    public function addTurma($objTurma){
        $this->turma = $objTurma;
    }
    
    public function addProfessor($objUsuario){
        $this->professor = $objUsuario;
    }

    public function addCard($objCard){
        $this->cards[] = $objCard;
    }

    public function addOcorrencia($objOcorrencia){
        $this->ocorrencias[] = $objOcorrencia;
    }

    public function addQuantidadeOcorrencia($qtdOcorrencia){
        $this->qtdOcorrencias = $qtdOcorrencia;
    }

    public function addQuantidadeAlternativa($alt, $qtdAlternativa){
        $this->qtdAlternativas[$alt] = $qtdAlternativa;
    }

    function getId(){
        return $this->id;
    }

    function getDescricao(){
        return $this->descricao;
    }

    function getHorarioEnvio(){
        return $this->horarioEnvio;
    }

    function getDataCadastro(){
        return $this->dataCadastro;
    }

    function setId($id){
        $this->id = $id;
    }

    function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    function setHorarioEnvio($horarioEnvio){
        $this->horarioEnvio = $horarioEnvio;
    }

    function setDataCadastro($dataCadastro){
        $this->dataCadastro = $dataCadastro;
    }
}

?>