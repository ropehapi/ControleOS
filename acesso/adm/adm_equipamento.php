<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../VO/EquipamentoVo.php';
require_once '../../CTRL/TipoCTRL.php';
require_once '../../CTRL/ModeloCTRL.php';

$TipoCTRL = new TipoCTRL;
$ModeloCTRL = new ModeloCTRL;
$cod = '';
$tipo = '';
$modelo = '';

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $ctrl = new EquipamentoCTRL;
    $cod = $_GET['cod'];
    $dados = $ctrl->DetalharEquipamento($cod);

    //Tratamento caso o TROUXA tente inserir um cod pela url
    if (count($dados) == 0) {
        header('location: adm_consultar_equipamento.php');
        exit;
    } else {
        $tipo = $dados[0]['id_tipo'];
        $modelo = $dados[0]['id_modelo'];
    }
}


if (isset($_POST['btnGravar'])) {
    $vo = new EquipamentoVo;
    $ctrl = new EquipamentoCTRL;

    $cod = $_POST['cod'];

    $vo->setIdEquipamento($cod);
    $vo->setIdTipo($_POST['tipo']);
    $vo->setIdModelo($_POST['modelo']);
    $vo->setIdentEquipamento($_POST['ident']);
    $vo->setDescEquipamento($_POST['desc']);

    if ($cod == '') {
        $ret = $ctrl->InserirEquipamentoCTRL($vo);
    } else {
        $ret = $ctrl->AlterarEquipamentoCTRL($vo);
        header('location: adm_equipamento.php?cod =' . $cod . '&ret=' . $ret);
    }
}

$tipos = $TipoCTRL->ConsultarTipoCTRL();
$modelos = $ModeloCTRL->ConsultarModeloCTRL();
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
                            <h1><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?> Equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Equipamento</li>
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
                        <h3 class="card-title"><?= $cod == '' ? 'Cadastre' : 'Altere' ?> seu equipamento aqui</h3>
                    </div>
                    <div class="card-body">


                        <form method="POST" action="adm_equipamento.php">
                            <input type="hidden" name="cod" value="<?= $cod ?>">
                            <div class="form-group">
                                <label>Tipo do equipamento</label>
                                <select id="tipo" name="tipo" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Selecione</option>
                                    <?php for ($i = 0; $i < count($tipos); $i++) { ?>
                                        <option value="<?= $tipos[$i]['id_tipo'] ?>" <?= $tipos[$i]['id_tipo'] == $tipo ? 'selected' : '' ?>><?= $tipos[$i]['nome_tipo'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Modelo</label>
                                <select id="modelo" name="modelo" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Selecione</option>
                                    <?php for ($i = 0; $i < count($modelos); $i++) { ?>
                                        <option value="<?= $modelos[$i]['id_modelo'] ?>" <?= $modelos[$i]['id_modelo'] == $modelo ? 'selected' : '' ?>><?= $modelos[$i]['nome_modelo'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Identificação</label>
                                <input id="ident" type="text" name="ident" class="form-control" placeholder="Digite aqui" value="<?= isset($dados) ? $dados[0]['ident_equipamento'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea id="desc" name="desc" type="text" class="form-control" placeholder="Digite aqui"><?= isset($dados) ? $dados[0]['desc_equipamento'] : '' ?></textarea>
                            </div>

                            <button onclick="return ValidarTela(5)" name="btnGravar" class="btn btn-success"><?= $cod == '' ? 'Cadastrar' : 'Alterar' ?></button>
                        </form>
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