<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/CTRL/TipoCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/VO/TipoVO.php';

$ctrl = new TipoCTRL;

if (isset($_POST['nome_tipo']) && $_POST['acao'] == 'I') {

    $vo = new TipoVo;

    $nome = $_POST['nome_tipo'];
    $vo->setNomeTipo($nome);

    $ret = $ctrl->InserirTipoCTRL($vo);
} elseif (isset($_POST['acao']) && $_POST['acao'] == 'C') {
    $tipos = $ctrl->ConsultarTipoCTRL();
?>
    <table class="table table-bordered" id="tabTipos">
        <thead>
            <tr>
                <th>Nome do tipo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                <tr>
                    <td><?= $tipos[$i]['nome_tipo'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosAlterar('<?= $tipos[$i]['id_tipo'] ?>','<?= $tipos[$i]['nome_tipo'] ?>')">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $tipos[$i]['id_tipo'] ?>','<?= $tipos[$i]['nome_tipo'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
}