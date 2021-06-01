<?php

class UtilCTRL
{
    private static function IniciarSessao(){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function CriarSessao($id,$tipo,$idSetor){
        self::IniciarSessao();
        $_SESSION['cod'] = $id;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['setor'] = $idSetor;
    }

    public static function Deslogar(){
        self::IniciarSessao();

        unset($_SESSION['cod']);
        unset($_SESSION['tipo']);
        unset($_SESSION['setor']);

        self::VoltarPaginaLogin();
    }

    public static function VerificarLogado(){
        if(!isset($_SESSION['cod'])||$_SESSION['cod']==''){
            self::VoltarPaginaLogin();
        }
    }

    public static function VoltarPaginaLogin(){
        header('http://localhost/ControleOS/acesso/login/acessar.php');
        exit;
    }

    public static function CodigoUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function TipoUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['tipo'];
    }

    public static function SetorUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['setor'];
    }

    public static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function HoraAtual()
    {
        self::SetarFusoHorario();
        return date('H:i');
    }

    public static function DataAtual()
    {
        self::SetarFusoHorario();
        return date('Y-m-d');
    }

    public static function RetornaCriptografado($palavra)
    {
        return password_hash($palavra, PASSWORD_DEFAULT);
    }

    public static function MostrarTipoUser($tipo)
    {
        $nome = '';

        switch ($tipo) {
            case 1:
                $nome = 'Administrador';
                break;
            case 2:
                $nome = 'Funcionário';
                break;
            case 3:
                $nome = 'Técnico';
                break;
        }

        return $nome;
    }
}
