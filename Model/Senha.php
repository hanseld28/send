<?php

class Senha{
    
    
    // Para chamar a função: echo ‘Sua senha é ‘.gerarSenha(10,8).”;
    
    
    function gerarSenha($tamanho, $forca) {
    
	$vogais = '23456789';
	$consoantes = 'bdghjmnpqrstvz';
	if ($forca >= 1) {
		$consoantes .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($forca >= 2) {
		$vogais .= "AEUY";
	}
	if ($forca >= 4) {
		$consoantes .= '23456789';
	}
	if ($forca >= 8 ) {
		$vogais .= '@#$%';
	}
 
	$senha = '';
	$alt = time() % 2;
	for ($i = 0; $i < $tamanho; $i++) {
		if ($alt == 1) {
			$senha .= $consoantes[(rand() % strlen($consoantes))];
			$alt = 0;
		} else {
			$senha .= $vogais[(rand() % strlen($vogais))];
			$alt = 1;
		}
	}
	return $senha;
}
    
}




?>