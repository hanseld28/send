<?php		
include_once("..\DAO\DaoAgenda.php");
include_once("..\Model\Agenda.php");
include_once("..\Model\Aluno.php");

class ControllerAgenda {
    
    public function cadastrarAgenda($codAluno){ 
    	$novaAgenda = new Agenda();        
        
        $aluno = new Aluno();

        $novaAgenda->addAluno($aluno);

        $novaAgenda->aluno->setCodigo($codAluno);

        $daoAgenda = new DaoAgenda();
        // Envia o objeto 'novaAgenda' para classe de acesso ao banco de dados
        $resultado = $daoAgenda->cadastrarAgenda($novaAgenda);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }
    
    public function consultarAgenda(){
        $daoAgenda = new DaoAgenda();
        // Requere uma lista de 'agendas' do objeto de acesso ao banco de dados
        $listaAgendas = $daoAgenda->consultarAgenda();
        // Retorna uma lista de agendas
        return $listaAgendas;
    }

   
    public function editarAgenda($codAgenda, $codAluno){
        $aluno = new Aluno();
        $aluno->setCodigo($codAluno);

        $editarAgenda = new Agenda();
        $editarAgenda->setId($codAgenda);    
        $editarAgenda->addAluno($aluno);

        $daoAgenda = new DaoAgenda();
        // Envia o objeto 'editarAgenda' para classe de acesso ao banco de dados
        $resultado = $daoAgenda->editarAgenda($editarAgenda);

        //var_dump($editarAgenda);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
       
    public function excluirAgenda($codAgenda){
        $excluirAgenda = new Agenda();

        $excluirAgenda->setId($codAgenda);

        $daoAgenda = new DaoAgenda();
        // Envia o objeto 'excluirAgenda' para classe de acesso ao banco de dados
        $resultado = $daoAgenda->excluirAgenda($excluirAgenda);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }

    public function preencherAgenda($codAgenda) { 
        $agenda = new Agenda();

        $agenda->setId($codAgenda);

        $daoAgenda = new DaoAgenda();
        
        $daoAgenda->preencherAgenda($agenda);

        $codAluno = $agenda->aluno->getCodigo();

        return $codAluno;
    }

    public function pesquisarAgendaAluno($codAluno) { 
        $aluno = new Aluno();

        $aluno->setCodigo($codAluno);

        $daoAgenda = new DaoAgenda();

        $agenda = $daoAgenda->pesquisarAgendaAluno($aluno);

        return $agenda;
    }
      
}

?>
