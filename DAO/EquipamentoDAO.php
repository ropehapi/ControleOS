<?php

require_once 'ConexaoDAO.php';

class EquipamentoDAO extends Conexao
{
    public function FiltrarEquipamentoNaoAlocado()
    {
        $conexao = parent::retornaConexao();
        $comando = 'select eq.id_equipamento,
                    eq.ident_equipamento,
                    eq.desc_equipamento 
                    from tb_equipamento as eq
                    LEFT join tb_alocar_equip as al
                    on eq.id_equipamento = al.id_equipamento
                    where eq.id_equipamento
                    not in (select al1.id_equipamento
                    from tb_alocar_equip as al1
                    where al1.data_remover is null)';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }

    public function InserirEquipamento(EquipamentoVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                    tb_equipamento(ident_equipamento,desc_equipamento,id_modelo,id_tipo,id_usuario)
                    values(?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getIdentEquipamento());
        $sql->bindValue(2, $vo->getDescEquipamento());
        $sql->bindValue(3, $vo->getIdModelo());
        $sql->bindValue(4, $vo->getIdTipo());
        $sql->bindValue(5, $vo->getIdUsuario());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    public function PesquisarEquipamentoTipo($idTipo)
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'select
        eq.id_equipamento,
        eq.ident_equipamento,
                        eq.desc_equipamento,
                        mo.nome_modelo,
                        ti.nome_tipo
                from tb_equipamento as eq
                inner join tb_modelo as mo
                    on eq.id_modelo = mo.id_modelo  
                inner join tb_tipo as ti
                    on eq.id_tipo = ti.id_tipo
                where eq.id_tipo = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);
        $i = 1;

        $sql->bindValue($i++, $idTipo);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEquipamento($idEquipamento)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select eq.id_equipamento,
        eq.ident_equipamento,
        eq.desc_equipamento,
        eq.id_modelo,
        eq.id_tipo
        from tb_equipamento as eq 
        where eq.id_equipamento = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $idEquipamento);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function AlterarEquipamentoDAO(EquipamentoVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'update tb_equipamento set ident_equipamento = ?,
                                              desc_equipamento = ?,
                                              id_modelo = ?,
                                              id_tipo = ?
                                              where id_equipamento = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getIdentEquipamento());
        $sql->bindValue(2, $vo->getDescEquipamento());
        $sql->bindValue(3, $vo->getIdModelo());
        $sql->bindValue(4, $vo->getIdTipo());
        $sql->bindValue(5, $vo->getIdEquipamento());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ExcluirEquipamentoDAO(EquipamentoVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'delete from tb_equipamento where id_equipamento = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getIdEquipamento());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function AlocarEquipamentoDAO(AlocarVo $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_alocar_equip (id_equipamento,id_setor,sit_alocar,data_alocar,hora_alocar) values
        (?,?,?,?,?) ';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getIdEquipamento());
        $sql->bindValue(2, $vo->getIdSetor());
        $sql->bindValue(3, $vo->getSitAlocar());
        $sql->bindValue(4, $vo->getDataAlocar());
        $sql->bindValue(5, $vo->getHoraALocar());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function FiltrarAlocado($idSetor)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select al.id_alocar,
                           eq.ident_equipamento,
                           eq.desc_equipamento,
                           al.sit_alocar
                    from tb_alocar_equip as al
                    inner join tb_equipamento as eq
                    on al.id_equipamento = eq.id_equipamento
                    where al.id_setor = ?
                    and al.data_remover is null';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$idSetor);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function RemoverEquipamentoDAO(EquipamentoVo $vo){
        $conexao = parent::retornaConexao();
        $comando = 'update tb_alocar_equip
                        set data_remover = ?,
                            hora_remover = ?,
                            sit_alocar = ?,
                        where id_alocar = ?';
        
    }
}
