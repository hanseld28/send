<?php
	include_once("../cab.php");
    include_once("verificaUsuarioLogado.php");
	include_once("../Controller/ControllerTipoUsuario.php");
    include_once("../Controller/ControllerUsuario.php");
?>


<?php

            $codigo = $_POST['id'];
         
            $usuario = new Usuario();
           
            $crud = new ControllerUsuario();

            $resultado = $crud->PreencherUsuario($codigo);
            $usuario = $resultado;
            
            
            $nome = $usuario->getNome();
            $login = $usuario->getLogin();
            $senha = $usuario->getSenha();

?>		
           <div class="cimaPesquisa">
       <h2 class="tituloTop">Editar Usuário</h2>
</div>

<a href="#" id="abaconsultauser" name="abaconsultauser"onclick="abaconsultauser('viewConsultarUsuario.php')"><div class="abrirAbaCadastro"><img src="../Imagens/add.png"alt=""></div></a>
        
           <div class="conteudoCadastroFuncionario">
       <div class="dadosFunc">
       <div class="cadastroFuncionario">

       
     <form method="post" action="#">
          
           
                <?php
                
                    echo("<p class='maiorInput'>");
                    echo("<label>Nome <sub>*</sub></label>");
                    echo("<input class='regular-input-text' type='text' name='txtnome' id='txtnome' value='".$nome."'>");
                    echo("</p>");
                
                    echo("<p>");
                    echo("<label>Login <sub>*</sub></label>");
                    echo("<input class='regular-input-text' type='text' name='txtlogin' id='txtlogin' value='".$login."'>");
                    echo("</p>");
                
                    echo("<p>");
                    echo("<label>Senha <sub>*</sub></label>");
                    echo("<input class='regular-input-text' type='text' name='txtsenha' id='txtsenha' value='".$senha."'>");
                    echo("</p");
                
                
                    $cod = $codigo;
                echo("<p>");    
                include_once("selectFormTipoUsuario.php");
                echo("</p");
                
                echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editarusuario('.$cod.')">');
                
                ?>
          
</form>
</div>
           </div>
               </div>
 
  <script type="text/javascript" language="javascript">

       function abaconsultauser(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
        };
            function editarusuario(cod)
            {
                var valorCombo = document.getElementById("tipoUsuario").value;

                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioUsuario2.php",
                    data:{
                        nome_usuario: $('#txtnome').val(),
                        login_usuario: $('#txtlogin').val(),
                        senha_usuario: $('#txtsenha').val(),
                        cod_usuario: cod,
                        tipo_usuario: valorCombo
                    },
                    success: function(data){
                        $('#painelAbas').html(data);  
                    }
                });
            }

        </script> 

<?php
	include_once("../rod.php");
?>