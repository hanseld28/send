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
		<div class="tituloCadastros"> <h1> Editar Prontuário </h1></div>

		<form method="post" action="#">
			<br>
			<div class="fonte"><p>Aluno</p></div>
			<select name="selectAlunoProntuario">
				<option value="Aluno1">Aluno1</option>
				<option value="Aluno2">Aluno2</option>
			</select>

			<br>
			<div class="fonte"><p>Caractersticas de saúde</p></div>
			<select name="selectCaracteristicaSaude">
				<option value="Caracteristica1">Caracteristica 1</option>
				<option value="Caracteristica2">Caracteristica 2</option>
			</select>


			<br>
			<div class="fonte"><p>Ficha de declaração de saúde</p></div>
			<select name="selectFichaDeclaracaoSaude">
				<option value="FichaDeclaracaoSaude1">Ficha de declaração de saúde 1</option>
				<option value="FichaDeclaracaoSaude2">Ficha de declaração de saúde 2</option>
			</select>


			<br>
			<div class="fonte"><p>Grau escolar</p></div>
			<select name="selectGrauEscolar">
				<option value="GrauEscolar1">Grau escolar 1</option>
				<option value="GrauEscolar2">Grau escolar 2</option>
			</select>
			<input type='submit' class="botao" value='Editar'>
		</form>
	</div>
</div>


<?php
include_once("../rod.php");
?>