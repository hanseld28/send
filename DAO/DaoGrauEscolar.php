

<?php
include_once("Conexao.php");
include_once("..\Model\GrauEscolar.php");
include_once("..\Model\Periodo.php");

/**
 * Description of DaoGrauEscolar
 *
 * @author hansel
 */


class DaoGrauEscolar {
    
    public function cadastrarGrauEscolar($novoGrauEscolar){
       
       $pdo = Conexao::conexao();

       $periodo = new Periodo();
       $descGrauEscolar = $novoGrauEscolar->getDescricao();
       $periodo = $novoGrauEscolar->periodo->getId();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbgrauescolar(descGrauEscolar, codPeriodo) "
               . "VALUES (:descGrauEscolar, :codPeriodo)");
       $cmd->bindValue(":descGrauEscolar", $descGrauEscolar, PDO::PARAM_STR);
       $cmd->bindValue(":codPeriodo", $periodo, PDO::PARAM_INT);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descGrauEscolar, codPeriodo FROM tbgrauescolar WHERE descGrauEscolar = :descGrauEscolar AND codPeriodo = :codPeriodo");
       $validar->bindValue(":descGrauEscolar", $descGrauEscolar, PDO::PARAM_STR);
       $validar->bindValue(":codPeriodo", $periodo, PDO::PARAM_INT);
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
    
