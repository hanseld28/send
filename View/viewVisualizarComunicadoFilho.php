<?php
  include_once("../Controller/ControllerComunicado.php");

  $codAgenda = (isset($_POST['idAgenda'])) ? intval($_POST['idAgenda']) : null;
  $codComunicado = (isset($_POST['idComunicado'])) ? intval($_POST['idComunicado']) : null;

  $controllerComunicado = new ControllerComunicado();

  $resultado = $controllerComunicado->visualizarComunicadoRecebido($codAgenda, $codComunicado);

  $comunicado = (!empty($resultado)) ? $resultado : null ;

  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');
  
  $assunto = (!empty($comunicado->getAssunto())) ? $comunicado->getAssunto() : "(sem assunto)" ;
	
  $descricao = nl2br($comunicado->getDescricao());	

  $dataCompleta = explode(" ", $comunicado->getDataCadastro());
  $data = utf8_encode(strftime('%d de %B de %Y', strtotime($dataCompleta[0])));
  $horario = date('H:i', strtotime($dataCompleta[1]));

/*
echo("<div class='topoTelaVisualizarComunicados'>");

echo("<div class='iconeComunicadoElabel'>");
    echo("<img class='iconeComunicadosFilho' src='../Imagens/iconeComunicadoResponsaveltopo.png'>");
    echo("<label class='lblTelaVisualizarComunicados'>Comunicado - {$assunto}</label>");
echo("</div>");

echo("</div>");
*/

      echo "<div class='comunicadoSelecionadoParaLer'>";

        echo "<div class='topoNomeDoProfessorQueEnviouDataEbotaoDefechar'>";

            echo"<label class='lblNomeDoProfessorQueEnviou'>Professor(a): {$comunicado->usuario->getNome()}</label>";

            echo"<label class='lblturmadocomunicado'>Turma: {$comunicado->turma->getDescricao()}</label>";

            echo"<label class='lblDataEhoraEnviada'>{$data}, ás {$horario}</label>"; 

            echo "<a href='' class='iconeDeFecharComunicado'>";

                echo "<img class='iconFecharCResponsavel' src='../Imagens/iconeDeFecharComunicadoResponsavel.png'>";

            echo "</a>";

        echo "</div>";

        echo "<div class='OcomunicadoEnviado'>";

        echo "<article class='atAssunto'>";

            echo"<label class='lblatAssunto'>Assunto: {$assunto}</label>";

        echo "</article>";

        echo "<article class='atComunicado'>";

            echo "$descricao";

        echo "</article>";
    
        echo "</div>";
	         
     echo "</div>";
	     
	 
	 
	
	


	//echo '<time datetime="'.date('c').'">'.date('Y - m - d').'</time>';
?>



<script type="text/javascript">
	
	function visualizarComunicadosFilho(cod_agenda)
    {
        $.ajax({
            asyn: false,
            url: 'viewVisualizarComunicadosFilho.php',
            dataType: 'html',
            type: 'POST',
            data: { codAgenda: cod_agenda },
            success: function(data)
            {
                $('#painel').html(data);
            }
            
        });
    }

</script>

