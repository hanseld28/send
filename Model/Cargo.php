<?php



/**
 * Description of Cargo
 *
 * @author laris
 */
class Cargo {
    //Classe cargo com seus atributos e métodos
    
      
    private $codigo;
    private $nome;
    private $datacadastro;
    
    
     function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
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
    
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }
    
    
}
