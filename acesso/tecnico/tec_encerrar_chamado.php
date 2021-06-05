<?php

require_once '../../CTRL/ChamadoCTRL.php';
require_once '../../VO/ChamadoVo.php';

if(isset($_POST['btnGravar'])){
    $vo = new ChamadoVo;
    $ctrl = new ChamadoCTRL;

    $data = $_POST['data'];
    $setor = $_POST['setor'];
    $funcionario = $_POST['funcionario'];
    $equipamento = $_POST['equip'];
    $laudo = $_POST['laudo'];

    $vo->setDataEncerramento($data);
    $vo->setIdSetor($setor);
    $vo->setIdUsuarioFunc($funcionario);
    $vo->setIdEquip($equipamento);
    $vo->setLaudoChamado($laudo);

    $ret = $ctrl->EncerrarChamado($vo);
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
                    <form method="POST" action="tec_encerrar_chamado.php">
                        <div class="form-group">
                            <label>Data</label>
                            <input id="data" name="data" type="text" class="form-control" placeholder="Digite aqui">
                        </div>

                        <div class="form-group">
                            <label>Setor</label>
                            <input id="setor" name="setor" type="text" class="form-control" placeholder="Digite aqui">
                        </div> 

                        <div class="form-group">
                            <label>Funcionário</label>
                            <input id="funcionario"  name="funcionario" type="text" class="form-control" placeholder="Digite aqui">
                        </div>

                        <div class="form-group">
                            <label>Equipamento</label>
                            <input name="equip" id="equipamento" type="text" class="form-control" placeholder="Digite aqui">
                        </div>

                        <div class="form-group">
                            <label>Laudo</label>
                            <textarea name="laudo" type="text" id="laudo" class="form-control" placeholder="Digite aqui"></textarea>
                        </div>

                        <button name="btnGravar" class="btn btn-success" onclick="return ValidarTela(16)">Gravar</button>
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