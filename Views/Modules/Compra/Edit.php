<?php
require_once("../../partials/routes.php");
require_once("../../../app/Controllers/CompraController.php");
require_once("../../../app/Controllers/PersonaController.php");
use Carbon\Carbon;
use App\Controllers\CompraController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Compra</title>
    <?php require_once("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require_once("../../partials/navbar_customization.php"); ?>

    <?php require_once("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Una Nueva Compra</h1>
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
                        Error al crear el Compra: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id_compra'])) { ?>
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
                <?php if(!empty($_GET["id_compra"]) && isset($_GET["id_compra"])){ ?>
                    <p>
                    <?php
                    $DataCompra = CompraController::searchForID($_GET["id_compra"]);
                    if(!empty($DataCompra)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditCompra" name="frmEditCompra" action="../../../app/Controllers/CompraController.php?action=edit">
                            <input id="id_compra" name="id_compra" value="<?php echo $DataCompra->getid_Compra(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>"
                                               value="<?= $DataCompra->getfecha()->toDateString(); ?>" class="form-control" id="fecha"
                                               name="fecha" placeholder="Ingrese la Fecha">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valor_total" class="col-sm-2 col-form-label">Valor Total</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" class="form-control" id="valor_total" name="valor_total" value="<?= $DataCompra->getvalor_total(); ?>" placeholder="Ingrese el Valor">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="Persona" class="col-sm-2 col-form-label">Persona</label>
                                    <div class="col-sm-10">
                                        <?= \App\Controllers\PersonaController::selectPersona(false,
                                            true,
                                            'persona',
                                            'persona',
                                            (!empty($dataCompra)) ? $dataCompra->getPersona()->getIdPersona() : '',
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

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>


