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

$sql_compras = "SELECT compras.id_compra, DATE_FORMAT(fecha_compra,'%d-%m-%Y') AS fecha_compra ,nro_comprobante,total_compra,estado_compra,razon_social_proveedor, cantidad_compra,precio_unitario, total_x_producto, nombre_producto FROM compras 
    INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor
        INNER JOIN detalle_compras ON compras.id_compra = detalle_compras.id_compra
            INNER JOIN productos ON detalle_compras.id_producto = productos.id_producto 
                GROUP BY compras.id_compra ORDER BY compras.id_compra DESC";
$resultado = mysqli_query($conexion, $sql_compras);
$row_count = mysqli_num_rows($resultado);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Compras</li>
        </ol>
        <h2 class="text-center">COMPRAS</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="compras_generar.php" class="btn btn-primary"><i class="fa-solid fa-bag-shopping"> </i> Cargar
                    nueva compra</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Comp. Nro°</th>
                    <th class="text-center">Fecha Compra</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Proveedor</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nro_comprobante']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['fecha_compra']; ?>
                        </td>
                        <td class="text-center">$
                            <?= $row['total_compra']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['razon_social_proveedor']; ?>
                        </td>
                        <td class="text-center">
                            <!-- Ver mas compra -->
                            <a href="compras_mostrar.php?id_compra=<?php echo $row['id_compra']; ?>"
                                class="btn btn-sm btn-primary" title="Ver mas"><i class="fa-solid fa-eye"
                                    style="color: #ffffff;"> </i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="principal.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './includes/footer.php'; ?>