<?php		
include_once("..\DAO\DaoTipoUsuario.php");
include_once("..\Model\TipoUsuario.php");


class ControllerTipoUsuario {
    
    public function cadastrarTipoUsuario($descTipoUsuario){ 
    	$novoTipoUsuario = new TipoUsuario();        
        $novoTipoUsuario->setDescricao($descTipoUsuario);

        $daotipousuario = new DaoTipoUsuario();
        // Envia o objeto 'tipoUsuario' para classe de acesso ao banco de dados
        $resultado = $daotipousuario->cadastrarTipoUsuario($novoTipoUsuario);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
   
    public function consultarTipoUsuario(){
        $daotipousuario = new DaoTipoUsuario();
        // Requere uma lista de 'tipos de usuario' do objeto de acesso ao banco de dados
        $listaTiposUsuario = $daotipousuario->consultarTipoUsuario();
        // Retorna uma lista de tipos de usuarios
        return $listaTiposUsuario;
    }
    
     public function consultarTipoUsuarioFuncionario(){
        $daotipousuario = new DaoTipoUsuario();
        // Requere uma lista de 'tipos de usuario' do objeto de acesso ao banco de dados
        $listaTiposUsuario = $daotipousuario->consultarTipoUsuarioFuncionario();
        // Retorna uma lista de tipos de usuarios
        return $listaTiposUsuario;
    }
    
    public function editarTipoUsuario($codTipoUsuario, $descTipoUsuario){
        $daotipousuario = new DaoTipoUsuario();

        $editarTipoUsuario = new TipoUsuario();

        $editarTipoUsuario->setId($codTipoUsuario);        
        $editarTipoUsuario->setDescricao($descTipoUsuario);

        // Envia o objeto 'tipoUsuario' para classe de acesso ao banco de dados
        $resultado = $daotipousuario->editarTipoUsuario($editarTipoUsuario);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirTipoUsuario($codTipoUsuario){
        $daotipousuario = new DaoTipoUsuario();
        // Envia o objeto 'excluirTipoUsuario' para classe de acesso ao banco de dados
        $resultado = $daotipousuario->excluirTipoUsuario($codTipoUsuario);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherTipoUsuario($codTipoUsuario){ // '&' representa uma Passagem por Referência
        $daotipousuario = new DaoTipoUsuario();
        
        $descTipoUsuario = $daotipousuario->preencherTipoUsuario($codTipoUsuario);

        return $descTipoUsuario;
    }
    
    #################################################################
    ############### Relatórios do Tipo de Usuário ###################
    #################################################################
    public function relatorioGeralTipoUsuario(){
        $daoTipoUsuario = new DaoTipoUsuario();
        // Requere uma lista de 'tiposUsuario' do objeto de acesso ao banco de dados
        $listaTiposUsuario = $daoTipoUsuario->relatorioGeralTipoUsuario();
        // Retorna uma lista de tipos de usuario
        return $listaTiposUsuario;
    }
    
    public function relatorioEspecificoTipoUsuario($codTipoUsuario){
        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->setId($codTipoUsuario);

        $daoTipoUsuario = new DaoTipoUsuario();
        // Requere o 'TipoUsuario' preenchido do objeto de acesso ao banco de dados
        $daoTipoUsuario->relatorioEspecificoTipoUsuario($tipoUsuario);
        // Retorna o tipo de usuario preenchido
        return $tipoUsuario;
    }

}

?>