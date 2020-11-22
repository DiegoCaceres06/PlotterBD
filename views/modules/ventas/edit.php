<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/VentasController.php");

use App\Controllers\VentasController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Editar Ventas</title>
    <?php require("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Nueva Venta</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">Plotter</a></li>
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
                        Error al crear la venta: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id'])) { ?>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-box"></i>&nbsp; Información de la venta</h3>
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
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                                <p>
                                <?php
                                $DataVenta = VentasController::searchForID($_GET["id"]);
                                if (!empty($DataVenta)) {
                                    ?>
                                    <div class="card-body">
                                        <!-- form start -->
                                        <form class="form-horizontal" method="post" id="frmEditVenta"
                                              name="frmEditVenta"
                                              action="../../../app/Controllers/VentasController.php?action=edit">
                                            <input id="id" name="id" value="<?php echo $DataVenta->getId(); ?>"
                                                   hidden required="required" type="text">
                                            <div class="form-group row">
                                                <label for="numero_serie" class="col-sm-2 col-form-label">N° Serie</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="numero_serie"
                                                           name="numero_serie" value="<?= $DataVenta->getNumeroSerie(); ?>"
                                                           placeholder="Ingrese el numero de serie">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cliente_id" class="col-sm-2 col-form-label">Cliente ID</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="cliente_id"
                                                           name="cliente_id" value="<?= $DataVenta->getClienteId(); ?>"
                                                           placeholder="Ingrese el Id del cliente">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="empleado_id" class="col-sm-2 col-form-label">Cliente ID</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="empleado_id"
                                                           name="empleado_id" value="<?= $DataVenta->getEmpleadoId(); ?>"
                                                           placeholder="Ingrese el Id de empleado">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="stock" name="stock"
                                                           value="<?= $DataProducto->getStock(); ?>"
                                                           placeholder="Ingrese el stock">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select id="estado" name="estado" class="custom-select">
                                                        <option <?= ($DataProducto->getEstado() == "Activo") ? "selected" : ""; ?>
                                                            value="Activo">Activo
                                                        </option>
                                                        <option <?= ($DataProducto->getEstado() == "Inactivo") ? "selected" : ""; ?>
                                                            value="Inactivo">Inactivo
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-info">Enviar</button>
                                            <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->

                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php } ?>
                                </p>
                            <?php } ?>
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
