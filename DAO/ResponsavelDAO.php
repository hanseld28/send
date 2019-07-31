<?php

include_once("Conexao.php");
include_once("../Model/Responsavel.php"); 
/**
 * Description of ResponsavelDAO
 *
 * @author laris
 */
class ResponsavelDAO {
    //DAO do responsável

  public function CadastrarResponsavel($obj){
        //cadastrando responsavel com o telefone

    $resp = new Responsavel();
    $resp = $obj;

    $nome = $resp->getNome();
    $cpf = $resp->getCpf();
    $nacionalidade = $resp->getNacionalidade();
    $rg = $resp->getRg();
    $data = $resp->getDatanascimento();
    $sexo = $resp->getSexo();
    $profissao = $resp->getProfissao();
    $enderecotrabalho = $resp->getEnderecotrabalho();
    $telefone = $resp->getTelefone();
    $celular = $resp->getCelular();
    $telefonetrabalho = $resp->getTelefonetrabalho();
    $grau = $resp->getGrauparentesco();
    $email = $resp->getEmail();
    $usuario = $resp->getUsuario();
    $foto = "fotoPadrao";
    
    
    $db = Conexao::conexao();
    
    $inseredados=$db->prepare("INSERT INTO tbresponsavel (nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, fotoResponsavel, codUsuario) VALUES(:nome, :cpf, :nacionalidade, :rg, :data, :sexo, :profissao, :endereco, :telefone, :celular, :telefonetrabalho, :grau, :email, :foto, :user)");
    $inseredados->bindValue(":nome", $nome);
    $inseredados->bindValue(":cpf", $cpf);
    $inseredados->bindValue(":nacionalidade", $nacionalidade);
    $inseredados->bindValue(":rg", $rg);
    $inseredados->bindValue(":data", $data);
    $inseredados->bindValue(":sexo", $sexo);
    $inseredados->bindValue(":profissao", $profissao);
    $inseredados->bindValue(":endereco", $enderecotrabalho);
    $inseredados->bindValue(":telefone", $telefone);
    $inseredados->bindValue(":celular", $celular);
    $inseredados->bindValue(":telefonetrabalho", $telefonetrabalho);
    $inseredados->bindValue(":grau", $grau);
    $inseredados->bindValue(":email", $email);
    $inseredados->bindValue(":foto", $foto);
    $inseredados->bindValue(":user", $usuario);
    
    
       // Valida o cadastro
    $validar = $db->prepare("SELECT nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, codUsuario, emailResponsavel FROM tbresponsavel WHERE nomeResponsavel = :nome AND cpfResponsavel = :cpf AND nacionalidadeResponsavel = :nacionalidade AND rgResponsavel = :rg AND dataNascResponsavel = :data AND sexoResponsavel = :sexo AND profissaoResponsavel = :profissao AND enderecoTrabalho = :endereco AND telefoneResidencialResponsavel = :telefone AND telefoneCelularResponsavel = :celular AND telefoneTrabalhoResponsavel = :telefonetrabalho AND grauParentescoResponsavel = :grau AND emailResponsavel = :email AND  codUsuario = :user");
    $validar->bindValue(":nome", $nome);
    $validar->bindValue(":cpf", $cpf);
    $validar->bindValue(":nacionalidade", $nacionalidade);
    $validar->bindValue(":rg", $rg);
    $validar->bindValue(":data", $data);
    $validar->bindValue(":sexo", $sexo);
    $validar->bindValue(":profissao", $profissao);
    $validar->bindValue(":endereco", $enderecotrabalho);
    $validar->bindValue(":telefone", $telefone);
    $validar->bindValue(":celular", $celular);
    $validar->bindValue(":telefonetrabalho", $telefonetrabalho);
    $validar->bindValue(":grau", $grau);
    $validar->bindValue(":email", $email);
    $validar->bindValue(":user", $usuario);
    $validar->execute();
    
    if($validar->rowCount() == 0){
    // Executa o Cadastro
     $inseredados->execute();
     return true;
   }else{
     return false;
   }

        //fechando a conexao
   Conexao::desconexao();
   
   
 }
 public function MostrarResponsavel(){
  $resp = 0;
  $db = Conexao::conexao();
    //Paginação
  $i = 1;

  $listarresp_pg=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, codUsuario FROM tbresponsavel");
  $listarresp_pg->execute();

  $count = $listarresp_pg->rowCount();
  $calculo = ceil(($count/3));

  $url = 0;
  $mody =0;
  if (isset($_GET['pageResp']) == $i) {
   $url= $_GET['pageResp'];
   $mody = ($url*3)-3;
 }

        //Paginação
 
 $listarresp=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, fotoResponsavel, codUsuario FROM tbresponsavel LIMIT 3 OFFSET {$mody}");
 $listarresp->execute();
 
 $listaresp = Array();
 $linha = $listarresp->fetchAll(PDO::FETCH_OBJ);
 
         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)

