<?php
include_once("..\DAO\DaoAlternativa.php");
include_once("..\Model\Alternativa.php");


class ControllerAlternativa {
    /*
    public function cadastrarAlternativa($descAlternativa){
        $novoAlternativa = new Alternativa();
        $novoAlternativa->setDescricao($descAlternativa);

        $daoAlternativa = new DaoAlternativa();
        // Envia o objeto 'novoAlternativa' para classe de acesso ao banco de dados
        $resultado = $daoAlternativa->cadastrarAlternativa($novoAlternativa);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    */
    public function consultarAlternativa(){
        $daoAlternativa = new DaoAlternativa();
        // Requere uma lista de 'alternativas' do objeto de acesso ao banco de dados
        $listaAlternativas = $daoAlternativa->consultarAlternativa();
        // Retorna uma lista de alternativa
        return $listaAlternativas;
    }
    /*
    public function editarAlternativa($codAlternativa, $descAlternativa){
        $Alternativa = new Alternativa();

        $Alternativa->setId($codAlternativa);
        $Alternativa->setDescricao($descAlternativa);
        
        $daoAlternativa = new DaoAlternativa();
        // Envia o objeto 'editarAlternativa' para classe de acesso ao banco de dados
        $resultado = $daoAlternativa->editarAlternativa($Alternativa);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirAlternativa($codAlternativa){
        $Alternativa = new Alternativa();

        $Alternativa->setId($codAlternativa);

        $daoAlternativa = new DaoAlternativa();
        // Envia o objeto 'excluirAlternativa' para classe de acesso ao banco de dados
        $resultado = $daoAlternativa->excluirAlternativa($Alternativa);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherAlternativa($codAlternativa){ // '&' representa uma Passagem por Referência
        $Alternativa = new Alternativa();

        $Alternativa->setId($codAlternativa);

        $daoAlternativa = new DaoAlternativa();
        
        $descAlternativa = $daoAlternativa->preencherAlternativa($Alternativa);

        return $descAlternativa;
    }
    */
}

?>