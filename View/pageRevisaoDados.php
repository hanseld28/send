

           
           <?php 
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

?>       
<div class="cimaPesquisaAluno">
   <div class="passosCadastros">
    <ul class="barraProgresso">
      <li class="ativo">Aluno</li>
      <li class="ativo2">Responsável</li>
      <li class="ativo3">Matrícula</li>
      <li class="ativo4">Prontuário</li>
      <li class="">Revisão</li>
    </ul>
  </div>
</div> 
                 
<a href='../Reports/reportsRevisaoDados.php?key_rpt_revisaodados=especifc' target="_blank"><div class="abrirRelatorioGeralRevisaoDados"><img src="../Imagens/printer.png" alt=""></div></a>
                         
        <div class="embrulho12">
         <div class="conteudoDadosRevisao">
                   
                    <div class="dadosRevisao">
                        <div class="revisar">
                            <form action="">
                               <p>
                                   <b>login Gerado:</b>
                                   <br>
                                   <label>Login:&nbsp;&nbsp;&nbsp;<?php echo($login); ?></label>
                                   <label>Senha:&nbsp;&nbsp;&nbsp;<?php echo($senha); ?></label>
                                    <br>
                                    <b> Dados do Aluno:</b>
                                    <br>
                                    <br>
                                    <label>Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($nome); ?></label>
                                    <label>Data de Nascimento:&nbsp;&nbsp;&nbsp;<?php echo($data); ?></label>
                                    <label>Sexo:&nbsp;&nbsp;&nbsp;<?php echo($sexo); ?></label>
                                    <label>Nacionalidade:&nbsp;&nbsp;&nbsp;<?php echo($nacionalidade); ?></label>
                                    <label>RG:&nbsp;&nbsp;&nbsp;<?php echo($rg); ?></label>
                                    <label>Cor/Raça:&nbsp;&nbsp;&nbsp;<?php echo($cor); ?></label>
                                    <label>Certidão de Nascimento:&nbsp;&nbsp;&nbsp;<?php echo($certidao); ?></label>
                                    <br>
                                    
                                    <b>Dados de Localização:</b>
                                    <br>
                                    <br>
                                    <label>CEP:&nbsp;&nbsp;&nbsp;<?php echo($cep); ?></label>
                                    <label>Cidade:&nbsp;&nbsp;&nbsp;<?php echo($cidade); ?></label>
                                    <label>Logradouro:&nbsp;&nbsp;&nbsp;<?php echo($logradouro); ?></label>
                                    <label>Bairro:&nbsp;&nbsp;&nbsp;<?php echo($bairro); ?></label>
                                    <label>Nº:&nbsp;&nbsp;&nbsp;<?php echo($num); ?></label>
                                    <label>Complemento:&nbsp;&nbsp;&nbsp;<?php echo($complemento); ?></label>
                                    <br>
                                    <b>Prontuário:</b>
                                    <br>
                                    <label>Tipo Sanguíneo:&nbsp;&nbsp;&nbsp;<?php echo($tipo); ?></label>
                                    <label>Deficiência(as):&nbsp;&nbsp;&nbsp;<?php echo($deficiencia); ?></label>
                                    <label>Problemas de Saúde:&nbsp;&nbsp;&nbsp;<?php echo($problema); ?></label>
                                    <label>Doenças Contagiosas:&nbsp;&nbsp;&nbsp;<?php echo($doenca); ?></label>
                                    <label>Tratamento:&nbsp;&nbsp;&nbsp;<?php echo($tratamento); ?></label>
                                    <label>Alergia(as):&nbsp;&nbsp;&nbsp;<?php echo($alergia); ?></label>
                                    <label>Medicação:&nbsp;&nbsp;&nbsp;<?php echo($medicacao); ?></label>
                    
                                </p>
                                
                                <p>
                                    <b>Dados do Responsável:</b>
                                    <br>
                                    <br>
                                    <label>Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($nomeresp); ?></label>
                                    <label>Sexo:&nbsp;&nbsp;&nbsp;<?php echo($sexoresponsavel); ?></label>
                                    <label>Data de Nascimento:&nbsp;&nbsp;&nbsp;<?php echo($datanascimentoresp); ?></label>
                                    <label>Nacionalidade:&nbsp;&nbsp;&nbsp;<?php echo($nacionalidaderesp); ?></label>
                                    <label>RG:&nbsp;&nbsp;&nbsp;<?php echo($rgresp); ?></label>
                                    <label>CPF:&nbsp;&nbsp;&nbsp;<?php echo($cpfresp); ?></label>
                                    <label>Parentesco:&nbsp;&nbsp;&nbsp;<?php echo($grauresp); ?></label>
                                    <label>Profissão:&nbsp;&nbsp;&nbsp;<?php echo($profissaoresp); ?></label>
                                    <label>E-mail:&nbsp;&nbsp;&nbsp;<?php echo($emailresp); ?></label>
                                    <label>Telefone Fixo:&nbsp;&nbsp;&nbsp;<?php echo($telefoneresp); ?></label>
                                    <label>Celular:&nbsp;&nbsp;&nbsp;<?php echo($celularresp); ?></label>
                                    <label>Telefone Trabalho:&nbsp;&nbsp;&nbsp;<?php echo($telefonetrabalho); ?></label>
                                    <label>Logradouro Trabalho:&nbsp;&nbsp;&nbsp;<?php echo($logradourotrabalho); ?></label>
                                    <br>
                                    
                                    <b>Em caso de Emergência contatar:</b>
                                    <br>
                                    <br>
                                    <b>Responsável 1:</b>
                                    <label>Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($pessoa1); ?></label>
                                    <label>Telefone:&nbsp;&nbsp;&nbsp;<?php echo($telefone1); ?></label>
                                    
                                    <b>Responsável 2:</b>
                                    <label>Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($pessoa2); ?></label>
                                    <label>Telefone:&nbsp;&nbsp;&nbsp;<?php echo($telefone2); ?></label>
                                    
                                    <b>Responsável 3:</b>
                                    <label>Nome Completo:&nbsp;&nbsp;&nbsp;<?php echo($pessoa3); ?></label>
                                    <label>Telefone:&nbsp;&nbsp;&nbsp;<?php echo($telefone3); ?></label>
                                     
                                </p>
                                
                                
                                <p class="maiorInput">
                                  <input class="btnProxPasso" type="button" id="btnFinalizar" name="btnFinalizar" value="Finalizar" onclick="Finalizar('viewConsultarAluno.php')">  
                                </p>
                                
                            </form>
                        </div>
                     </div>
            </div>

</div>


<script type="text/javascript">
    function Finalizar(pagina){
        $("#painelAbas").load(pagina);
    };
</script>
          