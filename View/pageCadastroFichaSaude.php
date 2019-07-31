<?php
?>

<script type="text/javascript" src="../js/funcaoToggle.js"></script>

<div class="cimaPesquisaAluno">
   <div class="passosCadastros">
    <ul class="barraProgresso">
      <li class="ativo">Aluno</li>
      <li class="ativo2">Responsável</li>
      <li class="ativo3">Matrícula</li>
      <li>Prontuário</li>
      <li>Revisão</li>
    </ul>
  </div>
</div>

<h1 class="tituloCadAlunoFicha">Ficha de Saúde</h1>
<div class="embrulho12">
            <div class="conteudoProntuarioReview">
                <div class="dadosProntuarioReview">
                    <div class="ProntuarioReview">
<form method="post" action="" name="fichasaude" id="fichasaude">

                      <p>
                          <b>1- Tipo Sanguíneo</b>
                           <select class='select-regular' name='tiposanguineo' id='tiposanguineo'>
                           <option value='A+'>A+</option>
                            <option value='A-'>A-</option>
                            <option value='B+'>B+</option>
                            <option value='B-'>B-</option>
                            <option value='AB+'>AB+</option>
                            <option value='AB-'>AB-</option>
                            <option value='O+'>O+</option>
                            <option value='O-'>O-</option>
                          </select> 
                     </p>
                     
                     <br>
                     
                    <p>
                        <b>2- Apresenta alguma deficiência? </b>
                           
                         <input type='radio' name='semDeficiencia' id='semDeficiencia' placeholder="" class="naoDeficiencia" value="Não"> 
                         <label for="naoDeficiencia">Não</label>    

                         <input type='radio' name='semDeficiencia' id='semDeficiencia' placeholder="" class="simDeficiencia" value="Sim"> 
                         <label for="simDeficiencia">Sim</label>
                    </p>
                     
                     <br>
                     
                     <div class="divDeficiencia">
                            <input type='checkbox' name='deficiencia' id='deficiencia' placeholder="" class="checkbox-regular" value="Visual">
                            <label> Visual </label>

                            <input type='checkbox' name='deficiencia' id='deficiencia' placeholder="" class="checkbox-regular " value="Fônica">
                            <label> Fônica </label>

                            <input type='checkbox' name='deficiencia' id='deficiencia' placeholder="" class="checkbox-regular " value="Auditiva">
                            <label> Auditiva </label>

                            <input type='checkbox' name='deficiencia' id='deficiencia' placeholder="" class="checkbox-regular " value="Motora">
                            <label> Motora </label>

                            <br>
                            <br>

                            <label> Outra(s): </label>
                            <input type='text' name='outraDeficiencia' id='outraDeficiencia' placeholder="" class="regular-input-text">
                    </div>
                       
                        <br>
                        
                        <p>
                            <b>3- Tem algum problema de saúde? </b>
                        
                                <input type='radio' name='problemaSaude' id='problemaSaude' placeholder="" class="radio-regular-naoProblemaSaude" value="Não"> 
                                <label> Não </label>    
                     
                                <input type='radio' name='problemaSaude' id='problemaSaude' placeholder="" class="radio-regular-simProblemaSaude" value="Sim"> 
                                <label> Sim </label>
                        </p>
                        
                     <br>
                     
                      <div class="divProblemaSaude">
                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Amigdalite">
                            <label> Amigdalite </label>
                    
                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Bronquite">
                            <label> Bronquite </label>

                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Diabete">
                            <label>  Diabete  </label>

                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Otite">
                            <label> Otite  </label>

                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Sinusite">
                            <label> Sinusite  </label>

                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Palpitação">
                            <label> Palpitação  </label>


                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Hemorragia">
                            <label> Hemorragia  </label>    
                            
                            <br>
                            
                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Dispnéia (falta de ar)">
                            <label> Dispnéia (falta de ar)   </label>

                            <input type='checkbox' name='problemas' id='problemas' placeholder="" class="checkbox-regular " value="Convulsão (desmaio)">
                            <label>  Convulsão (desmaio) </label>
                             <br>
                             <br>

                            <p> Outra(s):  <input type='text' name='outroProblema' id='outroProblema' placeholder="" class="regular-input-text"></p>
                     
                        </div>
                         
                          <br>
                          
                          
                            <p>
                               <b>4- Já teve doenças contagiosas? </b>
                                <input type='radio' name='doencas' id='doencas' placeholder="" class="radio-regular-naoContagiosa" value="Não"> 
                                <label> Não </label>    

                                <input type='radio' name='doencas' id='doencas' placeholder="" class="radio-regular-simContagiosa" value="Sim"> 
                                <label> Sim </label>
                             </p>
                     
                    <br>
                      <div class="divContagiosas">
                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Sarampo">
                            <label>  Sarampo </label>

                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Varicela">
                            <label> Varicela </label>

                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Catapora">
                            <label>   Catapora  </label>

                           <br>
                           
                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Escarlatina">
                            <label>  Escarlatina  </label>

                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Coqueluche">
                            <label> Coqueluche   </label>

                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Caxumba">
                            <label> Caxumba   </label>


                            <input type='checkbox' name='doenca' id='doenca' placeholder="" class="checkbox-regular " value="Rubéola">
                            <label>  Rubéola  </label>

                             <br>
                             <br>
                             
                            <p> Outra(s):  <input type='text' name='outraDoencaContagiosa' id='outraDoencaContagiosa' placeholder="" class="regular-input-text"></p>
                           
                    
                        </div>
                        
                     <br>
                     
                     <p>
                     
                     <b>5- Já foi submetido(a) a tratamento cirúrgico ou ortopédico? </b>
                     <input type='radio' name='ortopedico' id='ortopedico' placeholder="" class="radio-regular-naoTratamento" value="Não"> 
                     <label> Não </label>    
                     
                     <input type='radio' name='ortopedico' id='ortopedico' placeholder="" class="radio-regular-simTratamento" value="Sim"> 
                     <label> Sim</label>
                     
                    </p>
                    
                    <div class="divTratamento">   
                    <label for="">Qual?</label>
                     <input type='text' name='cirugia' id='cirurgia' placeholder="" class="regular-input-text">
                    </div>
                    
                    <br>
                    
                    <p>
                    <b>6- É alérgico(a)?</b>
                         <input type='radio' name='alergico' id='alergico' placeholder="" class="radio-regular-naoAlergia" value="Não"> 
                         <label> Não </label>    

                         <input type='radio' name='alergico' id='alergico' placeholder="" class="radio-regular-simAlergia" value="Sim"> 
                         <label> Sim</label>
                    </p>
                    
                     <div class="divAlergia">   
                     <label for="">Qual?</label>
                     <input type='text' name='alergias' id='alergias' placeholder="" class="regular-input-text">
                     </div>
                      
                       <br>
                       <p>
                    <b>7-Faz uso de alguma medicação?  </b>
                     <input type='radio' name='medicacao' id='medicacao' placeholder="" class="regular-input-naoMedicamento" value="Não"> 
                     <label> Não </label>    
                     
                     <input type='radio' name='medicacao' id='medicacao' placeholder="" class="regular-input-simMedicamento" value="Sim"> 
                        <label> Sim </label>
                        </p>
                    <br>
                     <div class="divMedicamento">   
                    <label> Qual? </label>
                     <input type='text' name='remedios' id='remedios' placeholder="" class="regular-input-text">
    </div>
                    

                      <p class="maiorInput">
           <input class="btnProxPasso" type="button" value="Próximo Passo" onclick="carregaFichaSaude();scrollToTop();return false">
            </p>
