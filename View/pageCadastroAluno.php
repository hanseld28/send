<?php
include_once("../cab.php");
include_once("../Controller/ResponsavelCRUD.php");
include_once("unsetSessions.php");

$responsaveis = array();
$crudresp = new ResponsavelCRUD();
$responsaveis = $crudresp->ListarResponsavel();
?>

<script type="text/javascript">  
  $('#datanasc').mask('00/00/0000'); 
</script>

<script type="text/javascript">  
  $('#certidaoaluno').mask('000000 00 00 0000 000 000000 00'); 
</script>

<script type="text/javascript" src="../js/jquery-3.3.1.js.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>

<div class="cimaPesquisaAluno">
 <div class="passosCadastros">
  <ul class="barraProgresso">
    <li class="">Aluno</li>
    <li>Responsável</li>
    <li>Matrícula</li>
    <li>Prontuário</li>
    <li>Revisão</li>
  </ul>
</div>
<h1>Dados do Aluno</h1>
</div>

<a href="#" id="abaconsultaaluno" name="abaconsultaaluno"onclick="abaconsultaaluno('viewConsultarAluno.php')"><div class="abrirAbaCadastro"><img src="../Imagens/add.png"alt=""></div></a>

<a href="#" id="abaconsultaaluno" name="abaconsultaaluno" onclick="abaconsultaaluno('viewConsultarAluno.php')"><div class="abrirAbaCadastro"><img src="../Imagens/loupe.png"alt=""></div></a>

<script type="text/javascript" language="javascript">
  function abaconsultaaluno(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };

          function abaconsultaaluno(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };

        </script>


        <div id="painelCadAluno">

          <div class="conteudoDadosAluno">
            <div class="dadosAluno">
             <div class="cadastroAluno">

              <form method="post" action="CorreioAlunoResponsavel.php">
                
                <p class="maiorInput">
                 <label>Nome Completo <sub>*</sub></label>
                 <input type='text' name='nomealuno' id='nomealuno' placeholder="Digite o nome" class="regular-input-text">
               </p>
               
               <p>
                 <label>Data de Nascimento <sub>*</sub></label>
                 <input type='text' name='datanasc' id='datanasc' placeholder="ex. 00/00/0000" class="regular-input-text" onkeypress="mascaraData( this, event )" maxlength="10"> 
               </p> 

               <p>
                 <label>Sexo <sub>*</sub></label>
                 <select class='select-regular' name='sexoaluno' id='sexoaluno'>
                  <option value='sexo'>Sexo</option>
                  <option value='Feminino'>Feminino</option>
                  <option value='Masculino'>Masculino</option>
                  <option value='Outro'>Outro</option>
                </select>  
              </p>
              
              <p class="maiorInput">
                <label>Certidão de Nascimento <sub>*</sub></label>
                <input type='text' name='certidao' id='certidaoaluno' placeholder="ex. 000000 00 00 0000 0 00000 000 0000000 00" class="regular-input-text"> 
              </p>
              
              <p>
                <label>Nacionalidade <sub>*</sub></label>
                <input type='text' name='nacionalidade' id='nacionalidade' placeholder="" class="regular-input-text">
              </p>
              
              <p>
                <label>RG <sub>*</sub></label>
                <input type='text' name='rgaluno' maxlength="13" id='rgaluno' placeholder="ex. 00.000.000-0" class="regular-input-text">
              </p> 
              
              <p>
                <label>Cor/Raça <sub>*</sub></label>
                <select class='select-regular' name='corracaaluno' id='corracaaluno'>
                  <option value='Cor/Raça'>Cor/Raça</option>
                  <option value='Branco(a)'>Branco(a)</option>
                  <option value='Preto(a)'>Preto(a)</option>
                  <option value='Pardo(a)'>Pardo(a)</option>
                  <option value='Amarelo(a)'>Amarelo(a)</option>
                  <option value='Indígeno(a)'>Indígeno(a)</option>
                  <option value='Prefiro não identificar'>Prefiro não identificar</option>
                </select> 
              </p>
              

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="embrulho">
      <div class="conteudoDadosLocalizacao">
        <div class="dadosLocalizacao">
          <div class="cadastroLocalizacao">
            <h3>Dados de Localização:</h3>
            <form method="post" action="CorreioAlunoResponsavel.php">
             
              <p>
                <label>CEP <sub>*</sub></label>
                <input type='text' name='cepaluno' id='cepaluno' maxlength="9" placeholder="ex. 00000-000" class="regular-input-text" onblur="pesquisacep(this.value);">   
              </p>
              
              <p>
               <label>Cidade <sub>*</sub></label>
               <input type='text' name='cidadealuno' id='cidadealuno' placeholder="" class="regular-input-text">  
             </p>
             
             <p class="maiorInput">
               <label>Logradouro <sub>*</sub></label>
               <input type='text' name='logradouroaluno' id='logradouroaluno' placeholder="Logradouro" class="regular-input-text">  
             </p>
             
             <p>
              <label>Bairro <sub>*</sub></label>
              <input type='text' name='bairroaluno' id='bairroaluno' placeholder="Bairro" class="regular-input-text">   
            </p>
            
            <p>
              <label>Nº <sub>*</sub></label>
              <input type='text' name='numeroCasaaluno' id='numeroCasaaluno' placeholder="" class="regular-input-text">     
            </p>
            
            <p>
              <label>Complemento </label>
              <input type='text' name='complementoaluno' id='complementoaluno' placeholder="Complemento" class="regular-input-text"> 
            </p>



            
            <p class="maiorInput">
              <input class="btnProxPasso" type="button" value="Próximo Passo" onclick="carregaAluno(); scrollToTop();return false">  
            </p>
            
          </form>

        </div>
      </div>
    </div>
  </div>
  <form id="formulario" name="formulario" method="post" enctype="multipart/form-data" action="upload.php">
   <div class="fotoDePerfilAluno" id='visualizar'>
    <img src="../Imagens/iconeFotoAluno.png" alt="">
    <div class="btnEscolherImagem"><label for="imagem"><img src="../Imagens/add.png" alt=""></label></div>
  </div>   
  
  <input type="file" name="imagem" id="imagem" name="imagem" class="btnfotoAluno">
