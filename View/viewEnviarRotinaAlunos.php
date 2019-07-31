   <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
   <script src="../css/sweetalert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
   <div id="splash-loading">      
   </div>
   <?php

   include_once("../Controller/ProfessorTurmaCRUD.php");
   include_once("../Controller/AlunoCRUD.php");
   include_once("verificaUsuarioLogado.php");
   include_once("../Controller/ControllerCard.php");
   include_once("../Controller/ControllerAlternativa.php");
   include_once("../Controller/ControllerRotina.php");

   if(!isset($_SESSION))
   {
    session_start();
  }

  if(isset($_POST['codigoturma']))
  { 
    $codigoturma = intval($_POST['codigoturma']);
  }

  $controllerProfessorTurma = new ProfessorTurmaCRUD();
  $nomeTurma = $controllerProfessorTurma->consultarNomeTurma($codigoturma);

  $lista = array();
  $pt = new ProfessorTurma();
  $crud = new ProfessorTurmaCRUD();
  $lista = $crud->consultarAlunosTurma($codigoturma);
  $pt = $lista;


      // Instancia a classe ControllerCard
  $controllerCard = new ControllerCard();
      // Instancia a classe ControllerAlternativa
  $controllerAlternativa = new ControllerAlternativa();

      // Recebe o retorno do método consultarCard
  $listaCards = $controllerCard->consultarCard();
      // Recebe o retorno do método consultarCard
  $listaAlternativas = $controllerAlternativa->consultarAlternativa();

      // Data/Horário atual do Servidor Host
  date_default_timezone_set("America/Araguaina");

  $data_servidor = date("d-m-Y");
  $data_atual = str_replace("-", "/", $data_servidor);

  $horario_atual = date("H:i");

      // Data da última rotina enviada

  $codUsuario = $_SESSION["codUsuario"];

  $controllerRotina = new ControllerRotina();
  $exists_rotina_enviada = $controllerRotina->dataUltimaRotinaEnviada($codUsuario, $nomeTurma);

  $ultimaRotinaEnviada = (is_object($exists_rotina_enviada)) ? $exists_rotina_enviada : null ; 

  if (!is_null($ultimaRotinaEnviada))
  {
    $aux_data_ult_rotina = date('d-m-Y', strtotime($ultimaRotinaEnviada->getDataCadastro()));

    $horario_ultima_rotina_enviada = date('H:i', strtotime($ultimaRotinaEnviada->getHorarioEnvio()));

    $data_ultima_rotina_enviada = str_replace("-", "/", $aux_data_ult_rotina);

          //$horario_ultima_rotina_enviada = str_replace("-", "/", $aux_horario_ult_rotina);
  }
  else
  {
    $data_ultima_rotina_enviada = "-- / -- / ----";

    $horario_ultima_rotina_enviada = "-- : --";
  } 

  $dadosRotina = $controllerRotina->dadosAnaliticosRotinasTurma($codigoturma);
  $dadosRotina['restantes'] = count($lista) - $dadosRotina['enviadas'];

  ?>
  
  <script>
    function abrirModal(){
     $('#menu-cima').css('z-index','-1');
     $('body').css('overflow-y','hidden');
     $('#menu-lateral').css('z-index','-1');
     $('.menutopotelaEnviarRotinaAlunos').css('z-index','0');
     $('.iconeSetaRetornoturmas').css('z-index','0');
     $('#logo').css('z-index','0');
     $('.btnEnviarRotinaAlunos').css('z-index','-1');
   }
 </script>


 <script>

  function fecharModal(){
   $('#menu-cima').css('z-index','1');
   $('body').css('overflow-y','scroll');
   $('#menu-lateral').css('z-index','9999');
   $('.menutopotelaEnviarRotinaAlunos').css('z-index','1');
   $('.iconeSetaRetornoturmas').css('z-index','1');
   $('#logo').css('z-index','9998');
   $('.btnEnviarRotinaAlunos').css('z-index','0');
 }
</script>

<style type="text/css">
input[type=time]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  display: none;
}
</style>

<script type="text/javascript"> 

  $(document).ready(function(){
    $('.tgl').before('<div class="iconeExpandirDivSelectsCategoriasRotinas"><img class="iconSetaExpandirSelectCategoriasRotinas" src="../Imagens/iconeSetaExpandirSelectsCategoriasRotinas.png"></img></div>');
    $('.tgl').css('display', 'none')
    $('.iconeExpandirDivSelectsCategoriasRotinas', '#box-toggle').click(function() {
      $(this).next().slideToggle('slow')
      .siblings('.tgl:visible').slideToggle('very fast');

      $(this).toggleText('Revelar','Esconder')
      .siblings('div').next('.tgl:visible').prev()
      .toggleText('Revelar','Esconder')
    });
  })
</script>

<!-- ########################################################################### -->    


