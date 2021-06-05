<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/ChamadoDAO.php';

class ChamadoCTRL{
    public function BuscarChamadosFunc(ChamadoVo $vo){
        if($vo->getSitChamado()==''){
            return 0;
        }

        
    } 

    public function AbrirChamado(ChamadoVo $vo){
        if($vo->getIdEquip()==''||$vo->getDescProblema()==''){
            return 0;
        }

        $dao = new ChamadoDAO();
        return $dao->InserirChamadoDAO($vo);
    }

    public function EncerrarChamado(ChamadoVo $vo){
        if($vo->getDataEncerramento()==''||$vo->getIdSetor()==''||$vo->getIdUsuarioFunc()==''||$vo->getIdEquip()==''||$vo->getLaudoChamado()==''){
            return 0;
        }
    }

    public function BuscarChamadosTec(ChamadoVo $vo){
        if($vo->getSitChamado()==''){
            return 0;
        }
    }
}