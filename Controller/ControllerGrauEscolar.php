<?php
include_once("..\DAO\DaoGrauEscolar.php");
include_once("..\Model\GrauEscolar.php");


class ControllerGrauEscolar {
    
    public function cadastrarGrauEscolar($descGrauEscolar, $codPeriodo){
        $novoGrauEscolar = new GrauEscolar();
        $periodo = new Periodo();
        $novoGrauEscolar->AddPeriodo($periodo);
        $novoGrauEscolar->setDescricao($descGrauEscolar);
        $novoGrauEscolar->periodo->setId($codPeriodo);
        $daograuescolar = new DaoGrauEscolar();
        // Envia o objeto 'novoGrauEscolar' para classe de acesso ao banco de dados
        $resultado = $daograuescolar->cadastrarGrauEscolar($novoGrauEscolar);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarGrauEscolar(){
        $daograuescolar = new DaoGrauEscolar();
        // Requere uma lista de 'tipos de usuario' do objeto de acesso ao banco de dados
        $listaGrausEscolares = $daograuescolar->consultarGrauEscolar();
        // Retorna uma lista de graus escolares
        return $listaGrausEscolares;
    }
    
        public function consultarGrauEscolar2(){
        $daograuescolar = new DaoGrauEscolar();
        // Requere uma lista de 'tipos de usuario' do objeto de acesso ao banco de dados
        $listaGrausEscolares = $daograuescolar->consultarGrauEscolar2();
        // Retorna uma lista de graus escolares
        return $listaGrausEscolares;
    }
    
    public function editarGrauEscolar($codGrauEscolar, $descGrauEscolar, $codPeriodo){
        $grauEscolar = new GrauEscolar();
        $periodo = new Periodo();
        $periodo->setId($codPeriodo);
        $grauEscolar->AddPeriodo($periodo);
        $grauEscolar->setId($codGrauEscolar);
        $grauEscolar->setDescricao($descGrauEscolar);
        
        
        $daograuescolar = new DaoGrauEscolar();
        // Envia o objeto 'editarGrauEscolar' para classe de acesso ao banco de dados
        $resultado = $daograuescolar->editarGrauEscolar($grauEscolar);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirGrauEscolar($codGrauEscolar){
        $grauEscolar = new GrauEscolar();

        $grauEscolar->setId($codGrauEscolar);

        $daograuescolar = new DaoGrauEscolar();
        // Envia o objeto 'excluirGrauEscolar' para classe de acesso ao banco de dados
        $resultado = $daograuescolar->excluirGrauEscolar($grauEscolar);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherGrauEscolar($codGrauEscolar){ // '&' representa uma Passagem por Referência
        $grauEscolar = new GrauEscolar();

        $grauEscolar->setId($codGrauEscolar);

        $daograuescolar = new DaoGrauEscolar();
        
        $descGrauEscolar = $daograuescolar->preencherGrauEscolar($grauEscolar);

        return $descGrauEscolar;
    }
    
    #################################################################
    ################## Relatórios do Grau Escolar ###################
    #################################################################
    public function relatorioGeralGrauEscolar(){
        $daoGrauEscolar = new DaoGrauEscolar();
        // Requere uma lista de 'grausEscolares' do objeto de acesso ao banco de dados
        $listaGrausEscolares = $daoGrauEscolar->relatorioGeralGrauEscolar();
        // Retorna uma lista de graus escolares
        return $listaGrausEscolares;
    }

    public function relatorioEspecificoGrauEscolar($codGrauEscolar){
        $grauEscolar = new GrauEscolar();
        $grauEscolar->setId($codGrauEscolar);

        $daoGrauEscolar = new DaoGrauEscolar();
        // Requere o 'grauEscolar' preenchido do objeto de acesso ao banco de dados
        $daoGrauEscolar->relatorioEspecificoGrauEscolar($grauEscolar);
        // Retorna a grau escolar preenchido
        return $grauEscolar;
    }
}

?>