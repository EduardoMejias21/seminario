<!-- MODALES CLIENTES (INICIO) -->
<!-- Modal nuevo cliente -->
<div class="modal fade" id="agregar_cliente" tabindex="-1" aria-labelledby="agregar_clienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="agregar_clienteLabel">AGREGAR CLIENTE</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                <div class="mb-3">
                        <label for="nombre_persona" class="form-label">Nombre</label>
                        <input type="text" name="nombre_persona" id="nombre_persona" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_persona" class="form-label">Apellido</label>
                        <input name="apellido_persona" id="apellido_persona" class="form-control" rows="3"
                            required></input>
                    </div>
                    <div class="mb-3">
                        <label for="cuil_persona" class="form-label">Cuil/Cuit</label>
                        <input name="cuil_persona" id="cuil_persona" class="form-control" rows="3" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nac_persona" class="form-label">Fecha Nacimiento</label>
                        <input type="date" name="fecha_nac_persona" id="fecha_nac_persona" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="sexo_persona" class="form-label">Sexo</label>
                        <select name="sexo_persona" id="sexo_persona" class="form-control" required>
                            <option value="">Seleccione:</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="I">Indefinido</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="num_telefono" class="form-label">Numero de Telefono</label>
                        <input name="num_telefono" id="num_telefono" class="form-control" rows="3" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="domicilio_fiscal" class="form-label">Domicilio Fiscal</label>
                        <input type="text" name="domicilio_fiscal" id="domicilio_fiscal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="condicion_iva" class="form-label">Condicion Frente al IVA</label>
                        <input type="text" name="condicion_iva" id="condicion_iva" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardar_cliente" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal ver cliente -->
<div class="modal fade" id="ver_usuario" tabindex="-1" aria-labelledby="ver_usuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="ver_usuarioLabel">VER MAS</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="id_cliente_mostrar" name="id_cliente_mostrar">

                    <div class="mb-2">
                        <label for="nombre_persona" class="form-label">Nombre</label>
                        <input name="nombre_persona" id="nombre_persona" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="apellido_persona" class="form-label">Apellido</label>
                        <input name="apellido_persona" id="apellido_persona" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="cuil_persona" class="form-label">Cuil/Cuit</label>
                        <input name="cuil_persona" id="cuil_persona" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="fecha_nac_persona" class="form-label">Fecha Nacimiento</label>
                        <input name="fecha_nac_persona" id="fecha_nac_persona" class="form-control" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="sexo_persona" class="form-label">Sexo</label>
                        <input name="sexo_persona" id="sexo_persona" class="form-control" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="num_telefono" class="form-label">Telefono</label>
                        <input name="num_telefono" id="num_telefono" class="form-control" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" id="correo" class="form-control" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="domicilio_fiscal" class="form-label">Domicilio Fiscal</label>
                        <input name="domicilio_fiscal" id="domicilio_fiscal" class="form-control" readonly="readonly">
                    </div>
                    <div class="mb-2">
                        <label for="condicion_iva" class="form-label">Condicion frente al IVA</label>
                        <input name="condicion_iva" id="condicion_iva" class="form-control" readonly="readonly">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar cliente -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="editarLabel">EDITAR USUARIO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" id="id_cliente_mostrar" name="id_cliente_mostrar">
                    <div class="mb-2">
                        <label for="nombre_persona" class="form-label">Nombre:</label>
                        <input type="text" name="nombre_persona" id="nombre_persona"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="apellido_persona" class="form-label">Apellido</label>
                        <input name="apellido_persona" id="apellido_persona" class="form-control form-control-sm"
                            required>
                    </div>

                    <div class="mb-2">
                        <label for="cuil_persona" class="form-label">Cuil</label>
                        <input name="cuil_persona" id="cuil_persona" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="fecha_nac_persona" class="form-label">Fecha Nacimiento</label>
                        <input name="fecha_nac_persona" id="fecha_nac_persona" class="form-control form-control-sm"
                            required>
                    </div>

                    <div class="mb-2">
                        <label for="sexo_persona" class="form-label">Sexo</label>
                        <input name="sexo_persona" id="sexo_persona" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label for="num_telefono" class="form-label">Numero de Telefono</label>
                        <input name="num_telefono" id="num_telefono" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" id="correo" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label for="domicilio_fiscal" class="form-label">Domicilio Fiscal</label>
                        <input name="domicilio_fiscal" id="domicilio_fiscal" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label for="condicion_iva" class="form-label">Condicion frente al IVA</label>
                        <input name="condicion_iva" id="condicion_iva" class="form-control form-control-sm" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="cliente_editar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar cliente -->
<div class="modal fade" id="usuario_eliminar" tabindex="-1" aria-labelledby="usuario_eliminarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="usuario_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea desabilitar este cliente?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_persona" id="id_persona">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="eliminar_cliente" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal clientes DESABILITADOS -->
<div class="modal fade" id="clientes_desabilitados" tabindex="-1" aria-labelledby="clientes_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_cli_desab = "SELECT personas.id_persona,nombre_persona, apellido_persona,cuil_persona FROM personas INNER JOIN clientes ON personas.id_persona = clientes.id_persona WHERE estado_cliente = 0";
    $result_cli_desab = mysqli_query($conexion, $sql_cli_desab);
    $row_cnt = mysqli_num_rows($result_cli_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="clientes_desabilitadosLabel">Clientes desabilitados</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay usuarios desabilitados';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_usu = mysqli_fetch_assoc($result_cli_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Razon Social</th>
                                    <th>Cuil/Cuit</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <?= $row_usu['nombre_persona'].' '.$row_usu['apellido_persona'] ?>
                                    </td>
                                    
                                    <td>
                                        <?= $row_usu['cuil_persona'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="personas[]"
                                                value="<?= $row_usu['id_persona'] ?>"
                                                id="<?= $row_usu['id_persona'] ?>">
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
                            echo '<button type="submit" name="habilitar_cliente" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>