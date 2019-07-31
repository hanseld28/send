<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php  
$cod = $_POST['id'];
?>

<p>
  <label class="labelNegritoPront">Insira a sua senha atual:</label>
  <br>
  <input type="password" class="regular-input-text" id="senha" name='senha'>
</p>
<br>
<p>
  <label class="labelNegritoPront">Insira a nova senha:</label>
  <br>
  <input type="password" class="regular-input-text" id="nova" name='nova'>
</p>
<br>
<p>
  <label class="labelNegritoPront">Insira a nova senha novamente:</label>
  <br>
  <input type="password" class="regular-input-text" id="nova2" name='nova2'>
</p>
<br>
<?php
echo("<input type='button' value='Pronto' class='btnProxPasso' name='butto' value='' id='butto' onclick='editarSenhaUsuario(".$cod.")'>");

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