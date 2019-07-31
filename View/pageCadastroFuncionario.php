<script type="text/javascript" src="../js/EventosdosAlerts.js"></script>

<?php
include_once("../cab.php");
?>

<!-- ==================== Form de Cadastro de Funcionário =================== -->
<div class="cimaPesquisa">
 <h2 class="tituloTop">Cadastrar Funcionário</h2>
</div>
<a  href="#" id="abaconsultafunc" name="abaconsultafunc" onclick="abaconsultafunc('viewConsultarFuncionario.php')"><div class="abrirAbaCadastro"><img src="../Imagens/loupe.png"alt=""></div></a>

<script type="text/javascript" language="javascript">
  function abaconsultafunc(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };


            </script>

            <a href="#" id="abaconsultafuncionario" name="abaconsultafuncionario"onclick="abaconsultafuncionario('viewConsultarFuncionario.php')"><div class="abrirAbaCadastro"><img src="../Imagens/add.png"alt=""></div></a>


            <div id="cadastroFuncionario" class="conteudoCadastroFuncionario">
             <div class="dadosFunc">
               <div class="cadastroFuncionario">
                <form action="#" method="post">
                  <p class="maiorInput">
                    <label>Nome Completo <sub>*</sub></label>
                    <input type="text" placeholder="Digite o Nome" name="nomefunc" id="nomefunc" class="regular-input-text">
                  </p>
                  
                  <p>
                    <label>RG <sub>*</sub></label>
                    <input type="text" placeholder="ex. 00.000.000-0" name="rgfunc" maxlength="13" id="rgfunc" class="regular-input-text">
                  </p>
                  
                  <p>
                    <label>CPF <sub>*</sub>&nbsp;&nbsp;&nbsp;<span id="cpfResponse" class="cpfLabel"></span></label>
                    <input type="text" onkeyup="cpfCheck(this)"  placeholder="ex. 000.000.000-0" id="cpffunc" class="regular-input-text" maxlength="14"  onkeydown="javascript: fMasc( this, mCPF );">
                  </p>
                  
                  
                  <!--Label do CPF-->
                  
                  <!-- FIM Label do CPF-->
                  
                  <p>
                    <label>CEP <sub>*</sub></label>
                    <input type="text" placeholder="00000-000" name="cepfunc" maxlength="9" id="cepfunc" class="regular-input-text" onblur="pesquisacep(this.value);">
                  </p>
                  
                  <p>
                    <label>Cidade <sub>*</sub></label>
                    <input type="text" placeholder="" name="cidadefunc" id="cidadefunc" class="regular-input-text">
                  </p>
                  
                  <p class="maiorInput">
                    <label>Endereço <sub>*</sub></label>
                    <input type="text" placeholder="ex. Av, Rua, Estrada" name="logradourofunc" id="logradourofunc" class="regular-input-text">
                  </p>
                  
                  <p>
                    <label>Número <sub>*</sub></label>
                    <input type="text" placeholder="" name="numeroCasafunc" id="numeroCasafunc" class="regular-input-text">
                  </p>
                  
                  <p>
                    <label>Complemento <sub class="subBranco">*</sub></label>
                    <input type="text" placeholder="ex. Bloco H" name="complementofunc" id="complementofunc" class="regular-input-text">
                  </p>
                  

                  
                  <p>
                    <label>E-mail <sub>*</sub></label>
                    <input type="text" placeholder="ex. Aline@gmail.com" name="emailfunc" id="emailfunc" class="regular-input-text">
                  </p>
                  


                  <?php
                  include_once("..\Controller\ControllerTipoUsuario.php");
    // Instancia a classe ControllerTipoUsuario
                  $controllerTipoUsuario = new ControllerTipoUsuario();
    // Recebe o retorno do método listarTipoUsuario
                  $listaTiposUsuario = $controllerTipoUsuario->consultarTipoUsuarioFuncionario();

    // Inclui o select com os tipos de usuário na página

                  echo "<p>";
                  echo "<label>Selecione o Tipo do Usuário:</label>";
                  echo "<select class='select-regular' name='tipoUsuario' id='tipoUsuario'>";     
                  foreach ($listaTiposUsuario as $obj) {
                    echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";   
                  }
                  echo "</select>";
                  
                  echo "</p>";

                  ?>
                  
                  <?php
                  include_once '../Controller/CargoCRUD.php';
                  
                  
                //instancia a classe crud
                  $list = new CargoCRUD();
            //cria um array
                  $listagem = array();
            //instancia um novo funcionario
                  $cargo = new Cargo();

            //o array recebe o retorno do metodo listar funcionario
                  $listagem = $list->ListarCargos();

            //o funcionario recebe a lista de funcionarios
                  $cargo = $listagem;
                  
                  
            //cria um foreach passando pela lista de funcionarios
                  echo("<fieldset class='maiorInput'>");
                  echo("<legend>Cargo(s) do funcionário</legend>");
                  foreach ($cargo as $obj){
                    echo("<nobr><input class='checkbox-regular' type='checkbox' id='ckbCargos' name='ckbCargos' value='".$obj->getCodigo()."'> ".$obj->getNome()."</nobr>");
                  }
                  echo("</fieldset>");
                  ?>

                  <p class="maiorInput">
                    <input class="btnProxPasso" type="button" value="Cadastrar" onclick="carregaFuncionario(); ">
                  </p>
                </form>


                <div id="tabelafunc">
                  <?php //include_once("viewConsultarFuncionario.php"); ?>
                </div>

              </div>
            </div>
          </div>
          <script type="text/javascript" language="javascript">

            function abaconsultafuncionario(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          }
          function carregaFuncionario()
          {
            if(document.getElementById("nomefunc").value != "" &&
             document.getElementById("rgfunc").value != "" &&
             document.getElementById("cpffunc").value != "" &&
             document.getElementById("logradourofunc").value != "" &&
             document.getElementById("numeroCasafunc").value != "" &&
             document.getElementById("cepfunc").value != "" &&
             document.getElementById("cidadefunc").value != "" && document.getElementById("emailfunc").value != ""){
              
              var tipouser = document.getElementById("tipoUsuario").value;
            var arr = [];

            $("input:checkbox[name=ckbCargos]:checked").each(function(){
              arr.push($(this).val());
            });

            
            $.ajax({
              asyn: false,
              type: "POST",
              url: "CorreioFuncionario.php",
              data:{
                nome: $('#nomefunc').val(),
                rg: $('#rgfunc').val(),
                cpf: $('#cpffunc').val(),
                logradouro: $('#logradourofunc').val(),
                complemento: $('#complementofunc').val(),
                ncasa: $('#numeroCasafunc').val(),
                cep: $('#cepfunc').val(),
                cidade: $('#cidadefunc').val(),
                email: $('#emailfunc').val(),
                cargos: arr,
                tipo: tipouser

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
     <script type="text/javascript" src="../js/EventosdosAlerts.js"></script>

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

  <?php
  include_once("../rod.php");
  ?>