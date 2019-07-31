<?php
	include_once("../Controller/ControllerCard.php");
    include_once("../Controller/ControllerAlternativa.php");
?>    
<script src="../js/add-fields.js"></script>

	<h1>Cadastrao de Rotina</h1>

	 <form>
     
	     <div class="caixaTexto">
	       <input type='text' name='txtRotina' id='txtRotina'>
           <label>Descrição</label>
      	   </input>
     	 </div>
    	

     	<h3>Cards (Categorias)</h3>
     	<?php
			// Instancia a classe ControllerCard
			$controllerCard = new ControllerCard();
			// Instancia a classe ControllerAlternativa
			$controllerAlternativa = new ControllerAlternativa();

			// Recebe o retorno do método consultarCard
			$listaCards = $controllerCard->consultarCard();
			// Recebe o retorno do método consultarCard
			$listaAlternativas = $controllerAlternativa->consultarAlternativa();


			foreach ($listaCards as $obj) {
			    echo "<input type='checkbox' name='cards[]' value='{$obj->getId()}'><b>{$obj->getDescricao()}</b><br/>";

			    foreach ($listaAlternativas as $alternativa) {
			        echo "<input type='radio' name='altCard[][{$obj->getId()}]' value='{$alternativa->getId()}'>{$alternativa->getDescricao()}<br/>";
			    }
			}

     	?>		      	

     	<br/>
		
		
		<div class="input_fields_wrap">
			<h3>Ocorrências</h3>
			<div>
				<input type="text" name="ocorrencias[]"> <button class="add_field_button">Adicionar</button>
			</div>
		</div>	
		
		<br/>

		<input type='button' name='enviarRotina' value='Cadastrar' onclick="enviarRotina(<?php echo $codigoturma; ?>)">
 </form>