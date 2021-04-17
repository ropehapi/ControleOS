<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/CTRL/UsuarioCTRL.php';

if(isset($_POST['email_user'])){
    $email = $_POST['email'];
    $ctrl = new UsuarioCTRL;
    $temEmail = $ctrl->VerificarEmailCadastro($email);

    echo $temEmail ;
}