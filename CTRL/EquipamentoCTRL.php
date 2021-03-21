<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/EquipamentoDAO.php';
require_once  'UtilCTRL.php';

class EquipamentoCTRL
{

    public function InserirEquipamentoCTRL(EquipamentoVO $vo)
    {
        if (
            $vo->getIdTipo() == '' ||
            $vo->getIdModelo() == '' ||
            $vo->getIdentEquipamento() == '' ||
            $vo->getDescEquipamento() == ''
        ) {
            return 0;
        }
        $vo->setIdUsuario(UtilCTRL::CodigoUserLogado());

        $dao = new EquipamentoDAO();
        return $dao->InserirEquipamento($vo);
    }
    public function PesquisarEquipamentoTipo($idTipo)
    {
        if ($idTipo == '') {
            return 0;
        }
        $dao = new EquipamentoDAO();
        return $dao->PesquisarEquipamentoTipo($idTipo);
    }
    public function AlocarEquipamentoCTRL(AlocarVo $vo)
    {
        if ($vo->getIdEquipamento() == '' || $vo->getIdSetor() == '') {
            return 0;
        }

        $vo->setSitAlocar(1);
        $vo->setDataAlocar(UtilCTRL::DataAtual());
        $vo->setHoraAlocar(UtilCTRL::HoraAtual());

        $dao = new EquipamentoDAO;
        return $dao->AlocarEquipamentoDAO($vo);
    }

    public function RemoverEquipamentoCTRL(EquipamentoVo $vo)
    {
        if ($vo->getSetorEquip() == '') {
            return 0;
        }
    }

    public function DetalharEquipamento($id)
    {
        $dao = new EquipamentoDAO;
        return $dao->DetalharEquipamento($id);
    }

    public function AlterarEquipamentoCTRL(EquipamentoVo $vo)
    {
        if ($vo->getIdTipo() == '' || $vo->getIdModelo() == '' || $vo->getDescEquipamento() == '' || $vo->getIdentEquipamento() == '') {
        return 0;
        }
        $dao = new EquipamentoDAO;
        return $dao->AlterarEquipamentoDAO($vo);
    }

    public function ConsultarEquipamentoNaoAlocadoCTRL(){
        $dao = new EquipamentoDAO;
        return $dao->FiltrarEquipamentoNaoAlocado();
    }

    public function ExcluirEquipamentoCTRL(EquipamentoVo $vo){
        $dao = new EquipamentoDAO;
        return $dao->ExcluirEquipamentoDAO($vo);
    }

    public function ProcurarEquipamentosNoSetor(AlocarVo $vo){
        $dao = new EquipamentoDAO;
        return $dao->ProcurarEquipamentosNoSetorDAO($vo);
    }

}
