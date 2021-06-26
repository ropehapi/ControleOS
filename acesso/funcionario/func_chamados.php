<?php
require_once '../../CTRL/ChamadoCTRL.php';
$sit = '';
if (isset($_POST['btnPesquisar'])) {
    $ctrl = new ChamadoCTRL;
    $sit = $_POST['sitChamado'];
    $chs = $ctrl->FiltrarChamadoSetor($sit);

    if (count($chs) == 0) {
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
                            <h1>Filtre os chamados do setor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Chamados do setor</li>
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
                        <h3 class="card-title">Aqui você visualiza todos os seus chamados realizados</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="func_chamados.php">
                            <div class="form-group">
                                <label>Escolha a situação do chamado</label>
                                <select id="sitChamado" name="sitChamado" class="form-control select2" style="width: 100%;">
                                    <option value="0" <?= $sit == 0 ? 'selected' : '' ?> ">Todos</option>
                                    <option value=" 1" <?= $sit == 1 ? 'selected' : '' ?> ">Aguardando atendimento</option>
                                    <option value=" 2" <?= $sit == 2 ? 'selected' : '' ?> ">Em atendimento</option>
                                    <option value=" 3" <?= $sit == 3 ? 'selected' : '' ?> ">Finalizado</option>
                                </select>
                            </div>

                            <button name=" btnPesquisar" onclick="return ValidarTela(11)" class="btn btn-warning">Pesquisar</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($chs) && count($chs) > 0) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Chamados encontrados</h3>

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
                                                <th>Data da abertura</th>
                                                <th>Funcionário</th>
                                                <th>Equipamento</th>
                                                <th>Problema</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($chs as $item) { ?>
                                                <tr>
                                                    <td><?= $item['data_chamado'] ?></td>
                                                    <td><?= $item['funcionario'] ?></td>
                                                    <td><?= $item['ident_equipamento'] ?>/ <?= $item['desc_equipamento'] ?></td>
                                                    <td><?= $item['desc_problema'] ?></td>
                                                    
                                                    <td>
                                                        <?php if ($item['data_atendimento'] != '') { ?>
                                                            <a href="#" data-toggle="modal" data-target="#modal-detalhe" onclick="return CarregarModalDetalharAtendimento('<?= $item['data_atendimento'] . ' às ' .$item['hora_atendimento'] ?>','<?= $item['data_encerramento'] . ' às ' .$item['hora_encerramento'] ?>','<?= $item['tecnico'] ?>','<?= $item['laudo_chamado'] ?>')" class="btn btn-warning btn-xs">Ver atendimento</a>
                                                        <?php }else{ 
                                                            echo '<i>Aguardando atendimento</i>';
                                                         } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php 
                                    include_once 'modal/_ver_atendimento.php';
                                    ?>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                <?php } ?>
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