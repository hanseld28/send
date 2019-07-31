<?php


/**
 * Description of ItemCronograma
 *
 * @author laris
 */
class ItemCronograma {
    //atributos e metodos dos itens do cronograma
    
    private $codigo;
    private $nome;
    private $horario;
    private $datacadastro;

    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }
    function getHorario(){
        return $this->horario;
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
    function setHorario($horario){
        $this->horario = $horario;
    }
    function setDatacadastro($datacadastro){
        $this->datacadastro = $datacadastro;
    }
    
    
}
