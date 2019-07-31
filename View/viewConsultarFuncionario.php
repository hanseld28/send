<div id="splash-loading"></div> <!-- Area da animacao de carregamento --> 

<script type="text/javascript" src="../js/Processa.js"></script>
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css">
<?php

include_once '../Controller/FuncionarioCRUD.php';
include_once '../Model/Funcionario.php';

        //instancia a classe crud
$list = new FuncionarioCRUD();
        //cria um array
$listagem = array();
        //instancia um novo funcionario
$funcionario = new Funcionario();

        //o array recebe o retorno do metodo listar funcionario
$listagem = $list->ListarFuncionario();

        //o funcionario recebe a lista de funcionarios
$funcionario = $listagem;


       //Paginação
$db = Conexao::conexao();
$i = 1;
$listaraluno_pg=$db->prepare("SELECT codFuncionario, nomeFuncionario, rgFuncionario, cpfFuncionario, logradouroFuncionario, complementoFuncionario, numCasaFuncionario,cepFuncionario, cidadeFuncionario FROM tbFuncionario");
$listaraluno_pg->execute();

$count = $listaraluno_pg->rowCount();
$calculo = ceil(($count/8));

Conexao::desconexao();
       //PAGINAÇÃO//

?>



<a href="#" id="abacadastrofunc" name="abacadastrofunc"onclick="abacadastrofunc('pageCadastroFuncionario.php')"><div class="abrirAbaCadastro"><img src="../Imagens/add.png"alt=""></div></a>

<a href='../Reports/reportsFuncionario.php?key_rpt_func=all' target="_blank"><div class="abriRelatorioGeral"><img src="../Imagens/printer.png" alt=""></div></a>

<script type="text/javascript" language="javascript">
    function abacadastrofunc(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelAbas").load(pagina);
        };


        //Paginação

        function pgfunc(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
            };
        //Paginação


        function excluirfunc(id) {

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
                asyn: false,
                url: "EditaExcluiFuncionario.php",
                dataType: "html",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#painelAbas').html(data);
                },
            }); 
               
           } 
       });
    }





    function editarfunc(id) {


        $.ajax({
            asyn: false,
            url: "edicaoFuncionario.php",
            dataType: "html",
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $('#painelAbas').html(data);
            },
        });

    }

    function vermais(id) {


        $.ajax({
            asyn: false,
            url: "verMaisFuncionario.php",
            dataType: "html",
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                $('#painelAbas').html(data);
            },
        });

    }

</script>
    <!--<h3>Consulta funcionario</h3>
            <label>Pesquisar</label>
            <br>-->

            <div class="cimaPesquisa">
               <div class="barraPesquisaGeral">
                <label>Funcionário</label>
                <form autocomplete="off">
                    <input type="text" placeholder="Pesquisar..." id="txFunc" name="txFunc" class="barraPesquisa">
                    <div class="barraPesquisaBotao"><img src="../Imagens/magnifying-glasslll.png" alt=""></div>
                </form>
            </div>
        </div>

        <div class="embrulho12">
            <div id="div-resultFunc" class="div-result">

                <table class="bordasimples3" cellspacing="0">
                    <thead>
                        <tr>
                            <!--<td>Código</td>-->
                            <td class="tituloTabelaCadAux">Nome</td>
                            <td class="tituloTabelaCadAux">RG</td>
                            <td class="tituloTabelaCadAux">CPF</td>
                  <!--       <td class="tituloTabelaCadAux">Logradouro</td>
                        <td class="tituloTabelaCadAux">Complemento</td>
                        <td class="tituloTabelaCadAux">Nº Casa</td>
                        <td class="tituloTabelaCadAux">CEP</td>
                        <td class="tituloTabelaCadAux">Cidade</td> -->
                        <td class="tituloTabelaCadAux">Cargo</td>
                        <td class="tituloTabelaCadAux">Ações</td>

                    </tr>
                </thead>

                <tbody>

                    <?php
        //cria um foreach passando pela lista de funcionarios
                    foreach ($funcionario as $obj){

        //imprime os dados do obj
                        echo("<tr>");

                            /*echo("<td class='linhaTabela'>");
                            echo($obj->getCodigo());
                            echo("</td>");*/
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getNome());
                            echo("</td>");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getRg());
                            echo("</td>");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getCpf());
                            echo("</td>");
                            
                            /*echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getLogradouro());
                            echo("</td>");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getComplemento());
                            echo("</td>");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getNumCasa());
                            echo("</td>");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getCep());
                            echo("</td >");
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            echo($obj->getCidade());
                            echo("</td>");*/
                            
                            
                            
                            $cargos;
                            $pesqcargos = new FuncionarioCRUD();
                            $lista = $pesqcargos->ConsultarCargos($obj->getCodigo());
                            
                            echo("<td class='linhaTabelaCadAux'>");
                            foreach($lista as $cargos){
                                echo($cargos);
                                echo("<br>");
                            }
                            echo("</td>");
                            
                            
                            
                            echo("<td class='tdAcoes'>");
                            
                            echo("<div class='iconTabela'>");
                            
                            echo("<a href='#' name='vermais' id='vermais' onclick='vermais(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgverMais' src='../Imagens/none.png'></div></a>");
                            
                            echo("<a href='#' name='editar' value='' id='editar' onclick='editarfunc(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
                            echo(" ");
                            echo("<a href='#' name='button' value='' id='button' onclick='excluirfunc(".$obj->getCodigo().")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");
                            
                            echo("<a href='../Reports/reportsFuncionario.php?key_rpt_func=especific&id_func={$obj->getCodigo()}' target='_blank'><div class='iconTabela'> <img class='imgRelatorioEspecifico' src='../Imagens/none.png'> </div></a>");
                            echo("</td>");
                            
                            
                            
                            
                            
                            echo("</tr>");
                            
                            echo("</div>");
                        }
                //Paginação (apagar os "br")
                        echo("<br>");
                        echo("<br>");


                        ?>


                    </tbody>

                </table>
                <?php

                echo("<ul class='paginacaoCadAux'>");
                if(empty($_GET['pageFunc'])){} else { $pagina = $_GET['pageFunc'];}
                if(isset($pagina)){ $pagina = $_GET['pageFunc'];}else{$pagina =1;}

                $voltar = $pagina - 1;
                $seguir = $pagina + 1;
                $valorAtual = $pagina;

                if( $pagina !=  1){
                   echo "<li>"; 
                   echo "<a  href='#' id='pgaluno' name='pgaluno' onclick="."pgaluno('viewConsultarAluno.php?pageFunc=$voltar')"."><</a>";
                   echo "</li>";
               }else{}

                      // $pg =  $_POST["pageFunc"];
               while ($i  <= $calculo) {
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
                   echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$i')".">$i</a>";
                   $i++;
                   if($i > 10){
                    echo "<li>"; 
                    echo "<a>...</a>";
                    echo "</li>"; 

                    if(@$pagina > 11){
                        echo "<li>"; 
                        echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$valorAtual')".">$valorAtual </a>";
                        echo "</li>"; 
                    }else{
                        echo "<li>"; 
                        echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=11')".">11</a>";
                        echo "</li>"; 
                    }
                    if (@$pagina <  ($calculo +5)) {
                        echo "<li>"; 
                        echo "<a  href='#' id='pgfunc' name='pgfunc' onclick="."pgfunc('viewConsultarFuncionario.php?pageFunc=$seguir')".">></a>";
                        echo "</li>"; 
                    }
                    break;
                }    
            }
            echo("</ul>");
                //Paginação


            ?>

        </div>
        <br>
        <br><br>
    </div>


