<?php 

class ModeloVo{
    private $idModelo;
    private $nomeModelo;

    public function setIdModelo($idModelo){
        $this->idModelo = $idModelo;
    }
    public function getIdModelo(){
        return $this->idModelo;
    }

    public function setNomeModelo($nomeModelo){
        $this->nomeModelo = trim($nomeModelo);
    }
    public function getNomeModelo(){
        return $this->nomeModelo;
    }
}