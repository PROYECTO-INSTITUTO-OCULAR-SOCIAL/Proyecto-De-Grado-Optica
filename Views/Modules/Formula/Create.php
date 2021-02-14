<?php
require_once("../../../app/Controllers/FormulaController.php");
require_once("../../Partials/Routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Formula</title>
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
                        <h1>Crear Nueva Formula</h1>
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
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al crear formula: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                data-source="create.php" data-source-selector="#card-refresh-content"
                                data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateFormula" name="frmCreateFormula" action="../../../app/Controllers/FormulaController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="od_esfera" class="col-sm-2 col-form-label">od esfera</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="od_esfera" name="od_esfera" placeholder="Ingrese od esfera">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="oi_esfera" class="col-sm-2 col-form-label">oi esfera</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="oi_esfera" name="oi_esfera" placeholder="Ingrese oi esfera">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="od_cilindro" class="col-sm-2 col-form-label">od cilindro</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="od_cilindro" name="od_cilindro" placeholder="Ingrese od cilindro">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="oi_cilindro" class="col-sm-2 col-form-label">oi cilindro</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="oi_cilindro" name="oi_cilindro" placeholder="Ingrese oi cilindro">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="od_eje" class="col-sm-2 col-form-label">od eje</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="od_eje" name="od_eje" placeholder="Ingrese od eje">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="oi_eje" class="col-sm-2 col-form-label">oi eje</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="oi_eje" name="oi_eje" placeholder="Ingrese oi eje">
                            </div></div>
                        <div class="form-group row">
                            <label for="od_av" class="col-sm-2 col-form-label">od av</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="od_av" name="od_av" placeholder="Ingrese od av">
                            </div></div>
                        <div class="form-group row">
                            <label for="oi_av" class="col-sm-2 col-form-label">oi av</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="oi_av" name="oi_av" placeholder="Ingrese oi av">
                            </div></div>
                        <div class="form-group row">
                            <label for="dp" class="col-sm-2 col-form-label">dp</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="dp" name="dp" placeholder="Ingrese dp">
                            </div></div>
                        <div class="form-group row">
                            <label for="color" class="col-sm-2 col-form-label">color</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="color" name="color" placeholder="Ingrese color">
                            </div></div>
                        <div class="form-group row">
                            <label for="numero_montura" class="col-sm-2 col-form-label">numero de montura</label>
                            <div class="col-sm-10">
                                <input required type="number" class="form-control" id="numero_montura" name="numero_montura" placeholder="Ingrese numero de montura">
                            </div></div>
                        <div class="form-group row">
                            <label for="observaciones" class="col-sm-2 col-form-label">observaciones</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="observaciones" name="observaciones" placeholder="observaciones">
                            </div></div>
                        <div class="form-group row">
                            <label for="bifocal" class="col-sm-2 col-form-label">bifocal</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="bifocal" name="bifocal" placeholder="Ingrese bifocal">
                            </div></div>
                        <div class="form-group row">
                            <label for="material" class="col-sm-2 col-form-label">material</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="material" name="material" placeholder="material">
                            </div></div>
                        <div class="form-group row">
                            <label for="valor" class="col-sm-2 col-form-label">valor</label>
                            <div class="col-sm-10">
                                <input required type="number" class="form-control" id="valor" name="valor" placeholder="valor">
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Enviar</button>
                            <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
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

<!-- /.card-body -->