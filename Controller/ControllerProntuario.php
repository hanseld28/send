<?php
include_once("../DAO/DaoProntuario.php");
include_once("../Model/Prontuario.php");
include_once("../Model/Aluno.php");
include_once("../Model/GrauEscolar.php");


class ControllerProntuario {
    
    public function cadastrarProntuario($codAluno, $tipo, $deficiencia, $problema, $doenca, $tratamento,  $alergia, $medicacao){
       $novoProntuario = new Prontuario();
       $aluno = new Aluno();
       $aluno->setCodigo($codAluno);
       $novoProntuario->addAluno($aluno);
       $novoProntuario->setTiposanguineo($tipo);
       $novoProntuario->setDeficiencia($deficiencia);
       $novoProntuario->setProblemasaude($problema);
       $novoProntuario->setDoencacontagiosa($doenca);
       $novoProntuario->setTratamentocirurgico($tratamento);
       $novoProntuario->setAlergia($alergia);
       $novoProntuario->setMedicacao($medicacao);

       $daoProntuario = new DaoProntuario();
        // Envia o objeto 'novo prontuario' para classe de acesso ao banco de dados
       $resultado = $daoProntuario->cadastrarProntuario($novoProntuario);
        // Retorna o resultado do cadastro: true or false
       return $resultado;
   } 
   
   public function consultarProntuario($cod){
    $a = new Prontuario();
    $a->setId($cod);
    
    $daoProntuario = new DaoProntuario();
        // Requere uma lista de 'prontuarios' do objeto de acesso ao banco de dados
    $listaProntuarios = $daoProntuario->consultarProntuario($a);
        // Retorna uma lista com prontuarios
    return $listaProntuarios;
}

public function editarProntuario($codProntuario, $tipo, $deficiencia, $problema, $doenca, $tratamento,$tratamento, $alergia, $medicacao){

    $editarProntuario = new Prontuario();
    $editarProntuario->setId($codProntuario);
    $editarProntuario->setTiposanguineo($tipo);
    $editarProntuario->setDeficiencia($deficiencia);
    $editarProntuario->setProblemasaude($problema);
    $editarProntuario->setDoencacontagiosa($doenca);
    $editarProntuario->setTratamentocirurgico($tratamento);
    $editarProntuario->setAlergia($alergia);
    $editarProntuario->setMedicacao($medicacao);


    $daoProntuario = new DaoProntuario();
        // Envia o objeto 'editar prontuario' para classe de acesso ao banco de dados
    $resultado = $daoProntuario->editarProntuario($editarProntuario);
        // Retorna o resultado da edição: true or false
    return $resultado;
}

public function excluirProntuario($codProntuario){
    $prontuario = new Prontuario();

    $prontuario->setId($codProntuario);

    $daoProntuario = new DaoProntuario();
        // Envia o objeto 'prontuario' para classe de acesso ao banco de dados
    $resultado = $daoProntuario->excluirProntuario($prontuario);
        // Retorna o resultado da exclusão: true or false
    return $resultado;
}

    public function preencherProntuario($codProntuario){ // '&' representa uma Passagem por Referência
    $prontuario = new Prontuario();

    $prontuario->setId($codProntuario);

    $daoProntuario = new DaoProntuario();
    
    $daoProntuario->preencherProntuario($prontuario);

    return $prontuario;
}

public function pesquisarProntuarioAluno($cod){
    $dao = new DaoProntuario();
    $prontuario = $dao->pesquisarProntuarioAluno($cod);
    return $prontuario;
}

public function relatorioEspecificoProntuario($codProntuario){
    $pront = new Prontuario();
    $pront->setId($codProntuario);

    $daoProntuario = new DaoProntuario();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
    $daoProntuario->relatorioEspecificoProntuario($pront);
        // Retorna a periodo preenchido
    return $pront;
}


}

?>