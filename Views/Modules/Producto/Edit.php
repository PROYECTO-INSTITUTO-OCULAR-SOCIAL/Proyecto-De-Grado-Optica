<?php
require("../../partials/routes.php");
require("../../../app/Controllers/ProductoController.php");

use App\Controllers\ProductoController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Producto</title>
    <?php require("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Nuevo Producto</h1>
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
                        Error al crear el Producto: <?= ($_GET['mensaje']) ?? "" ?>
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
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idProducto"]) && isset($_GET["idProducto"])){ ?>
                    <p>
                    <?php
                    $DataProducto = ProductoController::searchForID($_GET["idProducto"]);
                    if(!empty($DataProducto)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditProducto" name="frmEditProducto" action="../../../app/Controllers/ProductosController.php?action=edit">
                            <input id="id_producto" name="id_producto" value="<?php echo $DataProducto->getIdProducto(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nombre" name="nombres" value="<?= $DataProducto->getNombre(); ?>" placeholder="Ingrese el nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $DataProducto->getDescripcion(); ?>" placeholder="Ingrese la descripcion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="iva" class="col-sm-2 col-form-label">Iva</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="iva" name="iva" value="<?= $DataProducto->getIva(); ?>" placeholder="Ingrese el iva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control" id="stock" name="stock" value="<?= $DataProducto->getStock(); ?>" placeholder="Ingrese el stock">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="estado" name="estado" class="custom-select">
                                            <option <?= ($DataProducto->getEstado() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataProducto->getEstado() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
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

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>
