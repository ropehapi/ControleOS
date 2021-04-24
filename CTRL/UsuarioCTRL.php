<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/UsuarioDAO.php';

class UsuarioCTRL{
    public function InserirUserAdm(UsuarioVO $vo){
        if($vo->getTipo()=='' || $vo->getNome()==''||$vo->getCpf()==''){
            return 0;
        }

        $vo->setDtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetornaCriptografado($vo->getCpf()));
        $dao = new UsuarioDAO;
        return $dao->InserirUsuarioAdmDAO($vo);
    }

    public function InserirUserTecnico(TecnicoVO $vo){
        if($vo->getTipo()=='' || $vo->getNome()==''||$vo->getCpf()==''||
           $vo->getEmailTec()==''||$vo->getTelTec()==''||$vo->getEnderecoTec()==''){
            return 0;
        }

        $dao = new UsuarioDAO;
        return $dao->InserirTecDAO($vo);
    }

    public function InserirUserFuncionario(FuncionarioVo $vo){
        if($vo->getTipo()=='' || $vo->getNome()==''||$vo->getCpf()==''||
           $vo->getEmailFunc()==''||$vo->getTelFunc()==''||$vo->getEnderecoFunc()==''){
            return 0;
        }

        $dao = new UsuarioDAO;
        return $dao->InserirFuncDAO($vo);
    }

    public function PesquisarUsuario(UsuarioVO $vo){
        if($vo->getBuscarNome()==''){
            return 0;
        }
    }
    
    public function AlterarSenha(UsuarioVO $vo){
        if($vo->getSenha()==''||$vo->getNovaSenha()==''||$vo->getrNovaSenha()==''){
            return 0;
        }
    }

    public function VerificarCpfCadastro($cpf){
        $dao = new UsuarioDAO;
        return $dao->VerificarCpfCadastro($cpf);
    }

    public function VerificarEmailCadastro($email){
        $dao = new UsuarioDAO;
        return $dao->VerificarEmailCadastro($email);
    }

    public function FiltrarUsuarioCTRL($nomeFiltro){       
        $dao = new UsuarioDAO;
        return $dao->FiltrarUsuarioDAO($nomeFiltro);
    }
    
}