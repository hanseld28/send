<?php
    include_once("../Controller/ControllerUsuario.php");
    include_once("../Controller/ControllerRotina.php");
    include_once("funcoesUtilitarias.php");

    $codAgenda = (isset($_POST['idAgenda'])) ? intval($_POST['idAgenda']) : null;

    if (is_null($codAgenda)) 
    {
        $codAgenda = (isset($_GET['url_id_agenda'])) ? intval($_GET['url_id_agenda']) : null;
    }

    $listaDiaSemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');


    $controllerUsuario = new ControllerUsuario();

    $aluno = $controllerUsuario->pesquisarAlunoAgenda($codAgenda);

    $nomeAluno = current(str_word_count($aluno->getNome(), 2));



    // Data atual do Servidor Host
    date_default_timezone_set("America/Araguaina");

    $data_atual = date("Y-m-d");    

    $controllerRotina = new ControllerRotina();

    #########################################################################

?>

<style type="text/css">
    #datepicker_de::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }
    #datepicker_ate::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }

</style>

<div id="splash-loading"></div> <!-- Area da animacao de carregamento -->

<div class="visualizarAgenda">

  <div class='divTopoVoltarCardsFilhos'>

    <a class='iconeRetornarCards' href='#' id='dirFilhos' name='dirFilhos' onclick='voltarDirFilhos()'>
    
    <img class='iconSetaRetorno' src='../Imagens/iconeAgendaSetaRetornoCardFilho.png'>
    
    </a>
    
    <div class='iconeEagenda'>
    

    
    <h1 class=''><img class='' src='../Imagens/iconeAgenda.png'>Agenda do(a) <?php echo($nomeAluno); ?></h1>
    
    </div>

    </div>

    <div class='conteudoAgenda'>
    
            <a href='#' class='iconeComunicado' onclick='visualizarComunicadosFilho(<?php echo($codAgenda); ?>)'>
    
            <img class='iconeComunicadosFilho' src='../Imagens/iconeComunicadoResponsavel.png'>
            </a>
             
              <!-- <div class="NumComunicado">1</div> -->

            <input class='bntTodasAsRotinas' type='button' name='todas' value='Todas' onclick='filtrarTodasRotinasRecebidas(<?php echo($codAgenda); ?>, this.name)'/>

            <label class='lblDe'>Procurar rotinas de</label>
    
                 <input class='inpDe' id='datepicker_de' type='date' <?php echo("value='{$data_atual}'"); echo("max='{$data_atual}'"); ?> required='required'>
    
                 <label class='lblAte'>até</label>
    
                 <input class='inpAte' id='datepicker_ate' type='date' <?php echo("value='{$data_atual}'"); echo("max='{$data_atual}'"); ?> required='required'>
    
                 <input class='bntBuscarRotina' name='intervalo_data' type='button' value='Buscar' onclick='filtrarRotinasRecebidasIntervaloData(this, <?php echo($codAgenda); ?>)'>
    
                
                <div class="ordernarRotinaAgenda">
                 <label class='lblOrdenarPor'>Ordenar por</label>
    
                 <div class='esSelect'>
    
                     <select id='selectOrdenar' onchange='ordenarRotinasRecebidas(<?php echo($codAgenda); ?>)'>
    
                          <option value='0'>Mais recente</option>
    
                          <option value='1'>Mais antiga</option>
    
                      </select>
    
                 </div>
                 </div>

