<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../DAO/SetorDAO.php';
require_once '../../VO/AlocarVo.php';

$setorDAO = new SetorDAO;

if (isset($_POST['btnPesquisar'])) {
    $vo = new AlocarVo;
    $ctrl = new EquipamentoCTRL;

    $idSetor = $_POST['setor'];

    $eqs = $ctrl->FiltrarAlocado($idSetor);
}else if(isset($_POST['btnExcluir'])){
    $id = $_POST['cod_item'];
    $ctrl = new EquipamentoCTRL;
    $vo = new AlocarVo;

    $vo->setIdAlocar($id);

    $ret = $ctrl->RemoverEquipamentoCTRL($vo);
}

$setores = $setorDAO->ConsultarSetorDAO();


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
                            <h1>Remover equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Remover Equipamento</li>
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
                        <h3 class="card-title">Aqui você poderá remover seus equipamentos de um determinado setor</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="adm_remover_equipamento.php">
                            <div class="form-group">
                                <label>Setor</label>
                                <select id="setor" name="setor" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">Selecione</option>
                                    <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                        <option value="<?= $setores[$i]['id_setor'] ?>"><?= $setores[$i]['nome_setor'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button onclick="return ValidarTela(6)" name="btnPesquisar" class="btn btn-success">Procurar</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($eqs)) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Equipamentos alocados</h3>

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
                                                <th>Equipamento</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php for ($i = 0; $i < count($eqs); $i++) { ?>
                                                <tr>
                                                    <td><?= $eqs[$i]['ident_equipamento'] ?>/<?= $eqs[$i]['desc_equipamento'] ?></td>
                                                    <td>
                                                        <?php if ($eqs[$i]['sit_alocar'] != 3) { ?>
                                                            <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $eqs[$i]['id_alocar'] ?>','<?= $eqs[$i]['desc_equipamento'] ?> / <?= $eqs[$i]['ident_equipamento'] ?>')">Excluir</a>
                                                        <?php } else {
                                                            echo '<i>Em manutenção</i>';
                                                        } ?>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <form method="post" action="adm_remover_equipamento.php">
                                    <?php
                                    include_once '../../template/_modal_excluir.php';
                                    ?>
                                </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
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