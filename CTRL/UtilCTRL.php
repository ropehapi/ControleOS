<?php

class UtilCTRL{

    public static function CodigoUserLogado(){
        return 1;
    }

    public static function SetarFusoHorario(){
        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function HoraAtual(){
        self::SetarFusoHorario();
        return date('H:i');
    }

    public static function DataAtual(){
        self::SetarFusoHorario();
        return date('Y-m-d');
    }
}