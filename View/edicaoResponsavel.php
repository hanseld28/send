<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ResponsavelCRUD.php");
include_once("../Controller/ContatoEmergenciaCRUD.php");
?>


<?php

$codigo = $_POST['id']; 

$resp = new Responsavel();

$crud = new ResponsavelCRUD();

$resultado = $crud->ConsultaResponsavel($codigo);
$resp = $resultado;

$codAluno = $crud->buscarAluno($codigo);

$crud2 = new ContatoEmergenciaCRUD();
$contatos = $crud2->consultarDadosEmergenciaAluno($codAluno);



$nome = $resp->getNome();
$cpf = $resp->getCpf();
$nacionalidade = $resp->getNacionalidade();
$rg = $resp->getRg();
$sexo = $resp->getSexo();
$profissao = $resp->getProfissao();
$enderecotra = $resp->getEnderecotrabalho();
$telefone = $resp->getTelefone();
$celular = $resp->getCelular();
$telefonetrabalho = $resp->getTelefonetrabalho();
$grau = $resp->getGrauparentesco();
$email = $resp->getEmail();



$aux = str_replace('-', '/', $resp->getDatanascimento());
$data = date('d/m/Y', strtotime($aux));


?>


<!-- Edição do Responsável-->
<div class="cimaPesquisa">
 <h2 class="tituloTop">Editar Responsável</h2>
</div>

<a href="#" id="abaconsultaresp" name="abaconsultaresp"onclick="abaconsultaresp('viewConsultarResponsavel.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png"alt=""></div></a>

<div class="embrulho12">
  <div class="conteudoDadosResp">
    <div class="dadosResp">
      <div class="cadastroResp">          
       <form method="post" action="#">

        <?php
        echo("<p class='maiorInput'>");
        echo("<label>Nome Completo <sub>*</sub></label>");
        echo("<input class='regular-input-text' type='text' name='nomeresp' id='nomeresp' value='".$nome."'>");
        echo("</p>");

        echo("<p>");
        echo("<label>Sexo <sub>*</sub></label>");
        $options=array("Sexo","Feminino","Masculino","Outro");
        echo "<select class='select-regular' name='sexoResp' id='sexoResp'>";
        foreach ($options as $lista)
        {
         if($lista==$sexo)
          echo"<option value=$lista selected='selected'>$lista</option>";
        else
          echo"<option value=$lista>$lista</option>";
      }
      echo" </select>"; 
      echo("</select>");
      echo("</p>");







      echo("<p>");
      echo("<label>Data de Nascimento <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' id='datanasc' name='datanasc' value='".$data."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>Nacionalidade <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' id='nacionalidade' name='nacionalidade' value='".$nacionalidade."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>RG <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' maxlength='10' id='rgresp' name='rgresp' value='".$rg."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>CPF <sub>*</sub>&nbsp;&nbsp;&nbsp;<span id='cpfResponse'></span></label>");
      echo("<input onkeyup='cpfCheck(this)' class='regular-input-text' type='text' name='cpf' id='cpf' value='".$cpf."' onkeydown='javascript: fMasc( this, mCPF );' maxlength='14'>");
      echo("</p>");
      $cod = $codigo;

      echo("<p>");
      echo("<label>Parentesco <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' name='grauresp' id='grauresp' value='".$grau."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>Profissão <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' id='profissaoresp' name='profissaoresp' value='".$profissao."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>E-mail <sub>*</sub></label>");
      echo("<input type='text' id='emailresp' name='emailresp' class='regular-input-text' value='".$email."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>Telefone Fixo <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' id='telefoneresp' name='telefoneresp' value='".$telefone."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>Celular <sub>*</sub></label>");
      echo("<input type='text' id='celularresp' name='celularresp' class='regular-input-text' value='".$celular."' >");
      echo("</p>");

      echo("<p>");
      echo("<label>Logradouro Trabalho <sub>*</sub></label>");
      echo("<input type='text' id='logradourotrabalho' name='logradourotrabalho' class='regular-input-text' value='".$enderecotra."'>");
      echo("</p>");

      echo("<p>");
      echo("<label>Telefone Trabalho <sub>*</sub></label>");
      echo("<input type='text' class='regular-input-text' id='telefonetrabalho' name='telefonetrabalho' value='".$telefonetrabalho."'>");
      echo("</p>");

      ?>
    </form>
  </div>
