<?php
    session_start();
    include_once("verificaUsuarioLogado.php");
    include_once("../Controller/ResponsavelCRUD.php");
    include_once("../Controller/ControllerUsuario.php");
    include_once("../Model/Senha.php");

    //dados do responsavel
    $radio = (isset($_POST['codResponsavel'])) ? $_POST['codResponsavel'] : null;
    $datanasc = (isset($_POST['datanasc'])) ? $_POST['datanasc'] : null;
    $nacionalidaderesp = (isset($_POST['nacionalidaderesp'])) ? $_POST['nacionalidaderesp'] : null;
    $rgresp = (isset($_POST['rgresp'])) ? $_POST['rgresp'] : null;
    $cpfresp = (isset($_POST['cpfresp'])) ? $_POST['cpfresp'] : null;
    $profissaoresp = (isset($_POST['profissaoresp'])) ? $_POST['profissaoresp'] : null;
    $logradourotrabalho = (isset($_POST['logradourotrabalho'])) ? $_POST['logradourotrabalho'] : null;
    $telefoneresp = (isset($_POST['telefoneresp'])) ? $_POST['telefoneresp'] : null;
    $celularresp = (isset($_POST['celularresp'])) ? $_POST['celularresp'] : null;
    $telefonetrabalho = (isset($_POST['telefonetrabalho'])) ? $_POST['telefonetrabalho'] : null;
    $nomeresp = (isset($_POST['nomeresp'])) ? $_POST['nomeresp'] : null;
    $sexoresponsavel = (isset($_POST['sexoresponsavel'])) ? $_POST['sexoresponsavel'] : null;
    $grauresp = (isset($_POST['grauresp'])) ? $_POST['grauresp'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    
    //dados dos contatos de emergencia
    $pessoa1 = (isset($_POST['pessoa1'])) ? $_POST['pessoa1'] : null;
    $telefone1 = (isset($_POST['telefone1'])) ? $_POST['telefone1'] : null;
    $pessoa2 = (isset($_POST['pessoa2'])) ? $_POST['pessoa2'] : null;
    $telefone2 = (isset($_POST['telefone2'])) ? $_POST['telefone2'] : null;
    $pessoa3 = (isset($_POST['pessoa3'])) ? $_POST['pessoa3'] : null;
    $telefone3 = (isset($_POST['telefone3'])) ? $_POST['telefone3'] : null;
    


    if(!is_null($pessoa1) && !is_null($telefone1) && !is_null($pessoa2) && !is_null($telefone2) && !is_null($pessoa3) && !is_null($telefone3)){
        
        $_SESSION["pessoa1"] = $pessoa1;
        $_SESSION["telefone1"] = $telefone1;
        $_SESSION["pessoa2"] = $pessoa2;
        $_SESSION["telefone2"] = $telefone2;
        $_SESSION["pessoa3"] = $pessoa3;
        $_SESSION["telefone3"] = $telefone3;
    }

if(is_null($radio)){
   
if(!is_null($datanasc) && !is_null($nacionalidaderesp) && !is_null($rgresp) && !is_null($cpfresp) && !is_null($profissaoresp) && !is_null($logradourotrabalho) && !is_null($telefoneresp) && !is_null($celularresp) && !is_null($telefonetrabalho) && !is_null($nomeresp) && !is_null($sexoresponsavel) && !is_null($grauresp) && !is_null($email)){

    $_SESSION["datanasc"] = $datanasc;
    $_SESSION["nacionalidaderesp"] = $nacionalidaderesp;
    $_SESSION["rgresp"] =$rgresp; 
    $_SESSION["cpfresp"] = $cpfresp; 
    $_SESSION["profissaoresp"] = $profissaoresp; 
    $_SESSION["logradourotrabalho"] = $logradourotrabalho; 
    $_SESSION["telefoneresp"] = $telefoneresp;
    $_SESSION["celularresp"] = $celularresp;
    $_SESSION["telefonetrabalho"] = $telefonetrabalho; 
    $_SESSION["nomeresp"] = $nomeresp; 
    $_SESSION["sexoresponsavel"] = $sexoresponsavel; 
    $_SESSION["grauresp"] = $grauresp;
    $_SESSION["emailresp"] = $email;
    
    $auxiliar = str_replace('/', '-', $datanasc);
    $datanascresp = date('Y-m-d', strtotime($auxiliar));
    // atribuindo o tipo de usuário
    $codTipoUsuario = 6;

    //criando o login e senha temporários
    $login = new Senha();
    $loginUsuario = $nomeresp;
    $loginUsuario = current( str_word_count( $loginUsuario , 2));
    $loginUsuario = str_replace(' ', '', $loginUsuario);
    $loginUsuario = $loginUsuario.$login->gerarSenha(5,2);
    $senhaUsuario = $login->gerarSenha(8,4);

    //criando um novo usuário
    $cruduser = new ControllerUsuario();
    $cruduser->cadastrarUsuario($nomeresp, $loginUsuario, $senhaUsuario, $codTipoUsuario);

    $_SESSION['loginMatricula'] = $loginUsuario;
    $_SESSION['senhaMatricula'] = $senhaUsuario;
    $_SESSION['tipoUsuarioMatricula'] = $codTipoUsuario;

    //buscando o ultimo usuário
    $usuario = $cruduser->ultimoUsuario();
    $controller = new ControllerUsuario();

    //criando um novo responsável
    $crud = new ResponsavelCRUD();
    $crud->CadastroResponsavel($nomeresp, $cpfresp, $nacionalidaderesp, $rgresp, $datanascresp, $sexoresponsavel, $profissaoresp,  $logradourotrabalho, $telefoneresp, $celularresp, $telefonetrabalho, $grauresp, $email, $usuario);
    
    //resgatando o ultimo responsável
    $codresp = $crud->Ultimoresp();
    $_SESSION["codresp"] = $codresp;

    $controller = new ControllerUsuario();
$usuario = $controller->dadosUltimoUsuario();
echo ("<script> Alert.render('<h1>Responsável cadastrado com sucesso! Login: ".$usuario->getLogin()." Senha: ".$usuario->getSenha()."</h1>')</script>");

//indo para o próximo passo
include_once("pageCadastroMatricula.php");
}
}else{ 
        $_SESSION["codresp"] = $radio;
        $crudResponsavel = new ResponsavelCRUD();
        $responsavelexis = $crudResponsavel->ConsultaResponsavel($radio);
        //var_dump($responsavelexis);
            $_SESSION["datanasc"] = $responsavelexis->getDatanascimento();
            $_SESSION["nacionalidaderesp"] = $responsavelexis->getNacionalidade();
            $_SESSION["rgresp"] = $responsavelexis->getRg(); 
            $_SESSION["cpfresp"] = $responsavelexis->getCpf();
            $_SESSION["profissaoresp"] = $responsavelexis->getProfissao(); 
            $_SESSION["logradourotrabalho"] = $responsavelexis->getEnderecotrabalho();
            $_SESSION["telefoneresp"] = $responsavelexis->getTelefone();
            $_SESSION["celularresp"] = $responsavelexis->getCelular();
            $_SESSION["telefonetrabalho"] = $responsavelexis->getTelefonetrabalho(); 
            $_SESSION["nomeresp"] = $responsavelexis->getNome(); 
            $_SESSION["sexoresponsavel"] = $responsavelexis->getSexo(); 
            $_SESSION["grauresp"] = $responsavelexis->getGrauparentesco();
            $_SESSION["emailresp"] = $responsavelexis->getEmail();
    
            $CRUD = new ControllerUsuario();
            $usuario = $CRUD->preencherUsuario($responsavelexis->getUsuario());
    
                $_SESSION['loginMatricula'] = $usuario->getLogin();
                $_SESSION['senhaMatricula'] = $usuario->getSenha();
        
        include_once("pageCadastroMatricula.php");
        
}

?>