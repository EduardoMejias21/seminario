<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
if (isset($_GET['id_venta'])) {
    $id_venta = $_GET['id_venta'];

    $sql_venta = "SELECT id_venta, DATE_FORMAT(fecha_venta,'%d-%m-%Y') AS fecha_venta, total_venta,nombre_persona,apellido_persona,cuil_persona FROM ventas INNER JOIN personas ON ventas.id_persona = personas.id_persona WHERE id_venta='$id_venta'";
    $result_venta = mysqli_query($conexion, $sql_venta);

    $sql_detalle_venta = "SELECT id_venta,nombre_producto,cantidad_producto, detalle_ventas.precio_unitario,total_x_producto FROM detalle_ventas INNER JOIN productos ON detalle_ventas.id_producto=productos.id_producto WHERE id_venta='$id_venta'";
    $result_detalle_venta = mysqli_query($conexion, $sql_detalle_venta);
} else {
    header('Location: ventas.php');
}
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="ventas.php">Ventas</a></li>
            <li class="breadcrumb-item active">Detalle de venta</li>
        </ol>
        <h3 class="text-center">DETALLE DE VENTA</h3>
        <hr>
        <table class="table table-light table-bordered ">
            <?php
            while ($row_venta = mysqli_fetch_assoc($result_venta)) { ?>
                <tr>
                    <td colspan="2">
                        <?php echo "<b>Comprobante numero: " . $row_venta['id_venta'] . "</b>" ?>
                        <?php echo "<p><b>Fecha de Emision: " . $row_venta['fecha_venta'] . "</b></p>" ?>
                    </td>
                </tr>
                <?php
            } ?>
            <tr class="text-center">
                <th width="5%">Codigo</th>
                <th width="40%">Descripcion</th>
                <th width="15%">Cantidad</th>
                <th width="20%">Precio</th>
                <th width="20%">Total</th>
            </tr>
            <?php
            $total = 0;
            while ($row_detalle_venta = mysqli_fetch_assoc($result_detalle_venta)) { ?>
                <tr class="text-center">
                    <td width="5%"></td>
                    <td width="40%">
                        <?php echo $row_detalle_venta['nombre_producto'] ?>
                    </td>
                    <td width="15%">
                        <?php echo $row_detalle_venta['cantidad_producto'] ?>
                    </td>
                    <td width="20%">$
                        <?php echo $row_detalle_venta['precio_unitario'] ?>
                    </td>
                    <td width="20%">$
                        <?php echo number_format($row_detalle_venta['precio_unitario'] * $row_detalle_venta['cantidad_producto'], 2); ?>
                    </td>
                </tr>
                <?php
                $total = $total + ($row_detalle_venta['precio_unitario'] * $row_detalle_venta['cantidad_producto']);
            } ?>
            <tr>
                <td colspan="4" align="right">
                    <h4>Total</h4>
                </td>
                <td colspan="1" class="text-center">
                    <h4>$
                        <?php echo number_format($total, 2); ?>
                    </h4>
                </td>
            </tr>
        </table>
        <div class="alert alert-secondary" role="alert" align="center">
            <div class="form-group">
                <a href="includes/facturas.php?id_venta=<?php echo $id_venta?>" class="btn btn-secondary">Imprimir comprobante</a>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="ventas.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './includes/footer.php'; ?>