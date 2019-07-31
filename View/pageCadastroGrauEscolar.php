<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>

<?php
include_once("../cab.php");
include_once("../Controller/ControllerPeriodo.php");
$crud = new ControllerPeriodo();
$periodos = $crud->consultarPeriodo();
?>

<!-- ========================== Form de Cadastro do Grau Escolar ================================================ -->
<div class="barraPesquisaCadAux">

</div>

<a  href="#" id="abaconsultagrau" name="abaconsultagrau" onclick="abaconsultagrau('viewConsultarGrauEscolar.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>

<script type="text/javascript" language="javascript">
  function abaconsultagrau(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };


            </script>


            <div class="FormCadastroAtividade">
             <div class="fundo" id="fundoAtividade">
              <fieldset>
                <legend>Cadastro Grau Escolar</legend>  
                <form  action="viewCadastrarGrauEscolar.php" method="post">
                  <div class="caixaTexto">
                   <label class="labelCadAux">Descrição</label>
                   <br>
                   <input class="regular-input-text" type='text' name='txtGrauEscolar' id='txtGrauEscolar'>
                 </div>
                 <br>
                 <div class="caixaTexto">
                   <label class="labelCadAux">Período</label>
                   <br>
                   <select class="select-regular" name='periodo_grau' id='periodo_grau'>

                    <?php
                    foreach($periodos as $periodo){
                     echo "<option value='".$periodo->getId()."'>".$periodo->getDescricao()."</option>";
                   }?>  

                 </select>
               </div>
             </form>
             <img src="../Imagens/ImagensCadastrosAuxiliares/Grau%20Escolar.png" alt="">
           </fieldset>
           <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaGrau()">
         </div>
       </div>


       <script type="text/javascript" language="javascript">
        function carregaGrau()
        {

          var periodo = document.getElementById("periodo_grau").value;
          if(document.getElementById("txtGrauEscolar").value != "" && periodo != ""){
            $.ajax({
              asyn: false,
              type: "POST",
              url: "viewCadastrarGrauEscolar.php",
              data:{
                nome_grau: $('#txtGrauEscolar').val(),
                periodo_grau: periodo,
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