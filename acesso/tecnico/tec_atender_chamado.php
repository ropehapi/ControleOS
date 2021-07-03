<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/CTRL/ChamadoCTRL.php';

$ctrl = new ChamadoCTRL;

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dados = $ctrl->FiltrarChamadosTec(null, $_GET['cod']);

    if (count($dados) == 0) {
        header('location : tec_chamados.php');
        exit;
    }
} else {
    header('location : tec_chamados.php');
}

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
                            <h1>Faça o atendimento e finalização dos chamados aqui</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Atender chamado</li>
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
                        <h3 class="card-title">Escreva de uma forma clara o problema do Equipamento</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label>Data</label>
                                <input value="<?= $dados[0]['data_chamado'] ?>/<?= $dados[0]['hora_chamado'] ?>" type="text" disabled class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Setor</label>
                                <input value="<?= $dados[0]['nome_setor'] ?>" type="text" disabled class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Funcionário</label>
                                <input value="<?= $dados[0]['funcionario'] ?>" type="text" disabled class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Equipamento</label>
                                <input value="<?= $dados[0]['ident_equipamento'] ?>/<?= $dados[0]['desc_equipamento'] ?>" type="text" disabled class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Problema</label>
                                <textarea value="<?= $dados[0]['problema_chamado'] ?>" readonly class="form-control" placeholder="Digite aqui"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Laudo</label>
                                <textarea value="<?= $dados[0][''] ?>" class="form-control" placeholder="Digite aqui"></textarea>
                            </div>


                        </div>
                        <button class="btn btn-success">Finalizar</button>
                    </div>

                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php
        include_once '../../template/_footer.php'
        ?>
    </div>
    <!-- ./wrapper -->


</body>

</html>