<?php
    
include_once("../DAO/DaoRotina.php");
include_once("../DAO/DaoOcorrencia.php");
include_once("../Model/Agenda.php");
include_once("../Model/Rotina.php");
include_once("../Model/Turma.php");
include_once("../Model/Card.php");
include_once("../Model/Alternativa.php");
include_once("../Model/Ocorrencia.php");
include_once("../Model/Usuario.php");

class ControllerRotina {
    
    public function cadastrarRotina($horarioEnvio, $codTurma, $codUsuario, $listaAgendas, $listaCards, $listaAlternativasCard, $listaOcorrencias)
    { 
        $qtdAlternativas = count($listaAlternativasCard);
        $qtdCards = count($listaCards);
        $limit = $qtdCards;
        

        $novaRotina = new Rotina();        
        $novaRotina->setHorarioEnvio($horarioEnvio);

        $turma = new Turma();
        $turma->setId($codTurma);
        $novaRotina->addTurma($turma);

        $usuario = new Usuario();
        $usuario->setId($codUsuario);
        $novaRotina->addProfessor($usuario);

        $arr_tmp_ocorrencias_agendas = array_flip($listaAgendas);

        $i = 0;
        foreach ($arr_tmp_ocorrencias_agendas as $key => $value) {
            
            $arr_tmp_ocorrencias_agendas[$key] = $listaOcorrencias[$i];

            $i++;
        }

        foreach ($arr_tmp_ocorrencias_agendas as $tmp_agenda => $tmp_ocorrencia) 
        {
            if($tmp_ocorrencia == "")
            {
                unset($arr_tmp_ocorrencias_agendas[$tmp_agenda]);
            }
        }

        foreach ($listaAgendas as $key => $idAgenda) 
        {
            $agenda = new Agenda();
            $agenda->setId(intval($idAgenda));
            $novaRotina->addAgenda($agenda);
            
            foreach ($listaCards as $key => $idCard) 
            {
                $card = new Card();
                $card->setId(intval($idCard));

                foreach ($listaAlternativasCard as $key => $idAlternativa) 
                {
                    $alternativa = new Alternativa();
                    $alternativa->setId(intval($idAlternativa)); // solução mais apropriada: $listaAlternativasCard[$i][$card->getId()
                    $card->addAlternativa($alternativa);

                    $novaRotina->addCard($card);
                        
                    unset($listaAlternativasCard[$key]);

                    break;                    
                }

                //unset($listaCards[$key]);
            } 
            
        } 

        $daoRotina = new DaoRotina();
        // Envia o objeto 'novaRotina' para classe de acesso ao banco de dados

        $resultado = $daoRotina->cadastrarRotina($novaRotina, $arr_tmp_ocorrencias_agendas, $limit);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
    }

    public function adicionarOcorrenciaRotina($listaAgendas, $listaOcorrencias, $codUsuario)
    {
        $novaRotina = new Rotina();  

        $usuario = new Usuario();
        $usuario->setId($codUsuario);
        $novaRotina->addProfessor($usuario);      

        $arr_tmp_ocorrencias_agendas = array_flip($listaAgendas);

        $i = 0;
        foreach ($arr_tmp_ocorrencias_agendas as $key => $value) {
            
            $arr_tmp_ocorrencias_agendas[$key] = $listaOcorrencias[$i];

            $i++;
        }

        foreach ($arr_tmp_ocorrencias_agendas as $tmp_agenda => $tmp_ocorrencia) 
        {
            if($tmp_ocorrencia == "")
            {
                unset($arr_tmp_ocorrencias_agendas[$tmp_agenda]);
            }
        }

        foreach ($listaAgendas as $key => $idAgenda) 
        {
            $agenda = new Agenda();
            $agenda->setId(intval($idAgenda));
            $novaRotina->addAgenda($agenda);
        } 

        $daoRotina = new DaoRotina();
        // Envia o objeto 'novaRotina' para classe de acesso ao banco de dados
        $resultado = $daoRotina->adicionarOcorrenciaRotina($novaRotina, $arr_tmp_ocorrencias_agendas);
        // Retorna o resultado do cadastro: true or false
        return $resultado;
           
    }

    public function checarRotinaEnviada($codAgenda)
    {
        $agenda = new Agenda();

        $agenda->setId($codAgenda);

        $daoRotina = new DaoRotina();

        $resultado = $daoRotina->checarRotinaEnviada($agenda);
        // Retorna o resultado da validação (true or false)
        return $resultado;
    }

    public function visualizarTodasRotinasEnviadas($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasEnviadas = $daoRotina->visualizarTodasRotinasEnviadas($usuario, $turma);

        return $listaRotinasEnviadas;
    }

    public function visualizarTodasRotinasEnviadasMaisAntigas($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasEnviadas = $daoRotina->visualizarTodasRotinasEnviadasMaisAntigas($usuario, $turma);

        return $listaRotinasEnviadas;
    }  

    public function visualizarRotinasEnviadasTodas($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasEnviadasDataAtual = $daoRotina->visualizarRotinasEnviadasDataAtual($usuario, $turma);

        return $listaRotinasEnviadasDataAtual;
    }

    public function visualizarRotinasEnviadasIntervaloData($codUsuario, $data_de, $data_ate, $nomeTurma)
    {
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasEnviadasIntervaloData = $daoRotina->visualizarRotinasEnviadasIntervaloData($usuario, $data_de, $data_ate, $turma);

        return $listaRotinasEnviadasIntervaloData;
    }

