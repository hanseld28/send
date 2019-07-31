<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php
include_once("../cab.php");
?>
<?php
include_once("verificaUsuarioLogado.php");
    //Includes do Funcionário
include_once("../Controller/FuncionarioCRUD.php");
include_once("../Model/Funcionario.php");
    //Includes do Cargo 
include_once("../Controller/CargoCRUD.php");
include_once("../Model/Cargo.php");
?>


<!-- Edição do Funcionario-->


<?php     
$nomecargo = ""; 
$codigofunc = $_POST['id'];


$crudfunc = new FuncionarioCRUD();
$cargofunc = $crudfunc->ConsultarCargos($codigofunc);


$func = new Funcionario();
$cfunc = new FuncionarioCRUD();
$resultadoconsulta = array();

$resultadoconsulta = $cfunc->ConsultaFuncionario($codigofunc);
$func = $resultadoconsulta;


foreach($cargofunc as $cargo){
  $nomecargo = $nomecargo.",".$cargo;
}


?>

<div class="cimaPesquisa">
 <h2 class="tituloTop">Editar Funcionário</h2>
</div>

<a href="#" id="abaconsultafuncionario" name="abaconsultafuncionario"onclick="abaconsultafuncionario('viewConsultarFuncionario.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png"alt=""></div></a>

<div class="conteudoCadastroFuncionario">
 <div class="dadosFunc">
   <div class="cadastroFuncionario">
    <form method="post" action="CorreioFuncionario2.php">

     <?php

     $cargofunc = $nomecargo;

     function no_array($valor) {
      global $cargofunc;

      $Array = $cargofunc;
      $Array = explode(',', $cargofunc);
      if(in_array($valor, $Array)) {
        return "checked='checked'";

      }}

      foreach ($func as $lis){

        echo("<p class='maiorInput'>");
        echo('<label>Nome Completo <sub>*</sub></label>');   
        echo("<input class='regular-input-text' type='text' name='nomefunc' id='nomefunc'  value='".$lis->getNome()."'>");
        echo("</p>");


        echo('<p>');
        echo('<label>RG <sub>*</sub></label>');
        echo("<input class='regular-input-text' type='text' name='rgfunc' id='rgfunc'  value='".$lis->getRg()."'>");
        echo("</p>");

        echo('<p>');
        echo("<label>CPF <sub>*</sub>&nbsp;&nbsp;&nbsp;<span id='cpfResponse' class='cpfLabel'></span></label>");
        echo("<input type='text' onkeyup='cpfCheck(this)' class='regular-input-text' name='cpffunc' id='cpffunc'  class='cpf' value='".$lis->getCpf()."' maxlength='14'  onkeydown='javascript: fMasc( this, mCPF );'>");
        echo("</p>");

        echo('<p>');
        echo('<label>CEP <sub>*</sub></label>'); 
        echo("<input class='regular-input-text' type='text' maxlength='9' name='cepfunc' id='cepfunc'  class='cep' value='".$lis->getCep()."'  onblur='pesquisacep(this.value);'>");
        echo("</p>");

        echo('<p>');
        echo('<label>Cidade <sub>*</sub></label>');
        echo("<input class='regular-input-text' type='text' name='cidadefunc' id='cidadefunc' value='".$lis->getCidade()."' >");
        echo("</p>");


        echo("<p class='maiorInput'>");
        echo('<label>Logradouro <sub>*</sub></label>');
        echo("<input class='regular-input-text' type='text' name='logradourofunc' id='logradourofunc'  value='".$lis->getLogradouro()."'>");
        echo("</p>");


        echo('<p>');
        echo('<label>NºCasa <sub>*</sub></label>');
        echo("<input class='regular-input-text' type='text' name='numeroCasafunc' id='numeroCasafunc'  value='".$lis->getNumcasa()."'>");
        echo("</p>");


        echo('<p>');
        echo("<label>Complemento <sub class='subBranco'>*</sub></label>");
        echo("<input class='regular-input-text' type='text' name='complementofunc' id='complementofunc'  value='".$lis->getComplemento()."'>");
        echo("</p>");


        echo('<p>');
        echo("<label>E-mail <sub class='subBranco'>*</sub></label>");
        echo("<input class='regular-input-text' type='text' name='emailfunc' id='emailfunc'  value='".$lis->getEmail()."'>");
        echo("</p>");


      }

      ?>

      <fieldset class="maiorInput">
        <legend>Cargo(s) do funcionário</legend>
        <?php

        $list = new CargoCRUD();
                    //cria um array
        $listagem = array();
                    //instancia um novo funcionario
        $cargo = new Cargo();

                    //o array recebe o retorno do metodo listar funcionario
        $listagem = $list->ListarCargos();

                    //o funcionario recebe a lista de funcionarios
        $cargo = $listagem;

        foreach ($cargo as $obj ){
         $variavel = $obj->getNome();
         $cod = $obj->getCodigo();  
         $retorno = no_array($variavel);    
         echo(" <input class='checkbox-regular' type='checkbox' name='ckbCargos' id='ckbCargos' value='".$cod."' ".$retorno."> ".$variavel." ");
       }
       ?>

     </fieldset>


     <?php
     echo("<div class='btnEdit'>");
     echo('<input class="btnProxPasso" type="button" value="Editar" onclick="editaraluno('.$codigofunc.')">');

     echo ("<input class='btnProxPasso' type='button'  value='Cancelar' onclick="."cancelare('viewConsultarFuncionario.php')".">");
     echo("</div");
     ?>

   </form>
 </div>
