<?php

require_once $_SERVER['DOCUMENT_ROOT'] .  '/ControleOS/VO/ChamadoVo.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/ControleOS/CTRL/ChamadoCTRL.php';

if (isset($_POST['btnPesquisar'])) {
    $ctrl = new ChamadoCTRL;
    $chamados = $ctrl->FiltrarChamadosTec($_POST['sitChamado'],null);

    if (count($chamados) == 0) {
        $ret = 5;
    }
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
                            <h1>Filtre os chamados</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Consultar chamados</li>
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
                        <h3 class="card-title">Aqui você poderá consultar e atender a um chamado</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tec_chamados.php">
                            <div class="form-group">
                                <label>Escolha a situação do chamado</label>
                                <select id="sitChamado" name="sitChamado" class="form-control select2" style="width: 100%;">
                                    <option value="0" ">Todos</option>
                                    <option value=" 1" ">Aguardando atendimento</option>
                                    <option value=" 2" ">Em atendimento</option>
                                    <option value=" 3" ">Finalizado</option>
                                </select>
                            </div>

                            <button onclick=" return ValidarTela(15)" name="btnPesquisar" class="btn btn-success">Pesquisar</button>
                        </form>
                    </div>

                    <?php if (isset($chamados) && count($chamados) > 0) { ?>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Data da abertura</th>
                                        <th>Funcionário</th>
                                        <th>Equipamento</th>
                                        <th>Problema</th>
                                        <th>Setor</th>
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($chamados as $item) { ?>
                                        <tr>
                                            <td><?= $item['data_chamado'] ?>/<?= $item['hora_chamado'] ?></td>
                                            <td><?= $item['nome_funcionario'] ?></td>
                                            <td><?= $item['desc_equipamento'] ?>/<?= $item['ident_equipamento'] ?></td>
                                            <td><?= $item['desc_problema'] ?></td>
                                            <td><?= $item['nome_setor'] ?></td>
                                            <td><?= UtilCTRL::SituacaoChamado($item['data_atendimento'], $item['data_encerramento']) ?></td>
                                            <td>
                                                <a href="tec_atender_chamado.php?cod<?= $item['id_chamado'] ?>" class="btn btn-warning btn-xs">Ver mais</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                </div>

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