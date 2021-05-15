<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../CTRL/SetorCTRL.php';
require_once '../../VO/UsuarioVo.php';
require_once '../../VO/TecnicoVo.php';
require_once '../../VO/FuncionarioVo.php';

//Testa a URL: se tem a chave e o valor é numérico
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $ctrl = new UsuarioCTRL;
    $dados = $ctrl->DetalharUsuario($_GET['cod']);

    if (count($dados) == 0) {
        header('location: adm_consultar_usuario.php');
        exit;
    } else {
        if ($dados[0]['tipo_usuario'] == 2) {
            $setorCTRL = new SetorCTRL;
            $setores = $setorCTRL->ConsultarSetorCTRL();
        }
    }
} else if (isset($_POST['btnGravar'])) {

    $ctrl = new UsuarioCTRL;
    $tipo = $_POST['tipo'];

    switch ($tipo) {
        case '1':
            $vo = new UsuarioVO;

            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $ret = $ctrl->AlterarUserADM($vo);

            break;

        case '2':
            $vo = new FuncionarioVo;

            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $vo->setEnderecoFunc($_POST['endereco']);
            $vo->setTelFunc($_POST['telefone']);
            $vo->setEmailFunc($_POST['email']);
            $vo->setIdSetor($_POST['setor']);

            $ret = $ctrl->AlterarUserFun($vo);
            break;

        case '3':
            $vo = new TecnicoVO;

            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $vo->setEnderecoTec($_POST['endereco']);
            $vo->setTelTec($_POST['telefone']);
            $vo->setEmailTec($_POST['email']);

            $ret = $ctrl->AlterarUserTec($vo);

            break;
    }
    header('location: adm_consultar_usuario.php?ret=' . $ret);
} else {
    header('location: adm_consultar_usuario.php');
    exit;
}


$setorCTRL = new SetorCTRL;
$setores = $setorCTRL->ConsultarSetorCTRL();


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
                            <h1>Novo Usuario</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Novo usuario</li>
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
                        <h3 class="card-title">Aqui você insere um novo usuário</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="adm_usuario_alterar.php">
                            <input type="hidden" name="tipo" id="tipo" value="<?= $dados[0]['tipo_usuario'] ?>">
                            <input type="hidden" name="cod" id="cod" value="<?= $dados[0]['id_usuario'] ?>">


                            <div class="form-group">
                                <label>Nome</label>
                                <input value="<?= $dados[0]['nome_usuario'] ?>" id="nome" name="nome" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>CPF</label>
                                <input value="<?= $dados[0]['cpf_usuario'] ?>" id="cpf" name="cpf" onchange="ValidarCpfCadastro(this.value)" type="text" class="form-control" placeholder="Digite aqui">
                                <label id="val_cpf" style="color:red; display:none"></label>
                            </div>

                            <?php if ($dados[0]['tipo_usuario'] == 2) { ?>

                                <div class="form-group">
                                    <label>Setor</label>
                                    <select id="setor" name="setor" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecione</option>
                                        <?php for ($i = 0; $i < count($setores); $i++) { ?>
                                            <option value="<?= $setores[$i]['id_setor'] ?>" <?= $item['id_setor'] == $dados[0]['id_setor'] ? 'selected' : '' ?>><?= $setores[$i]['nome_setor'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            <?php } ?>

                            <?php if ($dados[0]['tipo_usuario'] == 2 || $dados[0]['tipo_usuario'] == 3) { ?>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['email_func'] : $dados[0]['email_tec'] ?>" name="email" onchange="ValidarEmailCadastro(this.value)" type="text" class="form-control" placeholder="Digite aqui">
                                    <label id="val_email" style="color: red; display: none;"></label>
                                </div>

                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input id="telefone" value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['tel_func'] : $dados[0]['tel_tec'] ?>" name="telefone" type="text" class="form-control" placeholder="Digite aqui">
                                </div>

                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input id="endereco" value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['endereco_func'] : $dados[0]['endereco_tec'] ?>" name="endereco" type="text" class="form-control" placeholder="Digite aqui">
                                </div>
                            <?php } ?>
                            <button id="btnGravar" name="btnGravar" class="btn btn-success">Gravar</button>

                        </form>
                    </div>

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