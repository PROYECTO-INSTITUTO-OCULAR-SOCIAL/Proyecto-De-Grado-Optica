<?php
require("../../Partials/Routes.php");
require("../../../app/Controllers/DepartamentoController.php");

use App\Controllers\DepartamentoController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Departamento</title>
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
                        <h1>Editar Nuevo Departamento</h1>
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
                        Error al crear Departamento: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_departamento'])) { ?>
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
                <?php if(!empty($_GET["id_departamento"]) && isset($_GET["id_departamento"])){ ?>
                    <p>
                    <?php
                    $DataDepartamento = DepartamentoController::searchForID($_GET["id_departamento"]);
                    if(!empty($DataDepartamento)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditDepartamento" name="frmEditDepartamento" action="../../../app/Controllers/$DataDepartamentoController.php?action=edit">
                            <input id="id_departamento" name="id_departamento" value="<?php echo $DataDepartamento->getId(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nombre" name="nombre" value="<?= $DataDepartamento->getNombre(); ?>" placeholder="Ingrese su nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="codigo_dane" class="col-sm-2 col-form-label">Codigo_Dane</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control" id="codigo_dane" name="codigo_dane" value="<?= $DataDepartamento->getCodigo_dane(); ?>" placeholder="Ingrese el Codigo Dane">
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

