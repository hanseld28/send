<?php
include_once("Conexao.php");
include_once("../Model/FichaDeclaracaoSaude.php");
include_once("../Model/CaracteristicaSaude.php");

/**
 * Description of DaoFichaDeclaracaoSaude
 *
 * @author hansel
 */

class DaoFichaDeclaracaoSaude {
    
    public function cadastrarFichaDeclaracaoSaude($novaFichaDeclaracaoSaude){
       
       $pdo = Conexao::conexao();

       $descFichaDeclaracaoSaude = $novaFichaDeclaracaoSaude->getDescricao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbfichadeclaracaosaude(descFichaDeclaracaoSaude, codCaracteristicaSaude) "
               . "VALUES (:descFichaDeclaracaoSaude, :codCaracteristicaSaude)");
       $cmd->bindValue(":descFichaDeclaracaoSaude", $descFichaDeclaracaoSaude, PDO::PARAM_STR);
       $cmd->bindValue(":codCaracteristicaSaude", $novaFichaDeclaracaoSaude->caracteristicaSaude->getId(), PDO::PARAM_INT);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descFichaDeclaracaoSaude FROM tbfichadeclaracaosaude WHERE descFichaDeclaracaoSaude = ?");
       $validar->execute(array($descFichaDeclaracaoSaude));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    
    public function consultarFichaDeclaracaoSaude(){
       $pdo = Conexao::conexao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codFichaDeclaracaoSaude, descFichaDeclaracaoSaude, descCaracteristicaSaude 
                              FROM tbfichadeclaracaosaude
                              INNER JOIN tbcaracteristicasaude
                              ON tbfichadeclaracaosaude.codCaracteristicaSaude = tbcaracteristicasaude.codCaracteristicaSaude");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as fichas de declaracao de saude
       $listaFichasDeclaracaoSaude = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'FichaDeclaracaoSaude' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $caracteristicaSaude = new  CaracteristicaSaude();
           $caracteristicaSaude->setDescricao($linha['descCaracteristicaSaude']);
           
           $fichaDeclaracaoSaude = new FichaDeclaracaoSaude();
           $fichaDeclaracaoSaude->setId($linha['codFichaDeclaracaoSaude']);
           $fichaDeclaracaoSaude->setDescricao($linha['descFichaDeclaracaoSaude']);
           $fichaDeclaracaoSaude->addCaracteristicaSaude($caracteristicaSaude);
           
           $listaFichasDeclaracaoSaude->append($fichaDeclaracaoSaude);
       }

       Conexao::desconexao();
       // Retorna a lista completa com as fichas de declaracao de saude
       return $listaFichasDeclaracaoSaude;
    }
    
    public function editarFichaDeclaracaoSaude($editarFichaDeclaracaoSaude){ 
        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbfichadeclaracaosaude "
                    . "SET descFichaDeclaracaoSaude = :descFichaDeclaracaoSaude, " 
                    . "codCaracteristicaSaude = :codCaracteristicaSaude "
                    . "WHERE codFichaDeclaracaoSaude = :codFichaDeclaracaoSaude");
            // Substitui os valores
            $cmd->bindValue(":descFichaDeclaracaoSaude", $editarFichaDeclaracaoSaude->getDescricao(), PDO::PARAM_STR);
            $cmd->bindValue(":codCaracteristicaSaude", $editarFichaDeclaracaoSaude->caracteristicaSaude->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codFichaDeclaracaoSaude", $editarFichaDeclaracaoSaude->getId(), PDO::PARAM_INT); 
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
    
    public function excluirFichaDeclaracaoSaude($fichaDeclaracaoSaude){
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
  
            $cmd = $pdo->prepare("DELETE FROM tbfichadeclaracaosaude WHERE codFichaDeclaracaoSaude = :codFichaDeclaracaoSaude");
            $cmd->bindValue(":codFichaDeclaracaoSaude", $fichaDeclaracaoSaude->getId(), PDO::PARAM_INT);
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
    public function preencherFichaDeclaracaoSaude(&$fichaDeclaracaoSaude){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           // Busca pelo código da ficha de declaracao de saude a 'descricao' e a 'caracteristica de saude' no banco de dados
           $cmd = $pdo->prepare("SELECT descFichaDeclaracaoSaude, descCaracteristicaSaude FROM tbfichadeclaracaosaude 
                                  INNER JOIN tbcaracteristicasaude
                                  ON tbfichadeclaracaosaude.codCaracteristicaSaude = tbcaracteristicasaude.codCaracteristicaSaude
                                    WHERE codFichaDeclaracaoSaude = :codFichaDeclaracaoSaude");

           $cmd->bindValue(":codFichaDeclaracaoSaude", $fichaDeclaracaoSaude->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $caracteristicaSaude = new CaracteristicaSaude();
                $caracteristicaSaude->setDescricao($linha->descCaracteristicaSaude);

                $fichaDeclaracaoSaude->setDescricao($linha->descFichaDeclaracaoSaude);
                $fichaDeclaracaoSaude->addCaracteristicaSaude($caracteristicaSaude);
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

   
}