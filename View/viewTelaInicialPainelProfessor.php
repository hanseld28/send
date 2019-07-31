<?php 
    if(isset($_POST['id']))
    {
        $codigouser = $_POST['id'];
    }
?>
<div id="splash-loading"></div> <!-- Area da animacao de carregamento -->    

  <div class="conteudoCardProf">
    <div class="embrulhoCardsProf">

      <!--   <section class="conteudoTopoMensagensResp">
            <div class="topoMensagensGame1">
                <h1> <img src="ImagensJogos/joystick.png" alt="">Jogos</h1>
            </div>
        </section>
         -->
        
        <section class="top-conteudoProf">
           
            <div class="topo-caixa top-caixaProf">
                    <p>Turmas</p>
               <a href="#" id="carregaturmas" name="carregaturmas" onclick="carregaturmas(<?php echo($codigouser); ?>)"><button>Visualizar Turmas</button></a>
            </div>
            
            <div class="topo-caixa top-caixaProf2">

               <p>Comunicados</p>
               <button>Ver Comunicados</button>
            </div>
            
            <div class="topo-caixa top-caixaProf3">
             <p>Rotinas Enviadas</p>
             <button>Ver Rotinas</button>
            </div>
            
            

        </section>


        <section class="conteudoRodapeProf">
            <div class="rodapeProf">
                Polaris &copy; 2018 
            </div>
        </section>



    </div>
</div>