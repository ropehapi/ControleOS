<?php


//Requires
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/UsuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/CTRL/UtilCTRL.php';

class UsuarioCTRL
{
    public function InserirUserAdm(UsuarioVO $vo)
    {
        if ($vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '') {
            return 0;
        }

        $vo->setDtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetornaCriptografado($vo->getCpf()));
        $dao = new UsuarioDAO;
        return $dao->InserirUsuarioAdmDAO($vo);
    }

    public function InserirUserTecnico(TecnicoVO $vo)
    {
        if (
            $vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '' ||
            $vo->getEmailTec() == '' || $vo->getTelTec() == '' || $vo->getEnderecoTec() == ''
        ) {
            return 0;
        }

        $vo->setDtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetornaCriptografado($vo->getCpf()));
        $dao = new UsuarioDAO;
        return $dao->InserirTecDAO($vo);
    }

    public function InserirUserFuncionario(FuncionarioVo $vo)
    {
        if (
            $vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '' ||
            $vo->getEmailFunc() == '' || $vo->getTelFunc() == '' || $vo->getEnderecoFunc() == ''
        ) {
            return 0;
        }

        $vo->setDtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetornaCriptografado($vo->getCpf()));
        $dao = new UsuarioDAO;
        return $dao->InserirFuncDAO($vo);
    }

    public function PesquisarUsuario(UsuarioVO $vo)
    {
        if ($vo->getBuscarNome() == '') {
            return 0;
        }
    }

    public function VerificarCpfCadastro($cpf)
    {
        $dao = new UsuarioDAO;
        return $dao->VerificarCpfCadastro($cpf);
    }

    public function VerificarEmailCadastro($email)
    {
        $dao = new UsuarioDAO;
        return $dao->VerificarEmailCadastro($email);
    }

    public function FiltrarUsuarioCTRL($nomeFiltro)
    {
        $dao = new UsuarioDAO;
        return $dao->FiltrarUsuarioDAO($nomeFiltro);
    }

    public function ExcluirUsuarioCTRL($idUsuario, $tipo)
    {
        $dao = new UsuarioDAO;
        return $dao->ExcluirUsuario($idUsuario, $tipo);
    }

    public function DetalharUsuario($idUser)
    {
        $dao = new UsuarioDAO;
        return $dao->DetalharUsuario($idUser == '' ? UtilCTRL::CodigoUserLogado() : $idUser);
    }



    public function AlterarUserFun(FuncionarioVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getEmailFunc() == '' || $vo->getTelFunc() == '' ||$vo->getEnderecoFunc()=='') {
            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarUserFun($vo);
    }

    public function AlterarUserTec(TecnicoVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getCPF() == '' || $vo->getEmailTec() == '' || $vo->getTelTec() == '') {
            return 0;
        }
        $dao = new UsuarioDAO();
        return $dao->AlterarUserTec($vo);
    }

    public function AlterarUserADM(UsuarioVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getCPF() == '') {
            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarUserAdm($vo);
    }

    public function ValidarLogin($cpf, $senha)
    {
        if (trim($cpf) == '' || trim($senha) == '') {
            return 0;
        }

        $dao = new UsuarioDAO;
        $user = $dao->ValidarLogin($cpf);

        //Verifica se encontrou o usuário
        if (count($user) == 0) {
            return 2;
        }

        $senha_hash = $user[0]['senha_usuario'];

        //Verifica se a senha bate
        if (password_verify($senha, $senha_hash)) {
            UtilCTRL::CriarSessao(
                $user[0]['id_usuario'],
                $user[0]['tipo_usuario'],
                $user[0]['id_setor']
            );

            switch ($user[0]['tipo_usuario']) {
                case '1':
                    header('location: http://localhost/ControleOS/acesso/adm/adm_usuario.php');
                    exit;
                    break;
                case '2':
                    header('location: http://localhost/ControleOS/acesso/funcionario/func_meus_dados.php');
                    exit;
                    break;
                case '3':
                    header('location: http://localhost/ControleOS/acesso/tecnico/tec_meus_dados.php');
                    exit;
                    break;
            }
        } else {
            return 2;
        }
    }

    public function ValidarSenhaAtual($senha_atual){
        $dao = new UsuarioDAO;
        $user_senha_hash = $dao->RecuperarSenhaAtual(UtilCTRL::CodigoUserLogado());
        $senha_hash = $user_senha_hash[0]['senha_usuario'];

        return password_verify($senha_atual,$senha_hash);
    }

    public function AlterarSenha($senha,$rSenha){
        if(trim($senha)=='' || trim($rSenha)==''){
            return 0;
        }

        if(strlen(trim($senha)) <6){
            return 3;
        }

        if(trim($senha) != trim($rSenha)){
            return 4;
        }

        $dao = new UsuarioDAO;

        return $dao->AlterarSenha(
            UtilCTRL::CodigoUserLogado(),
            UtilCTRL::RetornaCriptografado($senha)
        );
    }
}
