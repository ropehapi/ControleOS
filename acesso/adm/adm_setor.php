<?php

require_once '../../CTRL/SetorCTRL.php';
require_once '../../VO/SetorVo.php';


$ctrl = new SetorCTRL();

if (isset($_POST['btnGravar'])) {
    $vo = new SetorVo();


    $nome = $_POST['nomeSetor'];

    $vo->setNomeSetor($nome);
    $ret = $ctrl->InserirSetorCTRL($vo);
} else if (isset($_POST['btnExcluir'])) {
    $cod = $_POST['cod_item'];
    $ret = $ctrl->ExcluirSetorCTRL($cod);
}elseif(isset($_POST['btnAlterar'])){
    $vo = new SetorVo;
    $ctrl = new SetorCTRL;

    $vo->setIdSetor($_POST['cod_alt']);
    $vo->setNomeSetor($_POST['nome_alt']);

    $ret = $ctrl->AlterarSetorCTRL($vo);
}

$setores = $ctrl->ConsultarSetorCTRL();

?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include_once '../../template/_head.php'
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once '../../template/_topo.php';
        include_once '../../template/_menu.php';
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Setores</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Setores</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciar setores</h3>
                    </div>
                    <div class="card-body">

                        <form method="post" action="adm_setor.php">
                            <div class="form-group">
                                <label>Nome do Setor</label>
                                <input id="nome" type="text" class="form-control" name="nomeSetor" placeholder="Digite aqui">
                            </div>
                            <button onclick="return ValidarTela(7)" class="btn btn-success" name="btnGravar">Gravar</button>

                        </form>
                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Setores Cadastrados</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome do setor</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                                    <tr>
                                                        <td><?= $setores[$i]['nome_setor'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosAlterar('<?=$setores[$i]['id_setor'] ?>','<?=$setores[$i]['nome_setor'] ?>')">Alterar</a>
                                                            <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $setores[$i]['id_setor'] ?>','<?= $setores[$i]['nome_setor'] ?>')">Excluir</a>

                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form method="post" action="adm_setor.php">
                                            <?php
                                            include_once '../../template/_modal_excluir.php';
                                            ?>
                                        </form>

                                        <form method="post" action="adm_setor.php">
                                            <?php
                                            include_once '../adm/modal/_alterar_setor.php';
                                            ?>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php
        include_once '../../template/_footer.php';
        include_once '../../template/_msg.php';
        ?>
    </div>
    <!-- ./wrapper -->


</body>

</html>