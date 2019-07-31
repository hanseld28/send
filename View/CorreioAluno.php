<?php

//includes
include_once("../Controller/ResponsavelCRUD.php");
include_once("../Controller/AlunoCRUD.php");
include_once("../Controller/ControllerMatricula.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Controller/ControllerAgenda.php");
include_once("../Model/Senha.php");

    //variáveis
    $login;
    $senha;
    //dados vindos do ajax via post
    $dataGeneric = $_POST['datanasc'];
    $nomealuno = $_POST['nomealuno'];
    $rgaluno = $_POST['rgaluno'];
    $logradouroaluno = $_POST['logradouro'];
    $complementoaluno = $_POST['complemento'];
    $numcasaaluno = $_POST['ncasa'];
    $cepaluno = $_POST['cep'];
    $cidadealuno = $_POST['cidade'];
    $sel = $_POST['select'];



        //conversao de datas
        $aux = str_replace('/', '-', $dataGeneric);
        $dataaluno = date('Y-m-d', strtotime($aux));


                        $ca = new AlunoCRUD();
                        $ca->CadastrarAluno($nomealuno, $rgaluno, $dataaluno, $logradouroaluno, $complementoaluno, $numcasaaluno, $sel, $cepaluno, $cidadealuno);

                        
                        // Cadastro da agenda para o aluno
                        $controllerAgenda = new ControllerAgenda();
                        $codAluno = intval($ca->UltimoAluno());
                        $resposta = $controllerAgenda->cadastrarAgenda($codAluno);
                        
                        if($resposta){
                            include_once("pageCadastroResponsavel.php");
                        }

                  }

    


