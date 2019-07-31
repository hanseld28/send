<?php  

$nome = "%".$_POST['txUser']."%"; 

include_once("../DAO/Conexao.php");

       //Paginação
$db = Conexao::conexao();
$i = 1;
$listaruser_pg=$db->prepare("SELECT codUsuario, nomeUsuario, loginUsuario, codTipoUsuario FROM tbusuario");
$listaruser_pg->execute();

$count = $listaruser_pg->rowCount();
$calculo = ceil(($count/8));


$url = 0;
$mody =0;
if (isset($_GET['pageUser']) == $i) {
 $url= $_GET['pageUser'];
 $mody = ($url*8)-8;
}




Conexao::desconexao();
     //Paginação

?>  


<div class="div-result">
  <?php 
  
  // Abre a conexão com o banco de dados
  $pdo = Conexao::conexao();
    // Prepara a consulta de pesquisa 

  $cmd = $pdo->prepare("SELECT codUsuario, descTipoUsuario, loginUsuario, nomeUsuario FROM tbusuario 
   iNNER JOIN tbtipousuario on tbusuario.codTipoUsuario = tbtipousuario.codTipoUsuario where nomeUsuario like :nome
   or loginUsuario like :nome 
   or descTipoUsuario like :nome LIMIT 8 OFFSET {$mody}");

    // Substitui os parâmetros/pseudônomes pelo valor da variável 
  $cmd->bindParam(":nome", $nome, PDO::PARAM_STR); 
      // Executa a consulta
  $cmd->execute();     
      // Fecha a conexão com o banco de dados  
  Conexao::desconexao();


  echo("<table class='bordasimples3' cellspacing='0'>");
  echo("<thead>");
  echo("<tr>");
  /*echo("<td>Código</td>");*/
  echo("<td class='tituloTabelaCadAux'>Nome</td>");
  echo("<td class='tituloTabelaCadAux'>Login</td>");           
  echo("<td class='tituloTabelaCadAux'>Tipo de Usuário</td>");
  echo("</tr>");
  echo("</thead>");
  echo("<tbody>");


  while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) { 	
   echo("<tr>");

   /*echo("<td>");
   echo ($reg["codUsuario"]);
   echo("</td>");*/

   echo("<td class='linhaTabelaCadAux'>");
   echo($reg["nomeUsuario"]);
   echo("</td>");

   echo("<td class='linhaTabelaCadAux'>");

   echo($reg["loginUsuario"]);
   echo("</td>");

   echo("<td class='linhaTabelaCadAux'>");
   echo($reg["descTipoUsuario"]);
   echo("</td>");

   echo("<td>");
   echo("<div class='iconTabela'>");
   echo("<a href='#' name='editar' value='' id='editar' onclick='editarusuario(".$reg["codUsuario"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
   echo(" ");
   echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirusuario(".$reg["codUsuario"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

   echo "<a href='../Reports/reportsUsuario.php?key_rpt_user=especific&id_user={$reg['codUsuario']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>";



   echo("</td>");


   echo("</tr>");
   echo("</div>");
 }
 echo("</tbody>");
 echo ("</table>");

 ?>

</div>		

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


