<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/CTRL/UsuarioCTRL.php';
var_dump($_SERVER['DOCUMENT_ROOT']);

if(isset($_POST['senha_atual'])){
    $ctrl = new UsuarioCTRL;

    if($ctrl->ValidarSenhaAtual($_POST['senha_atual'])){
        echo '1';
    }else{
        echo '0';
    }
}