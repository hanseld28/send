<?php  
	
$nomeMatricula = "%".$_POST['txMatricula']."%";	

include_once("../DAO/Conexao.php");


	   //Paginação
       $db = Conexao::conexao();
       $i = 1;

       $listarmatricula_pg=$db->prepare("SELECT codMatricula, dataMatricula, codAluno, codTurma FROM tbmatricula");
       $listarmatricula_pg->execute();



       $count = $listarmatricula_pg->rowCount();
       $calculo = ceil(($count/8));
      
         $url = 0;
         $mody =0;
         if (isset($_GET['pageMatricula']) == $i) {
         $url= $_GET['pageMatricula'];
         $mody = ($url*8)-8;
     }


         
         Conexao::desconexao();
        //Paginação
?>
<div class="div-itens-consulta">
<div class="div-result">
 <?php 

 	// Abre a conexão com o banco de dados
 	$pdo = Conexao::conexao();
 	// Prepara a consulta de pesquisa 
 	$cmd = $pdo->prepare("SELECT codMatricula, dataMatricula, nomeAluno, nomeTurma FROM tbmatricula 
		INNER JOIN tbAluno on tbmatricula.codAluno = tbAluno.codAluno 
		 INNER JOIN tbturma on tbmatricula.codTurma = tbTurma.codTurma 
		   where nometurma like :nomeMatricula
		    or nomeAluno like :nomeMatricula
		     or dataMatricula like :nomeMatricula LIMIT 18 OFFSET {$mody}");

		// Substitui os parâmetros/pseudônomes pelo valor da variável 
	    $cmd->bindParam(":nomeMatricula", $nomeMatricula, PDO::PARAM_STR); 
	    // Executa a consulta
		$cmd->execute();     
	    // Fecha a conexão com o banco de dados  
	    Conexao::desconexao();


	echo("<table class='bordasimples2' cellspacing='0'>");
	echo("<thead>");
	echo("<tr>");
	/*echo("<td>Código</td>");*/
	echo("<td class='tituloTabelaCadAux'>Data</td>");
	echo("<td class='tituloTabelaCadAux'>Aluno</td>");
	echo("<td class='tituloTabelaCadAux'>Turma</td>");
	echo("<td class='tituloTabelaCadAux'>Período</td>");
	echo("</tr>");
	echo("</thead>");
	echo("<tbody>");

	while($reg = $cmd->fetch(PDO::FETCH_ASSOC)) {				
		echo("<tr>");
        
        echo("<tr>");
        
        /*echo("<td>");
        echo ($reg["codMatricula"]);
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($reg["dataMatricula"]);
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($reg["nomeAluno"]);
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($reg["nomeTurma"]);
        echo("</td>");

        echo("<td class='tdAcoes'>");
        echo("<div class='iconTabela'>");
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarmatricula(".$reg["codMatricula"].")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirmatricula(".$reg["codMatricula"].")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

        echo("<a href='../Reports/reportsMatricula.php?key_rpt_matricula=especific&id_matricula={$reg['codMatricula']}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>  ");
      
        echo("</td>");
        
        echo("</tr>");
        echo("</div>");
	}
	echo("</tbody>");
	echo("</table>");
    
    ?>

</div>
    <?php
    echo("<ul class='paginacaoCadAux'>");

      if(empty($_GET['pageMatricula'])){} else { $pagina = $_GET['pageMatricula'];}
      if(isset($pagina)){ $pagina = $_GET['pageMatricula'];}else{$pagina =1;}

      $voltar = $pagina - 1;
      $seguir = $pagina + 1;
      $valorAtual = $pagina;

      if( $pagina !=  1){
       echo "<li>"; 
       echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$voltar')"."><</a>";
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
       border-radius: 0px;
       border: 1px solid rgba(9, 132, 227, 1.0);";
     }
     ?>
     <li <?php echo $estilo;?>>
       <?php                 
       echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$i')".">$i</a>";
       echo "</li>";

       $i++;
       if($i > 10){
        echo "<li>"; 
        echo "<a>...</a>";
        echo "</li>"; 

        if(@$pagina > 11){
          echo "<li>"; 
          echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$valorAtual')".">$valorAtual</a>";
          echo "</li>"; 
        }else{
          echo "<li>"; 
          echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=11')".">11</a>";
          echo "</li>"; 
        }
        if (@$pagina <  ($calculo +5)) {
          echo "<li>"; 
          echo "<a  href='#' id='pgmatricula' name='pgmatricula' onclick="."pgmatricula('viewConsultarMatricula.php?pageMatricula=$seguir')".">></a>";
          echo "</li>"; 
        }
        break;
      }    
    }

    echo "</ul>";	
?> 	
</div>