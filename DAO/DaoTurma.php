<?php 
include_once("Conexao.php");
include_once("..\Model\Turma.php");
include_once("..\Model\GrauEscolar.php");

/**
 * Description of DaoTurma
 *
 * @author hansel
 */


class DaoTurma {
    
    public function cadastrarTurma($novaTurma){
       $pdo = Conexao::conexao();

       $nomeTurma = $novaTurma->getDescricao();
       $codGrauEscolar = $novaTurma->grauEscolar->getId();

       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbturma(nomeTurma, codGrauEscolar) "
               . "VALUES (:nomeTurma, :codGrauEscolar)");
       $cmd->bindValue(":nomeTurma", $nomeTurma, PDO::PARAM_STR);
       $cmd->bindValue(":codGrauEscolar", $codGrauEscolar, PDO::PARAM_INT);

       // Valida o cadastro
       $validar = $pdo->prepare("SELECT nomeTurma FROM tbturma WHERE nomeTurma = ?");
       $validar->execute(array($nomeTurma));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }

       Conexao::desconexao();
    }
    
    public function consultarTurma(){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

        //Paginação
       $i = 1;
       $listarturma_pg=$pdo->prepare("SELECT codTurma, nomeTurma, codGrauEscolar FROM tbturma");
       $listarturma_pg->execute();

       $count = $listarturma_pg->rowCount();
       $calculo = ceil(($count/5));
      

         $url = 0;
         $mody =0;
         if (isset($_GET['pageTurma']) == $i) {
         $url= $_GET['pageTurma'];
         $mody = ($url*5)-5;
         }
        //Paginação
             
      //Paginação
       $i = 1;
       $listarturma_pg=$pdo->prepare("SELECT codTurma, nomeTurma, codGrauEscolar FROM tbturma LIMIT 5 OFFSET {$mody}");
       $listarturma_pg->execute();

       $count = $listarturma_pg->rowCount();
       $calculo = ceil(($count/5));
      

         $url = 0;
         $mody =0;
         if (isset($_GET['pageTurma']) == $i) {
         $url= $_GET['pageTurma'];
         $mody = ($url*5)-5;
     }
        //Paginação
            
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codTurma, nomeTurma, descGrauEscolar FROM tbturma
                              INNER JOIN tbgrauescolar
                              ON tbturma.codGrauEscolar = tbgrauEscolar.codGrauEscolar LIMIT 5 OFFSET {$mody}");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as turmas
       $listaTurmas = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $grauEscolar = new GrauEscolar();
           $grauEscolar->setDescricao($linha['descGrauEscolar']);

           $turma = new Turma();
           $turma->setId($linha['codTurma']);
           $turma->setDescricao($linha['nomeTurma']);
           $turma->addGrauEscolar($grauEscolar);

           $listaTurmas->append($turma);
       }
       Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
       return $listaTurmas;
    }
    
    public function editarTurma($editarTurma){
        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
        
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbturma SET nomeTurma = :nomeTurma, codGrauEscolar = :codGrauEscolar 
                                  WHERE codTurma = :codTurma");

            // Substitui os valores
            $cmd->bindValue(":nomeTurma", $editarTurma->getDescricao(), PDO::PARAM_STR);
            $cmd->bindValue(":codGrauEscolar", $editarTurma->grauEscolar->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codTurma", $editarTurma->getId(), PDO::PARAM_INT); 
            

       // Valida o cadastro
       $validar = $pdo->prepare("SELECT nomeTurma FROM tbturma WHERE nomeTurma = :nome");
       $validar->bindValue(":nome", $editarTurma->getDescricao());
       $validar->execute();
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }    
    }catch(PDOException $e){
           echo $e->getMessage(); 
        } finally{
            Conexao::desconexao();
        }
    }
    
    public function excluirTurma($excluirTurma){
    try {

          $resposta = "";
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();


            $verifica = $pdo->prepare("select codMatricula from tbmatricula where codTurma = :codTurma");
            $verifica->bindValue(":codTurma", $excluirTurma->getId(), PDO::PARAM_INT);
            $verifica->execute();

            if($verifica->rowCount() > 0){
              $resposta = "Existem alunos mastriculados nesta turma";
              return $resposta;
            }else{
              $valida = $pdo->prepare("select codProfessorTurma from tbprofessorturma where codTurma = :codTurma");
            $valida->bindValue(":codTurma", $excluirTurma->getId(), PDO::PARAM_INT);
            $valida->execute();
 
              if($valida->rowCount() > 0){
                  $resposta = "Existe um professor para esta turma";
                  return $resposta;
              }else{

            $consulta=$pdo->prepare("select codCronograma from tbcronograma where codTurma = :cod");
            $consulta->bindValue(":cod", $excluirTurma->getId(), PDO::PARAM_INT);
            $consulta->execute();

            $codcronograma = $consulta->fetchColumn();

  $excluiritens=$pdo->prepare("DELETE FROM tbitensporcronograma WHERE codCronograma = :codigo");
  $excluiritens->bindValue(':codigo', $codcronograma);
  $excluiritens->execute();

            $excluircronograma = $pdo->prepare("delete from tbcronograma where codTurma = :cod");
            $excluircronograma->bindValue(":cod", $excluirTurma->getId(), PDO::PARAM_INT);
            $excluircronograma->execute();

            if($excluircronograma->rowCount() > 0){



            $cmd = $pdo->prepare("DELETE FROM tbturma WHERE codTurma = :codTurma");
            $cmd->bindValue(":codTurma", $excluirTurma->getId(), PDO::PARAM_INT);
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
              }
            }
            
            
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    }
    
    public function PesquisarUltimaTurma(){
        $pdo = Conexao::conexao();
        $cmd = $pdo->prepare("SELECT MAX(codTurma) FROM tbTurma");
        $cmd->execute();
        $linha = $cmd->fetchColumn();
        
        return $linha;
        
        Conexao::desconexao();
        
    }

    

    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherTurma($turma){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
           

           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT nomeTurma, codGrauEscolar FROM tbturma WHERE codTurma = :codTurma");
           $cmd->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_ASSOC);

                $turma->setDescricao($linha['nomeTurma']);
                $grauEscolar = new GrauEscolar();

                $grauEscolar->setId(intval($linha['codGrauEscolar']));

                $turma->addGrauEscolar($grauEscolar);

                return $turma;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }
    
    #################################################################
    ################## Relatórios da Turma ##########################
    #################################################################
    public function relatorioGeralTurma() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codTurma, nomeTurma, descGrauEscolar, dataCadastroTurma FROM tbturma
                              INNER JOIN tbgrauescolar
                              ON tbturma.codGrauEscolar = tbgrauEscolar.codGrauEscolar");
           
           // Cria uma lista para armazenar todos os Turmas
           $listaTurmas = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'Turmas' que é adicionado 
           // a uma lista de Turmas
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $turma = new Turma();
               $turma->setId($linha['codTurma']);
               $turma->setDescricao($linha['nomeTurma']);
               
               $grauEscolar = new GrauEscolar();
               $grauEscolar->setDescricao($linha['descGrauEscolar']);
               $turma->addGrauEscolar($grauEscolar);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroTurma']));
               $dataCadastroTurma = str_replace('-', '/', $aux);
               ################################################################
               $turma->setDataCadastro($dataCadastroTurma);

               $listaTurmas->append($turma);
           }
           // Retorna a lista completa com os Turmas
           return $listaTurmas;

       }
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
    
    public function relatorioEspecificoTurma(&$turma) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codTurma, nomeTurma, descGrauEscolar, dataCadastroTurma FROM tbturma
                              INNER JOIN tbgrauescolar
                              ON tbturma.codGrauEscolar = tbgrauEscolar.codGrauEscolar
                              WHERE codTurma = :codTurma");
           $cmd->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $turma->setId($linha['codTurma']);
               $turma->setDescricao($linha['nomeTurma']);
               
               $grauEscolar = new GrauEscolar();
               $grauEscolar->setDescricao($linha['descGrauEscolar']);
               $turma->addGrauEscolar($grauEscolar);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroTurma']));
               $dataCadastroTurma = str_replace('-', '/', $aux);
               ################################################################
               $turma->setDataCadastro($dataCadastroTurma);
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