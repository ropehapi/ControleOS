<?php 

require_once 'ConexaoDAO.php';

class SetorDAO extends Conexao{

    public function InserirSetorDAO(SetorVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_setor(nome_setor) value(?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getNomeSetor());

        try{
            $sql->execute();
            return 1;
        } catch(Exception $ex){
            return -1;
        }
    }

    public function ConsultarSetorDAO(){
        $conexao = parent::retornaConexao();
        $comando = 'select id_setor , nome_setor from tb_setor order by nome_setor';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirSetorDAO($id){
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_setor where id_setor = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$id);
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -2;
        }
    }

    public function AlterarSetorDAO(SetorVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'update tb_setor set nome_setor = ? where id_setor = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getNomeSetor());
        $sql->bindValue(2,$vo->getIdSetor());

        try {
            $sql->execute();
            return 1;
        } catch (\Throwable $th) {
            return -1;
        }
    }
}