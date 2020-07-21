<?php
require_once("../../Partials/Routes.php");
require_once("../../../app/Controllers/PersonaController.php");
require_once("../../../app/Controllers/MunicipioController.php");

use App\Controllers\PersonaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos de La Persona</title>
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
                        <h1>Informacion de La Persona</h1>
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

            <?php if (!empty($_GET['respuesta'])) { ?>
                <?php if ($_GET['respuesta'] == "error") { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al consultar Persona: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_persona'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-green">
                            <?php if (!empty($_GET["id_persona"]) && isset($_GET["id_persona"])) {
                                $DataPersona = PersonaController::searchForID($_GET["id_persona"]);
                                if (!empty($DataPersona)) {
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-info"></i> &nbsp; Ver Información
                                            de <?= $DataPersona->getNombre() ?></h3>
                                        <div class="card-tools">

                                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                                    data-source="show.php" data-source-selector="#card-refresh-content"
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

                                        <p>
                                            <strong><i class="fas fa-book mr-1"></i> Nombres y Apellidos</strong>
                                        <p class="text-muted">
                                            <?= $DataPersona->getNombre() . " " . $DataPersona->getApellido() ?>
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-user mr-1"></i> Documento</strong>
                                        <p class="text-muted"><?= $DataPersona->getTipoDocumento() . ": " . $DataPersona->getDocumento() ?></p>
                                        <hr>
                                        <strong><i class="far fa-user mr-1"></i> Municipio</strong>
                                        <p class="text-muted"><?= $DataPersona->getMunicipio()->getnombre() ?></p>
                                        <hr>
                                        <strong><i class="far fa-user mr-1"></i> Departamento</strong>
                                        <p class="text-muted"><?= $DataPersona->getMunicipio()->getDepartamento() ?></p>
                                        <hr>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Direccion</strong>
                                        <p class="text-muted"><?= $DataPersona->getDireccion() ?></p>
                                        <hr>
                                        <strong><i class="fas fa-phone mr-1"></i> Telefono</strong>
                                        <p class="text-muted"><?= $DataPersona->getTelefono() ?></p>
                                        <hr>
                                        <strong><i class="far fa-file-alt mr-1"></i> Estado y Rol</strong>
                                        <p class="text-muted"><?= $DataPersona->getEstado() . " - " . $DataPersona->getRol() ?></p>
                                        </p>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <a role="button" href="index.php" class="btn btn-success float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-tasks"></i> Gestionar Persona
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a role="button" href="create.php" class="btn btn-primary float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-plus"></i> Crear Persona
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../Partials/Footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../Partials/Scripts.php'); ?>
</body>
</html>

