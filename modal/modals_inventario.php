<!-- PRODUCTOS -->
<!-- Modal ver PRODUCTO -->
<div class="modal fade" id="productos_ver" tabindex="-1" aria-labelledby="productos_verLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="productos_verLabel">VER MAS</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="id_producto" name="id_producto">
                    <div class="mb-2">
                        <label for="nombre_producto" class="form-label">Nombre</label>
                        <input name="nombre_producto" id="nombre_producto" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="nombre_categoria" class="form-label">Tipo de Producto</label>
                        <input name="nombre_categoria" id="nombre_categoria" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="descripcion_producto" class="form-label">Descripcion</label>
                        <input name="descripcion_producto" id="descripcion_producto"
                            class="form-control form-control-sm" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="nombre_usuario" class="form-label">Usuario Alta</label>
                        <input name="nombre_usuario" id="nombre_usuario" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="fecha_creacion_producto" class="form-label">Fecha de Alta</label>
                        <input name="fecha_creacion_producto" id="fecha_creacion_producto"
                            class="form-control form-control-sm" readonly="readonly">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar PRODUCTO-->
<div class="modal fade" id="productos_editar" tabindex="-1" aria-labelledby="productos_editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="productos_editarLabel">EDITAR PRODUCTO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_producto" id="id_producto">

                    <div class="mb-2">
                        <label for="nombre_producto" class="form-label">Nombre</label>
                        <input type="text" name="nombre_producto" id="nombre_producto"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="descripcion_producto" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion_producto" id="descripcion_producto"
                            class="form-control form-control-sm" required>
                    </div>
                    
                    <div class="mb-2">
                        <label for="nombre_categoria" class="form-label">Tipo de Producto</label>
                        <select name="categorias" id="categorias" class="form-select">
                            <?php
                            $sql1 = "SELECT id_categoria, nombre_categoria 
                                        FROM categorias ";
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="editar_productos" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar PRODUCTO -->
<div class="modal fade" id="productos_eliminar" tabindex="-1" aria-labelledby="productos_eliminarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="productos_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Desea eliminar este producto?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_producto" id="id_producto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="productos_eliminar" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal productos DESABILITADOS -->
<div class="modal fade" id="productos_desabilitados" tabindex="-1" aria-labelledby="productos_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_productos_desabilitadas = "SELECT id_producto,nombre_producto, descripcion_producto FROM productos WHERE estado_producto = 0";
    $result_productos_desab = mysqli_query($conexion, $sql_productos_desabilitadas);
    $row_cnt = mysqli_num_rows($result_productos_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="productos_desabilitadosLabel">Productos desabilitados</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay productos desabilitados';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_prod = mysqli_fetch_assoc($result_productos_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Producto</th>
                                    <th>Descripcion</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <?= $row_prod['nombre_producto'] ?>
                                    </td>
                                    <td>
                                        <?= $row_prod['descripcion_producto'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="productos[]"
                                                value="<?= $row_prod['id_producto'] ?>"
                                                id="<?= $row_prod['id_producto'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <?php
                        if ($row_cnt == 0) {
                        } else {
                            echo '<button type="submit" name="producto_habilitar" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>