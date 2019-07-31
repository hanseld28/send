<?php
include_once("../Model/Aluno.php");
include_once("../DAO/AlunoDAO.php");

/**
 * Description of AlunoCRUD
 *
 * @author laris
 */
class AlunoCRUD {
    //CRUD do aluno
    
    
    public function CadastrarAluno($nomealuno, $dataaluno, $nacionalidadealuno, $sexoaluno, $rgaluno, $coraluno, $certidaoaluno, $logradouroaluno, $complementoaluno, $ncasaaluno, $cepaluno, $bairroaluno, $cidadealuno, $foto, $codigoresp){
        $a = new Aluno();
        
        $a->setNome($nomealuno);
        $a->setRg($rgaluno);
        $a->setDatanascimento($dataaluno);
        $a->setLogradouro($logradouroaluno);
        $a->setComplemento($complementoaluno);
        $a->setNumcasa($ncasaaluno);
        $a->setResponsavel($codigoresp);
        $a->setCep($cepaluno);
        $a->setCidade($cidadealuno);
        $a->setNacionalidade($nacionalidadealuno);
        $a->setSexo($sexoaluno);
        $a->setRg($rgaluno);
        $a->setCor($coraluno);
        $a->setCertidao($certidaoaluno);
        $a->setBairro($bairroaluno);
        $a->setFoto($foto);
        
        $pdao = new AlunoDAO();
        $resultado = $pdao->CadastrarAluno($a);
        return $resultado;
        
    }
    
       public function EditarAluno($id, $nomealuno, $dataaluno, $nacionalidadealuno, $sexoaluno, $rgaluno, $coraluno, $certidaoaluno, $logradouroaluno, $complementoaluno, $ncasaaluno, $cepaluno, $bairroaluno, $cidadealuno, $foto){
        
          $a = new Aluno();
          
        $a->setCodigo($id);
        $a->setNome($nomealuno);
        $a->setRg($rgaluno);
        $a->setDatanascimento($dataaluno);
        $a->setLogradouro($logradouroaluno);
        $a->setComplemento($complementoaluno);
        $a->setNumcasa($ncasaaluno);
        $a->setCep($cepaluno);
        $a->setCidade($cidadealuno);
        $a->setNacionalidade($nacionalidadealuno);
        $a->setSexo($sexoaluno);
        $a->setRg($rgaluno);
        $a->setCor($coraluno);
        $a->setCertidao($certidaoaluno);
        $a->setBairro($bairroaluno);
        $a->setFoto($foto);
          
          
          $pdao = new AlunoDAO();
          return $pdao->EditarAluno($a);
          
      }
      
      
        public function ListarAluno(){
        
        $pdao = new AlunoDAO();
        $var = array();
        return $var = $pdao->MostrarAluno();
        
        
        
    }
    
    public function ExcluirAluno($cod){    
        $codigo = $cod;
        $pdao = new AlunoDAO();
        return $pdao->ExcluirAluno($codigo);
    }
    
    public function ConsultaAluno($cod){
        $resultado = array();
        $codigo = $cod;
        $pdao = new AlunoDAO();
        
        return $resultado[] = $pdao->ConsultarAluno($codigo);
    }
    
    public function ConsultarResponsavel($cod){
       $resultado;
       $pdao = new AlunoDAO();
       return $resultado = $pdao->BuscarResponsavel($cod);
    }
    
    public function ConsultaDadosAluno($cod){
      $resultado = array();
      $codigo = $cod;
      $pdao = new AlunoDAO();
      
      return $resultado[] = $pdao->ConsultarDadosAluno($codigo);    
    }
    
    public function UltimoAluno(){
        $resultado;
        $pdao = new AlunoDAO();
        return $resultado = $pdao->ultimoAluno();
    }
    
    public function pesqAlunoPorCodigo($cod){
      $resultado;
      $pdao = new AlunoDAO();
  
      return $resultado = $pdao->pesqAlunoPorCodigo($cod);      
    }
    
    public function AlunoAgendaPorCodigo($codAgenda){
      $pdao = new AlunoDAO();
      return $resultado = $pdao->AlunoAgendaPorCodigo($codAgenda);     
    }

    public function AgendaAlunoPorCodigo($codaluno){
      $pdao = new AlunoDAO();
      return $resultado = $pdao->AgendaAlunoPorCodigo($codaluno);     
    }
    
    #################################################################
    ################## Relatórios do Aluno ##########################
    #################################################################

    public function relatorioGeralAluno(){
        $dao = new AlunoDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralAluno();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoAluno($cod){
        $aluno = new Aluno();
        $aluno->setCodigo($cod);

        $dao = new AlunoDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoAluno($aluno);
        // Retorna a periodo preenchido
        return $aluno;
    }
    
}
