<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="../css/sweetalert.min.css" />
<script src="../css/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styleExcluir.css"> 
<?php

include_once("../Controller/CronogramaCRUD.php");
include_once("verificaUsuarioLogado.php");
$codturma = 0;

session_start();

if(isset($_POST['codigo'])){
    $codturma = $_POST['codigo'];
    $_SESSION['turmacodigo'] = $codturma;
}else{

    if(isset($_SESSION['turmacodigo'])){

        $codturma = $_SESSION['turmacodigo'];
    }


}




$crud = new CronogramaCRUD();
$resposta = $crud->pesquisarCronogramaTurma($codturma);

$controller = new CronogramaCRUD();
$lista = $controller->consultarCronogramaTurma($resposta);



?>
<?php

echo('<a  href="#" id="abacadastroturma" name="abacadastroturma" onclick="cronogramaturma('.$codturma.')"><div class="abrirRelatorioGeralCadAux"><img src="../Imagens/add.png" alt=""></div></a>');
?>
<div class="barraPesquisaCadAux">

</div>

<a href="#" id="abaconsultacronograma" name="abaconsultacronograma"onclick="abaconsultacronograma('viewConsultarTurma.php')"><div class="abrirAbaCadastroAux"><img src="../Imagens/back.png"alt=""></div></a>

<h3 class="tituloConsultaCadAux">Cronograma</h3>
<table class="bordasimples" cellspacing="0">
    <thead>
        <tr>
            <td class="tituloTabelaCadAux">Código</td>  
            <td class="tituloTabelaCadAux">Atividade</td>
            <td class="tituloTabelaCadAux">Horario da atividade</td>
            <td class="tituloAcoesTabelaCadAux">Ações</td>

        </tr>
    </thead>
    <tbody>


        <?php


        foreach($lista as $itens){
            echo("<tr>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($itens['codItensPorCronograma']);
            $cod = $itens['codItensPorCronograma'];
            echo("</td>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($itens['descItensCronograma']);
            echo("</td>");

            echo("<td class='linhaTabelaCadAux'>");
            echo($itens['horarioCronograma']);
            echo("</td>");

            echo("<td class='tdAcoes'>");
            echo("<div class='iconTabela'>");

            echo("<a href='#' name='editar' value='' id='editar' onclick='editarcronogramaturma(".$cod.")'><div class='iconTabela'><img class='imgEditar' src='../Imagens/none.png'></div></a>");
            echo(" ");
            echo("<a href='#' name='excluir' value='' id='excluir' onclick='excluircronogramaturma(".$cod.")'><div class='iconTabela'><img class='imgExcluir' src='../Imagens/none.png'></div></a>");

            echo("</td>");

            echo("</tr>");
            echo("</div>");

        }



        ?>

        <script type="text/javascript" language="javascript">

            function abaconsultacronograma(pagina) {
            //carrega os dados de: pagina_conteudo.php na div id="conteudo"
            $("#painelCadAuxliar").load(pagina);
        };

        function abacadastrocaracteristicaaluno(pagina){
                //carrega os dados de: pagina_conteudo.php na div id="conteudo"
                $("#painelAbas").load(pagina);
            };
            
            
            function excluircronogramaturma(id){

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
                        url: "editaExcluiCronogramaTurma.php",
                        dataType: "html",
                        type: "POST",
                        data: { id: id},
                        success: function(data){
                            $('#painelCadAuxliar').html(data);
                        },
                    });     
                   } 
               });



                
            }
            
            function editarcronogramaturma(id){


                $.ajax({ 
                    asyn: false,
                    url: "edicaoCronogramaTurma.php",
                    dataType: "html",
                    type: "POST",
                    data: { id: id},
                    success: function(data){
                        $('#painelCadAuxliar').html(data);
                    },
                });
                
            }

            function cronogramaturma(id){

                $.ajax({ 
                    asyn: false,
                    url: "pageCadastroCronogramaTurma.php",
                    dataType: "html",
                    type: "POST",
                    data: { id: id},
                    success: function(data){
                        $('#painelCadAuxliar').html(data);
                    },
                });
                
            }

        </script>


    </tbody>
</table>
