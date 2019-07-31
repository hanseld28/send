<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php
session_start();
include_once("../DAO/Conexao.php");
include_once("../Controller/ControllerPeriodo.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
$controllerPeriodo = new ControllerPeriodo();
    // Recebe o retorno do método consultarPeriodo
$listaPeriodos = $controllerPeriodo->consultarPeriodo();

$pdo = Conexao::conexao();

   //PAGINAÇÃO
$i = 1;
$listarPeriodo_pg=$pdo->prepare("SELECT codPeriodo,descPeriodo, horarioPeriodo FROM tbperiodo");
$listarPeriodo_pg->execute();

$count = $listarPeriodo_pg->rowCount();
$calculo = ceil(($count/8));

while ($i <= $calculo) {
  $i++;
}

$_POST['calculoPeriodo'] = $calculo;

$url = 0;
$mody =0;
if (isset($_GET['pagePeriodo']) == $i) {
  $url= $_GET['pagePeriodo'];
  $mody = ($url*8)-8;
}
//PAGINAÇÃO
Conexao::desconexao();

?>





<div class="barraPesquisaCadAux">
 <form>
  <input type="text"class="barraPesquisa" placeholder="Pesquisar..." name="txPeriodo" id="txPeriodo">
  
  <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
</form> 
</div>


<a  href="#" id="abacadastroperiodo" name="abacadastroperiodo" onclick="abacadastroperiodo('pageCadastroPeriodo.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>

<a href='../Reports/reportsPeriodo.php?key_rpt_periodo=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>

<h3 class="tituloConsultaCadAux">Período</h3>

<div id='div-resultPeriodo'>  
  <table class="bordasimples" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux">Período</td>
        <td class="tituloTabelaCadAux">Horário</td>
        <td class="tituloAcoesTabelaCadAux">Ações</td>
      </tr>
    </thead>
    <tbody>


      <?php

      foreach ($listaPeriodos as $obj) {
        echo("<tr>");

        /*echo("<td>");
        echo ($obj->getId());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getDescricao());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getHorario());
        echo("</td>");
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarperiodo(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirperiodo(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        echo("<a href='../Reports/reportsPeriodo.php?key_rpt_periodo=especific&id_periodo={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");
      }

      ?>

    </tbody>
  </table>
</div>


<script type="text/javascript" language="javascript">
  function abacadastroperiodo(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };


              function excluirperiodo(id){
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
                  url: "viewExcluirPeriodo.php",
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
            
            

            function editarperiodo(id){
              $.ajax({

                asyn: false,
                url: "edicaoPeriodo.php",
                datatype: "html",
                type:"POST",
                data: {id: id},
                success: function(data){
                  $('#painelCadAuxliar').html(data);
                },
              });
            }


          </script>
          <?php
//Paginação
          $i = 1;
          $calculo = ($_POST['calculoPeriodo']) ? $_POST['calculoPeriodo'] : null;

          echo("<ul class='paginacaoCadAux'>");
          if(empty($_GET['pagePeriodo'])){} else { $pagina = $_GET['pagePeriodo'];}
          if(isset($pagina)){ $pagina = $_GET['pagePeriodo'];}else{$pagina =1;}

          $voltar = $pagina - 1;
          $seguir = $pagina + 1;
          $valorAtual = $pagina;

          if( $pagina !=  1){
           echo "<li>"; 
           echo "<a href='#' id='pgperiodo' name='pgperiodo' onclick="."pgperiodo('viewConsultarPeriodo.php?pagePeriodo=$voltar')"."><</a>";
           echo "</li>";
         }else{}

         // $pg =  $_POST["pagePeriodo"];
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
          echo "<a href='#' id='pgperiodo' name='pgperiodo' onclick="."pgperiodo('viewConsultarPeriodo.php?pagePeriodo={$i}')".">$i</a>";
          echo "</li>"; 
          $i++;
          if($i > 10){
            echo "<li>"; 
            echo "<a>...</a>";
            echo "</li>"; 

            if(@$pagina > 11){
              echo "<li>"; 
              echo "<a href='#' id='pgperiodo' name='pgperiodo' onclick="."pgperiodo('viewConsultarPeriodo.php?pagePeriodo=$valorAtual')".">$valorAtual </a>";
              echo "</li>"; 
            }else{
              echo "<li>"; 
              echo "<a href='#' id='pgperiodo' name='pgperiodo' onclick="."pgperiodo('viewConsultarPeriodo.php?pagePeriodo=11')".">11</a>";
              echo "</li>"; 
            }
            if (@$pagina <  ($calculo +5)) {
              echo "<li>"; 
              echo "<a href='#' id='pgperiodo' name='pgperiodo' onclick="."pgperiodo('viewConsultarPeriodo.php?pagePeriodo=seguir')".">></a>";
              echo "</li>"; 
            }
            break;
          }  

        }
        echo("</ul>");
 //Paginação
        ?>


        <script type="text/javascript">
          /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
          $(document).ready(function(){
            $('#txPeriodo').keyup(function(event){              
              $('form').submit(function(){
                var dados = $(this).serialize();

                $.ajax({
                  url:'../Pesquisa/processaPeriodo.php',
                  type: 'POST',
                  dataType: 'html',
                  data: dados,
                  success:function(data){
                    $('#div-resultPeriodo').empty().html(data);
                  }                   
                });
                return false;
              });

              $('form').trigger('submit');            
            });  

          }); 
          /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/

        </script>





