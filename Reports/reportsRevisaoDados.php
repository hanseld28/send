<?php 
include_once("../MPDF/mpdf.php");
session_start();
$linhas_por_pagina = 10;
$posicao_da_linha = 0;
$linha_atual = 0;
$pagina_atual = 1;
$page_yes = true;
$total_registros = 0;
date_default_timezone_set('America/Sao_Paulo');



$pagina_atual = 1;

$total_registros = 1;

$tipo = $_SESSION['tipo']; 
$deficiencia = $_SESSION['deficiencia'];
$problema = $_SESSION['problema'];
$doenca = $_SESSION['doenca']; 
$tratamento = $_SESSION['tratamento'];
$alergia = $_SESSION['alergia'];
$medicacao = $_SESSION['medicacao']; 
$login = $_SESSION["loginMatricula"];
$senha = $_SESSION["senhaMatricula"];

if($deficiencia == "" || $deficiencia == ",0" || $deficiencia == "0"){
	$deficiencia = "Nenhuma";
}

if($problema == "" || $problema == ",0" || $problema == "0"){
	$problema = "Nenhum";
}

if($doenca == "" || $doenca == ",0" || $doenca == "0"){
	$doenca = "Nenhuma";
}

if($tratamento == "" || $tratamento == ",0" || $tratamento == "0"){
	$tratamento = "Nenhum";
}

if($alergia == "" || $alergia == ",0" || $alergia == "0"){
	$alergia = "Nenhuma";
}

if($medicacao == "" || $medicacao == ",0" || $medicacao == "0"){
	$medicacao = "Nenhuma";
}

$nome = $_SESSION["nomealuno"];
$data = $_SESSION["dataGeneric"];
$nacionalidade = $_SESSION["nacionalidade"];
$sexo = $_SESSION["sexo"];
$rg = $_SESSION["rgaluno"];
$cor = $_SESSION["cor"];
$certidao = $_SESSION["certidao"];
$logradouro = $_SESSION["logradouroaluno"];
$complemento = $_SESSION["complementoaluno"];
$num = $_SESSION["numcasaaluno"]; 
$cep = $_SESSION["cepaluno"];
$bairro = $_SESSION["bairro"];
$cidade = $_SESSION["cidadealuno"];

$datanascimentoresp = $_SESSION["datanasc"];
$nacionalidaderesp = $_SESSION["nacionalidaderesp"];
$rgresp = $_SESSION["rgresp"];
$cpfresp = $_SESSION["cpfresp"];
$profissaoresp = $_SESSION["profissaoresp"];
$logradourotrabalho = $_SESSION["logradourotrabalho"]; 
$telefoneresp = $_SESSION["telefoneresp"];
$celularresp = $_SESSION["celularresp"];
$telefonetrabalho = $_SESSION["telefonetrabalho"];
$nomeresp = $_SESSION["nomeresp"];
$sexoresponsavel = $_SESSION["sexoresponsavel"]; 
$grauresp = $_SESSION["grauresp"];
$emailresp = $_SESSION["emailresp"];

$pessoa1 = $_SESSION['pessoa1'];
$telefone1 = $_SESSION['telefone1'];
$pessoa2 = $_SESSION['pessoa2']; 
$telefone2 = $_SESSION['telefone2']; 
$pessoa3 = $_SESSION['pessoa3']; 
$telefone3 = $_SESSION['telefone3'];

$html = "
<div class='logo'>
<img src='../Imagens/curumim_logo.png'>
</div>
<h1>Escola de Educação Infantil Papa-Capim Ltda.</h1>
<h1>Dados do Aluno e Responsável</h1>
<b>Login Gerado:</b>
<br>
<label>Login:&nbsp; {$login} </label>&nbsp;&nbsp;&nbsp;
<label>Senha:&nbsp; {$senha} </label>
<br>
<br>
<b> Dados do Aluno:</b>
<br>
<label>Nome Completo:&nbsp; $nome</label>&nbsp;&nbsp;&nbsp;
<label>Data de Nascimento:&nbsp; $data</label>
<br>
<label>Sexo:&nbsp; $sexo</label>&nbsp;&nbsp;&nbsp;
<label>Nacionalidade:&nbsp; $nacionalidade</label>
<br>
<label>RG:&nbsp; $rg</label>&nbsp;&nbsp;&nbsp;
<label>Cor/Raça:&nbsp; $cor</label>
<br>
<label>Certidão de Nascimento:&nbsp;$certidao</label>
<br>
<br>

