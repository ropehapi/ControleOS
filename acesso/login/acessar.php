<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/CTRL/UsuarioCTRL.php';

  if(isset($_POST['btnAcessar'])){

    $ctrl = new UsuarioCTRL;
    $ret = $ctrl->ValidarLogin($_POST['cpf'],$_POST['pass']);

  }
  
?>
<!DOCTYPE html>
<html>
<?php
 include_once '../../template/_head.php';
  include_once '../../template/_msg.php';
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b>Controle</b>OS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça login para iniciar a sua sessão</p>

      <form action="acessar.php" method="post">

        <div class="input-group mb-3">
          <input class="form-control" name="cpf" id="cpf" placeholder="CPF">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Digite sua senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button name="btnAcessar" onclick="return ValidarTela(19)" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once '../../template/_scripts.php'; ?>

</body>
</html>
