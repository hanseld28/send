   <?php
   include_once("../Controller/ControllerMatricula.php");
    $CRUD = new ControllerMatricula();
    $ultimoCodMatricula = $CRUD->ultimaMatricula();
    
   $nomealuno = (isset($_POST['nomealuno'])) ? $_POST['nomealuno'] : null;
   $dataGeneric = (isset($_POST['datanasc'])) ? $_POST['datanasc'] : null;
   $nacionalidade = (isset($_POST['nacionalidade'])) ? $_POST['nacionalidade'] : null;
   $sexo = (isset($_POST['sexoaluno'])) ? $_POST['sexoaluno'] : null;
   $rgaluno = (isset($_POST['rgaluno'])) ? $_POST['rgaluno'] : null;
   $cor = (isset($_POST['corracaaluno'])) ? $_POST['corracaaluno'] : null;
   $certidao = (isset($_POST['certidaoaluno'])) ? $_POST['certidaoaluno'] : null;
    //$imagem = $_POST['imgaluno'];
   $logradouroaluno = (isset($_POST['logradouro'])) ? $_POST['logradouro'] : null;
   $complementoaluno = (isset($_POST['complemento'])) ? $_POST['complemento'] : null;
   $numcasaaluno = (isset($_POST['ncasa'])) ? $_POST['ncasa'] : null;
   $cepaluno = (isset($_POST['cep'])) ? $_POST['cep'] : null;
   $bairro = (isset($_POST['bairro'])) ? $_POST['bairro'] : null;
   $cidadealuno = (isset($_POST['cidade'])) ? $_POST['cidade'] : null;

   if (!is_null($nomealuno) && !is_null($dataGeneric) && !is_null($nacionalidade) && !is_null($sexo) && !is_null($rgaluno) && !is_null($cor) && !is_null($certidao) && !is_null($logradouroaluno) && !is_null($numcasaaluno) && !is_null($cepaluno) && !is_null($bairro) && !is_null($cidadealuno))
   {
    
    
    session_start();
    $_SESSION['numeroMatriculaAluno'] = $ultimoCodMatricula + 1;
    $_SESSION["nomealuno"] = $nomealuno;
    $_SESSION["dataGeneric"] = $dataGeneric;
    $_SESSION["nacionalidade"] = $nacionalidade;
    $_SESSION["sexo"] = $sexo;
    $_SESSION["rgaluno"] = $rgaluno;
    $_SESSION["cor"] = $cor;
    $_SESSION["certidao"] = $certidao;
    $_SESSION["logradouroaluno"] = $logradouroaluno;
    $_SESSION["complementoaluno"] = $complementoaluno;
    $_SESSION["numcasaaluno"] = $numcasaaluno;
    $_SESSION["cepaluno"] = $cepaluno;
    $_SESSION["bairro"] = $bairro;
    $_SESSION["cidadealuno"] = $cidadealuno;
  }


  ?>

  <script type="text/javascript" src="../js/Processa.js"></script>

  <?php
  include_once("../cab.php");
  include_once("../Controller/ResponsavelCRUD.php");
  include_once("verificaUsuarioLogado.php");

	// Instancia a classe ControllerPeriodo
  $controllerResponsavel = new ResponsavelCRUD();
    // Recebe o retorno do método consultarPeriodo
  $listaResponsavel = $controllerResponsavel->listarResponsavel();

   //Paginação
  $db = Conexao::conexao();
  $i = 1;
  $listarresp_pg=$db->prepare("SELECT codResponsavel, nomeResponsavel, cpfResponsavel, nacionalidadeResponsavel, rgResponsavel, dataNascResponsavel, sexoResponsavel, profissaoResponsavel, enderecoTrabalho, telefoneResidencialResponsavel, telefoneCelularResponsavel, telefoneTrabalhoResponsavel, grauParentescoResponsavel, codUsuario FROM tbresponsavel");
  $listarresp_pg->execute();

  $count = $listarresp_pg->rowCount();
  $calculo = ceil(($count/3));
  Conexao::desconexao();
      //Paginação

  ?>

  <script type="text/javascript">  
    $('#datanasc').mask('00/00/0000'); 
  </script>

  <script type="text/javascript">  
    $('#telefoneresp').mask('(00) 0000-0000'); 
  </script>

  <script type="text/javascript">  
    $('#celularresp').mask('(00) 00000-0000'); 
  </script>

  <script type="text/javascript">  
    $('#telefonetrabalho').mask('(00) 0000-0000'); 
  </script>

  <script type="text/javascript">  
    $('#telefone1').mask('(00) 00000-0000'); 
  </script>

  <script type="text/javascript">  
    $('#telefone2').mask('(00) 00000-0000'); 
  </script>

  <script type="text/javascript">  
    $('#telefone3').mask('(00) 00000-0000'); 
  </script>



  <div class="cimaPesquisaAluno">
   <div class="passosCadastros">
    <ul class="barraProgresso">
      <li class="ativo">Aluno</li>
      <li>Responsável</li>
      <li>Matrícula</li>
      <li>Prontuário</li>
      <li>Revisão</li>
    </ul>
  </div>
