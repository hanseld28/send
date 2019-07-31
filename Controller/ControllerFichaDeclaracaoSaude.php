<?php
include_once("../DAO/DaoFichaDeclaracaoSaude.php");
include_once("../Model/FichaDeclaracaoSaude.php");
include_once("../Model/CaracteristicaSaude.php");


class ControllerFichaDeclaracaoSaude {
    
    public function cadastrarFichaDeclaracaoSaude($descFichaDeclaracaoSaude, $codCarateristicaSaude){
        $carateristicaSaude = new CaracteristicaSaude();
        $carateristicaSaude->setId($codCarateristicaSaude);

        $novaFichaDeclaracaoSaude = new FichaDeclaracaoSaude();
        $novaFichaDeclaracaoSaude->setDescricao($descFichaDeclaracaoSaude);
        $novaFichaDeclaracaoSaude->addCaracteristicaSaude($carateristicaSaude);

        $daoFichaDeclaracaoSaude = new DaoFichaDeclaracaoSaude();
        // Envia o objeto 'novaFichaDeclaracaoSaude' para classe de acesso ao banco de dados
        $resultado = $daoFichaDeclaracaoSaude->cadastrarFichaDeclaracaoSaude($novaFichaDeclaracaoSaude);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarFichaDeclaracaoSaude(){
        $daoFichaDeclaracaoSaude = new DaoFichaDeclaracaoSaude();
        // Requere uma lista de 'FichaDeclaracaos de saude' do objeto de acesso ao banco de dados
        $listaFichasDeclaracaoSaude = $daoFichaDeclaracaoSaude->consultarFichaDeclaracaoSaude();
        // Retorna uma lista com fichas de declaracao de saude
        return $listaFichasDeclaracaoSaude;
    }
    
    public function editarFichaDeclaracaoSaude($codFichaDeclaracaoSaude, $descFichaDeclaracaoSaude, $codCarateristicaSaude){
        $carateristicaSaude = new CaracteristicaSaude();
        $carateristicaSaude->setId($codCarateristicaSaude);

        $editarFichaDeclaracaoSaude = new FichaDeclaracaoSaude();
        $editarFichaDeclaracaoSaude->setId($codFichaDeclaracaoSaude);
        $editarFichaDeclaracaoSaude->setDescricao($descFichaDeclaracaoSaude);
        $editarFichaDeclaracaoSaude->addCaracteristicaSaude($caracteristicaSaude);

        $daoFichaDeclaracaoSaude = new DaoFichaDeclaracaoSaude();
        // Envia o objeto 'editarFichaDeclaracaoSaude' para classe de acesso ao banco de dados
        $resultado = $daoFichaDeclaracaoSaude->editarFichaDeclaracaoSaude($editarFichaDeclaracaoSaude);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirFichaDeclaracaoSaude($codFichaDeclaracaoSaude){
        $fichaDeclaracaoSaude = new FichaDeclaracaoSaude();

        $fichaDeclaracaoSaude->setId($codFichaDeclaracaoSaude);

        $daoFichaDeclaracaoSaude = new DaoFichaDeclaracaoSaude();
        // Envia o objeto 'ficha de declaracao de saude' para classe de acesso ao banco de dados
        $resultado = $daoFichaDeclaracaoSaude->excluirFichaDeclaracaoSaude($fichaDeclaracaoSaude);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherFichaDeclaracaoSaude($codFichaDeclaracaoSaude){ // '&' representa uma Passagem por Referência
        $fichaDeclaracaoSaude = new FichaDeclaracaoSaude();

        $fichaDeclaracaoSaude->setId($codFichaDeclaracaoSaude);

        $daoFichaDeclaracaoSaude = new DaoFichaDeclaracaoSaude();
        
        $daoFichaDeclaracaoSaude->preencherFichaDeclaracaoSaude($fichaDeclaracaoSaude);

        return $fichaDeclaracaoSaude;
    }

}

?>