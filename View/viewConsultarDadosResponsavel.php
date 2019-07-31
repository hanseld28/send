<?php
include_once("verificaUsuarioLogado.php");
include_once("../Controller/ResponsavelCRUD.php");
include_once("../Controller/AlunoCRUD.php");
include_once("../Model/Responsavel.php");
include_once("../Model/Aluno.php");
include_once("../Controller/ControllerUsuario.php");
include_once("../Model/Usuario.php");

if (!isset($_SESSION)) 
{
    session_start();
}
?>

<?php

$aluno = new Aluno(); 

$codUsuario = (isset($_SESSION["codUsuario"])) ? intval($_SESSION["codUsuario"]) : null;

if (!is_null($codUsuario))
{
    $usuario = new Usuario();
    $crud = new ControllerUsuario();
    $usuario = $crud->preencherUsuario($codUsuario);
    
    $resp = new Responsavel();
    
    $crud = new ResponsavelCRUD();
    $resp = $crud->ConsultaDadosResponsavel($codUsuario);
    
    
    $codResponsavel = $resp->getCodigo();
    $_SESSION['resp'] = $codResponsavel;
    $nome = $resp->getNome();
    $cpf = $resp->getCpf();
    $rg = $resp->getRg();
    $endTrabalho = $resp->getEnderecotrabalho();
    $telefone = $resp->getTelefone();
    $celular = $resp->getCelular();
    $telTrabalho = $resp->getTelefonetrabalho();
    $grauParentesco = $resp->getGrauparentesco(); 
    $foto = $resp->getFoto(); 
    
    $crud2 = new AlunoCRUD();
    $resultado = $crud2->ConsultaDadosAluno($codResponsavel);
    $aluno = $resultado;
}


?>
<div class="visualizarDadosResponsavel">

    <div class="topoTelaVisualizarPerfilResponsavel">
        
        <a class="iconeRetornoAba" href="#" onclick="carregaPainelResponsavel()">
         
         <img class="iconSetaRetorno" src="../Imagens/iconeDeRePerfilResp.png">
         
     </a>
     
     <div class="iconePerfilElabel">
         
       
        
        <h1 class="lblPerfilResponsavelTela"> <img class="iconePerfilResponsavelTela" src="../Imagens/iconePerfilResponsavelTela.png">Perfil</h1>
    </div>

</div>

<div class="conteudoTelaVisualizarPerfilResponsavel">

    <div class="menuTopoTelaVisualizarPerfilResponsavel">

        <a class="btnMeuPerfilResponsavel" id="" href="#" onclick="carregaViewPerfil()"><label class="lblMeuPerfilResp"><img src="../Imagens/user-silhouette(2).png" alt="">Meu perfil</label></a>
        <a class="btnAlterarFotoResponsavel" href="#" onclick="carregaViewAlterarSenha(<?php echo($codUsuario); ?>)"><label class="lblAltFoResp"><img src="../Imagens/lock.png" alt="">Alterar senha</label></a>

    </div> 

    <div class="conteudoPerfilFotoEsenhaResponsavel" id="conteudoPerfilResponsavel">
        
        <div class="painelMeuPerfilResponsavel">

            <div class="fundoMeuPerfilResponsavel">
                 
                    <fieldset class='localFotoDoResponsavelElogin' id='fotoPerfilDoresponsavel' name='fotoPerfilDoresponsavel'>
                      <?php
                        echo "<img class='iconFotoResponsavelPerfil' src='../fotos/".$foto."' id='fotoPerfilDoresponsavel'>";
                        ?>
                   <!--  <legend class=""><p><?php echo($usuario->getLogin());?></p></legend> -->
                    </fieldset>
               
                
                <div class="divQueDivideAfotoDasInformacoes"></div>
                
                <div class="localInformacoesPerfilResponsavel">
                 
                 <div class="info1">
                  
                  <label class="lblNomeResponsavelPerfil"><?php echo($nome);?></label>
                  
                  <label class="lbltLogin">Login:<label class="lblLoginRespPerfil"><?php echo($usuario->getLogin());?></label></label>
                  
                  <label class="lbltCpf">CPF:<label class="lblCpfRespPerfil"><?php echo($cpf);?></label></label>
                  
                  <label class="lbltEndereco">RG:<label class="lblEndRespPerfil"><?php echo($rg);?></label>
              </label>
              
              <label class="lbltComplemento">End. Trabalho:<label class="lblCompRespPerfil"><?php echo($endTrabalho);?></label></label>
              
          </div>
          
          <div class="info2">
              
              <label class="lbltNum">Telefone:<label class="lblNumRespPerfil"><?php echo($telefone);?></label></label>
              
              <label class="lbltCep">Tel. Trabalho: <label class="lblCepRespPerfil"><?php echo($telTrabalho);?></label></label>
              
              <label class="lbltCidade">Celular: <label class="lblCidadeRespPerfil"><?php echo($celular);?></label></label>
              
              
          </div>
          
      </div>

  </div>

</div>

</div>

</div>

</div>

<script type="text/javascript">
    $(".btnMeuPerfilResponsavel").on("click", function(){
        $(".btnMeuPerfilResponsavel").css('background-color','#fff');
        $(".btnAlterarFotoResponsavel").css('background-color','transparent');
    });
    $(".btnAlterarFotoResponsavel").on("click", function(){
        $(".btnMeuPerfilResponsavel").css('background-color','transparent');
        $(".btnAlterarFotoResponsavel").css('background-color','#fff');
    });
</script>

<script type="text/javascript">
    
    function carregaViewPerfil()
    {
        $("#painel").load("viewConsultarDadosResponsavel.php");
    }

    function carregaViewAlterarSenha(cod_usuario)
    {
        $.ajax({
            asyn: false,
            url: "viewAlterarSenhaResponsavel.php",
            dataType: "html", 
            type: "POST",
            data: { codUsuario: cod_usuario },
            success: function(data)
            {
                $("#conteudoPerfilResponsavel").html(data);
            }
        }); 
    }

</script>