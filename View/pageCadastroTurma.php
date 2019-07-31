<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
  include_once("../cab.php");
?>


<!-- ================================================================================== -->
            <div class="barraPesquisaCadAux">

</div>

<a  href="#" id="abaconsultaturma" name="abaconsultaturma" onclick="abaconsultaturma('viewConsultarTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>
    
     <script type="text/javascript" language="javascript">
                function abaconsultaturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                };
     
            
        </script>
        
<div class="FormCadastroPeriodo">
    <fieldset>
        <legend>Cadastro Turma</legend>
           <form action="#" method="post">
              <div class="caixaTexto">
                 <label class="labelCadAux">Descrição</label>
                   <br>
				       <input class="regular-input-text" type='text' name='txtTurma' id='txtTurma'>
			           
 					<?php
		   		 		include_once("selectFormGrauEscolar.php");
		         	?>			      	
		         	
                    </div>
			 </form>
            <img src="../Imagens/ImagensCadastrosAuxiliares/Turma.png" alt="">
             </fieldset>
             <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaTurma()">
			</div>
		
		
	  	  <script type="text/javascript" language="javascript">
            function carregaTurma()
            {
                var valorCombo = document.getElementById("grauTurma").value;
                
                if(document.getElementById('txtTurma').value != ""){
                $.ajax({
                    asyn: false,
                    type: "POST",
                    url: "viewCadastrarTurma.php",
                    data:{
                        nome_turma: $('#txtTurma').val(),
                        grau_turma: valorCombo,
 
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
	  
    
     
<?php
  include_once("../rod.php");
?>