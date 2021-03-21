<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/DAO/SetorDAO.php';

class SetorCTRL
{

    public function InserirSetorCTRL(SetorVo $vo)
    {
        if ($vo->getNomeSetor() == '') {
            return 0;
        }

        $dao = new SetorDAO;
        return $dao->InserirSetorDAO($vo);
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
        return $dao->AlterarSetorDAO($vo);
    }
}
