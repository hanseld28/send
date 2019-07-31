<?php
    
    include_once("../Controller/AlunoCRUD.php");
    include_once("../Controller/ControllerProntuario.php");
    include_once("../Controller/ControllerMatricula.php");
    include_once("../Controller/ControllerTurma.php");
    include_once("../Controller/ControllerGrauEscolar.php");
    include_once("verificaUsuarioLogado.php");
    include_once("../Model/Aluno.php");

    $codaluno = $_POST['codigo'];

    $crud = new ControllerProntuario();
    $codprontuario = $crud->pesquisarProntuarioAluno($codaluno);

    $crud2 = new ControllerMatricula();
    $matricula = $crud2->preencherMatriculaPorAluno($codaluno);

    $controller = new ControllerProntuario();
    $list = $controller->consultarProntuario($codprontuario);
    $sangue = $list->getTiposanguineo();

    $crud2 = new AlunoCRUD();
    $aluno = $crud2->ConsultaAluno($codaluno);

    $codturma = $matricula->turma->getId();


      if($codturma == 0){ 
            
            $descTurma = "Não está em nenhuma turma";
            $descGrau = "Indefinido";
            
        }else{
          
            $crud3 = new ControllerTurma();
            $turma = $crud3->preencherTurma($codturma);
             $descTurma = $turma->getDescricao();
            $codGrau = $turma->grauEscolar->getId();
            
            $crudGrau = new ControllerGrauEscolar();
            $grau = $crudGrau->preencherGrauEscolar($codGrau);
            $descGrau = $grau->getDescricao();
            
        }

    foreach($aluno as $alunos)
                {
                    $nome_foto = $alunos->getFoto();
                    $nome_aluno = $alunos->getNome();
                    $data_aluno = $alunos->getDatanascimento();
                    $sexo_aluno = $alunos->getSexo();
                    $numMatricula_aluno = $matricula->getNumero();
                    
                }

?>
<?php
echo("<a href='../Reports/reportsProntuario.php?key_rpt_pront=especific&id_pront={$codprontuario}' target='_blank'><div class='abriRelatorioGeral'><img src='../Imagens/printer.png' alt=''></div></a>")

?>
    
        
    <div class="cimaPesquisa">
       <h2 class="tituloTop">Prontuário</h2>
</div>

 <a href="#" id="abaconsultaaluno" name="abaconsultaaluno"onclick="abaconsultaaluno('viewConsultarAluno.php')"><div class="abrirAbaCadastro"><img src="../Imagens/back.png"alt=""></div></a>

<div class="fotoAlunoProntuario">
    

 
    <?php
    $aux = str_replace('-', '/', $data_aluno);
    $dataNascAluno = date('d/m/Y', strtotime($aux));

     echo "<img src='../fotos/".$nome_foto."' id='previsualizar'>";
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Turma: </label>"."<label  class='labelPront'>".$descTurma)."</label>";
     echo("</p>");
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Nome: </label>"."<label class='labelPront'>".$nome_aluno)."</label>";
     echo("</p>");
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Data de Nascimento: </label>"."<label class='labelPront'>".$dataNascAluno)."</label>";
     echo("</p>");
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Sexo: </label>"."<label class='labelPront'>".$sexo_aluno)."</label>";
     echo("</p>");
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Número de Matricula: </label>"."<label class='labelPront'>".$numMatricula_aluno)."</label>";
     echo("</p>");
    
     echo("<p>");
     echo("<label class='labelNegritoPront'>Grau: </label>"."<label class='labelPront'>".$descGrau)."</label>";
     echo("</p>");


     ?> 
