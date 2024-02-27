<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
$result_sql_id = mysqli_query($conexion,$sql_id);

$row_id = mysqli_fetch_array($result_sql_id);

$sql_ventas = "SELECT ventas.id_venta, DATE_FORMAT(fecha_venta,'%d-%m-%Y') AS fecha_venta, nombre_producto, cantidad_producto, precio_unitario, total_venta, nombre_persona,apellido_persona, id_usuario FROM ventas
INNER JOIN personas ON ventas.id_persona = personas.id_persona
    INNER JOIN detalle_ventas ON ventas.id_venta = detalle_ventas.id_venta
        INNER JOIN productos ON detalle_ventas.id_producto = productos.id_producto
            GROUP BY ventas.id_venta ORDER BY ventas.id_venta DESC ";
$resultado = mysqli_query($conexion, $sql_ventas);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Ventas</li>
        </ol>
        <h2 class="text-center">VENTAS</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="ventas_generar.php" class="btn btn-success"><i class="fa-solid fa-bag-shopping"></i> Generar nueva venta</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nro Comprobante</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['id_venta']; ?>
                        </td>
                        <td class="text-center">$
                            <?= number_format($row['total_venta'],2); ?>
                        </td>
                        <td class="text-center">
                            <?= $row['nombre_persona'].' '.$row['apellido_persona']; ?>
                        </td>
                        <td class="text-center">
                            <!-- Ver mas venta -->
                            <a href="ventas_mostrar.php?id_venta=<?php echo $row['id_venta'];?>"
                            class="btn btn-sm btn-primary" title="Ver mas"><i class="fa-solid fa-eye" style="color: #ffffff;"> </i></a>
                            <a href="includes/facturas.php?id_venta=<?php echo $row['id_venta'];?>"
                            class="btn btn-sm btn-success" title="Imprimir factura"><i class="fa-solid fa-print" style="color: #ffffff;"></i> </a>
                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="principal.php" class="btn btn-primary" >Volver</a>
            </div>
        </div> 
    </div>
<!-- FIN CONTENIDO -->
<?php include './includes/footer.php'; ?>