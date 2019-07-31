<?php
include_once("Conexao.php");
include_once("..\Model\Usuario.php");
include_once("..\Model\TipoUsuario.php");
include_once("..\Model\Criptografia.php");
include_once("..\Model\Aluno.php");
include_once("..\Model\Rotina.php");
include_once("..\Model\Turma.php");
include_once("..\Model\Card.php");
include_once("..\Model\Alternativa.php");
include_once("..\Model\Ocorrencia.php");

/**
 * Description of DaoUsuario
 *
 * @author hansel
 */

class DaoUsuario {
    
    public function cadastrarUsuario($novoUsuario){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       $nomeUsuario = $novoUsuario->getNome();
       $loginUsuario = $novoUsuario->getLogin();
       $senhaUsuario = $novoUsuario->getSenha();
       $codTipoUsuario = $novoUsuario->tipoUsuario->getId();

       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbusuario(nomeUsuario, loginUsuario, senhaUsuario, codTipoUsuario) "
               . "VALUES (:nomeUsuario, :loginUsuario, :senhaUsuario, :codTipoUsuario)");
       $cmd->bindValue(":nomeUsuario", $nomeUsuario, PDO::PARAM_STR);
       $cmd->bindValue(":loginUsuario", $loginUsuario, PDO::PARAM_STR);
       $cmd->bindValue(":senhaUsuario", $senhaUsuario, PDO::PARAM_STR);
       $cmd->bindValue(":codTipoUsuario", $codTipoUsuario, PDO::PARAM_INT);
       $cmd->execute();
       // Valida o cadastro
       //$validar = $pdo->prepare("SELECT nomeUsuario FROM tbusuario WHERE nomeUsuario = ?");
       //$validar->execute(array($nomeUsuario));
       if($cmd->rowCount() > 0){
           // Executa o Cadastro
           
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    
    public function consultarUsuario(){
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

           //Paginação
       $db = Conexao::conexao();
       $i = 1;
       $listaruser_pg=$db->prepare("SELECT codUsuario, nomeUsuario, loginUsuario, codTipoUsuario FROM tbusuario");
       $listaruser_pg->execute();

       $count = $listaruser_pg->rowCount();
       $calculo = ceil(($count/8));
      

         $url = 0;
         $mody =0;
         if (isset($_GET['pageUser']) == $i) {
         $url= $_GET['pageUser'];
         $mody = ($url*8)-8;
     }




             Conexao::desconexao();
     //Paginação


       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codUsuario, nomeUsuario, loginUsuario, descTipoUsuario FROM tbusuario
                              INNER JOIN tbtipousuario
                              ON tbusuario.codTipoUsuario = tbtipousuario.codTipoUsuario LIMIT 8 OFFSET {$mody}");
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as turmas
       $listaUsuarios = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'usuario' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $tipoUsuario = new TipoUsuario();

           $tipoUsuario->setDescricao($linha['descTipoUsuario']);

           $usuario = new Usuario();

           $usuario->setId($linha['codUsuario']);
           $usuario->setNome($linha['nomeUsuario']);
           $usuario->setLogin($linha['loginUsuario']);
           //$usuario->setSenha($linha['senhaUsuario']);
           $usuario->addTipoUsuario($tipoUsuario);

           $listaUsuarios->append($usuario);
       }
       Conexao::desconexao();
       // Retorna a lista completa com os usuários
       return $listaUsuarios;
    }

        public function verificaEmail($email){
      $pdo = Conexao::conexao();
      $linha = "";
      $consulta=$pdo->prepare("select codUsuario from tbfuncionario where emailFuncionario = :email");
      $consulta->bindValue(":email", $email, PDO::PARAM_STR);
      $consulta->execute();

      if($consulta->rowCount() > 0){
        $linha = $consulta->fetchColumn();
        return $linha;

      }else{

        $consulta2=$pdo->prepare("select codUsuario from tbresponsavel where emailResponsavel = :email");
        $consulta2->bindValue(":email", $email, PDO::PARAM_STR);
        $consulta2->execute();

        if($consulta2->rowCount() > 0){
          $linha = $consulta2->fetchColumn();
          return $linha;
        }else{

          $linha = "false";
          return $linha;
        }


      }


        Conexao::desconexao();


    }
    
