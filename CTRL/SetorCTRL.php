<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/DAO/SetorDAO.php';
require_once 'UtilCTRL';

class SetorCTRL
{

    public function InserirSetorCTRL(SetorVo $vo)
    {
        if ($vo->getNomeSetor() == '') {
            return 0;
        }

        $dao = new SetorDAO;
        return $dao->InserirSetorDAO($vo,UtilCTRL::CodigoUserLogado());
    }

    public function ConsultarSetorCTRL()
    {
        $dao = new SetorDAO;
        return $dao->ConsultarSetorDAO();
    }

    public function ExcluirSetorCTRL($id)
    {
        $dao = new SetorDAO();
        return $dao->ExcluirSetorDAO($id);
    }

    public function AlterarSetorCTRL($vo){
        $dao = new SetorDAO;
        return $dao->AlterarSetorDAO($vo,UtilCTRL::CodigoUserLogado());
    }
}
