<?php
include_once("Conexao.php");
include_once("../Model/Alternativa.php");

/**
 * Description of DaoAlternativa
 *
 * @author hansel
 */

class DaoAlternativa {
    /*
    public function cadastrarAlternativa($novaAlternativa){
       
       $pdo = Conexao::conexao();

       $descAlternativa = $novaAlternativa->getDescricao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbAlternativa(descAlternativa) "
               . "VALUES (:descAlternativa)");
       $cmd->bindValue(":descAlternativa", $descAlternativa, PDO::PARAM_STR);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descAlternativa FROM tbAlternativa WHERE descAlternativa = ?");
       $validar->execute(array($descAlternativa));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    */
    public function consultarAlternativa(){
       $pdo = Conexao::conexao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codAlternativa, descAlternativa FROM tbalternativa");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as Alternativas 
       $listaAlternativas = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'Alternativa' que é adicionado 
       // a uma lista de Alternativas
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $alternativa = new Alternativa();

           $alternativa->setId($linha['codAlternativa']);
           $alternativa->setDescricao($linha['descAlternativa']);
           
           $listaAlternativas->append($alternativa);
       }

       Conexao::desconexao();
       // Retorna a lista completa com as Alternativas
       return $listaAlternativas;
    }
    /*
    public function editarAlternativa($editarAlternativa){ 
        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbAlternativa "
                    . "SET descAlternativa = :descAlternativa "
                    . "WHERE codAlternativa = :codAlternativa");
            // Substitui os valores
            $cmd->bindValue(":descAlternativa", $editarAlternativa->getDescricao());
            $cmd->bindValue(":codAlternativa", $editarAlternativa->getId()); 
            $cmd->execute();

            if($cmd->rowCount() > 0): 
              return true;  
            else: 
              return false; 
            endif;
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();    
        }    
    }
    
    public function excluirAlternativa($Alternativa){
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

            $cmd = $pdo->prepare("DELETE FROM tbAlternativa WHERE codAlternativa = :codAlternativa");
            $cmd->bindValue(":codAlternativa", $Alternativa->getId();, PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    }
    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherAlternativa(&$Alternativa){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           // Busca o código da caracteristica de saude no banco de dados
           $cmd = $pdo->prepare("SELECT descAlternativa FROM tbAlternativa WHERE codAlternativa = :codAlternativa");
           $cmd->bindValue(":codAlternativa", $Alternativa->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $Alternativa->setDescricao($linha->descAlternativa);
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

    public function buscaUltimaAlternativaCadastrada(){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           // Busca o código da caracteristica de saude no banco de dados
           $cmd = $pdo->prepare("SELECT MAX(codAlternativa) FROM tbAlternativa"); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $codAlternativa = $linha->codAlternativa;

                return $codAlternativa;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

    */
}