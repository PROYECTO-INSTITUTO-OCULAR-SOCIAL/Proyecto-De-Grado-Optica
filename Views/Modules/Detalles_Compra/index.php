<?php

require_once("../../../app/Controllers/ProductoController.php");
require_once("../../../app/Controllers/CompraController.php");
require_once("../../../app/Controllers/Detalles_CompraController.php");
require_once("../../partials/routes.php");


use App\Controllers\Detalles_CompraController;
use App\Models\Detalles_Compra;

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Layout</title>
    <?php require("../../partials/head_imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require_once("../../partials/navbar_customization.php"); ?>

    <?php require_once("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pagina Principal</h1>
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

            <?php if (!empty($_GET['respuesta']) && !empty($_GET['action'])) { ?>
                <?php if ($_GET['respuesta'] == "correcto") { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php if ($_GET['action'] == "create") { ?>
                            El Producto ha sido creado con exito!
                        <?php } else if ($_GET['action'] == "update") { ?>
                            Los datos del Producto han sido actualizados correctamente!
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></i> &nbsp; Gestionar Detalle de Compra</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                data-source="index.php" data-source-selector="#card-refresh-content"
                                data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <a role="button" href="Create.php" class="btn btn-primary float-right"
                               style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Detalle de Compra
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tblDetalles_Compra" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                   <th>#</th>
                                     <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Compra</th>
                                    <th>Producto</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrDetalles_Compra = Detalles_CompraController::getAll();
                                foreach ($arrDetalles_Compra as $Detalles_Compra) {
                                    ;
                                    ?>
                                    <tr>
                                        <td><?= $Detalles_Compra->getIdDetallesCompra(); ?></td>
                                        <td><?= $Detalles_Compra->getCantidad(); ?></td>
                                        <td><?= $Detalles_Compra->getPrecio(); ?></td>
                                        <td><?= $Detalles_Compra->getCompra()->getfecha(); ?></td>
                                        <td><?= $Detalles_Compra->getProducto()->getNombre(); ?></td>

                                        <td>
                                            <a href="Edit.php?idDetalles_Compra=<?php echo $Detalles_Compra->getIdDetallesCompra(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="Show.php?idDetalles_Compra=<?php echo $Detalles_Compra->getIdDetallesCompra(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a
                                                <a type="button"
                                                   href="../../../app/Controllers/Detalles_CompraController.php?action=inactivate&Id=<?php echo $Detalles_Compra->getIdDetallesCompra(); ?>"
                                                   data-toggle="tooltip" title="Inactivar"
                                                   class="btn docs-tooltip btn-danger btn-xs"><i
                                                        class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Compra</th>
                                    <th>Producto</th>
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Pie de Página.
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
    </div>
</div>
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

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

