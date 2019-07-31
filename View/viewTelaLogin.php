<link rel="stylesheet" type="text/css" href="../Estilos/EstiloAlert.css">

<div id="modal">
    <div class="caixaDialogo" id="caixaDialogo">
     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="512px" height="512px">
      <g>
        <g>
          <path d="m40.5,61.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l18.9,18.9c0.8,0.8 1.8,1.2 2.9,1.2 0.1,0 0.1,0 0.2,0 1.1-0.1 2.2-0.6 3-1.5l47.3-56.7c1.4-1.7 1.2-4.3-0.5-5.8-1.7-1.4-4.3-1.2-5.8,0.5l-44.5,53.3-15.7-15.7z" fill="#91DC5A"/>
          <path d="m95.1,15.3c-23-14.4-52.5-11-71.7,8.2-22.6,22.6-22.6,59.5 7.10543e-15,82.1 11.3,11.3 26.2,17 41,17s29.7-5.7 41-17c19.3-19.3 22.6-48.9 8.1-71.9-1.2-1.9-3.7-2.5-5.6-1.3-1.9,1.2-2.5,3.7-1.3,5.6 12.5,19.8 9.6,45.2-7,61.8-19.4,19.4-51.1,19.4-70.5,0-19.4-19.4-19.4-51.1 0-70.5 16.6-16.5 41.9-19.4 61.7-7.1 1.9,1.2 4.4,0.6 5.6-1.3 1.2-1.9 0.6-4.4-1.3-5.6z" fill="#91DC5A"/>
      </g>
  </g>
</svg>
<div class="caixaDialogoCorpo" id="caixaDialogoCorpo">

</div>
<div class="caixaDialogoRodape" id="caixaDialogoRodape">
</div>
</div>
</div>



<div id="modalErro">
 <div class="caixaDialogoErro" id="caixaDialogoErro">    
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_2" x="0px" y="0px" viewBox="0 0 475.2 475.2" style="enable-background:new 0 0 475.2 475.2;" xml:space="preserve" width="512px" height="512px">
        <g>
            <g>
                <path d="M405.6,69.6C360.7,24.7,301.1,0,237.6,0s-123.1,24.7-168,69.6S0,174.1,0,237.6s24.7,123.1,69.6,168s104.5,69.6,168,69.6    s123.1-24.7,168-69.6s69.6-104.5,69.6-168S450.5,114.5,405.6,69.6z M386.5,386.5c-39.8,39.8-92.7,61.7-148.9,61.7    s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7,0-297.8C128.5,48.9,181.4,27,237.6,27s109.1,21.9,148.9,61.7    C468.6,170.8,468.6,304.4,386.5,386.5z" fill="#f70f39"/>
                <path d="M342.3,132.9c-5.3-5.3-13.8-5.3-19.1,0l-85.6,85.6L152,132.9c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1    l85.6,85.6l-85.6,85.6c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.6-85.6l85.6,85.6c2.6,2.6,6.1,4,9.5,4    c3.5,0,6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1l-85.4-85.6l85.6-85.6C347.6,146.7,347.6,138.2,342.3,132.9z" fill="#f70f39"/>
            </g>
        </g>
    </svg>
    
    <div class="caixaDialogoCorpoErro" id="caixaDialogoCorpoErro">

    </div>
    <div class="caixaDialogoRodapeErro" id="caixaDialogoRodapeErro">
    </div>
</div>
</div>

<?php

    include_once("..\DAO\Conexao.php");
    include_once("..\Controller\ControllerTipoUsuario.php");
    include_once("..\DAO\DaoTipoUsuario.php");
    include_once("..\Model\TipoUsuario.php");
    
    // Instancia a classe ControllerTipoUsuario
    $controllerTipoUsuario = new ControllerTipoUsuario();
    // Recebe o retorno do método listarTipoUsuario
    $listaTiposUsuario = $controllerTipoUsuario->consultarTipoUsuario();
    
?>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../Estilos/telaLogin.css">
    <script src="../js/jquery-3.3.1.js.js"></script>
    <script src="../js/jquery.1.8.3.min.js"></script>

    <style>
        html {
            background-image: url(../Imagens/ImagensTeladeLogin/FundoTelaInicial.jpg);
            background-size: cover;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="tudo">
       
        <form action="viewLoginUsuario.php" method="post" id="myF"> 
            
            <select name="tipoUsuario" id="options" onchange="optionCheck()">
            <?php
                echo "<option selected disabled>Entrar como...</option>";   
                foreach ($listaTiposUsuario as $obj) {
                    echo "<option value='{$obj->getId()}'>{$obj->getDescricao()}</option>";   
                }
            ?>
            </select>
            <div class="caixaInput">
                <img src="../Imagens/usuario.png" alt="">
                <input type="text" name="txtLogin" id="login" placeholder="Login" required="required">
            </div>

            <div class="caixaInput">
                <img src="../Imagens/cadeado.png" alt="">
                <input type="password" name="txtSenha" id="senha" placeholder="Senha" required="required">
            </div>
            
            <input type="submit" name="" value="Entrar">
        

        <a onclick="carregaInput('pageTrocaInput.php')">
            <p>Esqueceu a Senha?</p>
        </a>
        </form>

        <div class="caixaLogin" id="responsavel">
            
            <div class="marcaPagina">
                <div class="triangulo"></div>
            </div>
            

            <img class="iconeUsuario" src="../Imagens/ImagensTeladeLogin/IconeTelaLogin.png" alt="">

        </div>


        <div class="caixaLogin" id="professor">
            <img class="iconeUsuario" src="../Imagens/icon-professor-2.png" alt="">

        </div>

        <div class="caixaLogin" id="administrador">
            <img class="iconeUsuario" src="../Imagens/admin_icon.png" alt="">

        </div>
   
    </div>
    <script type="text/javascript">

        $("#options").on('change', function() {
            $('#caixaLogin').hide();
            $('#caixaLogin' + this.value).show();
        });

        function carregaInput(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#myF").load(pagina);
                };


    </script>
    <script type="text/javascript" src="../js/FuncoesSimples.js"></script>
</body>
</html>
