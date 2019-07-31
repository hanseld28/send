

                <div class='cimaPesquisa'>
                <h2 class='tituloTop'>Meu Perfil</h2>
                </div>


<?php
include_once("..\cab.php");
include_once("verificaUsuarioLogado.php");
include_once("../Controller/FuncionarioCRUD.php");
include_once("../Controller/ControllerUsuario.php");


echo("<fieldset class='fieldPerfil'>");
session_start();

		$controller = new ControllerUsuario();

	
		$cod = $_SESSION['codUsuario'];
		$login = $_SESSION['loginUsuario'];
		$nome = $_SESSION["nomeUsuario"];
		$codtipo = $_SESSION['codTipoUsuario'];
 
			$desc = $controller->descUsuario($cod);
			$crud = new FuncionarioCRUD();
			$funcionario = $crud->ConsultaFuncionarioUsuario($cod);

			if($funcionario != null){
 

			foreach ($funcionario as $f) {
				$nome = $f->getNome();
				$rg = $f->getRg();
				$cpf = $f->getCpf();
				$logra = $f->getLogradouro();
				$comple = $f->getComplemento();
				$numero = $f->getNumCasa();
				$cep = $f->getCep();
				$cidade = $f->getCidade();

			}
                


    
    echo("<label class='labelNegritoPront'>Nome: </label>"."<label class='labelDesc'>".$nome."</label>");
    echo("<br>");
	echo("<label class='labelNegritoPront'>RG: </label>"."<label class='labelDesc'>".$rg."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>CPF: </label>"."<label class='labelDesc'>".$cpf."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Logradouro: </label>"."<label class='labelDesc'>".$logra."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Complemento: </labels>"."<label class='labelDesc'>".$comple."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Nº: </label>"."<label class='labelDesc'>".$numero."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>CEP: </label>".$cep."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Cidade: </label>"."<label class='labelDesc'>".$cidade."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Login: </label>"."<label class='labelDesc'>".$login."</label>");
	







		}else{

    echo("<label class='labelNegritoPront'>Nome: </label>"."<label class='labelDesc'>"."</label>");
    echo("<br>");
	echo("<label class='labelNegritoPront'>RG: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>CPF: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Logradouro: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Complemento: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Nº: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>CEP: </label>"."<label class='labelDesc'>"."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Cidade: <label>"."<label class='labelDesc'>"."</label>");
    echo("<br>");
	echo("<label class='labelNegritoPront'>Login: </label>"."<label class='labelDesc'>".$login."</label>");
	echo("<br>");
	echo("<label class='labelNegritoPront'>Tipo de Usuario: </label>"."<label class='labelDesc'>".$desc."</label>");


		}

echo ("<a href='#' name='butto'  class='btnProxPassoA' value='' id='butto' onclick='editarSenha(".$cod.")'>Redefinir Senha</a>");
	
echo("</fieldset>");
	

?>



<div class='fieldSenha' id='redefinirsenha' name='redefinirsenha'>

</div>

<script type="text/javascript" language="javascript">

	function editarSenha(id){
                $.ajax({ 
                    asyn: false,
                    url: "pageRedefinirSenha.php",
                    dataType: "html",
                    type: "POST",
                    data: { id: id},
                    success: function(data){
                      $('#redefinirsenha').html(data);
                    },
                  });

            }


              </script>






<?php
include_once("../rod.php");
?>