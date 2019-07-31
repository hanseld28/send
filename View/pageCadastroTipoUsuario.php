<?php
  include_once("../cab.php");
?>

<!-- ==================== Form de Cadastro do Tipo de Usuário =================== -->            
                  <div class="barraPesquisaCadAux">

</div>
     
      
      <a  href="#" id="abaconsultatipousuario" name="abaconsultatipousuario" onclick="abaconsultatipousuario('viewConsultarTipoUsuario.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
        
           <script type="text/javascript" language="javascript">
                function abaconsultatipousuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
            
        </script>
        
  <div class="FormCadastroAtividade">
	  	 <div class="fundo" id="fundoAtividade">
        <fieldset>
        <legend>Cadastro Tipo de Usuário</legend>  
      <form action="viewCadastrarTipoUsuario.php" method="post">
       <div class="caixaTexto">
        <label class="labelCadAux" for="nomeResp">Descrição</label>
         <br>
          <input class="regular-input-text" type='text' name='txtTipoUsuario' id='txtTipoUsuario'>
        </div>
        
       
   </form>
            <img src="../Imagens/ImagensCadastrosAuxiliares/Tipo%20Usuario.png" alt="">
             </fieldset>
             <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregatipousuario()">
      </div>
</div>
   
          <script type="text/javascript" language="javascript">
            function carregatipousuario()
            {

                if(document.getElementById("txtTipoUsuario").value != ""){
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarTipoUsuario.php",
                    data:{
                        nome_usuario: $('#txtTipoUsuario').val(),
                        
 
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
              }else{
                alert("Preencha todos os campos!");
              }
            }
            
          

            
        </script>


<?php
  include_once("../rod.php");
?>