<div class="telaEnviarRotinaAlunos">

 <div class="topotelaEnviarRotinaAlunos">
   <a class="iconeSetaRetornoturmas" href="#" onclick="voltarPageAnterior(<?php echo($codUsuario); ?>)">
     <img class="iconSetaRetornoturmas" src="../Imagens/iconeSetaRetornoRotinasAlunos.png">
   </a>
   <div class="iconeElabelRotina">
     <h1 class=""><img class="" src="../Imagens/iconeRotinaAluno.png">Rotina</h1>
   </div>
 </div>

 <div class="conteudotelaEnviarRotinaAlunos">

  <div class="menutopotelaEnviarRotinaAlunos">

    <a class="btnNovaRotinaAlunos" href="#" onclick="carregaNovaRotina(<?php echo($codUsuario.", ".$codigoturma); ?>)">
      <div class="iconeElabelNovaRotinaAlunos">
        <img class="iconNovaRotinaAlunos" src="../Imagens/iconeNovaRotinaAlunos.png">
        <label class="lblNovaRotinaAlunos">Nova</label>
      </div>
    </a>
    <a class="btnTodasAsRotinasEnviadas" href="#" onclick="carregaRotinasEnviadas(<?php echo($codUsuario.", ".$codigoturma); ?>)">
      <div class="iconeElabelTodasRotinaAlunos">
        <img class="iconTodasAsRotinasEnviadas" src="../Imagens/iconeTodasAsRotinasEnviadas.png">
        <label class="lblTodasAsRotinasEnviadas">Todas</label>
      </div>
    </a>
    <a class="btnRecentesRotinasEnviadas" href="#" onclick="carregaRotinasRecentes(<?php echo($codUsuario.", ".$codigoturma); ?>)">
      <div class="iconeElabelRecentesRotinaAlunos">
        <img class="iconRecentesRotinasEnviadas" src="../Imagens/iconeRecentesRotinasEnviadas.png">
        <label class="lblRecentesRotinasEnviadas">Recentes</label>
      </div>
    </a>

  </div>

  <div id="conteudoPageRotina" class="painelNovaRotinasEnviadas">

    <div class="caixaGlobalNovaRotinasEnviadas">

      <div class="caixaDataHorarioEultimaData">
        <label class="lblTitDataAtual">Data: <label class="lblDataAtual"><?php echo($data_atual); ?></label></label>
        <label class="lblHorarioRotina">Horário<input class="inpHR" id="horarioEnvio" <?php echo("value='{$horario_atual}'");?> type="time" required="required"></label>
        <label class="lblUltimaDataRotina">Última rotina enviada: <label class="lblDataDaUltima"><?php echo($data_ultima_rotina_enviada." às ".$horario_ultima_rotina_enviada); ?></label></label>
      </div>

      <div class="caixaTurma">
        <div class="localDeterminadaTurmaRotina">
          <label class="lblDeterminadaTurmaRotina">Turma: </label><?php echo '<label class="lblDeterminadaTurmaRotina">'.$nomeTurma.'</label>' ?>
        </div>
      </div>
      
      <?php 

      if ($dadosRotina['restantes'] > 0)
      {
       echo("<article class='artC2'>");

       echo("<label class='lblRoEnviadas'>Enviadas: {$dadosRotina['enviadas']}</label>"); 

       echo("<label class='lblRoFaltam'>Restantes: {$dadosRotina['restantes']}</label>");

       echo("</article>");
     } 
     else
     {
      echo("<article class='artC2'>");

      echo("Rotinas diárias enviadas: {$dadosRotina['enviadas']}/{$dadosRotina['enviadas']}");

      echo("</article>");
    }

    echo("<label class='lblTotalOcorrencias'>Total de ocorrências (hoje): {$dadosRotina['qtdOcorrencias']}</label>"); 
    ?>


    <div id="box-toggle">
      <label class="lblMesmaRotinaParaTodos">Aplicar mesma rotina (será aplicado para todos os alunos)</label>
      <div class="tgl">
        <div class="caixaSelectsTodasCategorias">
          <div class="caixaCheckBoxTodasCategorias">
            <div class="selecionarTodos">
              <input type="checkbox" class='checkbox-regularC' id="selecionar_rotinas_default" onclick="selecionar_todas_rotinas_default();"> 
              <label class="lblSelecionarTAlunos">Selecionar todas as categorias</label>
            </div>
          </div>
        </div>
        <table class="tabelaNovaRotinaSelects" id="table_rotina_default">
          <thead>
            <tr id="rotinasDefault">
              <td></td>
              <?php
              $i = 1;
              foreach ($listaCards as $obj) 
              {    
                echo("<td class='tituloCdSRotinaTurma'>");
                echo("<input class='checkbox-regularS' type='checkbox' name='cardsDefault' id='colunaDefault{$i}' value='{$obj->getId()}'' onclick='habilitar_desabilitar_coluna(this.id);'>");
                echo("{$obj->getDescricao()}");
                echo("</td>");

                $i++;
              }
              ?>
            </tr>
          </thead>

          <tbody>
           <tr class="linhaCdSRotinaTurma">
             <td >Alternativas</td>
             <?php
             $i = 1;
             foreach ($listaCards as $obj) 
             {    
               echo("<td id='colunaDefault{$i}'>");

               echo ("<div class='div-selectRCards'>");

               echo("<select name='selectAltCard' disabled>");
               echo("<option value='' style='display: none;'></option>");
               foreach ($listaAlternativas as $alternativa) 
               {                            
                 echo("<option name='altCardDefault' id='coluna{$i}' value='{$alternativa->getId()}'>");

                 echo($alternativa->getDescricao());

                 echo("</option>");
               }

               echo("</select>");

               echo ("</div>");

               echo("</td>");

               $i++;
             }
             ?>
           </tr>
         </tbody>

       </table>
       <div class="caixaBtnConfirmarSelecao">
        <input class="btnConfirmarSelecao" type="button" name="confirm_aplicar_rotina" id="confirm_aplicar_rotina" value="Aplicar" onclick="aplicar_rotina_todos_alunos();">
      </div>
    </div>

  </div>

  <div class="linhatgl"></div>

  <div class="caixaRotinaEspecificaCampoPesquisaEtabelaNovaRotina">

    <div class="divPesquisaAlunoRotinaEspecifica">


      <label class="lblRotinaEspecificaParaAluno">Algum aluno teve algo de diferente em sua rotina? (envie uma rotina específica para este aluno)</label>

      <img class="setinhaEspecificaRotina" src="../Imagens/setinhaRotinaEspecifica.png">

      <label class="">

        <input class="inpPesquisaAluno" placeholder="Digite o nome do aluno" type="search" id="search" alt="tabelaNovaRotinaDeterminadaTurma">



      </label>
    </div>


    <form name="formRotinaAlunos" style="margin-top: 92px;">
      <table class="tabelaNovaRotinaDeterminadaTurma" id="table_rotina_alunos">
        <thead>
          <tr id="cardsRotina">
            <td class="tituloCdRotinaTurma">Aluno</td>
            <?php
            $i = 1;
            foreach ($listaCards as $obj) 
            {    
              echo("<td class='tituloCdRotinaTurma' id='coluna{$i}'>");
              echo("<input class='checkbox-regularCt' type='checkbox' name='cards' id='coluna{$i}' value='{$obj->getId()}' onclick='habilitar_desabilitar_coluna(this.id)' disabled>");
              echo("{$obj->getDescricao()}");
              echo("</td>");

              $i++;
            }
            ?>
            <td class="tituloCdRotinaTurma">Status</td>
            <td class="tituloCdRotinaTurma">Ocorrência</td>

          </tr>
        </thead>

        <tbody id="alunosRotina">

          <?php 
          $j = 1;

          foreach($pt as $aluno)
          {
            $i = 1;

            $alu = new AlunoCRUD();
            $nomealuno = $alu->pesqAlunoPorCodigo($aluno['codAluno']);
            $codigodoaluno = $aluno['codAluno'];

            $codAgendaAluno = intval($alu->AgendaAlunoPorCodigo($codigodoaluno));


                        // Validar Rotinas enviadas
            $controllerRotina = new ControllerRotina();
            $rotinaEnviada = $controllerRotina->checarRotinaEnviada($codAgendaAluno);
                        // ---------------------------------------------------------------

            echo("<tr class='linhaCdRotinaTurma' id='linha{$j}'>");

            echo("<td class='linhaAlunosNome'>");

            echo("<input class= 'checkbox-regularN' type='checkbox' id='linha{$j}' name='ckbAluno' value='{$codAgendaAluno}'>");

            echo($nomealuno);

            echo("</td>");

            foreach ($listaCards as $obj) 
            {    
              echo("<td class='linhaSelect' name='linha{$j}' id='coluna{$i}'>");

              echo ("<div class='div-selectRAprendizadoAlternativaAlunos'>");

              echo("<select name='selectAltCard' id='coluna{$i}' disabled>");
              echo("<option value='' style='display: none;'></option>");
              foreach ($listaAlternativas as $alternativa) 
              {                            
                echo("<option id='altCard' name='altCard' value='{$alternativa->getId()}'>");

                echo($alternativa->getDescricao());

                echo("</option>");
              }

              echo("</select>");

              echo ("</div>");

              echo("</td>");

              $i++;
            }

            echo("<td class='linhaRotinaStatus' name='linha{$j}'>");

            if ($rotinaEnviada)
            {
              echo("Enviada");
            }
            else
            {
              echo("Pendente");
            }

            echo("</td>");

            echo("<td class='linhaOcorrencia'>");

                                //echo("<span class='toolTipTextoPerfil'>Texto da ocorrência...</span>");
            echo("<a href='#openModal{$codigodoaluno}' id='#openModal{$codigodoaluno}' onclick='controle_modal_ocorrencia_abrir({$codigodoaluno}); abrirModal()'>");
            echo("<input class='btnAdicionarOcorrenciaAluno' type='button' class='add_field_button' name='btnAddOcorrencia' id='linha{$j}' value='+' disabled/>");
            echo("</a>");

            echo("<div id='openModal{$codigodoaluno}' class='modalDialog'>");

            echo("<div class='caixaOcorrencia'>");
            echo("<div class='caixaLabelocorrencia'>");

            echo("<label class='lblOcorrencia' id='lblOcorrencia'>Nova ocorrência</label>");

            echo("<a href='#' id='btnFechaMoldalOcorrencia' class='btnFechaMoldalOcorrencia' onclick='controle_modal_ocorrencia_fechar({$codigodoaluno}, this);fecharModal()'><div = id='closeModal'>-</div></a>");

            echo("</div>");

            echo("<label class='lblParaRotina'>Aluno: "); 
            echo("<label class='lblNomeAlunoOcorrencia'>{$nomealuno}</label>");
            echo("</label>");

            echo("<textarea class='taOcorrencia' name='ocorrenciaAgenda{$codAgendaAluno}' id='ocorrenciaAgenda{$codAgendaAluno}' placeholder='Relate aqui a ocorrência do aluno...'></textarea> ");

            echo("<input type='button' class='btnSalvarOcorrencia' id='btnSalvarOcorrencia' value='Salvar' onclick='salvarOcorrenciaAluno({$j}, {$codigodoaluno})'/>");

            echo("<input type='button' class='btnCancelarOcorrencia' id='ocorrenciaAgenda{$codAgendaAluno}' value='Cancelar' onclick='limparTextAreaOcorrencia(this)' style='margin-top: 30px; margin-left: 200px;'/>");

            echo("</div>");

            echo("</div>");

            echo("</td>");

            echo("</tr>");

            $j++;
          }

          ?>

        </tbody>

      </table>

    </form>

  </div>
  <!-- <button class="btnCancelarRotinaAlunos">Cancelar</button> -->
  <button class="btnEnviarRotinaAlunos" onclick="mandarRotina(<?php echo($codigoturma); ?>)">Enviar</button>

