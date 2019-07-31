<?php
include_once("../Model/Cronograma.php");
include_once("../DAO/CronogramaDAO.php");
include_once("../DAO/DaoTurma.php");
include_once("../Model/Turma.php");


class CronogramaCRUD{
    
    
    public function CadastrarCronograma($turma){
        $cronograma = new Cronograma();
        
        $cronograma->setTurma($turma);
        
        $pdao = new CronogramaDAO();
        $pdao->CadastrarCronograma($cronograma);
        
    }
    
    public function consultarCronograma($cod){
        $turma = new Turma();
        $turma->setId($cod);
        
        $daoTurma = new CronogramaDAO();
        // Requere uma lista de 'prontuarios' do objeto de acesso ao banco de dados
        $listaturmas = $daoTurma->consultarCronograma($turma);
        // Retorna uma lista com prontuarios
        return $listaturmas;
    }
    
    public function pesquisarCronogramaTurma($codturma){
        $turma = new Turma();
        $turma->setId($codturma);
        $dao = new CronogramaDAO();
        $resposta = $dao->pesquisarCronogramaTurma($turma);
        return $resposta;
        
    }
    
    public function consultarCronogramaTurma($codCronograma){
        
        $cronograma = new CronogramaDAO();
        // Requere uma lista de 'prontuarios' do objeto de acesso ao banco de dados
        $listaCronograma = $cronograma->consultarCronograma($codCronograma);
        // Retorna uma lista com prontuarios
        return $listaCronograma;
        
    }
    
    
    
    
}



?>