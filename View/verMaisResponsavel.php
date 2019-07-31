<?php

$codigo = $_POST['id'];
include_once('../Controller/ResponsavelCRUD.php');
$crud = new ResponsavelCRUD();
$Responsavel = $crud->ConsultaResponsavel($codigo);

?>
<a href="#" id="abaconsultaaluno" name="abaconsultaaluno"onclick="abaconsultaaluno('viewConsultarResponsavel.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png"alt=""></div></a>
<div class="cimaPesquisa">
 <h2 class="tituloTop">Consultar Dados do Responsável</h2>
</div>

    <div class="embrulho12">
         <div class="conteudoDadosRevisaoFunc">
                   
                    <div class="dadosRevisaoFunc">
                        <div class="revisarFunc">
                            <form action="">
                               <p>
                                   <b>Dados do Responsável:</b>
                                   
                                   <br>
                                   <br>
                                    <label><img src="../Imagens/ImagensRevisao/id-card.png" alt="">Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getNome()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/HeteroSym-pinkblue2.svg.png" alt="">Sexo:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getSexo()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/stork.png" alt="">Data de Nascimento:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getDatanascimento()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/flag.png" alt="">Nacionalidade:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getNacionalidade()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/id-card1.png" alt="">RG:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getRg()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/user.png" alt="">CPF:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getCpf()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/parents.png" alt="">Parentesco:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getGrauparentesco()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/workspace.png" alt="">Profissão:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getProfissao()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/email.png" alt="">E-mail:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getEmail()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/phone.png" alt="">Telefone Fixo:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getTelefone()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/smartphone.png" alt="">Celular:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getCelular()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/map.png" alt="">Logradouro Trabalho:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getEnderecotrabalho()); ?></label>
                                    <label><img src="../Imagens/ImagensRevisao/phone.png" alt="">Telefone Trabalho:&nbsp;&nbsp;&nbsp;<?php echo($Responsavel->getTelefonetrabalho()); ?></label>
                                </p>
                            </form>
                        </div>
                     </div>
                   </div>
                </div>


<script type="text/javascript">
     function abaconsultaaluno(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
          };   
</script>