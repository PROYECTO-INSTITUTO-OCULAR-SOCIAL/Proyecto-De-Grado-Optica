<?php
require_once("../../Partials/Routes.php");
require_once("../../../app/Controllers/PersonaController.php");
require_once("../../../app/Controllers/MunicipioController.php");

use App\Controllers\PersonaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Persona</title>
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
                        Error al crear Persona: <?= ($_GET['mensaje']) ?? "" ?>
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
                    <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información de la persona</h3>
                </div>
            </div>
                <div class="card card-info">
                <!-- /.card-header -->
                <?php if(!empty($_GET["id_persona"]) && isset($_GET["id_persona"])){ ?>
                    <p>
                    <?php
                    $DataPersona = PersonaController::searchForID($_GET["id_persona"]);
                    if(!empty($DataPersona)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditPersona" name="frmEditPersona" action="../../../app/Controllers/PersonaController.php?action=edit">
                            <input id="id_persona" name="id_persona" value="<?php echo $DataPersona->getIdPersona(); ?>" hidden
                                   required="required" type="text">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="tipo_documento" class="col-sm-2 col-form-label">Tipo
                                        Documento</label>
                                    <div class="col-sm-10">
                                        <select id="tipo_documento" name="tipo_documento"
                                                class="custom-select">
                                            <option <?= ($DataPersona->getTipoDocumento() == "Cedula De Ciudadania") ? "selected" : ""; ?>
                                                value="Cedula De Ciudadania">Cedula de Ciudadania
                                            </option>
                                            <option <?= ($DataPersona->getTipoDocumento() == "Tarjeta De Identidad") ? "selected" : ""; ?>
                                                value="Tarjeta De Identidad">Tarjeta de Identidad
                                            </option>
                                            <option <?= ($DataPersona->getTipoDocumento() == "Registro Civil") ? "selected" : ""; ?>
                                                value="Registro Civil">Registro Civil
                                            </option>
                                            <option <?= ($DataPersona->getTipoDocumento() == "Pasaporte") ? "selected" : ""; ?>
                                                value="Pasaporte">Pasaporte
                                            </option>
                                            <option <?= ($DataPersona->getTipoDocumento() == "Cedula De Extranjeria") ? "selected" : ""; ?>
                                                value="Cedula De Extranjeria">Cedula de Extranjeria
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="documento" class="col-sm-2 col-form-label">Documento</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control"
                                               id="documento" name="documento"
                                               value="<?= $DataPersona->getDocumento(); ?>"
                                               placeholder="Ingrese su documento">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombres</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nombre"
                                               name="nombre" value="<?= $DataPersona->getNombre(); ?>"
                                               placeholder="Ingrese sus nombres">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="apellido" class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="apellido"
                                               name="apellido" value="<?= $DataPersona->getApellido(); ?>"
                                               placeholder="Ingrese sus apellidos">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="direccion"
                                               name="direccion" value="<?= $DataPersona->getDireccion(); ?>"
                                               placeholder="Ingrese su direccion">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control"
                                               id="telefono" name="telefono"
                                               value="<?= $DataPersona->getTelefono(); ?>"
                                               placeholder="Ingrese su telefono">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="municipio" class="col-sm-2 col-form-label">Municipio</label>
                                    <div class="col-sm-10">
                                        <?= \App\Controllers\MunicipioController::selectMunicipio(false,
                                            true,
                                            'municipio',
                                            'municipio',
                                            (!empty($DataPersona)) ? $DataPersona->getMunicipio()->getIdMunicipio() : '',
                                            'form-control select2bs4 select2-info'
                                        )
                                        ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                                    <div class="col-sm-10">
                                        <select id="rol" name="rol" class="custom-select">
                                            <option <?= ($DataPersona->getRol() == "cliente") ? "selected" : ""; ?>
                                                value="cliente">cliente
                                            </option>
                                            <option <?= ($DataPersona->getRol() == "proveedor") ? "selected" : ""; ?>
                                                value="proveedor">proveedor
                                            </option>
                                            <option <?= ($DataPersona->getRol() == "vendedor") ? "selected" : ""; ?>
                                                value="vendedor">vendedor
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contrasena" class="col-sm-2 col-form-label">Contraseña</label>
                                    <div class="col-sm-10">
                                        <input required type="password" class="form-control" id="contrasena"
                                               name="contrasena" value="<?= $DataPersona->getContrasena(); ?>"
                                               placeholder="Ingrese su Nueva Contraseña">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="estado" name="estado" class="custom-select">
                                            <option <?= ($DataPersona->getEstado() == "activo") ? "selected" : ""; ?>
                                                value="activo">activo
                                            </option>
                                            <option <?= ($DataPersona->getEstado() == "inactivo") ? "selected" : ""; ?>
                                                value="inactivo">inactivo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <hr>
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

