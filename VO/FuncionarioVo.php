<?php

require_once 'UsuarioVo.php';

class FuncionarioVo extends UsuarioVo
{
    private $idUsuario;
    private $emailFunc;
    private $telFunc;
    private $enderecoFunc;
    private $idSetor;

    public function setEmailFunc($emailFunc){
        $this->emailFunc = trim($emailFunc);
    }
    public function getEmailFunc(){
        return $this->emailFunc;
    }

    public function setTelFunc($telFunc){
        $this->telFunc = trim($telFunc);
    }
    public function getTelFunc(){
        return $this->telFunc;
    }

    public function setEnderecoFunc($enderecoFunc){
        $this->enderecoFunc = trim($enderecoFunc);
    }
    public function getEnderecoFunc(){
        return $this->enderecoFunc;
    }

    public function  setIdSetor($idSetor){
        $this->idSetor = $idSetor;
    }
    public function getIdSetor(){
        return $this->idSetor;
    }
}