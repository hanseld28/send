<?php

 include_once("../DAO/ProfessorTurmaDAO.php");
 include_once("../Model/ProfessorTurma.php");


class ProfessorTurmaCRUD{
    
    
    public function cadastrarProfessorTurma($codTurma, $codProfessor){
        
        $pt = new ProfessorTurma();
        $pt->setCodigoturma($codTurma);
        $pt->setCodigoprofessor($codProfessor);
        
        $pdao = new ProfessorTurmaDAO();
        return $pdao->cadastrarProfessorTurma($pt);
    
    }
    
        public function mostrarProfessorTurma(){
        $pdao = new ProfessorTurmaDAO();
        $var = array();
        return $var = $pdao->mostrarProfessorTurma();
        
    }
    
        public function excluirProfessorTurma($cod){
            
        $codigo = $cod;
        $pdao = new ProfessorTurmaDAO();
        return $pdao->exluirProfessorTurma($codigo);
            
            
        }
    
        public function consultarProfessorTurma($cod){
            
        $resultado = array();
        $codigo = $cod;
        $pdao = new ProfessorTurmaDAO();
        
        return $resultado[] = $pdao->consultarProfessorTurma($codigo);
            
            
        }
    
        public function editarProfessorTurma($codTurma, $codProfessor, $codprofessorturma){
            
        $pt = new ProfessorTurma();
        $pt->setCodigoturma($codTurma);
        $pt->setCodigoprofessor($codProfessor);
        $pt->setCodigoprofessorturma($codprofessorturma);
        
        $pdao = new ProfessorTurmaDAO();
        return $pdao->editarProfessorTurma($pt);
            
            
        }
    
        public function consultarTurmasProfessor($coduser){
            
            $list = array();
            $pt = new ProfessorTurma();
            $pt->setCodigoprofessor($coduser);
            
            $pdao = new ProfessorTurmaDAO();
            return $list = $pdao->consultarTurmasProfessor($pt);
   
        }
    
        public function consultarNomeTurma($codturma){
            $pt = new ProfessorTurma();
            $pt->setCodigoturma($codturma);
            
            $pdao = new ProfessorTurmaDAO();
            return $resultado = $pdao->consultarNomeTurma($pt);
        }
    
        public function consultarAlunosTurma($codturma){
            $pt = new ProfessorTurma();
            $pt->setCodigoturma($codturma);
            
            $pdao = new ProfessorTurmaDAO();
            return $resultado = $pdao-> consultarAlunosTurma($pt);
            
        }
    
    #################################################################
    ################## Relatórios do profturma ######################
    #################################################################

    public function relatorioGeralProfessorTurma(){
        $dao = new ProfessorTurmaDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralProfessorTurma();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoProfessorTurma($cod){
        $profturma = new ProfessorTurma();
        $profturma->setCodigoprofessorturma($cod);

        $dao = new ProfessorTurmaDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoProfessorTurma($profturma);
        // Retorna a periodo preenchido
        return $profturma;
    }
    
        
    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}






?>