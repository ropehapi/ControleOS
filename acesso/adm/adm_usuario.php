<?php

require_once '../../CTRL/UsuarioCTRL.php';
require_once '../../CTRL/SetorCTRL.php';
require_once '../../VO/UsuarioVo.php';
require_once '../../VO/TecnicoVo.php';
require_once '../../VO/FuncionarioVo.php';

if (isset($_POST['btnGravar'])) {

    $ctrl = new UsuarioCTRL;
    $tipo = $_POST['tipo'];

    switch ($tipo) {
        case '1':
            $vo = new UsuarioVO;

            $vo->setTipo($tipo);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $ret = $ctrl->InserirUserAdm($vo);

            break;

        case '2':
            $vo = new TecnicoVO;

            $vo->setTipo($tipo);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $vo->setEnderecoTec($_POST['endereco']);
            $vo->setTelTec($_POST['telefone']);
            $vo->setEmailTec($_POST['email']);

            $ret = $ctrl->InserirUserTecnico($vo);

            break;

        case '3':
            $vo = new FuncionarioVo;

            $vo->setTipo($tipo);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);

            $vo->setEnderecoFunc($_POST['endereco']);
            $vo->setTelFunc($_POST['telefone']);
            $vo->setEmailFunc($_POST['email']);
            $vo->setIdSetor($_POST['setor']);

            $ret = $ctrl->InserirUserFuncionario($vo);
            break;
    }
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
                        <form method="POST" action="adm_usuario.php">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select id="tipo" name="tipo" class="form-control select2" style="width: 100%;" onchange="MostrarTipoUsuario(this.value)">
                                    <option value="" >Selecione</option>
                                    <option value="1" >Administrador</option>
                                    <option value="2" >Funcionário</option>
                                    <option value="3" >Técnico</option>
                                </select>
                            </div>
                            <div id="divTipo123" style="display: none;">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite aqui">
                                </div>

                                <div class="form-group">
                                    <label>CPF</label>
                                    <input id="cpf" name="cpf" onchange="ValidarCpfCadastro(this.value)" type="text" class="form-control" placeholder="Digite aqui">
                                    <label id="val_cpf" style="color:red; display:none"></label>
                                </div>
                            </div>
                            <div id="divTipo2" style="display: none;">
                                <div class="form-group">
                                    <label>Setor</label>
                                    <select id="setor" name="setor" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecione</option>
                                        <?php for($i=0;$i<count($setores);$i++){?>
                                            <option value="<?=$setores[$i]['id_setor'] ?>" selected="selected"><?=$setores[$i]['nome_setor'] ?></option>
                                            <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div id="divTipo23" style="display: none;">
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Telefone</label>
                                <input id="telefone" name="telefone" type="text" class="form-control" placeholder="Digite aqui">
                            </div>

                            <div class="form-group">
                                <label>Endereço</label>
                                <input id="endereco" name="endereco" type="text" class="form-control" placeholder="Digite aqui">
                            </div>
                            </div>

                            <button onclick="return ValidarTela(18)" id="btnGravar" style="display: none;" name="btnGravar" class="btn btn-success">Gravar</button>
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