<?php
require("../../partials/routes.php");
require("../../../app/Controllers/AbonoController.php");
require("../../../app/Controllers/VentaController.php");


use Carbon\Carbon;
use App\Controllers\CompraController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Abono</title>
    <?php require("../../Partials/Head_Imports.php"); ?>
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
                        <h1>Editar Abono</h1>
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
                        Error al Editar Abono: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_abono'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Abono</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["id_abono"]) && isset($_GET["id_abono"])){ ?>
                    <p>
                    <?php
                    $DataAbono = AbonoController::searchForid_abono($_GET["id_abono"]);
                    if(!empty($DataAbono)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditAbono" name="frmEditAbono" action="../../../app/Controllers/AbonoController.php?action=edit">
                            <input id="id_abono" name="id_abono" value="<?php echo $DataAbono->getid_abono(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear()->format('Y-m-d') ?>"
                                               value="<?= $DataAbono->getfecha()->toDateString(); ?>" class="form-control" id="fecha"
                                               name="fecha" placeholder="Ingrese Fecha Abono">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control" id="valor" name="valor" value="<?= $DataAbono->getvalor(); ?>" placeholder="Ingrese Valor Abono">
                                    </div>
                                </div>






                                <div class="form-group row">
                                    <label for="Venta" class="col-sm-2 col-form-label">Venta</label>
                                    <div class="col-sm-10">
                                        <?= \App\Controllers\VentaController::selectVenta(false,
                                            true,
                                            'Venta',
                                            'Venta',
                                            (!empty($dataAbono)) ? $dataAbono->getVenta()->getid_venta() : '',
                                            'form-control select2bs4 select2-info'
                                        )
                                        ?>
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

    <?php require ('../../Partials/Footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../Partials/Scripts.php');?>
</body>
</html>


