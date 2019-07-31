<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
<?php
include_once("../cab.php");
?>

<script type="text/javascript">  
    $('#txthoraitem').mask('00:00'); 
</script>


<!-- ==================== Form de Cadastro de Itens do Cronograma =================== -->
<div class="barraPesquisaCadAux">

</div>

<a  href="#" id="abaconsultaitem" name="abaconsultaitem" onclick="abaconsultaitem('viewConsultarItensCronograma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/loupe.png" alt=""></div></a>

<script type="text/javascript" language="javascript">
    function abaconsultaitem(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
            };
        </script>
        
        
        
        <div class="FormCadastroPeriodo">
            <fieldset>
                <legend>Cadastro Itens do Cronograma</legend>
                <form action="#" method="post">
                    <div class="caixaTexto">
                        <label class="labelCadAux">Descrição</label>
                        <br>
                        <input class="regular-input-text" type="text" name="ItensDeCronograma" id="ItensDeCronograma">
                        <label class="labelCadAux">Horário</label>
                        <br>
                        <input class="regular-input-text-mesma-linha" type="text" name="txthoraitem" id="txthoraitem">
                    </div>
                </form>

                <div id="tabelaitens">
                    <?php //include_once("viewConsultarItensCronograma.php"); ?>
                </div>

                <img src="../Imagens/ImagensCadastrosAuxiliares/ItensCronograma.png" alt="">
            </fieldset>

            <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaItens()">
        </div>
        
        <script type="text/javascript" language="javascript">
            function carregaItens()
            { 
              if(document.getElementById("ItensDeCronograma").value != "" && document.getElementById("txthoraitem").value != ""){  
                $.ajax({
                    type: "POST",
                    url: "CorreioItemCronograma.php",
                    data:{
                        nome_item: $('#ItensDeCronograma').val(),
                        horario_item: $('#txthoraitem').val(),
                        
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

        <!-- ==================== Form de Cadastro de Itens do Cronograma =================== -->



        <?php
        include_once("../rod.php");
        ?>