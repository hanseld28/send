<?php
    include_once("Conexao.php");
    include_once("../Model/ContatoEmergencia.php");
    

/**
 * Description of CargoDAO
 *
 * @author laris
 */
class ContatoEmergenciaDAO {
    //DAO do cargo
    
     public function cadastrarContatoEmergencia($obj){
        
        $contato = new ContatoEmergencia();
        $contato = $obj;
        
        $nome = $contato->getNome();
        $telefone = $contato->getTelefone();
        $aluno = $contato->getIdaluno();
        
        
        $db = Conexao::conexao();
        
        $inseredados=$db->prepare("INSERT INTO tbcontatoemergenciaaluno (nomeContatoEmergenciaAluno, telefoneContatoEmergencia, codAluno) VALUES (:nome, :telefone, :codaluno)");
        $inseredados->bindValue(':nome', $nome, PDO::PARAM_STR);
        $inseredados->bindValue(':telefone', $telefone, PDO::PARAM_STR);
        $inseredados->bindValue(':codaluno', $aluno, PDO::PARAM_INT);
         
       // Valida o cadastro
       $validar = $db->prepare("SELECT nomeContatoEmergenciaAluno, telefoneContatoEmergencia, codAluno FROM tbcontatoemergenciaaluno WHERE nomeContatoEmergenciaAluno = :nome AND telefoneContatoEmergencia = :telefone AND codAluno = :aluno");
       $validar->bindValue(":nome", $nome, PDO::PARAM_STR);
       $validar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
       $validar->bindValue(":aluno", $aluno, PDO::PARAM_STR);
       $validar->execute();
       
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $inseredados->execute();
           return true;
       }else{
           return false;
       }
        
        $db = Conexao::desconexao();
        
    }
    
    public function mostrarContatoEmergencia(){
        
        $db = Conexao::conexao();
        
        $listar=$db->prepare("SELECT codContatoEmergenciaAluno, nomeContatoEmergenciaAluno, telefoneContatoEmergencia FROM tbcontatoemergenciaaluno");
        $listar->execute();
        
        $lista = array();
        
        $linha=$listar->fetchAll(PDO::FETCH_OBJ);
        
        foreach($linha as $list){
            
            $contato = new ContatoEmergencia();
            $contato->setId($list->codContatoEmergenciaAluno);
            $contato->setNome($list->nomeContatoEmergenciaAluno);
            $contato->setTelefone($list->telefoneContatoEmergencia);
            
            
            $lista[] = $contato;
            
        }
        
        Conexao::desconexao();
        return $lista;
        
    }
    
    public function exluirContatoEmergencia($cod){
        
        
        $db = Conexao::conexao();
        $excluir=$db->prepare("DELETE FROM tbcontatoemergenciaaluno WHERE codContatoEmergenciaAluno = :codigo");
        $excluir->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $excluir->execute();

        Conexao::desconexao();
        
        if($excluir->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
        
        
    }
    
    public function consultarDadosEmergencia($cod){
        
        
        $db = Conexao::conexao();
        $consultar=$db->prepare("SELECT codContatoEmergenciaAluno, nomeContatoEmergenciaAluno, telefoneContatoEmergencia FROM tbcontatoemergenciaaluno WHERE codContatoEmergenciaAluno = :codigo");
        $consultar->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $consultar->execute();
        
        $lista = array();
        
        $linha = $consultar->fetchAll(PDO::FETCH_OBJ);
        foreach ($linha as $listar){
             $contato = new ContatoEmergencia();
             $contato->setNome($listar->nomeContatoEmergenciaAluno);
             $contato->setId($listar->codContatoEmergenciaAluno);
             $contato->setTelefone($listar->telefoneContatoEmergencia);
             
             $lista[] = $contado;
        }
        Conexao::desconexao();
        return $lista;
        
    } 

        public function consultarDadosEmergenciaAluno($cod){
        
        
        $db = Conexao::conexao();
        $consultar=$db->prepare("SELECT codContatoEmergenciaAluno, nomeContatoEmergenciaAluno, telefoneContatoEmergencia FROM tbcontatoemergenciaaluno WHERE codAluno = :codigo");
        $consultar->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $consultar->execute();
        
        $lista = array();
        
        $linha = $consultar->fetchAll(PDO::FETCH_OBJ);
        foreach ($linha as $listar){
             $contato = new ContatoEmergencia();
             $contato->setNome($listar->nomeContatoEmergenciaAluno);
             $contato->setId($listar->codContatoEmergenciaAluno);
             $contato->setTelefone($listar->telefoneContatoEmergencia);
             
             $lista[] = $contato;
        }
        Conexao::desconexao();
        return $lista;
        
    }
    
    public function editarContatoEmergencia($obj){
        $db = Conexao::conexao();
        
        $c = new ContatoEmergencia();
        
        $c = $obj;
        
        $id = $c->getId();
        $nome = $c->getNome();
        $telefone = $c->getTelefone();
        
        $editardados=$db->prepare("UPDATE tbcontatoemergenciaaluno SET nomeContatoEmergenciaAluno = :nome, telefoneContatoEmergencia = :telefone WHERE codContatoEmergenciaAluno = :codigo");
        $editardados->bindValue(':nome', $nome);
        $editardados->bindValue(':codigo', $id);
        $editardados->bindValue(':telefone', $telefone);
        $editardados->execute();
       
       if($editardados->rowCount() > 0){
           // Executa o Cadastro
           return true;
       }else{
           return false;
       }
        
        Conexao::desconexao();
        
    }
    
}
