<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/CTRL/UsuarioCTRL.php';

if(isset($_POST['senha_atual'])){
    $ctrl = new UsuarioCTRL;

    if($ctrl->ValidarSenhaAtual($_POST['senha_atual'])){
        echo 1;
    }else{
        echo 0;
    }
}
