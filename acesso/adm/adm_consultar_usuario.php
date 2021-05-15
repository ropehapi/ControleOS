<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../CTRL/UtilCTRL.php';
require_once '../../VO/UsuarioVo.php';

$util = new UtilCTRL();

$nomeFiltro = '';

if(isset($_POST['btnFiltrar'])){
    $nomeFiltro = $_POST['nomeFiltro'];
    $ctrl = new UsuarioCTRL;

    $usuarios = $ctrl->FiltrarUsuarioCTRL($nomeFiltro);
}else if(isset($_POST['btnExcluir'])){
    $valores = explode('-',$_POST['cod_item']);
    $cod = $valores[0];
    $tipo = $valores[1];

    $ctrl = new UsuarioCTRL;
    $ret = $ctrl->ExcluirUsuarioCTRL($cod,$tipo);
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
                            <h1>Consultar Usuário</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Consultar Usuário</li>
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
                        <h3 class="card-title">Aqui você consulta seus usuários</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Pesquisar por Nome</label>
                            <form method="POST" action="adm_consultar_usuario.php">
                            <input id="nome" type="text" value="<?= $nomeFiltro ?>" name="nomeFiltro" class="form-control" placeholder="Digite aqui">
                        </div>

                        <button onclick="return ValidarTela(3)" name="btnFiltrar" class="btn btn-success">Buscar</button>

                        <?php if (isset($usuarios)) { ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Usuários cadastrados</h3>
                                    
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
                                                    <th>Nome</th>
                                                    <th>Tipo</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($i=0;$i<count($usuarios);$i++) {?>
                                                <tr>
                                                    <td><?= $usuarios[$i]['nome_usuario'] ?></td>
                                                    <td><?= $util::MostrarTipoUser($usuarios[$i]['tipo_usuario'])?></td>
                                                    <td>
                                                        <a href="adm_usuario_alterar.php?cod=<?= $usuarios[$i]['id_usuario'] ?>" class="btn btn-warning btn-xs">Alterar</a>
                                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $usuarios[$i]['id_usuario'] . '-' . $usuarios[$i]['tipo_usuario'] ?>','<?= $usuarios[$i]['nome_usuario'] ?>')">Excluir</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form method="post" action="adm_consultar_usuario.php">
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
                    <?php } ?>

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