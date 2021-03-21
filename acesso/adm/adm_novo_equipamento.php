<?php

require_once '../../CTRL/EquipamentoCTRL.php';
require_once '../../VO/EquipamentoVo.php';
require_once '../../CTRL/TipoCTRL.php';
require_once '../../CTRL/ModeloCTRL.php';

$TipoCTRL = new TipoCTRL;
$ModeloCTRL = new ModeloCTRL;

if(isset($_POST['btnGravar'])){
    $vo = new EquipamentoVo;
    $ctrl = new EquipamentoCTRL;

    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];
    $ident = $_POST['ident'];
    $desc = $_POST['desc'];

    $vo->setIdTipo($tipo);
    $vo->setIdModelo($modelo);
    $vo->setIdentEquipamento($ident);
    $vo->setDescEquipamento($desc);

    $ret = $ctrl->InserirEquipamentoCTRL($vo);
}

$tipos = $TipoCTRL->ConsultarTipoCTRL();
$modelos = $ModeloCTRL->ConsultarModeloCTRL();
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
                            <h1>Novo equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Equipamento</li>
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
                        <h3 class="card-title">Cadastre seu equipamento aqui</h3>
                    </div>
                    <div class="card-body">


                    <form method="POST" action="adm_novo_equipamento.php">
                        <div class="form-group">
                            <label>Tipo do equipamento</label>
                            <select id="tipo" name="tipo" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Selecione</option>
                            <?php for($i=0;$i<count($tipos);$i++){ ?> 
                            <option value="<?= $tipos[$i]['id_tipo']?>"><?= $tipos[$i]['nome_tipo']?></option> 
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Modelo</label>
                            <select id="modelo" name="modelo"  class="form-control select2" style="width: 100%;">
                                <option selected="selected">Selecione</option>
                                <?php for($i=0;$i<count($modelos);$i++){ ?> 
                            <option value="<?= $modelos[$i]['id_modelo']?>"><?= $modelos[$i]['nome_modelo']?></option> 
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Identificação</label>
                            <input id="ident" type="text" name="ident" class="form-control" placeholder="Digite aqui">
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea id="desc" name="desc" type="text" class="form-control" placeholder="Digite aqui"></textarea>
                        </div>

                        <button onclick="return ValidarTela(5)" name="btnGravar" class="btn btn-success">Gravar</button>
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