<?php

 include_once("../DAO/ContatoEmergenciaDAO.php");
 include_once("../Model/ContatoEmergencia.php");
 
 
/**
 * Description of CargoCRUD
 *
 * @author laris
 */
class ContatoEmergenciaCRUD {
     //Aqui estão todos os cruds do cargo
    
      public function cadastrarContatoEmergencia($nome, $telefone, $idaluno){
        
        $c = new ContatoEmergencia();
        $c->setNome($nome);
        $c->setTelefone($telefone);
        $c->setIdaluno($idaluno);
          
        $pdao = new ContatoEmergenciaDAO();
        return $pdao->cadastrarContatoEmergencia($c);
    
    }
    
      
    public function editarContatoEmergencia($id, $nome, $telefone, $idaluno){
        
        $c = new ContatoEmergencia();
        $c->setId($id);
        $c->setNome($nome);
        $c->setTelefone($telefone);
        $c->setIdaluno($idaluno);
        
        $pdao = new ContatoEmergenciaDAO();
        return $pdao->editarContatoEmergencia($c);
  
    }
    
       public function mostrarContatoEmergencia(){
        $pdao = new ContatoEmergenciaDAO();
        $var = array();
        return $var = $pdao->mostrarContatoEmergencia();
        
    }
    
     public function exluirContatoEmergencia($cod){
        $codigo = $cod;
        $pdao = new ContatoEmergenciaDAO();
        return $pdao->exluirContatoEmergencia($codigo);
    }
    
      public function consultarDadosEmergencia($cod){
        $resultado = array();
        $codigo = $cod;
        $pdao = new ContatoEmergenciaDAO();
        
        return $resultado[] = $pdao->consultarDadosEmergencia($codigo);
    }
    
    

        public function consultarDadosEmergenciaAluno($cod){
        $resultado = array();
        $codigo = $cod;
        $pdao = new ContatoEmergenciaDAO();
        
        return $resultado[] = $pdao->consultarDadosEmergenciaAluno($codigo);
    }
}
