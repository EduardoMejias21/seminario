<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
if (isset($_GET['id_compra'])) {
    $id_compra = $_GET['id_compra'];

    $sql_compra = "SELECT id_compra, DATE_FORMAT(fecha_compra,'%d-%m-%Y') AS fecha_compra, nro_comprobante, total_compra,estado_compra,razon_social_proveedor,cuit_proveedor FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE id_compra='$id_compra'";
    $result_compra = mysqli_query($conexion, $sql_compra);

    $sql_detalle_compra = "SELECT id_compra,nombre_producto,cantidad_compra, detalle_compras.precio_unitario,total_x_producto FROM detalle_compras INNER JOIN productos ON detalle_compras.id_producto=productos.id_producto WHERE id_compra='$id_compra'";
    $result_detalle_compra = mysqli_query($conexion, $sql_detalle_compra);
} else {
    header('Location: compras.php');
}
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="compras.php">Compras</a></li>
            <li class="breadcrumb-item active">Detalle de compra</li>
        </ol>
        <h3 class="text-center">DETALLE DE COMPRA</h3>
        <hr>
        <table class="table table-light table-bordered ">
            <?php
            while ($row_compra = mysqli_fetch_assoc($result_compra)) { ?>
                <tr>
                    <td colspan="2">
                        <?php echo "<b>Proveedor: " . $row_compra['razon_social_proveedor'] . "</b>" ?>
                        <?php echo "<p><b>CUIT: " . $row_compra['cuit_proveedor'] . "</b></p>" ?>
                    </td>
                    <td colspan="2">
                        <?php echo "<b>Comprobante numero: " . $row_compra['nro_comprobante'] . "</b>" ?>
                        <?php echo "<p><b>Fecha de Emision: " . $row_compra['fecha_compra'] . "</b></p>" ?>
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
            while ($row_detalle_compra = mysqli_fetch_assoc($result_detalle_compra)) { ?>
                <tr class="text-center">
                    <td width="5%"></td>
                    <td width="40%">
                        <?php echo $row_detalle_compra['nombre_producto'] ?>
                    </td>
                    <td width="15%">
                        <?php echo $row_detalle_compra['cantidad_compra'] ?>
                    </td>
                    <td width="20%">$
                        <?php echo $row_detalle_compra['precio_unitario'] ?>
                    </td>
                    <td width="20%">$
                        <?php echo number_format($row_detalle_compra['precio_unitario'] * $row_detalle_compra['cantidad_compra'], 2); ?>
                    </td>
                </tr>
                <?php
                $total = $total + ($row_detalle_compra['precio_unitario'] * $row_detalle_compra['cantidad_compra']);
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
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="compras.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './includes/footer.php'; ?>