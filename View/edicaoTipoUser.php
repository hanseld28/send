<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ControllerTipoUsuario.php");
?>



<?php

$codigo = $_POST['id'];

$tipouser = new TipoUsuario();

$crud = new ControllerTipoUsuario();

$resultado = $crud->PreencherTipoUsuario($codigo);
$desctipo = $resultado;


?>
<div class="barraPesquisaCadAux">


</div>

<a href="#" id="abaconsultatipouser" name="abaconsultatipouser"onclick="abaconsultatipouser('viewConsultarTipoUsuario.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<div class="FormCadastroAtividade">
  <fieldset>
    <legend>Edição Tipo de Usuário</legend>
    <form method="post" action="#">
      <label class="labelCadAux">Descrição</label>
      <div class="caixaTexto">
        <?php
        
        echo("<input class='regular-input-text' type='text' name='txttipo' id='txttipo' value='".$desctipo."'>");

        $cod = $codigo;
        echo("<p class=''>");
        echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editartipousuario('.$cod.')">'); 
        echo("</p");
        echo("<p class=''>");
        echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarTipoUsuario.php')".">");
        echo("</p");
        
        ?>
      </div>
    </form>
    <img src="../Imagens/ImagensCadastrosAuxiliares/Tipo%20Usuario.png" alt="">
  </fieldset>
</div>

<script type="text/javascript" language="javascript">

  function abaconsultatipouser(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
          };
          function editartipousuario(cod)
          {
            if(document.getElementById("txttipo").value != ""){
              $.ajax({
                asyn: false,
                type: "POST",
                url: "CorreioTipoUsuario2.php",
                data:{
                  nome_usuario: $('#txttipo').val(),
                  cod_usuario: cod
                },
                success: function(data){
                  $('#painelCadAuxliar').html(data);  
                }
              });
            }else{
              AlertdeErro.render('<h1>Preencha todos os campos!</h1>');
            }
          }

        </script>

        <script type="text/javascript">
         function cancelare(pagina){
          swal({
            title: "Deseja Cancelar?(As alterações não serão salvas)",
            icon: "warning",
            buttons: [
            'Não',
            'Sim'
            ],
            dangerMode: true,
          }).then(function(isConfirm) { 
            if (isConfirm) {

              $("#painelCadAuxliar").load(pagina); 

            } 
           
          });
        }

      </script>

      <?php
      include_once("../rod.php");
      ?>