</form>
                    </div>
                </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>


<script type="text/javascript" language="javascript">


    function carregaFichaSaude(){
    //pergunta 1
    var tipoSanguineo = document.getElementById("tiposanguineo").value;
    var arrDeficiencia = [];
    var arrProblema = [];
    var arrDoencas = [];
    var outradoenca = 0;
    var outradeficiencia = 0;
    var outroproblema = 0;
    var cirurgia = 0;
    var alergias = 0;
    var medicacoes = 0;

    //pergunta 2
    if (document.fichasaude.semDeficiencia[0].checked == false 
    && document.fichasaude.semDeficiencia[1].checked == false){
            alert("Adicione uma resposta a pergunta 2");
            return false;
    }else{


        if(document.fichasaude.semDeficiencia[0].checked == true){
        }else if(document.fichasaude.semDeficiencia[1].checked == true){
              $("input:checkbox[name=deficiencia]:checked").each(function(){
                arrDeficiencia.push($(this).val());
              });
              
              outradeficiencia = document.getElementById("outraDeficiencia").value;
        }
            
        }
        //pergunta 3

     if (document.fichasaude.problemaSaude[0].checked == false
    && document.fichasaude.problemaSaude[1].checked == false){

         alert("Adicione uma resposta a pergunta 3");
        return false;

        
    }else{

        if(document.fichasaude.problemaSaude[0].checked == true){

        }else if(document.fichasaude.problemaSaude[1].checked == true){

              $("input:checkbox[name=problemas]:checked").each(function(){
                arrProblema.push($(this).val());
              });

              outroproblema = document.getElementById("outroProblema").value;

        }
            
        }
        //pergunta 4
        
      if (document.fichasaude.doencas[0].checked == false 
    && document.fichasaude.doencas[1].checked == false){

        alert("Adicione uma resposta a pergunta 4");
        return false;

    }else{


        if(document.fichasaude.doencas[0].checked == true){

        }else if(document.fichasaude.doencas[1].checked == true){

              $("input:checkbox[name=doenca]:checked").each(function(){
                arrDoencas.push($(this).val());
              });

              outradoenca = document.getElementById("outraDoencaContagiosa").value;

        }
            
        }
        //pergunta 5
        

          if (document.fichasaude.ortopedico[0].checked == false 
    && document.fichasaude.ortopedico[1].checked == false){

            alert("Adicione uma resposta a pergunta 5");
            return false;

    }else{


        if(document.fichasaude.ortopedico[0].checked == true){

        }else if(document.fichasaude.ortopedico[1].checked == true){

              cirurgia = document.getElementById("cirurgia").value;

        }

    }
        //pergunta 6
        

          if (document.fichasaude.alergico[0].checked == false 
    && document.fichasaude.alergico[1].checked == false){

            alert("Adicione uma resposta a pergunta 6");
            return false;

      
    }else{

          if(document.fichasaude.alergico[0].checked == true){

        }else if(document.fichasaude.alergico[1].checked == true){

              alergias = document.getElementById("alergias").value;

        }


    }
            //pergunta 7
            


        if (document.fichasaude.medicacao[0].checked == false 
    && document.fichasaude.medicacao[1].checked == false){

            alert("Adicione uma resposta a pergunta 7");
            return false;

    }else{
            if(document.fichasaude.medicacao[0].checked == true){

        }else if(document.fichasaude.medicacao[1].checked == true){

              medicacoes = document.getElementById("remedios").value;

        }

    }


             $.ajax({
                async: false,
                type: "POST",
                url: "CorreioProntuario.php",
                data:{
                   tipoSanguineo: tipoSanguineo,
                   deficiencias: arrDeficiencia,
                   problemassaude: arrProblema,
                   doencasContagiosas: arrDoencas,
                   descDoenca: outradoenca,
                   descDeficiencia: outradeficiencia,
                   descProblema: outroproblema,
                   descCirurgia: cirurgia,
                   descAlergia: alergias,
                   descMedicacoes: medicacoes,
                },
                success: function(data){
                    $('#painelAbas').html(data);  
                }
            });
}




