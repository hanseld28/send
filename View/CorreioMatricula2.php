<?php
include_once("../Controller/ControllerMatricula.php");
include_once("../Controller/ControllerAtividadeExtraCurricular.php");


try{
    
    
    if(isset($_POST['turma_matricula']) && isset($_POST['numero_matricula']) && isset($_POST['cod_matricula']) && isset($_POST['data_matricula'])){
        $atividades = array();
        $atividades = $_POST['atividades_matricula'];
        $codMatricula = $_POST['cod_matricula'];
        $dataMatricula = $_POST['data_matricula'];
        $codTurma = $_POST['turma_matricula'];
        $numero = $_POST['numero_matricula'];
        $aux = str_replace('/', '-', $dataMatricula);
        $data = date('Y-m-d', strtotime($aux));
        
        //echo($data);
        
        $crud0 = new ControllerAtividadeExtraCurricular();
        $result = $crud0->editarAtividadeMatricula($codMatricula, $atividades);
        
        
        $crud = new ControllerMatricula();
        $resposta = $crud->editarMatricula($codMatricula, $data, $codTurma, $numero);
        
        if($resposta == true && $result == true){ 
                echo "<script> Alert.render('<h1>Matrícula editada com sucesso!</h1>')</script>";
                
                    
                }else{
                echo "<script> AlertdeErro.render('<h1>Ocorreu um erro ao editar a matrícula...</h1>')</script>";   
                }
        
        include_once("viewConsultarMatricula.php");
        
        
    }


}catch(Exception $e){
    
    echo $e->getMessage();
    
}

?>