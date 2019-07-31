<?php

//includes
include_once("../Controller/ControllerMatricula.php");
include_once("../Controller/AlunoCRUD.php");
include_once("../Controller/ContatoEmergenciaCRUD.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");
include_once("../Controller/ControllerAgenda.php");

                
$fotopadrao = "fotoPadrao";

session_start();

try{
    
    
    
    //verifica se existe um codigo de um responsavel
    if(isset($_SESSION['codresp'])){
        
        //seta ele em uma variavel
        $codigoresp = $_SESSION['codresp'];
        
        //verifica se existe todos os dados do aluno
        if( isset($_SESSION["nomealuno"]) && isset($_SESSION["dataGeneric"]) && isset($_SESSION["nacionalidade"]) && isset($_SESSION["sexo"]) && isset($_SESSION["rgaluno"]) && isset($_SESSION["cor"]) && isset($_SESSION["certidao"]) && isset($_SESSION["logradouroaluno"]) && isset($_SESSION["complementoaluno"]) && isset($_SESSION["numcasaaluno"]) && isset($_SESSION["cepaluno"]) && isset($_SESSION["bairro"]) && isset($_SESSION["cidadealuno"]) ){
            
           //setando os dados da session do aluno para suas respectivas variáveis
           $nomealuno = $_SESSION["nomealuno"];
           $dataGeneric = $_SESSION["dataGeneric"];
           $aux = str_replace('/', '-', $dataGeneric);
           $dataaluno = date('Y-m-d', strtotime($aux));
           $nacionalidadealuno = $_SESSION["nacionalidade"];
           $sexoaluno = $_SESSION["sexo"];
           $rgaluno = $_SESSION["rgaluno"];
           $coraluno = $_SESSION["cor"];
           $certidaoaluno = $_SESSION["certidao"];
           $logradouroaluno = $_SESSION["logradouroaluno"];
           $complementoaluno = $_SESSION["complementoaluno"];
           $ncasaaluno = $_SESSION["numcasaaluno"];
           $cepaluno = $_SESSION["cepaluno"]; 
           $bairroaluno = $_SESSION["bairro"];
           $cidadealuno = $_SESSION["cidadealuno"];
            
            if(is_null($_SESSION['fotoaluno'])){
                $foto = $fotopadrao;
            }else{
                $foto = $_SESSION["fotoaluno"];
            }
           
            
           //cadastrando um novo aluno
           $crudaluno = new AlunoCRUD();
           $resultado = $crudaluno->CadastrarAluno($nomealuno, $dataaluno, $nacionalidadealuno, $sexoaluno, $rgaluno, $coraluno, $certidaoaluno, $logradouroaluno, $complementoaluno, $ncasaaluno, $cepaluno, $bairroaluno, $cidadealuno, $foto, $codigoresp);
            
           //verifica se o aluno foi cadastrado
           if($resultado){
               
               //recupera o código do ultimo aluno
               
               
               //verifica se existe todos os dados do contato de emergencia
               if( isset($_SESSION['pessoa1']) && isset($_SESSION['telefone1']) || isset($_SESSION['pessoa2']) && isset($_SESSION['telefone2']) || isset($_SESSION['pessoa3']) && isset($_SESSION['telefone3']) ){
                   
                $crudaluno1 = new AlunoCRUD();
                $codultimoaluno = $crudaluno1->UltimoAluno();
                $_SESSION['ultimoaluno'] = $codultimoaluno;

                $controllerAgenda = new ControllerAgenda();
                $respostaCadastroAgenda = $controllerAgenda->cadastrarAgenda(intval($codultimoaluno));
                   
                //seta os dados dos contatos em variaveis   
                $pessoa1 = $_SESSION['pessoa1'];
                $telefone1 = $_SESSION['telefone1'];
                $pessoa2 = $_SESSION['pessoa2'];
                $telefone2 = $_SESSION['telefone2'];
                $pessoa3 = $_SESSION['pessoa3'];
                $telefone3 = $_SESSION['telefone3'];

                 $crudContatoEmergencia = new ContatoEmergenciaCRUD();

                if($pessoa1 != null && $telefone1 != null){

                $result1 = $crudContatoEmergencia->cadastrarContatoEmergencia($pessoa1, $telefone1, $codultimoaluno);

                }

                if($pessoa2 != null && $telefone2 != null){

                  $result2 = $crudContatoEmergencia->cadastrarContatoEmergencia($pessoa2, $telefone2, $codultimoaluno);

                }

                if($pessoa2 != null && $telefone2 != null){

                    $result3 = $crudContatoEmergencia->cadastrarContatoEmergencia($pessoa3, $telefone3, $codultimoaluno); 

                }
                    
                    if(isset($_POST['datam']) && isset($_POST['numeroM']) && isset($_POST['turma'])){
                        
                        //dados recebidos do cadastro da matricula
                        $atividades = array();
                        $dataMatri = $_POST['datam'];
                        $numero = $_POST['numeroM'];
                        $turma = $_POST['turma'];
                        $atividades = $_POST['atividades']; 
                        
                        if($atividades == null){
                           $atividades = null;
                        }

                        $_SESSION['dataMatricula'] = $dataMatri;
                        $_SESSION['numeroMatricula'] = $numero;
                        $_SESSION['turmaMatricula'] = $turma;
                        $_SESSION['atividadesMatricula'] = $atividades;
                        
                        $auxiliar = str_replace('/', '-', $dataMatri);
                        $datamatri = date('Y-m-d', strtotime($auxiliar));
                        
                        $crudaluno1 = new AlunoCRUD();
                        $codultimoaluno = $crudaluno1->UltimoAluno();
                        
                        $crudmatricula = new ControllerMatricula();
                        $resposta = $crudmatricula->cadastrarMatricula($datamatri, $codultimoaluno, $turma, $numero);

                        $codMatricula = $crudmatricula->ultimaMatricula();
                        $controlleratividade = new ControllerAtividadeExtraCurricular();
                        $controlleratividade->cadastrarAtividadeAluno($atividades, $codMatricula);

                        
                        if($resposta && $respostaCadastroAgenda){
                            
                         
                         echo "<script> Alert.render('<h1>Cadastro do Aluno efetuado com sucesso!</h1>')</script>";
                        
                         include_once('pageCadastroFichaSaude.php');
                         
                        }else{
                            echo "<script> AlertdeErro.render('<h1>Não foi Cadastrado os Dados da Matrícula</h1>')</script>"; 
                            
                        }
                        
                    }else{
                        echo "<script> AlertdeErro.render('<h1>Erro nos dados da Matrícula</h1>')</script>"; 
                        
                    }
       
                    
                }else{
                   
                   
                   
               }
                   
               }else{
                   echo "<script> AlertdeErro.render('<h1>Dados dos Contatos de Emêrgencia Incorretos</h1>')</script>"; 
                   
               }
               
               
               
           }else{
               echo "<script> AlertdeErro.render('<h1>Não foi Possível Cadastrar Aluno</h1>')</script>"; 
           }
            
        } else{
             echo "<script> AlertdeErro.render('<h1>Escolha um Responsável</h1>')</script>"; 
         }
        


    }

catch(Exception $e){
    
    echo $e->getMessage();
    
}
        
?>         

      

