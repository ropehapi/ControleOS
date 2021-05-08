<?php

require_once 'ConexaoDAO.php';

class UsuarioDAO extends Conexao
{

    public function InserirUsuarioAdmDAO(UsuarioVO $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getTipo());
        $sql->bindValue(2, $vo->getNome());
        $sql->bindValue(3, $vo->getCpf());
        $sql->bindValue(4, $vo->getSenha());
        $sql->bindValue(5, $vo->getStatus());
        $sql->bindValue(6, $vo->getDtCad());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function InserirFuncDAO(FuncionarioVO $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getTipo());
        $sql->bindValue(2, $vo->getNome());
        $sql->bindValue(3, $vo->getCpf());
        $sql->bindValue(4, $vo->getSenha());
        $sql->bindValue(5, $vo->getStatus());
        $sql->bindValue(6, $vo->getDtCad());

        $conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $sql->execute();

            //Recuperar o ID do usuário cadastrado
            $id_user = $conexao->lastInsertId();
            $comando = 'insert into tb_funcionario (
                id_usuario_fun,
                id_setor,
                email_fun,
                tel_fun,
                endereco_fun
            )
            value(?,?,?,?,?)';
            $sql = $conexao->prepare($comando);
            $i = 1;
            $sql->bindValue($i++, $id_user);
            $sql->bindValue($i++, $vo->getIdSetor());
            $sql->bindValue($i++, $vo->getEmailFunc());
            $sql->bindValue($i++, $vo->getTelFunc());
            $sql->bindValue($i++, $vo->getEnderecoFunc());
            //Insere na tb_tecnico
            $sql->execute();
            //Confirmar a transação
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            //Cancela a transação
            $conexao->rollBack();
            return -1;
        }
    }

    public function InserirTecDAO(TecnicoVO $vo)
    {
        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $vo->getTipo());
        $sql->bindValue(2, $vo->getNome());
        $sql->bindValue(3, $vo->getCpf());
        $sql->bindValue(4, $vo->getSenha());
        $sql->bindValue(5, $vo->getStatus());
        $sql->bindValue(6, $vo->getDtCad());

        $conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $sql->execute();

            //Recuperar o ID do usuário cadastrado
            $id_user = $conexao->lastInsertId();
            $comando = 'insert into tb_tecnico (
                id_usuario_tec,
                email_tec,
                tel_tec,
                endereco_tec
            )
            value(?,?,?,?)';
            $sql = $conexao->prepare($comando);
            $i = 1;
            $sql->bindValue($i++, $id_user);
            $sql->bindValue($i++, $vo->getEmailTec());
            $sql->bindValue($i++, $vo->getTelTec());
            $sql->bindValue($i++, $vo->getEnderecoTec());
            //Insere na tb_tecnico
            $sql->execute();
            //Confirmar a transação
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            //Cancela a transação
            $conexao->rollBack();
            return -1;
        }
    }

    public function VerificarCpfCadastro($cpf)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select count(cpf_usuario) as contar from tb_usuario where cpf_usuario = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $cpf);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $result = $sql->fetchAll();

        return $result[0]['contar'];
    }

    public function VerificarEmailCadastro($email)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $email);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $result = $sql->fetchAll();

        return $result[0]['contar'];
    }

    public function FiltrarUsuarioDAO($nomeUsuario)
    {
        $conexao = parent::retornaConexao();
        $comando =  'select id_usuario,nome_usuario,tipo_usuario from tb_usuario where nome_usuario like ?';
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, '%' . $nomeUsuario . '%');
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharUsuario($id)
    {
        $conexao = parent::retornaConexao();
        $comando = 'select usu.id_usuario,
                           usu.nome_usuario,
                           usu.tipo_usuario,
                           usu.cpf_usuario,
                           tec.tel_tec,
                           tec.email_tec,
                           tec.endereco_tec,
                           fun.id_setor,
                           fun.tel_func,
                           fun_endereco_func
                      from tb_usuario as usu
                      left join tb_funcionario as fun
                      on usu.id_usuario = fun.id_usuario_func
                      left join tb_tecnico as tec
                      on usu.id_usuario = tec.id_usuario-tec
                      where usu.id_usuario = ? ';
        
    }

    public function ExcluirUsuario($idUsuario, $tipo)
    {

        $conexao = parent::retornaConexao();
        $sql = new PDOStatement;

        switch ($tipo) {
            case 1:
                $comando = 'delete from tb_usuario where id_usuario = ?';
                $sql = $conexao->prepare($comando);
                $sql->bindValue(1, $idUsuario);

                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
                break;

            case 2:
                $comando = 'delete from tb_funcionario where id_usuario_fun = ?';
                $sql = $conexao->prepare($comando);
                $sql->bindValue(1, $idUsuario);
                $conexao->beginTransaction();
                try {
                    $sql->execute();
                    $comando = 'delete from tb_usuario where id_usuario = ?';
                    $sql = $conexao->prepare($comando);
                    $sql->bindValue(1, $idUsuario);
                    $conexao->commit();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
                break;

            case 3:
                $comando = 'delete from tb_tecnico where id_usuario_tec = ?';
                $sql = $conexao->prepare($comando);
                $sql->bindValue(1, $idUsuario);
                $conexao->beginTransaction();
                try {
                    $sql->execute();
                    $comando = 'delete from tb_usuario where id_usuario = ?';
                    $sql = $conexao->prepare($comando);
                    $sql->bindValue(1, $idUsuario);
                    $conexao->commit();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;

                }
                break;
        }
    }
}
