<?php

require_once '../../CTRL/ModeloCTRL.php';
require_once '../../VO/ModeloVo.php';

$ctrl = new ModeloCTRL;

if(isset($_POST['btnGravar'])){
    $vo = new ModeloVo;

    $nome  = $_POST['nome'];

    $vo->setNomeModelo($nome);
    $ret = $ctrl->InserirModeloCTRL($vo);
}else if(isset($_POST['btnExcluir'])){
    $cod = $_POST['cod_item'];
    $ret = $ctrl->ExcluirModeloCTRL($cod);
}else if(isset($_POST['btnAlterar'])){
    $vo = new ModeloVo;
    $ctrl = new ModeloCTRL;

    $vo->setNomeModelo($_POST['nome_alt']);
    $vo->setIdModelo($_POST['cod_alt']);

    $ret = $ctrl->AlterarModeloCTRL($vo);
}
$modelos = $ctrl->ConsultarModeloCTRL();

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
                            <h1>Modelo de equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Modelo do equipamento</li>
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
                        <h3 class="card-title">Gerencie todos os modelos dos seus equipamentos aqui</h3>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="adm_modeloequip.php">
                        <div class="form-group">
                            <label>Nome do modelo</label>
                            <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite aqui">
                        </div>

                        <button onclick="return ValidarTela(4)" name="btnGravar" class="btn btn-success">Gravar</button>
                        <p></p>
                        </form> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Modelos cadastrados</h3>
                                    
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <buttontype="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome do Modelo</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($i=0;$i<count($modelos);$i++){?>
                                                <tr>
                                                    <td><?= $modelos[$i]['nome_modelo'] ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarDadosAlterar('<?=$modelos[$i]['id_modelo'] ?>','<?=$modelos[$i]['nome_modelo'] ?>')">Alterar</a>
                                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?=$modelos[$i]['id_modelo'] ?>','<?=$modelos[$i]['nome_modelo'] ?>')">Excluir</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form method="post" action="adm_modeloequip.php">
                                            <?php
                                            include_once '../../template/_modal_excluir.php';
                                            ?>
                                        </form>

                                        <form method="post" action="adm_modeloequip.php">
                                            <?php
                                            include_once '../adm/modal/_alterar_modelo.php';
                                            ?>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
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
        include_once '../../template/_msg.php'
        ?>
    </div>
    <!-- ./wrapper -->


</body>

</html>