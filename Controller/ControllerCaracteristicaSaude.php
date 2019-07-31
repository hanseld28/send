<?php
include_once("../DAO/DaoCaracteristicaSaude.php");
include_once("../Model/CaracteristicaSaude.php");


class ControllerCaracteristicaSaude {
    
    public function cadastrarCaracteristicaSaude($descCaracteristicaSaude){
        $novaCaracteristicaSaude = new CaracteristicaSaude();
        $novaCaracteristicaSaude->setDescricao($descCaracteristicaSaude);

        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        // Envia o objeto 'novaCaracteristicaSaude' para classe de acesso ao banco de dados
        $resultado = $daoCaracteristicaSaude->cadastrarCaracteristicaSaude($novaCaracteristicaSaude);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarCaracteristicaSaude(){
        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        // Requere uma lista de 'caracteristicas de saude' do objeto de acesso ao banco de dados
        $listaCaracteristicasSaude = $daoCaracteristicaSaude->consultarCaracteristicaSaude();
        // Retorna uma lista de graus escolares
        return $listaCaracteristicasSaude;
    }
    
    public function editarCaracteristicaSaude($codCaracteristicaSaude, $descCaracteristicaSaude){
        $editarCaracteristicaSaude = new CaracteristicaSaude();

        $editarCaracteristicaSaude->setId($codCaracteristicaSaude);
        $editarCaracteristicaSaude->setDescricao($descCaracteristicaSaude);
        
        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        // Envia o objeto 'editarCaracteristicaSaude' para classe de acesso ao banco de dados
        $resultado = $daoCaracteristicaSaude->editarCaracteristicaSaude($editarCaracteristicaSaude);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirCaracteristicaSaude($codCaracteristicaSaude){
        $caracteristicaSaude = new CaracteristicaSaude();

        $caracteristicaSaude->setId($codCaracteristicaSaude);

        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        // Envia o objeto 'caracteristicaSaude' para classe de acesso ao banco de dados
        $resultado = $daoCaracteristicaSaude->excluirCaracteristicaSaude($caracteristicaSaude);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherCaracteristicaSaude($codCaracteristicaSaude){ // '&' representa uma Passagem por Referência
        $caracteristicaSaude = new CaracteristicaSaude();

        $caracteristicaSaude->setId($codCaracteristicaSaude);

        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        
        $daoCaracteristicaSaude->preencherCaracteristicaSaude($caracteristicaSaude);

        return $caracteristicaSaude;
    }

    public function pesquisaAproximadaCaracteristicaSaude($descCaracteristicaSaude){
        $caracteristicaSaude = new CaracteristicaSaude();

        $caracteristicaSaude->setDescricao($descCaracteristicaSaude);

        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        // Requere uma lista de 'caracteristicas de saude' do objeto de acesso ao banco de dados
        $listaCaracteristicasSaude = $daoCaracteristicaSaude->pesquisaAproximadaCaracteristicaSaude($caracteristicaSaude);        
        // Retorna uma lista de caracteristicas de saude
        return $listaCaracteristicasSaude;
    }
    
    
    public function cadastrarCaracteristicaPorAluno($codprontuario, $codcaracteristica){
        $daoCaracteristicaSaude = new DaoCaracteristicaSaude();
        $daoCaracteristicaSaude->cadastrarCaracteristicaPorAluno($codprontuario, $codcaracteristica);
 
    }
    
    public function ExcluirCaracteristicaAluno($caracteristica){
        
        $dao = new DaoCaracteristicaSaude();
        $dao->ExcluirCaracteristicaAluno($caracteristica);
        
    }
    public function EditarCaracteristicaAluno($codigopront, $codcaracteristica){
        
        $dao = new DaoCaracteristicaSaude();
        $dao->EditarCaracteristicaAluno($codigopront, $codcaracteristica);
        
    }
    
    #################################################################
    ################## Relatórios da caracteristica saude ###########
    #################################################################

    public function relatorioGeralCaracteristicaSaude(){
        $daoc = new DaoCaracteristicaSaude();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $daoc->relatorioGeralCaracteristicaSaude();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoCaracteristicaSaude($cod){
        $cara = new CaracteristicaSaude();
        $cara->setId($cod);

        $dao = new DaoCaracteristicaSaude();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoCaracteristicaSaude($cara);
        // Retorna a periodo preenchido
        return $cara;
    }
    
}

?>