<?php
include_once("Conexao.php");
include_once("../Model/Cronograma.php");


class CronogramaDAO{
    
    public function CadastrarCronograma($obj){
     
        $cronograma = new Cronograma();
        $cronograma = $obj;
        
        
        //passando os dados do objeto para as variaveis
        
               
                $turma = $cronograma->getTurma();
                
        //abrir a conexao com o banco de dados
                
                $db = Conexao::conexao();
                
        //inserir os dados no banco de dados
                
                $inseredados=$db->prepare("INSERT INTO tbcronograma (codTurma) VALUES (:turma)");
                $inseredados->bindValue(':turma', $turma, PDO::PARAM_INT);

                $inseredados->execute();
                
        //fechando a conexao
                
                Conexao::desconexao();
        
    }
    
    public function consultarCronograma($codCronograma){
       $pdo = Conexao::conexao();
       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codItensPorCronograma, descItensCronograma,horarioCronograma FROM tbitensporcronograma 
                                INNER JOIN tbitenscronograma 
                                    ON tbitensporcronograma.codItensCronograma = tbitenscronograma.codItensCronograma
                                        WHERE codCronograma = :codigo");
        
       $cmd->bindValue(':codigo', $codCronograma);
       $cmd->execute();
       $linha = $cmd->fetchAll(PDO::FETCH_ASSOC); 

       Conexao::desconexao();
       // Retorna a lista completa com os prontuarios
       return $linha;
    }
    
     public function pesquisarCronogramaTurma(&$turma){
        
         $pdo = Conexao::conexao();
        
         $cmd = $pdo->prepare("SELECT codCronograma FROM tbcronograma WHERE codTurma = :cod");
         $cmd->bindValue(":cod", $turma->getId());
         $cmd->execute();
         $resultado = $cmd->fetchColumn();
        
         Conexao::desconexao();
         return $resultado;
         
    }
    
    public function EditarCronograma($obj){
        
    }
    
    public function ExcluirCronograma($obj){
        
    }
    
    public function PreencherCronogramaTurma($cod){
        
    }
    
    
    
    
}



?>