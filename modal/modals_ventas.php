<!-- VENTAS -->
<!-- MODAL SELECCIONE UN PRODUCTO -->
<div class="modal fade" id="seleccion_producto" tabindex="-1" aria-labelledby="seleccion_productoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="seleccion_productoLabel">SELECCIONE UN PRODUCTO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-light table-bordered " id="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Precio Compra</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Precio Venta</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_venta = "SELECT productos.id_producto as id_prod,nombre_producto,MAX(precio_unitario) as pCompra, cantidad FROM productos LEFT JOIN stock ON productos.id_producto = stock.id_producto INNER JOIN detalle_compras ON stock.id_producto = detalle_compras.id_producto WHERE estado_producto = 1 GROUP BY productos.id_producto";
                        $result_venta = mysqli_query($conexion, $sql_venta);
                        $num = 0;
                        while ($row_prod = mysqli_fetch_assoc($result_venta)) {
                            $num = $num + 1;
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $num ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row_prod['nombre_producto'] ?>

                                </td>
                                <td class="text-center">
                                    <?php echo $row_prod['pCompra'] ?>

                                </td>
                                <form action="modals_querys.php" method="post">
                                    <input type="hidden" name="id_usuario" id="id_usuario"
                                        value="<?php echo $row_id['id_usuario'] ?>">
                                    <input type="hidden" name="id_prod" id="id_prod"
                                        value="<?php echo $row_prod['id_prod']?>">
                                    <input type="hidden" name="nombre_producto" id="nombre_producto"
                                        value="<?php echo $row_prod['nombre_producto'] ?>">
                                    <input type="hidden" name="cantidad" id="cantidad"
                                        value="<?php echo $row_prod['cantidad'] ?>">
                                    <?php
                                    if ($row_prod['cantidad'] > 0) {
                                        ?>
                                        <td class="text-center">
                                            <?php echo $row_prod['cantidad'] ?>
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="precio_venta" id="precio_venta"
                                                class="form-control form-control-sm" value="" placeholder="$" required>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="cantidad_venta" id="cantidad_venta"
                                                class="form-control form-control-sm" value="1">
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" name="btnAccion" value="venta_agregar"
                                                type="submit">Agregar</button>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td class="text-center">Sin stock</td>
                                        <td></td>
                                        <td></td>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SELECCIONE UNA PERSONA -->
<div class="modal fade" id="seleccion_persona" tabindex="-1" aria-labelledby="seleccion_personaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="seleccion_personaLabel">SELECCIONE UNA PERSONA</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-light table-bordered " id="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Cuil</th>
                            <th class="text-center">Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql_persona_venta = "SELECT personas.id_persona,nombre_persona,apellido_persona,cuil_persona,correo,num_telefono,domicilio_fiscal,condicion_iva FROM personas INNER JOIN clientes ON personas.id_persona = clientes.id_persona WHERE estado_cliente = 1 GROUP BY personas.id_persona";
                        $result_persona_venta = mysqli_query($conexion, $sql_persona_venta);
                        $num = 0;
                        while ($row_pers = mysqli_fetch_assoc($result_persona_venta)) {
                            $num = $num + 1;
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $num; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row_pers['nombre_persona'] . ' ' . $row_pers['apellido_persona'] ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row_pers['cuil_persona'] ?>
                                </td>

                                <form action="modals_querys.php" method="post">
                                    <input type="hidden" name="id_persona" id="id_persona"
                                        value="<?php echo openssl_encrypt($row_pers['id_persona'], COD, KEY) ?>">
                                    <input type="hidden" name="nombre_persona" id="nombre_persona"
                                        value="<?php echo $row_pers['nombre_persona'] ?>">

                                    <input type="hidden" name="apellido_persona" id="apellido_persona"
                                        value="<?php echo $row_pers['apellido_persona'] ?>">
                                    <input type="hidden" name="cuil_persona" id="cuil_persona"
                                        value="<?php echo $row_pers['cuil_persona'] ?>">
                                    <input type="hidden" name="correo" id="correo"
                                        value="<?php echo $row_pers['correo'] ?>">
                                    <input type="hidden" name="num_telefono" id="num_telefono"
                                        value="<?php echo $row_pers['num_telefono'] ?>">
                                        <input type="hidden" name="domicilio_fiscal" id="domicilio_fiscal"
                                        value="<?php echo $row_pers['domicilio_fiscal'] ?>">
                                    <input type="hidden" name="condicion_iva" id="condicion_iva"
                                        value="<?php echo $row_pers['condicion_iva'] ?>">
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" name="btnAccion" value="agregar_persona"
                                            type="submit">Agregar</button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>