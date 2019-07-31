//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo//
$(document).ready(function(){		
	$('#txNome').keyup(function(event){				
		$('form').submit(function(){
			var dados = $(this).serialize();

			$.ajax({
				url:'../Pesquisa/processaAluno.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultAluno').empty().html(data);
				}				
			});
			return false;
		});

		$('form').trigger('submit');			
	});		
});

//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo//
$(document).ready(function(){		
	$('#txFunc').keyup(function(event){				
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/processaFunc.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultFunc').empty().html(data);
				}					
			});
			return false;
		});

		$('form').trigger('submit');			
	});		
});
	//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
	$(document).ready(function(){		
		$('#txResp').keyup(function(event){				
			$('form').submit(function(){
				var dados = $(this).serialize();
				
				$.ajax({

					url:'../Pesquisa/processaResp.php',
					type: 'POST',
					dataType: 'html',
					data: dados,
					success:function(data){
						$('#div-resultResp').empty().html(data);
					}					
				});
				return false;
			});

			$('form').trigger('submit');			
		});		
	});
			//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
			$(document).ready(function(){		
				$('#txUser').keyup(function(event){				
					$('form').submit(function(){
						var dados = $(this).serialize();
						
						$.ajax({
		
							url:'../Pesquisa/processaUser.php',
							type: 'POST',
							dataType: 'html',
							data: dados,
							success:function(data){
								$('#div-resultUser').empty().html(data);
							}					
						});
						return false;
					});

					$('form').trigger('submit');			
				});		
			});
//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
						$(document).ready(function(){		
							$('#txTurma').keyup(function(event){				
								$('form').submit(function(){
									var dados = $(this).serialize();

									$.ajax({
					
										url:'../Pesquisa/processaTurma.php',
										type: 'POST',
										dataType: 'html',
										data: dados,
										success:function(data){
											$('#div-resultTurma').empty().html(data);
										}					
									});
									return false;
								});

								$('form').trigger('submit');			
							});		
						});
//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
$(document).ready(function(){		
	$('#txMatricula').keyup(function(event){				
		$('form').submit(function(){
			var dados = $(this).serialize();

			$.ajax({
				url:'../Pesquisa/processaMatricula.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultMatricula').empty().html(data);
				}					
			});
			return false;
		});

		$('form').trigger('submit');			
	});		
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){		
	$('#txAtividade').keyup(function(event){				
		$('form').submit(function(){
			var dados = $(this).serialize();

			$.ajax({
				url:'../Pesquisa/processaAtividadeExtraCurricular.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultAtividade').empty().html(data);
				}					
			});
			return false;
		});

		$('form').trigger('submit');			
	});		
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){		
	$('#txCaracteristicas').keyup(function(event){        
		$('form').submit(function(){
			var dados = $(this).serialize();

			$.ajax({
				url:'../Pesquisa/processaCaracteristicas.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-result').empty().html(data);
				}         
			});
			return false;
		});

		$('form').trigger('submit');      
	}); 
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){		
	$('#txCargo').keyup(function(event){                
		$('form').submit(function(){
			var dados = $(this).serialize();

			$.ajax({
				url:'../Pesquisa/processaCargo.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultCargo').empty().html(data);
				}                   
			});
			return false;
		});

		$('form').trigger('submit');            
	});
}); 
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){	
	$('#txGrauEscolar').keyup(function(event){        
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/processaGrauEscolar.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultGrau').empty().html(data);
				}         
			});
			return false;
		});

		$('form').trigger('submit');     
	});
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){
	$('#txItens').keyup(function(event){             
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/processaItens.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultItens').empty().html(data);
				}                   
			});
			return false;
		});

		$('form').trigger('submit');            
	});     
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){
	$('#txPeriodo').keyup(function(event){              
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/processaPeriodo.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultPeriodo').empty().html(data);
				}                   
			});
			return false;
		});

		$('form').trigger('submit');            
	});  

}); 
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
$(document).ready(function(){   
	$('#txProfTurma').keyup(function(event){       
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/processaProfTurma.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-resultProfTurma').empty().html(data);
				}         
			});
			return false;
		});

		$('form').trigger('submit');      
	});   
});

/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/	
$(document).ready(function(){       
	$('#txTipo').keyup(function(event){             
		$('form').submit(function(){
			var dados = $(this).serialize();
			
			$.ajax({
				url:'../Pesquisa/ProcessaTipoUsuario.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success:function(data){
					$('#div-result').empty().html(data);
				}                   
			});
			return false;
		});

		$('form').trigger('submit');            
	});     
});
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/	