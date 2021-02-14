<?php
require_once("../../Partials/Routes.php");
require_once("../../../app/Controllers/PersonaController.php");
require_once("../../../app/Controllers/MunicipioController.php");

use App\Controllers\PersonaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos de la Persona</title>
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
                <div class="row mb-3">
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
                        Error al consultar el Municipio: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_persona'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Datos De La Persona </h3>
                </div>
            </div>

                <div class="card card-info">
                <?php if(!empty($_GET["id_persona"]) && isset($_GET["id_persona"])){
                    $DataPersona = PersonaController::searchForId($_GET["id_persona"]);
                    if(!empty($DataPersona)){
                        ?>
                        <strong><i class="fas fa-user mr-1"></i>Nombre</strong>
                        <p class="text-muted"><?= $DataPersona->getNombre() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i>ID</strong>
                        <p class="text-muted"><?= $DataPersona->getIdPersona() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i>Tipo Documento Y Documento</strong>
                            <p class="card-title"><?= $DataPersona->getTipoDocumento(). " ==> " .$DataPersona->getDocumento() ?>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Nombres Y Apellidos </strong>
                            <p class="card-title"><?= $DataPersona->getNombre() . " ==> " . $DataPersona->getApellido() ?>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Direccion</strong>
                        <p class="text-muted"><?= $DataPersona->getDireccion() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Telefono</strong>
                        <p class="text-muted"><?= $DataPersona->getTelefono() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Municipio </strong>
                        <p class="text-muted"><?= $DataPersona->getMunicipio()->getnombre() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Rol</strong>
                        <p class="text-muted"><?= $DataPersona->getRol() ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                        <p class="text-muted"><?= $DataPersona->getEstado() ?></p>
                        <hr>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Gestionar Persona
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="Create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Persona
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