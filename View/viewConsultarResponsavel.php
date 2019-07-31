<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php

include_once("../Controller/ResponsavelCRUD.php");
include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
$controllerResponsavel = new ResponsavelCRUD();
    // Recebe o retorno do método consultarPeriodo
$listaResponsavel = $controllerResponsavel->listarResponsavel();


      //Paginação
$db = Conexao::conexao();
$i = 1;
$listarresp_pg=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, codUsuario FROM tbresponsavel");
$listarresp_pg->execute();

$count = $listarresp_pg->rowCount();
$calculo = ceil(($count/3));
Conexao::desconexao();
      //Paginação

?>
<div class="cimaPesquisa">
  <div class="barraPesquisaGeral">
    <label>Responsável</label>
    <br>
    <form autocomplete="off">
      <input type="text" placeholder="Pesquisar..." id="txResp" name="txResp" class="barraPesquisa">
      <div class="barraPesquisaBotao"> <img src="../Imagens/magnifying-glasslll.png" alt=""></div>
    </form>
  </div>
</div>
<a href='../Reports/reportsResponsavel.php?key_rpt_resp=all' target="_blank"><div class="abrirAbaCadastro"><img src="../Imagens/printer.png" alt=""></div></a>


<div class="embrulho12">
  <div id="div-resultResp" class="div-result">

   <table class="bordasimples4" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->

        <td class="tituloTabelaCadAux">Nome</td>
        <td class="tituloTabelaCadAux">CPF</td>
        <!--<td class="tituloTabelaCadAux">Nacionalidade</td>-->
        <td class="tituloTabelaCadAux">RG</td>
        <td class="tituloTabelaCadAux">Data de Nascimento</td>
        <!--<td class="tituloTabelaCadAux">Sexo</td>-->
        <!-- <td class="tituloTabelaCadAux">Profissão</td> -->
     <!--  <td class="tituloTabelaCadAux">End. Trabalho</td>
      <td class="tituloTabelaCadAux">Telefone</td>
      <td class="tituloTabelaCadAux">Celular</td>
      <td class="tituloTabelaCadAux">Tel. Trabalho</td>
      <td class="tituloTabelaCadAux">Parentesco</td> -->
      <td class="tituloTabelaCadAux">Ações</td>
    </tr>
  </thead>
  <tbody>


    <?php

    foreach ($listaResponsavel as $obj) {
      echo("<tr>");

        /*echo("<td class='linhaTabela'>");
        echo ($obj->getCodigo());
        echo("</td>");*/
        $aux = str_replace('-', '/', $obj->getDatanascimento());
        $data = date('d/m/Y', strtotime($aux));
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getNome());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getCpf());
        echo("</td>");
        
       /* echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getNacionalidade());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getRg());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($data);
        echo("</td>");
        
        /*echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getSexo());
        echo("</td>");*/
        
        // echo("<td class='linhaTabelaCadAux'>");
        // echo($obj->getProfissao());
        // echo("</td>");
        
        /*echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getEnderecotrabalho());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getTelefone());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getCelular());
        echo("</td>");
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getTelefonetrabalho());
        echo("</td>");  
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getGrauparentesco());
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo("<div class='iconTabela'>");

        echo("<a href='#' name='vermais' id='vermais' onclick='vermais(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgverMais' src='../Imagens/none.png'></div></a>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editarresponsavel(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
        echo(" ");
        
        echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluirresponsavel(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
        
        echo("<a href='../Reports/reportsResponsavel.php?key_rpt_resp=especific&id_resp={$obj->getCodigo()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>  ");
        
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
  if(empty($_GET['pageResp'])){} else { $pagina = $_GET['pageResp'];}
  if(isset($pagina)){ $pagina = $_GET['pageResp'];}else{$pagina =1;}

  $voltar = $pagina - 1;
  $seguir = $pagina + 1;
  $valorAtual = $pagina;

  if( $pagina !=  1){
   echo "<li>"; 
   echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$voltar')"."><</a>";
   echo "</li>";
 }else{}

         // $pg =  $_POST["pageResp"];
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
   echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$i')".">$i</a>";
   echo("</li>");
   $i++;
   if($i > 10){
    echo "<li>"; 
    echo "<a>...</a>";
    echo "</li>"; 

    if(@$pagina > 11){
      echo "<li>"; 
      echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$valorAtual')".">$valorAtual </a>";
      echo "</li>"; 
    }else{
      echo "<li>"; 
      echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=11')".">11</a>";
      echo "</li>"; 
    }
    if (@$pagina <  ($calculo +5)) {
      echo "<li>"; 
      echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavel.php?pageResp=$seguir')".">></a>";
      echo "</li>"; 
    }
    break;
  }  
}
echo("</ul>");
    //Paginação
?>
</div>
<br>
<br>
</div>
<script type="text/javascript" language="javascript">
                //Paginação
                function pgresp(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
                //Paginação


                function excluirresponsavel(id){

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
                    url: "EditaExcluiResponsavel.php",
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




              function editarresponsavel(id){
                $.ajax({

                  asyn: false,
                  url: "edicaoResponsavel.php",
                  datatype: "html",
                  type:"POST",
                  data: {id: id},
                  success: function(data){
                    $('#painelAbas').html(data);
                  },
                });
              }

              function vermais(id){
                $.ajax({

                  asyn: false,
                  url: "verMaisResponsavel.php",
                  datatype: "html",
                  type:"POST",
                  data: {id: id},
                  success: function(data){
                    $('#painelAbas').html(data);
                  },
                });
              }



            </script>



