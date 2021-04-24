<?php

class UtilCTRL
{

    public static function CodigoUserLogado()
    {
        return 1;
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
