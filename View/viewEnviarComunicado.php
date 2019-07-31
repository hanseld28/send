
<?php
    include_once("verificaUsuarioLogado.php");
    include_once("../Controller/ControllerComunicado.php");
    include_once("../Controller/ProfessorTurmaCRUD.php");
    include_once("../Controller/AlunoCRUD.php");
   //var_dump($_POST);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Valida cadastro do Rotina 
        try 
        {
            if(isset($_POST["id_professor_usuario"]) and isset($_POST["txt_assunto"]) and isset($_POST["id_turma"]) and isset($_POST["txt_comunicado"]))
            {
                $codUsuario = intval($_POST['id_professor_usuario']);
                $txtAssunto = $_POST['txt_assunto'];
                $codTurma = intval($_POST["id_turma"]);
                $txtComunicado = $_POST['txt_comunicado'];

                $controllerProfessorTurma = new ProfessorTurmaCRUD();
                $listaAlunos = $controllerProfessorTurma->consultarAlunosTurma($codTurma);
                $listaAgendas = array();

                $controllerAluno = new AlunoCRUD();

                $i = 0;
                foreach ($listaAlunos as $aluno) 
                {
                	$idAluno = intval($aluno['codAluno']);

                	$listaAgendas[$i] = $controllerAluno->AgendaAlunoPorCodigo($idAluno);

                	$i++;
                }
                
                $controllerComunicado = new ControllerComunicado();

                $resposta = $controllerComunicado->cadastrarComunicado($listaAgendas, $codTurma, $codUsuario, $txtAssunto, $txtComunicado);
                
                if($resposta)
                {
                    echo "<script> Alert.render('<h1>Seu comunicado foi enviado com sucesso.</h1>')</script>";
                    
                    $_POST['codigoturma'] = $codTurma;
                    include_once("viewNovoComunicado.php");
                }
                else
                {
                    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar enviar o comunicado.</h1>')</script>";

                    $_POST['codigoturma'] = $codTurma;
                    include_once("viewComunicado.php");
                }
                    
            }

        } 
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
   
    }
    
    
?>