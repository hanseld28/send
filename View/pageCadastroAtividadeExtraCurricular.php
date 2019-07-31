<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
  include_once("../cab.php");
?>


  <!-- =================================================================================== -->
            <div class="barraPesquisaCadAux">

</div>

      
  
        <a  href="#" id="abaconsultaatividade" name="abaconsultaatividade" onclick="abaconsultaatividade('viewConsultarAtividadeExtraCurricular.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
        
           <script type="text/javascript" language="javascript">
                function abaconsultaatividade(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
        </script>
        
  
	    <div class="FormCadastroAtividade">
	  	 <div class="fundo" id="fundoAtividade">
        <fieldset>
        <legend>Cadastro Atividade Extra Curricular</legend>
	        <form action="#" method="post">
           <label class="labelCadAux">Descrição</label>
	           <div class="caixaTexto">
		           <input type='text' name='txtNomeAtividade' id='txtNomeAtividade' class="regular-input-text">
	            </div>
                </form>
                
                <img src="../Imagens/ImagensCadastrosAuxiliares/AtividadeExtraCurricular2.png" alt="">
                </fieldset>
			<input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaAtividade()">
		</div>
	  </div>


    <script type="text/javascript" language="javascript">

            function abaconsultaatv(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
        };
            function carregaAtividade()
            {
             
                if(document.getElementById("txtNomeAtividade").value != ""){   
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarAtividadeExtraCurricular.php",
                    data:{
                        nome_atividade: $('#txtNomeAtividade').val(),
                        
 
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
              }else{
                     AlertdeErro.render('<h1>Preencha todos os campos!</h1>');
              }
            }
            
          

            
        </script>
	
	

<?php
  include_once("../rod.php");
?>