</form>


<script type="text/javascript">
 
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


 function carregaAluno() {

   if(document.getElementById("nomealuno").value   != "" &&
     document.getElementById("rgaluno").value   != ""&&
     document.getElementById("logradouroaluno").value   != ""&&
     document.getElementById("numeroCasaaluno").value   != "" &&
     document.getElementById("cepaluno").value   != ""&&
     document.getElementById("cidadealuno").value   != "" &&
     document.getElementById("datanasc").value   != "" &&
     document.getElementById("nacionalidade").value   != "" &&
     document.getElementById("certidaoaluno").value   != "" &&
     document.getElementById("bairroaluno").value   != "" &&
     document.getElementById("sexoaluno").value   != "" &&
     document.getElementById("cepaluno").value   != ""  ){

    var sexoaluno = document.getElementById("sexoaluno").value;
  var corracaaluno = document.getElementById("corracaaluno").value;

  var data = document.getElementById('datanasc').value;

  var objDate = new Date();
  objDate.setYear(data.split("/")[2]);
              objDate.setMonth(data.split("/")[1]  - 1);//- 1 pq em js é de 0 a 11 os meses
              objDate.setDate(data.split("/")[0]);

              if(objDate.getTime() > new Date().getTime()){
                AlertdeErro.render('<h1>A data de nascimento não pode ser maior que a data atual</h1>');
                document.getElementById('datanasc').focus();
                return false;

              }else if(objDate.getTime() == new Date().getTime()){

                AlertdeErro.render('<h1>A data de nascimento não pode ser igual a data atual</h1>');
                document.getElementById('datanasc').focus();
                return false;

              }

              $.ajax({
                asyn: false,
                type: "POST",
                url: "viewConsultarResponsavelMatricula.php",
                data: {

                  nomealuno: $('#nomealuno').val(),
                  sexoaluno: sexoaluno,
                  datanasc: $('#datanasc').val(),
                  nacionalidade: $('#nacionalidade').val(),
                  rgaluno: $('#rgaluno').val(),
                  corracaaluno: corracaaluno,
                  certidaoaluno: $('#certidaoaluno').val(),
                  imgaluno: $('#imgaluno').val(),
                  logradouro: $('#logradouroaluno').val(),
                  ncasa: $('#numeroCasaaluno').val(),
                  complemento: $('#complementoaluno').val(),
                  cep: $('#cepaluno').val(),
                  bairro: $('#bairroaluno').val(),
                  cidade: $('#cidadealuno').val(),


                },
                success: function(data) {
                  $('#painelAbas').html(data);
                }
              });
            }
            else{
              AlertdeErro.render('<h1>Preencha todos os campos!</h1>');
              
            }
          }

        </script>

        <!------------------------ Consulta aos Alunos -------------------------->

        <?php
        include_once("../rod.php");
        ?>

        <script type="text/javascript" >
          function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouroaluno').value=("");
        document.getElementById('cidadealuno').value=("");
        document.getElementById('bairroaluno').value=("");

      }

      function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradouroaluno').value=(conteudo.logradouro);
        document.getElementById('cidadealuno').value=(conteudo.localidade);
        document.getElementById('bairroaluno').value=(conteudo.bairro);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        AlertdeErro.render('<h1>CEP não encontrado</h1>');
        
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

          document.getElementById('cepaluno').value = cep.substring(0,5)
          +"-"
          +cep.substring(5);

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('logradouroaluno').value="...";
            document.getElementById('cidadealuno').value="...";
            document.getElementById('bairroaluno').value="...";

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

