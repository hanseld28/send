<?php
//includes
include_once("../Controller/CargoCRUD.php");
include_once("verificaUsuarioLogado.php");

    //dados vindos do ajax
    $nomecargo = $_POST['nome_cargo'];

        //instancia a classe crud
        $mandardados = new CargoCRUD();
        $resultado = $mandardados->CadastroCargo($nomecargo);

        if($resultado){
            echo "<script> Alert.render('<h1>Cargo cadastrado!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o Cargo...</h1>')</script>";
        }
include_once("viewConsultarCargoFuncionario.php");
      
?> 
          




           
        