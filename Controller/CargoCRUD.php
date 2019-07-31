<?php

 include_once("../DAO/CargoDAO.php");
 include_once("../Model/Cargo.php");
 
 
/**
 * Description of CargoCRUD
 *
 * @author laris
 */
class CargoCRUD {
     //Aqui estão todos os cruds do cargo
    
      public function CadastroCargo($nomecargo){
        
        $c = new Cargo();
        $c->setNome($nomecargo);
        
        $pdao = new CargoDAO();
        return $pdao->cadastrarCargo($c);
    
    }
    
      
    public function EditarCargo($id, $nome){
        
        $c = new Cargo();
        $c->setCodigo($id);
        $c->setNome($nome);
        
        $pdao = new CargoDAO();
        return $pdao->editarcargos($c);
  
    }
    
       public function ListarCargos(){
        $pdao = new CargoDAO();
        $var = array();
        return $var = $pdao->mostrarCargos();
        
    }
    
     public function ExcluirCargo($cod){
        $codigo = $cod;
        $pdao = new CargoDAO();
        return $pdao->exluirCargos($codigo);
    }
    
      public function ConsultaCargo($cod){
        $resultado = array();
        $codigo = $cod;
        $pdao = new CargoDAO();
        
        return $resultado[] = $pdao->consultardadosCargos($codigo);
    }
    
    #################################################################
    ################## Relatórios do Cargo ########################
    #################################################################

    public function relatorioGeralCargo(){
        $dao = new CargoDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralCargo();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoCargo($cod){
        $cargo = new Cargo();
        $cargo->setCodigo($cod);

        $dao = new CargoDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoCargo($cargo);
        // Retorna a periodo preenchido
        return $cargo;
    }
}
