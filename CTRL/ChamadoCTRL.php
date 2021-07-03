<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/ChamadoDAO.php';
require 'UtilCTRL.php';

class ChamadoCTRL
{
    public function BuscarChamadosFunc(ChamadoVo $vo)
    {
        if ($vo->getSitChamado() == '') {
            return 0;
        }
    }

    public function AbrirChamado(ChamadoVo $vo, $idAlocar)
    {
        if ($vo->getIdEquip() == '' || $vo->getDescProblema() == '') {
            return 0;
        }

        $vo->setIdUsuarioFunc(UtilCTRL::CodigoUserLogado());
        $vo->setDataChamado(UtilCTRL::DataAtual());
        $vo->setHoraChamado(UtilCTRL::HoraAtual());

        $dao = new ChamadoDAO();
        return $dao->AbrirChamadoDAO($vo, $idAlocar);
    }

    public function EncerrarChamado(ChamadoVo $vo)
    {
        if ($vo->getDataEncerramento() == '' || $vo->getIdSetor() == '' || $vo->getIdUsuarioFunc() == '' || $vo->getIdEquip() == '' || $vo->getLaudoChamado() == '') {
            return 0;
        }
    }

    public function BuscarChamadosTec(ChamadoVo $vo)
    {
        if ($vo->getSitChamado() == '') {
            return 0;
        }
    }

    public function CarregarEquipamentoSetor()
    {
        $dao = new ChamadoDAO;
        return $dao->CarregarEquipamentoSetor(UtilCTRL::SetorUserLogado(), 1);
    }

    public function FiltrarChamadoSetor($situacao)
    {
        $dao = new ChamadoDAO;
        return $dao->FiltrarChamadoSetor(UtilCTRL::SetorUserLogado(), $situacao);
    }

    public function FiltrarChamadosTec($situacao,$cod)
    {
        $dao = new ChamadoDAO;
        return $dao->FiltrarChamadosTec($situacao,$cod);
    }
}