</div>

</div>

</div>

</div>




<!-- ########################################################################### -->  

<script type="text/javascript" language="javascript">
  function mandarRotina(codturma)
  { 
    var listaAgendas = [];
    var listaCards = [];
    var listaAlternativasCard = [];
    var listaOcorrencias = [];
    var aux;

    $("input:checkbox[name=ckbAluno]:checked").each(function(){
      listaAgendas.push($(this).val());

      id_agenda = $(this).val();

      $("#ocorrenciaAgenda" + id_agenda).each(function(){
        listaOcorrencias.push($(this).val());
      });

    });

    $("input:checkbox[name=cards]:checked").each(function(){
      listaCards.push($(this).val());
    });

    $("option[name=altCard]:selected").each(function(){
      listaAlternativasCard.push($(this).val());
    });

    var msg_valid = validaFormularioRotina();  


                //alert(msg_valid);

                
                if (msg_valid[1] == "error")
                {
                  alert(msg_valid[0]);
                }
                else if (msg_valid[0] == "ok" && msg_valid[1] == "new_rotina") 
                {

                  swal({
                    title: "Tem certeza que deseja enviar a(s) rotina(s)?",
                    icon: "warning",
                    buttons: [
                    'Não',
                    'Sim'
                    ],
                    dangerMode: true,
                  }).then(function(isConfirm) { 
                    if (isConfirm) {

                      $.ajax({
                        asyn: false,
                        type: "POST",
                        url: "viewCadastrarRotina.php",
                        beforeSend: function(){
                          $("#splash-loading").append("<div class='enviandoCarregando' id='enviandoCarregando'><div class='divimg'></div><label id='textCE'>Enviando...</label></div>");
                        },
                        data:{
                          agendas: listaAgendas,
                          cards: listaCards,
                          altCard: listaAlternativasCard,
                          ocorrencias: listaOcorrencias,
                          codTurma: codturma,
                          horarioEnvio: $("#horarioEnvio").val()
                        },
                        success: function(data){
                          $('#painelAbas').html(data);  
                        }
                      });
                    } 
                  });
                }
                else if (msg_valid[0] == "ok" && msg_valid[1] == "add_ocorrencia")
                {

                  swal({
                    title: "Tem certeza que deseja enviar a(s) ocorrência(s)? (Será adicionada à rotina existente)",
                    icon: "warning",
                    buttons: [
                    'Não',
                    'Sim'
                    ],
                    dangerMode: true,
                  }).then(function(isConfirm) { 
                    if (isConfirm) {

                     $.ajax({
                      asyn: false,
                      type: "POST",
                      url: "viewCadastrarRotina.php",
                      data:{
                        agendas: listaAgendas,
                        ocorrencias: listaOcorrencias,
                        codTurma: codturma,
                      },
                      success: function(data)
                      {
                        $('#painelAbas').html(data);  
                      }
                    });
                   } 
                 });
                }
                
                
              }


            </script>  



            <script language="text/javascript">

              var wrapper = $(".modalDialog");

              document.addEventListener('keyup', function(e){
                if(e.keyCode == 27) {
                  wrapper.css("display", 'none');
                }
              });

