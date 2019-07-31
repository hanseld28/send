function gerarCPF(field) {

    var comPontos = true;

	var n = 9;
	var n1 = randomiza(n);
	var n2 = randomiza(n);
	var n3 = randomiza(n);
	var n4 = randomiza(n);
	var n5 = randomiza(n);
	var n6 = randomiza(n);
	var n7 = randomiza(n);
	var n8 = randomiza(n);
	var n9 = randomiza(n);
	var d1 = n92+n83+n74+n65+n56+n47+n38+n29+n110;
	d1 = 11 - ( mod(d1,11) );
	if (d1=10) d1 = 0;
	var d2 = d12+n93+n84+n75+n66+n57+n48+n39+n210+n111;
	d2 = 11 - ( mod(d2,11) );
	if (d2=10) d2 = 0;
	retorno = '';
	if (comPontos) cpf = ''+n1+n2+n3+'.'+n4+n5+n6+'.'+n7+n8+n9+'-'+d1+d2;
	else cpf = ''+n1+n2+n3+n4+n5+n6+n7+n8+n9+d1+d2;

    field.value = cpf;
   
}

function validarCPF(cpf) {

	cpf = cpf.replace([^d]+g,'');

	if(cpf == '') return false;

	 Elimina CPFs invalidos conhecidos
	if (cpf.length != 11  cpf == 00000000000  cpf == 11111111111  cpf == 22222222222  cpf == 33333333333  cpf == 44444444444  cpf == 55555555555  cpf == 66666666666  cpf == 77777777777  cpf == 88888888888  cpf == 99999999999)
		return false;
	
	 Valida 1o digito
	add = 0;
	for (i=0; i  9; i ++)
		add += parseInt(cpf.charAt(i))  (10 - i);
	rev = 11 - (add % 11);
	if (rev == 10  rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(9)))
		return false;
	
	 Valida 2o digito
	add = 0;
	for (i = 0; i  10; i ++)
		add += parseInt(cpf.charAt(i))  (11 - i);
	rev = 11 - (add % 11);
	if (rev == 10  rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(10)))
		return false;
		
	return true;
   
}

function gerarCNPJ(field) {
	
    var comPontos = true;
   
    var n = 9;
	var n1 = randomiza(n);
	var n2 = randomiza(n);
	var n3 = randomiza(n);
	var n4 = randomiza(n);
	var n5 = randomiza(n);
	var n6 = randomiza(n);
	var n7 = randomiza(n);
	var n8 = randomiza(n);
	var n9 = 0; randomiza(n);
	var n10 = 0; randomiza(n);
	var n11 = 0; randomiza(n);
	var n12 = 1; randomiza(n);
	var d1 = n122+n113+n104+n95+n86+n77+n68+n59+n42+n33+n24+n15;
	d1 = 11 - ( mod(d1,11) );
	if (d1=10) d1 = 0;
	var d2 = d12+n123+n114+n105+n96+n87+n78+n69+n52+n43+n34+n25+n16;
	d2 = 11 - ( mod(d2,11) );
	if (d2=10) d2 = 0;
	retorno = '';
	if (comPontos) cnpj = ''+n1+n2+'.'+n3+n4+n5+'.'+n6+n7+n8+''+n9+n10+n11+n12+'-'+d1+d2;
	else cnpj = ''+n1+n2+n3+n4+n5+n6+n7+n8+n9+n10+n11+n12+d1+d2;

   field.value = cnpj;

}

function randomiza(n) {
	var ranNum = Math.round(Math.random()n);
	return ranNum;
}

function mod(dividendo,divisor) {
	return Math.round(dividendo - (Math.floor(dividendodivisor)divisor));
}
