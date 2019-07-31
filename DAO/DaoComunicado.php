<?php

include_once("..\DAO\Conexao.php");
include_once("..\Model\Comunicado.php");
include_once("..\Model\Agenda.php");
include_once("..\Model\Turma.php");
include_once("..\Model\Usuario.php");

/**
 * Description of DaoComunicado
 *
 * @author hansel 
 */

class DaoComunicado {

  public function cadastrarComunicado($novoComunicado) { 

   $pdo = Conexao::conexao();

   try {

     $count = 0;
     $size = $novoComunicado->agendas->count();

         // Prepara o cadastro
     $cmd = $pdo->prepare("INSERT INTO tbComunicado(assuntoComunicado, descComunicado, codTurma, codUsuario) 
      VALUES (:assuntoComunicado, :descComunicado, :codTurma, :codUsuario)");

     $cmd->bindValue(":assuntoComunicado", $novoComunicado->getAssunto(), PDO::PARAM_STR);
     $cmd->bindValue(":descComunicado", $novoComunicado->getDescricao(), PDO::PARAM_STR);
     $cmd->bindValue(":codTurma", $novoComunicado->turma->getId(), PDO::PARAM_INT);
     $cmd->bindValue(":codUsuario", $novoComunicado->usuario->getId(), PDO::PARAM_INT);
     $cmd->execute();

     $cmd2 = $pdo->prepare("SELECT MAX(codComunicado) FROM tbComunicado");



     if($cmd->rowCount() > 0) 
     {
      if($cmd2->execute())
      {

        $linha = $cmd2->fetch(PDO::FETCH_COLUMN);
        $novoComunicado->setId(intval($linha));

        foreach($novoComunicado->agendas as $agenda)
        {         
         $cmd3 = $pdo->prepare("INSERT INTO tbcomunicadoagenda(codComunicado, codAgenda) 
          VALUES (:codComunicado, :codAgenda)");
         $cmd3->bindValue(":codComunicado", $novoComunicado->getId(), PDO::PARAM_INT);  
         $cmd3->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
         $cmd3->execute();

         $count++;
       }

     }

   }
   

   if($count == $size) 
   {
    return true;  
  } 
  else 
  {
    return false;
  }

} 
catch (PDOException $e) 
{
  echo $e->getMessage();
}

Conexao::desconexao();

}

public function visualizarTodosComunicadosEnviados($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
    //PAGINAÇÃO
    $i = 1;
    $listarcargos_pg=$pdo->prepare("SELECT codComunicado, assuntoComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
      FROM tbcomunicado 
      INNER JOIN tbturma
      ON tbcomunicado.codTurma = tbturma.codTurma
      WHERE codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroComunicado DESC");

    $listarcargos_pg->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $listarcargos_pg->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    $listarcargos_pg->execute();

    $count = $listarcargos_pg->rowCount();
    $calculo = ceil(($count/10));

    while ($i <= $calculo) {
      $i++;
    }

    $_POST['calculoTodosComunicados'] = $calculo;

    $url = 0;
    $mody =0;
    if (isset($_GET['pageTodosComunicados']) == $i) {
      $url= $_GET['pageTodosComunicados'];
      $mody = ($url*10)-10;
    }
       //PAGINAÇÃO
    
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codComunicado, assuntoComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
      FROM tbcomunicado 
      INNER JOIN tbturma
      ON tbcomunicado.codTurma = tbturma.codTurma
      WHERE codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroComunicado DESC");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


    if ($cmd->execute())
    {
         // Cria uma lista para armazenar todas os comunicados
         $listaComunicadosEnviados = new ArrayObject();

                     // Retorna uma matriz da tabela do banco de dados
                     // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                     // onde é armazenada em um objeto 'rotinas' que é adicionado 
                     // a uma lista de rotinas
        if ($cmd->rowCount() > 0)
        {
           while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
             $comunicado = new Comunicado();
             $comunicado->setId(intval($linha['codComunicado']));
             $comunicado->setAssunto($linha['assuntoComunicado']);
             $comunicado->setDescricao($linha['descComunicado']);
             $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

             $usuario = new Usuario();
             $usuario->setId(intval($linha['codUsuario']));
             $comunicado->addUsuario($usuario);

             $turma = new Turma();
             $turma->setDescricao($linha['nomeTurma']);
             $comunicado ->addTurma($turma);

             $listaComunicadosEnviados->append($comunicado);
           }

           return $listaComunicadosEnviados;
        }
        else
        {
           return false;  
        }   
   }

 } 
 catch (PDOException $e) 
 {
  echo $e->getMessage();
} 
finally 
{
  Conexao::desconexao();    
} 
} 


public function visualizarComunicadosMaisAntigos($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codComunicado, assuntoComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
      FROM tbcomunicado 
      INNER JOIN tbturma
      ON tbcomunicado.codTurma = tbturma.codTurma
      WHERE codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroComunicado ASC");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


    if ($cmd->execute())
    {
      if($cmd->rowCount() > 0)
      {
          // Cria uma lista para armazenar todas os comunicados
          $listaComunicadosEnviados = new ArrayObject();

           // Retorna uma matriz da tabela do banco de dados
           // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
           // onde é armazenada em um objeto 'rotinas' que é adicionado 
           // a uma lista de rotinas
          while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
             $comunicado = new Comunicado();
             $comunicado->setId(intval($linha['codComunicado']));
             $comunicado->setAssunto($linha['assuntoComunicado']);
             $comunicado->setDescricao($linha['descComunicado']);
             $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

             $usuario = new Usuario();
             $usuario->setId(intval($linha['codUsuario']));
             $comunicado->addUsuario($usuario);

             $turma = new Turma();
             $turma->setDescricao($linha['nomeTurma']);
             $comunicado ->addTurma($turma);

             $listaComunicadosEnviados->append($comunicado);
          }

          return $listaComunicadosEnviados;
      }
      else
      {
          return false;
      }   
   }

 } 
 catch (PDOException $e) 
 {
  echo $e->getMessage();
} 
finally 
{
  Conexao::desconexao();    
} 
} 

