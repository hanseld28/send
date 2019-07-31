<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
?>
<?php
include_once("verificaUsuarioLogado.php");
    //Includes do Aluno
include_once("../Controller/AlunoCRUD.php");
include_once("../Model/Aluno.php");

$codigo = $_POST['id'];


$aluno = new Aluno();
$crudaluno = new AlunoCRUD();
$resultado = array();

$resultado = $crudaluno->ConsultaAluno($codigo);
$aluno = $resultado;
?>

<script type="text/javascript">  
  $('#txtDataNascAluno').mask('00/00/0000'); 
</script>

<script type="text/javascript">  
  $('#txtCertidao').mask('000000 00 00 0000 000 000000 00'); 
</script>


<a href="#" id="abaconsultaaluno" name="abaconsultaaluno"onclick="abaconsultaaluno('viewConsultarAluno.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png"alt=""></div></a>

<div class="cimaPesquisa">
 <h2 class="tituloTop">Editar Aluno</h2>
</div>
<div class="embrulho">    
  <div class="conteudoDadosAluno">
    <div class="dadosAluno">
     <div class="cadastroAluno">

      <form method="post" action="CorreioAluno2.php">

        <p class="maiorInput">
         <label>Nome Completo <sub>*</sub></label>
         <input type='text' class='regular-input-text' name='txtNomeAluno' id='txtNomeAluno' placeholder="Nome Completo" value='<?php
         foreach($aluno as $alunos){
           echo($alunos->getNome());
         }
         ?>'> 
       </p>
       <p>
         <?php
         foreach($aluno as $alunos)
         { 
          $date = $alunos->getDataNascimento();
        } 
        $aux = str_replace('-', '/', $date);
        $dataNascAluno = date('d/m/Y', strtotime($aux));
        ?>  
        <label>Data Nascimento <sub>*</sub></label>
        <input type='text' class="regular-input-text" name='txtDataNascAluno' id='txtDataNascAluno' placeholder="data de nascimento" value='<?php echo($dataNascAluno); ?>'>
      </p>
      <p>

        <?php  
        foreach($aluno as $alunos){
         $sexoAluno = $alunos->getSexo();
       }
       ?>
       <p>

        <label>Sexo <sub>*</sub></label>

        <?php

        $options=array("Sexo","Feminino","Masculino","Outro");
        echo "<select class='select-regular' name='sexoAluno' id='sexoAluno'>";
        foreach ($options as $lista)
        {
         if($lista==$sexoAluno)
          echo"<option value=$lista selected='selected'>$lista</option>";
        else
          echo"<option value=$lista>$lista</option>";
      }
      echo" </select>";

      ?>

    </p> 

    <p>
     <label>Nacionalidade <sub>*</sub></label>
     <input type="text" class="regular-input-text" name='txtNacionalidade' id='txtNacionalidade' value="<?php foreach($aluno as $alunos){echo($alunos->getNacionalidade());} ?>">
   </p>     

   <p>
     <label>RG <sub>*</sub></label>
     <input type='text' class="regular-input-text" name='txtRgAluno' id='txtRgAluno' placeholder="RG" value='<?php foreach($aluno as $alunos){echo($alunos->getRg());}?>'>
   </p>

   <p>                 <?php  
   foreach($aluno as $alunos){
     $cor = $alunos->getCor();

   }
   ?>

   <label>Cor/Raça</label>
   <?php
   $opcoes=array("Cor/Raça","Branco(a)","Preto(a)","Pardo(a)","Amarelo(a)", "Indígeno(a)", "Prefiro não identificar");
   echo "<select class='select-regular' name='cor' id='cor'>";
   foreach ($opcoes as $list)
   {
     if($list==$cor)
      echo"<option value=$list selected='selected'>$list</option>";
    else
      echo"<option value=$list>$list</option>";
  }
  echo" </select>";

  ?>
</p>

<p class="maiorInput">
 <label>Certidão de Nascimento <sub>*</sub></label>
 <input type="text" class="regular-input-text" name='txtCertidao' id='txtCertidao' value='<?php foreach($aluno as $alunos){echo($alunos->getCertidao());} ?>'>
</p>


<p>
  <label>CEP <sub>*</sub></label>
  <input  type='text' name='txtCepAluno' maxlength="9" id='txtCepAluno' placeholder="CEP" class="regular-input-text" value='<?php foreach($aluno as $alunos){echo($alunos->getCep());} ?>' onblur="pesquisacep(this.value);">
</p>



