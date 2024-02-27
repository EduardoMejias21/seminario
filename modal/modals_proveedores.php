<!-- PROVEEDORES -->
<!-- Modal ver PROVEEDOR -->
<div class="modal fade" id="proveedor_ver" tabindex="-1" aria-labelledby="proveedor_verLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="proveedor_verLabel">VER MAS</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="id_proveedor" name="id_proveedor">
                    <div class="mb-2">
                        <label for="razon_social_proveedor" class="form-label">Razon Social</label>
                        <input name="razon_social_proveedor" id="razon_social_proveedor"
                            class="form-control form-control-sm" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="cuit_proveedor" class="form-label">Cuit</label>
                        <input name="cuit_proveedor" id="cuit_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="condicion_iva_proveedor" class="form-label">Condicion IVA</label>
                        <input name="condicion_iva_proveedor" id="condicion_iva_proveedor"
                            class="form-control form-control-sm" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="telefono_proveedor" class="form-label">Telefono</label>
                        <input name="telefono_proveedor" id="telefono_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="correo_proveedor" class="form-label">Correo</label>
                        <input name="correo_proveedor" id="correo_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="domicilio_proveedor" class="form-label">Domicilio</label>
                        <input name="domicilio_proveedor" id="domicilio_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="pais_proveedor" class="form-label">Pais</label>
                        <input name="pais_proveedor" id="pais_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="provincia_proveedor" class="form-label">Provincia</label>
                        <input name="provincia_proveedor" id="provincia_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="localidad_proveedor" class="form-label">Localidad</label>
                        <input name="localidad_proveedor" id="localidad_proveedor" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="nombre_usuario" class="form-label">Usuario Alta</label>
                        <input name="nombre_usuario" id="nombre_usuario" class="form-control form-control-sm"
                            readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="fecha_alta_proveedor" class="form-label">Fecha de Alta</label>
                        <input name="fecha_alta_proveedor" id="fecha_alta_proveedor"
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
<!-- Modal nuevo PROVEEDOR -->
<div class="modal fade" id="proveedor_agregar" tabindex="-1" aria-labelledby="proveedor_agregarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="proveedor_agregarLabel">CREAR NUEVO PROVEEDOR</h5>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $row_id['id_usuario'] ?>">
                    <div class="mb-2">
                        <label for="razon_social_proveedor" class="form-label">Razon Social</label>
                        <input type="text" name="razon_social_proveedor" id="razon_social_proveedor"
                            class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="cuit_proveedor" class="form-label">CUIT</label>
                        <input type="text" name="cuit_proveedor" id="cuit_proveedor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="condicion_iva_proveedor" class="form-label">CONDICION IVA</label>
                        <input type="text" name="condicion_iva_proveedor" id="condicion_iva_proveedor"
                            class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="telefono_proveedor" class="form-label">TELEFONO</label>
                        <input type="text" name="telefono_proveedor" id="telefono_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="correo_proveedor" class="form-label">CORREO</label>
                        <input type="text" name="correo_proveedor" id="correo_proveedor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="domicilio_proveedor" class="form-label">DOMICILIO</label>
                        <input type="text" name="domicilio_proveedor" id="domicilio_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="pais_proveedor" class="form-label">PAIS</label>
                        <input type="text" name="pais_proveedor" id="pais_proveedor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="provincia_proveedor" class="form-label">PROVINCIA</label>
                        <input type="text" name="provincia_proveedor" id="provincia_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="localidad_proveedor" class="form-label">LOCALIDAD</label>
                        <input type="text" name="localidad_proveedor" id="localidad_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="proveedor_agregar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar PROVEEDOR-->
<div class="modal fade" id="proveedor_editar" tabindex="-1" aria-labelledby="proveedor_editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="proveedor_editarLabel">EDITAR PROVEEDOR</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_proveedor" id="id_proveedor">

                    <div class="mb-2">
                        <label for="razon_social_proveedor" class="form-label">Razon Social</label>
                        <input type="text" name="razon_social_proveedor" id="razon_social_proveedor"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="cuit_proveedor" class="form-label">Cuit</label>
                        <input type="text" name="cuit_proveedor" id="cuit_proveedor"
                            class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label for="condicion_iva_proveedor" class="form-label">Condicion Iva</label>
                        <input type="text" name="condicion_iva_proveedor" id="condicion_iva_proveedor"
                            class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="telefono_proveedor" class="form-label">Telefono</label>
                        <input type="text" name="telefono_proveedor" id="telefono_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="correo_proveedor" class="form-label">Correo</label>
                        <input type="text" name="correo_proveedor" id="correo_proveedor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="domicilio_proveedor" class="form-label">Domicilio</label>
                        <input type="text" name="domicilio_proveedor" id="domicilio_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="pais_proveedor" class="form-label">Pais</label>
                        <input type="text" name="pais_proveedor" id="pais_proveedor" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="provincia_proveedor" class="form-label">Provincia</label>
                        <input type="text" name="provincia_proveedor" id="provincia_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="localidad_proveedor" class="form-label">Localidad</label>
                        <input type="text" name="localidad_proveedor" id="localidad_proveedor" class="form-control"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="proveedor_editar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar PROVEEDOR -->
<div class="modal fade" id="proveedor_eliminar" tabindex="-1" aria-labelledby="proveedor_eliminarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="proveedor_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Desea eliminar este proveedor?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_proveedor" id="id_proveedor">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="proveedor_eliminar" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal PROVEEDOR DESABILITADOS -->
<div class="modal fade" id="proveedores_desabilitados" tabindex="-1" aria-labelledby="proveedores_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_proveedores_desabilitadas = "SELECT id_proveedor,razon_social_proveedor, cuit_proveedor FROM proveedores WHERE estado_proveedor = 0";
    $result_proveedores_desab = mysqli_query($conexion, $sql_proveedores_desabilitadas);
    $row_cnt = mysqli_num_rows($result_proveedores_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="proveedores_desabilitadosLabel">Proveedores desabilitados</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay proveedores desabilitados';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_proveedor = $result_proveedores_desab->fetch_assoc()) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Razon Social</th>
                                    <th>Cuit</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <?= $row_proveedor['razon_social_proveedor'] ?>
                                    </td>
                                    <td>
                                        <?= $row_proveedor['cuit_proveedor'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="proveedores[]"
                                                value="<?= $row_proveedor['id_proveedor'] ?>"
                                                id="<?= $row_proveedor['id_proveedor'] ?>">
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
                            echo '<button type="submit" name="proveedor_habilitar" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>