</div>
</div>

<div class="conteudodadosAdicionaisResp">
  <div class="dadosAdicionaisResp">
    <div class="cadastroDadosResp">
      <h3>Em caso de Emergência contatar:</h3>
      <form action="">
       <?php
       

       foreach ($contatos as $contato) {
          # code...

        echo("<p>");
        echo("<label>Nome Completo - Responsável </label>");
        echo("<input type='text' id='input name='input' value='".$contato->getNome()."' class='regular-input-text'>");
        echo("</p>");
        

        echo("<p>");
        echo("<label>Telefone - Responsável </label>");
        echo("<input type='text' id='input name='input' value='".$contato->getTelefone()."' class='regular-input-text'>");  
        echo("</p>");

      }

      echo("<div class='btnEdit'>");
      echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarresponsavel.php')".">");
      

      
      echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editar('.$codigo.')">');
      echo("</div>");

      ?>
      
    </form>
  </div>
</div>
</div>
</div>
<!-- <div class="conteudodadosAdicionaisResp">
  <div class="dadosAdicionaisResp">
    <div class="cadastroDadosResp">
      <h3>Em caso de Emergência contatar:
      <br>

      <form method="post" action="">

       
      </form>
    </div>
  </div>
</div> -->


<script type="text/javascript">
  function is_cpf (c) {

    if((c = c.replace(/[^\d]/g,"")).length != 11)
      return false

    if (c == "00000000000")
      return false;
    if (c == "11111111111")
      return false;
    if (c == "22222222222")
      return false;
    if (c == "33333333333")
      return false;
    if (c == "44444444444")
      return false;
    if (c == "55555555555")
      return false;
    if (c == "66666666666")
      return false;
    if (c == "77777777777")
      return false;
    if (c == "88888888888")
      return false;
    if (c == "99999999999")
      return false;

    var r;
    var s = 0;

    for (i=1; i<=9; i++)
      s = s + parseInt(c[i-1]) * (11 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[9]))
      return false;

    s = 0;

    for (i = 1; i <= 10; i++)
      s = s + parseInt(c[i-1]) * (12 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[10]))
      return false;

    return true;
  }


  function fMasc(objeto,mascara) {
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
  }

  function fMascEx() {
    obj.value=masc(obj.value)
  }

  function mCPF(cpf){
    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return cpf
  }

  cpfCheck = function (el) {
    document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green"> CPF Válido</span>' : '<span style="color:red"> CPF Inválido</span>';
    if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
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

     $("#painelAbas").load(pagina); 
     
   } 
  
});
   
 
}

</script>

<script type="text/javascript">
  function abaconsultaresp(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };

        </script>
        
        <script type="text/javascript" language="javascript">
          function editar(cod)
          {

            var sexoresp = document.getElementById("sexoResp").value;

            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioResponsavel2.php",
              data:{

                datanasc: $('#datanasc').val(),
                nacionalidaderesp: $('#nacionalidade').val(),
                rgresp: $('#rgresp').val(),
                cpfresp: $('#cpf').val(),
                profissaoresp: $('#profissaoresp').val(),
                logradourotrabalho: $('#logradourotrabalho').val(), 
                telefoneresp: $('#telefoneresp').val(),
                celularresp: $('#celularresp').val(),
                telefonetrabalho: $('#telefonetrabalho').val(),
                nomeresp: $('#nomeresp').val(),
                grauresp: $('#grauresp').val(),
                email: $('#emailresp').val(),
                sexoresponsavel: sexoresp,
                codigo: cod,

              },
              success: function(data){
                $('#painelAbas').html(data);  
              }
            });
          }

        </script>

        <?php
        include_once("../rod.php");
        ?>