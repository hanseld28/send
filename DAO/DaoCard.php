<?php

include_once("Conexao.php");
include_once("../Model/Card.php");

/**
 * Description of DaoCard
 *
 * @author hansel
 */


class DaoCard {

    ##### INSERT #####   
  public function cadastrarCard($novoCard){
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();
   $descCard = $novoCard->getDescricao();

       // Prepara o cadastro
   $cmd = $pdo->prepare("INSERT INTO tbcard(descCard) VALUES (:descCard)");
   $cmd->bindValue(":descCard", $descCard, PDO::PARAM_STR); 

       // Valida o cadastro
   $validar = $pdo->prepare("SELECT descCard FROM tbcard WHERE descCard = ?");
   $validar->execute(array($descCard));
   if($validar->rowCount() == 0){
           // Executa o Cadastro
     $cmd->execute();
     return true;
   }else{
     return false;
           //echo "Erro ao cadastrar: esse card já existe!";
   }

   Conexao::desconexao();
 }

    ##### SELECT #####
 public function consultarCard(){
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();

       //PAGINAÇÃO
   $i = 1;
   $listarcargos_pg=$pdo->prepare("SELECT codCard, descCard FROM tbcard");
   $listarcargos_pg->execute();

   $count = $listarcargos_pg->rowCount();
   $calculo = ceil(($count/5));

   while ($i <= $calculo) {
    $i++;
  }

  $_POST['calculoCard'] = $calculo;

  $url = 0;
  $mody =0;
  if (isset($_GET['pageCard']) == $i) {
    $url= $_GET['pageCard'];
    $mody = ($url*5)-5;
  }
       //PAGINAÇÃO
       // Prepara o cadastro
  $cmd = $pdo->prepare("SELECT codCard, descCard FROM tbcard");
  $cmd->execute();

       // Cria uma lista para armazenar todos os cards
  $listaCards = new ArrayObject();

       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto '$card' que é adicionado 
       // a uma lista de cards
  while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
   $card = new Card();

   $card->setId($linha['codCard']);
   $card->setDescricao($linha['descCard']);

   $listaCards->append($card);
 }
 Conexao::desconexao();
       // Retorna a lista completa com os cards
 return $listaCards;
}

    ##### UPDATE #####
public function editarCard($editarCard){
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

       // Prepara a edição 
 $cmd = $pdo->prepare("UPDATE tbCard SET descCard = :descCard WHERE codCard = :codCard");
 $cmd->bindValue(":descCard", $editarCard->getDescricao());
 $cmd->bindValue(":codCard", $editarCard->getId()); 
 $cmd->execute();

 if($cmd->rowCount() > 0):
           // Tipo de Usuário editado
   return true;  
 else:
           // Erro ao editar o Tipo de Usuário
   return false;
 endif;

 Conexao::desconexao();
}

    ##### DELETE #####
public function excluirCard($card){
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 $cmd = $pdo->prepare("DELETE FROM tbcard WHERE codCard = :codCard");
 $cmd->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
 $cmd->execute();

 if($cmd->rowCount() == 1){
           // Card excluído
   return true;
 }else{
           // Erro ao excluir Card
   return false;
 }
 Conexao::desconexao();
}

    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherCard(&$card){ // '&' representa uma Passagem por Referência

       // Abre a conexão com o banco de dados
    $pdo = Conexao::conexao();

    try{
           // Busca o código do card no banco
     $cmd = $pdo->prepare("SELECT descCard FROM tbcard WHERE codCard = :codCard");
     $cmd->bindValue(":codCard", $card->getId(), PDO::PARAM_INT); 
     if($cmd->execute()){
       $linha = $cmd->fetch(PDO::FETCH_OBJ);

       $card->setDescricao($linha->descCard);
     }
   } catch(PDOException $e){
     echo $e->getMessage();
   }

   Conexao::desconexao();

 }


    ///Relatório Card
 public function relatorioGeralCard() 
 {       
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();

   try
   {
           // Busca os dados do Relatorio no banco de dados
     $cmd = $pdo->query("SELECT codCard, descCard, dataCadastroCard FROM tbcard");
     
           // Cria uma lista para armazenar todos os periodos
     $lista = new ArrayObject();
     
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
     while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
     {
       $card = new Card();
       $card->setId($linha['codCard']);
       $card->setDescricao($linha['descCard']);

               ############## Formatando a Data de Cadastro ###################
       $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCard']));
       $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
       $card->setDataCadastro($dataCadastro);

       $lista->append($card);
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
 
 public function relatorioEspecificoCard(&$card) 
 {    
       // Abre a conexão com o banco de dados
   $pdo = Conexao::conexao();

   try
   {
           // Busca os dados do Período no banco de dados
     $cmd = $pdo->prepare("SELECT codCard, descCard, dataCadastroCard FROM tbcard WHERE codCard = :cod");
     $cmd->bindValue(":cod", $card->getId(), PDO::PARAM_INT);
     
     if ($cmd->execute()) 
     {    
       $linha = $cmd->fetch(PDO::FETCH_ASSOC);

       $card->setId($linha['codCard']);
       $card->setDescricao($linha['descCard']);
       
               ############## Formatando a Data de Cadastro ###################
       $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCard']));
       $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
       $card->setDataCadastro($dataCadastro);
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