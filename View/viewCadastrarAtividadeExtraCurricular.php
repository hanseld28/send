<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<link rel="stylesheet" type="text/css" href="../Estilos/EstiloAlert.css">


<script type="text/javascript">
    function AlertErro(){
    this.render = function(dialog){
        var modal= document.getElementById('modalErro');
        var caixaDialogo= document.getElementById('caixaDialogoErro');
        
        modalErro.style.display = "block";
        caixaDialogoErro.style.display = "block";

        
        
        document.getElementById('caixaDialogoCorpoErro').innerHTML = dialog;
        document.getElementById('caixaDialogoRodapeErro').innerHTML = '<button onclick="AlertdeErro.okErro()">OK</button>';

    }
    this.okErro = function(){
        document.getElementById('modalErro').style.display = "none";
        document.getElementById('caixaDialogoErro').style.display = "none";
    }
}
var AlertdeErro = new AlertErro();
</script>

<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // Valida cadastro do Tipo Usuário
        try {
            if(isset($_POST["nome_atividade"])):    
                //header("Location: ..\index.php");

                $descAtividade = trim($_POST["nome_atividade"]);            
                $controller = new ControllerAtividadeExtraCurricular();

                $resposta = $controller->cadastrarAtividadeExtraCurricular($descAtividade);

                if($resposta):
                    //header("Location: pageCadastroPeriodo.php");
                    //Alert.render('<h1>Cadastrado com Sucesso!</h1>')
                    echo "<script> Alert.render('<h1>Atividade cadastrada!</h1>')</script>";
               
                else:
                	echo "<script> AlertdeErro.render('<h1>Erro ao Cadastrar</h1>')</script>";
                endif;

            endif;
        } catch (Exception $e){
            echo $e->getMessage();
        }
   
    }

include_once("viewConsultarAtividadeExtraCurricular.php");
?>