<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">

        <img src="<?= $baseURL ?>/views/components/img/icono.jpg"
             master
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Proyecto-De-Grado-Optica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="<?= $baseURL ?>/views/components/img/goku.jpg" class="img-circle elevation-2" alt="User Image">
                <hr>
                <img src="<?= $baseURL ?>/views/components/img/goku.jpg" class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info">
                <a href="#" class="d-block">Hamilton Fonseca</a>

              master
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= $baseURL; ?>/views/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                    </a>
                </li>

                <li class="nav-header">Modulos Principales</li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Categoria

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>


                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Marca

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>





                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/Modules/Marca/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/Modules/Marca/Edit.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editar</p>
                            </a>
                        </li>
                       <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Marca/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Marca/create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show</p>
                            </a>
                        </li>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
