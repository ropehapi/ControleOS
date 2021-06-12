<?php

require_once 'ConexaoDAO.php';

class ChamadoDAO extends Conexao
{

    public function InserirChamadoDAO(ChamadoVo $vo)
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

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function CarregarEquipamentoSetor($idSetorLogado,$sit)
    {
        $conexao = parent::retornaConexao();
        $comando = 'SELECT al.id_equipamento,
                           eq.ident_equipamento,
                           eq.desc_equipamento,
                      FROM tb_alocar_equip AS al
                INNER JOIN tb_equipamento as eq
                       ON al.id_equipamento = eq.id_equipamento
                    WHERE al.id_setor = ?
                      AND al.sit_alocar = ?';
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$idSetorLogado);
        $sql->bindValue(2,$sit);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