</div>

<div class="pesquisaResp">
 <div class="barraPesquisaGeral">
   <br>
   <form autocomplete="off" id="form_pesquisa">
   <h1>Responsável</h1>
    <input type="text" placeholder="Pesquisar..." id="txRespMat" name="txRespMat" class="barraPesquisa">
    <div class="barraPesquisaBotao"> <img src="../Imagens/magnifying-glasslll.png" alt=""></div>
  </form>
</div>   
</div>


<div id="div-resultRespMat">
 <div class="div-itens-consulta">
  <table class="bordasimples5" cellspacing="0">
    <thead>
      <tr>
        <!--<td>Código</td>-->
        <td class="tituloTabelaCadAux2">Selecionar</td>
        <td class="tituloTabelaCadAux1">Nome</td>
        <td class="tituloTabelaCadAux1">CPF</td>
        <td class="tituloTabelaCadAux1">RG</td>
        <td class="tituloTabelaCadAux1">Data de Nascimento</td>
        <td class="tituloTabelaCadAux1">Telefone Fixo</td>

      </tr>
    </thead>
    <tbody>


      <?php

      foreach ($listaResponsavel as $obj) {
        echo("<tr>");

        echo("<td class='linhaTabelaCadAux2'>");
        echo ("<input type='radio' class='radio-regular' name='radioresp' id='radioresp' value='{$obj->getCodigo()}'>");
        echo("</td>");


        echo("<td class='linhaTabelaCadAux1'>");
        echo($obj->getNome());
        echo("</td>");

        echo("<td class='linhaTabelaCadAux1'>");
        echo($obj->getCpf());
        echo("</td>");


        echo("<td class='linhaTabelaCadAux1'>");
        echo($obj->getRg());
        echo("</td>");

        echo("<td class='linhaTabelaCadAux1'>");
        echo($obj->getDatanascimento());
        echo("</td>");


        echo("<td class='linhaTabelaCadAux1'>");
        echo($obj->getTelefone());
        echo("</td>");


        echo("</tr>");

        echo("</div>");

      }
      ?>
    </tbody>
  </table>
</div>
</div>
<?php
             //Paginação
echo("<ul class='paginacaoCadAux'>");
while ($i <= $calculo) {
 echo("<li>");
 echo "<a  href='#' id='pgresp' name='pgresp' onclick="."pgresp('viewConsultarResponsavelMatricula.php?pageResp=$i')".">$i</a>";
 $i++;
}

echo("</li>");
echo("</ul>");
    //Paginação
?>



