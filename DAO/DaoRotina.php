<?php

include_once("..\DAO\Conexao.php");
include_once("..\Model\Rotina.php");
include_once("..\Model\Turma.php");
include_once("..\Model\Card.php");
include_once("..\Model\Alternativa.php");
include_once("..\Model\Ocorrencia.php");
include_once("..\Model\Usuario.php");
include_once("..\Model\Aluno.php");

/**
 * Description of DaoRotina
 *
 * @author hansel
 */

class DaoRotina {

  public function cadastrarRotina($novaRotina, $listaOcorrencias, $limit) 
  { 
      $pdo = Conexao::conexao();

      try 
      {  
         $size = $novaRotina->agendas->count();
         $count = 0;

         foreach($novaRotina->agendas as $agenda) 
         {
            // Verifica se uma rotina já foi enviada para a agenda na data atual 
            $cmd7 = $pdo->prepare("SELECT codRotina FROM tbrotina 
              WHERE dataCadastroRotina 
              BETWEEN TIME('00:00:00') AND TIME('23:59:59') 
              AND DATE(dataCadastroRotina) = CURDATE()
              AND codAgenda = :codAgenda");
                  //AND codUsuario = :codUsuario
            $cmd7->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
                  //$cmd7->bindValue(":codUsuario", $novaRotina->usuario->getId(), PDO::PARAM_INT);


            if ($cmd7->execute())
            {
                $codRotina = $novaRotina->getId();

                if ($cmd7->rowCount() > 0) 
                {
                    $linha_rotina = $cmd7->fetch(PDO::FETCH_COLUMN);
                    $codRotina = intval($linha_rotina);

                    return "A rotina diária para o(s) aluno(s) já foi enviada. Espere até o dia seguinte.";
                }
                else
                {
                   // Prepara o cadastro
                   $cmd = $pdo->prepare("INSERT INTO tbrotina(codAgenda, codTurma, codUsuario, horarioEnvioRotina) 
                    VALUES (:codAgenda, :codTurma, :codUsuario, :horarioEnvio)");

                   $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
                   $cmd->bindValue(":codTurma", $novaRotina->turma->getId(), PDO::PARAM_INT);
                   $cmd->bindValue(":codUsuario", $novaRotina->professor->getId(), PDO::PARAM_INT);
                   $cmd->bindValue(":horarioEnvio", $novaRotina->getHorarioEnvio(), PDO::PARAM_STR);
                   $cmd->execute();


                   $cmd2 = $pdo->prepare("SELECT MAX(codRotina) FROM tbrotina");

                   if($cmd->rowCount() > 0) 
                   {
                      if($cmd2->execute())
                      {
                          $linha = $cmd2->fetch(PDO::FETCH_COLUMN);
                          $novaRotina->setId(intval($linha));

                          // Cria um indíce para controlar o número máximo de voltas do laço de repetição
                          $i = 0;

                          // Cria um iterador (da lista de cards) para gerenciar o laço de repetição
                          $iterator = $novaRotina->cards->getIterator();

                          while ($iterator->valid()) 
                          {
                            if ($i == $limit)
                            {
                                break;
                            }
                            else
                            { 
                               $card = $iterator->current(); 
                               $key = $iterator->key();

                               $cmd3 = $pdo->prepare("INSERT INTO tbcardrotina(codCard, codRotina) 
                                VALUES (:codCard, :codRotina)");
                               $cmd3->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                               $cmd3->bindValue(":codRotina", $novaRotina->getId(), PDO::PARAM_INT);

                               if($cmd3->execute())
                               {
                                  $cmd4 = $pdo->prepare("INSERT INTO tbalternativacard(codAlternativa, codCard, codRotina) 
                                    VALUES (:codAlternativa, :codCard, :codRotina)");
                                  $cmd4->bindValue(":codAlternativa", $card->alternativa->getId(), PDO::PARAM_INT);
                                  $cmd4->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                                  $cmd4->bindValue(":codRotina", $novaRotina->getId(), PDO::PARAM_INT);
                                  $cmd4->execute();
                               }

                               // Remove o objeto card c/ alternativa que já foi
                               // salva no banco de dados da memória
                               // através da "key" do array
                               unset($iterator[$key]); 
                               
                               $i++;
                            }   
                             // Muda o ponteiro do laço uma posição a frente
                             //$iterator->next();

                          }

                          if(key_exists($agenda->getId(), $listaOcorrencias))
                          {

                              foreach ($listaOcorrencias as $idAgenda => $ocorrencia) 
                              {

                                  if (empty($ocorrencia))
                                  {
                                      continue;    
                                  }  
                                  else
                                  {
                                      $cmd5 = $pdo->prepare("INSERT INTO tbocorrencia(descOcorrencia, codAgenda) 
                                        VALUES (:descOcorrencia, :codAgenda)");
                                      $cmd5->bindValue(":descOcorrencia", $ocorrencia, PDO::PARAM_STR);
                                      $cmd5->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
                                      $cmd5->execute();

                                      $cmd6 = $pdo->prepare("SELECT MAX(codOcorrencia) FROM tbocorrencia WHERE codAgenda = :codAgenda");
                                      $cmd6->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);

                                      if($cmd6->execute())
                                      {
                                          $linha_ocorrencia = $cmd6->fetch(PDO::FETCH_COLUMN);
                                          $codOcorrencia = intval($linha_ocorrencia);


                                          $cmd8 = $pdo->prepare("INSERT INTO tbocorrenciarotina(codOcorrencia, codRotina) 
                                           VALUES (:codOcorrencia, :codRotina)");
                                          $cmd8->bindValue(":codOcorrencia", $codOcorrencia, PDO::PARAM_INT);
                                          $cmd8->bindValue(":codRotina", $novaRotina->getId(), PDO::PARAM_INT);
                                          $cmd8->execute();

                                      }

                                  } 

                                  unset($listaOcorrencias[$idAgenda]);

                                  break;

                               }

                           }

                      }

                  }

              }

           }

           $count++;
      }

      if ($count == $size) 
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
       // */
  }

public function adicionarOcorrenciaRotina($novaRotina, $listaOcorrencias)
{
  $pdo = Conexao::conexao();

  try 
  {  
   $size = $novaRotina->agendas->count();
   $count = 0;

   foreach($novaRotina->agendas as $agenda) 
   {

    if(key_exists($agenda->getId(), $listaOcorrencias))
    {

      foreach ($listaOcorrencias as $idAgenda => $ocorrencia) 
      {

        if (empty($ocorrencia))
        {
          continue;    
        }  
        else
        {
          $cmd = $pdo->prepare("SELECT codRotina FROM tbrotina 
            WHERE dataCadastroRotina 
            BETWEEN TIME('00:00:00') AND TIME('23:59:59') 
            AND DATE(dataCadastroRotina) = CURDATE()
            AND codAgenda = :codAgenda");
                          //AND codUsuario = :codUsuario
          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
                          //$cmd->bindValue(":codUsuario", $novaRotina->usuario->getId(), PDO::PARAM_INT);

          if ($cmd->execute())
          {
            $codRotina = $novaRotina->getId();

            if ($cmd->rowCount() > 0) 
            {
              $linha_rotina = $cmd->fetch(PDO::FETCH_COLUMN);
              $codRotina = intval($linha_rotina);

              $cmd2 = $pdo->prepare("INSERT INTO tbocorrencia(descOcorrencia, codAgenda) 
                VALUES (:descOcorrencia, :codAgenda)");
              $cmd2->bindValue(":descOcorrencia", $ocorrencia, PDO::PARAM_STR);
              $cmd2->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
              $cmd2->execute();

              $cmd3 = $pdo->prepare("SELECT MAX(codOcorrencia) FROM tbocorrencia WHERE codAgenda = :codAgenda");
              $cmd3->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);

              if($cmd3->execute())
              {  
                $linha_ocorrencia = $cmd3->fetch(PDO::FETCH_COLUMN);
                $codOcorrencia = intval($linha_ocorrencia);

                $cmd4 = $pdo->prepare("INSERT INTO tbocorrenciarotina(codOcorrencia, codRotina) 
                 VALUES (:codOcorrencia, :codRotina)");
                $cmd4->bindValue(":codOcorrencia", $codOcorrencia, PDO::PARAM_INT);
                $cmd4->bindValue(":codRotina", $codRotina, PDO::PARAM_INT);
                $cmd4->execute();
              }

            }
            else
            {
              return "Nenhuma rotina foi enviada para o(a) aluno(a) ainda.";
            }

          }  

        } 

        unset($listaOcorrencias[$idAgenda]);

        break;

      }

    }

    $count++;
  }

  if ($count == $size) 
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
        //*/
}

public function checarRotinaEnviada($agenda)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codAgenda FROM tbrotina 
      WHERE dataCadastroRotina 
      BETWEEN TIME('00:00:00') AND TIME('23:59:59') 
      AND DATE(dataCadastroRotina) = CURDATE()
      AND codAgenda = :codAgenda");

    $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);

    if ($cmd->execute())
    {
      if ($cmd->rowCount() > 0) 
      {
        return true;
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

public function visualizarTodasRotinasEnviadas($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
       //PAGINAÇÃO
    $i = 1;
    $listarcargos_pg=$pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma
      WHERE tbrotina.codUsuario = :codUsuario AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroRotina DESC");

    $listarcargos_pg->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $listarcargos_pg->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    $listarcargos_pg->execute();

    $count = $listarcargos_pg->rowCount();
    $calculo = ceil(($count/10));

    while ($i <= $calculo) {
      $i++;
    }

    $_POST['calculoTodasRotinas'] = $calculo;

    $url = 0;
    $mody =0;
    if (isset($_GET['pageTodasRotinas']) == $i) {
      $url= $_GET['pageTodasRotinas'];
      $mody = ($url*10)-10;
    }
       //PAGINAÇÃO

    // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma
      WHERE tbrotina.codUsuario = :codUsuario AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroRotina DESC");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


    if ($cmd->execute())
    {
       // Cria uma lista para armazenar todas as rotinas
       $listaRotinasEnviadas = new ArrayObject();

                   // Retorna uma matriz da tabela do banco de dados
                   // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                   // onde é armazenada em um objeto 'rotinas' que é adicionado 
                   // a uma lista de rotinas
       if ($cmd->rowCount() > 0)
       {
         while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $rotina = new Rotina();
           $rotina->setId($linha['codRotina']);

           $rotina->setDataCadastro($linha['dataCadastroRotina']);

           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $rotina->addAluno($aluno);

           $turma = new Turma();
           $turma->setDescricao($linha['nomeTurma']);
           $rotina->addTurma($turma);

           $listaRotinasEnviadas->append($rotina);
         }

         return $listaRotinasEnviadas;
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

public function visualizarTodasRotinasEnviadasMaisAntigas($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
    // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma
      WHERE tbrotina.codUsuario = :codUsuario AND nomeTurma LIKE :nomeTurma
      ORDER BY dataCadastroRotina ASC");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


    if ($cmd->execute())
    {
                 // Cria uma lista para armazenar todas as rotinas
     $listaRotinasEnviadas = new ArrayObject();

                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
     while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
       $rotina = new Rotina();
       $rotina->setId($linha['codRotina']);
       $rotina->setDataCadastro($linha['dataCadastroRotina']);

       $aluno = new Aluno();
       $aluno->setNome($linha['nomeAluno']);
       $rotina->addAluno($aluno);

       $turma = new Turma();
       $turma->setDescricao($linha['nomeTurma']);
       $rotina->addTurma($turma);

       $listaRotinasEnviadas->append($rotina);
     }

     return $listaRotinasEnviadas;
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


public function visualizarRotinasEnviadasDataAtual($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma 
      WHERE DATE(dataCadastroRotina) = CURDATE() 
      AND nomeTurma LIKE :nomeTurma
      AND tbrotina.codUsuario = :codUsuario");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    if ($cmd->execute())
    {
                 // Cria uma lista para armazenar todas as rotinas
     $listaRotinasEnviadasDataAtual = new ArrayObject();

                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
     if ($cmd->rowCount() > 0)
     {
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
         $rotina = new Rotina();
         $rotina->setId($linha['codRotina']);
         $rotina->setDataCadastro($linha['dataCadastroRotina']);

         $aluno = new Aluno();
         $aluno->setNome($linha['nomeAluno']);
         $rotina->addAluno($aluno);

         $turma = new Turma();
         $turma->setDescricao($linha['nomeTurma']);
         $rotina->addTurma($turma);

         $listaRotinasEnviadasDataAtual->append($rotina);
       }

       return $listaRotinasEnviadasDataAtual;
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

public function visualizarRotinasEnviadasIntervaloData($usuario, $data_de, $data_ate, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma 
      WHERE DATE(dataCadastroRotina) BETWEEN :data_de AND :data_ate
      AND nomeTurma LIKE :nomeTurma 
      AND tbrotina.codUsuario = :codUsuario");

    $cmd->bindValue(":data_de", $data_de, PDO::PARAM_STR);
    $cmd->bindValue(":data_ate", $data_ate, PDO::PARAM_STR);
    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    if ($cmd->execute())
    {
                 // Cria uma lista para armazenar todas as rotinas
     $listaRotinasEnviadasIntervaloData = new ArrayObject();

                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
     if ($cmd->rowCount() > 0)
     {
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
         $rotina = new Rotina();
         $rotina->setId($linha['codRotina']);
         $rotina->setDataCadastro($linha['dataCadastroRotina']);

         $aluno = new Aluno();
         $aluno->setNome($linha['nomeAluno']);
         $rotina->addAluno($aluno);

         $turma = new Turma();
         $turma->setDescricao($linha['nomeTurma']);
         $rotina->addTurma($turma);

         $listaRotinasEnviadasIntervaloData->append($rotina);
       }

       return $listaRotinasEnviadasIntervaloData;
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

public function visualizarRotinasRecentes($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {

     //PAGINAÇÃO
    $i = 1;
    $listarcargos_pg=$pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma 
      WHERE nomeTurma LIKE :nomeTurma 
      AND tbrotina.codUsuario = :codUsuario");

    $listarcargos_pg->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $listarcargos_pg->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);
    $listarcargos_pg->execute();

    $count = $listarcargos_pg->rowCount();
    $calculo = ceil(($count/10));

    while ($i <= $calculo) {
      $i++;
    }

    $_POST['calculoRotinas'] = $calculo;

    $url = 0;
    $mody =0;
    if (isset($_GET['pageRotinas']) == $i) {
      $url= $_GET['pageRotinas'];
      $mody = ($url*10)-10;
    }
       //PAGINAÇÃO

            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, nomeAluno, nomeTurma, dataCadastroRotina 
      FROM tbrotina 
      INNER JOIN tbagenda
      ON tbrotina.codAgenda = tbagenda.codAgenda
      INNER JOIN tbaluno
      ON tbagenda.codAluno = tbaluno.codAluno
      INNER JOIN tbprofessorturma 
      ON tbrotina.codTurma = tbprofessorturma.codTurma
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma 
      WHERE nomeTurma LIKE :nomeTurma 
      AND tbrotina.codUsuario = :codUsuario
      ORDER BY dataCadastroRotina DESC  
      LIMIT 10 OFFSET {$mody}");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    if ($cmd->execute())
    {
                 // Cria uma lista para armazenar todas as rotinas
     $listaRotinasEnviadasDataAtual = new ArrayObject();

                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
     if ($cmd->rowCount() > 0)
     {
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
         $rotina = new Rotina();
         $rotina->setId($linha['codRotina']);
         $rotina->setDataCadastro($linha['dataCadastroRotina']);

         $aluno = new Aluno();
         $aluno->setNome($linha['nomeAluno']);
         $rotina->addAluno($aluno);

         $turma = new Turma();
         $turma->setDescricao($linha['nomeTurma']);
         $rotina->addTurma($turma);

         $listaRotinasEnviadasDataAtual->append($rotina);
       }

       return $listaRotinasEnviadasDataAtual;
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


public function dadosAnaliticosRotinasTurma($turma)
    {
        $pdo = Conexao::conexao();

        try
        {
                  // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT COUNT(codRotina) FROM tbrotina
                                  WHERE codTurma = :codTurma
                                  AND dataCadastroRotina 
                                  BETWEEN TIME('00:00:00') AND TIME('23:59:59') 
                                  AND DATE(dataCadastroRotina) = CURDATE()");

            $cmd->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);

            $cmd2 = $pdo->prepare("SELECT COUNT(tbocorrencia.codOcorrencia) FROM tbocorrencia
                                    INNER JOIN tbocorrenciarotina
                                    ON tbocorrencia.codOcorrencia = tbocorrenciarotina.codOcorrencia
                                    INNER JOIN tbrotina
                                    ON tbocorrenciarotina.codRotina = tbrotina.codRotina
                                    WHERE codTurma = :codTurma 
                                    AND dataCadastroRotina 
                                    BETWEEN TIME('00:00:00') AND TIME('23:59:59') 
                                    AND DATE(dataCadastroRotina) = CURDATE()");

            $cmd2->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);

            if ($cmd->execute() && $cmd2->execute())
            {
                $dadosRotinas = array();

                $dadosRotinas['enviadas'] = intval($cmd->fetch(PDO::FETCH_COLUMN));
                $dadosRotinas['qtdOcorrencias'] = intval($cmd2->fetch(PDO::FETCH_COLUMN));
                
                return $dadosRotinas;
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



public function dataUltimaRotinaEnviada($usuario, $turma)
{
  $pdo = Conexao::conexao();

  try
  {
            // Prepara o cadastro
    $cmd = $pdo->prepare("SELECT codRotina, horarioEnvioRotina, dataCadastroRotina FROM tbrotina 
      WHERE codRotina = (
      SELECT MAX(codRotina) FROM tbrotina
      INNER JOIN tbturma
      ON tbrotina.codTurma = tbturma.codTurma 
      WHERE tbrotina.codUsuario = :codUsuario
      AND nomeTurma LIKE :nomeTurma)");

    $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
    $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);

    if ($cmd->execute())
    {
     if ($cmd->rowCount() > 0)
     {
       $linha = $cmd->fetch(PDO::FETCH_ASSOC);

       $rotina = new Rotina();
       $rotina->setId($linha['codRotina']);
       $rotina->setDataCadastro($linha['dataCadastroRotina']);
       $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

       return $rotina;
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
    
     // Relatorios do Professor
    public function relatorioGeralTodasRotinasEnviadas($usuario, $turma)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codRotina, codAgenda, nomeTurma, nomeUsuario, horarioEnvioRotina, dataCadastroRotina 
                                  FROM tbrotina 
                                  INNER JOIN tbprofessorturma 
                                  ON tbrotina.codTurma = tbprofessorturma.codTurma
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  INNER JOIN tbusuario
                                  ON tbrotina.codUsuario = tbusuario.codUsuario
                                  WHERE tbrotina.codUsuario = :codUsuario AND nomeTurma LIKE :nomeTurma
                                  ORDER BY dataCadastroRotina DESC");

            $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


            if ($cmd->execute())
            {
               // Cria uma lista para armazenar todas as rotinas
               $listaRotinasEnviadas = new ArrayObject();

               // Retorna uma matriz da tabela do banco de dados
               // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
               // onde é armazenada em um objeto 'rotinas' que é adicionado 
               // a uma lista de rotinas

               while($linha = $cmd->fetch(PDO::FETCH_ASSOC))
               {
                   $rotina = new Rotina();
                   $rotina->setId(intval($linha['codRotina']));
                   $rotina->setDataCadastro($linha['dataCadastroRotina']);
                   $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

                   $agenda = new Agenda();
                   $agenda->setId(intval($linha['codAgenda']));
                   $rotina->addAgenda($agenda);

                   $turma = new Turma();
                   $turma->setDescricao($linha['nomeTurma']);
                   $rotina->addTurma($turma);

                   $usuario = new Usuario();
                   $usuario->setNome($linha['nomeUsuario']);
                   $rotina->addProfessor($usuario);


                   $cmd2 = $pdo->prepare("SELECT COUNT(codOcorrencia) from tbocorrenciarotina
                                          WHERE codRotina = :codRotina");   
                   $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd2->execute();
                   $qtdOcorrencias = intval($cmd2->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeOcorrencia($qtdOcorrencias);

                   // Quantidade de alternatinas [Bom]
                   $cmd3 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 1");
                   $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd3->execute();
                   $qtdAlternativasBom = intval($cmd3->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Bom", $qtdAlternativasBom);

                   // Quantidade de alternatinas [Regular]
                   $cmd4 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 2");
                   $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd4->execute();
                   $qtdAlternativasRegular = intval($cmd4->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Regular", $qtdAlternativasRegular);

                   // Quantidade de alternatinas [Ruim]
                   $cmd5 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 3");
                   $cmd5->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd5->execute();
                   $qtdAlternativasRuim = intval($cmd5->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Ruim", $qtdAlternativasRuim);

                   $listaRotinasEnviadas->append($rotina);
                }

                return $listaRotinasEnviadas;
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

    public function relatorioGeralRotinasRecentes($usuario, $turma)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codRotina, codAgenda, nomeTurma, nomeUsuario, horarioEnvioRotina, dataCadastroRotina 
                                  FROM tbrotina 
                                  INNER JOIN tbprofessorturma 
                                  ON tbrotina.codTurma = tbprofessorturma.codTurma
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  INNER JOIN tbusuario
                                  ON tbrotina.codUsuario = tbusuario.codUsuario
                                  WHERE tbrotina.codUsuario = :codUsuario AND nomeTurma LIKE :nomeTurma
                                  ORDER BY dataCadastroRotina DESC
                                  LIMIT 10");

            $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);


            if ($cmd->execute())
            {
               // Cria uma lista para armazenar todas as rotinas
               $listaRotinasRecentes = new ArrayObject();

               // Retorna uma matriz da tabela do banco de dados
               // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
               // onde é armazenada em um objeto 'rotinas' que é adicionado 
               // a uma lista de rotinas

               while($linha = $cmd->fetch(PDO::FETCH_ASSOC))
               {
                   $rotina = new Rotina();
                   $rotina->setId(intval($linha['codRotina']));
                   $rotina->setDataCadastro($linha['dataCadastroRotina']);
                   $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

                   $agenda = new Agenda();
                   $agenda->setId(intval($linha['codAgenda']));
                   $rotina->addAgenda($agenda);

                   $turma = new Turma();
                   $turma->setDescricao($linha['nomeTurma']);
                   $rotina->addTurma($turma);

                   $usuario = new Usuario();
                   $usuario->setNome($linha['nomeUsuario']);
                   $rotina->addProfessor($usuario);


                   $cmd2 = $pdo->prepare("SELECT COUNT(codOcorrencia) from tbocorrenciarotina
                                          WHERE codRotina = :codRotina");   
                   $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd2->execute();
                   $qtdOcorrencias = intval($cmd2->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeOcorrencia($qtdOcorrencias);

                   // Quantidade de alternatinas [Bom]
                   $cmd3 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 1");
                   $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd3->execute();
                   $qtdAlternativasBom = intval($cmd3->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Bom", $qtdAlternativasBom);

                   // Quantidade de alternatinas [Regular]
                   $cmd4 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 2");
                   $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd4->execute();
                   $qtdAlternativasRegular = intval($cmd4->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Regular", $qtdAlternativasRegular);

                   // Quantidade de alternatinas [Ruim]
                   $cmd5 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                          WHERE codRotina = :codRotina AND codAlternativa = 3");
                   $cmd5->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                   $cmd5->execute();
                   $qtdAlternativasRuim = intval($cmd5->fetch(PDO::FETCH_COLUMN));
                   $rotina->addQuantidadeAlternativa("Ruim", $qtdAlternativasRuim);

                   $listaRotinasRecentes->append($rotina);
                }

                return $listaRotinasRecentes;
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


    public function relatorioEspecificoRotina($usuario, $turma, &$rotina)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codRotina, codAgenda, nomeTurma, nomeUsuario, horarioEnvioRotina, dataCadastroRotina 
                                  FROM tbrotina 
                                  INNER JOIN tbprofessorturma 
                                  ON tbrotina.codTurma = tbprofessorturma.codTurma
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  INNER JOIN tbusuario
                                  ON tbrotina.codUsuario = tbusuario.codUsuario
                                  WHERE tbrotina.codUsuario = :codUsuario 
                                  AND nomeTurma LIKE :nomeTurma
                                  AND codRotina = :codRotina");

            $cmd->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":nomeTurma", $turma->getDescricao(), PDO::PARAM_STR);
            $cmd->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
           
            if ($cmd->execute())
            {
               $linha = $cmd->fetch(PDO::FETCH_ASSOC);

               $rotina->setId(intval($linha['codRotina']));
               $rotina->setDataCadastro($linha['dataCadastroRotina']);
               $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

               $agenda = new Agenda();
               $agenda->setId(intval($linha['codAgenda']));
               $rotina->addAgenda($agenda);

               $turma = new Turma();
               $turma->setDescricao($linha['nomeTurma']);
               $rotina->addTurma($turma);

               $usuario = new Usuario();
               $usuario->setNome($linha['nomeUsuario']);
               $rotina->addProfessor($usuario);


               $cmd2 = $pdo->prepare("SELECT COUNT(codOcorrencia) from tbocorrenciarotina
                                      WHERE codRotina = :codRotina");   
               $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               $cmd2->execute();
               $qtdOcorrencias = intval($cmd2->fetch(PDO::FETCH_COLUMN));
               $rotina->addQuantidadeOcorrencia($qtdOcorrencias);

               // Quantidade de alternatinas [Bom]
               $cmd3 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                      WHERE codRotina = :codRotina AND codAlternativa = 1");
               $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               $cmd3->execute();
               $qtdAlternativasBom = intval($cmd3->fetch(PDO::FETCH_COLUMN));
               $rotina->addQuantidadeAlternativa("Bom", $qtdAlternativasBom);

               // Quantidade de alternatinas [Regular]
               $cmd4 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                      WHERE codRotina = :codRotina AND codAlternativa = 2");
               $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               $cmd4->execute();
               $qtdAlternativasRegular = intval($cmd4->fetch(PDO::FETCH_COLUMN));
               $rotina->addQuantidadeAlternativa("Regular", $qtdAlternativasRegular);

               // Quantidade de alternatinas [Ruim]
               $cmd5 = $pdo->prepare("SELECT COUNT(codAlternativa) from tbalternativacard
                                      WHERE codRotina = :codRotina AND codAlternativa = 3");
               $cmd5->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
               $cmd5->execute();
               $qtdAlternativasRuim = intval($cmd5->fetch(PDO::FETCH_COLUMN));
               $rotina->addQuantidadeAlternativa("Ruim", $qtdAlternativasRuim);
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


    public function buscarTodasRotinasRecebidas($agenda)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codAgenda, codRotina, nomeTurma, horarioEnvioRotina, dataCadastroRotina FROM tbrotina
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  WHERE codAgenda = :codAgenda
                                  ORDER BY dataCadastroRotina DESC"); 

            $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_STR);

            if ($cmd->execute())
            {
                 // Cria uma lista para armazenar todas as rotinas
                 $listaTodasRotinasRecebidas = new ArrayObject();
                 
                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
                 if ($cmd->rowCount() > 0)
                 {
                   while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
                       $rotina = new Rotina();
                       $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

                       $agenda->setId(intval($linha['codAgenda']));
                       $rotina->addAgenda($agenda);

                       $rotina->setId(intval($linha['codRotina']));
                       $rotina->setDataCadastro($linha['dataCadastroRotina']);

                       $turma = new Turma();
                       $turma->setDescricao($linha['nomeTurma']);
                       $rotina->addTurma($turma);

                       $listaTodasRotinasRecebidas->append($rotina);
                   }

                   return $listaTodasRotinasRecebidas;
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


    public function buscarRotinasRecebidasIntervaloData($agenda, $data_de, $data_ate)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codAgenda, codRotina, nomeTurma, horarioEnvioRotina, dataCadastroRotina FROM tbrotina
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  WHERE DATE(dataCadastroRotina) BETWEEN :data_de AND :data_ate
                                  AND codAgenda = :codAgenda"); 
         
            $cmd->bindValue(":data_de", $data_de, PDO::PARAM_STR);
            $cmd->bindValue(":data_ate", $data_ate, PDO::PARAM_STR);
            $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_STR);

            if ($cmd->execute())
            {
                 // Cria uma lista para armazenar todas as rotinas
                 $listaRotinasRecebidasIntervaloData = new ArrayObject();
                 
                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
                 if ($cmd->rowCount() > 0)
                 {
                   while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
                       $rotina = new Rotina();
                       $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

                       $agenda->setId(intval($linha['codAgenda']));
                       $rotina->addAgenda($agenda);

                       $rotina->setId(intval($linha['codRotina']));
                       $rotina->setDataCadastro($linha['dataCadastroRotina']);

                       $turma = new Turma();
                       $turma->setDescricao($linha['nomeTurma']);
                       $rotina->addTurma($turma);

                       $listaRotinasRecebidasIntervaloData->append($rotina);
                   }

                   return $listaRotinasRecebidasIntervaloData;
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


    public function buscarRotinasRecebidasMaisAntigas($agenda)
    {
        $pdo = Conexao::conexao();

        try
        {
            // Prepara o cadastro
            $cmd = $pdo->prepare("SELECT codAgenda, codRotina, nomeTurma, horarioEnvioRotina, dataCadastroRotina FROM tbrotina
                                  INNER JOIN tbturma
                                  ON tbrotina.codTurma = tbturma.codTurma
                                  WHERE codAgenda = :codAgenda
                                  ORDER BY dataCadastroRotina ASC"); 

            $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_STR);

            if ($cmd->execute())
            {
                 // Cria uma lista para armazenar todas as rotinas
                 $listaRotinasRecebidasMaisAntigas = new ArrayObject();
                 
                 // Retorna uma matriz da tabela do banco de dados
                 // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
                 // onde é armazenada em um objeto 'rotinas' que é adicionado 
                 // a uma lista de rotinas
                 if ($cmd->rowCount() > 0)
                 {
                   while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
                       $rotina = new Rotina();
                       $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);

                       $agenda->setId(intval($linha['codAgenda']));
                       $rotina->addAgenda($agenda);

                       $rotina->setId(intval($linha['codRotina']));
                       $rotina->setDataCadastro($linha['dataCadastroRotina']);

                       $turma = new Turma();
                       $turma->setDescricao($linha['nomeTurma']);
                       $rotina->addTurma($turma);

                       $listaRotinasRecebidasMaisAntigas->append($rotina);
                   }

                   return $listaRotinasRecebidasMaisAntigas;
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


    public function relatorioRotinaEspecificaCrianca($agenda, &$rotina){

      $pdo = Conexao::conexao();
       
       try {

          $cmd = $pdo->prepare("SELECT codRotina, codTurma, codUsuario, horarioEnvioRotina, dataCadastroRotina FROM tbrotina
                                WHERE codAgenda = :codAgenda AND codRotina = :codRotina");
          $cmd->bindValue(":codAgenda", $agenda->getId(), PDO::PARAM_INT);
          $cmd->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
          //$cmd->bindValue(":inicio", $inicio, PDO::PARAM_INT);
          //$cmd->bindValue(":qtd", $qtd, PDO::PARAM_INT);

          if($cmd->execute()){
             
             $linha = $cmd->fetch(PDO::FETCH_ASSOC);
            
             $rotina->setId(intval($linha['codRotina']));
             $rotina->setHorarioEnvio($linha['horarioEnvioRotina']);
             $rotina->setDataCadastro($linha['dataCadastroRotina']);
             
             $usuario = new Usuario();
             $usuario->setId(intval($linha['codUsuario']));

             $cmdUsuario = $pdo->prepare("SELECT nomeUsuario FROM tbusuario WHERE codUsuario = :codUsuario");
             $cmdUsuario->bindValue(":codUsuario", $usuario->getId(), PDO::PARAM_INT);
             $cmdUsuario->execute();
             $usuario->setNome($cmdUsuario->fetch(PDO::FETCH_COLUMN));
             
             $rotina->addProfessor($usuario);

             $turma = new Turma();
             $turma->setId(intval($linha['codTurma']));
             
             $cmdTurma = $pdo->prepare("SELECT nomeTurma FROM tbturma WHERE codTurma = :codTurma");
             $cmdTurma->bindValue(":codTurma", $turma->getId(), PDO::PARAM_INT);
             $cmdTurma->execute();
             $turma->setDescricao($cmdTurma->fetch(PDO::FETCH_COLUMN));
             
             $rotina->addTurma($turma);
             
             $cmd2 = $pdo->prepare("SELECT codCard FROM tbcardrotina
                              WHERE codRotina = :codRotina");

             $cmd2->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
             if($cmd2->execute()){
                while($linha = $cmd2->fetch(PDO::FETCH_ASSOC)){
                  $card = new Card();
                  $card->setId(intval($linha['codCard']));
              
                  $cmdCard = $pdo->prepare("SELECT descCard FROM tbcard WHERE codCard = :codCard");
                  $cmdCard->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                  $cmdCard->execute();
                  $card->setDescricao($cmdCard->fetch(PDO::FETCH_COLUMN));  

                  $cmd3 = $pdo->prepare("SELECT codAlternativa FROM tbalternativacard
                              WHERE codCard = :codCard and codRotina = :codRotina");
                  $cmd3->bindValue(":codCard", $card->getId(), PDO::PARAM_INT);
                  $cmd3->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
                  if($cmd3->execute()){   
                    $codAlternativa = $cmd3->fetch(PDO::FETCH_COLUMN);
                    $alternativa = new Alternativa();
                    $alternativa->setId(intval($codAlternativa));
                    
                    $cmdAlternativa = $pdo->prepare("SELECT descAlternativa FROM tbalternativa WHERE codAlternativa = :codAlternativa");
                    $cmdAlternativa->bindValue(":codAlternativa", $alternativa->getId(), PDO::PARAM_INT);
                    $cmdAlternativa->execute();
                    $alternativa->setDescricao($cmdAlternativa->fetch(PDO::FETCH_COLUMN));  
                  
                    $card->addAlternativa($alternativa);
                  }
                  
                  $rotina->addCard($card);
                } 
                // continuar a fazer o select para obeter as alternativas do card
                // não esquecer de colocar o 'codRotina' na tabela 'tbalternativacard'
                // para assim obter as alternativas específicas da rotina para com os cards 
             }

             $cmd4 = $pdo->prepare("SELECT codOcorrencia FROM tbocorrenciarotina
                              WHERE codRotina = :codRotina");
             $cmd4->bindValue(":codRotina", $rotina->getId(), PDO::PARAM_INT);
             if($cmd4->execute()){
                if($cmd4->rowCount() > 0){
                  while($linha = $cmd4->fetch(PDO::FETCH_ASSOC)){
                    $ocorrencia = new Ocorrencia();
                    $ocorrencia->setId(intval($linha['codOcorrencia']));

                    $cmdOcorrencia = $pdo->prepare("SELECT descOcorrencia FROM tbocorrencia WHERE codOcorrencia = :codOcorrencia");
                    $cmdOcorrencia->bindValue(":codOcorrencia", $ocorrencia->getId(), PDO::PARAM_INT);
                    $cmdOcorrencia->execute();
                    $ocorrencia->setDescricao($cmdOcorrencia->fetch(PDO::FETCH_COLUMN));  
                    
                    $rotina->addOcorrencia($ocorrencia);
                  } 
                }
             }

          }

       } catch (PDOException $e) {
          echo $e->getMessage();
       }

       Conexao::desconexao();
    }



    /*
    public function consultarRotina(){
       
       $pdo = Conexao::conexao();

       // Prepara o cadastro
       $cmd = $pdo->prepare("SELECT codRotina, dataRotina, nomeAluno, nomeTurma, descPeriodo FROM tbRotina
                                INNER JOIN tbaluno
                                  ON tbRotina.codAluno = tbaluno.codAluno
                                    INNER JOIN tbturma
                                      ON tbRotina.codTurma = tbturma.codTurma
                                        INNER JOIN tbperiodo
                                          ON tbRotina.codPeriodo = tbperiodo.codPeriodo");
       
       $cmd->execute();
       
       // Cria uma lista para armazenar todas as turmas
       $listaRotinas = new ArrayObject();
       
       // Retorna uma matriz da tabela do banco de dados
       // Percorre uma matriz e passa os dados de cada linha para a variável '$listar', 
       // onde é armazenada em um objeto 'grauEscolar' que é adicionado 
       // a uma lista de graus escolares
       while($linha = $cmd->fetch(PDO::FETCH_ASSOC)){
           $Rotina = new Rotina();
           $Rotina->setId($linha['codRotina']);
           $Rotina->setData($linha['dataRotina']);

           $aluno = new Aluno();
           $aluno->setNome($linha['nomeAluno']);
           $Rotina->addAluno($aluno);

           $turma = new Turma();
           $turma->setNome($linha['nomeTurma']);
           $Rotina->addTurma($turma);

           $periodo = new Periodo();
           $periodo->setDescricao($linha['descPeriodo']);
           $Rotina->addPeriodo($periodo);

           $listaRotinas->append($Rotina);
       }
       
       Conexao::desconexao();
       // Retorna a lista completa com as Rotinas
       return $listaRotinas;
    }
      
    public function editarRotina($editarRotina){

        try{
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
     
            // Prepara a edição 
            $cmd = $pdo->prepare("UPDATE tbRotina SET dataRotina = :dataRotina, 
                                      codAluno = :codAluno, 
                                          codTurma = :codTurma, 
                                            codPeriodo = :codPeriodo 
                                              WHERE codRotina = :codRotina");

            // Substitui os valores
            $cmd->bindValue(":dataRotina", $editarRotina->getData(), PDO::PARAM_STR);
            $cmd->bindValue(":codAluno", $editarRotina->aluno->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codTurma", $editarRotina->turma->getId(), PDO::PARAM_INT);
            $cmd->bindValue(":codPeriodo", $editarRotina->periodo->getId(), PDO::PARAM_INT); 
            
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
    
    public function excluirRotina($excluirRotina){
         
        try {
            // Abre a conexão com o banco de dados
            $pdo = Conexao::conexao();
            
            $cmd = $pdo->prepare("DELETE FROM tbRotina WHERE codRotina = :codRotina");
            $cmd->bindValue(":codRotina", $excluirRotina->getId(), PDO::PARAM_INT);
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
    public function preencherRotina(&$Rotina){ // '&' representa uma Passagem por Referência
        
       try{
           // Abre a conexão com o banco de dados
           $pdo = Conexao::conexao();
            
           // Busca o código do grau escolar no banco de dados
           $cmd = $pdo->prepare("SELECT codRotina, dataRotina, codAluno, codTurma, codPeriodo FROM tbRotina
                                   WHERE codRotina = :codRotina");

           $cmd->bindValue(":codRotina", $Rotina->getId(), PDO::PARAM_INT); 
           
           if($cmd->execute()){
                $linha = $cmd->fetch(PDO::FETCH_OBJ);

                $Rotina->setId($linha->codRotina);
                $Rotina->setData($linha->dataRotina);

                $aluno = new Aluno();
                $aluno->setId($linha->codAluno);
                $Rotina->addAluno($aluno);

                $turma = new Turma();
                $turma->setId($linha->codTurma);
                $Rotina->addTurma($turma);

                $periodo = new Periodo();
                $periodo->setId($linha->codPeriodo);
                $Rotina->addPeriodo($periodo);

                return $Rotina;
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