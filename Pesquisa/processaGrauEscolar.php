<?php  
include_once("../DAO/Conexao.php");
$nomeGrauEscolar = "%".$_POST['txGrauEscolar']."%";
?>  


<div class="div-result">
  <?php 
  
  // Abre a conexão com o banco de dados
  $pdo = Conexao::conexao();
    // Prepara a consulta de pesquisa 


 //PAGINAÇÃO
  $i = 1;
  $listarGrauEscolar_pg=$pdo->prepare("SELECT codGrauEscolar, descGrauEscolar FROM tbgrauescolar");
  $listarGrauEscolar_pg->execute();

  $count = $listarGrauEscolar_pg->rowCount();
  $calculo = ceil(($count/5));

  while ($i <= $calculo) {
    $i++;
  }

  $_POST['calculoGrauEscolar'] = $calculo;

  $url = 0;
  $mody =0;
  if (isset($_GET['pageGrauEscolar']) == $i) {
    $url= $_GET['pageGrauEscolar'];
    $mody = ($url*5)-5;
  }
      //PAGINAÇÃO

  $cmd = $pdo->prepare("SELECT codGrauEscolar, descGrauEscolar FROM tbgrauescolar where descGrauEscolar like :nomeGrauEscolar LIMIT 5 OFFSET {$mody}");

    // Substitui os parâmetros/pseudônomes pelo valor da variável 
  $cmd->bindParam(":nomeGrauEscolar", $nomeGrauEscolar, PDO::PARAM_STR); 
      // Executa a consulta
  $cmd->execute();     
      // Fecha a conexão com o banco de dados  
  Conexao::desconexao();


  echo("<table class='bordasimples' cellspacing='0'>");
  echo("<thead>");
  echo ("<tr>");
  echo("<td class='tituloTabelaCadAux'>Descrição</td>");
  echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
  echo ("</tr>");
  echo ("</thead>");
  echo (" <tbody>");

  while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) { 	
   echo("<tr>");

       /*echo("<td>");
       echo ($obj->getId()); 
       echo("</td>");*/

       echo("<td class='linhaTabelaCadAux'>");

       echo($reg["descGrauEscolar"]);

       echo("</td>"); 

       echo("<td class='tdAcoes'>");

       echo("<div class='iconTabela'>");

       echo("<a href='#' name='editargrau' value='' id='editargrau' onclick='editargrau(".$reg['codGrauEscolar'].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
       echo(" ");
       echo("<a href='#' name='excluirgrau' value='' id='escluirgrau' onclick='excluirgrau(".$reg['codGrauEscolar'].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
       
       echo("<a href='../Reports/reportsGrauEscolar.php?key_rpt_grau_esc=especific&id_grau_esc={$reg['codGrauEscolar']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");

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






