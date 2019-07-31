<?php

include_once("Conexao.php");
include_once("../Model/ProfessorTurma.php");


class ProfessorTurmaDAO{
    
    public function cadastrarProfessorTurma($obj){
        
        $professorturma = new ProfessorTurma();
        $professorturma = $obj;
        
        $db = Conexao::conexao();
        
        $inseredados=$db->prepare("INSERT INTO tbprofessorturma (codTurma, codUsuario) VALUES (:codturma, :codprof)");
        $inseredados->bindValue(':codturma', $obj->getCodigoturma());
        $inseredados->bindValue(':codprof', $obj->getCodigoprofessor());
        
        // Valida o cadastro
       $validar = $db->prepare("SELECT codTurma, codUsuario FROM tbprofessorturma WHERE codTurma = :codturma and codUsuario = :codprof");

       $validar->bindValue(":codturma", $obj->getCodigoturma(), PDO::PARAM_INT);
       $validar->bindValue(":codprof", $obj->getCodigoprofessor(), PDO::PARAM_INT);
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
    
    public function mostrarProfessorTurma(){
        
        $db = Conexao::conexao();

      //PAGINAÇÃO//
       $i = 1;
       $listarprofturma_pg=$db->prepare("SELECT codprofessorTurma, codTurma, codUsuario FROM tbprofessorturma");
       $listarprofturma_pg->execute();

       $count = $listarprofturma_pg->rowCount();
       $calculo = ceil(($count/5)*5);

        while ($i <= $calculo) {
                $i++;
            }

         $url = 0;
         $mody =0;
         if (isset($_GET['pageProfTurma']) == $i) {
         $url= $_GET['pageProfTurma'];
         $mody = ($url*5)-5;
                                              }
      //PAGINAÇÃO//
        
        $listar=$db->prepare("SELECT codprofessorTurma, nomeTurma, nomeUsuario FROM tbprofessorturma
                                    INNER JOIN tbTurma ON tbprofessorturma.codTurma = tbturma.codTurma
                                        INNER JOIN tbusuario ON tbprofessorturma.codUsuario = tbusuario.codUsuario LIMIT 5 OFFSET {$mody}");
        $listar->execute();
        
        $listacompleta = array();
        
        $linha=$listar->fetchAll(PDO::FETCH_OBJ);
        
        foreach($linha as $listagem){
            
            $profturma = new ProfessorTurma();
            $profturma->setCodigoprofessorturma($listagem->codprofessorTurma);
            $profturma->setNomeprofessor($listagem->nomeUsuario);
            $profturma->setNometurma($listagem->nomeTurma);
            
            
            $listacompleta[] = $profturma;
            
        }
        
        Conexao::desconexao();
        return $listacompleta;
        
    }
    
    public function exluirProfessorTurma($codprofturma){
        
        $db = Conexao::conexao();
        $excluirprofturma=$db->prepare("DELETE FROM tbprofessorTurma WHERE codProfessorTurma = :codigo");
        $excluirprofturma->bindValue(':codigo', $codprofturma, PDO::PARAM_INT);
        $excluirprofturma->execute();
        
        if($excluirprofturma->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
        
        Conexao::desconexao();
        
        
    }
    
     public function consultarProfessorTurma($cod){
        
        $db = Conexao::conexao();
        $consultar=$db->prepare("SELECT codProfessorTurma, codTurma, codUsuario FROM tbprofessorturma WHERE codProfessorTurma = :codigo");
        $consultar->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $consultar->execute();
        
        $lista = array();
        
        $linha = $consultar->fetchAll(PDO::FETCH_OBJ);
        foreach ($linha as $listar){
             $profturma = new ProfessorTurma();
             $profturma->setCodigoturma($listar->codTurma);
             $profturma->setCodigoprofessor($listar->codUsuario);
             
             $lista[] = $profturma;
        }
        Conexao::desconexao();
        return $lista;
        
    }
    
    
    
    public function editarProfessorTurma($obj){
        $db = Conexao::conexao();
        
        $pt = new ProfessorTurma();
        
        $pt = $obj;

        $editardados=$db->prepare("UPDATE tbprofessorturma SET codTurma= :codturma, codUsuario= :codprof WHERE codProfessorTurma = :codigoprofessorturma");
        $editardados->bindValue(':codturma', $pt->getCodigoturma());
        $editardados->bindValue(':codprof', $pt->getCodigoprofessor());
        $editardados->bindValue(':codigoprofessorturma', $pt->getCodigoprofessorturma());
        $editardados->execute();
       
       if($editardados->rowCount() > 0){
           
           return true;
       }else{
           return false;
       }
        
        Conexao::desconexao();
        
    }
    
    public function consultarTurmasProfessor($obj){
        
        $db = Conexao::conexao();
        
        $pt = new ProfessorTurma();
        
        $pt = $obj;
        
        $consulta=$db->prepare("SELECT codTurma, codProfessorTurma FROM tbprofessorturma WHERE codUsuario = :coduser");
        $consulta->bindValue(':coduser', $pt->getCodigoprofessor());
        $consulta->execute();
        
        $listacompleta = array();
        
        $linha=$consulta->fetchAll(PDO::FETCH_OBJ);
        
        foreach($linha as $listagem){
            
            $pt2 = new ProfessorTurma();
            $pt2->setCodigoprofessorturma($listagem->codProfessorTurma);
            $pt2->setCodigoturma($listagem->codTurma);
            
            
            $listacompleta[] = $pt2;
            
        }
        
        Conexao::desconexao();
        return $listacompleta;
        
        
        
    }
    
        public function consultarNomeTurma($obj){
        $db = Conexao::conexao();
        $pt = new ProfessorTurma();
        $pt = $obj; 
            
        $consulta=$db->prepare("SELECT nomeTurma FROM tbturma WHERE codTurma = :cod");
        $consulta->bindValue(':cod', $pt->getCodigoturma());
        $consulta->execute();
            
        $linha = $consulta->fetchColumn();
            
        Conexao::desconexao();
        
        return $linha;
            
        }
    
        public function consultarAlunosTurma($obj){
            $db = Conexao::conexao();
            $pt = new ProfessorTurma();
            $pt = $obj; 
            
                $consulta=$db->prepare("SELECT codAluno FROM tbmatricula 
                                            WHERE codTurma = :cod");
                $consulta->bindValue(':cod', $pt->getCodigoturma());
                $consulta->execute();
            
                $listacompleta = array();
        
                $linha=$consulta->fetchAll(PDO::FETCH_ASSOC);
            
                $listacompleta = $linha;
        
                Conexao::desconexao();
                return $listacompleta;
        }
    
        #################################################################
    ################## Relatórios do Período ########################
    #################################################################

    public function relatorioGeralProfessorTurma() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codprofessorTurma, nomeTurma, nomeUsuario, dataCadastroFuncionario FROM tbprofessorturma
                                    INNER JOIN tbTurma ON tbprofessorturma.codTurma = tbturma.codTurma
                                        INNER JOIN tbusuario ON tbprofessorturma.codUsuario = tbusuario.codUsuario");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $profturma = new ProfessorTurma();
               $profturma->setCodigoprofessorturma($linha['codprofessorTurma']);
               $profturma->setNometurma($linha['nomeTurma']);
               $profturma->setNomeprofessor($linha['nomeUsuario']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroFuncionario']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $profturma->setDatacadastro($dataCadastro);

               $lista->append($profturma);
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
    
    public function relatorioEspecificoProfessorTurma(&$profturma) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codprofessorTurma, nomeTurma, nomeUsuario, dataCadastroFuncionario FROM tbprofessorturma
                                    INNER JOIN tbTurma ON tbprofessorturma.codTurma = tbturma.codTurma
                                        INNER JOIN tbusuario ON tbprofessorturma.codUsuario = tbusuario.codUsuario
                                        WHERE codprofessorTurma = :cod");
           $cmd->bindValue(":cod", $profturma->getCodigoprofessorturma(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $profturma->setCodigoprofessorturma($linha['codprofessorTurma']);
               $profturma->setNometurma($linha['nomeTurma']);
               $profturma->setNomeprofessor($linha['nomeUsuario']);            
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroFuncionario']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $profturma->setDatacadastro($dataCadastro);
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
