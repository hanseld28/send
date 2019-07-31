<?php		
include_once("..\DAO\DaoTurma.php");
include_once("..\Model\Turma.php");
include_once("..\Model\GrauEscolar.php");

class ControllerTurma {
    
    public function cadastrarTurma($nomeTurma, $codGrauEscolar){ 
    	$novaTurma = new Turma();        
        
        $grauEscolar = new GrauEscolar();

        $novaTurma->addGrauEscolar($grauEscolar);

        $novaTurma->setDescricao($nomeTurma);
        
        $novaTurma->grauEscolar->setId($codGrauEscolar);

        $daoturma = new DaoTurma();
        // Envia o objeto 'novaTurma' para classe de acesso ao banco de dados
        $resultado = $daoturma->cadastrarTurma($novaTurma);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
        public function PesquisarUltimaTurma(){
       
            $dao = new DaoTurma();
            $resultado = $dao->PesquisarUltimaTurma();
        
        return $resultado;
        
    }
    
    public function consultarTurma(){
        $daoturma = new DaoTurma();
        // Requere uma lista de 'tipos de turma' do objeto de acesso ao banco de dados
        $listaTurmas = $daoturma->consultarTurma();
        // Retorna uma lista de tipos de usuarios
        return $listaTurmas;
    }
    
    public function editarTurma($codTurma, $descTurma, $codGrauEscolar){
        $grauEscolar = new GrauEscolar();

        $editarTurma = new Turma();

        $editarTurma->setId($codTurma);        
        $editarTurma->setDescricao($descTurma);

        $editarTurma->addGrauEscolar($grauEscolar);
        $editarTurma->grauEscolar->setId($codGrauEscolar);

        $daoturma = new DaoTurma();
        // Envia o objeto 'editarTurma' para classe de acesso ao banco de dados
        $resultado = $daoturma->editarTurma($editarTurma);

        //var_dump($editarTurma);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
       
    public function excluirTurma($codTurma){
        $excluirTurma = new Turma();

        $excluirTurma->setId($codTurma);

        $daoturma = new DaoTurma();
        // Envia o objeto 'excluirTurma' para classe de acesso ao banco de dados
        $resultado = $daoturma->excluirTurma($excluirTurma);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherTurma($codTurma){ // '&' representa uma Passagem por Referência
        $turma = new Turma();

        $turma->setId($codTurma);

        $daoturma = new DaoTurma();
        
        $descTurma = $daoturma->preencherTurma($turma);

        return $descTurma;
    }
    
    public function consultarCronogramaTurma($codturma){
        
        
        
    }
    
    #################################################################
    ################## Relatórios do Turma ##########################
    #################################################################

    public function relatorioGeralTurma(){
        $daoTurma = new DaoTurma();
        // Requere uma lista de 'Turma' do objeto de acesso ao banco de dados
        $listaTurmas = $daoTurma->relatorioGeralTurma();
        // Retorna uma lista de Turmas
        return $listaTurmas;
    }
    
    public function relatorioEspecificoTurma($codTurma){
        $turma = new Turma();
        $turma->setId($codTurma);

        $daoTurma = new DaoTurma();
        // Requere o 'turma' preenchido do objeto de acesso ao banco de dados
        $daoTurma->relatorioEspecificoTurma($turma);
        // Retorna a turma preenchido
        return $turma;
    }
    
}

?>