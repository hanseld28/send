<?php
include_once("Conexao.php");
include_once("../Model/ItemCronograma.php");

/** 
 * Description of ItemCronogramaDAO
 *
 * @author laris
 */

class ItemCronogramaDAO {
 public function cadastrarItemCronograma($obj){

  $item = new ItemCronograma();
  $item = $obj;

  $nomeitem = $item->getNome();
  $horarioitem = $item->getHorario();


  $db = Conexao::conexao();

  $inseredados=$db->prepare("INSERT INTO tbitenscronograma (descItensCronograma, horarioCronograma) VALUES (:descitem, :horarioitem)");
  $inseredados->bindValue(':descitem', $nomeitem, PDO::PARAM_STR);
  $inseredados->bindValue(':horarioitem', $horarioitem);

        // Valida o cadastro
  $validar = $db->prepare("SELECT descItensCronograma, horarioCronograma FROM tbitenscronograma WHERE descItensCronograma = :itens AND horarioCronograma = :horario");

  $validar->bindValue(":itens", $nomeitem, PDO::PARAM_STR);
  $validar->bindValue(":horario", $horarioitem, PDO::PARAM_STR);
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

public function mostrarItemCronograma() {
  $item = 0;
  $db = Conexao::conexao();

 //PAGINAÇÃO
  $i = 1;
  $listarItemCronograma_pg=$db->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma");
  $listarItemCronograma_pg->execute();

  $count = $listarItemCronograma_pg->rowCount();
  $calculo = ceil(($count/5));

  while ($i <= $calculo) {
    $i++;
  }

  $_POST['calculoItensCronograma'] = $calculo;
  
  $url = 0;
  $mody =0;
  if (isset($_GET['pageItensCronograma']) == $i) {
    $url= $_GET['pageItensCronograma'];
    $mody = ($url*5)-5;
  }
//PAGINAÇÃO
  $listaritens=$db->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma LIMIT 5 OFFSET {$mody}");
  $listaritens->execute();

  $listaitens = array();

  $linha=$listaritens->fetchAll(PDO::FETCH_OBJ);

  foreach($linha as $listar){

    $item = new ItemCronograma();
    $item->setCodigo($listar->codItensCronograma);
    $item->setNome($listar->descItensCronograma);
    $item->setHorario($listar->horarioCronograma);

    $listaitens[] = $item;

  }

  Conexao::desconexao();
  return $listaitens;    
}
    
public function mostrarItemCronograma2(){
     $item = 0;
    $db = Conexao::conexao();
    //PAGINAÇÃO
  $listaritens=$db->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma");
  $listaritens->execute();

  $listaitens = array();

  $linha=$listaritens->fetchAll(PDO::FETCH_OBJ);

  foreach($linha as $listar){

    $item = new ItemCronograma();
    $item->setCodigo($listar->codItensCronograma);
    $item->setNome($listar->descItensCronograma);
    $item->setHorario($listar->horarioCronograma);

    $listaitens[] = $item;

  }

  Conexao::desconexao();
  return $listaitens; 
    
}

public function excluirItemCronograma($cod){

  $item = 0;
  $resposta = "";
  $db= Conexao::conexao();

  $verifica=$db->prepare("select codItensPorCronograma from tbitensporcronograma where codItensCronograma = :cod");
  $verifica->bindValue(":cod", $cod);
  $verifica->execute();

  if($verifica->rowCount() > 0){
    $resposta = "Existe um cronograma com este item";
    return $resposta;
 
  }else{

      $excluiritens=$db->prepare("DELETE FROM tbItensCronograma WHERE codItensCronograma = :codigo");
  $excluiritens->bindValue(':codigo', $cod);
  $excluiritens->execute();

  if($excluiritens->rowCount() == 1){
    $resposta = "true";
    return true;
  }else{
    $resposta = "false";
    return $resposta;
  }
  }


  Conexao::desconexao();



}

public function consultardadosItemCronograma($cod){

  $item = 0;
  $db= Conexao::conexao();
  $consultaritens=$db->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma FROM tbItensCronograma WHERE codItensCronograma = :codigo");
  $consultaritens->bindValue(':codigo',$cod);
  $consultaritens->execute();

  $itens = array();
  $linha = $consultaritens->fetchAll(PDO::FETCH_OBJ);

  foreach ($linha as $listar){
   $item = new ItemCronograma();
   $item->setNome($listar->descItensCronograma);
   $item->setHorario($listar->horarioCronograma);

   $itens[] = $item;
 }
 Conexao::desconexao();
 return $itens;

}

public function editarItemCronograma($obj){

  $item = 0;
  $db = Conexao::conexao();

  $item = new ItemCronograma();

  $item = $obj;

  $id = $item->getCodigo();
  $desc = $item->getNome();
  $horario = $item->getHorario();

  $editardados=$db->prepare("UPDATE tbItensCronograma SET descItensCronograma= :nomeitem, horarioCronograma=:horarioCronograma WHERE codItensCronograma = :codigoitem");
  $editardados->bindValue(':nomeitem', $desc);
  $editardados->bindValue(':codigoitem', $id);
  $editardados->bindValue(':horarioCronograma', $horario);

         // Valida o cadastro
  $validar = $db->prepare("SELECT descItensCronograma, horarioCronograma FROM tbitenscronograma WHERE descItensCronograma = :itens and horarioCronograma = :horario");

  $validar->bindValue(":itens", $desc, PDO::PARAM_STR);
  $validar->bindValue(":horario", $horario, PDO::PARAM_STR);
  $validar->execute();

  if($validar->rowCount() == 0){
           // Executa o Cadastro
   $editardados->execute();
   return true;
 }else{
   return false;
 }

 Conexao::desconexao();

}

public function cadastrarCronogramaTurma($codcronograma, $itemcronograma){

  $db = Conexao::conexao();

  $inseredados=$db->prepare("INSERT INTO tbitensporcronograma (codCronograma, codItensCronograma) VALUES (:cronograma, :item)");
  $inseredados->bindValue(':cronograma', $codcronograma);
  $inseredados->bindValue(':item', $itemcronograma);
  $inseredados->execute();

  Conexao::desconexao();


}

public function ExcluirCronogramaTurma($cod){

  $db = Conexao::conexao();

  $excluir=$db->prepare("DELETE FROM tbitensporcronograma WHERE codItensPorCronograma = :codigo");
  $excluir->bindValue(':codigo', $cod);
  $excluir->execute();

  Conexao::desconexao();

}

public function EditarCronogramaTurma($cod, $item){

  $db = Conexao::conexao();

  $editar=$db->prepare("UPDATE tbitensporcronograma SET codItensCronograma = :item WHERE codItensPorCronograma = :cod");
  $editar->bindValue(':cod', $cod);
  $editar->bindValue(':item', $item);
  $editar->execute();

  Conexao::desconexao();

}

    #################################################################
    ################## Relatórios do ItemCronograma #################
    #################################################################

public function relatorioGeralItemCronograma() 
{       
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 try
 {
           // Busca os dados do Relatorio no banco de dados
   $cmd = $pdo->query("SELECT codItensCronograma, descItensCronograma, horarioCronograma, dataCadastroItensCronograma FROM tbitenscronograma");

           // Cria uma lista para armazenar todos os periodos
   $lista = new ArrayObject();

           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
   while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
   {

     $item = new ItemCronograma();
     $item->setCodigo($linha['codItensCronograma']);
     $item->setNome($linha['descItensCronograma']);
     $item->setHorario($linha['horarioCronograma']);


               ############## Formatando a Data de Cadastro ###################
     $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroItensCronograma']));
     $dataCadastroItensCronograma = str_replace('-', '/', $aux);
               ################################################################
     $item->setDatacadastro($dataCadastroItensCronograma);

     $lista->append($item);
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

public function relatorioEspecificoItemCronograma(&$item) 
{    
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 try
 {
           // Busca os dados do Período no banco de dados
   $cmd = $pdo->prepare("SELECT codItensCronograma, descItensCronograma, horarioCronograma, dataCadastroItensCronograma FROM tbitenscronograma
    WHERE codItensCronograma = :cod");
   $cmd->bindValue(":cod", $item->getCodigo(), PDO::PARAM_INT);

   if ($cmd->execute()) 
   {    
     $linha = $cmd->fetch(PDO::FETCH_ASSOC);

     $item->setCodigo($linha['codItensCronograma']);
     $item->setNome($linha['descItensCronograma']);
     $item->setHorario($linha['horarioCronograma']);

               ############## Formatando a Data de Cadastro ###################
     $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroItensCronograma']));
     $dataCadastroItensCronograma = str_replace('-', '/', $aux);
               ################################################################
     $item->setDatacadastro($dataCadastroItensCronograma);
   }

 } 
 catch (PDOException $e)
 {
  echo $e->getMessage();
} 

Conexao::desconexao();
}


}
