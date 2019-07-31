<?php
/**
 * Description of Responsavel
 *
 * @author laris
 */
class Responsavel {
    //atributos e métodos do responsavel
    
    private $codigo;
    private $nome;
    private $cpf;
    private $nacionalidade;
    private $rg;
    private $datanascimento;
    private $sexo;
    private $profissao;
    private $enderecotrabalho;
    private $telefone;
    private $celular;
    private $telefonetrabalho;
    private $grauparentesco; 
    private $usuario;
    private $foto;
    private $datacadastro;
    private $email;
    
 
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }
    function getEmail() {
        return $this->email;
    }
    
    function getCpf(){
        return $this->cpf;
    }
    function getNacionalidade(){
        return $this->nacionalidade;
    }
    function getRg(){
        return $this->rg;
    }
    function getDatanascimento(){
        return $this->datanascimento;
    }
    function getSexo(){
        return $this->sexo;
    }
    function getProfissao(){
        return $this->profissao;
    }
    function getEnderecotrabalho(){
        return $this->enderecotrabalho;
    }
    function getTelefone(){
        return $this->telefone;
    }
    function getCelular(){
        return $this->celular;
    }
    function getTelefonetrabalho(){
        return $this->telefonetrabalho;
    }
    function getGrauparentesco(){
        return $this->grauparentesco;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function getDatacadastro() {
        return $this->datacadastro;
    }
    function getFoto() {
        return $this->foto;
    }
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
     function setEmail($email) {
        $this->email = $email;
    }
    function setCpf($cpf){
        $this->cpf = $cpf;  
    }
    function setNacionalidade($nacionalidade){
        $this->nacionalidade = $nacionalidade;  
    }
    function setTelefone($telefone){
        $this->telefone = $telefone;
        
    }
    function setCelular($celular){
        $this->celular = $celular;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
       function setRg($rg) {
        $this->rg = $rg;
    }
    function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }
    function setSexo($sexo) {
        $this->sexo = $sexo;
    }
    function setProfissao($profissao) {
        $this->profissao = $profissao;
    }
    function setEnderecotrabalho($enderecotrabalho) {
        $this->enderecotrabalho = $enderecotrabalho;
    }
    function setTelefonetrabalho($telefonetrabalho) {
        $this->telefonetrabalho = $telefonetrabalho;
    }
    function setGrauparentesco($grauparentesco) {
        $this->grauparentesco = $grauparentesco;
    }
    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }
    function setFoto($foto) {
        $this->foto = $foto;
    }
    
    
}
