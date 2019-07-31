<?php  
include_once("../DAO/Conexao.php");
$nomeCard = "%".$_POST['txCard']."%";
?>  


<div class="div-result">
  <?php 
  
  // Abre a conexão com o banco de dados
  $pdo = Conexao::conexao();
    // Prepara a consulta de pesquisa 


 //PAGINAÇÃO
  $i = 1;
  $listarGrauEscolar_pg=$pdo->prepare("SELECT codCard, descCard FROM tbcard");
  $listarGrauEscolar_pg->execute();

  $count = $listarGrauEscolar_pg->rowCount();
  $calculo = ceil(($count/5));

  while ($i <= $calculo) {
    $i++;
  }

  $_POST['calculoCard'] = $calculo;

  $url = 0;
  $mody =0;
  if (isset($_GET['pageCard']) == $i) {
    $url= $_GET['pageCard'];
    $mody = ($url*5)-5;
  }
      //PAGINAÇÃO

  $cmd = $pdo->prepare("SELECT codCard, descCard FROM tbcard where descCard LIKE :nomeCard  LIMIT 5 OFFSET {$mody}");

    // Substitui os parâmetros/pseudônomes pelo valor da variável 
  $cmd->bindParam(":nomeCard", $nomeCard, PDO::PARAM_STR); 
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

                 echo("<td class='linhaTabelaCadAux'>");
                        echo($reg['descCard']);
                        echo("</td>");
                        echo("<td class='tdAcoes'>");
                        echo("<div class='iconTabela'>");
                        echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$reg['codCard'].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
                        echo(" ");
                        //echo("<a href='editaExcluiCargo.php?acao=excluir&codcargo=".$obj->getCodigo()."'>Excluir</a>");
                        echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$reg['codCard'].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
                        
                        echo("<a href='../Reports/reportsCargo.php?key_rpt_cargo=especific&id_cargo={$reg['codCard']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
                        
                        //echo("<a href='#' id='".$obj->getCodigo()."' class='deleta'>Excluir</a>");
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

   echo("<ul class='paginacaoCadAux'>");
   if(empty($_GET['pageCard'])){} else { $pagina = $_GET['pageCard'];}
   if(isset($pagina)){ $pagina = $_GET['pageCard'];}else{$pagina =1;}

   $voltar = $pagina - 1;
   $seguir = $pagina + 1;
   $valorAtual = $pagina;

   if( $pagina !=  1){
     echo "<li>"; 
     echo "<a href='#' id='pgCard' 
     name='pgCard' onclick="."pgCard('viewConsultarCard.php?pageCard=$voltar')"."><</a>";
     echo "</li>";
   }else{}

         // $pg =  $_POST["pageCard"];
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
    echo "<a href='#' id='pgCard' 
    name='pgCard' onclick="."pgCard('viewConsultarCard.php?pageCard={$i}')".">$i</a>";
    echo "</li>";
    $i++;
    if($i > 10){
      echo "<li>"; 
      echo "<a>...</a>";
      echo "</li>"; 

      if(@$pagina > 11){
        echo "<li>"; 
        echo "<a href='#' id='pgCard' 
        name='pgCard' onclick="."pgCard('viewConsultarCard.php?pageCard=$valorAtual')".">$valorAtual</a>";
        echo "</li>"; 
      }else{
        echo "<li>"; 
        echo "<a href='#' id='pgCard' 
        name='pgCard' onclick="."pgCard('viewConsultarCard.php?pageCard=11')".">11</a>";
        echo "</li>"; 
      }
      if (@$pagina <  ($calculo +5)) {
        echo "<li>"; 
        echo "<a href='#' id='pgCard' 
        name='pgCard' onclick="."pgCard('viewConsultarCard.php?pageCard=$seguir')".">></a>";
        echo "</li>"; 
      }
      break;
    }  
  }
  echo("</ul>");
//Paginação
  ?>