</div>
    
           <div class="conteudoDadosProntView">
              <div class="dadosProntView">
                 <div class="prontView">
     <form method="post" action="" name="fichasaude" id="fichasaude">
     <p>
      <label> Tipo Sanguíneo: </label>
        <?php

        $options=array("A+","A-","B+","B-","AB+","AB-","O+","O-");
        echo "<select class='select-regular' name='sangue' id='sangue' disabled='true'>";

        foreach ($options as $lista)
        {
         if($lista==$sangue)
          echo"<option value=$lista selected='selected'>$lista</option>";
        else
          echo"<option value=$lista>$lista</option>";
      }
      echo" </select>";

      ?>
      </p>
     <p>

                            <label> Deficiências: </label>
                            <?php   $deficiencia = $list->getDeficiencia(); 
                                    $problema = $list->getProblemasaude();
                                    $doenca = $list->getDoencacontagiosa();
                                    $tratamento = $list->getTratamentocirurgico();
                                     $alergia = $list->getAlergia();
                                    $medicacao = $list->getMedicacao();

                                    if($deficiencia == "0" || $deficiencia == "" || $deficiencia == ",0"){
                                      $deficiencia = "Nenhuma";
                                    }else{
                                      $deficiencia = str_replace(',', '', $deficiencia);
                                    }

                                    if($problema == "" || $problema == "0" || $problema == ",0"){
                                      
                                      $problema = "Nenhum";
                                    }else{
                                      $problema = str_replace(',', '', $problema);
                                    }

                                    if($doenca == "0" || $doenca == "" || $doenca == ",0"){
                                      $doenca = "Nenhuma";
                                    }else{
                                      $doenca = str_replace(',', '', $doenca);
                                    }

                                    if($tratamento == "0" || $tratamento == "" || $tratamento == ",0"){
                                      $tratamento = "Nenhum";
                                    }else{
                                      $tratamento = str_replace(',', '', $tratamento);
                                    }

                                    if($alergia == "0" || $alergia == "" || $alergia == ",0"){
                                      $alergia = "Nenhuma";
                                    }else{
                                      $alergia = str_replace(',', '', $alergia);
                                    }

                                    if($medicacao == "0" || $medicacao == "" || $medicacao == ",0"){
                                      $medicacao = "Nenhuma";
                                    }else{
                                      $medicacao = str_replace(',', '', $medicacao);
                                    }
                                

    echo("<input type='text' name='outraDeficiencia' id='outraDeficiencia' disabled='true' value='".$deficiencia."' class='regular-input-text'>");

                            ?>
                       
                       </p>
                     

                            <p> <label>Problemas de Saúde:</label> <?php echo("<input type='text' name='outroProblema' id='outroProblema' placeholder='' disabled='true' value='".$problema."' class='regular-input-text'>"); ?>
                              
                            </p>
                          
                             
                            <p><label>Doenças Contagiosas:</label>   <?php echo("<input type='text' name='outraDoencaContagiosa' id='outraDoencaContagiosa' placeholder='' disabled='true' class='regular-input-text' value='".$doenca."'>"); ?></p>
                        <p>
                       
                    <label>Tratamentos cirúrgicos: </label>
                     <?php echo("<input type='text' name='cirugia' id='cirurgia' disabled='true' placeholder='' value='".$tratamento."' class='regular-input-text'>"); ?>
                    </p>
                    
                    
                    
                        <p>
                     <label for="">Alergias: </label>
                      <?php echo("<input type='text' disabled='true' name='alergias' id='alergias' placeholder='' class='regular-input-text' value='".$alergia."'>"); ?>
                     </p>
                      
                       
                       <p>  
                    <label> Medicações: </label>
                     <?php echo("<input type='text' disabled='true' name='remedios' id='remedios' placeholder='' class='regular-input-text' value='".$medicacao."'>"); ?>
                   </p>

            <div class="btnPront">
           <input class="btnProxPasso" type="button" value="Habilitar" onclick="habilitar();scrollToTop();return false">
           
           <input class="btnProxPasso" type="button" value="Pronto" onclick="editaFichaSaude(<?php echo($codprontuario); ?>);scrollToTop();return false">
            </div>
</form>
                  </div>
               </div>
</div>

        <tbody>


<script type="text/javascript" language="javascript">

  function habilitar(){
                  
                document.getElementById("outraDeficiencia").disabled = false; //Habilitando
                document.getElementById("outroProblema").disabled = false; //Habilitando 
                document.getElementById("outraDoencaContagiosa").disabled = false; //Habilitando
                document.getElementById("cirurgia").disabled = false; //Habilitando
                document.getElementById("alergias").disabled = false; //Habilitando
                document.getElementById("remedios").disabled = false; //Habilitando
                document.getElementById("sangue").disabled = false; //Habilitando
                  
              };
    
     function abacadastrocaracteristicaaluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
                };

                  function abaconsultaaluno(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
        };
                  function editaFichaSaude(id){

                    var tipo = document.getElementById("sangue").value; 
                 
                $.ajax({
                async: false,
                type: "POST",
                url: "CorreioProntuario2.php",
                data:{

                   deficiencias: $("#outraDeficiencia").val(),
                   problemassaude: $("#outroProblema").val(),
                   doencasContagiosas: $("#outraDoencaContagiosa").val(),
                   descCirurgia: $("#cirurgia").val(),
                   descAlergia: $("#alergias").val(),
                   descMedicacoes: $("#remedios").val(),
                   ultimo: id,
                   tipo: tipo,

                },
                success: function(data){
                    $('#painelAbas').html(data);  
                }
            });
                
            }
    
 </script>


 </tbody>
</table>