    public function consultarUsuarioProfessor(){
        $pdo = Conexao::conexao();
        
        $cmd = $pdo->prepare("SELECT codUsuario, nomeUsuario FROM tbusuario WHERE codTipoUsuario = 12");
        $cmd->execute();
        $listaUsuarios = new ArrayObject();
        
        while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){

           $usuario = new Usuario();

           $usuario->setId($linha['codUsuario']);
           $usuario->setNome($linha['nomeUsuario']);

           $listaUsuarios->append($usuario);
       }
        
        Conexao::desconexao();
       return $listaUsuarios;

    }
    
    public function editarUsuario($editarUsuario){

        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try{
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbusuario SET nomeUsuario = :nomeUsuario, loginUsuario = :loginUsuario, senhaUsuario = :senhaUsuario, codTipoUsuario = :codTipoUsuario
                                  WHERE codUsuario = :codUsuario");

            // Substitui os valores
            $cmd->bindValue(":codUsuario", $editarUsuario->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":nomeUsuario", $editarUsuario->getNome(), PDO::PARAM_STR);
            $cmd->bindValue(":loginUsuario", $editarUsuario->getLogin(), PDO::PARAM_STR);
            $cmd->bindValue(":senhaUsuario", $editarUsuario->getSenha(), PDO::PARAM_STR);
            $cmd->bindValue(":codTipoUsuario", $editarUsuario->tipoUsuario->getId(), PDO::PARAM_INT);

             // Valida o cadastro
       $validar = $pdo->prepare("SELECT nomeUsuario FROM tbusuario WHERE nomeUsuario = :nome AND loginUsuario = :login AND senhaUsuario = :senha AND codTipoUsuario = :codtipo");
       $validar->bindValue("nome", $editarUsuario->getNome() );
       $validar->bindValue("login", $editarUsuario->getLogin());
       $validar->bindValue("senha", $editarUsuario->getSenha());
       $validar->bindValue("codtipo", $editarUsuario->tipoUsuario->getId());
       $validar->execute();
        
       if($validar->rowCount() == 0){
           $cmd->execute();
           return true;
       }else{
           return false;
       }
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        } 

        Conexao::desconexao();
          
    }
    public function excluirUsuario($excluirUsuario){
        
        $codUsuario = $excluirUsuario->getId();
        $resposta = "";
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try { 

          $validar = $pdo->prepare("select codFuncionario from tbfuncionario where codUsuario = :codUsuario");
          $validar->bindValue(":codUsuario", $codUsuario, PDO::PARAM_INT);
          $validar->execute();

          if($validar->rowCount() > 0){
            $resposta = "Existe um funcionário cadastrado com este usuário";
            return $resposta;

          }else {

            $verificar = $pdo->prepare("select codResponsavel from tbresponsavel where codUsuario = :codUsuario");
            $verificar->bindValue(":codUsuario", $codUsuario, PDO::PARAM_INT);
            $verificar->execute();

            if($verificar->rowCount() > 0){
              $resposta = "Existe um responsável cadastrado com este usuário";
              return $resposta;
              
            }else{ 


            $cmd = $pdo->prepare("DELETE FROM tbusuario WHERE codUsuario = :codUsuario");
            $cmd->bindValue(":codUsuario", $codUsuario, PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1){
              $resposta = "true";
              return $resposta;

            }else{

              $resposta = "false";
              return $resposta;
            }

            }
          }
            
          
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } 

        Conexao::desconexao();
        
    }

        public function editarSenha($codUsuario, $senha){
        
        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();

        try {
            
            $cmd = $pdo->prepare("UPDATE tbusuario SET senhaUsuario = :senha WHERE codUsuario = :codUsuario");  
            $cmd->bindValue(":senha", $senha, PDO::PARAM_STR);
            $cmd->bindValue(":codUsuario", $codUsuario, PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() < 0): 
              return true;
            else: 
              return false; 
            endif;
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } 

        Conexao::desconexao();
        
    }



    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherUsuario(&$usuario){ // '&' representa uma Passagem por Referência
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try{

           // Busca os dados do usuario no banco de dados
           $cmd = $pdo->prepare("SELECT nomeUsuario, loginUsuario, senhaUsuario, descTipoUsuario FROM tbusuario
                              INNER JOIN tbtipousuario
                              ON tbusuario.codTipoUsuario = tbtipousuario.codTipoUsuario
                              WHERE codUsuario = :codUsuario");

           // Substitui os valores
           $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
           
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);
                $criptografia = new Criptografia();
  
                $usuario->setNome($linha->nomeUsuario);
                $usuario->setLogin($linha->loginUsuario);
                $usuario->setSenha($criptografia->decode($linha->senhaUsuario));
                //$usuario->tipoUsuario->setDescricao($linha->descTipoUsuario);

                // Não é necessário um 'return' pois o objeto será alterado automaticamente
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       }

       Conexao::desconexao();
       
    }


    public function logar(&$user, $flag){

      $usuario = new Usuario();
      $usuario = $user;
       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try{
          // Verifica o usuário
          $verificar = $pdo->prepare("SELECT codUsuario FROM tbusuario 
                                    WHERE loginUsuario = :loginUsuario and 
                                    senhaUsuario = :senhaUsuario and codTipoUsuario = :codTipoUsuario");
          
          $verificar->bindValue(":loginUsuario", $usuario->getLogin(), PDO::PARAM_STR);
          $verificar->bindValue(":senhaUsuario", $usuario->getSenha(), PDO::PARAM_STR);
          $verificar->bindValue(":codTipoUsuario", $usuario->tipoUsuario->getId(), PDO::PARAM_INT);
          

          if($verificar->execute())
          {    

            $linha = $verificar->fetch(PDO::FETCH_OBJ);
            $usuario->setId($linha->codUsuario);
          
          //var_dump($usuario);
 
            if($verificar->rowCount() == 1){
                $cmd = $pdo->prepare("SELECT codUsuario, nomeUsuario, loginUsuario, codTipoUsuario FROM tbusuario
                                      WHERE codUsuario = :codUsuario");
               
                $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
                $tipoUsuario = new TipoUsuario();
                $usuario->addTipoUsuario($tipoUsuario);
                if($cmd->execute()):
                  $linha = $cmd->fetch(PDO::FETCH_OBJ);
                  $usuario->setId($linha->codUsuario);
                  $usuario->setNome(strval($linha->nomeUsuario));
                  $usuario->setLogin(strval($linha->loginUsuario));
                  $usuario->tipoUsuario->setId($linha->codTipoUsuario);
                endif;

                return $usuario;
            }else{
                return false;
            }
          }
          else
          {
            return "Login ou senha incorretos...";
          }
      } catch (PDOException $e){
           echo $e->getMessage();
      }
      
      Conexao::desconexao();
      
    }
    
    public function ultimoUsuario(){
      $pdo = Conexao::conexao();
      $consulta=$pdo->prepare("SELECT MAX(codUsuario) FROM tbusuario");
      $consulta->execute();
      $resultado = $consulta->fetchColumn();
      
      Conexao::desconexao();
    
      return $resultado;
    
    }

       public function descUsuario($cod){
      $pdo = Conexao::conexao();
      $consulta=$pdo->prepare("SELECT descTipoUsuario FROM tbusuario INNER JOIN tbtipousuario ON tbusuario.codTipoUsuario = tbtipousuario.codTipoUsuario WHERE codUsuario = :cod");
      $consulta->bindValue(":cod", $cod);
      $consulta->execute();
      $resultado = $consulta->fetchColumn();
      
      Conexao::desconexao();
    
      return $resultado;
    
    }
    
    public function dadosUltimoUsuario(){
        $usuario = new Usuario();
        $criptografia = new Criptografia();
        
        $pdo = Conexao::conexao();
        $consulta=$pdo->prepare("SELECT loginUsuario, senhaUsuario FROM tbusuario WHERE codUsuario = (SELECT MAX(codUsuario) FROM tbusuario)");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
        
        foreach($resultado as $obj){
            $usuario->setLogin($obj->loginUsuario);
            $usuario->setSenha($criptografia->decode($obj->senhaUsuario));
            
        }
        
        Conexao::desconexao();
        
        return $usuario;
        
    }
    
    public function consultarFilhosResponsavel(&$usuario){
        $listaCriancas = new ArrayObject();
        $pdo = Conexao::conexao();

                //PAGINAÇÃO//
                   $i = 1;
                   $listaraluno_pg=$pdo->prepare("SELECT nomeAluno, codAluno, dataNascAluno, logradouroAluno, complementoAluno,cepAluno, cidadeAluno, rgAluno, numCasaAluno FROM tbaluno  INNER JOIN tbresponsavel
                                        ON tbaluno.codResponsavel = tbresponsavel.codResponsavel 
                                            WHERE codUsuario = :cod");
                   
                   $listaraluno_pg->bindValue(":cod", $usuario->getId());
                   $listaraluno_pg->execute();

                      $count = $listaraluno_pg->rowCount();
                      $calculo = ceil(($count/2));

                        while ($i <= $calculo) {
                            $i++;
                        }

                      
                             $_POST['calculoFilhos'] = $calculo;

                             $url = 0;
                             $mody =0;
                              if (isset($_GET['pageFilhos']) == $i) {
                                       $url= $_GET['pageFilhos'];
                                       $mody = ($url*2)-2;
                                                                   }
                //PAGINAÇÃO//
    

        $consulta=$pdo->prepare("SELECT nomeAluno, codAluno, dataNascAluno, logradouroAluno, complementoAluno,cepAluno, cidadeAluno, rgAluno, numCasaAluno, fotoAluno FROM tbaluno
                                    INNER JOIN tbresponsavel
                                        ON tbaluno.codResponsavel = tbresponsavel.codResponsavel 
                                            WHERE codUsuario = :cod LIMIT 2 OFFSET $mody");
        $consulta->bindValue(":cod", $usuario->getId());
        //$consulta->bindValue(":inicio", $inicio, PDO::PARAM_INT);
        //$consulta->bindValue(":qtd", $qtd, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
        
        foreach($resultado as $obj){
            $aluno = new Aluno();
            $aluno->setNome($obj->nomeAluno);
            $aluno->setCodigo($obj->codAluno);
            $aluno->setDatanascimento($obj->dataNascAluno);
            $aluno->setLogradouro($obj->logradouroAluno);
            $aluno->setComplemento($obj->complementoAluno);
            $aluno->setCep($obj->cepAluno);
            $aluno->setCidade($obj->cidadeAluno);
            $aluno->setRg($obj->rgAluno);
            $aluno->setNumcasa($obj->numCasaAluno);
            $aluno->setFoto($obj->fotoAluno);
            
            $listaCriancas->append($aluno);
            
        }
        
        
        
        Conexao::desconexao();
        
        return $listaCriancas;
    }

    public function consultarRotinasCriancaResponsavel($agenda){

      $pdo = Conexao::conexao();

           //PAGINAÇÃO//
                   $i = 1;
                   $listarrotina_pg=$pdo->prepare("SELECT codRotina, descRotina, codTurma, dataCadastroRotina FROM tbrotina  WHERE codAgenda = :codAgenda ");
                   
                   $listarrotina_pg->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
                   $listarrotina_pg->execute();

                      $count = $listarrotina_pg->rowCount();
                      $calculo = ceil(($count/4));

                        while ($i <= $calculo) {
                            $i++;
                        }

                      
                             $_POST['calculoRotinas'] = $calculo;

                             $url = 0;
                             $mody =0;
                              if (isset($_GET['pageRotina']) == $i) {
                                       $url= $_GET['pageRotina'];
                                       $mody = ($url*4)-4;
                                                                   }
                //PAGINAÇÃO//
       
       try {

          $cmd = $pdo->prepare("SELECT codRotina, descRotina, codTurma, dataCadastroRotina FROM tbrotina
                                WHERE codAgenda = :codAgenda LIMIT 4 OFFSET $mody");
          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
          //$cmd->bindValue(":inicio", $inicio, PDO::PARAM_INT);
          //$cmd->bindValue(":qtd", $qtd, PDO::PARAM_INT);

          $listaRotinas = new ArrayObject();

          if($cmd->execute()){
             while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
              
               $rotina = new Rotina();
               $rotina->setId(intval($linha['codRotina']));
               $rotina->setDescricao($linha['descRotina']);
               $rotina->setDataCadastro($linha['dataCadastroRotina']);
               
               $turma = new Turma();
               $turma->setId(intval($linha['codTurma']));
               
               $cmdTurma = $pdo->prepare("SELECT nomeTurma FROM tbturma WHERE codTurma = :codTurma");
               $cmdTurma->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);
               $cmdTurma->execute();
               $turma->setDescricao($cmdTurma->fetch(PDO::FETCH_COLUMN));
               
               $rotina->addTurma($turma);

               $cmd2 = $pdo->prepare("SELECT codCard FROM tbcardrotina
                                WHERE codRotina = :codRotina");

               $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               if($cmd2->execute()){
                  while($linha = $cmd2->fetch(PDO::FETCH_ASSOC)){
                    $card = new Card();
                    $card->setId(intval($linha['codCard']));
                
                    $cmdCard = $pdo->prepare("SELECT descCard FROM tbcard WHERE codCard = :codCard");
                    $cmdCard->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                    $cmdCard->execute();
                    $card->setDescricao($cmdCard->fetch(PDO::FETCH_COLUMN));  

                    $cmd3 = $pdo->prepare("SELECT codAlternativa FROM tbalternativacard
                                WHERE codCard = :codCard and codRotina = :codRotina");
                    $cmd3->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                    $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                    if($cmd3->execute()){   
                      $codAlternativa = $cmd3->fetch(PDO::FETCH_COLUMN);
                      $alternativa = new Alternativa();
                      $alternativa->setId(intval($codAlternativa));
                      
                      $cmdAlternativa = $pdo->prepare("SELECT descAlternativa FROM tbalternativa WHERE codAlternativa = :codAlternativa");
                      $cmdAlternativa->bindValue(":codAlternativa", $alternativa->getId(), PDO::PARAM_INT);
                      $cmdAlternativa->execute();
                      $alternativa->setDescricao($cmdAlternativa->fetch(PDO::FETCH_COLUMN));  
                    
                      $card->addAlternativa($alternativa);
                    }
                    
                    $rotina->addCard($card);
                  } 
                  // continuar a fazer o select para obeter as alternativas do card
                  // não esquecer de colocar o 'codRotina' na tabela 'tbalternativacard'
                  // para assim obter as alternativas específicas da rotina para com os cards 
               }

               $cmd4 = $pdo->prepare("SELECT codOcorrencia FROM tbocorrenciarotina
                                WHERE codRotina = :codRotina");
               $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               if($cmd4->execute()){
                  if($cmd4->rowCount() > 0){
                    while($linha = $cmd4->fetch(PDO::FETCH_ASSOC)){
                      $ocorrencia = new Ocorrencia();
                      $ocorrencia->setId(intval($linha['codOcorrencia']));

                      $cmdOcorrencia = $pdo->prepare("SELECT descOcorrencia FROM tbocorrencia WHERE codOcorrencia = :codOcorrencia");
                      $cmdOcorrencia->bindValue(":codOcorrencia", $ocorrencia->getId(), PDO::PARAM_INT);
                      $cmdOcorrencia->execute();
                      $ocorrencia->setDescricao($cmdOcorrencia->fetch(PDO::FETCH_COLUMN));  
                      
                      $rotina->addOcorrencia($ocorrencia);
                    } 
                  }
               }

               $listaRotinas->append($rotina);
             }
          }

          return $listaRotinas;

       } catch (PDOException $e) {
          echo $e->getMessage();
       }

       Conexao::desconexao();
    }
         

      public function consultarRotinaEspecificaCrianca($agenda, &$rotina){

      $pdo = Conexao::conexao();
       
       try {

          $cmd = $pdo->prepare("SELECT codRotina, codTurma, codUsuario, dataCadastroRotina FROM tbrotina
                                WHERE codAgenda = :codAgenda AND codRotina = :codRotina");
          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
          $cmd->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
          //$cmd->bindValue(":inicio", $inicio, PDO::PARAM_INT);
          //$cmd->bindValue(":qtd", $qtd, PDO::PARAM_INT);

          if($cmd->execute()){
             
             $linha = $cmd->fetch(PDO::FETCH_ASSOC);
            
             $rotina->setId(intval($linha['codRotina']));
             $rotina->setDataCadastro($linha['dataCadastroRotina']);
             
             $usuario = new Usuario();
             $usuario->setId(intval($linha['codUsuario']));

             $cmdUsuario = $pdo->prepare("SELECT nomeUsuario FROM tbusuario WHERE codUsuario = :codUsuario");
             $cmdUsuario->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
             $cmdUsuario->execute();
             $usuario->setNome($cmdUsuario->fetch(PDO::FETCH_COLUMN));
             
             $rotina->addProfessor($usuario);

             $turma = new Turma();
             $turma->setId(intval($linha['codTurma']));
             
             $cmdTurma = $pdo->prepare("SELECT nomeTurma FROM tbturma WHERE codTurma = :codTurma");
             $cmdTurma->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);
             $cmdTurma->execute();
             $turma->setDescricao($cmdTurma->fetch(PDO::FETCH_COLUMN));
             
             $rotina->addTurma($turma);
             
             $cmd2 = $pdo->prepare("SELECT codCard FROM tbcardrotina
                              WHERE codRotina = :codRotina");

             $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
             if($cmd2->execute()){
                while($linha = $cmd2->fetch(PDO::FETCH_ASSOC)){
                  $card = new Card();
                  $card->setId(intval($linha['codCard']));
              
                  $cmdCard = $pdo->prepare("SELECT descCard FROM tbcard WHERE codCard = :codCard");
                  $cmdCard->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                  $cmdCard->execute();
                  $card->setDescricao($cmdCard->fetch(PDO::FETCH_COLUMN));  

                  $cmd3 = $pdo->prepare("SELECT codAlternativa FROM tbalternativacard
                              WHERE codCard = :codCard and codRotina = :codRotina");
                  $cmd3->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                  $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                  if($cmd3->execute()){   
                    $codAlternativa = $cmd3->fetch(PDO::FETCH_COLUMN);
                    $alternativa = new Alternativa();
                    $alternativa->setId(intval($codAlternativa));
                    
                    $cmdAlternativa = $pdo->prepare("SELECT descAlternativa FROM tbalternativa WHERE codAlternativa = :codAlternativa");
                    $cmdAlternativa->bindValue(":codAlternativa", $alternativa->getId(), PDO::PARAM_INT);
                    $cmdAlternativa->execute();
                    $alternativa->setDescricao($cmdAlternativa->fetch(PDO::FETCH_COLUMN));  
                  
                    $card->addAlternativa($alternativa);
                  }
                  
                  $rotina->addCard($card);
                } 
                // continuar a fazer o select para obeter as alternativas do card
                // não esquecer de colocar o 'codRotina' na tabela 'tbalternativacard'
                // para assim obter as alternativas específicas da rotina para com os cards 
             }

             $cmd4 = $pdo->prepare("SELECT codOcorrencia FROM tbocorrenciarotina
                              WHERE codRotina = :codRotina");
             $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
             if($cmd4->execute()){
                if($cmd4->rowCount() > 0){
                  while($linha = $cmd4->fetch(PDO::FETCH_ASSOC)){
                    $ocorrencia = new Ocorrencia();
                    $ocorrencia->setId(intval($linha['codOcorrencia']));

                    $cmdOcorrencia = $pdo->prepare("SELECT descOcorrencia FROM tbocorrencia WHERE codOcorrencia = :codOcorrencia");
                    $cmdOcorrencia->bindValue(":codOcorrencia", $ocorrencia->getId(), PDO::PARAM_INT);
                    $cmdOcorrencia->execute();
                    $ocorrencia->setDescricao($cmdOcorrencia->fetch(PDO::FETCH_COLUMN));  
                    
                    $rotina->addOcorrencia($ocorrencia);
                  } 
                }
             }

          }

       } catch (PDOException $e) {
          echo $e->getMessage();
       }

       Conexao::desconexao();
    }
    
    #################################################################
    ####################### Relatórios ##############################
    #################################################################

    public function relatorioGeralUsuario() 
    {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->query("SELECT codUsuario, nomeUsuario, loginUsuario, descTipoUsuario, dataCadastroUsuario FROM tbusuario
                              INNER JOIN tbtipousuario
                              ON tbusuario.codTipoUsuario = tbtipoUsuario.codTipoUsuario");
           
           // Cria uma lista para armazenar todos os usuários
           $listaUsuarios = new ArrayObject();
           
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'usuario' que é adicionado 
           // a uma lista de graus escolares
           while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
           {
               $tipoUsuario = new TipoUsuario();

               $tipoUsuario->setDescricao($linha['descTipoUsuario']);
               
               $usuario = new Usuario();
               $usuario->addTipoUsuario($tipoUsuario);

               $usuario->setId($linha['codUsuario']);
               $usuario->setNome($linha['nomeUsuario']);
               $usuario->setLogin($linha['loginUsuario']);

               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroUsuario']));
               $dataCadastroFuncionario = str_replace('-', '/', $aux);
               ################################################################
               $usuario->setDataCadastro($dataCadastroFuncionario);

               $listaUsuarios->append($usuario);
           }
           // Retorna a lista completa com os usuários
           return $listaUsuarios;

       }
       catch (PDOException $e)
       {
           echo $e->getMessage();
       } 

       Conexao::desconexao();
    }


    public function relatorioEspecificoUsuario(&$usuario) 
    {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
           $cmd = $pdo->prepare("SELECT codUsuario, nomeUsuario, loginUsuario, descTipoUsuario, dataCadastroUsuario FROM tbusuario
                              INNER JOIN tbtipousuario
                              ON tbusuario.codTipoUsuario = tbtipoUsuario.codTipoUsuario
                              WHERE codUsuario = :codUsuario");
           $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
           
           if ($cmd->execute()) 
           {    
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $tipoUsuario = new TipoUsuario();
               $tipoUsuario->setDescricao($linha['descTipoUsuario']);
               $usuario->addTipoUsuario($tipoUsuario);

               $usuario->setId($linha['codUsuario']);
               $usuario->setNome($linha['nomeUsuario']);
               $usuario->setLogin($linha['loginUsuario']);
               
               ############## Formatando a Data de Cadastro ###################
               $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroUsuario']));
               $dataCadastroFuncionario = str_replace('-', '/', $aux);
               ################################################################
               $usuario->setDataCadastro($dataCadastroFuncionario);
           }
           
       } 
       catch (PDOException $e)
       {
          echo $e->getMessage();
       } 

       Conexao::desconexao();
    }

    public function pesquisarAlunoAgenda($agenda) {

      $pdo = Conexao::conexao();

      try 
      {
        $cmd = $pdo->prepare("SELECT nomeAluno FROM tbagenda
                              INNER JOIN tbaluno
                              ON tbagenda.codAluno = tbaluno.codAluno
                              WHERE codAgenda = :codAgenda");
        $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
        
        $aluno = new Aluno();

        if ($cmd->execute())
        {
          $aluno->setNome($cmd->fetch(PDO::FETCH_COLUMN));
        }
        else
        {
          $aluno = null;
        }

        return $aluno;
      } 
      catch (PDOException $e) 
      {
        echo $e->getMessage();
      }

      Conexao::desconexao();

    }

}

?>