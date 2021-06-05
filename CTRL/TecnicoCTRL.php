<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/TecnicoDAO.php';

class TecnicoCTRL{

    public function AlterarInformacoes(TecnicoVO $vo){
        if($vo->getNome()==''||$vo->getEmailTec()==''||$vo->getEnderecoTec()==''||$vo->getTelTec()==''){
            return 0;
        }
    }
    
}