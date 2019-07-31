<?php

include_once("Conexao.php");
include_once("../Model/Matricula.php");
include_once("../Model/Aluno.php");
include_once("../Model/Turma.php");
include_once("../Model/Periodo.php");

/**
 * Description of DaoMatricula
 *
 * @author hansel
 */

class DaoMatricula {
    
    public function cadastrarMatricula($novaMatricula) { 
 
       $pdo = Conexao::conexao();
 
       $codAluno = $novaMatricula->aluno->getCodigo();
       $codTurma = $novaMatricula->turma->getId();
       $numMatricula = $novaMatricula->getNumero();
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbmatricula(dataMatricula, numMatricula, codAluno, codTurma) "
               . "VALUES (:dataMatricula, :numMatricula, :codAluno, :codTurma)");

       $cmd->bindValue(":dataMatricula", $novaMatricula->getData(), PDO::PARAM_STR);
       $cmd->bindValue(":numMatricula", $novaMatricula->getNumero(), PDO::PARAM_STR);
       $cmd->bindValue(":codAluno", $codAluno, PDO::PARAM_INT);
       $cmd->bindValue(":codTurma", $codTurma, PDO::PARAM_INT);

       // Valida o cadastro
       $validar = $pdo->prepare("SELECT codAluno, numMatricula, codTurma FROM tbmatricula WHERE codAluno = :codAluno and codTurma = :codTurma and numMatricula = :numero");

