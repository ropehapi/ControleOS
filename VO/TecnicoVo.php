<?php 

require_once 'UsuarioVo.php';

class TecnicoVO extends UsuarioVO{

    private $emailTec;
    private $telTec;
    private $enderecoTec;

    public function setEmailTec($emailTec){
        $this->emailTec = trim($emailTec);
    }
    public function getEmailTec(){
        return $this->emailTec;
    }

    public function setTelTec($telTec){
        $this->telTec = trim($telTec);
    }
    public function getTelTec(){
        return $this->telTec;
    }

    public function setEnderecoTec($enderecoTec){
        $this->enderecoTec = trim($enderecoTec);
    }
    public function getEnderecoTec(){
        return $this->enderecoTec;
    }
}