public function visualizarComunicadosEnviadosIntervaloData($usuario, $data_de, $data_ate, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codComunicado, assuntoComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
      FROM tbcomunicado 
      INNER JOIN tbturma
      ON tbcomunicado.codTurma = tbturma.codTurma
      WHERE codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma
      AND DATE(dataCadastroComunicado) BETWEEN :data_de AND :data_ate
      ORDER BY dataCadastroComunicado DESC");

    $cmd->bindValue(":data_de", $data_de, PDO::PARAM_STR);
    $cmd->bindValue(":data_ate", $data_ate, PDO::PARAM_STR);
    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    if ($cmd->execute())
    {
                 // Cria uma lista para armazenar todos os comunicados
     $listaComunicadosEnviadasIntervaloData = new ArrayObject();

                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'comunicado' que é adicionado 
                 // a uma lista de comunicados
     if ($cmd->rowCount() > 0)
     {
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
         $comunicado = new Comunicado();
         $comunicado->setId(intval($linha['codComunicado']));
         $comunicado->setAssunto($linha['assuntoComunicado']);
         $comunicado->setDescricao($linha['descComunicado']);
         $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

         $usuario = new Usuario();
         $usuario->setId(intval($linha['codUsuario']));
         $comunicado->addUsuario($usuario);

         $turma = new Turma();
         $turma->setDescricao($linha['nomeTurma']);
         $comunicado ->addTurma($turma);

         $listaComunicadosEnviadasIntervaloData->append($comunicado);
       }

       return $listaComunicadosEnviadasIntervaloData;
     }
     else
     {
       return false;
     }
   }


 } 
 catch (PDOException $e) 
 {
  echo $e->getMessage();
} 
finally 
{
  Conexao::desconexao();    
} 

}

