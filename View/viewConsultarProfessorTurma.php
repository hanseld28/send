<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">

<?php

include_once("../Controller/ProfessorTurmaCRUD.php");
include_once("verificaUsuarioLogado.php");



$list = new ProfessorTurmaCRUD();           
$listagem = array();           
$profturma = new ProfessorTurma();
$listagem = $list->mostrarProfessorTurma();
$profturma = $listagem;

      //PAGINAÇÃO//
$db = Conexao::conexao();
$i = 1;
$listarprofturma_pg=$db->prepare("SELECT codprofessorTurma, codTurma, codUsuario FROM tbprofessorturma");
$listarprofturma_pg->execute();

$count = $listarprofturma_pg->rowCount();
$calculo = ceil(($count/5));

Conexao::desconexao();     
       //PAGINAÇÃO//

?>
<div class="barraPesquisaCadAux">
  <form autocomplete="off">
   <input type="text" placeholder="Pesquisar..." id="" name="" class="barraPesquisa">
   
   <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
 </form> 
</div>

<a  href="#" id="abacadastroprofturma" name="abacadastroprofturma" onclick="abacadastroprofturma('pageCadastroProfessorTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>


<a href='../Reports/reportsProfessorTurma.php?key_rpt_profturma=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>

<script type="text/javascript" language="javascript">
    //Paginação
    function pgprofturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
              };

     //Paginação
     function abacadastroprofturma(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                
              };
              
              
              function excluirprof(codigo){

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
                    url: "EditaExcluiProfessorTurma.php",
                    dataType: "html",
                    type: "POST",
                    data: { cod: codigo},
                    success: function(data){
                      $('#painelCadAuxliar').html(data);
                    },
                  });
                   
                 } 
              });
              }
              
              
              
              
              function editar(cod){
                
                $.ajax({
                  
                  url: "edicaoProfessorTurma.php",
                  datatype: "html",
                  type:"POST",
                  data: {cod: cod},
                  success: function(data){
                    $('#painelCadAuxliar').html(data);
                  },
                });
              }
              
              
            </script>

            <h3 class="tituloConsultaCadAux">Professores por Turma</h3>
            <div class="div-itens-consulta">
             <table class="bordasimples" cellspacing="0">
              <thead>
                <tr>
                  <td class="tituloTabelaCadAux">Nome da Turma</td>
                  <td class="tituloTabelaCadAux">Nome do Professor</td>   
                  <td class="tituloAcoesTabelaCadAux">Ações</td>     
                </tr>
              </thead>
              <tbody>
                
                
                <?php foreach ($profturma as $obj){
                  echo("<tr>");
                  
                  echo("<td class='linhaTabelaCadAux'>");
                  echo($obj->getNometurma());
                  echo("</td>");
                  
                  echo("<td class='linhaTabelaCadAux'>");
                  echo($obj->getNomeprofessor());
                  echo("</td>");
                  
                  
                  echo("<td class='tdAcoes'>");
                  
                  echo("<div class='iconTabela'>");
                  
                  echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$obj->getCodigoprofessorturma().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
                  echo(" ");
                  echo("<a href='#' name='button' value='' id='button' onclick='excluirprof(".$obj->getCodigoprofessorturma().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
                  
                  echo("<a href='../Reports/reportsProfessorTurma.php?key_rpt_profturma=especific&id_profturma={$obj->getCodigoprofessorturma()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
                  
                  echo("</td>");
                  
                  echo("</tr>");
                  
                  echo("</div>");
                }

                
                echo("</tbody>");
                echo("</table>");
                echo("<ul class='paginacaoCadAux'>");
                while ($i <= $calculo) {
                 echo("<li>");
                 echo "<a  href='#' id='pgprofturma' name='pgprofturma' onclick="."pgprofturma('viewConsultarProfessorTurma.php?pageProfTurma=$i')".">$i</a>";
                 $i++;
               }
               echo("</li>");
               echo("</ul>");
               echo("</div>");
               ?>
