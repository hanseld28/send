<?php

include_once("Conexao.php");
include_once("../Model/Aluno.php");

/**
 * Description of AlunoDAO
 *
 * @author laris
 */
class AlunoDAO {
    //DAO do aluno
    
    public function CadastrarAluno($obj){        
      $aluno = new Aluno();
        $aluno = $obj;
                
        $datanascimento = $aluno->getDatanascimento();
        $nome = $aluno->getNome();
        $nacionalidade = $aluno->getNacionalidade();
        $sexo = $aluno->getSexo();
        $cor = $aluno->getCor();
        $certidao = $aluno->getCertidao();
        $rg = $aluno->getRg();
        $logradouro = $aluno->getLogradouro();
        $complemento = $aluno->getComplemento();
        $numcasa = $aluno->getNumcasa();
        $responsavel = $aluno->getResponsavel();
        $cep = $aluno->getCep();
        $bairro = $aluno->getBairro();
        $cidade = $aluno->getCidade();
        $foto = $aluno->getFoto();
        $db = Conexao::conexao();
        
        
        $inseredados=$db->prepare("INSERT INTO tbaluno (nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno, codResponsavel, fotoAluno) VALUES (:nome, :data, :nacionalidade, :sexo, :cor, :rg, :certidao, :logradouro, :ncasa, :complemento, :cep, :bairro, :cidade, :resp, :foto)");
        
        
        $inseredados->bindValue(':nome', $nome, PDO::PARAM_STR);
        $inseredados->bindValue(':data', $datanascimento, PDO::PARAM_STR);
        $inseredados->bindValue(':nacionalidade', $nacionalidade, PDO::PARAM_STR);
        $inseredados->bindValue(':sexo', $sexo, PDO::PARAM_STR);
        $inseredados->bindValue(':cor', $cor, PDO::PARAM_STR);
        $inseredados->bindValue(':rg', $rg, PDO::PARAM_STR);
        $inseredados->bindValue(':certidao', $certidao, PDO::PARAM_STR);
        $inseredados->bindValue(':logradouro', $logradouro, PDO::PARAM_STR);
        $inseredados->bindValue(':ncasa', $numcasa, PDO::PARAM_STR);
        $inseredados->bindValue(':complemento', $complemento, PDO::PARAM_STR);
        $inseredados->bindValue(':cep', $cep, PDO::PARAM_STR);
        $inseredados->bindValue(':bairro', $bairro, PDO::PARAM_STR);
        $inseredados->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $inseredados->bindValue(':resp', $responsavel, PDO::PARAM_INT);
        $inseredados->bindValue(':foto', $foto, PDO::PARAM_STR);
        $inseredados->execute();
        
 
        
       if($inseredados->rowCount() > 0){
           // Executa o Cadastro
          
           return true;
       }else{
           return false;
       }
        Conexao::desconexao();
        
    }
    
