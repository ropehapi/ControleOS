<?php

require_once 'ConexaoDAO.php';

class ChamadoDAO extends Conexao
{

    public function AbrirChamadoDAO(ChamadoVo $vo, $idAlocar)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_chamado
                    (desc_problema,data_chamado,hora_chamado,id_usuario,id_equipamento)
                    values(?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getDescProblema());
        $sql->bindValue(2, $vo->getDataChamado());
        $sql->bindValue(3, $vo->getHoraChamado());
        $sql->bindValue(4, $vo->getIdUsuarioFunc());
        $sql->bindValue(5, $vo->getIdEquip());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $comando =  'update tb_alocar set sit_alocar = 3 where id_alocar = ?';
            $sql = $conexao->prepare($comando);
            $sql->bindValue(1, $idAlocar);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            return -1;
        }
    }

    public function CarregarEquipamentoSetor($idSetorLogado, $sit)
    {
        $conexao = parent::retornaConexao();
        $comando = 'SELECT al.id_equipamento,
                           eq.ident_equipamento,
                           eq.desc_equipamento,
                           al.id_alocar
                      FROM tb_alocar_equip AS al
                INNER JOIN tb_equipamento as eq
                       ON al.id_equipamento = eq.id_equipamento
                    WHERE al.id_setor = ?
                      AND al.sit_alocar = ?';
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $idSetorLogado);
        $sql->bindValue(2, $sit);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function FiltrarChamadoSetor($filtrarSit)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select cha.data_chamado,
                           fun.id_funcionario,
                           eq.id_equipamento,
                           cha.problema,
                           cha.data_atendimento,
                           tec.id_tecnico,
                           cha.data_encerramento,
                           cha.laudo_atendimento
                      from tb_chamado as cha
                inner join tb_equipamento as eq
                        on cha.id_equipamento = eq.id_equipamento
                inner join tb_funcionario as fun
                        on cha.id_funcionario = fun.id_funcionario
                 left join tb_tecnico as tec
                        on cha.id_tec = tec.id_tec';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
