<?php

require_once 'ConexaoDAO.php';

class TecnicoDAO extends Conexao{
    public function InserirTecnicoDAO(TecnicoVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_tecnico
                    (email_tec,tel_tec,endereco_tec)
                    values(?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getEmailTec());
        $sql->bindValue(2,$vo->getTelTec());
        $sql->bindValue(3,$vo->getEnderecoTec());

        try{
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            return -1;
        }
    }
}