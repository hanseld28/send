<?php
	header("Location: ../login.php");
	
	session_start();

	unset($_SESSION["codUsuario"]);
	unset($_SESSION["nomeUsuario"]);
	unset($_SESSION["loginUsuario"]);
	unset($_SESSION["codTipoUsuario"]);
              
    session_destroy();         
?>