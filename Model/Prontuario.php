<?php

class Prontuario {
    private $id;
    public $aluno;
    private $tiposanguineo;
    private $deficiencia;
    private $problemasaude;
    private $doencacontagiosa;
    private $tratamentocirurgico;
    private $alergia;
    private $acompanhamentomedico;
    private $medicacao;
    private $datacadastro;
    
    public function addAluno($aluno) {
        $this->aluno = $aluno;
    }

    function getId() {
        return $this->id;
    }

     function getTiposanguineo() {
        return $this->tiposanguineo;
    }
     function getDeficiencia() {
        return $this->deficiencia;
    }
     function getProblemasaude() {
        return $this->problemasaude;
    }
     function getDoencacontagiosa() {
        return $this->doencacontagiosa;
    }
     function getTratamentocirurgico() {
        return $this->tratamentocirurgico;
    }
     function getAlergia() {
        return $this->alergia;
    }
     function getAcompanhamentomedico() {
        return $this->acompanhamentomedico;
    }
     function getMedicacao() {
        return $this->medicacao;
    }

    function getDatacadastro() {
        return $this->datacadastro;
    }
    function setTiposanguineo($tiposanguineo) {
        $this->tiposanguineo = $tiposanguineo;
    }
    function setDeficiencia($deficiencia) {
        $this->deficiencia = $deficiencia;
    }
    function setProblemasaude($problemasaude) {
        $this->problemasaude = $problemasaude;
    }
    function setDoencacontagiosa($doencacontagiosa) {
        $this->doencacontagiosa = $doencacontagiosa;
    }
    function setTratamentocirurgico($tratamentocirurgico) {
        $this->tratamentocirurgico = $tratamentocirurgico;
    }
    function setAlergia($alergia) {
        $this->alergia = $alergia;
    }
    function setAcompanhamentomedico($acompanhamentomedico) {
        $this->acompanhamentomedico = $acompanhamentomedico;
    }
    function setMedicacao($medicacao) {
        $this->medicacao = $medicacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }




}

?>