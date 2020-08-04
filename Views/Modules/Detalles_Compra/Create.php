<?php
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../../app/Controllers/CompraController.php");
require_once("../../../app/Controllers/ProductoController.php");
require_once("../../partials/routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Detalles de Compra</title>
    <?php require("../../partials/head_imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php if (!empty($_GET['respuesta'])) { ?>
            <?php if ($_GET['respuesta'] != "correcto") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Error al crear la venta: <?= $_GET['mensaje'] ?>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear un Nuevo Detalle de Compra</h1>
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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Horizontal Form</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" id="frmCreateProducto" name="frmCreateProducto"
                      action="../../../app/Controllers/ProductoController.php?action=create">
                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-8">
                            <input required type="number" class="form-control" id="cantidad" name="cantidad"
                                   placeholder="Ingrese la cantidad">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-8">
                            <input required type="number" class="form-control" id="precio"
                                   name="precio" placeholder="Ingrese el precio">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="comra" class="col-sm-2 col-form-label">Compra</label>
                        <div class="col-sm-8">
                            <?= \App\Controllers\CompraController::selectCompra(false,
                                true,
                                'compra',
                                'compra',
                                (!empty($dataCompra)) ? $dataCompra->getCompra()->getid_compra() : '',
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
                                (!empty($dataProducto)) ? $dataProducto->getproducto()->getIdProducto() : '',
                                'form-control select2bs4 select2-info')
                            ?>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-info">Enviar</button>
                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                </form>
            </div>
        </div>
        <!-- /.card -->
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>

<?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<!-- DataTables -->
<script src="<?= $adminlteURL ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/jszip/jszip.js"></script>
<script src="<?= $adminlteURL ?>/plugins/pdfmake/pdfmake.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>

<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../components/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>


</body>
</html>

