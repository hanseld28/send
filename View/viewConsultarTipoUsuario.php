<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../Controller/ControllerTipoUsuario.php");

	// Instancia a classe ControllerTipoUsuario
$controllerTipoUsuario = new ControllerTipoUsuario();
    // Recebe o retorno do método listarTipoUsuario
$listaTiposUsuario = $controllerTipoUsuario->consultarTipoUsuario();

?>

<a  href="#" id="abacadastrotipousuario" name="abacadastrotipousuario" onclick="abacadastrotipousuario('pageCadastroTipoUsuario.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/add.png" alt=""></div></a>

<a href='../Reports/reportsTipoUsuario.php?key_rpt_type_user=all' target="_blank"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/printer.png" alt=""></div></a>
<h3 class="tituloConsultaCadAux">Tipo Usuário</h3>

<table class="bordasimples" cellspacing="0">
  <thead>
    <tr>
      <!--<td>Código</td>-->
      <td class="tituloTabelaCadAux">Tipo de Usuário</td>
      <td class="tituloAcoesTabelaCadAux">Ações</td>
    </tr>
  </thead>
  <tbody>

    <div class="barraPesquisaCadAux">
     <form>
   <!--<input type="text" name="txCaracteristicas" placeholder="Pesquisar..." class="barraPesquisa" id="txCaracteristicas">
     <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div> -->
   </form> 
 </div>
 <?php

 foreach ($listaTiposUsuario as $obj) {
  echo("<tr>");

        /*echo("<td>");
        echo ($obj->getId()); 
        echo("</td>");*/
        
        echo("<td class='linhaTabelaCadAux'>");
        echo($obj->getDescricao()); 
        echo("</td>");
        
        echo("<td class='tdAcoes'>");
        
        echo("<div class='iconTabela'>");
        
        echo("<a href='#' name='editar' value='' id='editar' onclick='editartipousuario(".$obj->getId().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
/*  echo(" ");
        echo("<a href='#' name='excluir' value='' id='escluir' onclick='excluirtipousuario(".$obj->getId().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>"); -->
        */
        echo("<a href='../Reports/reportsTipoUsuario.php?key_rpt_type_user=especific&id_type_user={$obj->getId()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>");
        
        echo("</td>");
        
        echo("</tr>");
        
        echo("</div>");
        
      } ?>


    </tbody>
  </table>


  <script type="text/javascript" language="javascript">
    function abacadastrotipousuario(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelCadAuxliar").load(pagina);
                
                
                
              };


              function excluirtipousuario(id){

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
                      url: "viewExcluirTipoUsuario.php",
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

              function editartipousuario(id){
                $.ajax({

                  asyn: false,
                  url: "edicaoTipoUser.php",
                  datatype: "html",
                  type:"POST",
                  data: {id: id},
                  success: function(data){
                    $('#painelCadAuxliar').html(data);
                  },
                });
              }
            </script>

            <?php      
    //Paginação
            $i = 1;
            $calculo = ($_POST['calculoTipoUsuario']) ? $_POST['calculoTipoUsuario'] : null;

            echo("<ul class='paginacaoCadAux'>");
            if(empty($_GET['pageAtividade'])){} else { $pagina = $_GET['pageAtividade'];}
            if(isset($pagina)){ $pagina = $_GET['pageAtividade'];}else{$pagina =1;}

            $voltar = $pagina - 1;
            $seguir = $pagina + 1;
            $valorAtual = $pagina;

            if( $pagina !=  1){
             echo "<li>"; 
             echo "<a href='#' id='pgTipoUsuario' name='pgTipoUsuario' onclick="."pgTipoUsuario('viewConsultarTipoUsuario.php?pageTipoUsuario=$voltar')"."><</a>";
             echo "</li>";
           }else{}

         // $pg =  $_POST["pageAtividade"];
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
            echo "<a href='#' id='pgTipoUsuario' name='pgTipoUsuario' onclick="."pgTipoUsuario('viewConsultarTipoUsuario.php?pageTipoUsuario={$i}')".">$i</a>";
            $i++;
            if($i > 10){
              echo "<li>"; 
              echo "<a>...</a>";
              echo "</li>"; 

              if(@$pagina > 11){
                echo "<li>"; 
                echo "<a href='#' id='pgTipoUsuario' name='pgTipoUsuario' onclick="."pgTipoUsuario('viewConsultarTipoUsuario.php?pageTipoUsuario=$valorAtual')".">$valorAtual </a>";
                echo "</li>"; 
              }else{
                echo "<li>"; 
                echo "<a href='#' id='pgTipoUsuario' name='pgTipoUsuario' onclick="."pgTipoUsuario('viewConsultarTipoUsuario.php?pageTipoUsuario=11')".">11</a>";
                echo "</li>"; 
              }
              if (@$pagina <  ($calculo +5)) {
                echo "<li>"; 
                echo "<a href='#' id='pgTipoUsuario' name='pgTipoUsuario' onclick="."pgTipoUsuario('viewConsultarTipoUsuario.php?pageTipoUsuario=$seguir')".">></a>";
                echo "</li>"; 
              }
              break;
            }  
          }
          echo("</li>");
          echo("</ul>");
 //Paginação
          ?>