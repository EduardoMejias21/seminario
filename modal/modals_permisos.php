<!-- MODALES PERMISOS (INICIO) -->
<!-- Modal permisos DESABILITADOS -->
<div class="modal fade" id="permisos_desabilitados" tabindex="-1" aria-labelledby="permisos_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_permisos_desabilitados = "SELECT id_modulo,nombre_modulo FROM modulos WHERE estado_modulo = 0";
    $result_permisos_desab = mysqli_query($conexion, $sql_permisos_desabilitados);
    $row_cnt = mysqli_num_rows($result_permisos_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="permisos_desabilitadosLabel">Permisos desabilitados</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay permisos desabilitados';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_perm = mysqli_fetch_assoc($result_permisos_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="50%">Permiso</th>
                                    <th width="50%">Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="text-center">
                                        <?= $row_perm['nombre_modulo'] ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="permisos[]"
                                                value="<?= $row_perm['id_modulo'] ?>"
                                                id="<?= $row_perm['id_modulo'] ?>">
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
                            echo '<button type="submit" name="permiso_habilitar" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar permiso -->
<div class="modal fade" id="permiso_eliminar" tabindex="-1" aria-labelledby="permiso_eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="permiso_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Desea eliminar este permiso?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo $id_modulo; ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="permiso_eliminar" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal nuevo permiso -->
<div class="modal fade" id="permiso_agregar" tabindex="-1" aria-labelledby="permiso_agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="permiso_agregarLabel">AGREGAR PERMISO</h5>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="nombre_modulo" class="form-label">Nombre Permiso</label>
                        <input type="text" name="nombre_modulo" id="nombre_modulo" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="permiso_agregar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

