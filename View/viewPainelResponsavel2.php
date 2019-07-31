<?php
	include_once("..\cab.php");
	session_start();

?>	
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEND - Agenda Online</title>
    <link rel="stylesheet" href="../Estilos/Estilos.css">
    <link rel="stylesheet" href="../Estilos/EstiloForms.css">
    <!--<script src="../Js/ChamadaDasForms.js"></script>-->
    <script type="../text/javascript" src="Js/jquery-3.3.1.js.js"></script>
</head>

<body >

    <input type="checkbox" id="btn-menu-lateral">
    <label for="btn-menu-lateral">&#9776;</label>
    <div class="balao" id="balao">

        <img src="../Imagens/recommended.png" alt="">
        <script LANGUAGE="JavaScript">
            d = new Date();
            hour = d.getHours();
            if (hour < 5) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Noite!</p>");
            } else
            if (hour < 8) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Dia!</p>");
            } else
            if (hour < 12) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Bom Dia!</p>");
            } else
            if (hour < 18) {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Tarde!</p>");
            } else {
                document.write("<p>Olá, Seja Bem-vindo e tenha uma Boa Noite!</p>");
            }
        </script>
        
        
			<?php
				echo "<h3>";
				echo "<a href='#''>"; 
				if(isset($_SESSION["statusUsuario"])): 
					if($_SESSION["statusUsuario"]):
						echo "Status do usuário: <b>Online</b>";
					else:
						echo "Status do usuário: <b>Offline</b>";
					endif;
				endif; 
				echo "</a>"; 
				echo " ------------------------------------------------------------------------------------------------------------------------------------ ";
				echo "<a href='logout.php'>Sair</a>";
				echo "</h3>";
			?>	
		
    </div>
    
<script>

    function mensagemBoasVindas(){
        $('#balao').fadeIn(2000); 
        $('#balao').delay(2200);
        $('#balao').fadeOut(1000);
    }

    </script>
    
    
    <nav id="menu-cima">
        <ul class="icones-menu-cima">
            <li class="perfil-usuario"><a href="#"><img src="../Imagens/user%20(1).png" alt="Icone-User"></a></li>
            <li><a href="#"><img src="../Imagens/alarm%20(1).png" alt="Icone-Notificacao"></a></li>
            <li><a href="logout.php"><img src="../Imagens/logout%20(1).png" alt="Icone-Sair"></a></li>
        </ul>
    </nav>

    <aside id="logo">
        <h1>.Send</h1>
    </aside>

    <section id="menu-lateral">
        <div class="viewPerfil">
            <div class="iconePerfil">
                <img src="../Imagens/user%20(5).png" alt="">
                <h1><?php echo($_SESSION["nomeUsuario"]); ?></h1>
                <div class="traco"></div>
                <h2>Administrador</h2>
            </div>
        </div>
        <ul class="icones-menu-lateral">
            
            <li id="btnResponsavel"><a  href="#" id="resp" name="resp" onclick="mostrapainelresponsavel('')"><span><img class="imgFunc" src="../Imagens/funcionario.png" alt=""></span><p>Meus Dados</p></a></li>
            
            <li id="btnCadastroAluno"><a  href="#" id="aluno" name="aluno" onclick="mostrapainelalunos('viewConsultarAlunosDoResponsavel.php')" ><span><img class="imgAluno" src="../Imagens/female-graduate-student.png" alt=""></span><p>Filho(s)</p></a></li>
            
    
            <li><a href="#"><span><img class="imgContato" src="../Imagens/telephone.png" alt=""></span><p>Contato</p></a></li>
            <li><a href="#"><span><img class="imgInfo" src="../Imagens/info-button.png" alt=""></span><p>Informação</p></a></li>
            <li><a href="#"><span><img class="imgAjuda"src="../Imagens/question-mark.png" alt=""></span><p>Ajuda</p></a></li>
        </ul>
        
        <script type="text/javascript" language="javascript">
            
            
                function mostrapainelalunos(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
                };
            
                function mostrapainelresponsavel(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
                };
            
        </script>
        
        

        <footer>
            <p>Polaris &copy; 2018</p>
        </footer>
    </section>
        
        
        
            <div class="painelFundo">
   
                <div class="painelAbas" id="painelAbas">
                  Painel do Responsável
                   
                     
                </div>
                
                
            </div>
            

<?php
	include_once("../rod.php");
?>
