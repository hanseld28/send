<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php 
session_start();

$cod = $_SESSION['codUsuario'];

echo "<div class='painelAlterarSenhaResponsavel'>";

echo "<div class='fundoPainelAlterarSenhaResponsavel'>";

echo"<fieldset class='localFotoDoResponsavelElogin2'>";

echo "<img class='' src='../Imagens/padlock.png'>";

echo" </fieldset>";

echo"<div class='divQueDivideAfotoDasInformacoes'></div>";
echo "<div class='localInputsAltaracaoDeSenha'>";

echo "<label class=''>Digite sua senha</label>";

echo "<input class='' type='password' name='senha' id='senha'>";

echo "<label class='' id=''>Digite sua nova senha</label>";

echo "<input class='' type='password' name='nova' id='nova'>";

echo "<label class=''>Confirmar nova senha</label>";

echo "<input class='' type='password' name='nova2' id='nova2'>";

echo "<input class='btnAlterarSenhaForm' type='button' name='butto' value='Pronto' id='butto' onclick='editarSenhaUsuario(".$cod.")'>";

echo "</div>";

echo "</div>";

echo "</div>";


?>  

<script type="text/javascript" language="javascript">
  function editarSenhaUsuario(id){ 


    if(document.getElementById("nova").value == document.getElementById("nova2").value){

      swal({
        title: "Deseja Redefinir Sua Senha?",
        icon: "warning",
        buttons: [
        'Não',
        'Sim'
        ],
        dangerMode: true,
      }).then(function(isConfirm) { 
        if (isConfirm) {

         $.ajax({ 
          asyn: false,
          url: "EditaSenha.php",
          dataType: "html",
          type: "POST",
          data: {

            id: id,
            senha: $("#senha").val(),
            nova: $("#nova").val(),

          },
          success: function(data){
            $('#painelAbas').html(data);
          },
        });

       } 
     });
    }else{

     AlertdeErro.render('<h1>As Senhas não Conferem</h1>');

   }

 }
</script>
