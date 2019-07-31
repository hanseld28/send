<?php
    include_once("verificaUsuarioLogado.php");
    include_once("../Controller/ControllerRotina.php");

   //var_dump($_POST);

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        session_start();
        $codUsuario = intval($_SESSION["codUsuario"]);
        
        // Valida cadastro do Rotina 
        try {

            if (isset($_POST["codTurma"]) && isset($_POST["cards"]) && isset($_POST["ocorrencias"]) && isset($_POST["agendas"]) && isset($_POST["altCard"]) && isset($_POST["horarioEnvio"]))
            {    

                //header("Location: ..\index.php");          
                $listaAgendas = $_POST["agendas"];
                $listaCards = $_POST["cards"];
                $listaAlternativasCard = $_POST["altCard"];
                $listaOcorrencias = $_POST["ocorrencias"];
                $codTurma = intval($_POST["codTurma"]);
                $horarioEnvio = $_POST["horarioEnvio"];

                $controllerRotina = new ControllerRotina();
                
                $resposta = $controllerRotina->cadastrarRotina($horarioEnvio, $codTurma, $codUsuario, $listaAgendas, $listaCards, $listaAlternativasCard, $listaOcorrencias);   

                if (is_bool($resposta))
                {
                    if ($resposta)
                    {
                        //header("Location: viewEnviarRotinaAlunos.php");
                        echo "<script> Alert.render('<h1>A Rotina foi enviada com sucesso.</h1>')</script>";
                        
                        $_POST['codigoturma'] = $codTurma;
                        include_once("viewEnviarRotinaAlunos.php");
                    }
                    else
                    {
                        echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar enviar a rotina.</h1>')</script>";

                        $_POST['codigoturma'] = $codTurma;
                        include_once("viewEnviarRotinaAlunos.php");
                    }
                }
                else if (is_string($resposta))
                {
                    echo "<script> AlertdeErro.render('<h1>{$resposta}</h1>')</script>";
                    
                    $_POST['codigoturma'] = $codTurma;
                    include_once("viewEnviarRotinaAlunos.php");
                }

            }
            else if (isset($_POST["codTurma"]) && isset($_POST["ocorrencias"]) && isset($_POST["agendas"]))
            {
                $listaAgendas = $_POST["agendas"];
                $listaOcorrencias = $_POST["ocorrencias"];
                $codTurma = intval($_POST["codTurma"]);   

                $controllerRotina = new ControllerRotina();
                
                $resposta = $controllerRotina->adicionarOcorrenciaRotina($listaAgendas, $listaOcorrencias, $codUsuario);   

                if (is_bool($resposta))
                {
                    if ($resposta)
                    {
                        //header("Location: viewEnviarRotinaAlunos.php");
                        echo "<script> Alert.render('<h1>Ocorrência(s) adicionada(s) com sucesso à(s) rotina(s).</h1>')</script>";
                        
                        $_POST['codigoturma'] = $codTurma;
                        include_once("viewEnviarRotinaAlunos.php");
                    }
                    else
                    {
                        echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar adicionar a(s) ocorrência(s) à rotina.</h1>')</script>";

                        $_POST['codigoturma'] = $codTurma;
                        include_once("viewEnviarRotinaAlunos.php");
                    }
                }
                else if (is_string($resposta))
                {
                    echo "<script> AlertdeErro.render('<h1>{$resposta}</h1>')</script>";

                    $_POST['codigoturma'] = $codTurma;
                    include_once("viewEnviarRotinaAlunos.php");
                }

            }

        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }
    
    
?>