<p>
 <label>Cidade <sub>*</sub></label>
 <input class="regular-input-text" type='text' name='txtCidadeAluno' id='txtCidadeAluno' placeholder="Cidade" value='<?php foreach($aluno as $alunos){echo($alunos->getCidade());} ?>'>
</p>

<p>
 <label>Bairro <sub>*</sub></label>
 <input class="regular-input-text" type='text' name='txtBairro' id='txtBairro' placeholder="Bairro" value='<?php foreach($aluno as $alunos){echo($alunos->getBairro());} ?>'>
</p>
<p class="maiorInput">
 <label>Logradouro <sub>*</sub></label>
 <input type='text' class="regular-input-text" name='txtLogradouroAluno' id='txtLogradouroAluno' placeholder="Logradouro" value='<?php foreach($aluno as $alunos){echo($alunos->getLogradouro());} ?>'>
</p>

<p>
 <label>Nº <sub>*</sub></label>
 <input type='text' class="regular-input-text" name='txtNumCasaAluno' id='txtNumCasaAluno' placeholder="Nº" value='<?php foreach($aluno as $alunos){echo($alunos->getNumCasa());} ?>'>
</p>


<p>
 <label>Complemento <sub class="subBranco">*</sub></label>
 <input class="regular-input-text" type='text' name='txtComplementoAluno' id='txtComplementoAluno' placeholder="Complemento" value='<?php foreach($aluno as $alunos){echo($alunos->getComplemento());} ?>'>
</p>

<?php

echo("<div class='btnEdit'>");
echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarAluno.php')".">");


echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editaraluno('.$codigo.')">');
echo("</div>");
?>

</form>
</div>
</div>
</div>

</div>

<?php
foreach($aluno as $alunos)
{
  $nome_foto = $alunos->getFoto();
}
?>

<form id="formulario" name="formulario" method="post" enctype="multipart/form-data" action="upload.php">
 <div class="fotoDePerfilAluno" id='visualizar'>
  <?php
  echo "<img src='../fotos/".$nome_foto."' id='previsualizar'>";
  ?>
  <div class="btnEscolherImagem"><label for="imagem"><img src="../Imagens/add.png" alt=""></label></div>
</div>   

<input type="file" name="imagem" id="imagem" name="imagem" class="btnfotoAluno">
</form>

<script type="text/javascript" language="javascript">


 function abaconsultaaluno(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };

          $(document).ready(function(){
           /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
           $('input:file[name="imagem"]').change(function(){

            var formdata = new FormData($("form[name='formulario']")[0]);


            $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
            /* Efetua o Upload sem dar refresh na pagina */
            $.ajax({
              type: "POST",
              url: "upload.php",
              enctype: "multpart/form-data",
              async: false,
              data: formdata,
            processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"
            cache: false, // desabilitar o "cache"
            
            success: function(data) {
              $('#visualizar').html(data);
            }
          });

          });
         });

          function editaraluno(cod) {

            var sexoaluno = document.getElementById("sexoAluno").value;
            var corracaaluno = document.getElementById("cor").value;

            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioAluno2.php",
              data: {
                codigo: cod,
                nome: $('#txtNomeAluno').val(),
                nacionalidade: $('#txtNacionalidade').val(),
                rg: $('#txtRgAluno').val(),
                datanasc: $('#txtDataNascAluno').val(),
                logradouro: $('#txtLogradouroAluno').val(),
                complemento: $('#txtComplementoAluno').val(),
                ncasa: $('#txtNumCasaAluno').val(),
                cep: $('#txtCepAluno').val(),
                cidade: $('#txtCidadeAluno').val(),
                certidao: $('#txtCertidao').val(),
                bairro: $('#txtBairro').val(),
                sexo: sexoaluno,
                cor: corracaaluno,
              },
              success: function(data) {
                $('#painelAbas').html(data);
              }
            });
          }
        </script>


        <script type="text/javascript">
          function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          document.getElementById('txtCepAluno').value = cep.substring(0,5)
          +"-"
          +cep.substring(5);

        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('txtLogradouroAluno').value="...";
        document.getElementById('txtCidadeAluno').value="...";
        document.getElementById('txtCidadeAluno').value="...";

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

      } //end if.
      else {
      //cep é inválido.
      limpa_formulário_cep();
      AlertdeErro.render('<h1>Formato de CEP inválido</h1>');
    }
  } //end if.
  else {
  //cep sem valor, limpa formulário.
  limpa_formulário_cep();
}
};
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

     $("#painelAbas").load(pagina); 

   }
});
}





</script>

<?php
include_once("../rod.php");
?>
