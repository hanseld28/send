<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
  include_once("../cab.php");
?>

<!-- ==================== Form de Cadastro de Cargo de funcionário =================== -->
   
               <div class="barraPesquisaCadAux">

</div>
  
   <a  href="#" id="abaconsultacargo" name="abaconsultacargo" onclick="abaconsultacargo('viewConsultarCargoFuncionario.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
   
   <script type="text/javascript" language="javascript">
                function abaconsultacargo(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
            
        </script>
        
    <div class="FormCadastroAtividade">
	  	 <div class="fundo" id="fundoAtividade">
        <fieldset>
        <legend>Cadastro Cargo</legend>  
   <div id="cadastroCargoFuncionario">
        <form action="#" method="post">
           <div class="caixaTexto">
            <label class="labelCadAux">Descrição</label>
            <br>
            <input class="regular-input-text" type='text' name='NomeCargo' id='NomeCargo'>
            
            </div>
        </form>
            
        </div>
            <img src="../Imagens/ImagensCadastrosAuxiliares/Cargo.png" alt="">
             </fieldset>
              <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaCargos()">
        </div>
</div>       
        <script type="text/javascript" language="javascript">
            function carregaCargos()
            {

                if(document.getElementById("NomeCargo").value != ""){
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "CorreioCargo.php",
                    data:{
                        nome_cargo: $('#NomeCargo').val()
                        
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