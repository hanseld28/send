<?php
include_once("../Model/Funcionario.php");
include_once("../DAO/FuncionarioDAO.php");

/**
 * Description of FuncionarioCRUD
 *
 * @author laris
 */
class FuncionarioCRUD {
    //Aqui esta o crud do funcionario
    
       public function CadastrarFuncionario($nome, $rg, $cpf, $logradouro, $complemento, $numcasa, $cep, $cidade, $lista, $usuario, $email){
        $f = new Funcionario();
        
        $f->setNome($nome);
        $f->setRg($rg);
        $f->setCpf($cpf);
        $f->setLogradouro($logradouro);
        $f->setComplemento($complemento);
        $f->setNumcasa($numcasa);
        $f->setCep($cep);
        $f->setCidade($cidade);
        $f->setCargos($lista);
        $f->setUsuario($usuario);
        $f->setEmail($email);
        
        $pdao = new FuncionarioDAO();
        return $pdao->CadastrarFuncionario($f);
        
    }
    
       public function EditarFuncionario($id, $nome, $rg, $cpf, $logradouro, $complemento, $numcasa, $cep, $cidade, $lista, $email){
        
          $f = new Funcionario();
          
          $f->setCodigo($id);
          $f->setNome($nome);
          $f->setRg($rg);
          $f->setCpf($cpf);
          $f->setLogradouro($logradouro);
          $f->setComplemento($complemento);
          $f->setNumcasa($numcasa);
          $f->setCep($cep);
          $f->setCidade($cidade);
          $f->setCargos($lista);
          $f->setEmail($email);
          
          $pdao = new FuncionarioDAO();
          return $pdao->EditarFuncionario($f);
          
      }
      
        public function ListarFuncionario(){
        
        $pdao = new FuncionarioDAO();
        $var = array();
        return $var = $pdao->MostrarFuncionario();
        
        
        
    }
    
     public function ExcluirFuncionario($cod){
        
        $codigo = $cod;
        $pdao = new FuncionarioDAO();
        return $pdao->ExcluirFunc($codigo);
                
    }
     
       public function ConsultaFuncionario($cod){
        $resultado = array();
        $codigo = $cod;
        $pdao = new FuncionarioDAO();
        
        return $resultado[] = $pdao->ConsultarDadosFuncionario($codigo);
         
    }

           public function ConsultaFuncionarioUsuario($cod){
        $codigo = $cod;
        $pdao = new FuncionarioDAO();
        
        return $resultado = $pdao->ConsultarDadosFuncionarioUsuario($codigo);
         
    }
    
        public function ConsultarCargos($cod){
            $resultado;
            $codigo = $cod;
            $pdao = new FuncionarioDAO();
            
            return $resultado = $pdao->buscarCargoFuncionario($codigo);
        }
    
    #################################################################
    ################## Relatórios do Funcionario ####################
    #################################################################

    public function relatorioGeralFuncionario(){
        $dao = new FuncionarioDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralFuncionario();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoFuncionario($cod){
        $func = new Funcionario();
        $func->setCodigo($cod);

        $dao = new FuncionarioDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoFuncionario($func);
        // Retorna a periodo preenchido
        return $func;
    }
    
    
}