    public function consultarGrauEscolar(){
       $pdo = Conexao::conexao();

       //PAGINAÇÃO
       $i = 1;
       $listarGrauEscolar_pg=$pdo->prepare("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo");
       $listarGrauEscolar_pg->execute();

       $count = $listarGrauEscolar_pg->rowCount();
       $calculo = ceil(($count/5));

       while ($i <= $calculo) {
        $i++;
      }

      $_POST['calculoGrauEscolar'] = $calculo;

      $url = 0;
      $mody =0;
      if (isset($_GET['pageGrauEscolar']) == $i) {
        $url= $_GET['pageGrauEscolar'];
        $mody = ($url*5)-5;
      }
      //PAGINAÇÃO


       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo LIMIT 5 OFFSET {$mody}");
       $cmd->execute();
       
       // Cria uma lista para armazenar todos os graus escolares
       $listaGrausEscolares = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $grauEscolar = new GrauEscolar();
           $periodo = new Periodo();
           $periodo->setDescricao($linha['descPeriodo']);
           $periodo->setHorario($linha['horarioPeriodo']);
           $grauEscolar->addPeriodo($periodo);
           $grauEscolar->setId($linha['codGrauEscolar']);
           $grauEscolar->setDescricao($linha['descGrauEscolar']);
           
           $listaGrausEscolares->append($grauEscolar);
       }

       Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
       return $listaGrausEscolares;
    }
    
    public function consultarGrauEscolar2(){
        
        $pdo = Conexao::conexao();
    
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo");
       $cmd->execute();
       
       // Cria uma lista para armazenar todos os graus escolares
       $listaGrausEscolares = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $grauEscolar = new GrauEscolar();
           $periodo = new Periodo();
           $periodo->setDescricao($linha['descPeriodo']);
           $periodo->setHorario($linha['horarioPeriodo']);
           $grauEscolar->addPeriodo($periodo);
           $grauEscolar->setId($linha['codGrauEscolar']);
           $grauEscolar->setDescricao($linha['descGrauEscolar']);
           
           $listaGrausEscolares->append($grauEscolar);
       }

       Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
       return $listaGrausEscolares;
        
    }
    
    public function editarGrauEscolar(&$GrauEscolar){ 
        try{
            // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
            // Prepara a edição 
            $grau = $GrauEscolar->getDescricao();
            $codgrau = $GrauEscolar->getId();
            $periodo = $GrauEscolar->periodo->getId();
            
            $cmd = $pdo->prepare("UPDATE tbgrauescolar SET descGrauEscolar = :descGrauEscolar, codPeriodo = :periodo WHERE codGrauEscolar = :codGrauEscolar");
            // Substitui os valores
            $cmd->bindValue(":descGrauEscolar", $grau, PDO::PARAM_STR);
            $cmd->bindValue(":periodo", $periodo, PDO::PARAM_INT); 
            $cmd->bindValue(":codGrauEscolar", $codgrau, PDO::PARAM_INT); 
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
    
    public function excluirGrauEscolar($excluirGrauEscolar){
      try {
            $resposta = "";
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
  
            // Código do tipo de usuário a ser excluído
            $codGrauEscolar = $excluirGrauEscolar->getId();


            $valida = $pdo->prepare("select codTurma from tbturma where codGrauEscolar = :codGrauEscolar");
            $valida->bindValue(":codGrauEscolar", $codGrauEscolar, PDO::PARAM_INT);
            $valida->execute();

            if($valida->rowCount() > 0){
              $resposta = "Existe uma turma cadastrada com este grau escolar";
              return $resposta;

            }else{

                 $cmd = $pdo->prepare("DELETE FROM tbgrauescolar WHERE codGrauEscolar = :codGrauEscolar");
            $cmd->bindValue(":codGrauEscolar", $codGrauEscolar, PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1){
              $resposta = "true";
              return $resposta;
            }
            else{
              $resposta = "false";
              return $respota; 
            }

            } 
         
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    }
    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherGrauEscolar($grauEscolar){ // '&' representa uma Passagem por Referência
       try{
               $pdo = Conexao::conexao();
           
           
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo WHERE codGrauEscolar = :codGrauEscolar");
           $cmd->bindValue(":codGrauEscolar", $grauEscolar->getId(), PDO::PARAM_INT); 
           $cmd->execute();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
           
           $periodo = new Periodo();
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           
           $grauEscolar->setId(intval($linha['codGrauEscolar']));
           $grauEscolar->setDescricao($linha['descGrauEscolar']);
           
           $periodo->setDescricao($linha['descPeriodo']);
           $periodo->setHorario($linha['horarioPeriodo']);
           $grauEscolar->addPeriodo($periodo);
           
          
           
       }
           
           return $grauEscolar;
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }
    
     #################################################################
    ################## Relatórios do Grau Escolar ###################
    #################################################################

    public function relatorioGeralGrauEscolar() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
            // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo");
           
           // Cria uma lista para armazenar todos os graus escolares
           $listaGrausEscolares = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
           // a uma lista de graus escolares
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $grauEscolar = new GrauEscolar();
               $grauEscolar->setId($linha['codGrauEscolar']);
               $grauEscolar->setDescricao($linha['descGrauEscolar']);
               $periodo = new Periodo();
               $periodo->setDescricao($linnha['descPeriodo']);
               $periodo->setHorario($linha['horarioPeriodo']);
               $grauEscolar->addPeriodo($periodo);
               $grauEscolar->setDataCadastro($linha['dataCadastroGrauEscolar']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroGrauEscolar']));
               $dataCadastroGrauEscolar = str_replace('-', '/', $aux);
               ################################################################
               $grauEscolar->setDataCadastro($dataCadastroGrauEscolar);

               $listaGrausEscolares->append($grauEscolar);
           }
           // Retorna a lista completa com os graus escolares
           return $listaGrausEscolares;

       }
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 

       Conexao::desconexao();
    }

    public function relatorioEspecificoGrauEscolar(&$grauEscolar) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Grau Escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codGrauEscolar, descGrauEscolar, descPeriodo, horarioPeriodo FROM tbgrauescolar INNER JOIN tbPeriodo ON tbgrauescolar.codPeriodo = tbperiodo.codPeriodo WHERE codGrauEscolar = :codGrauEscolar");
           $cmd->bindValue(":codGrauEscolar", $grauEscolar->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $grauEscolar->setId($linha['codGrauEscolar']);
               $grauEscolar->setDescricao($linha['descGrauEscolar']);
               $periodo = new Periodo();
               $periodo->setDescricao($linnha['descPeriodo']);
               $periodo->setHorario($linha['horarioPeriodo']);
               $grauEscolar->addPeriodo($periodo);
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroGrauEscolar']));
               $dataCadastroGrauEscolar = str_replace('-', '/', $aux);
               ################################################################
               $grauEscolar->setDataCadastro($dataCadastroGrauEscolar);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
}