<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
  include_once("../cab.php");
?>


  <!-- =================================================================================== -->
                    <div class="barraPesquisaCadAux">

</div>
       
        <a  href="#" id="abaconsultacaracteristica" name="abaconsultacaracteristica" onclick="abaconsultacaracteristica('viewConsultarCaracteristicaSaude.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png"alt=""></div></a>
        
           <script type="text/javascript" language="javascript">
                function abaconsultacaracteristica(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
            
        </script>


	    <div class="FormCadastroAtividade">
	  	 <div class="fundo" id="fundoAtividade">
        <fieldset>
        <legend>Cadastro Características de Saúde</legend>
	        <form action="" method="post">
	           <div class="caixaTexto">
	                <label class="labelCadAux">Descrição</label>
	                <br>
		           <input class="regular-input-text" type='text' name='txtCaracteristica' id='txtCaracteristica'>
		           
	            </div>
	     </form>
            <img src="../Imagens/ImagensCadastrosAuxiliares/CaracteristicaSaude.png" class="imgAtividadeCurricular" alt="">
             </fieldset>
             <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaCaracteristica()">
            </div>
</div>

    <script type="text/javascript" language="javascript">
            function carregaCaracteristica()
            {
                    if(document.getElementById("txtCaracteristica").value != ""){
                    $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarCaracteristicaSaude.php",
                    data:{
                        nome: $('#txtCaracteristica').val(),
                        
 
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