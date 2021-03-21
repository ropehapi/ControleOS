<?php

require_once '../../VO/ChamadoVo.php';
require_once '../../CTRL/ChamadoCTRL.php';

if(isset($_POST['btnPesquisar'])){
    $vo =new ChamadoVo;
    $ctrl = new ChamadoCTRL;

    $sitChamado = $_POST['sitChamado'];

    $vo->setSitChamado($sitChamado);
    $ret = $ctrl->BuscarChamadosTec($vo);
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
                            <h1>Filtre seus chamados</h1>
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
                                    <option value="" selected="selected">Selecione</option>
                                    <option selected="selected">Todos</option>
                                </select>
                            </div>

                            <button onclick="return ValidarTela(15)" name="btnPesquisar" class="btn btn-success">Pesquisar</button>
                        </form>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Data da abertura</th>
                                    <th>Funcionário</th>
                                    <th>Equipamento</th>
                                    <th>Problema</th>
                                    <th>Data atendimento</th>
                                    <th>Tecnico</th>
                                    <th>Data encerramento</th>
                                    <th>Laudo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>(Data da abertura)</td>
                                    <td>(Funcionário)</td>
                                    <td>(Equipamento)</td>
                                    <td>(Problema)</td>
                                    <td>(Data atendimento)</td>
                                    <td>(Técnico)</td>
                                    <td>(Data encerramento)</td>
                                    <td>(Laudo)</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-xs">Alterar</a>
                                        <a href="#" class="btn btn-danger btn-xs">Excluir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div>
                    <div class="form-group">


                    </div>
                    <div class="form-group">
                        < </div>
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