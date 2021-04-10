<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/CTRL/ModeloCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/Vo/ModeloVo.php';

$ctrl = new ModeloCTRL;

if(isset($_POST['nome_modelo']) && $_POST['acao']== 'I'){
    $vo = new ModeloVo;
    $nome = $_POST['nome_modelo'];
    $vo->setNomeModelo($nome);

    $ret = $ctrl->InserirModeloCTRL($vo);
}
