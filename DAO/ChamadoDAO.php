<?php

require_once 'ConexaoDAO.php';

class ChamadoDAO extends Conexao
{

    public function AbrirChamadoDAO(ChamadoVo $vo, $idAlocar)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_chamado
                    (desc_problema,data_chamado,hora_chamado,id_usuario_func,id_equipamento)
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

            $comando =  'update tb_alocar_equip set sit_alocar = 3 where id_alocar = ?';
            $sql = $conexao->prepare($comando);
            $sql->bindValue(1, $idAlocar);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
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

    public function FiltrarChamadoSetor($idSetor, $situacao)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select 
                            ch.data_chamado,
                            ch.hora_chamado,
                            usu_fun.nome_usuario as funcionario,
                            eq.ident_equipamento,
                            eq.desc_equipamento,
                            ch.desc_problema,
                            ch.data_atendimento,
                            ch.hora_atendimento,
                            usu_tec.nome_usuario as tecnico,
                            ch.data_encerramento,
                            ch.hora_encerramento,
                            ch.laudo_chamado
                        from
                            tb_chamado as ch
                    inner join
                        tb_funcionario as fu
                    on 
                        ch.id_usuario_func = fu_id_usuario_func
                    inner join 
                        tb_usuario as usu_fun
                    on 
                        fu.id_usuario_func = usu_fun.id_usuario
                    inner join 
                        tb_equipamento as eq
                    on 
                        ch.id_equipamento = eq.id_equipamento
                    left join 
                        tb_tecnico as te
                    on
                        te.id_usuario_tec = ch.id_usuario_tec
                    left join
                        tb_usuario as usu_tec
                    on 
                        usu_tec.id_usuario = te.id_usuario_tec
                    inner join
                        tb_alocar_equip as alo
                    on 
                        alo.id_equipamento = eq.id_equipamento
                    where 
                        alo.id_setor = ?';

        switch ($situacao) {
            case 1: //Aguardando
                $comando .= ' and ch.data_atendimento is null and alo.sit_alocar = 3';
                break;
            case 2: //Em atendimento
                $comando .= ' and ch.data_atendimento is not null and ch.data_encerramento is null and alo.sit_alocar = 3';
                break;
            case 3: //Finalizado
                $comando .= ' and ch.data_encerramento is not null and alo.sit_alocar = 1';
                break;
        }

        $comando .= ' order by ch.id_chamado DESC';

        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $idSetor);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function FiltrarChamadosTec($FiltrarSit,$cod)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select cha.id_chamado,
                               cha.data_chamado,
                               cha.data_atendimento,
                               cha.data_encerramento,
                               cha.hora_chamado,
                               usu_func.nome_usuario as nome_funcionario,
                               equip.ident_equipamento,
                               equip.desc_equipamento,
                               cha.desc_problema,
                               se.nome_setor
                            from tb_chamado as cha
                            
                        inner join tb_equipamento as equip
                            on cha.id_equipamento = equip.id_equipamento
                            
                        inner join tb_funcionario as func
                            on cha.id_usuario_func = func.id_usuario_func
                        inner join tb_usuario as usu_func
                            on func.id_usuario_func = usu_func.id_usuario
                        
                        inner join tb_alocar_equip as alo
                            on alo.id_equipamento = equip.id_equipamento
                        inner join tb_setor as se
                            on alo.id_setor = se.id_setor';

        if ($FiltrarSit == 1)
            $comando .= ' where cha.data_atendimento is null';

        if ($FiltrarSit == 2)
            $comando .= ' where cha.data_atendimento is not null and cha.data_encerramento is null';

        if ($FiltrarSit == 3)
            $comando .= ' where cha.data_encerramento is not null';

        if($cod != null){
            $comando .= ' where cha.id_chamado = ' . $cod;
        }

        $comando .= ' order by cha.id_chamado DESC';

        $sql = $conexao->prepare($comando);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}
