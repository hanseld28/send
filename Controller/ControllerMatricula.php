<?php
	
include_once("../DAO/DaoMatricula.php");
include_once("../Model/Matricula.php");
include_once("../Model/Aluno.php");
include_once("../Model/Turma.php");

class ControllerMatricula {
    
    public function cadastrarMatricula($dataMatricula, $codAluno, $codTurma, $numero){ 
    	$novaMatricula = new Matricula();        
        
        $aluno = new Aluno();
        
        $turma = new Turma();

        $novaMatricula->addAluno($aluno);
        $novaMatricula->addTurma($turma);

        $novaMatricula->setData($dataMatricula);
        $novaMatricula->setNumero($numero);
        $novaMatricula->aluno->setCodigo($codAluno);
        
        $novaMatricula->turma->setId($codTurma);    

        $daomatricula = new DaoMatricula();
        // Envia o objeto 'novaMatricula' para classe de acesso ao banco de dados
        $resultado = $daomatricula->cadastrarMatricula($novaMatricula);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarMatricula(){
        $daoMatricula = new DaoMatricula();
        // Requere uma lista de 'tipos de Matricula' do objeto de acesso ao banco de dados
        $listaMatriculas = $daoMatricula->consultarMatricula();
        // Retorna uma lista de tipos de usuarios
        return $listaMatriculas;
    }
    
    public function editarMatricula($codMatricula, $dataMatricula, $codTurma, $numero){
   $editarMatricula = new Matricula();
        $editarMatricula->setId($codMatricula);        
        $editarMatricula->setData($dataMatricula);
        $editarMatricula->setNumero($numero);

        $turma = new Turma();
        $turma->setId($codTurma);
        $editarMatricula->addTurma($turma);

        $daoMatricula = new DaoMatricula();
        // Envia o objeto 'editarMatricula' para classe de acesso ao banco de dados
        $resultado = $daoMatricula->editarMatricula($editarMatricula);

        //var_dump($editarMatricula);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
       
    public function excluirMatricula($codMatricula){
        $excluirMatricula = new Matricula();

        $excluirMatricula->setId($codMatricula);

        $daoMatricula = new DaoMatricula();
        // Envia o objeto 'excluirMatricula' para classe de acesso ao banco de dados
        $resultado = $daoMatricula->excluirMatricula($excluirMatricula);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherMatricula($codMatricula){ 
        $matricula = new Matricula();

        $matricula->setId($codMatricula);

        $daoMatricula = new DaoMatricula();
        
        $daoMatricula->preencherMatricula($matricula);

        return $matricula;
    }
    
    public function preencherMatriculaPorAluno($codAluno){ 
        $matricula = new Matricula();

        $aluno = new Aluno();
        $aluno->setCodigo($codAluno);
        $matricula->addAluno($aluno);

        $daoMatricula = new DaoMatricula();
        
        $daoMatricula->preencherMatriculaPorAluno($matricula);

        return $matricula;
    }

    public function ultimaMatricula(){
        $daoMatricula = new DaoMatricula();
        return $resultado = $daoMatricula->ultimaMatricula();
    }
    
    #################################################################
    ################## Relatórios da Matricula ######################
    #################################################################

    public function relatorioGeralMatricula(){
        $dao = new DaoMatricula();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralMatricula();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoMatricula($cod){
        $matricula = new Matricula();
        $matricula->setId($cod);

        $dao = new DaoMatricula();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoMatricula($matricula);
        // Retorna a periodo preenchido
        return $matricula;
    }
	
	    
}

?>