<div class="embrulho">
  <div class="conteudoDadosResp">
    <div class="dadosResp">
      <div class="cadastroResp">
        <p class="mensagemdeConfirmacao">        
          Deseja Adicionar um novo?
          <input class="InputMensagemdeConfirmacaosim" type="button" value="Sim" onclick="habilitaInputs()">
          <input class="InputMensagemdeConfirmacaonao" type="button" value="Cancelar" onclick="desabilitarInputs()">
        </p>
        <br>
        <form method="post" action="">

         <p class="maiorInput">
           <label>Nome Completo <sub>*</sub></label>
           <input type='text' name='nomeresp' id='nomeresp' placeholder="Digite o Nome" class="regular-input-text" disabled="true">
         </p>

         <p>
           <label>Sexo <sub>*</sub></label>
           <select class='select-regular' name='sexoresp' id='sexoresp' disabled="true">
            <option value='sexo'>Sexo</option>
            <option value='Feminino'>Feminino</option>
            <option value='Masculino'>Masculino</option>
            <option value='Outro'>Outro</option>
          </select>
        </p>

        <p>
         <label>Data de Nascimento <sub>*</sub></label>
         <input type='text' name='datanasc' id='datanasc' placeholder="ex. 00/00/0000" class="regular-input-text" disabled="true" maxlength="10"> 
       </p>

       <p>
        <label>Nacionalidade <sub>*</sub></label>
        <input type='text' name='nacionalidade' id='nacionalidade' placeholder="" class="regular-input-text" disabled="true">  
      </p>

      <p>
       <label>RG <sub>*</sub></label>
       <input type='text' name='rgresp' id='rgresp' maxlength="13" placeholder="ex. 00.000.000-0" class="regular-input-text" disabled="true"> 
     </p>

     <p>
       <label>CPF <sub>*</sub>&nbsp;&nbsp;&nbsp;<span id="cpfResponse"></span></label>
       <input onkeyup="cpfCheck(this)"  name="cpfResponsavel" id="cpfResponsavel" type="text" placeholder="CPF" class="regular-input-text" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" disabled="true">  
     </p>

     <p>
       <label>Parentesco <sub>*</sub></label>
       <input type='text' name='grauresp' id='grauresp' placeholder="Parentesco" class="regular-input-text" disabled="true">  
     </p>

     <p>
      <label>Profissão <sub>*</sub></label>
      <input type='text' name='profissaoresp' id='profissaoresp' placeholder="Profissão" class="regular-input-text" disabled="true">  
    </p>

    <p>
      <label>E-mail </label>
      <input type="text" name='emailresp' id='emailresp' placeholder="você@Exemplo.org" class="regular-input-text" disabled="true">  
    </p>

    <p>
      <label>Telefone Fixo</label>
      <input type='text' name='telefoneresp' id='telefoneresp' placeholder="ex. (00) 0000-0000" class="regular-input-text" disabled="true">  
    </p>

    <p>
     <label>Celular</label>
     <input type='text' name='celularresp' id='celularresp' placeholder="Celular" class="regular-input-text" disabled="true">  
   </p>

   <p>
    <label>Logradouro Trabalho</label>
    <input type='text' name='logradourotrabalho' id='logradourotrabalho' placeholder="ex. Rua, AV, Estrada... Nº 26" class="regular-input-text" disabled="true">  
  </p>

  <p>
   <label>Telefone Trabalho</label>
   <input type='text' name='telefonetrabalho' id='telefonetrabalho' placeholder="ex. (00) 00000-0000" class="regular-input-text" disabled="true">  
 </p>

 <!-- Responsável -->

</form>
</div>
</div>
</div>



