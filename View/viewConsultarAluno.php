<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 
        <script type="text/javascript" src="../js/Processa.js"></script>
        <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
        <script src="../css/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
        <?php 
        
        include_once("../Controller/AlunoCRUD.php");
        include_once("verificaUsuarioLogado.php");
        
        $listadealunos = array();
        
        $aluno = new Aluno();
        $crudaluno = new AlunoCRUD();
        
        $listadealunos = $crudaluno->ListarAluno();
        
        $aluno = $listadealunos;


        //PAGINAÇÃO//
        $db = Conexao::conexao();
        $i = 1;
        $listaraluno_pg=$db->prepare("SELECT codAluno, nomeAluno, rgAluno, cidadeAluno, logradouroAluno, numCasaAluno, dataNascAluno, cepAluno, complementoAluno FROM tbaluno");
        $listaraluno_pg->execute();

        $count = $listaraluno_pg->rowCount();
        $calculo = ceil(($count/8));

        Conexao::desconexao();
       //PAGINAÇÃO//
        ?>




        <div class="cimaPesquisa">
         <div class="barraPesquisaGeral">
          <label>Alunos</label>
          <form autocomplete="off">

            <input type="text" placeholder="Pesquisar..." id="txNome" name="txNome" class="barraPesquisa">
            <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
          </form>
        </div>
      </div>

      <a  href="#" id="abacadastroaluno" name="abacadastroaluno" onclick="abacadastroaluno('pageCadastroAluno.php')"><div class="abrirAbaCadastro"><img src="../Imagens/add.png"alt=""></div></a>

      <a href='../Reports/reportsAluno.php?key_rpt_aluno=all' target="_blank"><div class="abriRelatorioGeral"><img src="../Imagens/printer.png" alt=""></div></a>

      <!-- FUNÇÃO QUE ABRE A TELA DE CADASTRO -->
      <script type="text/javascript" language="javascript">
        function abacadastroaluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };



    //Paginação
    function pgaluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
              };
    //Paginação


    function excluiraluno(id){

   swal({
        title: "Deseja Excluir?",
        icon: "warning",
        buttons: [
        'Cancelar',
        'Excluir'
        ],
        dangerMode: true,
      }).then(function(isConfirm) { 
        if (isConfirm) {

          $.ajax({ 
            url: "EditaExcluiAluno.php",
            dataType: "html",
            type: "POST",
            data: { id: id},

            success: function(data){
              $('#painelAbas').html(data);
            },

          });
        
        } 
      });
    }


    function editaraluno(id){


      $.ajax({ 
        url: "edicaoAluno.php",
        dataType: "html",
        type: "POST",
        data: { id: id},
        success: function(data){
          $('#painelAbas').html(data);
        },
      });

    };

    function abrirprontuario(cod){


      $.ajax({ 
        url: "viewConsultarProntuario.php",
        dataType: "html",
        type: "POST",
        data: { codigo: cod},
        success: function(data){
          $('#painelAbas').html(data);
        },
      });

    }


  </script>
  <div class="embrulho12">
  <div id='div-resultAluno' class="div-result">
   <div class="div-itens-consulta">
    <table class="bordasimples4" cellspacing="0">
      <thead>
        <tr class="tituloTabela">
          <!--<th>Código do aluno</th>-->
          <td class="tituloTabelaCadAux">Nome</td>
          <td class="tituloTabelaCadAux">RG</td>
          <td class="tituloTabelaCadAux">Data Nascimento</td>
          <td class="tituloTabelaCadAux">Logradouro</td>
          <td class="tituloTabelaCadAux">Complemento</td>
          <td class="tituloTabelaCadAux">Nº Casa</td>
          <td class="tituloTabelaCadAux">CEP</td>
          <td class="tituloTabelaCadAux">Cidade</td>
          <td class="tituloTabelaCadAux">Responsável</td>
          <td class="tituloTabelaCadAux">Ações</td>
        </tr>
      </thead>
      <tbody>



        <?php foreach($aluno as $alunos){

          $date = $alunos->getDatanascimento();

          $aux = str_replace('-', '/', $date);
          $dataNascAluno = date('d/m/Y', strtotime($aux));




          echo("<tr>");

                        /*echo("<td>");
                        echo($alunos->getCodigo());
                        echo("</td>");*/
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getNome());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getRg());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($dataNascAluno);
                        echo("</td>");

                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getLogradouro());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getComplemento());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getNumCasa());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getCep());
                        echo("</td>");
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($alunos->getCidade());
                        echo("</td>");
                        
                        $responsavel;
                        $pesqresp = new AlunoCRUD();
                        $resp = $pesqresp->ConsultarResponsavel($alunos->getCodigo());
                        
                        echo("<td class='linhaTabelaCadAux'>");
                        echo($resp);
                        echo("</td>");
                        

                        
                        echo("<td>");
                        echo("<div class='iconTabela'>");
                      
                        echo("<a href='#' name='editar' value='' id='editar' onclick='editaraluno(".$alunos->getCodigo().")'>
                          <div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
                        echo(" ");
                        echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluiraluno(".$alunos->getCodigo().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
                        echo(" ");

                        echo("<a href='#' name='prontuario' value='' id='prontuario' onclick='abrirprontuario(".$alunos->getCodigo().")'><div class='iconTabela'><img class='imgProntuario' src='../Imagens/none.png'></div></a>");

                        echo("<a href='../Reports/reportsAluno.php?key_rpt_aluno=especific&id_aluno={$alunos->getCodigo()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'></div></a>  ");
                        echo("</td>");
                        
                        
                        
                        echo("</tr>");
                        
                        echo("</div>");
                        
                      }
                      ?> 

                    </tbody>
                  </table>
                </div>
                
                <?php 
                 //PAGINAÇÃO
                echo "<ul class='paginacaoCadAux'>"; 

                if(empty($_GET['pageAluno'])){} else { $pagina = $_GET['pageAluno'];}
                if(isset($pagina)){ $pagina = $_GET['pageAluno'];}else{$pagina =1;}

                $voltar = $pagina - 1;
                $seguir = $pagina + 1;
                $valorAtual = $pagina;

                if( $pagina !=  1){
                 echo "<li>"; 
                 echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$voltar')"."><</a>";
                 echo "</li>";
               }else{}

         // $pg =  $_POST["pageAluno"];
               while ($i <= $calculo) {
                $estilo= "";
                if($pagina == $i){
                 $estilo = "div style='position: relative;
                 display: block;
                 width: 35px;
                 height: 35px;
                 font-size: 20px;
                 text-align: center;
                 line-height: 35px;
                 background-color: rgba(9, 132, 227, 1.0);
                 color: white;
                 text-decoration: none;
                 border-radius: 0px;
                 border: 1px solid rgba(9, 132, 227, 1.0);";
               }
               ?>
               <li <?php echo $estilo;?>>
                 <?php                 

                 echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$i')".">$i</a>";
                 echo "</li>"; 
                 $i++;
                 if($i > 10){
                  echo "<li>"; 
                  echo "<a>...</a>";
                  echo "</li>"; 

                  if(@$pagina > 11){
                    echo "<li>"; 
                    echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$valorAtual')".">$valorAtual </a>";
                    echo "</li>"; 
                  }else{
                    echo "<li>"; 
                    echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=11')".">11</a>";
                    echo "</li>"; 
                  }
                  if (@$pagina <  ($calculo +5)) {
                    echo "<li>"; 
                    echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageAluno=$seguir')".">></a>";
                    echo "</li>"; 
                  }
                  break;
                }    
              }

              echo "</ul>";
            //PAGINAÇÃO
              ?> 

           <br>    
           <br>
            </div>
            </div>