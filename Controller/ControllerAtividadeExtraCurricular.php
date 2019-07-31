<?php
include_once("../DAO/DaoAtividadeExtraCurricular.php");
include_once("../Model/AtividadeExtraCurricular.php");


class ControllerAtividadeExtraCurricular {
    
    public function cadastrarAtividadeExtraCurricular($descAtividadeExtraCurricular) {
        $novaAtividadeExtraCurricular = new AtividadeExtraCurricular();
        $novaAtividadeExtraCurricular->setDescricao($descAtividadeExtraCurricular);

        $daoatividadeextracurricular = new daoAtividadeExtraCurricular();
        // Envia o objeto 'novaAtividadeExtraCurricular' para classe de acesso ao banco de dados
        $resultado = $daoatividadeextracurricular->cadastrarAtividadeExtraCurricular($novaAtividadeExtraCurricular);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarAtividadeExtraCurricular() {
        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        // Requere uma lista de 'atividades extra curriculares' do objeto de acesso ao banco de dados
        $listaAtividadesExtraCurriculares = $daoatividadeextracurricular->consultarAtividadeExtraCurricular();
        // Retorna uma lista de 'atividades extra curriculares'
        return $listaAtividadesExtraCurriculares;
    }
    
    public function editarAtividadeExtraCurricular($codAtividadeExtraCurricular, $descAtividadeExtraCurricular) {
        $atividadeExtraCurricular = new AtividadeExtraCurricular();

        $atividadeExtraCurricular->setId($codAtividadeExtraCurricular);
        $atividadeExtraCurricular->setDescricao($descAtividadeExtraCurricular);
        
        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        // Envia o objeto 'editarAtividadeExtraCurricular' para classe de acesso ao banco de dados
        $resultado = $daoatividadeextracurricular->editarAtividadeExtraCurricular($atividadeExtraCurricular);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }

    public function editarAtividadeMatricula($codMatricula, $atividades) {
        $atividadeExtraCurricular = new AtividadeExtraCurricular();
        $listaAtv = new ArrayObject();
        foreach($atividades as $atvs){
            $atividade = new AtividadeExtraCurricular();
            $atividade->setId($atvs);
            $listaAtv->append($atividade);

        }
        
        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        // Envia o objeto 'editarAtividadeExtraCurricular' para classe de acesso ao banco de dados
        $resultado = $daoatividadeextracurricular->editarAtividadeMatricula($codMatricula, $listaAtv);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirAtividadeExtraCurricular($codAtividadeExtraCurricular){
        $atividadeExtraCurricular = new AtividadeExtraCurricular();

        $atividadeExtraCurricular->setId($codAtividadeExtraCurricular);

        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        // Envia o objeto 'excluirAtividadeExtraCurricular' para classe de acesso ao banco de dados
        $resultado = $daoatividadeextracurricular->excluirAtividadeExtraCurricular($atividadeExtraCurricular);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherAtividadeExtraCurricular($codAtividadeExtraCurricular){ // '&' representa uma Passagem por Referência
        $atividadeExtraCurricular = new AtividadeExtraCurricular();

        $atividadeExtraCurricular->setId($codAtividadeExtraCurricular);

        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        
        $descAtividadeExtraCurricular = $daoatividadeextracurricular->preencherAtividadeExtraCurricular($atividadeExtraCurricular);

        return $descAtividadeExtraCurricular;
    } 

    public function consultarPorMatricula($codMatricula){ // '&' representa uma Passagem por Referência
        

        $daoatividadeextracurricular = new DaoAtividadeExtraCurricular();
        
        $atividades = $daoatividadeextracurricular->consultarPorMatricula($codMatricula);

        return $atividades;
    }
    
    public function cadastrarAtividadeAluno($codAtividade, $codMatricula){
        
        $daoatividade = new DaoAtividadeExtraCurricular();
        $daoatividade->CadastrarAtividadeAluno($codAtividade, $codMatricula);
        
        
    }
    
    #################################################################
    ################## Relatórios da atividade ######################
    #################################################################

    public function relatorioGeralAtividade(){
        $dao = new DaoAtividadeExtraCurricular();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralAtividade();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoAtividade($cod){
        $atividade = new AtividadeExtraCurricular();
        $atividade->setId($cod);

        $dao = new DaoAtividadeExtraCurricular();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoAtividade($atividade);
        // Retorna a periodo preenchido
        return $atividade;
    }

  
}

?>