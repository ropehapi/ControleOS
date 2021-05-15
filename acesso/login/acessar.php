
<!DOCTYPE html>
<html>
<?php include_once '../../template/_head.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b>Controle</b>OS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça login para iniciar a sua sessão</p>

      <form action="../../template/index3.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="cpf" id="cpf" placeholder="CPF">
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
            <button onclick="return ValidarTela(19)" class="btn btn-primary btn-block">Entrar</button>
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
