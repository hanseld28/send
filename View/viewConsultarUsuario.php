<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php
include_once("../Controller/ControllerUsuario.php");

	// Instancia a classe ControllerUsuario
$controllerUsuario = new ControllerUsuario();
    // Recebe o retorno do método listarTipoUsuario
$listaUsuarios = $controllerUsuario->consultarUsuario();


      //PAGINAÇÃO//
$db = Conexao::conexao();
$i = 1;
$listaruser_pg=$db->prepare("SELECT codUsuario, codUsuario, codUsuario, codTipoUsuario FROM tbusuario");
$listaruser_pg->execute();

$count = $listaruser_pg->rowCount();
$calculo = ceil(($count/8));

Conexao::desconexao();
       //PAGINAÇÃO//

?>

<div class="cimaPesquisa">
 <div class="barraPesquisaGeral">
  <label>Usuário</label>
  <form autocomplete="off">
    <input type="text" placeholder="Pesquisar..." id="txUser" name="txUser" class="barraPesquisa">
    <div class="barraPesquisaBotao"> <img src="../Imagens/magnifying-glasslll.png" alt=""></div>
  </form>
</div>
</div>
<a href='../Reports/reportsUsuario.php?key_rpt_user=all' target="_blank"><div class="abrirAbaCadastro"><img src="../Imagens/printer.png" alt=""></div></a>

<div id="div-resultUser">
 <div class="div-itens-consulta">
  <table class="bordasimples2" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux">Nome</td>
        <td class="tituloTabelaCadAux">Login</td>
        <td class="tituloTabelaCadAux">Tipo de Usuário</td>
        <td class="tituloAcoesTabelaCadAux">Ações</td>

      </tr>
    </thead>
    <tbody>

      <?php

      foreach ($listaUsuarios as $obj) {

        echo("<tr>");

        /*echo("<td>");
        echo ($obj->getId());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getNome());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getLogin());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->tipoUsuario->getDescricao());
        echo("</td>");
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirusuario(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        
        echo "<a href='../Reports/reportsUsuario.php?key_rpt_user=especific&id_user={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>";
        
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");

      }
      ?>

    </tbody>
  </table>

  <?php   
        //Paginação
  echo("<ul class='paginacaoCadAux'>");
  if(empty($_GET['pageUser'])){} else { $pagina = $_GET['pageUser'];}
  if(isset($pagina)){ $pagina = $_GET['pageUser'];}else{$pagina =1;}

  $voltar = $pagina - 1;
  $seguir = $pagina + 1;
  $valorAtual = $pagina;

  if( $pagina !=  1){
   echo "<li>"; 
   echo "<a  href='#' id='pguser' name='pguser' onclick="."pguser('viewConsultarUsuario.php?pageUser=$voltar')"."><</a>";
   echo "</li>";
 }else{}

         // $pg =  $_POST["pageUser"];
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
   border-radius: 0px;
   border: 1px solid rgba(9, 132, 227, 1.0);";
 }
 ?>
 <li <?php echo $estilo;?>>
   <?php                 

   echo "<a  href='#' id='pguser' name='pguser' onclick="."pguser('viewConsultarUsuario.php?pageUser=$i')".">$i</a>";
   echo("</li>");

   $i++;
   if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a  href='#' id='pguser' name='pguser' onclick="."pguser('viewConsultarUsuario.php?pageUser=$valorAtual')".">$valorAtual </a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a  href='#' id='pguser' name='pguser' onclick="."pguser('viewConsultarUsuario.php?pageUser=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a  href='#' id='pguser' name='pguser' onclick="."pguser('viewConsultarUsuario.php?pageUser=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  } 
}
echo("<ul>");
    //Paginação
?>

</div>
</div>


<script type="text/javascript" language="javascript">
  function abacadastrousuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);                    
              };

            //Paginação  
            function pguser(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
            //Paginação 
            
            function excluirusuario(id){
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
                url: "viewExcluirUsuario.php",
                dataType: "html",
                type: "POST",
                data: { id: id},
                success: function(data){
                  $('#painelAbas').html(data);
                },
              });
             } 
          });
          }

          function editarusuario(id){
            $.ajax({

              asyn: false,
              url: "edicaoUser.php",
              datatype: "html",
              type:"POST",
              data: {id: id},
              success: function(data){
                $('#painelAbas').html(data);
              },
            });
          }


        </script>
        