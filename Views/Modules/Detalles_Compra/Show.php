<?php
require_once("../../Partials/Routes.php");
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../../app/Controllers/CompraController.php");
require_once("../../../app/Controllers/Detalles_CompraController.php");



use App\Controllers\Detalles_CompraController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos del Detalle de Compra</title>
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
                        <h1>Informacion del  Detalle de Compra</h1>
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
                        Error al consultar el Detalle de Compra: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idDetalles_Compra'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idDetalles_Compra"]) && isset($_GET["idDetalles_Compra"])){
                $DataDetalles_Compra = Detalles_CompraController::searchForID($_GET["idDetalles_Compra"]);
                if(!empty($DataDetalles_Compra)){
                ?>
            </div>
            <div class="card-header">
                <hr>
                <strong><i class="fas fa-user mr-1"></i> Cantidad</strong>
                <p class="text-muted"><?= $DataDetalles_Compra->getCantidad() ?></p>
                <hr>
                <strong><i class="fas fa-user mr-1"></i> Precio</strong>
                <p class="text-muted"><?= $DataDetalles_Compra->getPrecio() ?></p>
                <hr>
                <strong><i class="fas fa-user mr-1"></i> Compra</strong>
                <p class="text-muted"><?= $DataDetalles_Compra->getCompra()->getNombre() ?></p>
                <hr>
                <strong><i class="fas fa-user mr-1"></i> Producto</strong>
                <p class="text-muted"><?= $DataDetalles_Compra->getProducto()->getnombre() ?></p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                            <i class="fas fa-tasks"></i> Gestionar Detalle de Compra
                        </a>
                    </div>
                    <div class="col-auto">
                        <a role="button" href="Create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-plus"></i> Crear Detalle de Compra
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