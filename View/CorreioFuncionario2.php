<?php

//Correio que edita os dados do funcionario
include_once("../Controller/FuncionarioCRUD.php");
include_once("verificaUsuarioLogado.php");


    $listacargos = array();
            
            // Pega os dados do funcionario via POST e manda para uma classe Controller
            $id = $_POST['codigo']; 
            $nome = $_POST['nome'];
            $rg = $_POST['rg'];
            $cpf = $_POST['cpf'];
            $logradouro = $_POST['logradouro'];
            $complemento = $_POST['complemento'];
            $numcasa = $_POST['ncasa'];
            $cep = $_POST['cep'];
            $cidade = $_POST['cidade'];
            $listacargos = $_POST['cargos'];
            $email = $_POST['email'];

                //instanciando a classe CRUD e mandando os dados por parametro para o metodo editar
                $mandardados = new FuncionarioCRUD();
                $resultado = $mandardados->EditarFuncionario($id, $nome, $rg, $cpf, $logradouro, $complemento, $numcasa, $cep, $cidade, $listacargos, $email);

                 if($resultado){
                        echo "<script> Alert.render('<h1>Funcionário editado com sucesso!</h1>')</script>";
                    }else{
                        echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o Funcionário...</h1>')</script>";
                    }

        
include_once("viewConsultarFuncionario.php");
?>