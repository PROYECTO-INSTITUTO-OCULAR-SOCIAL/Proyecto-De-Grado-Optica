<?php
require("../../Partials/Routes.php");
require("../../../app/Controllers/MarcaController.php");

use App\Controllers\MarcaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Marca</title>
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
                        <h1>Editar Nueva Marca</h1>
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
                        Error al crear Marca: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_marca'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Registrar Marca</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["id_marca"]) && isset($_GET["id_marca"])){ ?>
                    <p>
                    <?php
                    $DataMarca = MarcaController::searchForid_marca($_GET["id_marca"]);
                    if(!empty($DataMarca)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditMarca" name="frmEditMarca" action="../../../app/Controllers/MarcaController.php?action=Edit">
                            <input id="id" name="id" value="<?php echo $DataMarca->getid_marca(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nombre" name="nombre" value="<?= $DataMarca->getnombre(); ?>" placeholder="Ingrese nombre marca">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="estado" class="col-sm-2 col-form-label">estado</label>
                                    <div class="col-sm-10">
                                        <select id="estado" name="estado" class="custom-select">
                                            <option <?= ($DataMarca->getestado() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataMarca->getestado() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="estado" name="estado" class="custom-select">
                                            <option <?= ($DataMarca->getestado() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataMarca->getestado() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                        </select>
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

