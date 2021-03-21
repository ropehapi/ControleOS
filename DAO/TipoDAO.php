<?php

require_once 'ConexaoDAO.php';

class TipoDAO extends Conexao
{
    public function InserirTipoDAO(TipoVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_tipo(nome_tipo)
                    value(?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getNomeTipo());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public function ConsultarTipoDAO()
    {
        $conexao = parent::retornaConexao();
        $comando = 'select id_tipo ,nome_tipo from tb_tipo order by nome_tipo';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirTipoDAO($id)
    {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_tipo where id_tipo = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare(($comando));
        $sql->bindValue(1, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -2;
        }
    }

    public function AlterarTipoDAO(TipoVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'update tb_tipo set nome_tipo = ? where id_tipo = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare(($comando));
        $sql->bindValue(1, $vo->getNomeTipo());
        $sql->bindValue(2, $vo->getIdTipo());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
}
