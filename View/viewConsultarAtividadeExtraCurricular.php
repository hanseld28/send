<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">

<?php

include_once("../Controller/ControllerAtividadeExtraCurricular.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
$controlleratividade = new ControllerAtividadeExtraCurricular();
    // Recebe o retorno do método consultarPeriodo
$listaatividade = $controlleratividade->consultarAtividadeExtraCurricular();

        //PAGINAÇÃO//
$db = Conexao::conexao();
$i = 1;
$listaratividade_pg=$db->prepare("SELECT codAtividadeExtraCurricular, descAtividadeExtraCurricular FROM tbatividadeextracurricular");
$listaratividade_pg->execute();

$count = $listaratividade_pg->rowCount();
$calculo = ceil(($count/16));

Conexao::desconexao();
       //PAGINAÇÃO//
?>

<div class="barraPesquisaCadAux">
 <form autocomplete="off">
  
  <input type="text" class="barraPesquisa" placeholder="Pesquisar..."name="txAtividade" id="txAtividade">
  
  <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
</form> 
</div>



<a  href="#" id="abacadastroatividade" name="abacadastroatividade" onclick="abacadastroatividade('pageCadastroAtividadeExtraCurricular.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png"alt=""></div></a>

<a href='../Reports/reportsAtividadeExtraCurricular.php?key_rpt_atividade=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>


<h3 class="tituloConsultaCadAux">Atividade Extra Curricular</h3>
<div class="div-itens-consulta">
  <div id="div-resultAtividade">

    <table >
      <table class="bordasimples" cellspacing="0">

        <thead>
          <tr>
            <!--<td>Código</td>-->
            <td class="tituloTabelaCadAux">Descrição</td>
            <td class="tituloAcoesTabelaCadAux">Ações</td>

          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($listaatividade as $obj) {
            echo("<tr>");

        /*echo("<td>");
        echo ($obj->getId());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getDescricao());
        echo("</td>");
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editaratividade(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluiratividade(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        
        echo("<a href='../Reports/reportsAtividadeExtraCurricular.php?key_rpt_atividade=especific&id_atividade={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");
      }


      echo("</tbody>");
      echo("</table>"); 
      echo "</div>";
      echo("<ul class='paginacaoCadAux'>");

      if(empty($_GET['pgatividade'])){} else { $pagina = $_GET['pgatividade'];}
      if(isset($pagina)){ $pagina = $_GET['pgatividade'];}else{$pagina =1;}

      $voltar = $pagina - 1;
      $seguir = $pagina + 1;
      $valorAtual = $pagina;

      if( $pagina !=  1){
       echo "<li>"; 
       echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$voltar')"."><</a>";
       echo "</li>";
     }else{}

         // $pg =  $_POST["pageAluno"];
     while ($i <= $calculo) {
      $estilo= "";
      if($pagina == $i){
       $estilo = "div style='position: relative;
       display: block;
       width: 35px;
       height: 35px;
       font-size: 20px;
       text-align: center;
       line-height: 35px;
       background-color: rgba(9, 132, 227, 1.0);
       color: white;
       text-decoration: none;
       border: 1px solid rgba(9, 132, 227, 1.0);";
     }
     ?>

     <li <?php echo $estilo;?>>
      <?php
      echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$i')".">$i</a>";
      $i++;
      if($i > 10){
        echo "<li>"; 
        echo "<a>...</a>";
        echo "</li>"; 

        if(@$pagina > 11){
          echo "<li>"; 
          echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$valorAtual')".">$valorAtual</a>";
          echo "</li>"; 
        }else{
          echo "<li>"; 
          echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=11')".">11</a>";
          echo "</li>"; 
        }
        if (@$pagina <  ($calculo +5)) {
          echo "<li>"; 
          echo "<a href='#' id='pgatividade' name='pgatividade' onclick="."pgatividade('viewConsultarAtividadeExtraCurricular.php?pageAtividade=$seguir')".">$seguir</a>";
          echo "</li>"; 
        }
        break;
      }    

    }
    echo("</ul>");

    echo("</div>");
    echo("</div>");
    ?>
    <script type="text/javascript" language="javascript">

      function abacadastroatividade(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);

              };

                //Paginação
                function pgatividade(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };
                //Paginação        

                function excluiratividade(id){

                 swal({
                  title: "Deseja Excluir?",
                  icon: "warning",
                  buttons: [
                  'Cancelar',
                  'Excluir'
                  ],
                  dangerMode: true,
                }).then(function(isConfirm) { 
                  if (isConfirm) {
                   $.ajax({ 
                    asyn: false,
                    url: "viewExcluirAtividadeExtraCurricular.php",
                    dataType: "html",
                    type: "POST",
                    data: { id: id},
                    success: function(data){
                      $('#painelCadAuxliar').html(data);
                    },
                  });
                 } 
                
              });
              }
              
              
              

              function editaratividade(id){
                $.ajax({

                  asyn: false,
                  url: "edicaoAtividadeExtraCurricular.php",
                  datatype: "html",
                  type:"POST",
                  data: {id: id},
                  success: function(data){
                    $('#painelCadAuxliar').html(data);
                  },
                });
              }


            </script>

            <script type="text/javascript">
              /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
              $('#txAtividade').keyup(function(event){        
                $('form').submit(function(){
                  var dados = $(this).serialize();

                  $.ajax({
                    url:'../Pesquisa/processaAtividadeExtraCurricular.php',
                    type: 'POST',
                    dataType: 'html',
                    data: dados,
                    success:function(data){
                      $('#div-resultAtividade').empty().html(data);
                    }         
                  });
                  return false;
                });

                $('form').trigger('submit');      
              });   
              /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
            </script>