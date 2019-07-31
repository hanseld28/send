 <?php
include_once("Conexao.php");
include("../Model/AtividadeExtraCurricular.php");

/**
* Description of DaoAtividadeExtraCurricular
*
* @author hansel
*/

class DaoAtividadeExtraCurricular {

	public function cadastrarAtividadeExtraCurricular($novaAtividadeExtraCurricular){
       
       $pdo = Conexao::conexao();

       $descAtividadeExtraCurricular = $novaAtividadeExtraCurricular->getDescricao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbatividadeextracurricular(descAtividadeExtraCurricular) "
               . "VALUES (:descAtividadeExtraCurricular)");
       $cmd->bindValue(":descAtividadeExtraCurricular", $descAtividadeExtraCurricular, PDO::PARAM_STR);
       
       // Valida o cadastro
       $validar = $pdo->prepare("SELECT descAtividadeExtraCurricular FROM tbatividadeextracurricular WHERE descAtividadeExtraCurricular = ?");
       $validar->execute(array($descAtividadeExtraCurricular));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }

       Conexao::desconexao();
    }

    public function consultarAtividadeExtraCurricular() {
     $pdo = Conexao::conexao();


         
      //PAGINAÇÃO//
       $i = 1;
       $listaratividade_pg=$pdo->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbatividadeextracurricular");
       $listaratividade_pg->execute();

       $count = $listaratividade_pg->rowCount();
       $calculo = ceil(($count/5));
  

        while ($i <= $calculo) {
                $i++;
            }

         $url = 0;
         $mody =0;
         if (isset($_GET['pageAtividade']) == $i) {
         $url= $_GET['pageAtividade'];
         $mody = $url*5-5;
                             }
                        
      //PAGINAÇÃO//

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbatividadeextracurricular LIMIT 5 OFFSET $mody");
       $cmd->execute();
       
       // Cria uma lista para armazenar todos os graus escolares
       $listaAtividadesExtraCurriculares = new ArrayObject();
        
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $atividadeExtraCurricular = new AtividadeExtraCurricular();

           $atividadeExtraCurricular->setId($linha['codAtividadeExtraCurricular']);
           $atividadeExtraCurricular->setDescricao($linha['descAtividadeExtraCurricular']);
           
           $listaAtividadesExtraCurriculares->append($atividadeExtraCurricular);
       }

       Conexao::desconexao();
       // Retorna a lista completa com as atividade extra curriculares
       return $listaAtividadesExtraCurriculares;
    }

    public function editarAtividadeExtraCurricular($editarAtividadeExtraCurricular){ 
        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbatividadeextracurricular "
                    . "SET descAtividadeExtraCurricular = :descAtividadeExtraCurricular "
                    . "WHERE codAtividadeExtraCurricular = :codAtividadeExtraCurricular");
            // Substitui os valores
            $cmd->bindValue(":descAtividadeExtraCurricular", $editarAtividadeExtraCurricular->getDescricao());
            $cmd->bindValue(":codAtividadeExtraCurricular", $editarAtividadeExtraCurricular->getId()); 
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

  public function editarAtividadeMatricula(&$codMatricula, &$listaAtv){ 
        try{

          $cod = $codMatricula;
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();

        
            $cmd = $pdo->prepare("DELETE from tbmatriculaatividadeextracurricular WHERE codMatricula = :cod");
            $cmd->bindValue(":cod", $cod); 
            $cmd->execute();


             foreach ($listaAtv as $atv) {
                $cmd2 = $pdo->prepare("INSERT INTO tbmatriculaatividadeextracurricular (codAtividadeExtraCurricular, codMatricula) VALUES (:codatividade, :codmatri)");
                  $cmd2->bindValue(":codatividade", $atv->getId(), PDO::PARAM_INT); 
                  $cmd2->bindValue(":codmatri", $cod, PDO::PARAM_INT); 
                  $cmd2->execute();
              }

    

            if($cmd->rowCount() > 0){ 
              return true;
            } else{
              return false; 
            }

            } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();    
        }    
    }

    public function excluirAtividadeExtraCurricular($excluirAtividadeExtraCurricular){
        try {

            $resposta = "";
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
  
            // Código do tipo de usuário a ser excluído
            $codAtividadeExtraCurricular = $excluirAtividadeExtraCurricular->getId();

            $consulta = $pdo->prepare("select codMatricula from tbmatriculaatividadeextracurricular where codAtividadeExtraCurricular = :cod");
            $consulta->bindValue(":cod", $codAtividadeExtraCurricular, PDO::PARAM_INT);
            $consulta->execute();

            if($consulta->rowCount() > 0){
              $resposta = "Existe uma matricula com esta atividade";
              return $resposta;
            }else{

              $cmd = $pdo->prepare("DELETE FROM tbatividadeextracurricular WHERE codAtividadeExtraCurricular = :codAtividadeExtraCurricular");
            $cmd->bindValue(":codAtividadeExtraCurricular", $codAtividadeExtraCurricular, PDO::PARAM_INT);
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
    public function preencherAtividadeExtraCurricular($atividadeExtraCurricular){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           $descAtividadeExtraCurricular = "";
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT descAtividadeExtraCurricular FROM tbatividadeextracurricular WHERE codAtividadeExtraCurricular = :codAtividadeExtraCurricular");
           $cmd->bindValue(":codAtividadeExtraCurricular", $atividadeExtraCurricular->getId(), PDO::PARAM_INT); 
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $atividadeExtraCurricular->setDescricao($linha->descAtividadeExtraCurricular);

                $descAtividadeExtraCurricular = $atividadeExtraCurricular->getDescricao();

                return $descAtividadeExtraCurricular;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }
    
        public function cadastrarAtividadeAluno($codatividade, $codmatricula){
        $db = Conexao::conexao();
       
        
         foreach ($codatividade as $lista){
                $consulta=$db->prepare("INSERT INTO tbmatriculaatividadeextracurricular (codAtividadeExtraCurricular, codMatricula) VALUES (:codatividade, :codmatricula)");
                $consulta->bindValue(':codatividade', $lista);
                $consulta->bindValue(':codmatricula', $codmatricula);
                $consulta->execute();
                }
        
                Conexao::desconexao();
    }

            public function consultarPorMatricula($codmatricula){
        $pdo = Conexao::conexao();

        $atividades = array();

        try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codMatriculaAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbmatriculaatividadeextracurricular INNER JOIN tbatividadeextracurricular ON tbatividadeextracurricular.codAtividadeExtraCurricular = tbmatriculaatividadeextracurricular.codAtividadeExtraCurricular WHERE codmatricula = :cod");
           $cmd->bindValue(":cod", $codmatricula, PDO::PARAM_INT);
           $cmd->execute();

            $linha = $cmd->fetchAll(PDO::FETCH_OBJ);
          foreach ($linha as $listar){
             $atividade = new AtividadeExtraCurricular();
             $atividade->setId($listar->codMatriculaAtividadeExtraCurricular);
             $atividade->setDescricao($listar->descAtividadeExtraCurricular);
             
             $atividades[] = $atividade;
        }
        Conexao::desconexao();
        return $atividades;

           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
       
        
    }
    
    #################################################################
    ################## Relatórios da Atividade ######################
    #################################################################

    public function relatorioGeralAtividade() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular, dataCadastroAtividadeExtraCurricular FROM tbatividadeextracurricular");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $atividade = new AtividadeExtraCurricular();
               $atividade->setId($linha['codAtividadeExtraCurricular']);
               $atividade->setDescricao($linha['descAtividadeExtraCurricular']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroAtividadeExtraCurricular']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $atividade->setDatacadastro($dataCadastro);

               $lista->append($atividade);
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
    
    public function relatorioEspecificoAtividade(&$atividade) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular, dataCadastroAtividadeExtraCurricular FROM tbatividadeextracurricular
                              WHERE codAtividadeExtraCurricular = :cod");
           $cmd->bindValue(":cod", $atividade->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $atividade->setId($linha['codAtividadeExtraCurricular']);
               $atividade->setDescricao($linha['descAtividadeExtraCurricular']);           
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroAtividadeExtraCurricular']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $atividade->setDataCadastro($dataCadastro);
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