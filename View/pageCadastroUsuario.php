<?php
	include_once("../cab.php");
?>

<!-- ==================== Form de Cadastro do Usuário =================== -->
       
       
    <a  href="#" id="abaconsultausuario" name="abaconsultausuario" onclick="abaconsultausuario('viewConsultarUsuario.php')">Abrir aba de consulta</a>
        
           <script type="text/javascript" language="javascript">
                function abaconsultausuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
                };
     
            
        </script>
    
        <div class="FormCadastrarUsuario">
           <div class="fundo" id="fundoCadastrarUsuario">
          <h1> Cadastro de Usuário </h1>

            <form action="#" method="post">
	          <label>Nome</label>
	          <div class="caixaTexto">
	           <input type='text' name='NomeUsuario' id='NomeUsuario'>
	              
	           
	          </div> 
	           <label>Login</label>
	          <div class="caixaTexto">
	           <input type='text' name='LoginUsuario' id='LoginUsuario'>
	             
	           
	          </div>    
             <label>Senha</label>
	         <div class="caixaTexto">
	           <input type='password' name='SenhaUsuario' id='SenhaUsuario'>
	            
	           
	      	</div>

	       <!-- Select tipos de usuário -->
          <?php 
          	  include_once("selectFormTipoUsuario.php");
          ?>
		    <input type="button" value="Cadastrar" onclick="carregausuario()">
	      
	        </form>
	       </div>
	    </div>
		
		
		    <script type="text/javascript" language="javascript">
            function carregausuario()
            {
                
                var valorCombo = document.getElementById("tipoUsuario").value;
                
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarUsuario.php",
                    data:{
                        nome_usuario: $('#NomeUsuario').val(),
                        login_usuario: $('#LoginUsuario').val(),
                        senha_usuario: $('#SenhaUsuario').val(),
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