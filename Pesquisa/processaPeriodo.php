<?php 

include_once("../DAO/Conexao.php");
$nomePeriodo = "%".$_POST['txPeriodo']."%";
?>

<div class="div-result" >
    <div class="div-itens-consulta">
        <?php 

        // Abre a conexão com o banco de dados
        $pdo = Conexao::conexao();
        // Prepara a consulta de pesquisa 


        $pdo = Conexao::conexao();

   //PAGINAÇÃO
        $i = 1;
        $listarPeriodo_pg=$pdo->prepare("SELECT codPeriodo,descPeriodo, horarioPeriodo FROM tbperiodo");
        $listarPeriodo_pg->execute();

        $count = $listarPeriodo_pg->rowCount();
        $calculo = ceil(($count/5));

        while ($i <= $calculo) {
            $i++;
        }

        $_POST['calculoPeriodo'] = $calculo;

        $url = 0;
        $mody =0;
        if (isset($_GET['pagePeriodo']) == $i) {
            $url= $_GET['pagePeriodo'];
            $mody = ($url*5)-5;
        }
         //PAGINAÇÃO

        $cmd = $pdo->prepare("SELECT codPeriodo, descPeriodo, horarioPeriodo FROM tbperiodo where descPeriodo LIKE :nomePeriodo or horarioPeriodo LIKE :nomePeriodo");

        // Substitui os parâmetros/pseudônomes pelo valor da variável 
        $cmd->bindParam(":nomePeriodo", $nomePeriodo, PDO::PARAM_STR); 
        // Executa a consulta
        $cmd->execute();     
        // Fecha a conexão com o banco de dados  
        Conexao::desconexao();


        echo("<table class='bordasimples' cellspacing='0'>");
        echo("<thead>");
        echo("<tr>");
        /*echo("<td>Código</td>");*/
        echo("<td  class='tituloTabelaCadAux'>Periodo</td>");
        echo("<td class='tituloTabelaCadAux'>Horário</td>");
        echo("<td class='tituloAcoesTabelaCadAux'>Ações</td>");
        echo("</tr>");
        echo("</thead>");
        echo("<tbody>");

        while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {				 
            echo("<tr>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($reg["descPeriodo"]);
            echo("</td>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($reg["horarioPeriodo"]);
            echo("</td>");


            echo("<td>");

            echo("<div class='iconTabela'>");

            echo("<a href='#' name='editar' value='' id='editar' onclick='editarperiodo(".$reg['codPeriodo'].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
            echo(" ");
            echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirperiodo(".$reg['codPeriodo'].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
            echo("<a href='../Reports/reportsPeriodo.php?key_rpt_periodo=especific&id_periodo={$reg['codPeriodo']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
            echo("</td>");



            echo("</tr>");
            echo("</div>");
        }
        echo("</tbody>");
        echo("</table>");
        ?>
    </div>	
</div>

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