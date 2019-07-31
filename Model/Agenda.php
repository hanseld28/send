<?php

class Agenda {
    private $id;
    public $aluno;


    public function addAluno($objAluno) {
        $this->aluno = $objAluno;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }


}
