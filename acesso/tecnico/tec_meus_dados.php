<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../VO/TecnicoVo.php';

$ctrl = new UsuarioCTRL;

if (isset($_POST['btnGravar'])) {
    $vo = new TecnicoVO;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $vo->setNome($nome);
    $vo->setEmailTec($email);
    $vo->setTelTec($telefone);
    $vo->setEnderecoTec($endereco);

    $ret = $ctrl->AlterarUserTec($vo);
}

$dados = $ctrl->DetalharUsuario('');

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
                            <h1>Atualize suas informações</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Meus dados</li>
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
                        <h3 class="card-title">Mantenha seus dados atualizados aqui</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tec_meus_dados.php">
                            <div class="form-group">
                                <label>Nome</label>
                                <input id="nome" value="<?= $dados[0]['nome_usuario'] ?>" name="nome" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" value="<?= $dados[0]['email_tec'] ?>" name="email" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Telefone</label>
                                <input id="telefone" value="<?= $dados[0]['tel_tec'] ?>" name="telefone" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Endereço</label>
                                <input id="endereco" value="<?= $dados[0]['endereco_tec'] ?>" name="endereco" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <button name="btnGravar" onclick="return ValidarTela(17)" class="btn btn-success">Gravar</button>
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