<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/CTRL/UsuarioCTRL.php';

if(isset($_POST['cpf_user'])){
    $cpf = $_POST['cpf_user'];
    $ctrl = new UsuarioCTRL;
    $temCpf = $ctrl->VerificarCpfCadastro($cpf);

    echo $temCpf ;
}