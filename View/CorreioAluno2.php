<?php
session_start();
include_once("../Controller/AlunoCRUD.php");
//include("../Alert.html");
include_once("verificaUsuarioLogado.php"); 
            
            $cor = $_POST['cor']; 
            $sexo = $_POST['sexo'];
            $bairro = $_POST['bairro'];
            $nacionalidade = $_POST['nacionalidade'];
            $certidao = $_POST['certidao'];
            $id = $_POST['codigo'];
            $nome = $_POST['nome'];
            $rg = $_POST['rg'];
            $logra = $_POST['logradouro'];
            $ComplementoAluno = $_POST['complemento'];
            $numcasa = $_POST['ncasa'];
            $cep = $_POST['cep'];
            $cidade = $_POST['cidade'];
            $data = $_POST['datanasc'];
            $foto = (isset($_SESSION['fotoaluno'])) ? $_SESSION['fotoaluno'] : null;

            
                $aux = str_replace('/', '-', $data);
                $dataaluno = date('Y-m-d', strtotime($aux));

                $mandardados = new AlunoCRUD();
                $resultado = $mandardados->EditarAluno($id, $nome, $dataaluno, $nacionalidade, $sexo, $rg, $cor, $certidao, $logra, $ComplementoAluno, $numcasa, $cep, $bairro, $cidade, $foto);
                if($resultado){
                echo "<script> Alert.render('<h1>Aluno editado com sucesso!</h1>')</script>";
                
                    
                }else{
                echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o aluno...</h1>')</script>";   
                }
unset($_SESSION['fotoaluno']);
include_once("viewConsultarAluno.php");

?>