    public function EditarAluno($obj){
    
         $db = Conexao::conexao();
        
        $aluno = new Aluno();
        $aluno = $obj;
        $codigo = $aluno->getCodigo();
        $datanascimento = $aluno->getDatanascimento();
        $nome = $aluno->getNome();
        $nacionalidade = $aluno->getNacionalidade();
        $sexo = $aluno->getSexo();
        $cor = $aluno->getCor();
        $certidao = $aluno->getCertidao();
        $rg = $aluno->getRg();
        $logradouro = $aluno->getLogradouro();
        $complemento = $aluno->getComplemento();
        $numcasa = $aluno->getNumcasa();
        $cep = $aluno->getCep();
        $bairro = $aluno->getBairro();
        $cidade = $aluno->getCidade();
        $foto = $aluno->getFoto();
        
        $editadados=$db->prepare("UPDATE tbaluno SET nomeAluno = :nome, dataNascAluno = :data, nacionalidadeAluno = :nacionalidade, sexoAluno = :sexo, corRacaAluno = :cor, rgAluno = :rg, certidaoNascimentoAluno = :certidao, logradouroAluno = :logradouro, numCasaAluno = :ncasa, complementoAluno = :complemento, cepAluno = :cep, bairroAluno = :bairro, cidadeAluno = :cidade, fotoAluno = :foto  WHERE codAluno = :id");
        
        $editadados->bindValue(':nome', $nome, PDO::PARAM_STR);
        $editadados->bindValue(':data', $datanascimento, PDO::PARAM_STR);
        $editadados->bindValue(':nacionalidade', $nacionalidade, PDO::PARAM_STR);
        $editadados->bindValue(':sexo', $sexo, PDO::PARAM_STR);
        $editadados->bindValue(':cor', $cor, PDO::PARAM_STR);
        $editadados->bindValue(':rg', $rg, PDO::PARAM_STR);
        $editadados->bindValue(':certidao', $certidao, PDO::PARAM_STR);
        $editadados->bindValue(':logradouro', $logradouro, PDO::PARAM_STR);
        $editadados->bindValue(':ncasa', $numcasa, PDO::PARAM_STR);
        $editadados->bindValue(':complemento', $complemento, PDO::PARAM_STR);
        $editadados->bindValue(':cep', $cep, PDO::PARAM_STR);
        $editadados->bindValue(':bairro', $bairro, PDO::PARAM_STR);
        $editadados->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $editadados->bindValue(':id', $codigo, PDO::PARAM_INT);
        $editadados->bindValue(':foto', $foto, PDO::PARAM_STR);
        $editadados->execute();
        
       if($editadados->rowCount() > 0){
           return true;
       }else{
           return false;
       }
        
        Conexao::desconexao();
        
    }
    
    public function ExcluirAluno($cod){  
        $aluno = 0;
        $db = Conexao::conexao();

        $buscaresp=$db->prepare("select codResponsavel from tbaluno where codaluno = :cod");
        $buscaresp->bindValue(":cod", $cod, PDO::PARAM_INT);
        $buscaresp->execute();
        $codresp = $buscaresp->fetchColumn();
        
        $buscarAlunoResp=$db->prepare("select codAluno from tbaluno where codResponsavel = :cod");
        $buscarAlunoResp->bindValue(":cod", $codresp, PDO::PARAM_INT);
        $buscarAlunoResp->execute();
        
        if($buscarAlunoResp->rowCount() == 1){
            
        $excluirresp=$db->prepare("delete from tbresponsavel where codResponsavel = :codresp");
        $excluirresp->bindValue(":codresp", $codresp, pdo::PARAM_INT);
        $excluirresp->execute();
            
        }

              $buscarmatri=$db->prepare("select codmatricula from tbmatricula where codAluno = :codaluno");
              $buscarmatri->bindValue(":codaluno", $cod, PDO::PARAM_INT);
              $buscarmatri->execute();
              $codMatricula = $buscarmatri->fetchColumn();

              $excluirAtividade=$db->prepare("delete from tbmatriculaatividadeextracurricular where codMatricula = :codMatricula");
              $excluirAtividade->bindValue(":codMatricula", $codMatricula, PDO::PARAM_INT);
              $excluirAtividade->execute();


                $excluirMatricula=$db->prepare("delete from tbmatricula where codAluno = :codAluno");
                $excluirMatricula->bindValue(":codAluno", $cod, PDO::PARAM_INT);
                $excluirMatricula->execute();

                if($excluirMatricula->rowCount() > 0){


                  $excluirProntuario=$db->prepare("delete from tbprontuarioaluno where codAluno = :codAluno");
                  $excluirProntuario->bindValue(":codAluno", $cod, PDO::PARAM_INT);
                  $excluirProntuario->execute();

                  if($excluirProntuario->rowCount() > 0){


        $excluiraluno=$db->prepare("DELETE FROM tbaluno WHERE codAluno = :codigo");
        $excluiraluno->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $excluiraluno->execute();


        
           if($excluiraluno->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;

                  }



                }

              

        
     
        Conexao::desconexao();

    }
    
    public function ConsultarAluno($cod){
        
        $aluno = 0;
        $db = Conexao::conexao();
        $consultaraluno=$db->prepare("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno, fotoAluno FROM tbaluno WHERE codAluno = :codigo");
        
        $consultaraluno->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $consultaraluno->execute();
        
        
        
        $listaaluno =  Array();
        
        $linha = $consultaraluno->fetchAll(PDO::FETCH_OBJ);
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $aluno = new Aluno();
            
            $aluno->setCodigo($listar->codAluno);
            $aluno->setNome($listar->nomeAluno);
            $aluno->setDatanascimento($listar->dataNascAluno);
            $aluno->setNacionalidade($listar->nacionalidadeAluno);
            $aluno->setSexo($listar->sexoAluno);
            $aluno->setCor($listar->corRacaAluno);
            $aluno->setRg($listar->rgAluno);
            $aluno->setCertidao($listar->certidaoNascimentoAluno);
            $aluno->setLogradouro($listar->logradouroAluno);
            $aluno->setNumcasa($listar->numCasaAluno);
            $aluno->setComplemento($listar->complementoAluno);
            $aluno->setCep($listar->cepAluno);
            $aluno->setBairro($listar->bairroAluno);
            $aluno->setCidade($listar->cidadeAluno);
            $aluno->setFoto($listar->fotoAluno);
            
            
            $alunos[] = $aluno;
       }
       
       Conexao::desconexao();
       
       return $alunos;
        
    }
    
