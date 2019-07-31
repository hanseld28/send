<?php
include_once("..\cab.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEND - Agenda Online</title>
  <link rel="stylesheet" href="../Estilos/Estilos.css">
  <link rel="stylesheet" href="../Estilos/EstiloForms.css">
  <link rel="stylesheet" href="../Estilos/Responsividade.css">
  <link rel="stylesheet" href="../Estilos/EstiloAlert.css">
  <link rel="stylesheet" type="text/css" href="../Estilos/EstiloItensForms.css">
  <link rel="stylesheet" type="text/css" href="../Estilos/EstiloTabelas.css">
  <link rel="stylesheet" type="text/css" href="../Estilos/EstiloPaginacao.css">
  <!--<script src="../Js/ChamadaDasForms.js"></script>-->
  <script type="text/javascript" src="../js/jquery-3.3.1.js.js"></script>
  <script type="text/javascript" src="../js/EventosdosAlerts.js"></script>
  <link rel="stylesheet" href="../Estilos/EstilosCardsAdmin.css">
  <title></title>
</head>
<body>
  <div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

  <div class="cimaCadAux">
    <h1>Cadastros Auxiliares</h1>
    <div class="linhaCadAux">
      <a href="#" id="atividade" name="atividade" onclick="mostrapainelatividade('viewConsultarAtividadeExtraCurricular.php')">
        <div class="colunaCadAux">
          <div class="btnCadAuxAtividadeExtraCurricular">
           <img src="../Imagens/ImagensCadastrosAuxiliares/AtividadeExtraCurricular.png" id="atividadeExtraCurricularIMG" alt="">
           <p>Atividade Extra Curricular</p>      
         </div>
       </div>
     </a>


   <a href="#" id="rotinas" name="rotinas" onclick="mostrapainelcategoria('viewConsultarCard.php')">
    <div class="colunaCadAux">
      <div class="btnCadAuxCards">
       <img src="../Imagens/ImagensCadastrosAuxiliares/Rotina.png" alt="">
       <p>Categorias da Rotina</p>
     </div>
   </div>
 </a>

 <a href="#" id="cargo" name="cargo" onclick="mostrapainelcargo('viewConsultarCargoFuncionario.php')">
  <div class="colunaCadAux">
    <div class="btnCadAuxCargo">
     <img src="../Imagens/ImagensCadastrosAuxiliares/Cargo.png" alt="">
     <p>Cargo</p>
   </div> 
 </div>
</a>

<a href="#" id="grau" name="grau" onclick="mostrapainelgrau('viewConsultarGrauEscolar.php')">
 <div class="colunaCadAux">
   <div class="btnCadAuxGrauEscolar">
     <img src="../Imagens/ImagensCadastrosAuxiliares/Grau%20Escolar.png" alt="">
     <p>Grau Escolar</p>
   </div>  
 </div>
</a>

<a href="#" id="item" name="item" onclick="mostrapainelitem('viewConsultarItensCronograma.php')">
 <div class="colunaCadAux">
  <div class="btnCadAuxItensCronograma">
    <img src="../Imagens/ImagensCadastrosAuxiliares/ItensCronograma.png" alt="">
    <p> Itens do Cronograma</p>
  </div>
 </div>
</a>

<a href="#" id="periodo" name="periodo" onclick="mostrapainelperiodo('viewConsultarPeriodo.php')">
<div class="colunaCadAux">
  <div class="btnCadAuxPeriodo">
   <img src="../Imagens/ImagensCadastrosAuxiliares/Periodo.png" alt="">
   <p>Período</p>
 </div>
</div>
</a>

<a href="#" id="profTurma" name="profTurma" onclick="mostrapainelprofessorturma('viewConsultarProfessorTurma.php')">
<div class="colunaCadAux">
  <div class="btnCadAuxProfessorTurma">
    <img src="../Imagens/ImagensCadastrosAuxiliares/Professores%20Por%20Turma.png" alt="">
    <p>Professores por Turma</p>
  </div>
</div>
</a>

<a href="#" id="tipoUser" name="tipoUser" onclick="mostrapaineltipousuario('viewConsultarTipoUsuario.php')">
<div class="colunaCadAux">
  <div class="btnCadTipoUsuario">
   <img src="../Imagens/ImagensCadastrosAuxiliares/Tipo%20Usuario.png" alt="">
   <p>Tipo do Usuário</p>
 </div> 
</div>
</a>

<a href="#" id="turma" name="turma" onclick="mostrapainelturma('viewConsultarTurma.php')">
<div class="colunaCadAux">
 <div class="btnCadAuxTurma">
   <img src="../Imagens/ImagensCadastrosAuxiliares/Turma.png" alt="">
   <p>Turma</p>
 </div>  
 </div>  
</a>


</div> 
</div>
              <br>
                <br>
                 <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
              <br>
                <br>
                 <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>

                       
  <div class="painelCadAuxliar" id="painelCadAuxliar">

                <!--<a href="#">Pesquisar</a>
                <a href="#">Cadastrar</a>-->
   </div>

<script type="text/javascript" src="../js/FuncoesSimples.js"></script>
<script src="../js/FuncoesCardsAdmin.js" type="text/javascript"></script>
<script src="../js/Processa.js" type="text/javascript"></script>

</body>
</html>

<?php
include_once("../rod.php");
?>

