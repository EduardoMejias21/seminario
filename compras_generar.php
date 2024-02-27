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
            <li class="breadcrumb-item"><a href="compras.php">Compras</a></li>
            <li class="breadcrumb-item active">Cargar Compra</li>
        </ol>
        <h2 class="text-center">CARGAR COMPRA</h2>
        <hr>
        <?php include './includes/mensaje.php';?>
        <div>
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#fecha_comprobante">Fecha y N° Comprobante</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#seleccion_proveedor">Seleccione
                    un proveedor</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#seleccion_producto_compra">Seleccione
                    un producto</button>
            </div>
            <br>
            <h3>Detalle de compra</h3>
            <table class="table table-light table-bordered ">
                <tbody>
                    <?php
                    foreach ($_SESSION['nuevo_producto'] as $indice => $nuevo_prod) {
                        $id_p = $nuevo_prod['id_producto'];
                        $nombre_p = $nuevo_prod['nombre_producto'];
                        $descripcion_p = $nuevo_prod['descripcion_producto'];
                        $estado_p = $nuevo_prod['estado_producto'];
                        $id_c = $nuevo_prod['id_categoria'];
                        $id_u = $nuevo_prod['id_usuario_creacion'];

                        echo $nuevo_prod['id_producto'];
                        echo $nombre_p;
                        echo $descripcion_p;
                        echo $estado_p;
                        echo $id_c;
                        echo $id_u;
                    }
                    ?>
                    <?php if (!empty($_SESSION['datos_compra'])) { ?>
                        <tr class="text-center">
                            <th colspan="5">DATOS DE COMPRA</th>
                        </tr>
                        <?php
                        foreach ($_SESSION['datos_compra'] as $indice => $datos_compra) { ?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">
                                    <?php echo "Fecha de Compra: " . $datos_compra['fecha_compra'] ?><br>
                                    <?php echo "Compr. Nro: " . $datos_compra['nro_comprobante'] ?><br>
                                </td>
                                <td colspan="1" class="text-center">
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="nro_comprobante" id="nro_comprobante"
                                            value="<?php echo openssl_encrypt($datos_compra['nro_comprobante'], COD, KEY) ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAgregar"
                                            value="limpiar_fecha_comprobante">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Por favor ingrese una fecha y nro de comprobante
                        </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION['proveedor'])) { ?>
                        <tr class="text-center">
                            <th colspan="5">DATOS DE PROVEEDOR</th>
                        </tr>
                        <?php
                        foreach ($_SESSION['proveedor'] as $indice => $proveedor) { ?>
                            <tr>
                                <td colspan="3">
                                    <?php echo "RAZON SOCIAL: " . $proveedor['razon_social_proveedor'] ?><br>
                                    <?php echo "CUIT: " . $proveedor['cuit_proveedor'] ?><br>
                                </td>
                                <td colspan="2" class="text-center">
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="id_proveedor" id="id_proveedor"
                                            value="<?php echo openssl_encrypt($proveedor['id_proveedor'], COD, KEY) ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAgregar"
                                            value="limpiar_campo">Limpiar campo</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Por favor seleccione un proveedor
                        </div>
                    <?php } ?>
                    <?php if (!empty($_SESSION['compra']) || !empty($_SESSION['nuevo_producto'])) { ?>
                        <tr class="text-center">
                            <th colspan="5">DETALLE DE COMPRA</th>
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
                        foreach ($_SESSION['compra'] as $indice => $producto) { ?>
                            <tr>
                                <td width="40%">
                                    <?php echo $producto['nombre_producto'] ?>
                                </td>
                                <td width="15%">
                                    <?php echo $producto['cantidad_compra'] ?>
                                </td>
                                <td width="20%">$
                                    <?php echo $producto['precio_unitario'] ?>
                                </td>
                                <td width="20%">$
                                    <?php echo number_format($producto['precio_unitario'] * $producto['cantidad_compra'], 2); ?>
                                </td>
                                <td width="5%">
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="id_product" id="id_product"
                                            value="<?php echo $producto['id_producto'] ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAgregar"
                                            value="eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $total = $total + ($producto['precio_unitario'] * $producto['cantidad_compra']);
                        }
                        foreach ($_SESSION['nuevo_producto'] as $indice => $prod_nuevo) { ?>
                            <tr>
                                <td width="40%">
                                    <?php echo $prod_nuevo['nombre_producto'] ?>
                                </td>
                                <td width="15%">
                                    <?php echo $prod_nuevo['cantidad_compra'] ?>
                                </td>
                                <td width="20%">$
                                    <?php echo $prod_nuevo['precio_unitario'] ?>
                                </td>
                                <td width="20%">$
                                    <?php echo number_format($prod_nuevo['precio_unitario'] * $prod_nuevo['cantidad_compra'], 2); ?>
                                </td>
                                <td width="5%">
                                    <form action="modals_querys.php" method="post">
                                        <input type="hidden" name="id_product" id="id_product"
                                            value="<?php echo $prod_nuevo['id_producto'] ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="btnAgregar"
                                            value="eliminar_nuevo">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $total1 = $total1 + ($prod_nuevo['precio_unitario'] * $prod_nuevo['cantidad_compra']);
                        }
                        ?>
                        <tr>
                            <td colspan="3" align="right">
                                <h4>Total</h4>
                            </td>
                            <td colspan="2" align="right">
                                <h4>$
                                    <?php echo number_format($total + $total1, 2); ?>
                                </h4>
                            </td>
                        </tr>
                        <?php if ((!empty($_SESSION['compra']) || !empty($_SESSION['nuevo_producto'])) && !empty($_SESSION['proveedor']) && !empty($_SESSION['datos_compra'])) { ?>
                            <tr>
                                <td colspan="5">
                                    <form action="modals_querys.php" method="post">
                                        <div class="alert alert-primary" role="alert">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" name="btnAgregar"
                                                    value="proceder">Guardar compra</button>
                                            </div>
                                            <small id="emailHelp" class="form-text text-muted">
                                                Usted esta por generar un nuevo registro de compra.
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
                    <a href="compras.php" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
        <!-- FIN CONTENIDO -->
        <?php include './modal/modals_compras.php'; ?>
    <script>
        let seleccion_proveedor = document.querySelector("#seleccion_proveedor")
        let seleccion_producto_compra = document.querySelector("#seleccion_producto_compra")
        let producto_agregar = document.getElementById('producto_agregar')
        let fecha_comprobante = document.getElementById('fecha_comprobante')
    </script>
    <?php include './includes/footer.php'; ?>