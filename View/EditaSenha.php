<?php

include("../Controller/ControllerUsuario.php");


$cod = $_POST['id'];
$senha = $_POST['senha'];
$nova = $_POST['nova'];


$usuario = new Usuario();
$crud = new ControllerUsuario();
$usuario = $crud->preencherUsuario($cod);

if($usuario->getSenha() == $senha){

	$resultado = $crud->editarSenha($cod, $nova);
	
	if($resultado)
	{
		echo "<script>Alert.render('<h1>Senha editada com sucesso</h1>'); </script>";
	}
	else
	{
		echo "<script>AlertdeErro.render('<h1>Erro ao editar a senha...</h1>');</script>";
	}




}else{


	echo "<script> AlertdeErro.render('<h1>Senha atual inválida...</h1>');</script>";
	
}



include_once('viewConsultarPerfil.php');








?>