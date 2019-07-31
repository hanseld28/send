<?php
 
include_once("../Controller/ControllerProntuario.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Model/Usuario.php");
include_once("verificaUsuarioLogado.php");

    $codProntuario = $_POST['ultimo'];
    $tipo = $_POST['tipo'];
    $deficiencia = $_POST['deficiencias'];
    $problema = $_POST['problemassaude'];
    $doenca = $_POST['doencasContagiosas'];
    $tratamento = $_POST['descCirurgia'];
    $alergia = $_POST['descAlergia'];
    $medicacao = $_POST['descMedicacoes']; 
                   
    

        $mandardados = new ControllerProntuario();
        $resultado = $mandardados->editarProntuario($codProntuario, $tipo, $deficiencia, $problema, $doenca, $tratamento, $tratamento, $alergia, $medicacao);
        
        if($resultado){

        	echo "<script> Alert.render('<h1>Ficha médica editada com sucesso</h1>')</script>";
       
             }else {
                  echo "<script> AlertdeErro.render('<h1>Erro ao editar a ficha médica</h1>')</script>";
               }

 
include_once("viewConsultarAluno.php");
?>

      
 
          




           
        