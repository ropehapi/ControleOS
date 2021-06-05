<?php

class AlocarVo
{
    private $idAlocar;
    private $dataAlocar;
    private $horaAlocar;
    private $dataRemover;
    private $horaRemover;
    private $sitAlocar;
    private $idSetor;
    private $idEquipamento;

    public function setIdAlocar($idAlocar)
    {
        $this->idAlocar = $idAlocar;
    }
    public function getIdAlocar()
    {
        return $this->idAlocar;
    }

    public function setDataAlocar($dataAlocar)
    {
        $this->dataAlocar = $dataAlocar;
    }
    public function getDataAlocar()
    {
        return $this->dataAlocar;
    }

    public function setHoraAlocar($horaAlocar)
    {
        $this->horaAlocar = $horaAlocar;
    }
    public function getHoraALocar()
    {
        return $this->horaAlocar;
    }

    public function setDataRemover($dataRemover)
    {
        $this->dataRemover = $dataRemover;
    }
    public function getDataRemover()
    {
        return $this->dataRemover;
    }

    public function setHoraRemover($horaRemover)
    {
        $this->horaRemover = $horaRemover;
    }
    public function getHoraRemover()
    {
        return $this->horaRemover;
    }

    public function setSitAlocar($sitAlocar)
    {
        $this->sitAlocar = $sitAlocar;
    }
    public function getSitAlocar()
    {
        return $this->sitAlocar;
    }

    public function setIdSetor($idSetor)
    {
        $this->idSetor = $idSetor;
    }
    public function getIdSetor()
    {
        return $this->idSetor;
    }

    public function setIdEquipamento($idEquipamento)
    {
        $this->idEquipamento = $idEquipamento;
    }
    public function getIdEquipamento()
    {
        return $this->idEquipamento;
    }
}