<?php

	if (!is_null($codAgenda)) 
  {
        $resultadoConsulta = $controllerRotina->buscarTodasRotinasRecebidas($codAgenda);

        $listaTodasRotinasRecebidas = (!$resultadoConsulta) ? null : $resultadoConsulta ;

        if (is_null($listaTodasRotinasRecebidas)) 
        {
            echo "<div class='SemRotina'><p>Não foi encontrado nenhuma rotina recebida...</p></div>"; 
        }
        else
        {
            echo "<div class='caixaTabela' id='caixaTabela'>";
                
                echo "<table class='tabelaRotina'>";
                  
                  echo "<thead>";

                  echo "<tr>";
                          echo "<td class='titulo'>N°</td>";
                          echo "<td class='titulo'>Descrição</td>";
                          echo "<td class='titulo'>Turma</td>";
                          echo "<td class='titulo'>Horário</td>";
                          echo "<td class='titulo'>Data</td>";
                    echo "</tr>";
                  
                  echo "</thead>";
                  
                  echo "<tbody>";

              $i = 1;

              foreach ($listaTodasRotinasRecebidas as $key => $rotina) 
              {
                  $dataCompleta = explode(" ", $rotina->getDataCadastro());
                  $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
                  $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";

                  $diaSemana = calculaDiaSemana($data);

                  echo "<tr class='infoRotinas'>";

                        echo "<td>";          
                           echo $i;
                        echo "</td>";
                         
                        echo "<td>";
                           echo "Rotina de ".$diaSemana;
                        echo "</td>";
                        
                        echo "<td>";
                           echo $rotina->turma->getDescricao();    
                        echo "</td>";

                        echo "<td>";
                           echo $horario;    
                        echo "</td>";

                        echo "<td>";
                           echo $data;    
                        echo "</td>";
                    
                        echo "<td>";
                           echo "<a class='btnVisualizarRotina' href='#' onclick='mostrarRotina({$rotina->getId()}, {$codAgenda})'>visualizar</a>";  
                        echo "</td>";

                  echo "</tr>";
                              

                    $i++;
                }

                echo "<tbody>";

                echo "</table>";
              
                echo "</div>";
            }
      }          
      else 
      {
          echo "Agenda não encontrada..."; // Substituir por um Alert
      }          


    echo "</div>";

?>

</div>

<script type="text/javascript" language="javascript">
            
    
    function mostrarRotina(codRotina, codAgenda){
        $.ajax({ 
            asyn: false,
            url: "viewConsultarRotinaEspecifica.php?idAgenda="+codAgenda,
            dataType: "html",
            type: "POST",
            beforeSend: function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            },
            data: { idRotina: codRotina},
            success: function(data){
                $('#painel').html(data);
            },
        });
                
    }
     
    function voltarDirFilhos(){
        // Carrega os dados de: pagina_conteudo.php na div id="conteudo"
        $("#painel").load('viewConsultarFilhosResponsavel.php');        
    };     
    

    // Filtros de pesquisa
    function filtrarTodasRotinasRecebidas(cod_agenda, filtro) 
    {
        $.ajax({
            asyn: false,
            url: "viewFiltrarRotinasRecebidas.php",
            dataType: "html",
            type: "POST",
            data: 
            { 
                codAgenda: cod_agenda,
                parametro: filtro
            },
            success: function(data)
            {
              $("#caixaTabela").html(data);
            }
        });
      
    }

    function filtrarRotinasRecebidasIntervaloData(filtro, cod_agenda) 
    {
        $.ajax({
          asyn: false,
          url: "viewFiltrarRotinasRecebidas.php",
          dataType: "html",
          type: "POST",
          data: 
          {
            data_de: $("#datepicker_de").val(), 
            data_ate: $("#datepicker_ate").val(),
            filtro_data: filtro.name,
            codAgenda: cod_agenda
          },
          success: function(data)
          {
            $("#caixaTabela").html(data);
          }

      });
      
    }

    function ordenarRotinasRecebidas(cod_agenda)
    {
        var ordenar_por;

        $("#selectOrdenar option").each(function() {

          if($(this).prop("selected"))
          {
            ordenar_por = $(this).val();
          }

        });

        $.ajax({
          asyn: false,
          url: "viewFiltrarRotinasRecebidas.php",
          dataType: "html",
          type: "POST",
          data: 
          {
            ordenarPor: ordenar_por, 
            codAgenda: cod_agenda
          },
          success: function(data)
          {
            $('#caixaTabela').html(data);
          }
        });

    }



    function visualizarComunicadosFilho(cod_agenda)
    {
        $.ajax({
            asyn: false,
            url: 'viewVisualizarComunicadosFilho.php',
            dataType: 'html',
            type: 'POST',
            beforeSend: function(){
                $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
            },
            data: { codAgenda: cod_agenda },
            success: function(data)
            {
                $('#painel').html(data);
            }
            
        });
    }
    
    //Paginação
    function pgrotina(pagina){
        // Carrega os dados de: pagina_conteudo.php na div id="conteudo"
        $("#painel").before(function(){
            $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Carregando...</label></div>");
        });
        $("#painel").load(pagina);        
    }
</script>
