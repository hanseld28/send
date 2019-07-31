<?php

include_once("../DAO/ResponsavelDAO.php");
include_once("../Model/Responsavel.php");
/**
 * Description of ResponsavelCRUD
 *
 * @author laris
 */
class ResponsavelCRUD {
    //CRUD do responsavel
    
       public function CadastroResponsavel($nome, $cpf, $nacionalidade, $rg, $data, $sexo, $profissao, $endereco, $telefone, $celular, $telefonetrabalho, $grau, $email, $usuario){
        
        $r = new Responsavel();
        $r->setNome($nome);
        $r->setCpf($cpf);
        $r->setNacionalidade($nacionalidade);
        $r->setRg($rg);
        $r->setDatanascimento($data);
        $r->setSexo($sexo);
        $r->setProfissao($profissao);
        $r->setEnderecotrabalho($endereco);
        $r->setTelefone($telefone);
        $r->setCelular($celular);
        $r->setTelefonetrabalho($telefonetrabalho);
        $r->setGrauparentesco($grau);
        $r->setEmail($email);
        $r->setUsuario($usuario);
        
        $pdao = new ResponsavelDAO();
        $pdao->CadastrarResponsavel($r);
    
    }
    
    public function EditarResponsavel($nome, $cpf, $nacionalidade, $rg, $data, $sexo, $profissao, $endereco, $telefone, $celular, $telefonetrabalho, $grau, $email, $usuario){
        
        $r = new Responsavel();
        $r->setNome($nome);
        $r->setCpf($cpf);
        $r->setNacionalidade($nacionalidade);
        $r->setRg($rg);
        $r->setDatanascimento($data);
        $r->setSexo($sexo);
        $r->setProfissao($profissao);
        $r->setEnderecotrabalho($endereco);
        $r->setTelefone($telefone);
        $r->setCelular($celular);
        $r->setTelefonetrabalho($telefonetrabalho);
        $r->setGrauparentesco($grau);
        $r->setEmail($email);
        $r->setCodigo($usuario);
        
        $pdao = new ResponsavelDAO();
        return $pdao->EditarResponsavel($r);
  
    }
    
     public function ListarResponsavel(){
        $pdao = new ResponsavelDAO();
        $var = array();
        return $var = $pdao->MostrarResponsavel();
        
    }
    
     public function ExcluirResponsavel($cod){
        $codigo = $cod;
        $pdao = new ResponsavelDAO();
        return $pdao->excluirResponsavel($codigo);
    }
    
     public function VerificaResponsavel($cod){
         $responsavel = new Responsavel();
         $responsavel->setCodigo($cod);
         $pdao = new ResponsavelDAO();
         return $pdao->VerificaResponsavel($responsavel);
         
     }
     public function cadastrarFotoResponsavel($foto, $cod){

         $pdao = new ResponsavelDAO();
         $pdao->cadastrarFotoResponsavel($foto, $cod);
     }
    
     public function ConsultaResponsavel($cod){
        
         $resp = new Responsavel();
         $resp->setCodigo($cod);
         
        $codigo = $cod;
        $pdao = new ResponsavelDAO();
        
        return $pdao->ConsultarResponsavel($resp);
         
    }
    
    public function ConsultaDadosResponsavel($cod){     
         $resp = new Responsavel();
         $resp->setCodigo($cod);
         
         $codigo = $cod;
         $pdao = new ResponsavelDAO();
        
        return $pdao->ConsultarDadosResponsavel($resp);
    }

    public function Ultimoresp(){
        $resultado;
        $pdao = new ResponsavelDAO();
        return $resultado = $pdao->UltimoResponsavel();
    }

    public function buscarAluno($cod){
        $resultado;
        $pdao = new ResponsavelDAO();
        return $resultado = $pdao->buscarAluno($cod);
    }
    
    #################################################################
    ################## Relatórios do Responsavel ####################
    #################################################################

    public function relatorioGeralResponsavel(){
        $dao = new ResponsavelDAO();
        // Requere uma lista de 'periodo' do objeto de acesso ao banco de dados
        $lista = $dao->relatorioGeralResponsavel();
        // Retorna uma lista de periodos
        return $lista;
    }
    
    public function relatorioEspecificoResponsavel($cod){
        $responsavel = new Responsavel();
        $responsavel->setCodigo($cod);
        $dao = new ResponsavelDAO();
        // Requere o 'periodo' preenchido do objeto de acesso ao banco de dados
        $dao->relatorioEspecificoResponsavel($responsavel);
        // Retorna a periodo preenchido
        return $responsavel;
    }
    
}
