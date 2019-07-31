<?php
include_once("..\DAO\DaoPeriodo.php");
include_once("..\Model\Periodo.php");


class ControllerPeriodo {
    
    public function cadastrarPeriodo($descPeriodo, $horarioPeriodo){
        $novoPeriodo = new Periodo();

        $novoPeriodo->setDescricao($descPeriodo);
        $novoPeriodo->setHorario($horarioPeriodo);

        $daoperiodo = new DaoPeriodo();
        // Envia o objeto 'novoPeriodo' para classe de acesso ao banco de dados
        $resultado = $daoperiodo->cadastrarPeriodo($novoPeriodo);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarPeriodo(){
        $daoperiodo = new DaoPeriodo();
        // Requere uma lista de 'tipos de Periodo' do objeto de acesso ao banco de dados
        $listaPeriodos = $daoperiodo->consultarPeriodo();
        // Retorna uma lista de graus escolares
        return $listaPeriodos;
    }
    
    public function editarPeriodo($codPeriodo, $descPeriodo, $horarioPeriodo){
        $periodo = new Periodo();

        $periodo->setId($codPeriodo);
        $periodo->setDescricao($descPeriodo);
        $periodo->setHorario($horarioPeriodo);

        $daoperiodo = new DaoPeriodo();
        // Envia o objeto 'editarPeriodo' para classe de acesso ao banco de dados
        $resultado = $daoperiodo->editarPeriodo($periodo);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
    
    public function excluirPeriodo($codPeriodo){
        $periodo = new Periodo();

        $periodo->setId($codPeriodo);

        $daoperiodo = new DaoPeriodo();
        // Envia o objeto 'excluirPeriodo' para classe de acesso ao banco de dados
        $resultado = $daoperiodo->excluirPeriodo($periodo);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }

    public function preencherPeriodo($codPeriodo){ // '&' representa uma Passagem por Referência
        $periodo = new Periodo();

        $periodo->setId($codPeriodo);

        $daoperiodo = new DaoPeriodo();
        
        $daoperiodo->preencherPeriodo($periodo);

        return $periodo;
    }
    
    #################################################################
    ################## Relatórios do Período ########################
    #################################################################

    public function relatorioGeralPeriodo(){
        $daoPeriodo = new DaoPeriodo();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $listaPeriodos = $daoPeriodo->relatorioGeralPeriodo();
        // Retorna uma lista de periodos
        return $listaPeriodos;
    }
    
    public function relatorioEspecificoPeriodo($codPeriodo){
        $periodo = new Periodo();
        $periodo->setId($codPeriodo);

        $daoPeriodo = new DaoPeriodo();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $daoPeriodo->relatorioEspecificoPeriodo($periodo);
        // Retorna a periodo preenchido
        return $periodo;
    }
    
}

?>