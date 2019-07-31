<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">

<?php
include_once '../Controller/ItemCronogramaCRUD.php';


                //instancia a classe crud
$list = new ItemCronogramaCRUD();
            //cria um array

            //instancia um novo funcionario


            //o array recebe o retorno do metodo listar funcionario
$listagem = $list->ListarItensCronograma();

        //o funcionario recebe a lista de funcionario

?>



<div class="barraPesquisaCadAux">
 <form>
  <input type="text" name="txItens" placeholder="Pesquisar..." class="barraPesquisa" id="txItens"/>
  <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
</form> 
</div>


<a  href="#" id="abacadastroitem" name="abacadastroitem" onclick="abacadastroitem('pageCadastroItensCronograma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>

<a href='../Reports/reportsItensCronograma.php?key_rpt_itenscronograma=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>




                  <!-- <h3>Consulta Itens de Cronograma</h3>
        <label>Pesquisar:</label>
            <br>
            <input type="text" name="txtPesquisaItensDeCronograma" id="pesquisaItensDeCronograma"> -->
            
            
            
            

            <!-- FUNÇÃO QUE ABRE A TELA DE CADASTRO -->
            <script type="text/javascript" language="javascript">
              function abacadastroitem(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);



              };
              
              
              function excluiritem(id){
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
                    url: "EditaExcluiItemCronograma.php",
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
              
              
              
              function editaritem(cod){


                $.ajax({ 
                  asyn: false,
                  url: "edicaoItensCronograma.php",
                  dataType: "html",
                  type: "POST",
                  data: { cod: cod},
                  success: function(data){
                    $('#painelCadAuxliar').html(data);
                  },
                });
                
              }   
            </script>
            
            <script type="text/javascript">$(document).ready(function(){
              $('#txItens').keyup(function(event){             
                $('form').submit(function(){
                  var dados = $(this).serialize();

                  $.ajax({
                    url:'../Pesquisa/processaItens.php',
                    type: 'POST',
                    dataType: 'html',
                    data: dados,
                    success:function(data){
                      $('#div-resultItens').empty().html(data);
                    }                   
                  });
                  return false;
                });

                $('form').trigger('submit');            
              });     
            });
          </script>
          <h3 class="tituloConsultaCadAux">Itens Cronograma</h3>
          <div id="div-resultItens">

           <table class="bordasimples" cellspacing="0">
            <thead>
              <tr>
                <!--<td>Código</td>-->
                <td class="tituloTabelaCadAux">Descrição</td>
                <td class="tituloTabelaCadAux">Horário</td>
                <td class="tituloAcoesTabelaCadAux">Ações</td>

              </tr>
            </thead>
            <tbody>



              <?php foreach ($listagem as $obj){
            //cria um foreach passando pela lista de funcionarios
        //imprime os dados do obj
                echo("<tr>");

            /*echo("<td>");
            echo($obj->getCodigo());
            echo("</td>");*/

            echo("<td class='linhaTabelaCadAux'>");
            echo($obj->getNome());
            echo("</td>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($obj->getHorario());
            echo("</td>");
            
            echo("<td class='tdAcoes'>");

            echo("<div class='iconTabela'>");

            echo("<a href='#' name='editar' value='' id='editar' onclick='editaritem(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
            echo(" ");
            echo("<a href='#' name='button' value='' id='button' onclick='excluiritem(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

            echo("<a href='../Reports/reportsItensCronograma.php?key_rpt_itenscronograma=especific&id_itenscronograma={$obj->getCodigo()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
            echo("</td>");
            echo("</tr>");

            echo("</div>");
          }?>

        </tbody>
      </table>
    </div>


    <?php        

                    //Paginação
    $i = 1;
    $calculo = ($_POST['calculoItensCronograma']) ? $_POST['calculoItensCronograma'] : null;

    echo("<ul class='paginacaoCadAux'>");
    if(empty($_GET['pageItensCronograma'])){} else { $pagina = $_GET['pageItensCronograma'];}
    if(isset($pagina)){ $pagina = $_GET['pageItensCronograma'];}else{$pagina =1;}

    $voltar = $pagina - 1;
    $seguir = $pagina + 1;
    $valorAtual = $pagina;

    if( $pagina !=  1){
     echo "<li>"; 
     echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$voltar')"."><</a>";
     echo "</li>";
   }else{}

         // $pg =  $_POST["pageItensCronograma"];
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
    echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma={$i}')".">$i</a>";
    $i++;
    if($i > 10){
      echo "<li>"; 
      echo "<a>...</a>";
      echo "</li>"; 

      if(@$pagina > 11){
        echo "<li>"; 
        echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$valorAtual')".">$valorAtual </a>";
        echo "</li>"; 
      }else{
        echo "<li>"; 
        echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=11')".">11</a>";
        echo "</li>"; 
      }
      if (@$pagina <  ($calculo +5)) {
        echo "<li>"; 
        echo "<a href='#' id='pgitenscronograma' name='pgitenscronograma' onclick="."pgitenscronograma('viewConsultarItensCronograma.php?pageItensCronograma=$seguir')".">></a>";
        echo "</li>"; 
      }
      break;
    }  
  }
  echo("</ul>");

        //Paginação

  ?>    
