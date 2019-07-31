<?php
$codigo = $_POST['id'];
include_once('../Controller/FuncionarioCRUD.php');
$crud = new FuncionarioCRUD();
$Funcionario = $crud->ConsultaFuncionario($codigo);

$pesqcargos = new FuncionarioCRUD();
$lista = $pesqcargos->ConsultarCargos($codigo);

?>

<div class="cimaPesquisa">
 <h2 class="tituloTop">Consultar Dados do Funcionário</h2>
</div>
        
         <div class="embrulho12">
         <div class="conteudoDadosRevisaoFunc">
                   
                    <div class="dadosRevisaoFunc">
                        <div class="revisarFunc">
                            <form action="">
                               <p>
                                   <b>Dados do Funcionário:</b>
                                   
                                   <br>
                                   <br>
                                    <label><img src="../Imagens/ImagensRevisao/id-card.png" alt="">Nome Completo:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getNome());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/user.png" alt="">RG:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getRg());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/id-card1.png" alt="">CPF:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getCpf());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/placeholder.png" alt="">CEP:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getCep());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/map.png" alt="">Logradouro:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getLogradouro());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/cityscape.png" alt="">Cidade:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getCidade());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/login.png" alt="">Número:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getNumcasa());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/house.png" alt="">Complemento:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getComplemento());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/email.png" alt="">E-mail:&nbsp;&nbsp;&nbsp;<?php foreach($Funcionario as $f){echo($f->getEmail());} ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/worker.png" alt="">Cargo(s):&nbsp;&nbsp;&nbsp;<?php 
                                    foreach($lista as $cargos){
			                                echo($cargos);
			                                echo(" ");

			                            }
                                    ?> </label>
                                </p>
                            </form>
                        </div>
                     </div> 
            </div>

</div>