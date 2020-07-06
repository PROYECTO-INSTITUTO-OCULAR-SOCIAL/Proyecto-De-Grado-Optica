<?php require("../../Partials/Routes.php");
require("../../../app/Controllers/FormulaController.php");

use App\Controllers\FormulaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Layout</title>
    <?php require("../../Partials/Head_Imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../Partials/Navbar_Customization.php"); ?>

    <?php require("../../Partials/Sliderbar_Main_Menu.php"); ?>

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

            <?php if(!empty($_GET['respuesta']) && !empty($_GET['action'])){ ?>
                <?php if ($_GET['respuesta'] == "correcto"){ ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php if ($_GET['action'] == "create"){ ?>
                            La Formula ha sido creada con exito!
                        <?php }else if($_GET['action'] == "update"){ ?>
                            Los datos de la formula han sido actualizados correctamente!
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestionar Formula</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <a role="button" href="Create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Formula
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tblCategoria" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>od esfera</th>
                                    <th>oi esfera</th>
                                    <th>od cilindro</th>
                                    <th>oi cilindro</th>
                                    <th>od eje</th>
                                    <th>oi eje</th>
                                    <th>od av</th>
                                    <th>oi ad</th>
                                    <th>dp</th>
                                    <th>color</th>
                                    <th>numero de montura</th>
                                    <th>observaciones</th>
                                    <th>bifocal</th>
                                    <th>material</th>
                                    <th>valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrFormula = FormulaController::getAll();
                                foreach ($arrFormula as $Formula){
                                    ?>
                                    <tr>
                                        <td><?php echo $Formula->getid_formula(); ?></td>
                                        <td><?php echo $Formula->getod_esferea(); ?></td>
                                        <td><?php echo $Formula->getoi_esfera(); ?></td>
                                        <td><?php echo $Formula->getod_cilindro(); ?></td>
                                        <td><?php echo $Formula->getoi_cilindro(); ?></td>
                                        <td><?php echo $Formula->getod_eje(); ?></td>
                                        <td><?php echo $Formula->getoi_eje(); ?></td>
                                        <td><?php echo $Formula->getod_av(); ?></td>
                                        <td><?php echo $Formula->getoi_av(); ?></td>
                                        <td><?php echo $Formula->getdp(); ?></td>
                                        <td><?php echo $Formula->getcolor(); ?></td>
                                        <td><?php echo $Formula->getnumero_montura(); ?></td>
                                        <td><?php echo $Formula->getobservaciones(); ?></td>
                                        <td><?php echo $Formula->getbifocal(); ?></td>
                                        <td><?php echo $Formula->getmaterial(); ?></td>
                                        <td><?php echo $Formula->getvalor(); ?></td>

                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>od esfera</th>
                                    <th>oi esfera</th>
                                    <th>od cilindro</th>
                                    <th>oi cilindro</th>
                                    <th>od eje</th>
                                    <th>oi eje</th>
                                    <th>od av</th>
                                    <th>oi ad</th>
                                    <th>dp</th>
                                    <th>color</th>
                                    <th>numero de montura</th>
                                    <th>observaciones</th>
                                    <th>bifocal</th>
                                    <th>material</th>
                                    <th>valor</th>


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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
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
                "url": "../../Components/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave" : true, //Guardar la configuracion del Formula
        });
</script>

</body>
</html>

