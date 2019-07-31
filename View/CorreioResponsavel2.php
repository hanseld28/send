<?php
include_once("verificaUsuarioLogado.php");
include_once("..\Controller\ResponsavelCRUD.php");


try {
  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){


        if(isset($_POST['nomeresp']) and isset($_POST['cpfresp']) and isset($_POST['codigo']) and isset($_POST['nacionalidaderesp']) and isset($_POST['datanasc']) and isset($_POST['rgresp']) and isset($_POST['cpfresp']) and isset($_POST['profissaoresp']) and isset($_POST['logradourotrabalho']) and isset($_POST['telefoneresp']) and isset($_POST['celularresp']) and  isset($_POST['telefonetrabalho']) and isset($_POST['grauresp']) and isset($_POST['email']) and isset($_POST['sexoresponsavel'])){



                //header("Location: viewConsultarTipoUsuario.php");
            $usuario = $_POST['codigo'];
            $nome = trim($_POST['nomeresp']);
            $cpf = trim($_POST['cpfresp']);
            $nacionalidade = trim($_POST['nacionalidaderesp']);
            $rg = trim($_POST['rgresp']);
            $data = trim($_POST['datanasc']);
            $sexo = trim($_POST['sexoresponsavel']);
            $profissao = trim($_POST['profissaoresp']);
            $endereco = trim($_POST['logradourotrabalho']);
            $telefone = trim($_POST['telefoneresp']);
            $celular = trim($_POST['celularresp']);
            $telefonetrabalho = trim($_POST['telefonetrabalho']);
            $grau = trim($_POST['grauresp']);
            $email = trim($_POST['email']);

            $aux = str_replace('/', '-', $data);
            $dataNasc = date('Y-m-d', strtotime($aux));

            $controllerResponsavel = new ResponsavelCRUD();

            $resposta = $controllerResponsavel->EditarResponsavel($nome, $cpf, $nacionalidade, $rg, $dataNasc, $sexo, $profissao, $endereco, $telefone, $celular, $telefonetrabalho, $grau, $email, $usuario);
            
            if($resposta){
                echo "<script> Alert.render('<h1>Responsável editado com sucesso!</h1>')</script>";
            }else{
                echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar o responsável...</h1>')</script>";
            }
            
        }	
         

    }} catch (Exception $e) {
      echo $e->getMessage();
  }



include_once("viewConsultarResponsavel.php");
  ?>