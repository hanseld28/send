<?php
//includes
include_once("../Controller/FuncionarioCRUD.php");
include_once("verificaUsuarioLogado.php");
include_once("../Model/Senha.php");
include_once("../Controller/ControllerUsuario.php");

    //variáveis
$listacargos = array();

$listacargos = $_POST['cargos']; 

$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$logradouro = $_POST['logradouro'];
$complemento = $_POST['complemento'];
$numcasa = $_POST['ncasa'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$usuario = $_POST['tipo'];
$email = $_POST['email'];
$login = $nome;

            //gerar senha e login
$criarsenha = new Senha();
$senha = $criarsenha->gerarSenha(8,5);

$criarlogin = new Senha();
$login = current( str_word_count( $login , 2 ));
$login = str_replace(' ', '', $login);
$login = $login.$criarlogin->gerarSenha(3,0);

                 //cadastrar um usuario com o login e senha gerados

$controllerusuario = new ControllerUsuario();
$controllerusuario->cadastrarUsuario($nome, $login, $senha, $usuario);

$controllerusuario2 = new ControllerUsuario();
$ultimoUser = $controllerusuario2->ultimoUsuario();



$mandardados = new FuncionarioCRUD();
$resultado = $mandardados->CadastrarFuncionario($nome, $rg, $cpf, $logradouro, $complemento, $numcasa, $cep, $cidade, $listacargos, $ultimoUser, $email);

if($resultado){
    echo "<script> Alert.render('<h1>Funcionário cadastrado com sucesso!</h1>')</script>";
}else{
    echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o Funcionário...</h1>')</script>";
}


$controller = new ControllerUsuario();
$usuario = $controller->dadosUltimoUsuario();
echo ("<script> Alert.render('<h1>Funcionário cadastrado com sucesso! Login: ".$usuario->getLogin()." Senha: ".$usuario->getSenha()."</h1>')</script>");




include_once("viewConsultarFuncionario.php");

?>