/*
        document.addEventListener('click', function(e){

          $("#btnSalvarOcorrencia").click(function(){
            $("a[href=#close]").trigger('click');
          });

        });*/

        $(function(){
          $(".inpPesquisaAluno").keyup(function(){
                //pega o css da tabela 
                var tabela = $(this).attr('alt');
                if( $(this).val() != ""){
                  $("."+tabela+" tbody>tr").hide();
                  $("."+tabela+" td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                } else{
                  $("."+tabela+" tbody>tr").show();
                }
              }); 
        });
        $.extend($.expr[":"], {
          "contains-ci": function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
          }
        });


        //document.getElementById('search').addEventListener('keyup', pesquisaTabela());

        var selectOption;

        $(document).ready(function() {

          altera_cor_dinamicamente();
        });


        var countAlunosChecked = 0;    

        $("#table_rotina_alunos input:checkbox").on("click", function() {

          var qntdAlunos = 0;   

          if ($(this).prop("checked") == true) 
          {
                    //if (countAlunosChecked > 0)
                    //{
                      habilitarCheckBoxes();
                    //}

                    //
                    if (this.name == "ckbAluno")
                    {
                      habilitarLinha(this.id);
                      countAlunosChecked++;
                    }
                  }
                  else
                  {
                    if (this.name == "ckbAluno")
                    {
                      desabilitarLinha(this.id);
                      countAlunosChecked--;
                      checkbox_replicar_invisible();
                    }

                    //
                    if (countAlunosChecked == 0)
                    {
                      desabilitarCheckBoxes();

                        // Remove o checked 
                        $('#selecionarCards').prop("checked", false);
                        $('#selecionarAlunos').prop("checked", false);

                      }

                    }


                    if ($(this).prop("checked") == true)
                    {

                      if (this.id == "selecionarAlunos")
                      {
                        // Checked em todos alunos
                        $('#alunosRotina input:checkbox').each(function(){

                          qntdAlunos++;   

                          if ($(this).prop("checked") == false)
                          {
                            $(this).prop("checked", true);

                            if (countAlunosChecked < qntdAlunos)
                            {
                              countAlunosChecked++;
                            }
                          }
                          else
                          {
                            $(this).prop("checked", false);   

                            if (countAlunosChecked > 0)
                            {
                              countAlunosChecked--;
                            }
                          }


                        });

                      }
                      else if (this.id == "selecionarCards")
                      {
                        //alert("Selecionar todos (cards): Checkeeeeed");
                        // Habilita todos os cards/rotinas
                        $('#cardsRotina input:checkbox').each(function(){

                          if ($(this).prop("checked") == true)
                          {
                            $(this).prop("checked", false);
                          }
                          else ($(this).prop("checked") == false)
                          {
                            $(this).prop("checked", true);

                            habilitarColuna(this.id);
                          }


                        });

                      }
                      else if (this.id == "replicarRespostas")
                      {
                        var value_option = 0;

                        $("#alunosRotina select").each(function(){

                          if (this.id == selectOption.id)
                          {
                            value_option = $(selectOption).prop("selectedIndex");

                            $(this).prop("selectedIndex", value_option);
                          }

                        }); 

                      }


                    }
                    else if ($(this).prop("checked") == false)
                    {

                      if (this.id == "selecionarAlunos")
                      {
                        // Checked em todos alunos
                        $('#alunosRotina input:checkbox').each(function(){

                          countAlunosChecked--;

                          if ($(this).prop("checked") == false)
                          {
                            $(this).prop("checked", true);
                          }
                          else
                          {
                            $(this).prop("checked", false);   

                            $('#selecionarCards').prop("checked", false);
                          }

                        });

                      }

                    }
                //alert("Checked's Alunos = " + countAlunosChecked);

              });

   function uncheckedCheckBoxes()
   {
                // this code here
              }

              function habilitarCheckBoxes()
              {
                // Habilita todos os cards/rotinas
                $('#cardsRotina input:checkbox').each(function(){

                  if ($(this).prop("disabled") == true)
                  {
                    $(this).prop("disabled", false);
                  }

                });

                $('#selecionarCards').each(function(){

                  if ($(this).prop("disabled") == true)
                  {
                    $(this).prop("disabled", false);
                  }

                });
              }

              function desabilitarCheckBoxes()
              {
                // Habilita todos os cards/rotinas
                $('#cardsRotina input:checkbox').each(function(){

                  if ($(this).prop("disabled") == false)
                  {
                        //
                        $(this).prop("disabled", true);
                        $(this).prop("checked", false);
                        //

                        //            
                        $('#selecionarCards').each(function(){
                          $(this).prop("disabled", true);
                        });
                        //

                        desabilitarColuna(this.id);
                        //
                      }

                    });

              }

              function habilitarColunaDefault(id)
              {
                var coluna = "#" + id + " select";
                var coluna_element, linha_element;

                $(coluna).each(function(){

                  coluna_element = $(this);                   

                  coluna_element.prop("disabled", false);                           

                });    

              }

              function desabilitarColunaDefault(id)
              {
                var coluna = "#"+id;
                
                $(coluna + ' select').each(function(){

                  $(this).prop("disabled", true);

                  $(this).prop("selectedIndex", 0);

                  retorna_cor_padrao_select(this);
                });

              }   


            // Habilitar e Desabilitar colunas da tabela
            function habilitar_desabilitar_coluna(id)
            {
              var coluna = "#"+id;

              $(coluna + ' select').each(function(){

                if ($(this).prop("disabled") == true)
                {
                  $(this).prop("disabled", false);
                }
                else if ($(this).prop("disabled") == false)
                {
                  $(this).prop("disabled", true);

                  $(this).prop("selectedIndex", 0);

                  retorna_cor_padrao_select(this);
                }

              });

            }   

            // Desabilitar colunas da tabela
            function desabilitarColuna(id)
            {
              var coluna = "#"+id;

              $(coluna + ' select').each(function(){

                $(this).prop("disabled", true);

                $(this).prop("selectedIndex", 0);

              });

            }   

            // Habilitar colunas da tabela
            function habilitarColuna(id)
            {
              var coluna = "#" + id + " select";
              var coluna_element, linha_element;

              $(coluna).each(function(){

                coluna_element = $(this);                   
                linha_element = $(this).parent();

                $("#alunosRotina input:checkbox").each(function(){
                  if($(this).prop("checked"))
                  {
                    coluna_element.prop("disabled", false);                           
                  }

                });

              });    

            } 
            
            // Habilitar as linhas da tabela
            function habilitarLinha(id)
            {
              var linha = "#" + id + " td select";
              var btn_ocorrencia = "#" + id + " td input:button";
              var aluno_element, coluna_element, id_linha, id_coluna;

              $("#cardsRotina input:checkbox").each(function(){

                coluna_element = $(this);                   
                id_coluna = this.id;

                $(linha).each(function() {

                  if(coluna_element.prop("checked"))
                  {
                    if (this.id == id_coluna)
                    {
                      $(this).prop("disabled", false);
                    }

                  }

                });                    
                
              });

              $("#alunosRotina input:checkbox").each(function(){

                id_linha = this.id;
                aluno_element = $(this);

                $(btn_ocorrencia).each(function() {

                  if(aluno_element.prop("checked"))
                  {
                    if (this.id == id_linha)
                    {
                      $(this).prop("disabled", false);
                      altera_cor_btn_ocorrencia($(this));
                    }

                  }

                });

              });

            }

            // Desabilitar as linhas da tabela
            function desabilitarLinha(id)
            {
              var linha = "#" + id + " td select";
              var btn_ocorrencia = "#" + id + " td input:button";
              var aluno_element, id_linha_aluno, btn_ocorrencia;

              $(linha).each(function() {
                $(this).prop("selectedIndex", 0);

                retorna_cor_padrao_select(this);

                $(this).prop("disabled", true);
              });

              $("#alunosRotina input:checkbox").each(function(){

                id_linha_aluno = this.id;
                aluno_element = $(this);

                $(btn_ocorrencia).each(function() {

                  if (this.id == id_linha_aluno)
                  {
                    $(this).prop("disabled", true);
                    altera_cor_btn_ocorrencia($(this));
                  }

                });

              });

            }

            ///////////////////////////////////////////
            function checkbox_replicar_visible()
            {
              $(".bkg-replicar-todos").css("display", 'block');  
            }

            function checkbox_replicar_invisible()
            {
              $(".bkg-replicar-todos").css("display", 'none');
              $(".bkg-replicar-todos input:checkbox").prop("checked", false);
            }

            function verifica_opcao_selecionada() 
            {
              $("#alunosRotina select").each(function() {

                if ($(this).prop("selectedIndex") > 0)
                {
                  checkbox_replicar_visible();
                }

              });
            }
            
            function checkbox_selecionar_visible()
            {
              if ($(".bkg-selecionar-rotinas").css("display") == "none")
              {
                $(".bkg-selecionar-rotinas").css("display", "block");  
              }
              else if ($(".bkg-selecionar-rotinas").css("display") == "block")
              {
                $(".bkg-selecionar-rotinas").css("display", "none");   
              }
            }
            
            function table_default_visible()
            {
              if ($(".bkg-table-default").css("display") == "none")
              {
                $(".bkg-table-default").css("display", "block");  
                $(".bkg-button-confirm").css("display", "block");
              }
              else if ($(".bkg-table-default").css("display") == "block")
              {
                $(".bkg-table-default").css("display", "none");  
                $(".bkg-button-confirm").css("display", "none"); 
              }
            }

            function troca_funcao_botao()
            {
              if ($("#confirmar-rotina-padrao").val() == "Sim")
              {
                $("#confirmar-rotina-padrao").val("Não");
              }
              else
              {
                $("#confirmar-rotina-padrao").val("Sim");
              }   
            }

            //////////////////////////////////////////////////////
            function selecionar_todas_rotinas_default() 
            {
              var count_checked = 0;
                // Habilita todos os cards/rotinas
                $('#rotinasDefault input:checkbox').each(function(){

                  if ($(this).prop("checked") == true)
                  {
                    $(this).prop("checked", false);

                    desabilitarColunaDefault(this.id);
                  }
                  else if ($(this).prop("checked") == false)
                  {
                    $(this).prop("checked", true);

                    habilitarColunaDefault(this.id);
                  }

                });

                

                /*
                if (count_checked == 0) 
                {
                    checkbox_replicar_invisible(); 
                }
                else
                {
                    checkbox_replicar_visible();
                }
                */
              }

              function salvarOcorrenciaAluno(id_linha, id_aluno)
              {
                swal({
                  title: "Deseja salvar a ocorrência descrita?",
                  icon: "warning",
                  buttons: [
                  'Não',
                  'Sim'
                  ],
                  dangerMode: true,
                }).then(function(isConfirm) { 
                  if (isConfirm) {
                   var btn_ocorrencia = "#linha" + id_linha + " input:button[name=btnAddOcorrencia]";

                   $(btn_ocorrencia).attr("value", "✓");
                   $(btn_ocorrencia).css("background-color", "limegreen");

                   controle_modal_ocorrencia_fechar(id_aluno, false); 

                   $('#menu-cima').css('z-index','1');
                   $('body').css('overflow-y','scroll');
                   $('#menu-lateral').css('z-index','5');
                   $('.menutopotelaEnviarRotinaAlunos').css('z-index','1');
                   $('.iconeSetaRetornoturmas').css('z-index','1');
                   $('#logo').css('z-index','9998');
                   $('.btnEnviarRotinaAlunos').css('z-index','0');
                 } 
               });     
              }
              function controle_modal_ocorrencia_abrir(id_aluno)
              { 
                var controlModal = "#openModal" + id_aluno;

                $(controlModal).css("display", "block");   
              }

              function controle_modal_ocorrencia_fechar(id_aluno, btn)
              { 
                var controlModal = "#openModal" + id_aluno;
                //var wrapper_ocorrencia = "#ocorrenciaAgenda" + id_aluno;
                if(btn != false)
                {
                  var id_modal = $(btn).parent().parent().parent().prop("id");
                  var text_area = $("#"+id_modal+" textarea");

                  if(text_area.prop("value") != "")
                  {
                    swal({
                    title: "Deseja manter a ocorrência descrita?",
                    icon: "warning",
                    buttons: [
                    'Não',
                    'Sim'
                    ],
                    dangerMode: true,
                  }).then(function(isConfirm) {
                    if (isConfirm) {

                    } else {
                      text_area.prop("value", "");
                    }
                  });
                  }  
                } 
                $(controlModal).css("display", "none");

                
                //$("#closeModal").trigger("click");

              }

              function aplicar_rotina_todos_alunos()
              {
                var rotinas_checked = 0;
                var rotinas_options_selected = 0;

                $("#table_rotina_default input:checkbox").each(function(){

                  if ($(this).prop("checked")) 
                  {
                    rotinas_checked++;
                  }

                });

                $("#table_rotina_default select").each(function(){

                  if ($(this).prop("selectedIndex") > 0) 
                  {
                    rotinas_options_selected++;
                  }

                });


                if (rotinas_checked == 0) 
                {
                  AlertdeErro.render('<h1>Selecione ao menos uma rotina</h1>');
                }
                else
                {
                  if (rotinas_options_selected == 0)
                  {
                    AlertdeErro.render('<h1>Nenhuma alternativa foi selecionada ainda</h1>');
                  }
                  else if(rotinas_options_selected < rotinas_checked)
                  {
                    AlertdeErro.render('<h1>Selecione as alternativa restantes</h1>');
                  }
                  else
                  {  

                    swal({
                      title: "Tem certeza que deseja aplicar a rotina criada para todos os alunos?",
                      icon: "warning",
                      buttons: [
                      'Não',
                      'Sim'
                      ],
                      dangerMode: true,
                    }).then(function(isConfirm) { 
                      if (isConfirm) {


                        var listaCardsDefault = [];
                        var listaAlternativasDefault = [];
                        var listaColunasDefault = [];
                        var i = 0;
                        var j = 0;

                        $("#table_rotina_default input:checkbox[name=cardsDefault]:checked").each(function(){
                          listaCardsDefault.push($(this).val());
                        });

                        $("#table_rotina_default option[name=altCardDefault]:selected").each(function(){
                          listaAlternativasDefault.push($(this).val());
                        });

                        $("#table_rotina_default option[name=altCardDefault]:selected").each(function(){
                          listaColunasDefault.push(this.id);
                        });

                        var qtdColunas = listaColunasDefault.length;
                            //alert(listaColunasDefault + " - " + listaCardsDefault);

                            //var value_option = 0;

                            $("#table_rotina_alunos #alunosRotina input:checkbox").each(function() {

                              if ($(this).prop("checked") == false)
                              {
                                $(this).prop("checked", true);
                                countAlunosChecked++;
                              }

                            });

                            $("#table_rotina_alunos #cardsRotina input:checkbox").each(function(){

                              if ($(this).prop("checked") == false && this.value == listaCardsDefault[i])
                              {
                                $(this).prop("checked", true);
                                habilitarColuna(this.id);

                                    // Habilita todos os cards/rotinas
                                    if ($(this).prop("disabled") == true)
                                    {
                                      $(this).prop("disabled", false);
                                    }

                                  }

                                  i++;
                                }); 

                            $("#table_rotina_alunos #alunosRotina select").each(function(){

                                //alert(this.id + " = " + listaColunasDefault[j])
                                if (listaColunasDefault[j] == this.id)
                                {
                                  $("#table_rotina_alunos #alunosRotina #" + this.id +" select").each(function(){                            
                                    value_option = listaAlternativasDefault[j];

                                    $(this).prop("selectedIndex", value_option);

                                    altera_cor_dinamicamente_obj(this);
                                  });
                                }

                                if (j == qtdColunas) 
                                {
                                  j = 0;
                                }
                                else
                                {
                                  j++
                                }

                              });

                            $("input:button[name=btnAddOcorrencia]:disabled").each(function() {

                              $(this).prop("disabled", false);
                              altera_cor_btn_ocorrencia($(this));

                            });
                          } 
                        });
                  }
                }

              }
            ///////////////////////////////////////////////////////

            function acionaOcorrencia(id_linha, ativar, position)
            {
              $("#alunosRotina input:button[name=btnAddOcorrencia]").each(function(){

                if(this.id == id_linha && ativar == true)
                {
                  var id_modal = $(this).parent().prop("id");

                  $("#"+id_linha+" input:button[name=btnAddOcorrencia]").trigger('click');
                  $(id_modal+" #lblOcorrencia").text("O que aconteceu?");

                  var id_coluna = $(position).prop("id");

                  numerarTextAreaOcorrencia(id_modal, id_coluna);

                }
                else if(this.id == id_linha && ativar == false)
                {
                  $(id_modal+" #lblOcorrencia").text("Nova ocorrência");   
                }

              });

            }

            function numerarTextAreaOcorrencia(id_modal, id_coluna)
            { 
              var wrapper = $(id_modal+" textarea");

              var txt_coluna = $("#cardsRotina #"+id_coluna).text();
              var txt_existente = wrapper.prop("value");

              var rotina = txt_existente + txt_coluna + ":  \n";

              wrapper.prop("value", rotina);
            }

            function limparTextAreaOcorrencia(btn)
            {

              swal({
                title: "A ocorrência não será salva. Tem certeza que deseja cancelar?",
                icon: "warning",
                buttons: [
                'Não',
                'Sim'
                ],
                dangerMode: true,
              }).then(function(isConfirm) { 
                if (isConfirm) {

                  var id_modal = $(btn).parent().parent().prop("id");
                  var text_area = $("#"+id_modal+" textarea");

                  text_area.prop("value", "");

                  $("#closeModal").trigger("click");

                } 
              });

              
              
              
            }

            function altera_cor_dinamicamente()
            {    
              var id_linha = null;

              $("select[name=selectAltCard]").on("change", function(){

                if ($(this).prop("selectedIndex") == 1)
                {
                  $(this).css("background-color", "#20bf6b");
                  
                  id_linha = $(this).parent().parent().attr("name");

                  acionaOcorrencia(id_linha, false, this);

                }
                else if ($(this).prop("selectedIndex") == 2)
                {
                  $(this).css("background-color", "#f7b731");

                  id_linha = $(this).parent().parent().attr("name");

                  acionaOcorrencia(id_linha, true, this); 
                }
                else if ($(this).prop("selectedIndex") == 3)
                {
                  $(this).css("background-color", "#eb3b5a");

                  id_linha = $(this).parent().parent().attr("name");

                  acionaOcorrencia(id_linha, true, this); 
                }

              });
            }

            function altera_cor_dinamicamente_obj(obj_select)
            {        
              if ($(obj_select).prop("selectedIndex") == 1)
              {
                $(obj_select).css("background-color", "#20bf6b");
              }
              else if ($(obj_select).prop("selectedIndex") == 2)
              {
                $(obj_select).css("background-color", "#f7b731");
              }
              else if ($(obj_select).prop("selectedIndex") == 3)
              {
                $(obj_select).css("background-color", "#eb3b5a");
              }

            }

            function retorna_cor_padrao_select(obj_select)
            {
              if ($(obj_select).prop("selectedIndex") == 0)
              {
                $(obj_select).css("background-color", "");
              }
            }

            function altera_cor_btn_ocorrencia(btn_ocorrencia)
            {
              if (btn_ocorrencia.prop("disabled"))
              {
                btn_ocorrencia.css("background-color", "#e6e6e6");
              }
              else
              {
                btn_ocorrencia.css("background-color", "#fcb736");
              }
            }
            ///////////////////////////////////////////////////////

            function pesquisaTabela() 
            {
              var filter, table, tr, td, i;

              table = document.getElementById("table_rotina_alunos");

              return function() {
                tr = table.querySelectorAll("tbody tr");
                filter = this.value.toUpperCase();

                for (i = 0; i < tr.length; i++) 
                {
                  var match = tr[i].innerHTML.toUpperCase().indexOf(filter) > -1;
                  tr[i].style.display = match ? "block" : "none";
                }
              }

            }

            ///////////////////////////////////////////////////////
            // Validações requeridas
            function validaFormularioRotina() {

              var countAlunos = 0;
              var countResps = 0; 
              var countInputsEmpyt = 0;   
              var validaTime = false;
              var msg_list = new Array();
              msg_list[1] = "error";

              $('#alunosRotina input:checkbox').each(function(){

                if ($(this).prop("checked") == true)
                {
                  $("#alunosRotina select").each(function() {

                    if ($(this).prop("selectedIndex") > 0)
                    {
                      countResps++;
                    }

                  });

                  countAlunos++;
                }

              });    

              var rec_id_agenda = null;  
              var aux = null;

              $("input:checkbox[name=ckbAluno]:checked").each(function(){ 
                id_agenda_checked = $(this).val();

                $("#ocorrenciaAgenda" + id_agenda).each(function(){

                  aux = this.id;
                  rec_id_agenda = parseInt(aux.replace(/[^0-9]/g,''));
                      //alert("ID Agenda REC = " + rec_id_agenda + " - ID Agenda Checked = " + id_agenda_checked);
                      if (($(this).prop("value") == "" && rec_id_agenda == id_agenda_checked) || ($(this).prop("value") == null && rec_id_agenda == id_agenda_checked))
                      {
                        countInputsEmpyt++;
                      }
                      else
                      {
                        countInputsEmpyt = false
                      }

                    });

              });

                //alert("Alunos = " + countAlunos + " - Respostas: " + countResps + " - A ocorrência está vazia? = " + countInputsEmpyt);

                // Se tiver alunos selecionados, respostas selecionadas, e ocorrências preenchidas ou não
                if ((countAlunos > 0 && countResps > 0 && countInputsEmpyt == false) || (countAlunos > 0 && countResps > 0 && countInputsEmpyt > 0))
                {
                  msg_list[0] = "ok";
                  msg_list[1] = "new_rotina";
                }
                // Se tiver alunos selecionados, nenhuma resposta selecionada e ocorrências preenchidas
                else if (countAlunos > 0 && countResps == 0 && countInputsEmpyt == false)
                {
                  msg_list[0] = "ok";
                  msg_list[1] = "add_ocorrencia";
                }
                else if (countAlunos == 0)
                {
                  msg_list[0] = "Marque ao menos um aluno para qual deseja enviar a rotina.";
                  msg_list[1] = "error";
                }
                else if ((countAlunos > 0 && countResps == 0) || (countAlunos > 0 && countInputsEmpyt > 0))
                {
                  msg_list[0] = "Selecione uma resposta ou descreva uma ocorrência para este aluno antes de enviar a rotina.";
                  msg_list[1] = "error";
                }

                return msg_list;

              }

            // Voltar
            function voltarPageAnterior(codUsuario)
            {
              $.ajax({ 
                asyn: false,
                url: "viewTurmasProfessor.php",
                dataType: "html",
                type: "POST",
                data: { id: codUsuario},
                success: function(data){
                  $('#painelAbas').html(data);
                },
              });
            }      

            // Carrega Pages
            function carregaNovaRotina(idUsuario, codTurma)
            {   
              $.ajax({
                asyn: false,
                url: "viewEnviarRotinaAlunos.php",
                dataType: "html",
                type: "POST",
                data: { 
                  id: idUsuario,
                  codigoturma: codTurma
                },
                success: function(data)
                {
                  $('#painelAbas').html(data);
                }
              });

            }

            function carregaRotinasEnviadas(idUsuario, codTurma)
            {   
              $.ajax({
                asyn: false,
                url: "viewVisualizarRotinasEnviadas.php",
                dataType: "html",
                type: "POST",
                data: { 
                  id: idUsuario,
                  codigoturma: codTurma
                },
                success: function(data)
                {
                  $('#conteudoPageRotina').html(data);
                }
              });

            }
            function carregaRotinasRecentes(idUsuario, codTurma)
            {   
              $.ajax({
                asyn: false,
                url: "viewVisualizarRotinasRecentes.php",
                dataType: "html",
                type: "POST",
                data: { 
                  id: idUsuario,
                  codigoturma: codTurma
                },
                success: function(data)
                {
                  $('#conteudoPageRotina').html(data);
                }
              });

            }
            