    public function MostrarAluno(){
        
        $aluno = 0;
        $db = Conexao::conexao();
        
     //Paginação
       $i = 1;
       $listaraluno_pg=$db->prepare("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno FROM tbaluno");
       $listaraluno_pg->execute();

       $count = $listaraluno_pg->rowCount();
       $calculo = ceil(($count/8));

         $url = 0;
         $mody =0;
         if (isset($_GET['pageAluno']) == $i) {
         $url= $_GET['pageAluno'];
         $mody = ($url*8)-8;
     }

     //Paginação    
        
        $listaraluno=$db->prepare("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno FROM tbaluno LIMIT 8 OFFSET {$mody}");
        $listaraluno->execute();
        
        $listaaluno =  Array();
        
         
         $linha = $listaraluno->fetchAll(PDO::FETCH_OBJ);
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $aluno = new Aluno();
            
            $aluno->setCodigo($listar->codAluno);
            $aluno->setNome($listar->nomeAluno);
            $aluno->setDatanascimento($listar->dataNascAluno);
            $aluno->setNacionalidade($listar->nacionalidadeAluno);
            $aluno->setSexo($listar->sexoAluno);
            $aluno->setCor($listar->corRacaAluno);
            $aluno->setRg($listar->rgAluno);
            $aluno->setCertidao($listar->certidaoNascimentoAluno);
            $aluno->setLogradouro($listar->logradouroAluno);
            $aluno->setNumcasa($listar->numCasaAluno);
            $aluno->setComplemento($listar->complementoAluno);
            $aluno->setCep($listar->cepAluno);
            $aluno->setBairro($listar->bairroAluno);
            $aluno->setCidade($listar->cidadeAluno);
            
            
            $listaaluno[] = $aluno;
            
            
       }
       
       Conexao::desconexao();
       
