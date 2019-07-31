<?php


class Matricula {
	private $id;
	private $data;
	public $aluno;
	public $turma;
    private $datacadastro;
    private $numero;
    


	public function addAluno($objAluno){
        $this->aluno = $objAluno;
    }
	
	public function addTurma($objTurma){
        $this->turma = $objTurma;
    }  

    function getId(){
    	return $this->id;
    }
    
    function getDatacadastro(){
    	return $this->datacadastro;
    }

    function getData(){
    	return $this->data;
    }
    function getNumero(){
    	return $this->numero;
    }

    function setId($id){
    	$this->id = $id;
    }

    function setData($data){
    	$this->data = $data;
    }
    function setDatacadastro($datacadastro){
    	$this->datacadastro = $datacadastro;
    }
    function setNumero($numero){
    	$this->numero = $numero;
    }

}

?>
