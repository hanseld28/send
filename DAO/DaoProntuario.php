<?php
include_once("Conexao.php");
include_once("../Model/Prontuario.php");
include_once("../Model/Aluno.php");
include_once("../Model/GrauEscolar.php");

/**
 * Description of DaoProntuario
 *
 * @author hansel
 */

class DaoProntuario {
    
    public function cadastrarProntuario($novoProntuario){
       
       $pdo = Conexao::conexao();

     $codAluno = $novoProntuario->aluno->getCodigo();
     $tiposanguineo = $novoProntuario->getTiposanguineo();
     $deficiencia = $novoProntuario->getDeficiencia();
     $problemasaude = $novoProntuario->getProblemasaude();
     $doencacontagiosa = $novoProntuario->getDoencacontagiosa();
     $tratamentocirurgico = $novoProntuario->getTratamentocirurgico();
     $alergia = $novoProntuario->getAlergia();
     $medicacao = $novoProntuario->getMedicacao();
       
       // Prepara o cadastro
       $cmd = $pdo->prepare("INSERT INTO tbprontuarioaluno(codAluno, tipoSanguineo, deficiencia, problemaSaude, doencaContagiosa, tratamentoCirurgico, alergia, medicacao) VALUES (:codAluno, :tipo, :deficiencia, :problema, :doenca, :tratamento, :alergia, :medicacao)");
       $cmd->bindValue(":codAluno", $codAluno, PDO::PARAM_INT);
       $cmd->bindValue(":tipo", $tiposanguineo, PDO::PARAM_STR);
       $cmd->bindValue(":deficiencia", $deficiencia, PDO::PARAM_STR);
       $cmd->bindValue(":problema", $problemasaude, PDO::PARAM_STR);
       $cmd->bindValue(":doenca", $doencacontagiosa, PDO::PARAM_STR);
       $cmd->bindValue(":tratamento", $tratamentocirurgico, PDO::PARAM_STR);
       $cmd->bindValue(":alergia", $alergia, PDO::PARAM_STR);
       $cmd->bindValue(":medicacao", $medicacao, PDO::PARAM_STR);

       // Valida o cadastro
       $validar = $pdo->prepare("SELECT codAluno FROM tbprontuarioaluno WHERE codAluno = ?");
       //$validar->bindValue(':codigoAluno', $codAluno);
       $validar->execute(array($codAluno));
       if($validar->rowCount() == 0){
           // Executa o Cadastro
           $cmd->execute();
           return true;
       }else{
           return false;
       }
       Conexao::desconexao();
    }
    
    public function consultarProntuario(&$a){
       $aluno = new Aluno();
       $a->addAluno($aluno);
       $pdo = Conexao::conexao();
       //$aluno = new Aluno();
       $codigo = $a->getId();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codAluno, tipoSanguineo, deficiencia, problemaSaude, doencaContagiosa, tratamentoCirurgico, alergia, acompanhamentoMedico, medicacao FROM tbprontuarioaluno  WHERE codProntuarioAluno = :codigo");
        $cmd->bindValue(':codigo', $codigo);
        $cmd->execute();

       $linha = $cmd->fetchAll(PDO::FETCH_OBJ); 

         foreach ($linha as $listar){  //inserir o tipo de retorno (objeto, arraylist, ou um array associativo)
            
     $a->aluno->setCodigo($listar->codAluno);
     $a->setTiposanguineo($listar->tipoSanguineo);
     $a->setDeficiencia($listar->deficiencia);
     $a->setProblemasaude($listar->problemaSaude);
     $a->setDoencacontagiosa($listar->doencaContagiosa);
     $a->setTratamentocirurgico($listar->tratamentoCirurgico);
     $a->setAlergia($listar->alergia);
     $a->setAcompanhamentomedico($listar->acompanhamentoMedico);
     $a->setMedicacao($listar->medicacao);
       }

       Conexao::desconexao();
       // Retorna a lista completa com os prontuarios
       return $a;
    }
    
