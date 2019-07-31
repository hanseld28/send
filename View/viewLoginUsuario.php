

<head>
<script type="text/javascript" src="js/EventosdosAlerts.js"></script>
 </head>
<?php
	include_once("../Controller/ControllerUsuario.php");
		 
	try {

		 if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if(isset($_POST["txtLogin"]) and isset($_POST["txtSenha"]) and isset($_POST["tipoUsuario"])){
             	//header("Location: viewConsultarUsuario.php");

                $loginUsuario = trim($_POST["txtLogin"]);
                $senhaUsuario = trim($_POST["txtSenha"]);            
    			$codTipoUsuario = intval($_POST["tipoUsuario"]);

       			$controllerUsuario = new ControllerUsuario();
                
                	$flag = false;

                $usuario = $controllerUsuario->logar($loginUsuario, $senhaUsuario, $codTipoUsuario, $flag);
                //var_dump($usuario);

                if(is_object($usuario)){ 
                    
                    session_start();
                	$_SESSION["codUsuario"] = $usuario->getId();
                	$_SESSION["nomeUsuario"] = $usuario->getNome();
                	$_SESSION["loginUsuario"] = $usuario->getLogin();
                	$_SESSION["codTipoUsuario"] = $usuario->tipoUsuario->getId();
                	$_SESSION["statusUsuario"] = true;     
                    
                    
                if($codTipoUsuario == 12){ //professor
                    header("Location: viewPainelProfessor.php");
                }else if($codTipoUsuario == 6){ //responsavel
                    header("Location: viewPainelResponsavel.php");
                }else if($codTipoUsuario == 1){ //admin
                    header("Location: viewPainel2.php");
                }

                    
	            	
	            }else{
	            	echo "<script> AlertdeErro.render('<h1>{$usuario}</h1>')</script>";
                    header("Location: viewTelaLogin.php");
	           	}
       			
	        }	
		}

	} catch (Exception $e) {
        //header("Location: viewTelaLogin.php");
		echo $e->getMessage();
	}	
?>