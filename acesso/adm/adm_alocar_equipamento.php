<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../CTRL/SetorCTRL.php';
require_once '../../VO/AlocarVo.php';

$SetorCtrl = new SetorCTRL;
$ctrl = new EquipamentoCTRL;


if(isset($_POST['btnGravar'])){
    $vo = new AlocarVo;

     $vo->setIdEquipamento($_POST['equipamento']);
     $vo->setIdSetor($_POST['setor']);
     
     $ret = $ctrl->AlocarEquipamentoCTRL($vo);

}


$setores = $SetorCtrl->ConsultarSetorCTRL();
$equipamentosNaoAlocados = $ctrl->ConsultarEquipamentoNaoAlocadoCTRL();

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
                            <h1>Alocar equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Alocar Equipamento</li>
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
                        <h3 class="card-title">Aqui você aloca um equipamento a um setor específico</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="adm_alocar_equipamento.php">
                            <div class="form-group">
                                <label>Setor</label>
                                <select id="setor" name="setor" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">Selecione</option>
                                    <?php foreach ($setores as $item) { ?>
                                        <option value="<?= $item['id_setor'] ?>"><?= $item['nome_setor'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>equipamento</label>
                                <select id="equip" name="equipamento" class="form-control select2" style="width: 100%;">
                                    <option value="" selected="selected">Selecione</option>
                                    <?php foreach ($equipamentosNaoAlocados as $item) { ?>
                                        <option value="<?= $item['id_equipamento'] ?>"><?= $item['ident_equipamento'] ?> / <?= $item['desc_equipamento'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button name="btnGravar" class="btn btn-success" onclick="return ValidarTela(1)">Gravar</button>
                        </form>
                    </div>

                </div>
                <div>
                    <div class="form-group">


                    </div>
                    <div class="form-group">
                    </div>
                    <hr>

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