<?php
  include_once("../Controller/ControllerComunicado.php");

  $codAgenda = (isset($_POST['codAgenda'])) ? intval($_POST['codAgenda']) : null;


  $controllerComunicado = new ControllerComunicado();
  
  $qtd_comunicados = $controllerComunicado->contarComunicadosRecebidos($codAgenda);  

  $resultado = $controllerComunicado->buscarTodosComunicadosRecebidos($codAgenda);

  $listaComunicados = ($resultado->count() > 0) ? $resultado : null ;


?>

<div class="telaVisualizarComunicados" id="painelComunicados">


<div class="topoTelaVisualizarComunicados">

<a class="iconeRetornarCardsFilhosComunicados" href="#" onclick="mostrarAgenda(<?php echo($codAgenda); ?>)">
    <img class="iconSetaRetornoComunicados" src="../Imagens/iconeRetornarCardsFilhosComunicados.png">
</a>

<div class="iconeElabelFilhos">
    
    <h1 class=""><img class="" src="../Imagens/iconeComunicadoResponsaveltopo.png">Comunicados (<?php echo($qtd_comunicados); ?>)</h1>
</div>

</div>

<div class="conteudoTelaVisualizarComunicados" id="painelComunicados">

<div class="tabelaDosComunicados" id="gradeComunicados">

<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 


  <?php

      if(!is_null($listaComunicados))
      {
          echo("<table class='tabelaComunicadosFilhopV'>");
            echo("<thead>");
                echo("<tr>");
                  //echo("<td class='tituloCFpV'></td>"); 
                  echo("<td class='tituloCFpV'>Comunicado</td>");
                  echo("<td class='tituloCFpV'>Data</td>");
                  echo("<td class='tituloCFpV'>Hora</td>");
                  echo("<td class='tituloCFpV'>Ações</td>");
                echo("</tr>");
            echo("</thead>");

            echo("<tbody>");
          //$i = 1;
          foreach ($listaComunicados as $comunicadoRecebido) 
          { 
              $assunto = (!empty($comunicadoRecebido->getAssunto())) ? "<b>".$comunicadoRecebido->getAssunto()."</b>" : "<b>(sem assunto)</b>" ;
              $descricao = substr($comunicadoRecebido->getDescricao(), 0, 30);

              $dataCompleta = explode(" ", $comunicadoRecebido->getDataCadastro());
              $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
              $horario = str_replace(":", "h", date('H:i', strtotime($dataCompleta[1])))."min";

              echo("<tr class='linhaCFpV'>");
                  
                  //echo("<td>");
                        
                      //echo("<input type='checkbox' id='{$comunicadoRecebido->getId()}'>");

                  //echo("</td>");

                  echo("<td>");
                        
                      echo($assunto." - ".$descricao);

                  echo("</td>");
                  
                  echo("<td>");

                      echo($data);

                  echo("</td>");
                  
                  echo("<td>");

                      echo($horario);

                  echo("</td>");
                  
                  echo("<td>");
                    
                    echo("<a class='btnVisualizarComunicadoFilho' href='#' onclick='visualizarComunicado({$codAgenda}, {$comunicadoRecebido->getId()})'>");

                      echo("visualizar");

                    echo("</a>");

                  echo("</td>");
               
              echo("</tr>");
          }  

            echo("</tbody>");     
        
        echo("</table>");
      }
      else
      {
          echo ("<div class='SemRotina'><p>A agenda não possui comunicados...</p></div>");
      }     
        
  ?>
    </div>

</div>

</div>



<script type="text/javascript">
  
  function mostrarAgenda(codAgenda) 
  {
      $.ajax({
          asyn: false,
          url: "viewConsultarRotinasCrianca.php",
          dataType: "html",
          type: "POST",
          data: {
              idAgenda: codAgenda
          },
          success: function(data) {
              $('#painel').html(data);
          },
      });

  }

  function visualizarComunicado(codAgenda, codComunicado) 
  {
      $.ajax({
          asyn: false,
          url: "viewVisualizarComunicadoFilho.php",
          dataType: "html",
          type: "POST",
          beforeSend: function(){
              $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
          },
          data: 
          {
              idAgenda: codAgenda,
              idComunicado: codComunicado
          },
          success: function(data) {
              $('#gradeComunicados').html(data);
          },
      });

  }


</script>