public function visualizarComunicadosRecentes($usuario, $turma, $limite)
{
  $pdo = Conexao::conexao();

  try
  {

    // //PAGINAÇÃO
    // $i = 1;
    // $listarcargos_pg=$pdo->prepare("SELECT codComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
    //   FROM tbcomunicado 
    //   INNER JOIN tbturma
    //   ON tbcomunicado.codTurma = tbturma.codTurma
    //   WHERE codUsuario = :codUsuario");

    // $listarcargos_pg->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    // $listarcargos_pg->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    // $listarcargos_pg->execute();

    // $count = $listarcargos_pg->rowCount();
    // $calculo = ceil(($count/10));

    // while ($i <= $calculo) {
    //   $i++;
    // }

    // $_POST['calculoRecentesComunicados'] = $calculo;

    // $url = 0;
    // $mody =0;
    // if (isset($_GET['pageRecentesComunicados']) == $i) {
    //   $url= $_GET['pageRecentesComunicados'];
    //   $mody = ($url*10)-10;
    // }
    //    //PAGINAÇÃO
    // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codComunicado, assuntoComunicado, descComunicado, nomeTurma, codUsuario, dataCadastroComunicado
      FROM tbcomunicado 
      INNER JOIN tbturma
      ON tbcomunicado.codTurma = tbturma.codTurma
      WHERE codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroComunicado DESC ");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);
    //$cmd->bindValue(":limite", $limite, PDO::PARAM_INT);

    if ($cmd->execute())
    {
      if($cmd->rowCount() > 0)
      {
           // Cria uma lista para armazenar todas os comunicados
           $listaComunicadosRecentes = new ArrayObject();

                       // Retorna uma matriz da tabela do banco de dados
                       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                       // onde é armazenada em um objeto 'comunicado' que é adicionado 
                       // a uma lista de comunicados
           while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
             $comunicado = new Comunicado();
             $comunicado->setId(intval($linha['codComunicado']));
             $comunicado->setAssunto($linha['assuntoComunicado']);
             $comunicado->setDescricao($linha['descComunicado']);
             $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

             $usuario = new Usuario();
             $usuario->setId(intval($linha['codUsuario']));
             $comunicado->addUsuario($usuario);

             $turma = new Turma();
             $turma->setDescricao($linha['nomeTurma']);
             $comunicado ->addTurma($turma);

             $listaComunicadosRecentes->append($comunicado);
           }

           return $listaComunicadosRecentes;
      }
      else 
      {
           return false;
      }    
   }

 } 
 catch (PDOException $e) 
 {
  echo $e->getMessage();
} 
finally 
{
  Conexao::desconexao();    
} 
} 

    
    public function buscarTodosComunicadosRecebidos($agenda)
  {
      $pdo = Conexao::conexao();

      try
      {     
          // Prepara o cadastro
          $cmd = $pdo->prepare("SELECT tbcomunicado.codComunicado, assuntoComunicado, descComunicado, codAgenda, nomeTurma, nomeUsuario, dataCadastroComunicado
                                FROM tbcomunicadoagenda
                                INNER JOIN tbcomunicado
                                ON tbcomunicadoagenda.codComunicado = tbcomunicado.codComunicado
                                INNER JOIN tbturma
                                ON tbcomunicado.codTurma = tbturma.codTurma
                                INNER JOIN tbusuario
                                ON tbcomunicado.codUsuario = tbusuario.codUsuario
                                WHERE codAgenda = :codAgenda
                                ORDER BY dataCadastroComunicado DESC");

          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);

          if ($cmd->execute())
          {
              // Cria uma lista para armazenar todas os comunicados
              $listaComunicadosRecebidos = new ArrayObject();

              // Retorna uma matriz da tabela do banco de dados
              // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
              // onde é armazenada em um objeto 'comunicado' que é adicionado 
              // a uma lista de comunicaods
             while($linha = $cmd->fetch(PDO::FETCH_ASSOC))
             {
                 $comunicado = new Comunicado();
                 $comunicado->setId(intval($linha['codComunicado']));
                 $comunicado->setAssunto($linha['assuntoComunicado']);
                 $comunicado->setDescricao($linha['descComunicado']);
                 $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

                 $agenda = new Agenda();
                 $agenda->setId(intval($linha['codAgenda']));
                 $comunicado->addAgenda($agenda);

                 $usuario = new Usuario();
                 $usuario->setNome($linha['nomeUsuario']);
                 $comunicado->addUsuario($usuario);

                 $turma = new Turma();
                 $turma->setDescricao($linha['nomeTurma']);
                 $comunicado ->addTurma($turma);

                 $listaComunicadosRecebidos->append($comunicado);
             }

             return $listaComunicadosRecebidos;
         }

      } 
      catch (PDOException $e) 
      {
          echo $e->getMessage();
      } 
      finally 
      {
          Conexao::desconexao();    
      } 
  }    


