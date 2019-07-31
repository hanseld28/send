<?php       
include_once("..\DAO\DaoCard.php");
include_once("..\Model\Card.php");


class ControllerCard {
    
    public function cadastrarCard($descCard){ 
        $novoCard = new Card();        
        $novoCard->setDescricao($descCard);

        $daoCard = new DaoCard();
        // Envia o objeto 'Card' para classe de acesso ao banco de dados
        $resultado = $daoCard->cadastrarCard($novoCard);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarCard(){
        $daoCard = new DaoCard();
        // Requere uma lista de 'cards' do objeto de acesso ao banco de dados
        $listaCards = $daoCard->consultarCard();
        // Retorna uma lista de cards
        return $listaCards;
    }
    
    public function editarCard($codCard, $descCard){
        $daoCard = new DaoCard();

        $editarCard = new Card();

        $editarCard->setId($codCard);        
        $editarCard->setDescricao($descCard);

        // Envia o objeto 'Card' para classe de acesso ao banco de dados
        $resultado = $daoCard->editarCard($editarCard);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
    
    public function excluirCard($codCard){
        $daoCard = new DaoCard();
        
        $card = new Card();
        $card->setId($codCard);
        // Envia o objeto 'excluirCard' para classe de acesso ao banco de dados
        $resultado = $daoCard->excluirCard($card);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherCard($codCard){ // '&' representa uma Passagem por Referência
    $daoCard = new DaoCard();
    
    $card = new Card();
    $card->setId($codCard);

    $daoCard->preencherCard($card);

    return $card;
}


    #################################################################
    ################## Relatórios do Cargo ########################
    #################################################################

public function relatorioGeralCard(){
    $dao = new DaoCard();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
    $lista = $dao->relatorioGeralCard();
        // Retorna uma lista de periodos
    return $lista;
}

public function relatorioEspecificoCard($cod){
    $card = new Card();
    $card->setId($cod);

    $dao = new DaoCard();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
    $dao->relatorioEspecificoCard($card);
        // Retorna a periodo preenchido
    return $card;
}

}

?>