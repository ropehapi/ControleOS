<?php

require_once 'ConexaoDAO.php';

class UsuarioDAO extends Conexao
{

    /** @var PDO */
    private $conexao;

    /** @var PDOSTatement */
    private $sql;

    public function __construct()
    {   
        $this->conexao = parent::retornaConexao();
        $this->sql = new PDOStatement;
    }

    public function InserirUsuarioAdmDAO(UsuarioVO $vo)
    {
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, $vo->getTipo());
        $this->sql->bindValue(2, $vo->getNome());
        $this->sql->bindValue(3, $vo->getCpf());
        $this->sql->bindValue(4, $vo->getSenha());
        $this->sql->bindValue(5, $vo->getStatus());
        $this->sql->bindValue(6, $vo->getDtCad());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function InserirFuncDAO(FuncionarioVO $vo)
    {
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, 2);
        $this->sql->bindValue(2, $vo->getNome());
        $this->sql->bindValue(3, $vo->getCpf());
        $this->sql->bindValue(4, $vo->getSenha());
        $this->sql->bindValue(5, $vo->getStatus());
        $this->sql->bindValue(6, $vo->getDtCad());

        $this->conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $this->sql->execute();

            //Recuperar o ID do usuário cadastrado
            $id_user = $this->conexao->lastInsertId();
            $comando = 'insert into tb_funcionario (
                id_usuario_fun,
                id_setor,
                email_func,
                tel_func,
                endereco_func
            )
            values(?,?,?,?,?)';
            $this->sql = $this->conexao->prepare($comando);
            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getIdSetor());
            $this->sql->bindValue($i++, $vo->getEmailFunc());
            $this->sql->bindValue($i++, $vo->getTelFunc());
            $this->sql->bindValue($i++, $vo->getEnderecoFunc());
            //Insere na tb_tecnico
            $this->sql->execute();
            //Confirmar a transação
            $this->conexao->commit();
            return 1;
        } catch (Exception $ex) {
            //Cancela a transação
            echo $ex->getMessage();
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function InserirTecDAO(TecnicoVO $vo)
    {
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, 3);
        $this->sql->bindValue(2, $vo->getNome());
        $this->sql->bindValue(3, $vo->getCpf());
        $this->sql->bindValue(4, $vo->getSenha());
        $this->sql->bindValue(5, $vo->getStatus());
        $this->sql->bindValue(6, $vo->getDtCad());

        $this->conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $this->sql->execute();

            //Recuperar o ID do usuário cadastrado
            $id_user = $this->conexao->lastInsertId();
            $comando = 'insert into tb_tecnico (
                id_usuario_tec,
                email_tec,
                tel_tec,
                endereco_tec
            )
            value(?,?,?,?)';
            $this->sql = $this->conexao->prepare($comando);
            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getEmailTec());
            $this->sql->bindValue($i++, $vo->getTelTec());
            $this->sql->bindValue($i++, $vo->getEnderecoTec());
            //Insere na tb_tecnico
            $this->sql->execute();
            //Confirmar a transação
            $this->conexao->commit();
            return 1;
        } catch (Exception $ex) {
            //Cancela a transação
            $ex->getMessage();
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function VerificarCpfCadastro($cpf)
    {
        $comando = 'select count(cpf_usuario) as contar from tb_usuario where cpf_usuario = ?';
        $this->sql = new PDOStatement;
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, $cpf);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        $result = $this->sql->fetchAll();

        return $result[0]['contar'];
    }

    public function VerificarEmailCadastro($email)
    {
        $comando = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';
        $this->sql = new PDOStatement;
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, $email);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        $result = $this->sql->fetchAll();

        return $result[0]['contar'];
    }

    public function FiltrarUsuarioDAO($nomeUsuario)
    {
        $comando =  'select id_usuario,nome_usuario,tipo_usuario from tb_usuario where nome_usuario like ?';
        $this->sql = new PDOStatement;
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1, '%' . $nomeUsuario . '%');
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }

    public function DetalharUsuario($id)
    {
        $comando = 'select usu.id_usuario,
                           usu.nome_usuario,
                           usu.tipo_usuario,
                           usu.cpf_usuario,
                           tec.tel_tec,
                           tec.email_tec,
                           tec.endereco_tec,
                           fun.id_setor,
                           fun.tel_func,
                           fun.endereco_func,
                           fun.email_func
                      from tb_usuario as usu
                      left join tb_funcionario as fun
                      on usu.id_usuario = fun.id_usuario_fun
                      left join tb_tecnico as tec
                      on usu.id_usuario = tec.id_usuario_tec
                      where usu.id_usuario = ? ';
        $this->sql = $this->conexao->prepare($comando);
        $this->sql->bindValue(1,$id);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
        
    }

    public function ExcluirUsuario($idUsuario, $tipo)
    {

        $this->sql = new PDOStatement;

        switch ($tipo) {
            case 1:
                $comando = 'delete from tb_usuario where id_usuario = ?';
                $this->sql = $this->conexao->prepare($comando);
                $this->sql->bindValue(1, $idUsuario);

                try {
                    $this->sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
                break;

            case 2:
                $comando = 'delete from tb_funcionario where id_usuario_fun = ?';
                $this->sql = $this->conexao->prepare($comando);
                $this->sql->bindValue(1, $idUsuario);
                $this->conexao->beginTransaction();
                try {
                    $this->sql->execute();
                    $comando = 'delete from tb_usuario where id_usuario = ?';
                    $this->sql = $this->conexao->prepare($comando);
                    $this->sql->bindValue(1, $idUsuario);
                    $this->conexao->commit();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;
                }
                break;

            case 3:
                $comando = 'delete from tb_tecnico where id_usuario_tec = ?';
                $this->sql = $this->conexao->prepare($comando);
                $this->sql->bindValue(1, $idUsuario);
                $this->conexao->beginTransaction();
                try {
                    $this->sql->execute();
                    $comando = 'delete from tb_usuario where id_usuario = ?';
                    $this->sql = $this->conexao->prepare($comando);
                    $this->sql->bindValue(1, $idUsuario);
                    $this->conexao->commit();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return -1;

                }
                break;
        }
    }

    public function AlterarUserTec(TecnicoVO $vo){
        
        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i=1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getUserId());

        $this->conexao->beginTransaction();

        try{
            $this->sql->execute();

            $comando_sql = 'update tb_tecnico
                                set email_tec = ?,
                                    tel_tec = ?,
                                    endereco_tec = ?
                                where id_usuario_tec = ?';
            
            $this->sql = $this->conexao->prepare($comando_sql);

            $i=1;
            $this->sql->bindValue($i++, $vo->getEmailTec());
            $this->sql->bindValue($i++, $vo->getTelTec());
            $this->sql->bindValue($i++, $vo->getEnderecoTec());
            $this->sql->bindValue($i++, $vo->getUserId());

            $this->sql->execute();
            $this->conexao->commit();

            return 1; 

        }catch (Exception $ex){
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function AlterarUserFun(FuncionarioVO $vo){
        
        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i=1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getUserId());

        $this->conexao->beginTransaction();

        try{
            $this->sql->execute();

            $comando_sql = 'update tb_funcionario
                                set email_func = ?,
                                    tel_func = ?,
                                    endereco_func = ?,
                                    id_setor = ?
                                where id_usuario_fun = ?';
            
            $this->sql = $this->conexao->prepare($comando_sql);

            $i=1;
            $this->sql->bindValue($i++, $vo->getEmailFunc());
            $this->sql->bindValue($i++, $vo->getTelFunc());
            $this->sql->bindValue($i++, $vo->getEnderecoFunc());
            $this->sql->bindValue($i++, $vo->getIdSetor());
            $this->sql->bindValue($i++, $vo->getUserId());

            $this->sql->execute();
            $this->conexao->commit();

            return 1; 

        }catch (Exception $ex){
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function AlterarUserAdm(UsuarioVO $vo){

        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i=1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getUserId());

        try{
            $this->sql->execute();
            return 1;
        }catch (Exception $ex){
            parent::GravarErro($ex->getMessage(), $vo->getUserId(), Alterar);
            return -1;
        }
    }

    public function ValidarLogin($cpf,$senha){
        $comando = 'select * from tb_usuario where cpf_usuario = ? and senha_usuario = ?';
        $this->sql = $this->conexao->prepare($comando);
        $i = 1;
        $this->sql->bindValue($i++,$cpf);
        $this->sql->bindValue($i++,$senha);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        try{
            $this->sql->execute();
            return $this->sql->fetchAll();
        }catch(Exception $ex){
            return -1;
        }   
    }
}