/*
        $(document).ready(function() {

            altera_cor_dinamicamente();


              var max_fields = 2; //maximum input boxes allowed
              var wrapper = $(".input_fields_wrap"); //Fields wrapper
              var add_button = $(".add_field_button"); //Add button ID

              var x = 0; //initlal text box count
              var aluno_checked = 0;
              $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                                        
                    if (x <= max_fields) //max input box allowed
                    {
                        if (confirm("Deseja adicionar uma nova ocorrência?"))
                        {
                            $('#alunosRotina input:checkbox').each(function(){
                                
                                if ($(this).prop("checked"))
                                {
                                    aluno_checked++;
                                }

                            });

                            if (aluno_checked > 0)
                            {
                                if ($("#input_fields_wrap_ocorrencias").prop("value") == "")
                                { 
                                    alert("Termine de descrever/citar a " + x + "° ocorrência antes.");
                                }
                                else if (x >= 0)
                                {
                                    x++; //text box increment
                                    $(wrapper).append("<div><input class='inputOcorrencia' id='input_fields_wrap_ocorrencias' type='text' name='ocorrencias[]' minlenght='10' /><a href='#' class='remove_field'>Remover</a></div>"); //add input box
                                }
                            }
                            else
                            {
                                alert("Selecione ao menos um aluno para qual deseja adicionar uma ocorrência.");
                            }
                        }
                    }
                    else
                    {
                        alert("A quantidade de ocorrências para esta rotina atingiu o limite (3).");
                    }

              });

              $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
              })

            });


            */


          </script>        

          <style type="text/css">
          body{
            font-family: 'Calibri', sans-serif;
          }
          /* código do moldal */

          /* código do moldal */

          .modalDialog {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(255, 255, 255,.0);
            opacity:0;/* se remover esse campo a caixa de ocorrencia vai ficar visivel */
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            pointer-events: none;
          }
          .modalDialog:target {

            position: fixed;
            background-color: rgba(0, 0, 0, 0.6);
            opacity: 10;
            pointer-events: auto;
            left: 50%;
            top: -65%;
            transform: translate(-50%,-50%);
            width: 500%;
            height: 500%;
            z-index: 9999;

          }
          /* fecha o código do moldal */

          /* div caixa ocorrencia */

          .caixaOcorrencia {
            position: absolute;
            width: 490px;
            height: 295px;
            left: 50%;
            top: 40%;
            z-index: 1;
            background-color: #fff;
            border: 1px solid rgb(190, 190, 190);
            box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px;
            transform: translate(-50%, -50%);
            z-index: 9998;

          }
          /* fecha o codigo da caixa ocorrencia */

          .caixaLabelocorrencia{
            position: relative;
            width: 490px;
            height: 49px;
            border-bottom-style: solid;
            border-bottom-color: #d9d9d9;
            border-bottom-width: 1px;
            //background-color: blueviolet;
          }
          .lblOcorrencia{
            position: relative;
            top: 12px;
            margin-left: -315px;
            font-size: 15pt;
            color: #333333;
          }
          .lblParaRotina {
            position: relative;
            top: 12px;
            font-size: 15pt;
            color: #333333;
            width: 100%;
          }

          /* classe do textarea */

          .taOcorrencia{
            position: relative;
            display: block;
            resize: none;
            width: 450px;
            height: 150px;
            top: 6%;
            left: 15px;
            font-size: 13pt;
            font-family: 'Calibri',sans-serif;
            color: #4d4d4d;
            padding-left: 10px;
            padding-top: 5px;
            border: 1.5px solid #ddd;
          }

          /* fecha código da textarea */

          /* link que fecha o moldal */

          .btnFechaMoldalOcorrencia {
            background-color: #fff;
            color: #606061;
            position: absolute;
            text-align: center;
            top: 3px;
            width: 24px;
            height: 23px;
            border-radius: 3px;
            line-height: 19px;/* pode ser usado no lugar de padding-top*/
            border:1px solid #d9d9d9;
            text-decoration: none;
            left: 440px; 
            //background-color: aqua;
            font-size: 16pt;
            transition: all .4s;
          }
          .btnFechaMoldalOcorrencia:after {
            background-color: #fff;
            color: #606061;
            position: absolute;
            text-align: center;
            top: 5px;
            width: 24px;
            height: 23px;
            border-radius: 3px;
            line-height: 19px;/* pode ser usado no lugar de padding-top*/
            border:1px solid #d9d9d9;
            margin-left: 370px;
            text-decoration: none;
            //background-color: aqua;
            font-size: 16pt;
            transition: all .4s;
          }
          .btnFechaMoldalOcorrencia:hover{
            border:1px solid #e74c3c;
            background-color: #e74c3c;
            color: #fff;
          }

          /* fecha o código do link de fechar */
        </style>

        <script>

          $('.checkbox-regularC').click(function(){
           var opts = function(i){
            return {
             'background-color': i ? 'transparent' : '#ccc',
             'cursor': i ? 'auto' : 'not-allowed'
           };
         }

         $('.linhaCdSRotinaTurma')
         .css(opts($(this).is(":checked")));
       });
     </script>




     <script>

      $('.btnTodasAsRotinasEnviadas').click(function(){
       if($('.btnTodasAsRotinasEnviadas').css('background-color')=='transparent'){
        $('.btnTodasAsRotinasEnviadas').css('background-color','#ffffff');
        $('.btnRecentesRotinasEnviadas').css('background-color','transparent');
        $('.btnNovaRotinaAlunos').css('background-color','transparent');
      }else{
       $('.btnTodasAsRotinasEnviadas').css('background-color','#ffffff');
       $('.btnRecentesRotinasEnviadas').css('background-color','transparent');  
       $('.btnNovaRotinaAlunos').css('background-color','transparent');  
     }
   })

      $('.btnRecentesRotinasEnviadas').click(function(){
       if($('.btnRecentesRotinasEnviadas').css('background-color')=='#ffffff'){
        $('.btnRecentesRotinasEnviadas').css('background-color','transparent');
        $('.btnNovaRotinaAlunos').css('background-color','transparent');
        $('.btnTodasAsRotinasEnviadas').css('background-color','#ffffff');
      }else{
       $('.btnRecentesRotinasEnviadas').css('background-color','#ffffff');
       $('.btnTodasAsRotinasEnviadas').css('background-color','transparent');  
       $('.btnNovaRotinaAlunos').css('background-color','transparent');  
     }
   })

      $('.btnNovaRotinaAlunos').click(function(){
       if($('.btnNovaRotinaAlunos').css('background-color')=='#ffffff'){
        $('.btnNovaRotinaAlunos').css('background-color','transparent');
        $('.btnRecentesRotinasEnviadas').css('background-color','transparent');
        $('.btnTodasAsRotinasEnviadas').css('background-color','#ffffff');
      }else{
       $('.btnNovaRotinaAlunos').css('background-color','#ffffff');
       $('.btnTodasAsRotinasEnviadas').css('background-color','transparent');  
       $('.btnRecentesRotinasEnviadas').css('background-color','transparent');  
     }
   })


