<?php
require_once("../../../app/Controllers/MunicipioController.php");
require_once("../../Partials/Routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Persona</title>
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
                        <h1>Crear un Nueva Persona</h1>
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
                <?php if ($_GET['respuesta'] != "correcto") { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al crear una persona: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información de la persona</h3>
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
                            <div class="card-body">
                                <!-- form start -->
                                <form class="form-horizontal" method="post" id="frmCreatePersona"
                                      name="frmCreatePersona"
                                      action="../../../app/Controllers/PersonaController.php?action=create">

                                    <div class="form-group row">
                                        <label for="tipo_documento" class="col-sm-2 col-form-label">Tipo
                                            Documento</label>
                                        <div class="col-sm-10">
                                            <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                                <option value="Cedula De Ciudadania">Cedula de Ciudadania</option>
                                                <option value="Tarjeta De Identidad">Tarjeta de Identidad</option>
                                                <option value="Registro Civil">Registro Civil</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cedula De Extranjeria">Cedula de Extranjeria</option>
                                            </select>
                                    </div>
                            </div>

                                    <div class="form-group row">
                                        <label for="documento" class="col-sm-2 col-form-label">Documento</label>
                                        <div class="col-sm-10">
                                            <input required type="number" minlength="6" class="form-control"
                                                   id="documento" name="documento" placeholder="Ingrese su documento">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombres</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="nombre" name="nombre"
                                                   placeholder="Ingrese sus nombres">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="apellido" class="col-sm-2 col-form-label">Apellidos</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="apellido"
                                                   name="apellido" placeholder="Ingrese sus apellidos">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="direccion"
                                                   name="direccion" placeholder="Ingrese su direccion">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-10">
                                            <input required type="number" minlength="6" class="form-control"
                                                   id="telefono" name="telefono" placeholder="Ingrese su telefono">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="municipio" class="col-sm-2 col-form-label">Municipio</label>
                                        <div class="col-sm-10">
                                            <?= \App\Controllers\MunicipioController::selectMunicipio(false,
                                                true,
                                                'municipio',
                                                'municipio',
                                                 (!empty($dataPersona)) ? $dataPersona->getMunicipio()->getIdMunicipio() : '',
                                                'form-control select2bs4 select2-info'
                                            )
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="rol" class="col-sm-2 col-form-label">Rol De Cargo</label>
                                        <div class="col-sm-10">
                                            <select id="rol" name="rol" class="custom-select">
                                                <option value="cliente">Cliente</option>
                                                <option value="proveedor">Proveedor</option>
                                                <option value="vendedor">Vendedor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contrasena" class="col-sm-2 col-form-label">Contraseña</label>
                                        <div class="col-sm-10">
                                            <input required type="password" class="form-control" id="contrasena"
                                                   name="contrasena" placeholder="Ingrese su contraseña">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                        <div class="col-sm-10">
                                            <select id="estado" name="estado" class="custom-select">
                                                <option value="activo">Activo</option>
                                                <option value="inactivo">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card-body -->

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
</body>
</html>