public function visualizarComunicadoRecebido($agenda, &$comunicado)
  {
      $pdo = Conexao::conexao();

      try
      {     
          // Prepara o cadastro
          $cmd = $pdo->prepare("SELECT tbcomunicado.codComunicado, assuntoComunicado, descComunicado, codAgenda, nomeTurma, nomeUsuario, dataCadastroComunicado
                                FROM tbcomunicadoagenda
                                INNER JOIN tbcomunicado
                                ON tbcomunicadoagenda.codComunicado = tbcomunicado.codComunicado
                                INNER JOIN tbturma
                                ON tbcomunicado.codTurma = tbturma.codTurma
                                INNER JOIN tbusuario
                                ON tbcomunicado.codUsuario = tbusuario.codUsuario
                                WHERE codAgenda = :codAgenda
                                AND tbcomunicado.codComunicado = :codComunicado
                                ORDER BY dataCadastroComunicado DESC");

          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
          $cmd->bindValue(":codComunicado", $comunicado->getId(), PDO::PARAM_INT);

          if ($cmd->execute())
          {
             $linha = $cmd->fetch(PDO::FETCH_ASSOC);
             
             $comunicado->setId(intval($linha['codComunicado']));
             $comunicado->setAssunto($linha['assuntoComunicado']);
             $comunicado->setDescricao($linha['descComunicado']);
             $comunicado ->setDataCadastro($linha['dataCadastroComunicado']);

             $agenda = new Agenda();
             $agenda->setId(intval($linha['codAgenda']));
             $comunicado->addAgenda($agenda);

             $usuario = new Usuario();
             $usuario->setNome($linha['nomeUsuario']);
             $comunicado->addUsuario($usuario);

             $turma = new Turma();
             $turma->setDescricao($linha['nomeTurma']);
             $comunicado ->addTurma($turma);
         }

      } 
      catch (PDOException $e) 
      {
          echo $e->getMessage();                                          
      } 
      finally 
      {
          Conexao::desconexao();    
      } 
  } 


    // Contagem de comunicados da Agenda
  public function contarComunicadosRecebidos($agenda)
  {
      $pdo = Conexao::conexao();

      try
      {     
          // Prepara o cadastro
          $cmd = $pdo->prepare("SELECT COUNT(codComunicado) FROM tbcomunicadoagenda
                                WHERE codAgenda = :codAgenda");

          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);

          if ($cmd->execute())
          {
             $qtd_comunicados = intval($cmd->fetch(PDO::FETCH_COLUMN));
             
             return $qtd_comunicados;
          }

      } 
      catch (PDOException $e) 
      {
          echo $e->getMessage();
      } 
      finally 
      {
          Conexao::desconexao();    
      }

  }


    /*
    public function consultarComunicado(){
       
       $pdo = Conexao::conexao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codComunicado, dataComunicado, nomeAluno, nomeTurma, descPeriodo FROM tbComunicado
                                INNER JOIN tbaluno
                                  ON tbComunicado.codAluno = tbaluno.codAluno
                                    INNER JOIN tbturma
                                      ON tbComunicado.codTurma = tbturma.codTurma
                                        INNER JOIN tbperiodo
                                          ON tbComunicado.codPeriodo = tbperiodo.codPeriodo");
       
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as turmas
       $listaComunicados = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $Comunicado = new Comunicado();
           $Comunicado->setId($linha['codComunicado']);
           $Comunicado->setData($linha['dataComunicado']);

           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $Comunicado->addAluno($aluno);

           $turma = new Turma();
           $turma->setNome($linha['nomeTurma']);
           $Comunicado->addTurma($turma);

           $periodo = new Periodo();
           $periodo->setDescricao($linha['descPeriodo']);
           $Comunicado->addPeriodo($periodo);

           $listaComunicados->append($Comunicado);
       }
       
       Conexao::desconexao();
       // Retorna a lista completa com as Comunicados
       return $listaComunicados;
    }
      
    public function editarComunicado($editarComunicado){

        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
     
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbComunicado SET dataComunicado = :dataComunicado, 
                                      codAluno = :codAluno, 
                                          codTurma = :codTurma, 
                                            codPeriodo = :codPeriodo 
                                              WHERE codComunicado = :codComunicado");

            // Substitui os valores
            $cmd->bindValue(":dataComunicado", $editarComunicado->getData(), PDO::PARAM_STR);
            $cmd->bindValue(":codAluno", $editarComunicado->aluno->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codTurma", $editarComunicado->turma->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codPeriodo", $editarComunicado->periodo->getId(), PDO::PARAM_INT); 
            
            $cmd->execute();

            if($cmd->rowCount() > 0): 
              return true;  
            else: 
              return false; 
            endif;
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();    
        }    

    }
    
    public function excluirComunicado($excluirComunicado){
         
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
            
            $cmd = $pdo->prepare("DELETE FROM tbComunicado WHERE codComunicado = :codComunicado");
            $cmd->bindValue(":codComunicado", $excluirComunicado->getId(), PDO::PARAM_INT);
            $cmd->execute();

            if($cmd->rowCount() == 1): 
              return true;
            else: 
              return false; 
            endif;
 
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally {
            Conexao::desconexao();
        }
    
    }


    ////////////////////////////////////////////////////
    // Métodos Auxiliares
    ////////////////////////////////////////////////////
    public function preencherComunicado(&$Comunicado){ // '&' representa uma Passagem por Referência
        
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
            
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codComunicado, dataComunicado, codAluno, codTurma, codPeriodo FROM tbComunicado
                                   WHERE codComunicado = :codComunicado");

           $cmd->bindValue(":codComunicado", $Comunicado->getId(), PDO::PARAM_INT); 
           
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $Comunicado->setId($linha->codComunicado);
                $Comunicado->setData($linha->dataComunicado);

                $aluno = new Aluno();
                $aluno->setId($linha->codAluno);
                $Comunicado->addAluno($aluno);

                $turma = new Turma();
                $turma->setId($linha->codTurma);
                $Comunicado->addTurma($turma);

                $periodo = new Periodo();
                $periodo->setId($linha->codPeriodo);
                $Comunicado->addPeriodo($periodo);

                return $Comunicado;
           }
       } catch (PDOException $e){
           echo $e->getMessage();
       } finally {
           Conexao::desconexao();
       }
    }

     */
  }

  ?>