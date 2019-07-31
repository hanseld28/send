<?php

include_once("Conexao.php");
include_once("../Model/TipoUsuario.php");

/**
 * Description of DaoTipoUsuario
 *
 * @author hansel
 */


class DaoTipoUsuario {
    
    ##### INSERT #####   
    public function cadastrarTipoUsuario($novoTipoUsuario){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();
       $descTipoUsuario = $novoTipoUsuario->getDescricao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbtipousuario(descTipoUsuario) VALUES (:tipoUsuario)");
       $cmd->bindValue(":tipoUsuario", $descTipoUsuario, PDO::PARAM_STR); 
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descTipoUsuario FROM tbtipousuario WHERE descTipoUsuario = ?");
       $validar->execute(array($descTipoUsuario));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
           //echo "Erro ao cadastrar: esse tipo de usuário já existe!";
       }
       
       Conexao::desconexao();
    }
    
    ##### SELECT #####
    public function consultarTipoUsuario(){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

      //PAGINAÇÃO
       $i = 1;
       $listarTipoUsuario_pg=$pdo->prepare("SELECT codTipoUsuario, descTipoUsuario FROM tbtipousuario");
       $listarTipoUsuario_pg->execute();

       $count = $listarTipoUsuario_pg->rowCount();
       $calculo = ceil(($count/5));

       while ($i <= $calculo) {
        $i++;
      }

      $_POST['calculoTipoUsuario'] = $calculo;

      $url = 0;
      $mody =0;
      if (isset($_GET['pageTipoUsuario']) == $i) {
        $url= $_GET['pageTipoUsuario'];
        $mody = ($url*5)-5;
      }
      //PAGINAÇÃO


       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codTipoUsuario, descTipoUsuario FROM tbtipousuario");
       $cmd->execute();
       
       // Cria uma lista para armazenar todos os tipos de usuario
       $listaTiposUsuario = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto '$tipoUsuario' que é adicionado 
       // a uma lista de tipos de usuarios
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $tipoUsuario = new TipoUsuario();

           $tipoUsuario->setId($linha['codTipoUsuario']);
           $tipoUsuario->setDescricao($linha['descTipoUsuario']);

           $listaTiposUsuario->append($tipoUsuario);
       }
       Conexao::desconexao();
       // Retorna a lista completa com os tipos de usuario
       return $listaTiposUsuario;
    }
    
     public function consultarTipoUsuarioFuncionario(){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codTipoUsuario, descTipoUsuario FROM tbtipousuario WHERE descTipoUsuario <> 'Responsável' ");
       $cmd->execute();
       
       // Cria uma lista para armazenar todos os tipos de usuario
       $listaTiposUsuario = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto '$tipoUsuario' que é adicionado 
       // a uma lista de tipos de usuarios
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $tipoUsuario = new TipoUsuario();

           $tipoUsuario->setId($linha['codTipoUsuario']);
           $tipoUsuario->setDescricao($linha['descTipoUsuario']);

           $listaTiposUsuario->append($tipoUsuario);
       }
       Conexao::desconexao();
       // Retorna a lista completa com os tipos de usuario
       return $listaTiposUsuario;
    }
    
    
	
    ##### UPDATE #####
    public function editarTipoUsuario($editarTipoUsuario){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       // Prepara a edição 
       $cmd = $pdo->prepare("UPDATE tbtipousuario SET descTipoUsuario = :descTipoUsuario WHERE codTipoUsuario = :codTipoUsuario");
       $cmd->bindValue(":descTipoUsuario", $editarTipoUsuario->getDescricao());
       $cmd->bindValue(":codTipoUsuario", $editarTipoUsuario->getId()); 
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
    public function excluirTipoUsuario($codTipoUsuario){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();
       
       $cmd = $pdo->prepare("DELETE FROM tbtipousuario WHERE codTipoUsuario = :codTipoUsuario");
       $cmd->bindValue(":codTipoUsuario", $codTipoUsuario, PDO::PARAM_INT);
       $cmd->execute();
       
       if($cmd->rowCount() == 1){
           // Tipo de Usuário excluído
           return true;
       }else{
           // Erro ao excluir Tipo de Usuário
           return false;
       }
       Conexao::desconexao();
    }
    
    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherTipoUsuario($codTipoUsuario){ // '&' representa uma Passagem por Referência

       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           $descTipoUsuario = "";

           $tipoUsuario = new TipoUsuario();

           $tipoUsuario->setId($codTipoUsuario);

           // Busca o código do tipo de usuário no banco
           $cmd = $pdo->prepare("SELECT descTipoUsuario FROM tbtipousuario WHERE codTipoUsuario = :codTipoUsuario");
           $cmd->bindValue(":codTipoUsuario", $tipoUsuario->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                 $linha = $cmd->fetch(PDO::FETCH_OBJ);

                 $tipoUsuario->setDescricao($linha->descTipoUsuario);

                 $descTipoUsuario = $tipoUsuario->getDescricao();

                 return $descTipoUsuario;
           }
       } catch(PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }
    
       #################################################################
    ############### Relatórios do Tipo de Usuário ###################
    #################################################################
    public function relatorioGeralTipoUsuario() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codTipoUsuario, descTipoUsuario, dataCadastroTipoUsuario FROM tbtipousuario");
           
           // Cria uma lista para armazenar todos os tipos de usuario
           $listaTiposUsuario = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'TipoUsuario' que é adicionado 
           // a uma lista de graus escolares
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $tipoUsuario = new TipoUsuario();
               $tipoUsuario->setId($linha['codTipoUsuario']);
               $tipoUsuario->setDescricao($linha['descTipoUsuario']);
               $tipoUsuario->setDataCadastro($linha['dataCadastroTipoUsuario']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroTipoUsuario']));
               $dataCadastroTipoUsuario = str_replace('-', '/', $aux);
               ################################################################
               $tipoUsuario->setDataCadastro($dataCadastroTipoUsuario);

               $listaTiposUsuario->append($tipoUsuario);
           }
           // Retorna a lista completa com os tipos de usuario
           return $listaTiposUsuario;

       }
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
    
    public function relatorioEspecificoTipoUsuario(&$tipoUsuario) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Grau Escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codTipoUsuario, descTipoUsuario, dataCadastroTipoUsuario FROM tbTipoUsuario
                              WHERE codTipoUsuario = :codTipoUsuario");
           $cmd->bindValue(":codTipoUsuario", $tipoUsuario->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $tipoUsuario->setId($linha['codTipoUsuario']);
               $tipoUsuario->setDescricao($linha['descTipoUsuario']);
  
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroTipoUsuario']));
               $dataCadastroTipoUsuario = str_replace('-', '/', $aux);
               ################################################################
               $tipoUsuario->setDataCadastro($dataCadastroTipoUsuario);
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