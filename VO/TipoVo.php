<?php 

class TipoVo{

    private $idTipo;
    private $nomeTipo;

    public function setIdTipo($idTipo){
        $this->idTipo = $idTipo;
    }
    public function getIdTipo(){
        return $this->idTipo;
    }

    public function setNomeTipo($nomeTipo){
        $this->nomeTipo = trim($nomeTipo);
    }
    public function getNomeTipo(){
        return $this->nomeTipo;
    }
}
