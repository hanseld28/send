<?php
include_once("Conexao.php");
include_once("../Model/CaracteristicaSaude.php");

/**
 * Description of DaoCaracteristicaSaude
 *
 * @author hansel
 */

class DaoCaracteristicaSaude {
    
    public function cadastrarCaracteristicaSaude($novaCaracteristicaSaude){
       
       $pdo = Conexao::conexao();

       $descCaracteristicaSaude = $novaCaracteristicaSaude->getDescricao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbcaracteristicasaude(descCaracteristicaSaude) "
               . "VALUES (:descCaracteristicaSaude)");
       $cmd->bindValue(":descCaracteristicaSaude", $descCaracteristicaSaude, PDO::PARAM_STR);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descCaracteristicaSaude FROM tbcaracteristicasaude WHERE descCaracteristicaSaude = ?");
       $validar->execute(array($descCaracteristicaSaude));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    
     public function cadastrarCaracteristicaPorAluno($codprontuario, $codcaracteristica){
         $pdo = Conexao::conexao();
         $cmd = $pdo->prepare("INSERT INTO tbcaracteristicaprontuario (codCaracteristicaSaude, codProntuarioAluno) VALUES (:codcara, :codpront)");
         $cmd->bindValue(':codcara', $codcaracteristica);
         $cmd->bindValue(':codpront', $codprontuario);
         $cmd->execute();
         Conexao::desconexao();
  
    }
    
     public function ExcluirCaracteristicaAluno($caracteristica){
         $pdo = Conexao::conexao();
         $cmd = $pdo->prepare("DELETE FROM tbcaracteristicaprontuario WHERE codCaracteristicaProntuario = :codigo ");
         $cmd->bindValue(':codigo', $caracteristica);
         $cmd->execute();
         Conexao::desconexao();
     }
    
     public function EditarCaracteristicaAluno($codigopront, $codcaracteristica){
         $pdo = Conexao::conexao();
         $cmd = $pdo->prepare("UPDATE tbcaracteristicaprontuario SET codCaracteristicaSaude = :caracteristica WHERE codCaracteristicaProntuario = :caracteristicaPront");
         $cmd->bindValue(':caracteristica', $codcaracteristica);
         $cmd->bindValue(':caracteristicaPront', $codigopront);
         $cmd->execute();
         Conexao::desconexao();
     }
    
    public function consultarCaracteristicaSaude(){
       $pdo = Conexao::conexao();

  //PAGINAÇÃO
       $i = 1;
       $listarCaracteristicasSaude_pg=$pdo->prepare("SELECT codcargo,nomecargo FROM tbcargo");
       $listarCaracteristicasSaude_pg->execute();

       $count = $listarCaracteristicasSaude_pg->rowCount();
       $calculo = ceil(($count/5));

       while ($i <= $calculo) {
        $i++;
      }

      $_POST['calculoCaracteristicaSaude'] = $calculo;

      $url = 0;
      $mody =0;
      if (isset($_GET['pageCaracteristicaSaude']) == $i) {
        $url= $_GET['pageCaracteristicaSaude'];
        $mody = ($url*5)-5;
      }
  //PAGINAÇÃO
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codCaracteristicaSaude, descCaracteristicaSaude FROM tbcaracteristicasaude LIMIT 5 OFFSET {$mody}");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as caracteristicas de saude
       $listaCaracteristicasSaude = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'caracteristicaSaude' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $caracteristicaSaude = new CaracteristicaSaude();

           $caracteristicaSaude->setId($linha['codCaracteristicaSaude']);
           $caracteristicaSaude->setDescricao($linha['descCaracteristicaSaude']);
           
           $listaCaracteristicasSaude->append($caracteristicaSaude);
       }

       Conexao::desconexao();
       // Retorna a lista completa com os graus escolares
       return $listaCaracteristicasSaude;
    }
    
    public function editarCaracteristicaSaude($editarCaracteristicaSaude){ 
        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbcaracteristicasaude "
                    . "SET descCaracteristicaSaude = :descCaracteristicaSaude "
                    . "WHERE codCaracteristicaSaude = :codCaracteristicaSaude");
            // Substitui os valores
            $cmd->bindValue(":descCaracteristicaSaude", $editarCaracteristicaSaude->getDescricao());
            $cmd->bindValue(":codCaracteristicaSaude", $editarCaracteristicaSaude->getId()); 
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
    
    public function excluirCaracteristicaSaude($excluirCaracteristicaSaude){
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
  
            // Código do tipo de usuário a ser excluído
            $codCaracteristicaSaude = $excluirCaracteristicaSaude->getId();

            $cmd = $pdo->prepare("DELETE FROM tbcaracteristicasaude WHERE codCaracteristicaSaude = :codCaracteristicaSaude");
            $cmd->bindValue(":codCaracteristicaSaude", $codCaracteristicaSaude, PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    }
    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherCaracteristicaSaude(&$caracteristicaSaude){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           // Busca o código da caracteristica de saude no banco de dados
           $cmd = $pdo->prepare("SELECT descCaracteristicaSaude FROM tbcaracteristicasaude WHERE codCaracteristicaSaude = :codCaracteristicaSaude");
           $cmd->bindValue(":codCaracteristicaSaude", $caracteristicaSaude->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $caracteristicaSaude->setDescricao($linha->descCaracteristicaSaude);
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

    public function pesquisaAproximadaCaracteristicaSaude($caracteristicaSaude){
        try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
           // Prepara a pesquisa
           $cmd = $pdo->prepare("SELECT codCaracteristicaSaude, descCaracteristicaSaude FROM tbCaracteristicaSaude 
                                  WHERE descCaracteristicaSaude like ':descCaracteristicaSaude%'");
           $cmd->bindValue(":descCaracteristicaSaude", $caracteristicaSaude->getDescricao(), PDO::PARAM_STR);
           $cmd->execute();
           
           // Cria uma lista para armazenar todas caracteristicas de saude
           $listaCaracteristicasSaude = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'caracteristicaSaude' que é adicionado 
           // a uma lista de graus escolares
           while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
               $caracteristicaSaude = new CaracteristicaSaude();

               $caracteristicaSaude->setId($linha['codCaracteristicaSaude']);
               $caracteristicaSaude->setDescricao($linha['descCaracteristicaSaude']);
               
               $listaCaracteristicasSaude->append($caracteristicaSaude);
           }

           Conexao::desconexao();
           // Retorna a lista completa com as caracteristicas de saude
           return $listaCaracteristicasSaude;

        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
          Conexao::desconexao();
        }
    }
    
        #################################################################
    ################## Relatórios do Período ########################
    #################################################################

    public function relatorioGeralCaracteristicaSaude() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codCaracteristicaSaude, descCaracteristicaSaude, dataCadastroCaracteristicaSaude FROM tbcaracteristicasaude");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $cara = new CaracteristicaSaude();
               $cara->setId($linha['codCaracteristicaSaude']);
               $cara->setDescricao($linha['descCaracteristicaSaude']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCaracteristicaSaude']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $cara->setDatacadastro($dataCadastro);

               $lista->append($cara);
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
    
    public function relatorioEspecificoCaracteristicaSaude(&$cara) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codCaracteristicaSaude, descCaracteristicaSaude, dataCadastroCaracteristicaSaude FROM tbcaracteristicasaude
                              WHERE codCaracteristicaSaude = :cod");
           $cmd->bindValue(":cod", $cara->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $cara->setId($linha['codCaracteristicaSaude']);
               $cara->setDescricao($linha['descCaracteristicaSaude']);            
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroCaracteristicaSaude']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $cara->setDatacadastro($dataCadastro);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
}