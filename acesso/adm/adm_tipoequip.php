<?php

require_once '../../CTRL/TipoCTRL.php';
require_once '../../VO/TipoVo.php';


$ctrl = new TipoCTRL;

if (isset($_POST['btnGravar'])) {
    $vo = new TipoVo;

    $nome = $_POST['nome'];
    $vo->setNomeTipo($nome);

    $ret = $ctrl->InserirTipoCTRL($vo);
}else if(isset($_POST['btnExcluir'])){
    $cod = $_POST['cod_item'];
    $ret = $ctrl->ExcluirTipoCTRL($cod);
}else if(isset($_POST['btnAlterar'])){
    $vo = new TipoVo;
    $ctrl = new TipoCTRL;

    $vo->setNomeTipo($_POST['nome_alt']);
    $vo->setIdTipo($_POST['cod_alt']);

    $ret = $ctrl->AlterarSetorCTRL($vo);
}

$tipos = $ctrl->ConsultarTipoCTRL();

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
                            <h1>Tipos de equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Tipo do equipamento</li>
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
                        <h3 class="card-title">Gerenciar todos os tipos de equipamento</h3>
                    </div>

                    <form method="POST" action="adm_tipoequip.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nome do tipo</label>
                                <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite aqui">
                            </div>
                            <button onclick="return InserirTipo()" name="btnGravar" class="btn btn-success">Gravar</button>
                    </form>
                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tipos cadastrados</h3>

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
                                                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosAlterar('<?= $tipos[$i]['id_tipo']?>','<?=$tipos[$i]['nome_tipo']?>')">Alterar</a>
                                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $tipos[$i]['id_tipo'] ?>','<?= $tipos[$i]['nome_tipo'] ?>')">Excluir</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <form method="post" action="adm_tipoequip.php">
                                            <?php
                                            include_once '../../template/_modal_excluir.php';
                                            ?>
                                            <?php 
                                            include_once '../adm/modal/_alterar_tipo.php';
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