       $validar->bindValue(":codAluno", $codAluno, PDO::PARAM_INT);
       $validar->bindValue(":codTurma", $codTurma, PDO::PARAM_INT);
       $validar->bindValue(":numero", $numMatricula, PDO::PARAM_INT);
       
        
       $validar->execute();
       
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }

       Conexao::desconexao();
    }
    
    public function consultarMatricula(){
       
       $pdo = Conexao::conexao();
        
    //Paginação
      $i = 1;

       $listarmatricula_pg=$pdo->prepare("SELECT codMatricula, dataMatricula, numMatricula, codAluno, codTurma FROM tbmatricula");
       $listarmatricula_pg->execute();

       $count = $listarmatricula_pg->rowCount();
       $calculo = ceil(($count/8));
      
         $url = 0;
         $mody =0;
         if (isset($_GET['pageMatricula']) == $i) {
         $url= $_GET['pageMatricula'];
         $mody = ($url*8)-8;
     }
        //Paginação


       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codMatricula, dataMatricula, numMatricula, nomeAluno, nomeTurma FROM tbmatricula
                                INNER JOIN tbaluno
                                  ON tbmatricula.codAluno = tbaluno.codAluno
                                    INNER JOIN tbturma
                                      ON tbmatricula.codTurma = tbturma.codTurma LIMIT 8 OFFSET {$mody}");
       
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as turmas
       $listaMatriculas = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $matricula = new Matricula();
           $matricula->setId($linha['codMatricula']);
           $matricula->setData($linha['dataMatricula']);
           $matricula->setNumero($linha['numMatricula']);

           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $matricula->addAluno($aluno);

           $turma = new Turma();
           $turma->setDescricao($linha['nomeTurma']);
           $matricula->addTurma($turma);

           $listaMatriculas->append($matricula);
       }
       
       Conexao::desconexao();
       // Retorna a lista completa com as matriculas
       return $listaMatriculas;
    }
      
    public function editarMatricula(&$editarMatricula){

        try{
            
            
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
     
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbmatricula SET dataMatricula = :dataMatricula,
                                    numMatricula = :numero, 
                                          codTurma = :codTurma  
                                              WHERE codMatricula = :codMatricula");

            // Substitui os valores
            $cmd->bindValue(":dataMatricula", $editarMatricula->getData(), PDO::PARAM_STR);
            $cmd->bindValue(":numero", $editarMatricula->getNumero(), PDO::PARAM_STR);
            $cmd->bindValue(":codTurma", $editarMatricula->turma->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codMatricula", $editarMatricula->getId(), PDO::PARAM_INT);
            $cmd->execute();
       
       if($cmd->rowCount() > 0){
           // Executa o Cadastro
           return true; 
       }else{
           return false;
       }
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();    
        }    

    }
    
    public function excluirMatricula($excluirMatricula){
         $resposta = "";
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
            
            $consulta = $pdo->prepare("SELECT codAluno from tbmatricula WHERE codMatricula = :codMatricula");
            $consulta->bindValue(":codMatricula", $excluirMatricula->getId(), PDO::PARAM_INT);
            $consulta->execute();
            
            if($consulta->rowCount() > 0){
                $resposta = "Existe um aluno cadastrado com esta matrícula";
                return $resposta;
            }else{
                
            $cmd = $pdo->prepare("DELETE FROM tbmatricula WHERE codMatricula = :codMatricula");
            $cmd->bindValue(":codMatricula", $excluirMatricula->getId(), PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1){
                $resposta = "true";
                return $resposta;
            }
            else{
              $resposta = "false";
              return $resposta;   
            } 
                
            }
            
         
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    
    }
    
      public function ultimaMatricula(){
        
        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT MAX(codMatricula) FROM tbmatricula");
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        return $linha;
    }


    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherMatricula(&$matricula){ // '&' representa uma Passagem por Referência
        
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
            
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codMatricula, dataMatricula, numMatricula, codAluno, codTurma FROM tbmatricula
                                   WHERE codMatricula = :codMatricula");

           $cmd->bindValue(":codMatricula", $matricula->getId(), PDO::PARAM_INT); 
           
           if($cmd->execute()){
              $linha = $cmd->fetch(PDO::FETCH_ASSOC);

              $matricula->setId(intval($linha['codMatricula']));
              $matricula->setNumero($linha['numMatricula']);
              $matricula->setData($linha['dataMatricula']);

              $aluno = new Aluno();
              $aluno->setCodigo(intval($linha['codAluno']));
              $matricula->addAluno($aluno);

              $turma = new Turma();
              $turma->setId(intval($linha['codTurma']));
              $matricula->addTurma($turma);

           }

       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

    public function preencherMatriculaPorAluno(&$matricula) { // '&' representa uma Passagem por Referência

       try {
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
            
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codMatricula, dataMatricula, numMatricula, codAluno, codTurma FROM tbmatricula
                                   WHERE codAluno = :codAluno");

           $cmd->bindValue(":codAluno", $matricula->aluno->getCodigo(), PDO::PARAM_INT); 
           
           if ($cmd->execute())
           {
              $linha = $cmd->fetch(PDO::FETCH_ASSOC);

              $matricula->setId(intval($linha['codMatricula']));
              $matricula->setNumero($linha['numMatricula']);
              $matricula->setData($linha['dataMatricula']);

              $turma = new Turma();
              $turma->setId(intval($linha['codTurma']));
              $matricula->addTurma($turma);

              
           }

       } 
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 
       finally 
       {
           Conexao::desconexao();
       }
    }
    
  #################################################################
    ################## Relatórios da Matricula ######################
    #################################################################

    public function relatorioGeralMatricula() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codMatricula, dataMatricula, numMatricula, nomeAluno, nomeTurma, dataCadastroMatricula FROM tbmatricula
                                INNER JOIN tbaluno
                                  ON tbmatricula.codAluno = tbaluno.codAluno
                                    INNER JOIN tbturma
                                      ON tbmatricula.codTurma = tbturma.codTurma");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $matricula = new Matricula();
               $matricula->setId($linha['codMatricula']);
               $matricula->setNumero($linha['numMatricula']);
               $matricula->setData($linha['dataMatricula']);
               
           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $matricula->addAluno($aluno);

           $turma = new Turma();
           $turma->setDescricao($linha['nomeTurma']);
           $matricula->addTurma($turma);

           

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroMatricula']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $matricula->setDatacadastro($dataCadastro);

               $lista->append($matricula);
           }
           // Retorna a lista completa com os periodos
           return $lista;

       }
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
    
    public function relatorioEspecificoMatricula(&$matricula) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codMatricula, dataMatricula, numMatricula, nomeAluno, nomeTurma, dataCadastroMatricula FROM tbmatricula 
                              INNER JOIN tbaluno
                                  ON tbmatricula.codAluno = tbaluno.codAluno
                                    INNER JOIN tbturma
                                      ON tbmatricula.codTurma = tbturma.codTurma
                              WHERE codMatricula = :cod");
           $cmd->bindValue(":cod", $matricula->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               
               $matricula->setId($linha['codMatricula']);
               $matricula->setNumero($linha['numMatricula']);
               $matricula->setData($linha['dataMatricula']);
               
           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $matricula->addAluno($aluno);

           $turma = new Turma();
           $turma->setDescricao($linha['nomeTurma']);
           $matricula->addTurma($turma);

           
               
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroMatricula']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $matricula->setDatacadastro($dataCadastro);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
    
    
}

?>