<?php
include_once("Conexao.php");
include_once("..\Model\Agenda.php");
include_once("..\Model\Aluno.php");

/**
 * Description of DaoAgenda
 *
 * @author hansel
 */


class DaoAgenda {
    
    public function cadastrarAgenda($novaAgenda){
       $pdo = Conexao::conexao();

       $codAluno = $novaAgenda->aluno->getCodigo();

       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbagenda(codAluno) "
               . "VALUES (:codAluno)");
       $cmd->bindValue(":codAluno", $codAluno, PDO::PARAM_INT);

       // Valida o cadastro
       $validar = $pdo->prepare("SELECT codAluno FROM tbagenda WHERE codAluno = ?");
       $validar->execute(array($codAluno));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }

       Conexao::desconexao();
    }
    
    public function consultarAgenda(){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codAgenda, nomeAluno FROM tbagenda
                              INNER JOIN tbaluno
                              ON tbagenda.codAluno = tbaluno.codAluno");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as Agendas
       $listaAgendas = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'Aluno' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);

           $agenda = new Agenda();
           $agenda->setId($linha['codAgenda']);
           $agenda->addAluno($aluno);

           $listaAgendas->append($agenda);
       }
       Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
       return $listaAgendas;
    }
    
    public function editarAgenda($editarAgenda){
        
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try{      
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbagenda SET codAluno = :codAluno 
                                  WHERE codAgenda = :codAgenda");

            // Substitui os valores
            $cmd->bindValue(":codAluno", $editarAgenda->aluno->getCodigo(), PDO::PARAM_INT);
            $cmd->bindValue(":codAgenda", $editarAgenda->getId(), PDO::PARAM_INT); 
            
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
    
    public function excluirAgenda($excluirAgenda){
        
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try {
            
            $cmd = $pdo->prepare("DELETE FROM tbagenda WHERE codAgenda = :codAgenda");
            $cmd->bindValue(":codAgenda", $excluirAgenda->getId(), PDO::PARAM_INT);
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
    public function preencherAgenda(&$agenda){ // '&' representa uma Passagem por Referência
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try{
           $cmd = $pdo->prepare("SELECT codAluno FROM tbagenda WHERE codAgenda = :codAgenda");

           $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT); 

           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $aluno = new Aluno();
                $aluno->setCodigo($linha->codAluno);

                $agenda->addAluno($aluno);
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } 
       
       Conexao::desconexao();
       
    }


    public function pesquisarAgendaAluno($aluno){ 
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try{
           $cmd = $pdo->prepare("SELECT codAgenda FROM tbagenda WHERE codAluno = :codAluno");

           $cmd->bindValue(":codAluno", $aluno->getCodigo(), PDO::PARAM_INT); 

           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_COLUMN);

                $agenda = new Agenda();
                $agenda->setId(intval($linha));

                return $agenda;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } 
       
       Conexao::desconexao();
       
    }
    

}

?>