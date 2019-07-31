<?php
?>
<div id='mensagem' name='mensagem' class="mensagem">
	Para recuperar sua senha, coloque seu endereço de email no campo abaixo.
</div>
<div class="caixaInput"> 
				<form action="" method="" id="formRecuperar">
                <img src="../Imagens/usuario.png" alt="">
                <input type="email" name="email" id="email" placeholder="Digite aqui o seu E-mail">
                <input type="button" class="btnEnviar" name="" value="Enviar" onclick="enviarEmail()">

                </form>
            </div>

            <a onclick="window.location.reload();">
            	<p class="btnVoltarTela"> Voltar</p>
        		</a>


            <script type="text/javascript" language="javascript">

            	function carregaInputVoltar(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $().load(pagina);
                };

                 function enviarEmail()
            {

                
                $.ajax({ 
                    asyn: false,
                    type: "POST",
                    url: "recuperarSenha.php",
                    data:{
                        email: $('#email').val()
                        
                    },
                    success: function(data){
                        $('#mensagem').html(data);  
                    }
                });
                       } 

        </script>
  