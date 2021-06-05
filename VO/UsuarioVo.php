<?php

class UsuarioVO
{

    private $idUser;
    private $tipoUsuario;
    private $nome;
    private $cpf;
    private $senha;
    private $status;
    private $dtCad;
    private $novaSenha;
    private $rNovaSenha;
    private $nomeBuscado;

    public function setIdUser($id)
    {
        $this->idUser = $id;
    }
    public function getUserId()
    {
        return $this->idUser;
    }

    public function setTipo($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }
    public function getTipo()
    {
        return $this->tipoUsuario;
    }

    public function setNome($nome){
        $this->nome = trim($nome);
    }
    public function getNome(){
        return $this->nome;
    }

    public function setCpf($cpf){
        $this->cpf = trim($cpf);
    }
    public function getCpf(){
        return $this->cpf;
    }

    public function setSenha($senha){
        $this->senha = trim($senha);
    }
    public function getSenha(){
        return $this->senha;
    }

    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }

    public function setDtCad($dtCad){
        $this->dtCad = $dtCad;
    }
    public function getDtCad(){
        return $this->dtCad;
    }

    public function setRSenha($rSenha){
        $this->rSenha = $rSenha;
    }
    public function getRSenha(){
        return $this->rSenha;
    }

    public function setBuscarNome($nomeBuscado){
        $this->nomeBuscado = $nomeBuscado;
    }
    public function getBuscarNome(){
        return $this->nomeBuscado;
    }

    public function setNovaSenha($novaSenha){
        $this->novaSenha = $novaSenha;
    }
    public function getNovaSenha(){
        return $this->novaSenha;
    }

    public function setrNovaSenha($rNovaSenha){
        $this->rNovaSenha = $rNovaSenha;
    }
    public function getrNovaSenha(){
        return $this->rNovaSenha;
    }
}
