<?php
require_once '../../VO/ChamadoVo.php';
require_once '../../CTRL/ChamadoCTRL.php';

if(isset($_POST['btnPesquisar'])){
    $vo = new ChamadoVo;
    $ctrl = new ChamadoCTRL;

    $sitChamado = $_POST['sitChamado'];

    $vo->setSitChamado($sitChamado);
    $ret = $ctrl->BuscarChamadosFunc($vo);
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
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Meus chamados</li>
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
                                    <option value="" selected="selected">Todos</option>
                                </select>
                            </div>

                            <button name="btnPesquisar" onclick="return ValidarTela(11)" class="btn btn-warning">Pesquisar</button>
                        </form>
                    </div>


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
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
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