/*$('.Desativado .btnTodasAsRotinasEnviadas').click(function(){
       if($('.Desativado .btnTodasAsRotinasEnviadas').css('background-color')=='#1d1f21'){
          $('.Desativado .btnRecentesRotinasEnviadas').css('background-color','transparent');
          $('.Desativado .btnTodasAsRotinasEnviadas').css('background-color','transparent');
         $('.Desativado .btnTodasAsRotinasEnviadas').css('background-color','#1d1f21');
    }else{
         $('.Desativado .btnRecentesRotinasEnviadas').css('background-color','#1d1f21');
         $('.Desativado .btnTodasAsRotinasEnviadas').css('background-color','transparent');  
         $('.Desativado .btnNovaRotinaAlunos').css('background-color','transparent');  
    }
})

/* $('.btnTodasAsRotinasEnviadas').click(function(){
       if($('.btnTodasAsRotinasEnviadas').css('background-color')=='#232323'){
          $('.btnTodasAsRotinasEnviadas').css('background-color','#1d1f21');
         $('.btnRecentesRotinasEnviadas').css('background-color','#1d1f21');
         $('.btnNovaRotinaAlunos').css('background-color','#232323');
    }else{
         $('.btnTodasAsRotinasEnviadas').css('background-color','#1d1f21');
         $('.btnRecentesRotinasEnviadas').css('background-color','#232323');  
         $('.btnNovaRotinaAlunos').css('background-color','#232323');  
    }
  })  */

</script>
