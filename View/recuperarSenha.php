<?php
 require_once('../Model/PHPMailer.php'); //chama a classe de onde você a colocou.
 require_once('../Model/SMTP.php');
 require_once('../Model/POP3.php');
 require_once('../Model/OAuth.php');
 require_once('../Model/Exception.php');
 include_once('../Controller/ControllerUsuario.php');
 include_once('../Model/Senha.php');
 
$email = $_POST['email'];

if($email == ""){
	echo("Preencha o campo corretamente!");
}else if(filter_var($email, FILTER_VALIDATE_EMAIL)){

	$crud = new ControllerUsuario();
$resultado = $crud->verificaEmail($email);
if($resultado == "false"){
	echo("Email incorreto, tente novamente!");
}else if($resultado > 0){

	$usuario = $crud->preencherUsuario($resultado);
	$login = $usuario->getLogin();

	$senha = new Senha();
    $senhaUsuario = $senha->gerarSenha(8,4);

    $resultado = $crud->editarSenha($resultado, $senhaUsuario);
    if($resultado){

$mail = new \PHPMailer\PHPMailer\PHPMailer(); // instancia a classe PHPMailer
$mail->IsSMTP();

//configuração do gmail
$mail->Port = '465'; //porta usada pelo gmail.
$mail->Host = 'smtp.gmail.com'; 
$mail->IsHTML(true); 
$mail->Mailer = 'smtp'; 
$mail->SMTPSecure = 'ssl';

//configuração do usuário do gmail
$mail->SMTPAuth = true; 
$mail->Username = 'larissa.sousa4@gmail.com'; // usuario gmail.   
$mail->Password = 'Larissa82408560'; // senha do email.

$mail->SingleTo = true; 

// configuração do email a ver enviado.
$mail->From = "teste@teste.com"; 
$mail->FromName = "Polaris."; 


$mail->addAddress($email); // email do destinatario.

$mail->Subject = "Solicitação de nova senha - .SEND."; 
$mail->Body = "Olá, você solicitou a recuperação de senha para acessar o seu perfil no .SEND. Seu login: ".$login. " sua nova senha: ".$senhaUsuario.".";

if(!$mail->Send()){
    echo "<label class='lbldeErroEmail'>Erro ao enviar Email:" . $mail->ErrorInfo."</label>";
}else
{
    echo "<label class='lbldeErroEmail'>E-mail enviado com sucesso.</label>";
}

}
    else {
        
        echo("<label class='lbldeErroEmail'>Ocorreu um erro ao editar a senha</label>"); 
    }



}else{
	echo("<label class='lbldeErroEmail'>Ocorreu Algum erro!</label>"); 
}

 }else{

	echo("<label class='lbldeErroEmail'>Coloque um E-mail válido!</label>");

}






?>