<?php
require_once("../../../app/Controllers/CompraController.php");
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../../app/Controllers/Detalles_CompraController.php");
require_once("../../partials/routes.php");

use App\Controllers\Detalles_CompraController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Detalles de Compra</title>
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
                        <h1>Editar Un Nuevo Detalle de Compra </h1>
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
                        Error al crear Producto: <?= ($_GET['mensaje']) ?? "" ?>
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
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idDetalles_Compra"]) && isset($_GET["idDetalles_Compra"])){ ?>
                    <p>
                    <?php
                    $DataDetalles_Compra = Detalles_CompraController::searchForID($_GET["idDetalles_Compra"]);
                    if(!empty($DataDetalles_Compra)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditDetalles_Compra" name="frmEditDetalles_Compra" action="../../../app/Controllers/Detalles_CompraController.php?action=edit">
                            <input id="id_detalles_compra" name="id_detalles_compra" value="<?php echo $DataDetalles_Compra->getIdDetallesCompra(); ?>" hidden
                                   required="required" type="text">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control"
                                               id="cantidad" name="cantidad"
                                               value="<?= $DataDetalles_Compra->getCantidad(); ?>"
                                               placeholder="Ingrese su Cantidad">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control"
                                               id="precio" name="precio"
                                               value="<?= $DataDetalles_Compra->getPrecio(); ?>"
                                               placeholder="Ingrese su precio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="compra" class="col-sm-2 col-form-label">Compra</label>
                                    <div class="col-sm-8">
                                        <?= \App\Controllers\compraController::selectcompra(false,
                                            true,
                                            'compra',
                                            'compra',
                                            (!empty($DataDetalles_Compra)) ? $DataDetalles_Compra->getCompra()->getid_compra() : '',
                                            'form-control select2bs4 select2-info')
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="producto" class="col-sm-2 col-form-label">Producto</label>
                                    <div class="col-sm-8">
                                        <?= \App\Controllers\ProductoController::selectProducto(false,
                                            true,
                                            'producto',
                                            'producto',
                                            (!empty($DataDetalles_Compra)) ? $DataDetalles_Compra->getProducto()->getIdProducto() : '',
                                            'form-control select2bs4 select2-info')
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Enviar</button>
                                <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php } ?>
                    </p>
                <?php } ?>
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