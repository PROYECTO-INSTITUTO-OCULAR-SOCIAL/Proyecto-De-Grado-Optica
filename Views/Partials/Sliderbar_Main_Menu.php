<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="<?= $baseURL ?>/Views/Components/Img/ojo.jpeg"


             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-2"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Proyecto De Grado Optica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $baseURL ?>/Views/Components/Img/User.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Usuario</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= $baseURL; ?>/Views/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                    </a>
                </li>
                <li class="nav-header">Modulos Principales</li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Municipio
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Municipio/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Municipio/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Categoria
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Categoria/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Categoria/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Marca
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Marca/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Marca/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p>
                            </a>
                        </li>

                    </ul>

                </li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Formula
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                </li><li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Departamento
                            <i class="fas fa-angle-left right"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Departamento/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Departamento/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a></li><li class="nav-item">

                            </a>
                        </li>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Producto
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Persona
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Compra
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Venta
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Detalles de Venta
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Detalles de Compra
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon far fa-user"></i>
                        <p>

                            Abonos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/Create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>

                        </a>
                        </li><li class="nav-item">
                            <a href="<?= $baseURL ?>/Views/Modules/Formula/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>index</p></a>
                        </li>
                    </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>