    public function visualizarTodasRotinasRecentes($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();

        $usuario->setId($codUsuario);

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasRecentes = $daoRotina->visualizarRotinasRecentes($usuario, $turma);

        return $listaRotinasRecentes;
    }


    public function dadosAnaliticosRotinasTurma($codTurma)
    {
        $turma = new Turma();

        $turma->setId($codTurma);

        $daoRotina = new DaoRotina();

        $resultado = $daoRotina->dadosAnaliticosRotinasTurma($turma);
        // Retorna o resultado da validação (true or false)
        return $resultado;
    } 


    public function dataUltimaRotinaEnviada($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId(intval($codUsuario));

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $ultimaRotinaEnviada = $daoRotina->dataUltimaRotinaEnviada($usuario, $turma);

        return $ultimaRotinaEnviada;
    }

     // Relatorios do Professor
    public function relatorioGeralTodasRotinasEnviadas($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId(intval($codUsuario));

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasEnviadas = $daoRotina->relatorioGeralTodasRotinasEnviadas($usuario, $turma);
   
        return $listaRotinasEnviadas;
    }

    public function relatorioGeralRotinasRecentes($codUsuario, $nomeTurma)
    {
        $usuario = new Usuario();
        $usuario->setId(intval($codUsuario));

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $daoRotina = new DaoRotina();

        $listaRotinasRecentes = $daoRotina->relatorioGeralRotinasRecentes($usuario, $turma);
   
        return $listaRotinasRecentes;
    }

    public function relatorioEspecificoRotina($codUsuario, $nomeTurma, $codRotina)
    {
        $usuario = new Usuario();
        $usuario->setId(intval($codUsuario));

        $turma = new Turma();
        $turma->setDescricao($nomeTurma);

        $rotina = new Rotina();
        $rotina->setId(intval($codRotina));

        $daoRotina = new DaoRotina();

        $daoRotina->relatorioEspecificoRotina($usuario, $turma, $rotina);

        return $rotina;
    }


      // Filtros - Agenda da Crianca
    public function buscarTodasRotinasRecebidas($codAgenda)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $daoRotina = new DaoRotina();

        $listaTodasRotinasRecebidas = $daoRotina->buscarTodasRotinasRecebidas($agenda);

        return $listaTodasRotinasRecebidas;
    }

    public function buscarRotinasRecebidasIntervaloData($codAgenda, $data_de, $data_ate)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $daoRotina = new DaoRotina();

        $listaRotinasRecebidasIntervaloData = $daoRotina->buscarRotinasRecebidasIntervaloData($agenda, $data_de, $data_ate);

        return $listaRotinasRecebidasIntervaloData;
    }

    public function buscarRotinasRecebidasMaisAntigas($codAgenda)
    {
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $daoRotina = new DaoRotina();

        $listaRotinasRecebidasMaisAntigas = $daoRotina->buscarRotinasRecebidasMaisAntigas($agenda);

        return $listaRotinasRecebidasMaisAntigas;
    }

    public function relatorioRotinaEspecificaCrianca($codAgenda, $codRotina){
        $agenda = new Agenda();
        $agenda->setId(intval($codAgenda));

        $rotina = new Rotina();
        $rotina->setId(intval($codRotina));

        $daoRotina = new DaoRotina();
        $daoRotina->relatorioRotinaEspecificaCrianca($agenda, $rotina);
    
        return $rotina; 
    }

    public function consultarRotina(){
        $daoRotina = new DaoRotina();
        // Requere uma lista de 'tipos de Rotina' do objeto de acesso ao banco de dados
        $listaRotinas = $daoRotina->consultarRotina();
        // Retorna uma lista de tipos de usuarios
        return $listaRotinas;
    }
    
    public function editarRotina($codRotina, $dataRotina, $codAluno, $codTurma, $codPeriodo){
        $editarRotina = new Rotina();
        $editarRotina->setId($codRotina);        
        $editarRotina->setData($dataRotina);

        $aluno = new Aluno();
        $aluno->setId($codAluno);
        $editarRotina->addAluno($aluno);

        $turma = new Turma();
        $turma->setId($codTurma);
        $editarRotina->addTurma($turma);

        $periodo = new Periodo();
        $periodo->setId($codPeriodo);
        $editarRotina->addPeriodo($periodo);

        $daoRotina = new DaoRotina();
        // Envia o objeto 'editarRotina' para classe de acesso ao banco de dados
        $resultado = $daoRotina->editarRotina($editarRotina);

        //var_dump($editarRotina);
        // Retorna o resultado da edição: true or false
        return $resultado;
    }
       
    public function excluirRotina($codRotina){
        $excluirRotina = new Rotina();

        $excluirRotina->setId($codRotina);

        $daoRotina = new DaoRotina();
        // Envia o objeto 'excluirRotina' para classe de acesso ao banco de dados
        $resultado = $daoRotina->excluirRotina($excluirRotina);
        // Retorna o resultado da exclusão: true or false
        return $resultado;
    }
    
    public function preencherRotina($codRotina){ 
        $Rotina = new Rotina();

        $Rotina->setId($codRotina);

        $daoRotina = new DaoRotina();
        
        $daoRotina->preencherRotina($Rotina);

        return $Rotina;
    }
    
    
        
}

?>