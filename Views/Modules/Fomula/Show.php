<?php
require("../../Partials/Routes.php");
require("../../../app/Controllers/FormulaController.php");

use app\Controllers\FormulaContrller; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos de la Formula</title>
    <?php require("../../partials/head_imports.php"); ?>
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
                        <h1>Informacion de la Formula</h1>
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
                        Error al consultar la formula: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_formula'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["id_formula"]) && isset($_GET["id_formula"])){
                    $DataFormula = FormulaController::searchForID($_GET["id_formula"]);
                    if(!empty($DataFormula)){
                        ?>
                        <div class="card-header">

                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od esfera</strong>
                            <p class="text-muted"><?= $DataFormula->getod_esferan() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od esfera</strong>
                            <p class="text-muted"><?= $DataFormula->getod_esfera() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> oi esfera</strong>
                            <p class="text-muted"><?= $DataFormula->getoi_esfera() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od cilindro</strong>
                            <p class="text-muted"><?= $DataFormula->getod_cilindro() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od eje</strong>
                            <p class="text-muted"><?= $DataFormula->getoi_cilindro() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od eje</strong>
                            <p class="text-muted"><?= $DataFormula->getod_eje() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> oi eje</strong>
                            <p class="text-muted"><?= $DataFormula->getoi_eje() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> od av</strong>
                            <p class="text-muted"><?= $DataFormula->getod_av() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> oi av</strong>
                            <p class="text-muted"><?= $DataFormula->getoi_av() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> dp</strong>
                            <p class="text-muted"><?= $DataFormula->getdp() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> color</strong>
                            <p class="text-muted"><?= $DataFormula->getcolor() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> numero montura</strong>
                            <p class="text-muted"><?= $DataFormula->getnumero_montura() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> observaciones</strong>
                            <p class="text-muted"><?= $DataFormula->getobservaciones() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> bifocal</strong>
                            <p class="text-muted"><?= $DataFormula->getbifocal() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> material</strong>
                            <p class="text-muted"><?= $DataFormula->getmaterial() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> valor</strong>
                            <p class="text-muted"><?= $DataFormula->getvalor() ?></p>
                            <hr>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Gestionar Formula
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Formula
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

