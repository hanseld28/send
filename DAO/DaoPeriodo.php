<?php
include_once("Conexao.php");
include_once("..\Model\Periodo.php");

/**
 * Description of DaoPeriodo
 *
 * @author hansel
 */


class DaoPeriodo {

  public function cadastrarPeriodo($novoPeriodo){ 
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();

   $descPeriodo = $novoPeriodo->getDescricao();

       // Prepara o cadastro
   $cmd = $pdo->prepare("INSERT INTO tbperiodo(descPeriodo, horarioPeriodo) "
     . "VALUES (:descPeriodo, :horarioPeriodo)");

   $cmd->bindValue(":descPeriodo", $descPeriodo, PDO::PARAM_STR);
   $cmd->bindValue(":horarioPeriodo", $novoPeriodo->getHorario(), PDO::PARAM_STR);

       // Valida o cadastro
   $validar = $pdo->prepare("SELECT descPeriodo FROM tbperiodo WHERE descPeriodo = ?");
   $validar->execute(array($descPeriodo));
   if($validar->rowCount() == 0){
           // Executa o Cadastro
     $cmd->execute();
     return true;
   }else{
     return false;
   }
   Conexao::desconexao();
 }

 public function consultarPeriodo(){ 
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();


   //PAGINAÇÃO
   $i = 1;
   $listarPeriodo_pg=$pdo->prepare("SELECT codPeriodo,descPeriodo, horarioPeriodo FROM tbperiodo");
   $listarPeriodo_pg->execute();

   $count = $listarPeriodo_pg->rowCount();
   $calculo = ceil(($count/5));

   while ($i <= $calculo) {
    $i++;
  }

  $_POST['calculoPeriodo'] = $calculo;
  
  $url = 0;
  $mody =0;
  if (isset($_GET['pagePeriodo']) == $i) {
    $url= $_GET['pagePeriodo'];
    $mody = ($url*5)-5;
  }
//PAGINAÇÃO

  // Prepara o cadastro
  $cmd = $pdo->prepare("SELECT codPeriodo, descPeriodo, horarioPeriodo FROM tbperiodo LIMIT 5 OFFSET {$mody}");
  $cmd->execute();

       // Cria uma lista para armazenar todos os graus escolares
  $listaPeriodos = new ArrayObject();

       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'Periodo' que é adicionado 
       // a uma lista de graus escolares
  while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
   $periodo = new Periodo();

   $periodo->setId($linha['codPeriodo']);
   $periodo->setDescricao($linha['descPeriodo']);
   $periodo->setHorario($linha['horarioPeriodo']);

   $listaPeriodos->append($periodo);
 }
 Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
 return $listaPeriodos;
}

public function editarPeriodo($editarPeriodo){
  try{
            // Abre a conexão com o banco de dados
    $pdo = Conexao::conexao();

            // Prepara a edição 
    $cmd = $pdo->prepare("UPDATE tbperiodo SET descPeriodo = :descPeriodo, horarioPeriodo = :horarioPeriodo "
      . "WHERE codPeriodo = :codPeriodo");
            // Substitui os valores
    $cmd->bindValue(":descPeriodo", $editarPeriodo->getDescricao(), PDO::PARAM_STR);
    $cmd->bindValue(":horarioPeriodo", $editarPeriodo->getHorario(), PDO::PARAM_STR);
    $cmd->bindValue(":codPeriodo", $editarPeriodo->getId(), PDO::PARAM_INT); 
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

public function excluirPeriodo($excluirPeriodo){
   try {

    $resposta = "";

            // Abre a conexão com o banco de dados
    $pdo = Conexao::conexao();

    $valida = $pdo->prepare("select codGrauEscolar from tbgrauescolar where codPeriodo = :codPeriodo");
    $valida->bindValue(":codPeriodo", $excluirPeriodo->getId(), PDO::PARAM_INT);
    $valida->execute();

    if($valida->rowCount() > 0){
      $resposta = "Existe um grau escolar cadastrado com este período";
      return $resposta;

 
    }else{

    $cmd = $pdo->prepare("DELETE FROM tbperiodo WHERE codPeriodo = :codPeriodo");
    $cmd->bindValue(":codPeriodo", $excluirPeriodo->getId(), PDO::PARAM_INT);
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

    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherPeriodo(&$periodo){ // '&' representa uma Passagem por Referência
    try{
           // Abre a conexão com o banco de dados
     $pdo = Conexao::conexao();

           // Busca os dados do Periodo no banco de dados
     $cmd = $pdo->prepare("SELECT descPeriodo, horarioPeriodo FROM tbperiodo
      WHERE codPeriodo = :codPeriodo");

           // Substitui os valores
     $cmd->bindValue(":codPeriodo", $periodo->getId(), PDO::PARAM_INT);

     if($cmd->execute()){
      $linha = $cmd->fetch(PDO::FETCH_ASSOC);

      $periodo->setDescricao($linha['descPeriodo']);
      $periodo->setHorario($linha['horarioPeriodo']);

                // Não é necessário um 'return' pois o objeto será alterado automaticamente através da Passagem por Referência
    }
  } catch (PDOException $e){
   echo $e->getMessage();
 } finally {
   Conexao::desconexao();
 }
}

      #################################################################
    ################## Relatórios do Período ########################
    #################################################################

public function relatorioGeralPeriodo() 
{       
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 try
 {
           // Busca os dados do Relatorio no banco de dados
   $cmd = $pdo->query("SELECT codPeriodo, descPeriodo, horarioPeriodo, dataCadastroPeriodo FROM tbperiodo");

           // Cria uma lista para armazenar todos os periodos
   $listaPeriodos = new ArrayObject();

           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
   while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
   {
     $periodo = new Periodo();
     $periodo->setId($linha['codPeriodo']);
     $periodo->setDescricao($linha['descPeriodo']);
     $periodo->setHorario($linha['horarioPeriodo']);

               ############## Formatando a Data de Cadastro ###################
     $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroPeriodo']));
     $dataCadastroPeriodo = str_replace('-', '/', $aux);
               ################################################################
     $periodo->setDataCadastro($dataCadastroPeriodo);

     $listaPeriodos->append($periodo);
   }
           // Retorna a lista completa com os periodos
   return $listaPeriodos;

 }
 catch (PDOException $e)
 {
   echo $e->getMessage();
 } 

 Conexao::desconexao();
}

public function relatorioEspecificoPeriodo(&$periodo) 
{    
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 try
 {
           // Busca os dados do Período no banco de dados
   $cmd = $pdo->prepare("SELECT codPeriodo, descPeriodo, horarioPeriodo, dataCadastroPeriodo FROM tbperiodo
    WHERE codPeriodo = :codPeriodo");
   $cmd->bindValue(":codPeriodo", $periodo->getId(), PDO::PARAM_INT);

   if ($cmd->execute()) 
   {    
     $linha = $cmd->fetch(PDO::FETCH_ASSOC);

     $periodo->setId($linha['codPeriodo']);
     $periodo->setDescricao($linha['descPeriodo']);
     $periodo->setHorario($linha['horarioPeriodo']);            
               ############## Formatando a Data de Cadastro ###################
     $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroPeriodo']));
     $dataCadastroPeriodo = str_replace('-', '/', $aux);
               ################################################################
     $periodo->setDataCadastro($dataCadastroPeriodo);
   }

 } 
 catch (PDOException $e)
 {
  echo $e->getMessage();
} 

Conexao::desconexao();
}

}
