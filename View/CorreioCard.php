 <?php
//includes
include_once("../Controller/ControllerCard.php");
include_once("verificaUsuarioLogado.php");

    //dados vindos do ajax
    $desc = $_POST['nome_card'];

        //instancia a classe crud
        $mandardados = new ControllerCard();
        $resultado = $mandardados->cadastrarCard($desc);

        if($resultado){
            echo "<script> Alert.render('<h1>Categoria de rotina cadastrada!</h1>')</script>";
        }else{
            echo "<script> AlertdeErro.render('<h1>Rotina já Cadastrada</h1>')</script>";
        }
include_once("viewConsultarCard.php");
      
?> 
          




           
        