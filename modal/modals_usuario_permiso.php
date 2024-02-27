<!-- MODALES USUARIOS PERMISOS (INICIO) -->
<!-- Modal permiso eliminar usuario -->
<div class="modal fade" id="permiso_eliminar_usuario" tabindex="-1" aria-labelledby="permiso_eliminar_usuarioLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="permiso_eliminar_usuarioLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Seguro desea desabilitar este permiso?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo $id_modulo; ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="permiso_eliminar_usuario" class="btn btn-danger">Desabilitar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal permisos DESABILITADOS usuario -->
<div class="modal fade" id="permisos_usuarios_desabilitados" tabindex="-1" aria-labelledby="permisos_usuarios_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_usu_perm_desab = "SELECT usuario_modulos.id_usuario,usuario_modulos.id_modulo,nombre_modulo FROM `usuario_modulos` INNER JOIN modulos ON usuario_modulos.id_modulo = modulos.id_modulo WHERE `estado` = 0 AND `id_usuario`=$id";
    $result_usu_perm_desab = mysqli_query($conexion, $sql_usu_perm_desab);
    $row_cnt = mysqli_num_rows($result_usu_perm_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="permisos_usuarios_desabilitadosLabel">Permisos desabilitados</h3>
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
                    <?php while ($row_perm = mysqli_fetch_assoc($result_usu_perm_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="90%">Permiso</th>
                                    <th width="10%">Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="text-center">
                                        <?= $row_perm['nombre_modulo'] ?>
                                    </td>
                                    <td width="10%">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="permisos[]"
                                                value="<?= $row_perm['id_modulo'] ?>"
                                                id="<?= $row_perm['id_modulo'] ?>">
                                                <input type="hidden" name="id_usuario" value="<?= $row_perm['id_usuario']?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <?php } ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <?php
                        if ($row_cnt == 0) {
                        } else {
                            echo '<button type="submit" name="permiso_habilitar_usuario" class="btn btn-sm btn-success">Habilitar</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal asignar permiso -->
<div class="modal fade" id="permiso_asignar" tabindex="-1" aria-labelledby="permiso_asignarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="permiso_asignarLabel">ASIGNAR PERMISO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                
                    <div class="mb-3">
                        <select name="modulos" id="modulos" class="form-select">
                            <option>Seleccione el permiso</option>
                            <?php 
                            
                            $sql1 = "SELECT modulos.id_modulo,nombre_modulo 
                                        FROM modulos WHERE modulos.id_modulo!=ALL(
                                            SELECT usuario_modulos.id_modulo 
                                                FROM usuario_modulos WHERE id_usuario=$id)";
                            $resultado = mysqli_query($conexion, $sql1);
                            
                            while ($row = mysqli_fetch_assoc($resultado)) {
                            ?>
                            <option value="<?php echo $row['id_modulo'].','.$row['nombre_modulo'] ?>"><?=$row['nombre_modulo'] ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="permiso_asignar" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Asignar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODALES USUARIOS PERMISOS (FIN) -->