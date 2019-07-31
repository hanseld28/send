<?php
	
include_once("../DAO/DaoComunicado.php");
include_once("../Model/Agenda.php");
include_once("../Model/Comunicado.php");
include_once("../Model/Turma.php");
include_once("../Model/Usuario.php");

class ControllerComunicado {
    
    public function cadastrarComunicado($listaAgendas, $codTurma, $codUsuario, $txtAssunto, $txtComunicado)
    { 
    	$novoComunicado = new Comunicado();
        $novoComunicado->setAssunto($txtAssunto);        
        $novoComunicado->setDescricao($txtComunicado);

        $turma = new Turma();
        $turma->setId($codTurma);
        $novoComunicado->addTurma($turma);

        $usuario = new Usuario();
        $usuario->setId($codUsuario);
        $novoComunicado->addUsuario($usuario);

        foreach ($listaAgendas as $idAgenda) 
        {
            $agenda = new Agenda();
            $agenda->setId(intval($idAgenda));
            $novoComunicado->addAgenda($agenda);
        }
        
        $daoComunicado = new DaoComunicado();
        // Envia o objeto 'novaComunicado' para classe de acesso ao banco de dados
        $resultado = $daoComunicado->cadastrarComunicado($novoComunicado);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }

	public function visualizarTodosComunicadosEnviados($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoComunicado = new DaoComunicado();

        $listaComunicadosEnviados = $daoComunicado->visualizarTodosComunicadosEnviados($usuario, $turma);

        return $listaComunicadosEnviados;
    }

    public function visualizarComunicadosMaisAntigos($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoComunicado = new DaoComunicado();

        $listaComunicadosMaisAntigos = $daoComunicado->visualizarComunicadosMaisAntigos($usuario, $turma);

        return $listaComunicadosMaisAntigos;
    }

    public function visualizarComunicadosRecentes($codUsuario, $nomeTurma, $limite)
    {
        $usuario = new Usuario();
        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoComunicado = new DaoComunicado();

        $listaComunicadosRecentes = $daoComunicado->visualizarComunicadosRecentes($usuario, $turma, $limite);

        return $listaComunicadosRecentes;
    }


    public function visualizarComunicadosEnviadosIntervaloData($codUsuario, $data_de, $data_ate, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoComunicado = new DaoComunicado();

        $listaComunicadosEnviadosIntervaloData = $daoComunicado->visualizarComunicadosEnviadosIntervaloData($usuario, $data_de, $data_ate, $turma);

        return $listaComunicadosEnviadosIntervaloData;
    }


    public function buscarTodosComunicadosRecebidos($codAgenda)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $daoComunicado = new DaoComunicado();

        $listaComunicadosRecebidos = $daoComunicado->buscarTodosComunicadosRecebidos($agenda);

        return $listaComunicadosRecebidos;
    }

   public function visualizarComunicadoRecebido($codAgenda, $codComunicado)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $comunicado = new Comunicado();
        $comunicado->setId(intval($codComunicado));

        $daoComunicado = new DaoComunicado();

        $daoComunicado->visualizarComunicadoRecebido($agenda, $comunicado);

        return $comunicado;
    }


    public function contarComunicadosRecebidos($codAgenda)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $daoComunicado = new DaoComunicado();

        $qtd_comunicados = $daoComunicado->contarComunicadosRecebidos($agenda);

        return $qtd_comunicados;
    }


}

?>