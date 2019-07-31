<?php		
include_once("..\DAO\DaoUsuario.php");
include_once("..\Model\Usuario.php");
include_once("..\Model\TipoUsuario.php");
include_once("..\Model\Criptografia.php");
include_once("..\Model\Agenda.php");
include_once("..\Model\Rotina.php");
include_once("..\Model\Turma.php");
include_once("..\Model\Card.php");
include_once("..\Model\Alternativa.php");
include_once("..\Model\Ocorrencia.php");

class ControllerUsuario {
    
    public function cadastrarUsuario($nomeUsuario, $loginUsuario, $senhaUsuario, $codTipoUsuario){ 
    	$novoUsuario = new Usuario();        
        
        $tipoUsuario = new TipoUsuario();

        $novoUsuario->addTipoUsuario($tipoUsuario);

        $criptografia = new Criptografia();
        
        $novoUsuario->setNome($nomeUsuario);
        $novoUsuario->setLogin($loginUsuario);
        $novoUsuario->setSenha($criptografia->encode($senhaUsuario));
        $novoUsuario->tipoUsuario->setId($codTipoUsuario);

        $daousuario = new DaoUsuario();
        // Envia o objeto 'novoUsuario' para classe de acesso ao banco de dados
        $resultado = $daousuario->cadastrarUsuario($novoUsuario);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarUsuario(){
        $daousuario = new DaoUsuario();
        // Requere uma lista de 'usuarios' do objeto de acesso ao banco de dados
        $listaUsuarios = $daousuario->consultarUsuario();
        // Retorna uma lista de usuarios
        return $listaUsuarios;
    }
    
    public function consultarUsuarioProfessor(){
        $daousuario = new DaoUsuario();
        $listaUsuarios = $daousuario->consultarUsuarioProfessor();
        return $listaUsuarios;
    }

    public function verificaEmail($email){

        $dao = new DaoUsuario();
        return $retorno = $dao->verificaEmail($email);

    }
    
    
    
    public function editarUsuario($codUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario, $codTipoUsuario){
        $tipoUsuario = new TipoUsuario();

        $editarUsuario = new Usuario();

        $criptografia = new Criptografia();

        $editarUsuario->setId($codUsuario);        
        $editarUsuario->setNome($nomeUsuario);
        $editarUsuario->setLogin($loginUsuario);
        $editarUsuario->setSenha($criptografia->encode($senhaUsuario));

        $editarUsuario->addTipoUsuario($tipoUsuario);
        $editarUsuario->tipoUsuario->setId($codTipoUsuario);

        $daousuario = new DaoUsuario();
        // Envia o objeto 'editarUsuario' para classe de acesso ao banco de dados
        $resultado = $daousuario->editarUsuario($editarUsuario);

        //var_dump($editarUsuario);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
   
    public function excluirUsuario($codUsuario){
        $excluirUsuario = new Usuario();

        $excluirUsuario->setId($codUsuario);

        $daousuario = new DaoUsuario(); 
        // Envia o objeto 'excluirUsuario' para classe de acesso ao banco de dados
        $resultado = $daousuario->excluirUsuario($excluirUsuario);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }

    public function editarSenha($codUsuario, $senha){
        $criptografia = new Criptografia();
        $senhaCri = $criptografia->encode($senha);

        $daousuario = new DaoUsuario(); 
        // Envia o objeto 'excluirUsuario' para classe de acesso ao banco de dados
        $resultado = $daousuario->editarSenha($codUsuario, $senhaCri);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }

    

    public function preencherUsuario($codUsuario){ // '&' representa uma Passagem por Referência
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $daousuario = new DaoUsuario();
        
        $daousuario->preencherUsuario($usuario);

        return $usuario;
    }

    public function logar($loginUsuario, $senhaUsuario, $codTipoUsuario, &$flag){
        $tipoUsuario = new TipoUsuario();

        $user = new Usuario();

        $criptografia = new Criptografia();
        
        $user->setLogin($loginUsuario);
        $user->setSenha($criptografia->encode($senhaUsuario));

        $user->addTipoUsuario($tipoUsuario);
        $user->tipoUsuario->setId($codTipoUsuario);

        $daousuario = new DaoUsuario();
        // Envia o objeto 'usuario' para classe de acesso ao banco de dados
        $usuario = $daousuario->logar($user, $flag);
               
        return $usuario;   
    }
    
    public function ultimoUsuario(){
        
        $dao = new DaoUsuario();
        return $retorno = $dao->ultimoUsuario();
        
    }

     public function descUsuario($cod){
        
        $dao = new DaoUsuario();
        return $retorno = $dao->descUsuario($cod);
        
    }
    
    public function dadosUltimoUsuario(){
        $dao = new DaoUsuario();
        return $retorno = $dao->dadosUltimoUsuario();
    }
    
    public function consultarFilhosResponsavel($codUsuario){
        $usuario = new Usuario();
        $usuario->setId($codUsuario);
        
        $dao = new DaoUsuario();
        $listaCriancas = $dao->consultarFilhosResponsavel($usuario);
        
        return $listaCriancas;
        
    }

    public function consultarRotinasCriancaResponsavel($codAgenda){
        $agenda = new Agenda();
        $agenda->setId($codAgenda);
        
        $daoUsuario = new DaoUsuario();
        $listaRotinas = $daoUsuario->consultarRotinasCriancaResponsavel($agenda);
    
        return $listaRotinas;
        
    }
    
  public function consultarRotinaEspecificaCrianca($codAgenda, $codRotina){
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $rotina = new Rotina();
        $rotina->setId(intval($codRotina));

        $daoUsuario = new DaoUsuario();
        $daoUsuario->consultarRotinaEspecificaCrianca($agenda, $rotina);
    
        return $rotina; 
    }
        
    #################################################################
    ################### Relatórios do Usuário #######################
    #################################################################

    public function relatorioGeralUsuario(){
        $daoUsuario = new DaoUsuario();
        // Requere uma lista de 'usuarios' do objeto de acesso ao banco de dados
        $listaUsuarios = $daoUsuario->relatorioGeralUsuario();
        // Retorna uma lista de usuarios
        return $listaUsuarios;
    }
    
    public function relatorioEspecificoUsuario($codUsuario){
        $usuario = new Usuario();
        $usuario->setId($codUsuario);

        $daoUsuario = new DaoUsuario();
        // Requere o 'usuario' preenchido do objeto de acesso ao banco de dados
        $daoUsuario->relatorioEspecificoUsuario($usuario);
        // Retorna a usuario preenchido
        return $usuario;
    }

       public function pesquisarAlunoAgenda($codAgenda) {
        $agenda = new Agenda();
        $agenda->setId($codAgenda);

        $daoUsuario = new DaoUsuario();
        $aluno = $daoUsuario->pesquisarAlunoAgenda($agenda);

        return $aluno;
    } 
}


?>