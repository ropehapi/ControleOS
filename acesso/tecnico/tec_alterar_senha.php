<?php

require_once '../../VO/UsuarioVo.php';
require_once '../../CTRL/UsuarioCTRL.php';

if (isset($_POST['btnGravar'])) {
    $vo = new UsuarioVO;
    $ctrl = new UsuarioCTRL;

    $senha = $_POST['senha'];
    $novaSenha = $_POST['novaSenha'];
    $rNovaSenha = $_POST['rNovaSenha'];

    $vo->setSenha($senha);
    $vo->setNovaSenha($novaSenha);
    $vo->setrNovaSenha($rNovaSenha);

    $ret = $ctrl->AlterarSenha($vo);
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
                            <h1>Modifique sua senha</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Mudar Senha</li>
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
                        <h3 class="card-title">Sempre opte por senhas com mais de 6 caracteres</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tec_alterar_senha.php">
                            <div class="form-group">
                                <label>Digite a senha atual</label>
                                <input id="senha" name="senha" type="password" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Digite uma nova senha</label>
                                <input id="novaSenha" name="novaSenha" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Repita a nova senha</label>
                                <input id="rNovaSenha" name="rNovaSenha" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <button onclick="return ValidarTela(14)" name="btnGravar" class="btn btn-success">Gravar</button>
                            </form>
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
        include_once '../../template/_msg.php'
        ?>
    </div>
    <!-- ./wrapper -->


</body>

</html>