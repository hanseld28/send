<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php

include_once("../Controller/ControllerCaracteristicaSaude.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
$controller = new ControllerCaracteristicaSaude();
    // Recebe o retorno do método consultarPeriodo
$lista = $controller->consultarCaracteristicaSaude();

      //PAGINAÇÃO//
$db = Conexao::conexao();
$i = 1;
$listarcaracteristica_pg=$db->prepare("SELECT codCaracteristicaSaude, descCaracteristicaSaude FROM tbcaracteristicasaude");
$listarcaracteristica_pg->execute();

$count = $listarcaracteristica_pg->rowCount();
$calculo = ceil(($count/100)*10);

Conexao::desconexao();     
       //PAGINAÇÃO//

?>

<div class="barraPesquisaCadAux">
 <form>
   <input type="text" name="txCaracteristicas" placeholder="Pesquisar..." class="barraPesquisa" id="txCaracteristicas">
   <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
 </form> 
</div>

<a  href="#" id="abacadastrocaracteristica" name="abacadastrocaracteristica" onclick="abacadastrocaracteristica('pageCadastroCaracteristicaSaude.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png"alt=""></div></a>

<a href='../Reports/reportsCaracteristicaSaude.php?key_rpt_caracteristica=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>
<h3 class="tituloConsultaCadAux">Características de Saúde</h3>
<div id="div-result">

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

      foreach ($lista as $obj) {
        echo("<tr>");

        /*echo("<td>");
        echo ($obj->getId());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getDescricao());
        echo("</td>");
        
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarcaracteristica(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluircaracteristica(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        
        echo("<a href='../Reports/reportsCaracteristicaSaude.php?key_rpt_caracteristica=especific&id_caracteristica={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
        
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");
      }

      ?>

    </tbody>
  </table>
</div>
<?php
echo "<ul class='paginacaoCadAux'>"; 
if(empty($_GET['pageCaracteristicaSaude'])){} else { $pagina = $_GET['pageCaracteristicaSaude'];}
if(isset($pagina)){ $pagina = $_GET['pageCaracteristicaSaude'];}else{$pagina =1;}

$voltar = $pagina - 1;
$seguir = $pagina + 1;
$valorAtual = $pagina;

if( $pagina !=  1){
 echo "<li>"; 
 echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$voltar')"."><</a>";
 echo "</li>";
}else{}

         // $pg =  $_POST["pageCaracteristicaSaude"];
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
   text-decoration: none
   border: 1px solid rgba(9, 132, 227, 1.0);";
 }
 ?>
 <li <?php echo $estilo;?>>
  <?php

  echo "<a  href='#' id='pgcaracteristica' name='pgcaracteristica' onclick="."pgcaracteristica('viewConsultarCaracteristicaSuade.php?pageCaracteristica=$i')".">$i</a>";
  echo "</li>";
  $i++;
  if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$valorAtual')".">$valorAtual </a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a href='#' id='pgcaracteristicasaude' name='pgcaracteristicasaude' onclick="."pgcaracteristicasaude('viewConsultarCaracteristicaSaude.php?pageCaracteristicaSaude=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }
  echo "</ul>"; 
}
 //Paginação
?>

<script type="text/javascript" language="javascript">
                //Paginação
                function pgcaracteristica(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
                //Paginação


                function abacadastrocaracteristica(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);

              };


              function excluircaracteristica(id){

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
                      url: "viewExcluirCaracteristicaSaude.php",
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

              

              function editarcaracteristica(id){
                $.ajax({

                  asyn: false,
                  url: "edicaoCaracteristicaSaude.php",
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
              $(document).ready(function(){   
                $('#txCaracteristicas').keyup(function(event){        
                  $('form').submit(function(){
                    var dados = $(this).serialize();

                    $.ajax({
                      url:'../Pesquisa/processaCaracteristicas.php',
                      type: 'POST',
                      dataType: 'html',
                      data: dados,
                      success:function(data){
                        $('#div-result').empty().html(data);
                      }         
                    });
                    return false;
                  });

                  $('form').trigger('submit');      
                }); 
              });
              /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
            </script>



