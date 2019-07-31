<?php

include_once("../DAO/ItemCronogramaDAO.php");
include_once("../Model/ItemCronograma.php");
/**
 * Description of ItemCronogramaCRUD
 *
 * @author laris
 */
class ItemCronogramaCRUD {
    //crud dos itens do cronograma;
    
    public function CadastroItem($nomeItem,$horarioItem){
        
        $item = new ItemCronograma();
        $item->setNome($nomeItem);
        $item->setHorario($horarioItem);
        
        $pdao = new ItemCronogramaDAO();
        return $pdao->cadastrarItemCronograma($item);
    
    }
    public function cadastrarCronogramaTurma($codcronograma, $itemcronograma){
        $dao = new ItemCronogramaDAO();
        $dao->cadastrarCronogramaTurma($codcronograma, $itemcronograma);
        
    }
    
     public function EditarItem($id, $nome, $horario){
        
        $item = new ItemCronograma();
        $item->setNome($nome);
        $item->setCodigo($id);
        $item->setHorario($horario);
        
        $pdao = new ItemCronogramaDAO();
        return $pdao->editarItemCronograma($item);
        
        
    }
    
     public function ListarItensCronograma(){
        
        $pdao = new ItemCronogramaDAO();
        $lista = $pdao->mostrarItemCronograma();
        return $lista;
    }
    
       public function ListarItensCronograma2(){
        
        $pdao = new ItemCronogramaDAO();
        $lista = $pdao->mostrarItemCronograma2();
        return $lista;
    }
    
     public function ExcluirItensCronograma($cod){
        
        $codigo = $cod;
        $pdao = new ItemCronogramaDAO();
        return $pdao->excluirItemCronograma($codigo);
        
    }
    
    public function consultaItensCronograma($cod){
        
        $resultado = array();
        $codigo = $cod;
        $pdao = new ItemCronogramaDAO();
        
        return $resultado[] = $pdao->consultardadosItemCronograma($codigo);
        
    }
    
    public function ExcluirCronogramaTurma($cod){
        
        $pdao = new ItemCronogramaDAO();
        $pdao->ExcluirCronogramaTurma($cod);
        
    }
    
    public function EditarCronogramaTurma($cod, $item){
        
        $pdao = new ItemCronogramaDAO();
        $pdao->EditarCronogramaTurma($cod, $item);
       
        
    }
    
    #################################################################
    ################## Relatórios do ItemC ronograma ################
    #################################################################

    public function relatorioGeralItemCronograma(){
        $daoItem = new ItemCronogramaDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $daoItem->relatorioGeralItemCronograma();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoItemCronograma($cod){
        $item = new ItemCronograma();
        $item->setCodigo($cod);

        $daoItem = new ItemCronogramaDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $daoItem->relatorioEspecificoItemCronograma($item);
        // Retorna a periodo preenchido
        return $item;
    }
    
    
}
