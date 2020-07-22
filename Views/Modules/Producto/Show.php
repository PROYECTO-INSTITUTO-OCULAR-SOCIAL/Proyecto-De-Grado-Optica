<?php
require_once("../../Partials/Routes.php");
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../../app/Controllers/CategoriaController.php");
require_once("../../../app/Controllers/MarcaController.php");



use App\Controllers\ProductoController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos del Producto</title>
    <?php require_once("../../Partials/Head_Imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require_once("../../Partials/Navbar_Customization.php"); ?>

    <?php require_once("../../Partials/Sliderbar_Main_Menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion del Producto</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">Proyecto-De-Grado-Optica</a></li>
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if(!empty($_GET['respuesta'])){ ?>
                <?php if ($_GET['respuesta'] == "error"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al consultar el Producto: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idProducto'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idProducto"]) && isset($_GET["idProducto"])){
                    $DataProducto = ProductoController::searchForID($_GET["idProducto"]);
                    if(!empty($dataProducto)){
                        ?>
                        <div class="card-header">
                            <p class="card-title"><?= $DataProducto->getIdProducto() ?></p>
                        </div>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Nombre</strong>
                        <p class="text-muted"><?= $DataProducto->getNombre() ?></p>
                        <hr>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Descripcion</strong>
                        <p class="text-muted"><?= $DataProducto->getDescripcion() ?></p>
                        <hr>
                        <strong><i class="far fa-user mr-1"></i> Iva</strong>
                        <p class="text-muted"><?= $DataProducto->getIva() ?></p>
                        <hr>
                        <strong><i class="far fa-user mr-1"></i> Stock</strong>
                        <p class="text-muted"><?= $DataProducto->getStock() ?></p>
                        <hr>
                        <strong><i class="far fa-user mr-1"></i> Categoria</strong>
                        <p class="text-muted"><?= $DataProducto->getCategoria()->getNombre() ?></p>
                        <hr>
                        <strong><i class="far fa-user mr-1"></i> Marca</strong>
                        <p class="text-muted"><?= $DataProducto->getMarca()->getnombre() ?></p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Estado</strong>
                        <p class="text-muted"><?= $DataProducto->getEstado() ?></p>
                        </p>
                        <hr>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Gestionar Producto
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="Create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Producto
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('../../Partials/Footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../Partials/Scripts.php');?>
</body>
</html>