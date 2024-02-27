<!-- COMPRAS -->
<!-- MODAL SELECCIONE UN PROVEEDOR -->
<div class="modal fade" id="seleccion_proveedor" tabindex="-1" aria-labelledby="seleccion_proveedorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="seleccion_proveedorLabel">SELECCIONE UN PROVEEDOR</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-light table-bordered " id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Razon Social</th>
                            <th>Cuit</th>
                            <th>Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql_proveedor = "SELECT id_proveedor, razon_social_proveedor,cuit_proveedor FROM proveedores WHERE estado_proveedor = 1";
                        $result_proveedor = mysqli_query($conexion, $sql_proveedor);
                        $num = 0;
                        while ($row_prov = mysqli_fetch_assoc($result_proveedor)) {
                            $num = $num + 1;
                            ?>
                            <tr class="text-center">
                                <td>
                                    <?php echo $num; ?>
                                </td>
                                <td>
                                    <?php echo $row_prov['razon_social_proveedor'] ?>
                                </td>
                                <td>
                                    <?php echo $row_prov['cuit_proveedor'] ?>
                                </td>

                                <form action="modals_querys.php" method="post">
                                    <input type="hidden" name="id_proveedor" id="id_proveedor"
                                        value="<?php echo openssl_encrypt($row_prov['id_proveedor'], COD, KEY) ?>">
                                    <input type="hidden" name="razon_social_proveedor" id="razon_social_proveedor"
                                        value="<?php echo $row_prov['razon_social_proveedor'] ?>">
                                    <input type="hidden" name="cuit_proveedor" id="cuit_proveedor"
                                        value="<?php echo $row_prov['cuit_proveedor'] ?>">
                                    <td>
                                        <button class="btn btn-sm btn-primary" name="btnAgregar" value="agregar_proveedor"
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
<!-- MODAL SELECCIONE UN PRODUCTO -->
<div class="modal fade" id="seleccion_producto_compra" tabindex="-1" aria-labelledby="seleccion_producto_compraLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="seleccion_producto_compraLabel">SELECCIONE UN PRODUCTO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-header">
                    <button class="btn btn-success" data-bs-target="#producto_agregar" data-bs-toggle="modal"> Nuevo
                        producto</button>
                </div>
                <table class="table table-light table-bordered " id="table">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">#</th>
                            <th width="40%">Producto</th>
                            <th width="10%">Cantidad</th>
                            <th width="20%">Precio Unitario</th>
                            <th width="10%">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_compra = "SELECT id_producto as id_product,nombre_producto FROM productos ";
                        $result_compra = mysqli_query($conexion, $sql_compra);
                        $num = 0;
                        while ($row_compra = mysqli_fetch_assoc($result_compra)) {
                            $num = $num + 1;
                            ?>
                            <tr class="text-center">
                                <td>
                                    <?php echo $num ?>
                                </td>
                                <td>
                                    <?php echo $row_compra['nombre_producto'] ?>

                                </td>
                                <form action="modals_querys.php" method="post">
                                    <input type="hidden" name="id_usuario" id="id_usuario"
                                        value="<?php echo $row_id['id_usuario'] ?>">
                                    <input type="hidden" name="id_product" id="id_product"
                                        value="<?php echo $row_compra['id_product'] ?>">
                                    <input type="hidden" name="nombre_producto" id="nombre_producto"
                                        value="<?php echo $row_compra['nombre_producto'] ?>">
                                    <td>
                                        <input type="number" name="cantidad_compra" id="cantidad_compra"
                                            class="form-control form-control-sm" value="1">
                                    </td>
                                    <td>
                                        <input type="" name="precio_unitario" id="precio_unitario"
                                            class="form-control form-control-sm" value="" placeholder="$">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" name="btnAgregar" value="agregar"
                                            type="submit">Agregar</button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal producto agregar -->
<div class="modal fade" id="producto_agregar" tabindex="-1" aria-labelledby="producto_agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="productos_agregarLabel">AGREGAR NUEVO PRODUCTO</h5>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $row_id['id_usuario'] ?>">
                    <div class="mb-2">
                        <label for="nombre_producto" class="form-label">Nombre</label>
                        <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion_producto" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="text" name="precio_unitario" id="precio_unitario" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="cantidad_compra" class="form-label">Cantidad</label>
                        <input type="text" name="cantidad_compra" id="cantidad_compra" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="nombre_categoria" class="form-label">Tipo de Producto</label>
                        <select name="categorias" id="categorias" class="form-select">
                            <option value="">Seleccione una categoria</option>
                            <?php
                            $sql1 = "SELECT id_categoria, nombre_categoria 
                                        FROM categorias WHERE estado_categoria = 1 ";
                            $resultado = mysqli_query($conexion, $sql1);

                            while ($row = mysqli_fetch_assoc($resultado)) {
                                ?>
                                <option value="<?php echo $row['id_categoria'] ?>">
                                    <?= $row['nombre_categoria'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#seleccion_producto_compra"
                            data-bs-toggle="modal">Volver</button>
                        <button type="submit" name="btnAgregar" value="guardar_producto" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL INGRESAR FECHA Y N° COMPROBANTE -->
<div class="modal fade" id="fecha_comprobante" tabindex="-1" aria-labelledby="fecha_comprobanteLabel" aria-hidden="true" >
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="fecha_comprobanteLabel">INGRESE LA FECHA Y N° DE COMPROBANTE</h3>
                    <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="modals_querys.php" method="post">
                        <div class="mb-2">
                            <label for="fecha_compra" class="form-label">Fecha</label>
                            <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="nro_comprobante" class="form-label">Numero de Comprobante</label>
                            <input type="text" name="nro_comprobante" id="nro_comprobante" class="form-control"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" name="btnAgregar" value="fecha_comprobante"
                                type="submit">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>