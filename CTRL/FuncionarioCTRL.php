<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/FuncionarioDAO.php';

class FuncionarioCTRL{
    
    public function AlterarInformacoes(FuncionarioVo $vo){
        if($vo->getNome()==''||$vo->getEmailFunc()==''||$vo->getEnderecoFunc()==''||$vo->getTelFunc()==''){
            return 0;
        }
    }
}