<div class="conteudodadosAdicionaisResp">
  <div class="dadosAdicionaisResp">
    <div class="cadastroDadosResp">
      <h3>Em caso de Emergência contatar: </h3>
      <br>

      <form method="post" action="">
       <p>
         <label>Nome Completo - Responsável 1</label>
         <input type='text' name='pessoa1' id='pessoa1' placeholder="Nome Completo" class="regular-input-text">   
       </p>

       <p>
         <label>Telefone - Responsável 1</label>
         <input type='text' name='telefone1' id='telefone1' placeholder="Telefone/Celular" class="regular-input-text">  
       </p>

       <p>
        <label>Nome Completo - Responsável 2</label>
        <input type='text' name='pessoa2' id='pessoa2' placeholder="Nome Completo" class="regular-input-text">
      </p>

      <p>
        <label>Telefone - Responsável 2</label>
        <input type='text' name='telefone2' id='telefone2' placeholder="Telefone/Celular" class="regular-input-text">
      </p>

      <p>
        <label>Nome Completo - Responsável 3</label>
        <input type='text' name='pessoa3' id='pessoa3' placeholder="Nome Completo" class="regular-input-text">
      </p>

      <p>
        <label>Telefone - Responsável 3</label>
        <input type='text' name='telefone3' id='telefone3' placeholder="Telefone/Celular" class="regular-input-text">
      </p>



      <p class="maiorInput">
       <input class="btnProxPasso" type="button" value="Próximo Passo" onclick="carregaDados();scrollToTop();return false">
     </p>
   </form>
 </div>
</div>
</div>




<script type="text/javascript" language="javascript">
                //Paginação
                function pgresp(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
                //Paginação

                function habilitaInputs(){
                  var inputs = document.querySelectorAll('input[type="radio"]');
                  for (var i = 0, l = inputs.length; i < l; i++){
                    inputs[i].checked = false;
                    inputs[i].disabled = true;
                  }
                document.getElementById("nomeresp").disabled = false; //Habilitando
                document.getElementById("sexoresp").disabled = false; //Habilitando 
                document.getElementById("datanasc").disabled = false; //Habilitando
                document.getElementById("nacionalidade").disabled = false; //Habilitando
                document.getElementById("rgresp").disabled = false; //Habilitando
                document.getElementById("cpfResponsavel").disabled = false; //Habilitando
                document.getElementById("profissaoresp").disabled = false; //Habilitando
                document.getElementById("logradourotrabalho").disabled = false; //Habilitando
                document.getElementById("telefoneresp").disabled = false; //Habilitando
                document.getElementById("celularresp").disabled = false; //Habilitando   
                document.getElementById("telefonetrabalho").disabled = false; //Habilitando  
                document.getElementById("grauresp").disabled = false; //Habilitando  
                document.getElementById("emailresp").disabled = false; //Habilitando  
              };

              function desabilitarInputs(){
                var inputs = document.querySelectorAll('input[type="radio"]');
                for (var i = 0, l = inputs.length; i < l; i++){
                  inputs[i].checked = false;
                  inputs[i].disabled = false;
                }

                document.getElementById("nomeresp").disabled = true; //Habilitando
                document.getElementById("sexoresp").disabled = true; //Habilitando 
                document.getElementById("datanasc").disabled = true; //Habilitando
                document.getElementById("nacionalidade").disabled = true; //Habilitando
                document.getElementById("rgresp").disabled = true; //Habilitando
                document.getElementById("cpfResponsavel").disabled = true; //Habilitando
                document.getElementById("profissaoresp").disabled = true; //Habilitando
                document.getElementById("logradourotrabalho").disabled = true; //Habilitando
                document.getElementById("telefoneresp").disabled = true; //Habilitando
                document.getElementById("celularresp").disabled = true; //Habilitando   
                document.getElementById("telefonetrabalho").disabled = true; //Habilitando  
                document.getElementById("grauresp").disabled = true; //Habilitando 
                document.getElementById("emailresp").disabled = true; //Habilitando 
              };

              function carregaDados(){

               var arr = $("input[name='radioresp']:checked").val();
               var sexoresp = document.getElementById("sexoresp").value;

               var data = document.getElementById('datanasc').value;

               var objDate = new Date();
               objDate.setYear(data.split("/")[2]);
              objDate.setMonth(data.split("/")[1]  - 1);//- 1 pq em js é de 0 a 11 os meses
              objDate.setDate(data.split("/")[0]);

              if(objDate.getTime() > new Date().getTime()){
                alert("A data de nascimento não pode ser maior que a data atual");
                document.getElementById('datanasc').focus();
                return false;

              }else if(objDate.getTime() == new Date().getTime()){

                alert("A data de nascimento não pode ser igual a data atual");
                document.getElementById('datanasc').focus();
                return false;
              }

                $.ajax({
                  asyn: false,
                  type: "POST",
                  url: "CorreioResponsavel.php",
                  data:{

                    codResponsavel: arr,
                    pessoa1: $('#pessoa1').val(),
                    pessoa2: $('#pessoa2').val(),
                    pessoa3: $('#pessoa3').val(),
                    telefone1: $('#telefone1').val(),
                    telefone2: $('#telefone2').val(),
                    telefone3: $('#telefone3').val(),
                    datanasc: $('#datanasc').val(),
                    nacionalidaderesp: $('#nacionalidade').val(),
                    rgresp: $('#rgresp').val(),
                    cpfresp: $('#cpfResponsavel').val(),
                    profissaoresp: $('#profissaoresp').val(),
                    logradourotrabalho: $('#logradourotrabalho').val(),
                    telefoneresp: $('#telefoneresp').val(),
                    celularresp: $('#celularresp').val(),
                    telefonetrabalho: $('#telefonetrabalho').val(),
                    nomeresp: $('#nomeresp').val(),
                    grauresp: $('#grauresp').val(),
                    email: $('#emailresp').val(),
                    sexoresponsavel: sexoresp,

                  },
                  success: function(data){
                    $('#painelAbas').html(data);  
                  }
                });
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

        function mCPF(cpfResponsavel){
          cpfResponsavel=cpfResponsavel.replace(/\D/g,"")
          cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d)/,"$1.$2")
          cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d)/,"$1.$2")
          cpfResponsavel=cpfResponsavel.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
          return cpfResponsavel
        }

        cpfCheck = function (el) {
          document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green"> CPF Válido</span>' : '<span style="color:red"> CPF Inválido</span>';
          if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
        }

      </script>



      <script type="text/javascript">
        $(document).ready(function(){

    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, div)
    {
      $.ajax
      ({
        type: 'POST',
        dataType: 'html',
        url:'../Pesquisa/processaRespMat.php',
        data: valores,
        success:function(data){
          $('#div-resultRespMat').empty().html(data);
        }         

      });
    }
    

    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#txRespMat').keyup(function(){

        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
        
        if($parametro.length >= 1)
        {
          load_dados(valores, '../Pesquisa/processaRespMat.php', '#div-resultRespMat');
        }else
        {
          load_dados(valores, '../Pesquisa/processaRespMat.php', '#div-resultRespMat');
        }
      });

  });