</script>


<script>
/*Deficiência*/

$(function(){
   $(".simDeficiencia").click(function(){
      $(".divDeficiencia").show(600); 
   }); 
});
    
$(function(){
   $(".naoDeficiencia").click(function(){
      $(".divDeficiencia").hide(500); 
   }); 
});
</script>


<script>
/*Problemas de Saúde*/
    
$(function(){
   $(".radio-regular-simProblemaSaude").click(function(){
      $(".divProblemaSaude").show(600); 
   }); 
});
    
$(function(){
   $(".radio-regular-naoProblemaSaude").click(function(){
      $(".divProblemaSaude").hide(500); 
   }); 
});
</script>


<script>
/*Doenças Contagiosas*/
$(function(){
   $(".radio-regular-simContagiosa").click(function(){
      $(".divContagiosas").show(600); 
   }); 
});
    
$(function(){
   $(".radio-regular-naoContagiosa").click(function(){
      $(".divContagiosas").hide(500); 
   }); 
});
</script>

<script>
/*Tratamento Cirurgia*/
$(function(){
   $(".radio-regular-simTratamento").click(function(){
      $(".divTratamento").show(600); 
   }); 
});
    
$(function(){
   $(".radio-regular-naoTratamento").click(function(){
      $(".divTratamento").hide(500); 
   }); 
});
</script>

<script>
/*Alergia*/
$(function(){
   $(".radio-regular-simAlergia").click(function(){
      $(".divAlergia").show(600); 
   }); 
});
    
$(function(){
   $(".radio-regular-naoAlergia").click(function(){
      $(".divAlergia").hide(500); 
   }); 
});
    </script>



<script>
/*Medicamento*/
$(function(){
   $(".regular-input-simMedicamento").click(function(){
      $(".divMedicamento").show(600); 
   }); 
});
    
$(function(){
   $(".regular-input-naoMedicamento").click(function(){
      $(".divMedicamento").hide(500); 
   }); 
});
</script>

<script src="../js/funcaoToggle.js"></script>


