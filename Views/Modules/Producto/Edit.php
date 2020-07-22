<?php
require_once("../../../app/Controllers/MarcaController.php");
require_once("../../../app/Controllers/CategoriaController.php");
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../partials/routes.php");

use App\Controllers\ProductoController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Producto</title>
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
                        <h1>Editar Un Nueva Producto</h1>
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
                        <form class="form-horizontal" method="post" id="frmEditProducto" name="frmEditProducto" action="../../../app/Controllers/ProductoController.php?action=edit">
                            <input id="id_producto" name="id_producto" value="<?php echo $DataProducto->getIdProducto(); ?>" hidden
                                   required="required" type="text">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" minlength="6" class="form-control"
                                               id="nombre" name="nombre"
                                               value="<?= $DataProducto->getNombre(); ?>"
                                               placeholder="Ingrese su Nombre">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" minlength="6" class="form-control"
                                               id="descripcion" name="descripcion"
                                               value="<?= $DataProducto->getDescripcion(); ?>"
                                               placeholder="Ingrese su Descripcion">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="iva" class="col-sm-2 col-form-label">Iva</label>
                                    <div class="col-sm-10">
                                        <input required type="number" class="form-control" id="iva"
                                               name="iva" value="<?= $DataProducto->getIva(); ?>"
                                               placeholder="Ingrese sus Iva">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="stock"
                                               name="stock" value="<?= $DataProducto->getStock(); ?>"
                                               placeholder="Ingrese sus Stock">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
                                    <div class="col-sm-8">
                                        <?= \App\Controllers\CategoriaController::selectCategoria(false,
                                            true,
                                            'categoria',
                                            'categoria',
                                            (!empty($DataProducto)) ? $DataProducto->getCategoria()->getIdCategoria() : '',
                                            'form-control select2bs4 select2-info',
                                            "estado = 'Activo'")
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                                    <div class="col-sm-8">
                                        <?= \App\Controllers\MarcaController::selectMarca(false,
                                            true,
                                            'marca',
                                            'marca',
                                            (!empty($DataProducto)) ? $DataProducto->getMarca()->getid_marca() : '',
                                            'form-control select2bs4 select2-info',
                                            "estado = 'Activo'")
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="estado" name="estado" class="custom-select">
                                            <option <?= ($DataProducto->getEstado() == "activo") ? "selected" : ""; ?>
                                                    value="activo">activo
                                            </option>
                                            <option <?= ($DataProducto->getEstado() == "inactivo") ? "selected" : ""; ?>
                                                    value="inactivo">inactivo
                                            </option>
                                        </select>
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