    public function editarProntuario($editarProntuario) { 
        try{
            // Abre a conexão com o banco de dados
     $pdo = Conexao::conexao();

     $tiposanguineo = $editarProntuario->getTiposanguineo();
     $deficiencia = $editarProntuario->getDeficiencia();
     $problemasaude = $editarProntuario->getProblemasaude();
     $doencacontagiosa = $editarProntuario->getDoencacontagiosa();
     $tratamentocirurgico = $editarProntuario->getTratamentocirurgico();
     $alergia = $editarProntuario->getAlergia();
     $medicacao = $editarProntuario->getMedicacao();
     $codigo = $editarProntuario->getId();

            // Prepara a edição 
    $cmd = $pdo->prepare("UPDATE tbprontuarioaluno SET tipoSanguineo = :tipo, deficiencia = :deficiencia, problemaSaude = :problema, doencaContagiosa = :doenca, tratamentoCirurgico = :tratamento, alergia = :alergia, medicacao = :medicacao WHERE codProntuarioAluno = :cod");
            // Substitui os valores
       $cmd->bindValue(":tipo", $tiposanguineo, PDO::PARAM_STR);
       $cmd->bindValue(":deficiencia", $deficiencia, PDO::PARAM_STR);
       $cmd->bindValue(":problema", $problemasaude, PDO::PARAM_STR);
       $cmd->bindValue(":doenca", $doencacontagiosa, PDO::PARAM_STR);
       $cmd->bindValue(":tratamento", $tratamentocirurgico, PDO::PARAM_STR);
       $cmd->bindValue(":alergia", $alergia, PDO::PARAM_STR);
       $cmd->bindValue(":medicacao", $medicacao, PDO::PARAM_STR);
       $cmd->bindValue(":cod", $codigo, PDO::PARAM_INT);    
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
    
    public function excluirProntuario($prontuario){
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
  
            $cmd = $pdo->prepare("DELETE FROM tbprontuario WHERE codProntuario = :codProntuario");
            $cmd->bindValue(":codProntuario", $prontuario->getId(), PDO::PARAM_INT);
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
    public function preencherProntuario(&$prontuario){ // '&' representa uma Passagem por Referência
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();

           // Busca pelo código do prontuario o 'aluno', a 'ficha de declaracao de saude' e o 'grau escolar' no banco de dados
           $cmd = $pdo->prepare("SELECT codAluno, tipoSanguineo, deficiencia, problemaSaude, doencaContagiosa, tratamentoCirurgico, alergia, acompanhamentoMedico, medicacao");
           $cmd->bindValue(":codProntuario", $prontuario->getId(), PDO::PARAM_INT); 
           $cmd->execute();
           $linha = $cmd->fetch(PDO::FETCH_OBJ);

           foreach ($linha as $listar){
                $aluno = new Aluno();
                $aluno->setId($linha['codAluno']);

               $prontuario->aluno->setCodigo($listar->codAluno);
               $prontuario->setTiposanguineo($listar->tipoSanguineo);
               $prontuario->setDeficiencia($listar->deficiencia);
               $prontuario->setProblemasaude($listar->problemaSaude);
               $prontuario->setDoencacontagiosa($listar->doencaContagiosa);
               $prontuario->setTratamentocirurgico($listar->tratamentoCirurgico);
               $prontuario->setAlergia($listar->alergia);
               $prontuario->setAcompanhamentomedico($listar->acompanhamentoMedico);
               $prontuario->setMedicacao($listar->medicacao);
               $prontuario->addAluno($aluno);
               
           }

       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }
    
    public function pesquisarProntuarioAluno($cod){
        
         $pdo = Conexao::conexao();
        
         $cmd = $pdo->prepare("SELECT codProntuarioAluno FROM tbprontuarioaluno WHERE codAluno = :cod");
         $cmd->bindValue(":cod", $cod);
         $cmd->execute();
         $resultado = $cmd->fetchColumn();
        
         Conexao::desconexao();
         return $resultado;
    }
    
    #################################################################
    ################## Relatórios do Prontuario #####################
    #################################################################

   public function relatorioEspecificoProntuario(&$pront) 
{    
       // Abre a conexão com o banco de dados
 $pdo = Conexao::conexao();

 try
 {
           // Busca os dados do Período no banco de dados
   $cmd = $pdo->prepare(" SELECT codProntuarioAluno, tbprontuarioaluno.codAluno, nomeAluno, tipoSanguineo, deficiencia, problemaSaude, doencaContagiosa, tratamentoCirurgico, alergia, acompanhamentoMedico, medicacao, dataCadastroProntuarioAluno FROM tbprontuarioaluno INNER JOIN tbaluno ON tbprontuarioaluno.codAluno = tbaluno.codAluno WHERE codProntuarioAluno = :codProntuario");
   $cmd->bindValue(":codProntuario", $pront->getId(), PDO::PARAM_INT);

   if ($cmd->execute()) 
   {    
     $linha = $cmd->fetch(PDO::FETCH_ASSOC);

     $aluno = new Aluno();
     $aluno->setNome($linha['nomeAluno']);
     $pront->addAluno($aluno);

     $pront->setId($linha['codProntuarioAluno']);
     $pront->setTiposanguineo($linha["tipoSanguineo"]);
     $pront->setDeficiencia($linha['deficiencia']);
     $pront->setProblemasaude($linha['problemaSaude']);
     $pront->setDoencacontagiosa($linha['doencaContagiosa']);
     $pront->setTratamentocirurgico($linha['tratamentoCirurgico']);
     $pront->setAlergia($linha['alergia']);
     $pront->setAcompanhamentomedico($linha['acompanhamentoMedico']);
     $pront->setMedicacao($linha['medicacao']);
     
     
    ############## Formatando a Data de Cadastro ###################
     $aux = date('d-m-Y h:i A', strtotime($linha['dataCadastroProntuarioAluno']));
     $dataCadastro = str_replace('-', '/', $aux);
    ################################################################
     $pront->setDatacadastro($dataCadastro);
   }

 } 
 catch (PDOException $e)
 {
  echo $e->getMessage();
} 

Conexao::desconexao();
}
  
}