          $r = new Responsavel();
          $r->setCodigo($listar->codResponsavel);
          $r->setNome($listar->nomeResponsavel);
          $r->setCpf($listar->cpfResponsavel);
          $r->setNacionalidade($listar->nacionalidadeResponsavel);
          $r->setRg($listar->rgResponsavel);
          $r->setDatanascimento($listar->dataNascResponsavel);
          $r->setSexo($listar->sexoResponsavel);
          $r->setProfissao($listar->profissaoResponsavel);
          $r->setEnderecotrabalho($listar->enderecoTrabalho);
          $r->setTelefone($listar->telefoneResidencialResponsavel);
          $r->setCelular($listar->telefoneCelularResponsavel);
          $r->setTelefonetrabalho($listar->telefoneTrabalhoResponsavel);
          $r->setGrauparentesco($listar->grauParentescoResponsavel);
          $r->setEmail($listar->emailResponsavel);
          $r->setFoto($listar->fotoResponsavel);
          
          $listaresp[] = $r;
        }
        
        Conexao::desconexao();
        
        return $listaresp;
        
        
      }
      public function EditarResponsavel($obj){

        $db = Conexao::conexao();
        $resp = new Responsavel();
        $resp = $obj;
        $nome = $resp->getNome();
        $cpf = $resp->getCpf();
        $nacionalidade = $resp->getNacionalidade();
        $rg = $resp->getRg();
        $data = $resp->getDatanascimento();
        $sexo = $resp->getSexo();
        $profissao = $resp->getProfissao();
        $enderecotrabalho = $resp->getEnderecotrabalho();
        $telefone = $resp->getTelefone();
        $celular = $resp->getCelular();
        $telefonetrabalho = $resp->getTelefonetrabalho();
        $grau = $resp->getGrauparentesco();
        $email = $resp->getEmail();
        $usuario = $resp->getCodigo();
        $editardados=$db->prepare("UPDATE tbresponsavel SET nomeResponsavel = :nome, cpfResponsavel = :cpf, nacionalidadeResponsavel = :nacionalidade, rgResponsavel = :rg, dataNascResponsavel = :data, sexoResponsavel = :sexo, profissaoResponsavel = :profissao, enderecoTrabalho = :endereco, telefoneResidencialResponsavel = :telefone, telefoneCelularResponsavel = :celular, telefoneTrabalhoResponsavel = :telefonetrabalho, grauParentescoResponsavel = :grau, emailResponsavel = :email WHERE codResponsavel = :codigo");

        $editardados->bindValue(":codigo", $usuario);
        $editardados->bindValue(":nome", $nome);
        $editardados->bindValue(":cpf", $cpf);
        $editardados->bindValue(":nacionalidade", $nacionalidade);
        $editardados->bindValue(":rg", $rg);
        $editardados->bindValue(":data", $data);
        $editardados->bindValue(":sexo", $sexo);
        $editardados->bindValue(":profissao", $profissao);
        $editardados->bindValue(":endereco", $enderecotrabalho);
        $editardados->bindValue(":telefone", $telefone);
        $editardados->bindValue(":celular", $celular);
        $editardados->bindValue(":telefonetrabalho", $telefonetrabalho);
        $editardados->bindValue(":grau", $grau);
        $editardados->bindValue(":email", $email);
        $editardados->execute();
        
        if($editardados->rowCount() > 0){

         return true;
       }else{
         return false;
       }
       
       Conexao::desconexao();
       
       
     }
     
     public function VerificaResponsavel(&$responsavel){
      $codigoresp = $responsavel->getCodigo();
      $db = Conexao::conexao();
      $verificarresp=$db->prepare("SELECT count(codResponsavel) FROM tbaluno WHERE codResponsavel = :codigo");
      $verificarresp->bindValue(':codigo', $codigoresp, PDO::PARAM_INT);
      $verificarresp->execute();
      $resultado = $verificarresp->fetchColumn();
      return $resultado;
      
      Conexao::desconexao();
      
      
    }

    public function cadastrarFotoResponsavel($foto, $cod){

      $db = Conexao::conexao();
      $cadastrar=$db->prepare("UPDATE tbresponsavel SET fotoResponsavel = :foto WHERE codResponsavel = :codigo");
      $cadastrar->bindValue(':foto', $foto, PDO::PARAM_STR);
      $cadastrar->bindValue(':codigo', $cod, PDO::PARAM_INT);
      $cadastrar->execute();
      
      Conexao::desconexao();

    }
    public function ExcluirResponsavel($cod){


      $resposta = "";
      $db = Conexao::conexao();

      $buscaresp=$db->prepare("select codUsuario from tbresponsavel where codResponsavel = :codigo");
      $buscaresp->bindValue(':codigo', $cod, PDO::PARAM_INT);
      $buscaresp->execute();
      $linha = $buscaresp->fetchColumn();

      $excluir=$db->prepare("delete from tbUsuario where codUsuario = :cod");
      $excluir->bindValue(':cod', $linha, PDO::PARAM_INT);
      $excluir->execute();

      if($buscaresp->rowCount() > 0){

        $excluirresp=$db->prepare("DELETE FROM tbResponsavel WHERE codResponsavel = :codigo");
        $excluirresp->bindValue(':codigo', $cod, PDO::PARAM_INT);
        $excluirresp->execute();
        
        if($excluirresp->rowCount() == 1): 
          return true;
        else: 
          return false; 
        endif;

        Conexao::desconexao();

      } }

      public function buscarAluno($cod){

        $db = Conexao::conexao();
        $buscar=$db->prepare("select codAluno from tbaluno where codResponsavel = :codigo");
        $buscar->bindValue(":codigo", $cod, PDO::PARAM_INT);
        $buscar->execute();

        $codAluno = $buscar->fetchColumn();

        return $codAluno;

        Conexao::desconexao();


      }

      public function ConsultarResponsavel(&$resp){


        $db = Conexao::conexao();
        $consultarresp=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, fotoResponsavel, codUsuario FROM tbresponsavel WHERE codResponsavel = :codigo");
        $consultarresp->bindValue(":codigo", $resp->getCodigo(), PDO::PARAM_INT);
        $consultarresp->execute();
        
        $responsavel = Array();
        
        $linha = $consultarresp->fetch(PDO::FETCH_OBJ);
          //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
        
            //$resp = new Responsavel;
        
        $resp->setNome($linha->nomeResponsavel);
        $resp->setCpf($linha->cpfResponsavel);
        $resp->setNacionalidade($linha->nacionalidadeResponsavel);
        $resp->setRg($linha->rgResponsavel);
        $resp->setDatanascimento($linha->dataNascResponsavel);
        $resp->setSexo($linha->sexoResponsavel);
        $resp->setProfissao($linha->profissaoResponsavel);
        $resp->setEnderecotrabalho($linha->enderecoTrabalho);
        $resp->setTelefone($linha->telefoneResidencialResponsavel);
        $resp->setCelular($linha->telefoneCelularResponsavel);
        $resp->setTelefonetrabalho($linha->telefoneTrabalhoResponsavel);
        $resp->setGrauparentesco($linha->grauParentescoResponsavel);
        $resp->setEmail($linha->emailResponsavel);
        $resp->setFoto($linha->fotoResponsavel);
        $resp->setUsuario($linha->codUsuario);
        
        
        Conexao::desconexao();
        
        return $resp;
      }
      
      public function ConsultarDadosResponsavel(&$resp){
        $db = Conexao::conexao();
        $consultarresp=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, codUsuario, fotoResponsavel FROM tbresponsavel WHERE codUsuario = :codigo");
        $consultarresp->bindValue(":codigo", $resp->getCodigo(), PDO::PARAM_INT);
        $consultarresp->execute();
        
        $responsavel = Array();
          //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
        
            //$resp = new Responsavel;
        while ($listar = $consultarresp->fetch(PDO::FETCH_ASSOC))
        {
          $resp->setCodigo($listar['codResponsavel']);
          $resp->setNome($listar['nomeResponsavel']);
          $resp->setCpf($listar['cpfResponsavel']);
          $resp->setNacionalidade($listar['nacionalidadeResponsavel']);
          $resp->setRg($listar['rgResponsavel']);
          $resp->setDatanascimento($listar['dataNascResponsavel']);
          $resp->setSexo($listar['sexoResponsavel']);
          $resp->setProfissao($listar['profissaoResponsavel']);
          $resp->setEnderecotrabalho($listar['enderecoTrabalho']);
          $resp->setTelefone($listar['telefoneResidencialResponsavel']);
          $resp->setCelular($listar['telefoneCelularResponsavel']);
          $resp->setTelefonetrabalho($listar['telefoneTrabalhoResponsavel']);
          $resp->setGrauparentesco($listar['telefoneTrabalhoResponsavel']);
          $resp->setEmail($listar['emailResponsavel']);
          $resp->setFoto($listar['fotoResponsavel']);

        }
        
        Conexao::desconexao();
        
        return $resp;
      }

      public function UltimoResponsavel(){

        $db = Conexao::conexao();
        $consulta=$db->prepare("SELECT MAX(codResponsavel) FROM tbresponsavel");
        $consulta->execute();
        $linha = $consulta->fetchColumn();
        
        Conexao::desconexao();
        return $linha;
        
      }
      
    #################################################################
    ################## Relatórios do Responsavel ####################
    #################################################################

      public function relatorioGeralResponsavel() 
      {       
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Relatorio no banco de dados
         $cmd = $pdo->query("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, dataCadastroResponsavel FROM tbresponsavel ");
         
           // Cria uma lista para armazenar todos os periodos
         $lista = new ArrayObject();
         
           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'periodos' que é adicionado 
           // a uma lista de periodos
         while ($linha = $cmd->fetch(PDO::FETCH_ASSOC))
         {
           $responsavel = new Responsavel();
           $responsavel->setCodigo($linha['codResponsavel']);
           $responsavel->setNome($linha['nomeResponsavel']);
           $responsavel->setCpf($linha['cpfResponsavel']);
           $responsavel->setNacionalidade($linha['nacionalidadeResponsavel']);
           $responsavel->setRg($linha['rgResponsavel']);
           $responsavel->setDatanascimento($linha['dataNascResponsavel']);
           $responsavel->setSexo($linha['sexoResponsavel']);
           $responsavel->setProfissao($linha['profissaoResponsavel']);
           $responsavel->setEnderecotrabalho($linha['enderecoTrabalho']);
           $responsavel->setTelefone($linha['telefoneResidencialResponsavel']);
           $responsavel->setCelular($linha['telefoneCelularResponsavel']);
           $responsavel->setTelefonetrabalho($linha['telefoneTrabalhoResponsavel']);
           $responsavel->setGrauparentesco($linha['grauParentescoResponsavel']);
           $responsavel->setEmail($linha['emailResponsavel']);

               ############## Formatando a Data de Cadastro ###################
           $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroResponsavel']));
           $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
           $responsavel->setDatacadastro($dataCadastro);

           $lista->append($responsavel);
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
     
     public function relatorioEspecificoResponsavel(&$responsavel) 
     {    
       // Abre a conexão com o banco de dados
       $pdo = Conexao::conexao();

       try
       {
           // Busca os dados do Período no banco de dados
         $cmd = $pdo->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, emailResponsavel, dataCadastroResponsavel FROM tbresponsavel WHERE codResponsavel = :cod");
         $cmd->bindValue(":cod", $responsavel->getCodigo(), PDO::PARAM_INT);
         
         if ($cmd->execute()) 
         {    
           $linha = $cmd->fetch(PDO::FETCH_ASSOC);

           $responsavel->setCodigo($linha['codResponsavel']);
           $responsavel->setNome($linha['nomeResponsavel']);
           $responsavel->setCpf($linha['cpfResponsavel']);
           $responsavel->setNacionalidade($linha['nacionalidadeResponsavel']);
           $responsavel->setRg($linha['rgResponsavel']);
           $responsavel->setDatanascimento($linha['dataNascResponsavel']);
           $responsavel->setSexo($linha['sexoResponsavel']);
           $responsavel->setProfissao($linha['profissaoResponsavel']);
           $responsavel->setEnderecotrabalho($linha['enderecoTrabalho']);
           $responsavel->setTelefone($linha['telefoneResidencialResponsavel']);
           $responsavel->setCelular($linha['telefoneCelularResponsavel']);
           $responsavel->setTelefonetrabalho($linha['telefoneTrabalhoResponsavel']);
           $responsavel->setGrauparentesco($linha['grauParentescoResponsavel']);
           $responsavel->setEmail($linha['emailResponsavel']);           
               ############## Formatando a Data de Cadastro ###################
           $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroResponsavel']));
           $dataCadastro = str_replace('-', '/', $aux);
               ################################################################
           $responsavel->setDatacadastro($dataCadastro);
         }
         
       } 
       catch (PDOException $e)
       {
        echo $e->getMessage();
      } 

      Conexao::desconexao();
    }
    
  }