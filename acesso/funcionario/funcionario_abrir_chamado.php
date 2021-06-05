<?php

require_once '../../VO/ChamadoVo.php';
require_once '../../CTRL/ChamadoCTRL.php';

if(isset($_POST['btnGravar'])){
    $vo = new ChamadoVo;
    $ctrl = new ChamadoCTRL;

    $idEquip = $_POST['idEquip'];
    $descProblema = $_POST['descProblema'];

    $vo->setIdEquip($idEquip);
    $vo->setDescProblema($descProblema);

    $ret = $ctrl->AbrirChamado($vo);
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
                            <h1>Realize a abertura de chamado aqui</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Abrir chamado</li>
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
                        <h3 class="card-title">Escreva de forma clara o problema do equipamento</h3>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="funcionario_abrir_chamado.php">
                        <div class="form-group">
                            <label>Escolha o equipamento</label>
                            <select id="equip" name="idEquip" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Selecione</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Escreva o problema apresentado</label>
                            <textarea id="descProblema" name="descProblema" type="text" class="form-control" placeholder="Digite aqui"></textarea>
                        </div>

                        <button name="btnGravar" onclick="return ValidarTela(13)" class="btn btn-success">Gravar</button>
                        </form>
                    </div>

                </div>
                <div>
                    <div class="form-group">


                    </div>
                    <div class="form-group">
                        < </div> <hr>

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