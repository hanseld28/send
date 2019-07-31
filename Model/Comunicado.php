<?php 
	
class Comunicado {
	private $id;
	private $descricao;
	private $assunto;
	private $dataCadastro;
	public $turma;
	public $usuario;
	public $agendas;


	public function Comunicado()
	{
		$this->agendas = new ArrayObject();
	}

	public function addTurma($objTurma) 
	{
		$this->turma = $objTurma;
	}

	public function addUsuario($objUsuario) 
	{
		$this->usuario = $objUsuario;
	}

	public function addAgenda($objAgenda)
	{
		$this->agendas->append($objAgenda);
	}

	function getId(){
        return $this->id;
    }

    function getAssunto(){
        return $this->assunto;
    }

    function getDescricao(){
        return $this->descricao;
    }

    function getDataCadastro(){
        return $this->dataCadastro;
    }

    function setId($id){
        $this->id = $id;
    }

    function setAssunto($assunto){
        $this->assunto = $assunto;
    }

    function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    function setDataCadastro($dataCadastro){
        $this->dataCadastro = $dataCadastro;
    }
} 
?>