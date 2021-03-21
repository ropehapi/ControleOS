<?php 

require_once 'ConexaoDAO.php';

class UsuarioDAO extends Conexao{

    public function InserirUsuarioAdmDAO(UsuarioVO $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into 
                    tb_usuario(tipo_usuario,nome_usuario,cpf_usuario,senha_usuario,status_usuario,data_cadastro)
                    values (?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1,$vo->getTipo());
        $sql->bindValue(2,$vo->getNome());
        $sql->bindValue(3,$vo->getCpf());
        $sql->bindValue(4,$vo->getSenha());
        $sql->bindValue(5,$vo->getStatus());
        $sql->bindValue(6,$vo->getDtCad());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -1;
        }
    }

    public function InserirFuncDAO(FuncionarioVO $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_funcionario (email_func,tel_func,endereco_func,id_setor)
                    values (?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare(($comando));
        $sql->bindValue(1,$vo->getEmailFunc());
        $sql->bindValue(2,$vo->getTelFunc());
        $sql->bindValue(3,$vo->getEnderecoFunc());
        $sql->bindValue(4,$vo->getIdSetor());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -1;
        }
    }

    public function InserirTecDAO(TecnicoVO $vo){
        $conexao = parent::retornaConexao();
        $comando = 'insert into tb_tecnico (email_tec,tel_tec,endereco_tec)
                    values (?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare(($comando));
        $sql->bindValue(1,$vo->getEmailTec());
        $sql->bindValue(2,$vo->getTelTec());
        $sql->bindValue(3,$vo->getEnderecoTec());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -1;
        }
    }

   // public function ConsultarUsuarioDAO(){
   //   $conexao = parent::retornaConexao();
   //   $conexao = ''
   // }
}