<b>Dados de Localização:</b>
<br>
<label>CEP:&nbsp; $cep</label>&nbsp;&nbsp;&nbsp;
<label>Cidade:&nbsp;$cidade</label>
<br>
<label>Logradouro:&nbsp; $logradouro</label>&nbsp;&nbsp;&nbsp;
<label>Bairro:&nbsp; $bairro</label>&nbsp;&nbsp;&nbsp;
<label>Nº:&nbsp; $num</label>
<br>
<label>Complemento:&nbsp; $complemento</label>
<br>
<br>
<b>Prontuário:</b>
<br>
<label>Tipo Sanguíneo:&nbsp; $tipo</label>&nbsp;&nbsp;&nbsp;
<label>Deficiência(as):&nbsp;$deficiencia</label>
<br>
<label>Problemas de Saúde:&nbsp; $problema</label>&nbsp;&nbsp;&nbsp;
<label>Doenças Contagiosas:&nbsp; $doenca</label>
<br>
<label>Tratamento:&nbsp; $tratamento</label>&nbsp;&nbsp;&nbsp;
<label class='w'>Alergia(as):&nbsp; $alergia</label>
<br>
<label>Medicação:&nbsp; $medicacao</label>

</p>

<p>
<b>Dados do Responsável:</b>
<br>
<label>Nome Completo:&nbsp; $nomeresp</label>&nbsp;&nbsp;&nbsp;
<label>Sexo:&nbsp; $sexoresponsavel</label>
<br>
<label>Data de Nascimento:&nbsp; $datanascimentoresp</label>&nbsp;&nbsp;&nbsp;
<label>Nacionalidade:&nbsp; $nacionalidaderesp</label>
<br>
<label>RG:&nbsp; $rgresp</label>&nbsp;&nbsp;&nbsp;
<label>CPF:&nbsp; $cpfresp</label>
<br>
<label>Parentesco:&nbsp; $grauresp</label>&nbsp;&nbsp;&nbsp;
<label>Profissão:&nbsp; $profissaoresp</label>
<br>
<label>E-mail:&nbsp; $emailresp</label>&nbsp;&nbsp;&nbsp;
<label>Telefone Fixo:&nbsp; $telefoneresp</label>
<br>
<label>Celular:&nbsp; $celularresp</label>&nbsp;&nbsp;&nbsp;
<label>Telefone Trabalho:&nbsp; $telefonetrabalho</label><br>
<label>Logradouro Trabalho:&nbsp;$logradourotrabalho</label>
<br>
<br>

<b>Em caso de Emergência contatar:</b>
<br>
<b>Responsável 1:</b>
<label>Nome Completo:&nbsp;&nbsp;&nbsp; $pessoa1</label>
<label>Telefone:&nbsp;&nbsp;&nbsp; $telefone1</label>
<br>
<b>Responsável 2:</b>
<label>Nome Completo:&nbsp;&nbsp;&nbsp; $pessoa2</label>
<label>Telefone:&nbsp;&nbsp;&nbsp; $telefone2</label>
<br>
<b>Responsável 3:</b>
<label>Nome Completo:&nbsp;&nbsp;&nbsp; $pessoa3</label>
<label>Telefone:&nbsp;&nbsp;&nbsp; $telefone3</label>

</p>


</div>
</div>
</div>

</div>";


$mpdf = new mPDF(); 



$html .= "<div class='dadosCadastros'><p>Número de Registros por página: {$linhas_por_pagina} | Total de registros: {$total_registros}</p></div> 
<br>";

$rodape = '{DATE d/m/Y H:i:s}|{PAGENO}/{nb}| SEND - Agenda Online';

$mpdf->SetFooter($rodape);	

$mpdf->SetDisplayMode('fullpage');

$mpdf->allow_charset_conversion = true;

$mpdf->charset_in = 'UTF-8';
                            //Adicionando Css nos relatórios
$css = file_get_contents("../Estilos/EstiloModeloRelatorio.css");
$mpdf->WriteHTML($css,1);

$mpdf->SetTitle("relatorio-especifico-revisaodados-cadastrado");

$mpdf->WriteHTML($html);

$mpdf->Output("relatorio-especifico-revisaodados.pdf", "I");

exit();




