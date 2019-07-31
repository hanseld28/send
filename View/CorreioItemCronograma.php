<?php
//includes
include_once("../Controller/ItemCronogramaCRUD.php");
include_once("verificaUsuarioLogado.php");


    //dados vindos do ajax
    $nomeitem = $_POST['nome_item'];
    $horarioitem = $_POST['horario_item'];

        //chamada ao método
        $mandardados = new ItemCronogramaCRUD();
        $resultado = $mandardados->CadastroItem($nomeitem, $horarioitem);

        if($resultado){
            echo "<script> Alert.render('<h1>Item cadastrado com sucesso!</h1>')</script>";
              
        }else{
            
            echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao cadastrar o item...</h1>')</script>";  
        }

include_once("viewConsultarItensCronograma.php");

?>