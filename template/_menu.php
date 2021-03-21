<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">Administrador</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <!-- Menu Options -->
        <li class="nav-item">
          <a href="adm_setor.php" class="nav-link">
            <i class="nav-icon far fa-edit"></i>
            <p>
              Gerenciar Setor
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="adm_tipoequip.php" class="nav-link">
            <i class="nav-icon far fa-edit"></i>
            <p>
              Gerenciar Tipo
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="adm_modeloequip.php" class="nav-link">
            <i class="nav-icon far fa-edit"></i>
            <p>
              Gerenciar Modelo
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-archive"></i>
            <p>
               Equipamento
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="adm_equipamento.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Novo equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_alocar_equipamento.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Alocar equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_consultar_equipamento.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Consultar equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_remover_equipamento.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Remover equipamento</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>
              Usuário
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="adm_usuario.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Novo Usuário</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="adm_consultar_usuario.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Consultar Usuário</p>
              </a>
            </li>
          </ul>
        </li>





        <!-- End of menu options -->



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>