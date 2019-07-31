<?php
	include_once("../cab.php");
?>
<?php
	include_once("verificaUsuarioLogado.php");
?>
<!-- Edição do cargo-->
<div class="painelFormEdit">
                         <div class="iconsCrudDemaisCad" id="opCrud">
  <ul class="fecharEdicao">
    <li><a href="#" id="sairTEFunc"><img src="imagens/sair.png"></a></li>   
</ul>
</div>

	<div class="fundoEdit">
		<div class="tituloCadastros"><h1>Editar Cronograma</h1></div>

		<form method="post" action="#">

			<div class="caixaTexto">
				<input type='text' name='txtCronograma' id='txtCronograma' placeholder="Descrição">
			</div>

			<p>Turma</p>
			<select name="selectCronogramaTurma" size="5">
				<option value="Turma1">Whooo</option>
				<option value="Turma2">Whoooo2</option>
			</select>

			<br>  

			<input type='submit' class="botao" value='Editar'>
		</form>
	</div>
</div>


<?php
	include_once("../rod.php");
?>