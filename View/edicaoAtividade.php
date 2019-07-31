<?php
	include_once("../cab.php");
?>
<?php
	include_once("verificaUsuarioLogado.php");
?>
<div class="painelFormEdit">
                         <div class="iconsCrudDemaisCad" id="opCrud">
  <ul class="fecharEdicao">
    <li><a href="#" id="sairTEFunc"><img src="imagens/sair.png"></a></li>   
</ul>
</div>
	<div class="fundoEdit">
	
		<div class="tituloCadastros"><h1>Editar Atividade Extra Curricular</h1></div>

		<form method="post" action="#">
			<div class="caixaTexto">
				<input type='text' name='txtAtividadeExtraCurricular' id='txtAtividadeExtraCurricular' placeholder="Descrição">
			</div>
			<input type='submit' class="botao" value='Editar'>
		</form>
	</div>
</div>

<?php
include_once("../rod.php");
?>