<?php  

include_once("../Controller/ControllerGrauEscolar.php");

    $codGrauEscolar = $_POST['id']; 
    $controllerGrauEscolar = new ControllerGrauEscolar();
    $resposta = $controllerGrauEscolar->excluirGrauEscolar($codGrauEscolar);
               
                   
        if($resposta == "true"){
                
                            
			    echo "<script> Alert.render('<h1>Grau escolar excluído com sucesso!</h1>')</script>";
			         }else if($resposta == "false"){
			            	echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao tentar excluir o grau escolar...</h1>')</script>";
			              }else{

			              	echo "<script> AlertdeErro.render('<h1>".$resposta."</h1>')</script>";


			              }

			              include_once("viewConsultarGrauEscolar.php");
		 
?>