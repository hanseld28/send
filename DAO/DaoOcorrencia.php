<?php
include_once("Conexao.php");
include_once("../Model/Ocorrencia.php");

/**
 * Description of DaoOcorrencia
 *
 * @author hansel
 */

class DaoOcorrencia {
    
    public function cadastrarOcorrencia($novaOcorrencia){
       
       $pdo = Conexao::conexao();

       $descOcorrencia = $novaOcorrencia->getDescricao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbocorrencia(descOcorrencia) "
               . "VALUES (:descOcorrencia)");
       $cmd->bindValue(":descOcorrencia", $descOcorrencia, PDO::PARAM_STR);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descOcorrencia FROM tbocorrencia WHERE descOcorrencia = ?");
       $validar->execute(array($descOcorrencia));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    
    public function consultarOcorrencia(){
       $pdo = Conexao::conexao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codOcorrencia, descOcorrencia FROM tbocorrencia");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as ocorrencias 
       $listaOcorrencias = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'Ocorrencia' que é adicionado 
       // a uma lista de ocorrencias
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $ocorrencia = new Ocorrencia();

           $ocorrencia->setId($linha['codOcorrencia']);
           $ocorrencia->setDescricao($linha['descOcorrencia']);
           
           $listaOcorrencias->append($ocorrencia);
       }

       Conexao::desconexao();
       // Retorna a lista completa com as ocorrencias
       return $listaOcorrencias;
    }
    
    public function editarOcorrencia($editarOcorrencia){ 
        
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try{
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbocorrencia "
                    . "SET descOcorrencia = :descOcorrencia "
                    . "WHERE codOcorrencia = :codOcorrencia");
            // Substitui os valores
            $cmd->bindValue(":descOcorrencia", $editarOcorrencia->getDescricao());
            $cmd->bindValue(":codOcorrencia", $editarOcorrencia->getId()); 
            $cmd->execute();

            if($cmd->rowCount() > 0): 
              return true;  
            else: 
              return false; 
            endif;
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        Conexao::desconexao();    
           
    }
    
    public function excluirOcorrencia($ocorrencia){
        
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try {    
            $cmd = $pdo->prepare("DELETE FROM tbocorrencia WHERE codOcorrencia = :codOcorrencia");
            $cmd->bindValue(":codOcorrencia", $ocorrencia->getId(), PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
 
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        
        Conexao::desconexao();
    }

    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherOcorrencia(&$ocorrencia){ // '&' representa uma Passagem por Referência
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();
           
       try{
           // Busca o código da caracteristica de saude no banco de dados
           $cmd = $pdo->prepare("SELECT descOcorrencia FROM tbocorrencia WHERE codOcorrencia = :codOcorrencia");
           $cmd->bindValue(":codOcorrencia", $ocorrencia->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $ocorrencia->setDescricao($linha->descOcorrencia);
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       }
       
       Conexao::desconexao();
       
    }

    public function buscaUltimaOcorrenciaCadastrada(){ // '&' representa uma Passagem por Referência
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try{
           // Busca o código da caracteristica de saude no banco de dados
           $cmd = $pdo->prepare("SELECT MAX(codOcorrencia) FROM tbocorrencia"); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $codOcorrencia = $linha->codOcorrencia;

                return $codOcorrencia;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       }
       
       Conexao::desconexao();
    }


}