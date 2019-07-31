<?php 

    include_once("Conexao.php");
    include_once("../Model/Funcionario.php");
/**
 * Description of FuncionarioDAO
 *
 * @author laris
 */
class FuncionarioDAO {
      //Classe DAO do funcionario
    
    public function CadastrarFuncionario($obj){
        
        //instanciando a classe funcionario para passar o objeto recebido por parametro
        $func = new Funcionario();
        $func = $obj;
        
        
        //passando os dados do objeto para as variaveis
        
                $nome = $func->getNome();
                $rg = $func->getRg();
                $cpf = $func->getCpf();
                $logradouro = $func->getLogradouro();
                $complemento = $func->getComplemento();
                $numcasa = $func->getNumcasa();
                $cep = $func->getCep();
                $cidade = $func->getCidade();
                $cargo = $func->getCargos();
                $user = $func->getUsuario();
                $email = $func->getEmail();
        //abrir a conexao com o banco de dados
                
                $db = Conexao::conexao();
                
        //inserir os dados no banco de dados
                
                $inseredados=$db->prepare("INSERT INTO tbfuncionario (nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario, cepFuncionario, cidadeFuncionario, emailFuncionario, codUsuario) VALUES (:nome, :rg, :cpf, :logradouro, :complemento, :numcasa, :cep, :cidade, :email, :user)");
                $inseredados->bindValue(':nome', $nome, PDO::PARAM_STR);
                $inseredados->bindValue(':rg', $rg, PDO::PARAM_STR);
                $inseredados->bindValue(':cpf', $cpf, PDO::PARAM_STR);
                $inseredados->bindValue(':logradouro', $logradouro, PDO::PARAM_STR);
                $inseredados->bindValue(':complemento', $complemento, PDO::PARAM_STR);
                $inseredados->bindValue(':numcasa', $numcasa, PDO::PARAM_STR);
                $inseredados->bindValue(':cep', $cep, PDO::PARAM_STR);
                $inseredados->bindValue(':cidade', $cidade, PDO::PARAM_STR);
                $inseredados->bindValue(':email', $email, PDO::PARAM_STR);
                $inseredados->bindValue(':user', $user,PDO::PARAM_INT);
        
                // Valida o cadastro
       $validar = $db->prepare("SELECT nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario, cepFuncionario, cidadeFuncionario, codUsuario FROM tbfuncionario WHERE nomeFuncionario = :nome AND rgFuncionario = :rg AND cpfFuncionario = :cpf AND logradouroFuncionario = :logra AND complementoFuncionario = :complemento AND numCasaFuncionario = :ncasa AND cepFuncionario = :cep AND cidadeFuncionario = :cidade AND emailFuncionario = :email AND codUsuario = :cod");
       $validar->bindValue(":nome", $nome);
       $validar->bindValue(":rg", $rg);
       $validar->bindValue(":cpf", $cpf);
       $validar->bindValue(":logra", $logradouro);
       $validar->bindValue(":complemento", $complemento);
       $validar->bindValue(":ncasa", $numcasa);
       $validar->bindValue(":cep", $cep);
       $validar->bindValue(":cidade", $cidade);
       $validar->bindValue(":email", $email);
       $validar->bindValue(":cod", $user);
       
        
       $validar->execute();
       
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $inseredados->execute();

           //fazer select MAX do funcionario
                $ultimofunc = "SELECT MAX(codFuncionario) FROM tbfuncionario";
                $linha = $db->prepare($ultimofunc);
                $linha->execute();
                $ultimo = $linha->fetchColumn();
                
               
                foreach ($cargo as $lista){
                $inserecargos=$db->prepare("INSERT INTO tbfuncionariocargo (codCargo, codFuncionario) VALUES (:cargo, :funcionario)");
                $inserecargos->bindValue(':cargo', $lista);
                $inserecargos->bindValue(':funcionario', $ultimo);
                $inserecargos->execute();
                }
           return true;
       }else{
           return false;
       }
                
