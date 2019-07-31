<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php

include_once("../Controller/ControllerCard.php");
include_once("../Model/Card.php");
include_once("verificaUsuarioLogado.php");


                //instancia a classe crud
$list = new ControllerCard();
            //cria um array
$listagem = array();
            //instancia um novo funcionario
$card = new Card();

            //o array recebe o retorno do metodo listar funcionario
$listagem = $list->consultarCard();

            //o funcionario recebe a lista de funcionarios
$card = $listagem;

?>



              <!--<label>Pesquisar</label>
            <br>
            <input type="text" name="txtPesquisaCargoFuncionario" id="pesquisaCargoFuncionario">-->
            
            <div class="barraPesquisaCadAux">
             <form>
               <input type="text" placeholder="Pesquisar" id="txCard" class="barraPesquisa" name="txCard"/> 
               <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
             </form> 
           </div>

           <a  href="#" id="abacadastrocard" name="abacadastrocard" onclick="abacadastrocard('pageCadastroCard.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>

           <a href='../Reports/reportsCard.php?key_rpt_card=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>

           <!-- FUNÇÃO QUE ABRE A TELA DE CADASTRO -->
           <script type="text/javascript" language="javascript">
            function abacadastrocard(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                
                
                
              };


              function excluir(id){

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
                    url: "EditaExcluiCard.php",
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
            
            
            

            function editar(cod){

              $.ajax({
                asyn: false,
                url: "edicaoCard.php",
                datatype: "html",
                type:"POST",
                data: {cod: cod},
                success: function(data){
                  $('#painelCadAuxliar').html(data);
                },
              });
            }


          </script>
          <h3 class="tituloConsultaCadAux">Categoria de Rotina</h3>
          <div id="div-resultCard">
            <table class="bordasimples" cellspacing="0">
              <thead>
                <tr>
                  <!--<td> Código </td>-->
                  <td class="tituloTabelaCadAux">Descrição</td>
                  <td class="tituloAcoesTabelaCadAux">Ações</td>

                </tr>
              </thead>
              <tbody>


                <?php foreach ($card as $obj){
                    /*echo("<tr>");
                    echo("<td>");
                        
                        echo($obj->getCodigo());
                    
                        echo("</td>");*/
                        
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($obj->getDescricao());
                        echo("</td>");
                        echo("<td class='tdAcoes'>");
                        echo("<div class='iconTabela'>");
                        echo("<a href='#' name='butto' value='' id='butto' onclick='editar(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
                        echo(" ");
                        //echo("<a href='editaExcluiCargo.php?acao=excluir&codcargo=".$obj->getCodigo()."'>Excluir</a>");
                        echo("<a href='#' name='button' value='' id='button' onclick='excluir(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
                        
                        echo("<a href='../Reports/reportsCard.php?key_rpt_card=especific&id_card={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
                        
                        //echo("<a href='#' id='".$obj->getCodigo()."' class='deleta'>Excluir</a>");
                        echo("</td>");
                        
                        echo("</tr>");
                        
                        echo("</div>");
                      }?>

                    </tbody>
                  </table>

                  <?php

                //Paginação
                  $i = 1;
                  $calculo = ($_POST['calculoCard']) ? $_POST['calculoCard'] : null;

                  echo "<ul class='paginacaoCadAux'>";
                  if(empty($_GET['pageCard'])){} else { $pagina = $_GET['pageCard'];}
                  if(isset($pagina)){ $pagina = $_GET['pageCard'];}else{$pagina =1;}

                  $voltar = $pagina - 1;
                  $seguir = $pagina + 1;
                  $valorAtual = $pagina;

                  if( $pagina !=  1){
                   echo "<li>"; 
                   echo "<a href='#' id='pgcard' name='pgcard' onclick="."pgcard('viewConsultarCard.php?pageCard=$voltar')"."><</a>";
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
                  echo "<a href='#' id='pgcard' name='pgcard' onclick="."pgcard('viewConsultarCard.php?pageCard={$i}')".">$i</a>";
                  $i++;
                  if($i > 10){
                    echo "<li>"; 
                    echo "<a>...</a>";
                    echo "</li>"; 

                    if(@$pagina > 11){
                      echo "<li>"; 
                      echo "<a href='#' id='pgcard' name='pgcard' onclick="."pgcard('viewConsultarCard.php?pageCard=$valorAtual')".">$valorAtual </a>";
                      echo "</li>"; 
                    }else{
                      echo "<li>"; 
                      echo "<a href='#' id='pgcard' name='pgcard' onclick="."pgcard('viewConsultarCard.php?pageCard=11')".">11</a>";
                      echo "</li>"; 
                    }
                    if (@$pagina <  ($calculo +5)) {
                      echo "<li>"; 
                      echo "<a href='#' id='pgcard' name='pgcard' onclick="."pgcard('viewConsultarCard.php?pageCard=$seguir')".">></a>";
                      echo "</li>"; 
                    }
                    break;
                  }  

                }
                echo("</ul>");
 //Paginação
                ?>
              </div>



              <script type="text/javascript">
                /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
                $(document).ready(function(){   
                  $('#txCard').keyup(function(event){                
                    $('form').submit(function(){
                      var dados = $(this).serialize();

                      $.ajax({
                        url:'../Pesquisa/processaCard.php',
                        type: 'POST',
                        dataType: 'html',
                        data: dados,
                        success:function(data){
                          $('#div-resultCard').empty().html(data);
                        }                   
                      });
                      return false;
                    });

                    $('form').trigger('submit');            
                  });
                }); 
                /*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/

              </script>

              <script type="text/javascript">
                    //Paginação
                    function pgcard(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
    //Paginação
  </script>