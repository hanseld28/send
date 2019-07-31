<?php 
    include_once("../Controller/ControllerRotina.php");
    include_once("funcoesUtilitarias.php");
    
    $controllerRotina = new ControllerRotina();
      
    $parametro_filtro = (isset($_POST['parametro'])) ? $_POST['parametro'] : null ;
  
    $filtro_data = (isset($_POST['filtro_data'])) ? $_POST['filtro_data'] : null ;
    $ordenar_por = (isset($_POST['ordenarPor'])) ? intval($_POST['ordenarPor']) : null ;

    $codAgenda = (isset($_POST['codAgenda'])) ? intval($_POST['codAgenda']) : null ;

    $i = 1;

    if(!is_null($filtro_data) || !is_null($ordenar_por) || !is_null($parametro_filtro))
    { 
        if ($filtro_data == "intervalo_data")
        {
            $data_de = (isset($_POST['data_de'])) ? $_POST['data_de'] : null ;
            $data_ate = (isset($_POST['data_ate'])) ? $_POST['data_ate'] : null ;

            if(!is_null($data_de) && !is_null($data_ate) && !is_null($codAgenda))
            {
                $resultadoConsulta = $controllerRotina->buscarRotinasRecebidasIntervaloData($codAgenda, $data_de, $data_ate);

                $listaRotinasEnviadasIntervaloData = (!$resultadoConsulta) ? null : $resultadoConsulta;

                if (is_null($listaRotinasEnviadasIntervaloData)) 
                {
                    echo("<label class='lblNaoHaRotinasDestaData'>Não foi encontrado nenhuma rotina nestas datas...</label>"); 
                }
                else
                {                
                    //echo "<div class='caixaTabela' id='caixaTabela'>";
                    
                    echo "<table class='tabelaRotina'>";
                      
                      echo "<thead>";

                      echo "<tr>";
                              echo "<td class='titulo'>N°</td>";
                              echo "<td class='titulo'>Descrição</td>";
                              echo "<td class='titulo'>Turma</td>";
                              echo "<td class='titulo'>Horário</td>";
                              echo "<td class='titulo'>Data</td>";
                        echo "</tr>";
                      
                      echo "</thead>";
                      
                      echo "<tbody>";
                    
                        
                        foreach ($listaRotinasEnviadasIntervaloData as $rotina) 
                        {
                            $dataCompleta = explode(" ", $rotina->getDataCadastro());
                            $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
                            $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";
                            
                            $diaSemana = calculaDiaSemana($data);

                            echo "<tr class='infoRotinas'>";

                                echo "<td>";          
                                   echo $i;
                                echo "</td>";
                                 
                                echo "<td>";
                                   echo "Rotina de ".$diaSemana;
                                echo "</td>";
                                
                                echo "<td>";
                                   echo $rotina->turma->getDescricao();    
                                echo "</td>";

                                echo "<td>";
                                   echo $horario;    
                                echo "</td>";

                                echo "<td>";
                                   echo $data;    
                                echo "</td>";
                            
                                echo "<td>";
                                   echo "<a class='btnVisualizarRotina' href='#' onclick='mostrarRotina({$rotina->getId()}, {$codAgenda})'>visualizar</a>";  
                                echo "</td>";

                          echo "</tr>";
                            

                            $i++;
                        }

                      echo "<tbody>";

                      echo "</table>";
                    
                      //echo "</div>";

                  }

              }      

        }
        else if ($ordenar_por == 0) // Mais Recente
        {
            $resultadoConsulta = $controllerRotina->buscarTodasRotinasRecebidas($codAgenda);

            $listaRotinasRecebidasMaisRecentes = (!$resultadoConsulta) ? null : $resultadoConsulta;

            if (is_null($listaRotinasRecebidasMaisRecentes)) 
            {

              echo("<label class='lblNaoHaRotinasDestaData'>Não foi encontrado nenhuma rotina recebida...</label>"); 
              
            }
            else
            {
                //echo "<div class='caixaTabela' id='caixaTabela'>";
                    
                    echo "<table class='tabelaRotina'>";
                      
                      echo "<thead>";

                      echo "<tr>";
                              echo "<td class='titulo'>N°</td>";
                              echo "<td class='titulo'>Descrição</td>";
                              echo "<td class='titulo'>Turma</td>";
                              echo "<td class='titulo'>Horário</td>";
                              echo "<td class='titulo'>Data</td>";
                        echo "</tr>";
                      
                      echo "</thead>";
                      
                      echo "<tbody>";

              $i = 1;

              foreach ($listaRotinasRecebidasMaisRecentes as $key => $rotina) 
              {
                  $dataCompleta = explode(" ", $rotina->getDataCadastro());
                  $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
                  $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";

                  $diaSemana = calculaDiaSemana($data);

                  echo "<tr class='infoRotinas'>";

                        echo "<td>";          
                           echo $i;
                        echo "</td>";
                         
                        echo "<td>";
                           echo "Rotina de ".$diaSemana;
                        echo "</td>";
                        
                        echo "<td>";
                           echo $rotina->turma->getDescricao();    
                        echo "</td>";

                        echo "<td>";
                           echo $horario;    
                        echo "</td>";

                        echo "<td>";
                           echo $data;    
                        echo "</td>";
                    
                        echo "<td>";
                           echo "<a class='btnVisualizarRotina' href='#' onclick='mostrarRotina({$rotina->getId()}, {$codAgenda})'>visualizar</a>";  
                        echo "</td>";

                  echo "</tr>";
                              

                    $i++;
                }

              echo "<tbody>";

              echo "</table>";
            
             // echo "</div>";
            }

        }
        else if ($ordenar_por == 1) // Mais Antiga
        {
            $resultadoConsulta = $controllerRotina->buscarRotinasRecebidasMaisAntigas($codAgenda);

            $listaRotinasRecebidasMaisAntigas = (!$resultadoConsulta) ? null : $resultadoConsulta;

            if (is_null($listaRotinasRecebidasMaisAntigas)) 
            {

              echo("<label class='lblNaoHaRotinasDestaData'>Não foi encontrado nenhuma rotina recebida...</label>"); 
              
            }
            else
            {
                //echo "<div class='caixaTabela' id='caixaTabela'>";
                    
                    echo "<table class='tabelaRotina'>";
                      
                      echo "<thead>";

                      echo "<tr>";
                              echo "<td class='titulo'>N°</td>";
                              echo "<td class='titulo'>Descrição</td>";
                              echo "<td class='titulo'>Turma</td>";
                              echo "<td class='titulo'>Horário</td>";
                              echo "<td class='titulo'>Data</td>";
                        echo "</tr>";
                      
                      echo "</thead>";
                      
                      echo "<tbody>";

              $i = 1;

              foreach ($listaRotinasRecebidasMaisAntigas as $key => $rotina) 
              {
                  $dataCompleta = explode(" ", $rotina->getDataCadastro());
                  $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
                  $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";

                  $diaSemana = calculaDiaSemana($data);

                  echo "<tr class='infoRotinas'>";

                        echo "<td>";          
                           echo $i;
                        echo "</td>";
                         
                        echo "<td>";
                           echo "Rotina de ".$diaSemana;
                        echo "</td>";
                        
                        echo "<td>";
                           echo $rotina->turma->getDescricao();    
                        echo "</td>";

                        echo "<td>";
                           echo $horario;    
                        echo "</td>";

                        echo "<td>";
                           echo $data;    
                        echo "</td>";
                    
                        echo "<td>";
                           echo "<a class='btnVisualizarRotina' href='#' onclick='mostrarRotina({$rotina->getId()}, {$codAgenda})'>visualizar</a>";  
                        echo "</td>";

                  echo "</tr>";
                              

                    $i++;
                }

              echo "<tbody>";

              echo "</table>";
            
              //echo "</div>";
            }

        }
        else if ($parametro_filtro == "todas") 
        {
            $resultadoConsulta = $controllerRotina->buscarTodasRotinasRecebidas($codAgenda);

            $listaTodasRotinasRecebidas = (!$resultadoConsulta) ? null : $resultadoConsulta;

            if (is_null($listaTodasRotinasRecebidas)) 
            {

              echo("<label class='lblNaoHaRotinasDestaData'>Não foi encontrado nenhuma rotina recebida...</label>"); 
              
            }
            else
            {
                //echo "<div class='caixaTabela' id='caixaTabela'>";
                    
                    echo "<table class='tabelaRotina'>";
                      
                      echo "<thead>";

                      echo "<tr>";
                              echo "<td class='titulo'>N°</td>";
                              echo "<td class='titulo'>Descrição</td>";
                              echo "<td class='titulo'>Turma</td>";
                              echo "<td class='titulo'>Horário</td>";
                              echo "<td class='titulo'>Data</td>";
                        echo "</tr>";
                      
                      echo "</thead>";
                      
                      echo "<tbody>";

              $i = 1;

              foreach ($listaTodasRotinasRecebidas as $key => $rotina) 
              {
                  $dataCompleta = explode(" ", $rotina->getDataCadastro());
                  $data = str_replace("-", "/", date('d-m-Y', strtotime($dataCompleta[0])));
                  $horario = str_replace(":", "h", date('H:i', strtotime($rotina->getDataCadastro())))."min";

                  $diaSemana = calculaDiaSemana($data);

                  echo "<tr class='infoRotinas'>";

                        echo "<td>";          
                           echo $i;
                        echo "</td>";
                         
                        echo "<td>";
                           echo "Rotina de ".$diaSemana;
                        echo "</td>";
                        
                        echo "<td>";
                           echo $rotina->turma->getDescricao();    
                        echo "</td>";

                        echo "<td>";
                           echo $horario;    
                        echo "</td>";

                        echo "<td>";
                           echo $data;    
                        echo "</td>";
                    
                        echo "<td>";
                           echo "<a class='btnVisualizarRotina' href='#' onclick='mostrarRotina({$rotina->getId()}, {$codAgenda})'>visualizar</a>";  
                        echo "</td>";

                  echo "</tr>";
                              

                    $i++;
                }

              echo "<tbody>";

              echo "</table>";
            
              //echo "</div>";
            }
        }

    }

?>