        //fechando a conexao
                
                Conexao::desconexao();
                
        
        
    }
    
    public function MostrarFuncionario(){
        
        $func = 0;
        $db = Conexao::conexao();

       //Paginação
       $i = 1;
       $listarfunc_pg=$db->prepare("SELECT codFuncionario, nomeFuncionario, logradouroFuncionario, complementoFuncionario, cepFuncionario, cidadeFuncionario, rgFuncionario, cpfFuncionario, numCasaFuncionario, emailFuncionario FROM tbfuncionario");
       $listarfunc_pg->execute();

       $count = $listarfunc_pg->rowCount();
       $calculo = ceil(($count/8));

             Conexao::desconexao();

         $url = 0;
         $mody =0;
         if (isset($_GET['pageFunc']) == $i) {
         $url= $_GET['pageFunc'];
         $mody = ($url*8)-8;
     }
     //Paginação
        $listarfunc=$db->prepare("SELECT codFuncionario, nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario,cepFuncionario, cidadeFuncionario, emailFuncionario FROM tbFuncionario LIMIT 8 OFFSET {$mody}");
        $listarfunc->execute();
        
        $listafuncionario =  Array();
        
        
        
         $linha = $listarfunc->fetchAll(PDO::FETCH_OBJ);
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $func = new Funcionario;
            $func->setCodigo($listar->codFuncionario);
            $func->setNome($listar->nomeFuncionario);
            $func->setCidade($listar->cidadeFuncionario);
            $func->setRg($listar->rgFuncionario);
            $func->setCpf($listar->cpfFuncionario);
            $func->setLogradouro($listar->logradouroFuncionario);
            $func->setComplemento($listar->complementoFuncionario);
            $func->setNumcasa($listar->numCasaFuncionario);
            $func->setCep($listar->cepFuncionario);
            $func->setEmail($listar->emailFuncionario);
            
            
            $listafuncionario[] = $func;
       }
       
       Conexao::desconexao();
       
       return $listafuncionario;
       
       
        
    }
    
    public function ExcluirFunc($cod){
        
        
        $resposta = "";
        $func = 0;
        $db = Conexao::conexao();
        
        

        $consulta=$db->prepare("select codUsuario from tbfuncionario where codFuncionario = :cod");
        $consulta->bindValue(':cod', $cod, PDO::PARAM_INT);
        $consulta->execute();
        $coduser = $consulta->fetchColumn();
        
        $c=$db->prepare("SELECT codProfessorTurma from tbprofessorturma WHERE codUsuario = :cod");
        $c->bindValue(':cod', $coduser, PDO::PARAM_INT);
        $c->execute();
        
        if($c->rowCount() > 0){
            $resposta = "Esse professor está cadastrado em uma turma";
            return $resposta;
        }else{
            
        $excluir=$db->prepare("delete from tbUsuario where codUsuario = :cod");
        $excluir->bindValue(':cod', $coduser, PDO::PARAM_INT);
        $excluir->execute();

        if($excluir->rowCount() > 0){

 
             $excluircargofunc=$db->prepare("DELETE FROM tbfuncionariocargo WHERE codFuncionario = :cod");
        $excluircargofunc->bindValue(':cod', $cod, PDO::PARAM_INT);
        $excluircargofunc->execute();

        if($excluir->rowCount() > 0){

                $excluirfunc=$db->prepare("DELETE FROM tbfuncionario WHERE codFuncionario = :codigo");
        $excluirfunc->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $excluirfunc->execute();
        
        if($excluirfunc->rowCount() == 1){
            $resposta = "true";
            return $resposta;
        }
              
            else{
              $resposta = "false";
              return $resposta;  
            }

        }

        }}
        
     
        
        
        Conexao::desconexao();
        
    }
    
    public function ConsultarDadosFuncionario($cod){
        
        $func = 0;
        $db = Conexao::conexao();
        $consultarfunc=$db->prepare("SELECT codFuncionario, nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario, cepFuncionario, cidadeFuncionario, emailFuncionario FROM tbFuncionario WHERE codFuncionario = :codigo");
        $consultarfunc->bindValue(':codigo', $cod, PDO::PARAM_INT);
        
        $consultarfunc->execute();
        
        
          $funcionario =  Array();
        
        
        
         $linha = $consultarfunc->fetchAll(PDO::FETCH_OBJ);
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $func = new Funcionario;
            $func->setCodigo($listar->codFuncionario);
            $func->setNome($listar->nomeFuncionario);
            $func->setRg($listar->rgFuncionario);
            $func->setCpf($listar->cpfFuncionario);
            $func->setLogradouro($listar->logradouroFuncionario);
            $func->setComplemento($listar->complementoFuncionario);
            $func->setNumcasa($listar->numCasaFuncionario);
            $func->setCep($listar->cepFuncionario);
            $func->setCidade($listar->cidadeFuncionario);
            $func->setEmail($listar->emailFuncionario);
            
            
            $funcionario[] = $func;
       }
       
       Conexao::desconexao();
       
       return $funcionario;
        
        
       
    }

    public function ConsultarDadosFuncionarioUsuario($cod){
        
        $func = 0;
        $db = Conexao::conexao();
        $consultarfunc=$db->prepare("SELECT codFuncionario, nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario, cepFuncionario, cidadeFuncionario, emailFuncionario FROM tbFuncionario WHERE codUsuario = :codigo");
        $consultarfunc->bindValue(':codigo', $cod, PDO::PARAM_INT);
        
        $consultarfunc->execute();
        
        
          $funcionario =  Array();
        
        
        
         $linha = $consultarfunc->fetchAll(PDO::FETCH_OBJ);
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
             
            $func = new Funcionario;
            $func->setCodigo($listar->codFuncionario);
            $func->setNome($listar->nomeFuncionario);
            $func->setRg($listar->rgFuncionario);
            $func->setCpf($listar->cpfFuncionario);
            $func->setLogradouro($listar->logradouroFuncionario);
            $func->setComplemento($listar->complementoFuncionario);
            $func->setNumcasa($listar->numCasaFuncionario);
            $func->setCep($listar->cepFuncionario);
            $func->setCidade($listar->cidadeFuncionario);
            $func->setEmail($listar->emailFuncionario);
            
            
            $funcionario[] = $func;
       }
       
       Conexao::desconexao();
       
       return $funcionario;
        
        
       
    }
    
    public function EditarFuncionario($obj){
        $func = 0;
        $db = Conexao::conexao();
        
        $f = new Funcionario();
        $f = $obj;
        $id = $f->getCodigo();
        $nome = $f->getNome();
        $rg = $f->getRg();
        $cpf = $f->getCpf();
        $logradouro = $f->getLogradouro();
        $complemento = $f->getComplemento();
        $numcasa = $f->getNumcasa();
        $cep = $f->getCep();
        $cidade = $f->getCidade();
        $email = $f->getEmail();
        $cargos = $f->getCargos();
        
        $excluircargos=$db->prepare("DELETE from tbfuncionariocargo WHERE codFuncionario = :codfunc");
        $excluircargos->bindValue(":codfunc", $id);
        $excluircargos->execute();
        
        foreach ($cargos as $lista){
                $inserecargos=$db->prepare("INSERT INTO tbfuncionariocargo (codCargo, codFuncionario) VALUES (:cargo, :funcionario)");
                $inserecargos->bindValue(':cargo', $lista);
                $inserecargos->bindValue(':funcionario', $id);
                $inserecargos->execute();
                }
        
        
        $editadados=$db->prepare("UPDATE tbfuncionario SET nomeFuncionario= :nomefunc, rgFuncionario= :rgfunc, cpfFuncionario= :cpffunc, logradouroFuncionario= :logradourofunc, complementoFuncionario= :complementofunc, numCasaFuncionario= :numcasafunc, cepFuncionario= :cepfunc, cidadeFuncionario= :cidadefunc, emailFuncionario = :email WHERE codFuncionario = :idfunc");
        
        $editadados->bindValue(':idfunc', $id);
        $editadados->bindValue(':nomefunc', $nome);
        $editadados->bindValue(':rgfunc', $rg);
        $editadados->bindValue(':cpffunc', $cpf);
        $editadados->bindValue(':logradourofunc', $logradouro);
        $editadados->bindValue(':complementofunc', $complemento);
        $editadados->bindValue(':numcasafunc', $numcasa);
        $editadados->bindValue(':cepfunc', $cep);
        $editadados->bindValue(':cidadefunc', $cidade);
        $editadados->bindValue(':email', $email);
        $editadados->execute();
        
       
       if($editadados->rowCount() > 0){
           // Executa o Cadastro
           
           return true;
       }else{
           return false;
       }
        Conexao::desconexao();
    }
    
    public function buscarCargoFuncionario($cod){
        
        $listacargos = array();
        $db= Conexao::conexao();
        
        $buscarcargo=$db->prepare("SELECT nomeCargo FROM tbcargo
INNER JOIN tbfuncionariocargo
ON tbcargo.codCargo = tbfuncionariocargo.codCargo WHERE codFuncionario = :codigo");
        $buscarcargo->bindValue(":codigo", $cod);
        $buscarcargo->execute();
        $linha = $buscarcargo->fetchAll(PDO::FETCH_COLUMN);
        
        //foreach($linha as $lin){
            //$listacargos[] = $lin('nomeCargo');
        //}
        
        Conexao::desconexao();
        
        return $linha;
  
    }
    
    #################################################################
    ################## Relatórios do Funcionário ####################
    #################################################################

    public function relatorioGeralFuncionario() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codFuncionario, nomeFuncionario, logradouroFuncionario, complementoFuncionario, cepFuncionario, cidadeFuncionario, rgFuncionario, cpfFuncionario, numCasaFuncionario, dataCadastroFuncionario, emailFuncionario FROM tbfuncionario");
           
           // Cria uma lista para armazenar todos os periodos
           $lista = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $func = new Funcionario();
               $func->setCodigo($linha['codFuncionario']);
               $func->setNome($linha['nomeFuncionario']);
               $func->setLogradouro($linha['logradouroFuncionario']);
               $func->setComplemento($linha['complementoFuncionario']);
               $func->setCep($linha['cepFuncionario']);
               $func->setCidade($linha['cidadeFuncionario']);
               $func->setRg($linha['rgFuncionario']);
               $func->setCpf($linha['cpfFuncionario']);
               $func->setNumcasa($linha['numCasaFuncionario']);
               $func->setEmail($linha['emailFuncionario']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroFuncionario']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $func->setDatacadastro($dataCadastro);

               $lista->append($func);
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
    
    public function relatorioEspecificoFuncionario(&$func) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
           $cmd = $pdo->prepare("SELECT codFuncionario, nomeFuncionario, logradouroFuncionario, complementoFuncionario, cepFuncionario, cidadeFuncionario, rgFuncionario, cpfFuncionario, numCasaFuncionario, dataCadastroFuncionario, emailFuncionario FROM tbfuncionario
                              WHERE codFuncionario = :cod");
           $cmd->bindValue(":cod", $func->getCodigo(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $func->setCodigo($linha['codFuncionario']);
               $func->setNome($linha['nomeFuncionario']);
               $func->setLogradouro($linha['logradouroFuncionario']);
               $func->setComplemento($linha['complementoFuncionario']);
               $func->setCep($linha['cepFuncionario']);
               $func->setCidade($linha['cidadeFuncionario']);
               $func->setRg($linha['rgFuncionario']);
               $func->setCpf($linha['cpfFuncionario']);
               $func->setNumcasa($linha['numCasaFuncionario']);
               $func->setEmail($linha['emailFuncionario']); 
               
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroFuncionario']));
               $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
               $func->setDatacadastro($dataCadastro);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }
    
    
    
}
