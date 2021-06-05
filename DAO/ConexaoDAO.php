<?php

// Configurações do site
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', null); //Senha
define('DB', 'db_os'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, Wladimir M. Barros
 */

class Conexao {

    /** @var PDO */
    private static $Connect;

    private static function Conectar() {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    public static function retornaConexao() {
        return  self::Conectar();
    }

    public static function GravarErro($msg,$idUser,$funcao){
        $quebra = chr(13) . chr(10);


        $arquivo = $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/CTRL/Erro/erro.txt';

        //Verifica se o arquivo nao existe
        if(!file_exists($arquivo)){
            $arquivo = fopen($arquivo , 'w');
        }else{
            $arquivo = fopen($arquivo , 'a+');
        }

        $textoFinal = '*******************************************'. $quebra;
        $textoFinal .= 'Erro: ' . $msg;
        $textoFinal .= 'Data: ' . date('Y-m-d') . 'Hora: ' . date('H:i'). $quebra;
        $textoFinal .= 'Função chamada: ' . $funcao . $quebra;
        $textoFinal .= 'Id usuário logado: ' . $idUser . $quebra;


        //Escrever no arquivo o conteúdo do erro
        fwrite($arquivo,$textoFinal);
        fclose($arquivo);
    } 
    
    
}