<?php 
    include_once("verificaUsuarioLogado.php");
    //include_once("../Controller/ControllerComunicado.php");
    include_once("../Controller/ProfessorTurmaCRUD.php");

    if(!isset($_SESSION))
    {
        session_start();
    }

    $id_usuario = (isset($_SESSION['codUsuario'])) ? intval($_SESSION['codUsuario']) : null ;
    $nome_usuario = (isset($_SESSION['nomeUsuario'])) ? $_SESSION['nomeUsuario'] : null ;

    $id_turma = (isset($_POST['codigoturma'])) ? intval($_POST['codigoturma']) : null ;

    $controllerProfessor = new ProfessorTurmaCRUD();
    $nomeTurma = $controllerProfessor->consultarNomeTurma($id_turma); 

?>

<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

<label class="lblNaoHaComunicados">Não há ainda comunicados para esta turma</label>
<div class="caixaComunicado">
    <div class="caixa1">
        <label class="lblTituloComunicado">
          Turma: 
          <label id="lblTurmaComunicado" class="lblTurmaComunicado">
            <?php

              echo($nomeTurma);

            ?>
            </label>

        </label>
    </div>
    <div class="caixaAssunto">
       <label>Assunto:</label>
        <input class="inputAssunto" placeholder="Assunto" id="txtAssunto" type="text">
    </div>
    <div class="caixa2">
        <label class="lblProfessorComunicado">
          Professor(a): 
          <?php
            echo("<label id='lblProfessorComunicado' value='{$id_usuario}'>");
            echo ((!is_null($nome_usuario)) ? $nome_usuario : "--------"); 
          ?> 
          
        </label>
    </div>
    <textarea id="txtComunicado" placeholder="Digite aqui um comunicado..." class="taComunicado"></textarea>

    <div id="beforeSend" style="margin-top: 20px; margin-left: 0; position: absolute;"></div>

    <button class="btnEnviarComunicado" onclick="enviar_comunicado(<?php echo($id_turma); ?>)">Enviar</button>
</div>