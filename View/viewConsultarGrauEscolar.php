<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php

include_once("../Controller/ControllerGrauEscolar.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerTipoUsuario
$controllerGrauEscolar = new ControllerGrauEscolar();
    // Recebe o retorno do método listarTipoUsuario
$listaGrausEscolares = $controllerGrauEscolar->consultarGrauEscolar();

?>


<div class="barraPesquisaCadAux">
  <form autocomplete="off">
    <input type="text" class="barraPesquisa" placeholder="Pesquisar..." name="txGrauEscolar" id="txGrauEscolar">

    <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
  </form> 
</div>



<a  href="#" id="abacadastrograu" name="abacadastrograu" onclick="abacadastrograu('pageCadastroGrauEscolar.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png"alt=""></div></a>

<a href='../Reports/reportsGrauEscolar.php?key_rpt_grau_esc=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a> 
<h3 class="tituloConsultaCadAux">Grau Escolar</h3>

<div id='div-resultGrau'>


  <table class="bordasimples" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux">Descrição</td>
        <td class="tituloTabelaCadAux">Período</td>
        <td class="tituloAcoesTabelaCadAux">Ações</td>
      </tr>
    </thead>
    <tbody>

      <?php

      foreach ($listaGrausEscolares as $obj) {
       echo("<tr>");

       /*echo("<td>");
       echo ($obj->getId()); 
       echo("</td>");*/

       echo("<td class='linhaTabelaCadAux'>");

       echo($obj->getDescricao());

       echo("</td>"); 

       echo("<td class='linhaTabela'>");
       
       echo($obj->periodo->getDescricao());
       
       echo("</td>"); 
       
       echo("<td class='tdAcoes'>");

       echo("<div class='iconTabela'>");

       echo("<a href='#' name='editargrau' value='' id='editargrau' onclick='editargrau(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
       echo(" ");
       echo("<a href='#' name='excluirgrau' value='' id='escluirgrau' onclick='excluirgrau(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
       echo("<a href='../Reports/reportsGrauEscolar.php?key_rpt_grau_esc=especific&id_grau_esc={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");

       echo("</td>");

       echo("</tr>");

       echo("</div>");


     }

     ?>
   </tbody>
 </table>
 
 <?php
            //Paginação
 $i = 1;
 $calculo = ($_POST['calculoGrauEscolar']) ? $_POST['calculoGrauEscolar'] : null;

 echo("<ul class='paginacaoCadAux'>");
 if(empty($_GET['pageGrauEscolar'])){} else { $pagina = $_GET['pageGrauEscolar'];}
 if(isset($pagina)){ $pagina = $_GET['pageGrauEscolar'];}else{$pagina =1;}

 $voltar = $pagina - 1;
 $seguir = $pagina + 1;
 $valorAtual = $pagina;

 if( $pagina !=  1){
   echo "<li>"; 
   echo "<a href='#' id='pgGrauEscolar' 
   name='pgGrauEscolar' onclick="."pgGrauEscolar('viewConsultarGrauEscolar.php?pageGrauEscolar=$voltar')"."><</a>";
   echo "</li>";
 }else{}

         // $pg =  $_POST["pageGrauEscolar"];
 while ($i <= $calculo) {
  $estilo= "";
  if($pagina == $i){
   $estilo =  "div style='position: relative;
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
  echo "<a href='#' id='pgGrauEscolar' 
  name='pgGrauEscolar' onclick="."pgGrauEscolar('viewConsultarGrauEscolar.php?pageGrauEscolar={$i}')".">$i</a>";
  echo "</li>";
  $i++;
  if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a href='#' id='pgGrauEscolar' 
      name='pgGrauEscolar' onclick="."pgGrauEscolar('viewConsultarGrauEscolar.php?pageGrauEscolar=$valorAtual')".">$valorAtual</a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a href='#' id='pgGrauEscolar' 
      name='pgGrauEscolar' onclick="."pgGrauEscolar('viewConsultarGrauEscolar.php?pageGrauEscolar=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a href='#' id='pgGrauEscolar' 
      name='pgGrauEscolar' onclick="."pgGrauEscolar('viewConsultarGrauEscolar.php?pageGrauEscolar=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }  
}
echo("</ul>");
//Paginação
?>

<script type="text/javascript" language="javascript">
  function abacadastrograu(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);

              };

//Paginação
function pgGrauEscolar(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };
        //Paginação


        function excluirgrau(id){
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
                url: "viewExcluirGrauEscolar.php",
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
        
        
        

        function editargrau(id){
          $.ajax({

            asyn: false,
            url: "edicaoGrauEscolar.php",
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
        $('#txGrauEscolar').keyup(function(event){        
          $('form').submit(function(){
            var dados = $(this).serialize();

            $.ajax({
              url:'../Pesquisa/processaGrauEscolar.php',
              type: 'POST',
              dataType: 'html',
              data: dados,
              success:function(data){
                $('#div-resultGrau').empty().html(data);
              }         
            });
            return false;
          });

          $('form').trigger('submit');     
        });
      </script>



    </div>

