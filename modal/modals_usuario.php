<!-- MODALES USUARIO (INICIO) -->
<!-- Modal nuevo usuario -->
<div class="modal fade" id="agregar_usuario" tabindex="-1" aria-labelledby="agregar_usuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="agregar_usuarioLabel">AGREGAR USUARIO</h3>
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
                        <label for="cuil_persona" class="form-label">Cuil</label>
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
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave_usuario" class="form-label">Clave</label>
                        <input type="password" name="clave_usuario" id="clave_usuario" class="form-control" required>
                        <input type="checkbox" id="mostrar_contrasena" title="click para mostrar contraseña">
                        <label for="mostrar_contrasena">Mostrar contraseña</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardar_usuario" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar usuario -->
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
                    <input type="hidden" id="id_persona_mostrar" name="id_persona_mostrar">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="usuario_editar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal ver usuario -->
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
                    <input type="hidden" id="id_persona_mostrar" name="id_persona_mostrar">
                    <div class="mb-2">
                        <label for="nombre_usuario" class="form-label">Usuario</label>
                        <input name="nombre_usuario" id="nombre_usuario" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="nombre_persona" class="form-label">Nombre</label>
                        <input name="nombre_persona" id="nombre_persona" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="apellido_persona" class="form-label">Apellido</label>
                        <input name="apellido_persona" id="apellido_persona" class="form-control" readonly="readonly">
                    </div>

                    <div class="mb-2">
                        <label for="cuil_persona" class="form-label">Cuil</label>
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
                        <label for="fecha_creacion_usuario" class="form-label">Fecha de Alta</label>
                        <input name="fecha_creacion_usuario" id="fecha_creacion_usuario" class="form-control"
                            readonly="readonly">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal usuarios DESABILITADOS -->
<div class="modal fade" id="usuarios_desabilitados" tabindex="-1" aria-labelledby="usuarios_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_usuarios_desabilitadas = "SELECT personas.id_persona,id_usuario,nombre_usuario,nombre_persona, apellido_persona FROM usuarios INNER JOIN personas ON usuarios.id_persona = personas.id_persona WHERE estado_usuario = 0";
    $result_usuarios_desab = mysqli_query($conexion, $sql_usuarios_desabilitadas);
    $row_cnt = mysqli_num_rows($result_usuarios_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="usuarios_desabilitadosLabel">Usuarios desabilitados</h3>
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
                    <?php while ($row_usu = mysqli_fetch_assoc($result_usuarios_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Usuario</th>
                                    <th>Nombre Completo</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <?= $row_usu['nombre_usuario'] ?>
                                    </td>
                                    <td>
                                        <?= $row_usu['nombre_persona'].' '.$row_usu['apellido_persona'] ?>
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
                            echo '<button type="submit" name="habilitar_usuario" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar usuario -->
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
                ¿Desea eliminar este usuario?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_persona" id="id_persona">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="eliminar_usuario" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODALES USUARIO (FIN) -->