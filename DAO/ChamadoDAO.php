<?php

require_once 'ConexaoDAO.php';

class ChamadoDAO extends Conexao{

    public function InserirChamadoDAO (ChamadoVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_chamado
                    (desc_problema,data_chamado,hora_chamado,id_usuario,id_equipamento)
                    values(?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getDescProblema());
        $sql->bindValue(2,$vo->getDataChamado());
        $sql->bindValue(3,$vo->getHoraChamado());
        $sql->bindValue(4,$vo->getIdUsuarioFunc());
        $sql->bindValue(5,$vo->getIdEquip());

        try{
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            return -1;
        }

    }
}