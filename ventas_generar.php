<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
$result_sql_id = mysqli_query($conexion, $sql_id);

$row_id = mysqli_fetch_array($result_sql_id);

?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="ventas.php">Ventas</a></li>
            <li class="breadcrumb-item active">Generar Venta</li>
        </ol>
        <h2 class="text-center">GENERAR VENTA</h2>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <div>
            <div class="mb-2">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#seleccion_persona">Seleccione
                    un cliente</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#seleccion_producto">Seleccione
                    un producto</button>
            </div>
            <br>
            <h3>Detalle de venta</h3>
            <table class="table table-light table-bordered ">
                <tbody>
                    <?php if (!empty($_SESSION['persona_venta'])) { ?>
                        <tr class="text-center">
                            <th colspan="5">DATOS DE FACTURACION</th>
                        </tr>
                        <?php
                        foreach ($_SESSION['persona_venta'] as $indice => $persona) { ?>
                            <tr>
                                <td colspan="3">
                                    <?php echo $persona['nombre_persona'] . ' ' . $persona['apellido_persona'] ?><br>
                                    <?php echo "CUIL: " . $persona['cuil_persona'] ?><br>
                                    <?php echo "CONDICION IVA: " . $persona['condicion_iva'] ?><br>
                                    <?php echo "DOMICILIO: " . $persona['domicilio_fiscal'] ?><br>
                                    <?php echo "CORREO: " . $persona['correo'] ?><br>
                                    <?php echo "TELEFONO: " . $persona['num_telefono'] ?><br>
                                </td>
                                <td colspan="2" class="text-center">
                                    <br>
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="id_persona" id="id_persona"
                                            value="<?php echo openssl_encrypt($persona['id_persona'], COD, KEY) ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAccion"
                                            value="limpiar_campo">Limpiar
                                            campo</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Por favor seleccione una persona
                        </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION['venta'])) { ?>
                        <tr class="text-center">
                            <th colspan="5">DETALLE DE VENTA</th>
                        </tr>
                        <tr class="text-center">
                            <th width="40%">Descripcion</th>
                            <th width="15%">Cantidad</th>
                            <th width="20%">Precio</th>
                            <th width="20%">Total</th>
                            <th width="5%">--</th>
                        </tr>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['venta'] as $indice => $producto) { ?>
                            <tr>
                                <td width="40%">
                                    <?php echo $producto['nombre_producto'] ?>
                                </td>
                                <td width="15%">
                                    <?php echo $producto['cantidad_venta'] ?>
                                </td>
                                <td width="20%">$
                                    <?php echo number_format($producto['precio_venta'],2)?>
                                </td>
                                <td width="20%">$
                                    <?php echo number_format($producto['precio_venta'] * $producto['cantidad_venta'], 2); ?>
                                </td>
                                <td width="5%">
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="id_prod" id="id_prod"
                                            value="<?php echo $producto['id_producto'] ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAccion"
                                            value="Eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $total = $total + ($producto['precio_venta'] * $producto['cantidad_venta']);
                        } ?>
                        <tr>
                            <td colspan="3" align="right">
                                <h4>Total</h4>
                            </td>
                            <td colspan="2" align="right">
                                <h4>$
                                    <?php echo number_format($total, 2); ?>
                                </h4>
                            </td>
                        </tr>
                        <?php if (!empty($_SESSION['venta']) && !empty($_SESSION['persona_venta'])) { ?>
                            <tr>
                                <td colspan="5">
                                    <form action="modals_querys.php" method="post">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" name="btnAccion"
                                                    value="proceder">Generar
                                                    comprobante</button>
                                            </div>
                                            <small id="emailHelp" class="form-text text-muted">
                                                Usted esta por generar un nuevo comprobante de venta.
                                            </small>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Por favor seleccione productos...
                        </div>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <a href="ventas.php" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
        <!-- FIN CONTENIDO -->
        <?php include './modal/modals_ventas.php'; ?>
    <script>
        let seleccion_persona = document.querySelector("#seleccion_persona")
        let seleccion_producto = document.querySelector("#seleccion_producto")
    </script>
<?php include './includes/footer.php'; ?>