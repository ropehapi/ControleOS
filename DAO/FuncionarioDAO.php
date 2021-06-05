<?php

require_once 'ConexaoDAO.php';

class FuncionarioDAO extends Conexao{
    public function InserirFuncionarioDAO(FuncionarioVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_funcionario
                    (email_func,tel_func,endereco_func)
                    values(?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getEmailFunc());
        $sql->bindValue(2,$vo->getTelFunc());
        $sql->bindValue(3,$vo->getEnderecoFunc());

        try{
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            return -1;
        }
    }
}