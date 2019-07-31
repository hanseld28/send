<?php

 
    include_once("Conexao.php");
    include_once("../Model/Cargo.php");
    

/**
 * Description of CargoDAO
 *
 * @author laris
 */
class CargoDAO {
    //DAO do cargo
    
     public function cadastrarCargo($obj){
        
        $cargo = new Cargo();
        $cargo = $obj;
        
        $nomecargo = $cargo->getNome();
        
        
        $db = Conexao::conexao();
        
        $inseredados=$db->prepare("INSERT INTO tbcargo (nomeCargo) VALUES (:nomecargo)");
        $inseredados->bindValue(':nomecargo', $nomecargo, PDO::PARAM_STR);
         
       // Valida o cadastro
       $validar = $db->prepare("SELECT nomeCargo FROM tbcargo WHERE nomeCargo = :nome");
       $validar->bindValue(":nome", $nomecargo, PDO::PARAM_STR);
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
    
    public function mostrarCargos(){
        
        $cargo = 0;
        $db = Conexao::conexao();

        //PAGINAÇÃO
        $i = 1;
        $listarcargos_pg=$db->prepare("SELECT codcargo,nomecargo FROM tbcargo ");
        $listarcargos_pg->execute();

        $count = $listarcargos_pg->rowCount();
        $calculo = ceil(($count/5));

        while ($i <= $calculo) {
          $i++;
        }

        $_POST['calculoCargo'] = $calculo;

        $url = 0;
        $mody =0;
        if (isset($_GET['pageCargo']) == $i) {
          $url= $_GET['pageCargo'];
          $mody = ($url*5)-5;
        }
       //PAGINAÇÃO
        
        $listarcargos=$db->prepare("SELECT codCargo, nomeCargo FROM tbCargo LIMIT 5 OFFSET {$mody}");
        $listarcargos->execute();
        
        $listacargos = array();
        
        $linha=$listarcargos->fetchAll(PDO::FETCH_OBJ);
        
        foreach($linha as $listar){
            
            $cargo = new Cargo();
            $cargo->setCodigo($listar->codCargo);
            $cargo->setNome($listar->nomeCargo);
            
            
            $listacargos[] = $cargo;
            
        }
        
        Conexao::desconexao();
        return $listacargos;
        
    }
    
    public function exluirCargos($codcargo){
        
         $resultado = "";
        $cargo = 0;
        $db = Conexao::conexao();

        $consulta = $db->prepare("select codFuncionario from tbfuncionariocargo where codCargo = :cod");
        $consulta->bindValue(":cod", $codcargo, PDO::PARAM_INT);
        $consulta->execute();
        if($consulta->rowCount() > 0){

          $resultado = "Existe um funcionário com este cargo";
          return $resultado;
        }else{


        $excluircargo=$db->prepare("DELETE FROM tbCargo WHERE codCargo = :codigo");
        $excluircargo->bindValue(':codigo', $codcargo, PDO::PARAM_INT);
        $excluircargo->execute();

          if($excluircargo->rowCount() == 1){
            $resultado = "true";
            return $resultado;
          }else{
            $resultado = "false";
            return $resultado;
          }
           

        }
        

        Conexao::desconexao();
        
        
    }
    
    public function consultardadosCargos($cod){
        
        $cargo = 0;
        $db = Conexao::conexao();
        $consultarcargos=$db->prepare("SELECT codCargo, nomeCargo FROM tbCargo WHERE codCargo = :codigocargo");
        $consultarcargos->bindValue(':codigocargo', $cod, PDO::PARAM_INT);
        $consultarcargos->execute();
        
        $cargo = array();
        
        $linha = $consultarcargos->fetchAll(PDO::FETCH_OBJ);
        foreach ($linha as $listar){
             $cargos = new Cargo();
             $cargos->setNome($listar->nomeCargo);
             $cargos->setCodigo($listar->codCargo);
             
             $cargo[] = $cargos;
        }
        Conexao::desconexao();
        return $cargo;
        
    }
    
    public function editarcargos($obj){
        $cargo = 0;
        $db = Conexao::conexao();
        
        $c = new Cargo();
        
        $c = $obj;
        
        $id = $c->getCodigo();
        $nome = $c->getNome();
        
        $editardados=$db->prepare("UPDATE tbcargo SET nomeCargo= :nomecargo WHERE codCargo = :codigocargo");
        $editardados->bindValue(':nomecargo', $nome);
        $editardados->bindValue(':codigocargo', $id);
        
        
         // Valida o cadastro
       $validar = $db->prepare("SELECT nomeCargo FROM tbcargo WHERE nomeCargo = :nome");
       $validar->bindValue(":nome", $nome, PDO::PARAM_STR);
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
    
    #################################################################
    ################## Relatórios do cargo ##########################
    #################################################################

    public function relatorioGeralCargo() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codCargo, nomeCargo, dataCadastroCargo FROM tbcargo");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $cargo = new Cargo();
               $cargo->setCodigo($linha['codCargo']);
               $cargo->setNome($linha['nomeCargo']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCargo']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $cargo->setDatacadastro($dataCadastro);

               $lista->append($cargo);
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
    
    public function relatorioEspecificoCargo(&$cargo) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codCargo, nomeCargo, dataCadastroCargo FROM tbcargo WHERE codCargo = :cod");
           $cmd->bindValue(":cod", $cargo->getCodigo(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $cargo->setCodigo($linha['codCargo']);
               $cargo->setNome($linha['nomeCargo']);
                           
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCargo']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $cargo->setDatacadastro($dataCadastro);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
}