</script> 



<script>

$('.InputMensagemdeConfirmacaosim').click(function(){
$('table.bordasimples5 td').css('background-color','#ccc');
$('table.bordasimples5 td').css('border','1px solid #e1e1e1');
$('table.bordasimples5 td').css('color','grey');
$('table.bordasimples5 td').css('cursor','not-allowed');
$('table.bordasimples5 td .radio-regular').css('background-color','transparent');
$('table.bordasimples5 td .radio-regular').css('border','2px solid grey');



})
    
$('.InputMensagemdeConfirmacaonao').click(function(){
$('table.bordasimples5 td').css('border','1px solid #e1e1e1');
$('table.bordasimples5 td').css('color','grey');
$('table.bordasimples5 td').css('cursor','auto');
$('table.bordasimples5 td .radio-regular').css('border','1px solid grey');
$('.linhaTabelaCadAux1').css('background-color','aliceblue');
$('.linhaTabelaCadAux2').css('background-color','aliceblue');
$('table.bordasimples5 tr:nth-child(2n+2) td').css('background-color','#fff'); 
$('table.bordasimples5 td .radio-regular').css('border','2px solid #0099e5');
$('.tituloTabelaCadAux1').css('background-color','#fff');
$('.tituloTabelaCadAux2').css('background-color','#fff');

})
    
</script>                     