       return $listaaluno;
    }

    public function ConsultarDadosAluno($cod){
        $aluno = 0;
        $db = Conexao::conexao();
        $consultaraluno=$db->prepare("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno FROM tbaluno WHERE codResponsavel = :codigo LIMIT 1");
        
        $consultaraluno->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $consultaraluno->execute();
        
        $listaaluno =  Array();
        
        $linha = $consultaraluno->fetchAll(PDO::FETCH_OBJ);
        
        foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $aluno = new Aluno();
            
            $aluno->setCodigo($listar->codAluno);
            $aluno->setNome($listar->nomeAluno);
            $aluno->setDatanascimento($listar->dataNascAluno);
            $aluno->setNacionalidade($listar->nacionalidadeAluno);
            $aluno->setSexo($listar->sexoAluno);
            $aluno->setCor($listar->corRacaAluno);
            $aluno->setRg($listar->rgAluno);
            $aluno->setCertidao($listar->certidaoNascimentoAluno);
            $aluno->setLogradouro($listar->logradouroAluno);
            $aluno->setNumcasa($listar->numCasaAluno);
            $aluno->setComplemento($listar->complementoAluno);
            $aluno->setCep($listar->cepAluno);
            $aluno->setBairro($listar->bairroAluno);
            $aluno->setCidade($listar->cidadeAluno);
            
            
            $listaaluno[] = $aluno;
        }
       
       Conexao::desconexao();
       
       return $listaaluno;    
    }
    
    
    public function BuscarResponsavel($cod){
        $responsavel;
        $db= Conexao::conexao();
        
        $buscarresp=$db->prepare("SELECT nomeResponsavel FROM tbresponsavel
                                    INNER JOIN tbaluno
                                    ON tbresponsavel.codResponsavel = tbaluno.codResponsavel WHERE codAluno = :codigo");
        $buscarresp->bindValue(":codigo", $cod);
        $buscarresp->execute();
        $linha = $buscarresp->fetchColumn();
        
        //foreach($linha as $lin){
            //$listacargos[] = $lin('nomeCargo');
        //}
        
        
        Conexao::desconexao();
        
        return $linha;
    }
    
    public function ultimoAluno(){
        
        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT MAX(codAluno) FROM tbaluno");
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        return $linha;
    }
    
    public function pesqAlunoPorCodigo($cod){
        
        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT nomeAluno FROM tbaluno WHERE codAluno = :codigo");
        $consulta->bindValue(":codigo", $cod);
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        return $linha;
        
    }
    public function AlunoAgendaPorCodigo($codAgenda){

        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT codAluno FROM tbagenda
                                    WHERE codAgenda = :codAgenda");
        $consulta->bindValue(":codAgenda", $codAgenda);
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        
        return $linha;
        
    }

        public function AgendaAlunoPorCodigo($codaluno){
        
        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT codAgenda FROM tbagenda
                                    WHERE codAluno = :codigo");
        $consulta->bindValue(":codigo", $codaluno);
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        return $linha;
        
    }
    
    #################################################################
    ################## Relatórios do Aluno ##########################
    #################################################################

    public function relatorioGeralAluno() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno, dataCadastroAluno FROM tbaluno");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $aluno = new Aluno();
               $aluno->setCodigo($linha['codAluno']);
               $aluno->setNome($linha['nomeAluno']);
               $aluno->setRg($linha['rgAluno']);
               $aluno->setCidade($linha['cidadeAluno']);
               $aluno->setLogradouro($linha['logradouroAluno']);
               $aluno->setNumcasa($linha['numCasaAluno']);
               $aluno->setDatanascimento($linha['dataNascAluno']);
               $aluno->setCep($linha['cepAluno']);
               $aluno->setComplemento($linha['complementoAluno']);
               $aluno->setNacionalidade($linha['nacionalidadeAluno']);
               $aluno->setSexo($linha['sexoAluno']);
               $aluno->setCor($linha['corRacaAluno']);
               $aluno->setCertidao($linha['certidaoNascimentoAluno']);
               $aluno->setBairro($linha['bairroAluno']);
               
               

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroAluno']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $aluno->setDatacadastro($dataCadastro);

               $lista->append($aluno);
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
    
    public function relatorioEspecificoAluno(&$aluno) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codAluno, nomeAluno, dataNascAluno, nacionalidadeAluno, sexoAluno, corRacaAluno, rgAluno, certidaoNascimentoAluno, logradouroAluno, numCasaAluno, complementoAluno, cepAluno, bairroAluno, cidadeAluno, dataCadastroAluno FROM tbaluno WHERE codAluno = :cod");
           $cmd->bindValue(":cod", $aluno->getCodigo(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $aluno->setCodigo($linha['codAluno']);
               $aluno->setNome($linha['nomeAluno']);
               $aluno->setRg($linha['rgAluno']);
               $aluno->setCidade($linha['cidadeAluno']);
               $aluno->setLogradouro($linha['logradouroAluno']);
               $aluno->setNumcasa($linha['numCasaAluno']);
               $aluno->setDatanascimento($linha['dataNascAluno']);
               $aluno->setCep($linha['cepAluno']);
               $aluno->setComplemento($linha['complementoAluno']);
               $aluno->setNacionalidade($linha['nacionalidadeAluno']);
               $aluno->setSexo($linha['sexoAluno']);
               $aluno->setCor($linha['corRacaAluno']);
               $aluno->setCertidao($linha['certidaoNascimentoAluno']);
               $aluno->setBairro($linha['bairroAluno']);
               
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroAluno']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $aluno->setDatacadastro($dataCadastro);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }


    
}
