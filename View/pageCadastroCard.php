<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
  include_once("../cab.php");
?>

<!-- ==================== Form de Cadastro de Cargo de funcionário =================== -->
   
               <div class="barraPesquisaCadAux">

</div>
  
   <a  href="#" id="abaconsultacard" name="abaconsultacard" onclick="abaconsultacard('viewConsultarCard.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
   
   <script type="text/javascript" language="javascript">
                function abaconsultacard(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
             
        </script>
        
    <div class="FormCadastroAtividade">
	  	 <div class="fundo" id="fundoAtividade">
        <fieldset>
        <legend>Cadastro Categoria da rotina</legend>  
   <div id="cadastroCard">
        <form action="#" method="post">
           <div class="caixaTexto">
            <label class="labelCadAux">Descrição</label>
            <br>
            <input class="regular-input-text" type='text' name='NomeCard' id='NomeCard'>
            
            </div>
        </form>
            
        </div>
            <img src="../Imagens/ImagensCadastrosAuxiliares/Rotina.png" alt="">
             </fieldset>
              <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaCard()">
        </div>
</div>       
        <script type="text/javascript" language="javascript">
            function carregaCard()
            {

                if(document.getElementById("NomeCard").value != ""){
                $.ajax({ 
                    asyn: false,
                    type: "POST",
                    url: "CorreioCard.php",
                    data:{
                        nome_card: $('#NomeCard').val()
                        
                    },
                    success: function(data){
                        $('#painelCadAuxliar').html(data);  
                    }
                });
              }else{
                     AlertdeErro.render('<h1>Preencha todos os campos!</h1>')
              }
            } 
            
          

            
        </script>
        
        <!-- ==================== Form de Cadastro de Cargo de funcionário =================== -->
     
<?php
  include_once("../rod.php");
?>