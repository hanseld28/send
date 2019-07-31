<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
include_once("../cab.php");
?>

<script type="text/javascript">  
  $('#txtHorarioPeriodo').mask('00:00'); 
</script>
<!-- =================================================================================== -->
            <div class="barraPesquisaCadAux">

</div>

<a  href="#" id="abaconsultaperiodo" name="abaconsultaperiodo" onclick="abaconsultaperiodo('viewConsultarPeriodo.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>

<script type="text/javascript" language="javascript">
  function abaconsultaperiodo(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };


            </script>

            <div class="FormCadastroPeriodo">
            
              <fieldset>
                <legend>Cadastro Período</legend>
                <form action="viewCadastrarPeriodo.php" method="post">
                  <div class="caixaTexto">
                    <label class="labelCadAux">Descrição</label>
                    <br>
                    <input class="regular-input-text" type='text' name='txtPeriodo' id='txtPeriodo'>
                  </div>           
                  <div class="caixaTexto">
                   <label class="labelCadAux">Horário</label>
                   <br>
                   <input class="regular-input-text-mesma-linha" type="text" name='txtHorarioPeriodo' id='txtHorarioPeriodo'>
                 </div>


               </form>

               <img src="../Imagens/ImagensCadastrosAuxiliares/Periodo.png" alt="">

             </fieldset>  

             <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaPeriodo()">

         
         </div>


         <script type="text/javascript" language="javascript">
          function carregaPeriodo()
          {


           if(document.getElementById("txtPeriodo").value != "" && 
            document.getElementById("txtHorarioPeriodo").value != ""){
            $.ajax({
              asyn: false,
              type: "POST",
              url: "viewCadastrarPeriodo.php",
              data:{
                nome_periodo: $('#txtPeriodo').val(),
                horario_periodo: $('#txtHorarioPeriodo').val()

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