</div>
</div>
<script type="text/javascript" language="javascript">

 function abaconsultafuncionario(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };
          function editaraluno(cod)
          {
            if(document.getElementById("nomefunc").value != "" &&
             document.getElementById("rgfunc").value != "" &&
             document.getElementById("cpffunc").value != "" &&
             document.getElementById("logradourofunc").value != "" &&
             document.getElementById("numeroCasafunc").value != "" &&
             document.getElementById("cepfunc").value != "" &&
             document.getElementById("cidadefunc").value != "" && document.getElementById("emailfunc").value != ""){
              var arr = [];

            $("input:checkbox[name=ckbCargos]:checked").each(function(){
              arr.push($(this).val());
            });


            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioFuncionario2.php",
              data:{
                codigo: cod,
                nome: $('#nomefunc').val(),
                rg: $('#rgfunc').val(),
                cpf: $('#cpffunc').val(),
                logradouro: $('#logradourofunc').val(),
                complemento: $('#complementofunc').val(),
                ncasa: $('#numeroCasafunc').val(),
                cep: $('#cepfunc').val(),
                cidade: $('#cidadefunc').val(),
                email: $('#emailfunc').val(),
                cargos: arr

              },
              success: function(data){
                $('#painelAbas').html(data);  
              }
            });
          }else{
           AlertdeErro.render('<h1>Preencha todos os campos!</h1>')
         }
       }


     </script>



     <script type="text/javascript" >
      function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradourofunc').value=("");
        document.getElementById('cidadefunc').value=("");


      }

      function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradourofunc').value=(conteudo.logradouro);
        document.getElementById('cidadefunc').value=(conteudo.localidade);

    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
      }
    }

    function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          document.getElementById('cepfunc').value = cep.substring(0,5)
          +"-"
          +cep.substring(5);

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('logradourofunc').value="...";
            document.getElementById('cidadefunc').value="...";

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
            AlertdeErro.render('<h1>Formato de CEP inválido!</h1>')
          }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    };
  </script>


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

    function mCPF(cpffunc){
      cpffunc=cpffunc.replace(/\D/g,"")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
      return cpffunc
    }

    cpfCheck = function (el) {
      document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green"> CPF Válido</span>' : '<span style="color:red"> CPF Inválido</span>';
      if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
    }

  </script>


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

    function mCPF(cpffunc){
      cpffunc=cpffunc.replace(/\D/g,"")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d)/,"$1.$2")
      cpffunc=cpffunc.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
      return cpffunc
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






<?php
include_once("../rod.php");
?>