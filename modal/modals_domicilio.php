<!-- MODALES DOMICILIO (INICIO) -->
<!-- Modal nuevo domicilo -->
<div class="modal fade" id="dom_agregar" tabindex="-1" aria-labelledby="dom_agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="dom_agregarLabel">AGREGAR DOMICILIO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="mb-2">
                        <label for="pais_dom" class="form-label">Pais</label>
                        <input type="text" name="pais_dom" id="pais_dom" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="provincia_dom" class="form-label">Provincia</label>
                        <input type="text" name="provincia_dom" id="provincia_dom" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="calle_dom" class="form-label">Calle</label>
                        <input type="text" name="calle_dom" id="calle_dom" class="form-control" required></input>
                    </div>
                    <div class="mb-2">
                        <label for="altura_dom" class="form-label">Altura</label>
                        <input type="text" name="altura_dom" id="altura_dom" class="form-control" required></input>
                    </div>
                    <div class="mb-2">
                        <label for="coordenadas_dom" class="form-label">Coordenadas</label>
                        <input type="text" name="coordenadas_dom" id="coordenadas_dom" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="descripcion_dom" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion_dom" id="descripcion_dom" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardar_dom" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal edita registro -->
<div class="modal fade" id="dom_editar" tabindex="-1" aria-labelledby="dom_editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="dom_editarLabel">EDITAR DOMICILIO</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="id_dom_editar" id="id_dom_editar">

                    <div class="mb-2">
                        <label for="pais_dom" class="form-label">Pais:</label>
                        <input type="text" name="pais_dom" id="pais_dom" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="provincia_dom" class="form-label">Provincia:</label>
                        <input name="provincia_dom" id="provincia_dom" class="form-control form-control-sm"
                            required></input>
                    </div>

                    <div class="mb-2">
                        <label for="calle_dom" class="form-label">Calle:</label>
                        <input type="text" name="calle_dom" id="calle_dom" class="form-control form-control-sm"
                            required>
                    </div>

                    <div class="mb-2">
                        <label for="altura_dom" class="form-label">Altura:</label>
                        <input type="text" name="altura_dom" id="altura_dom" class="form-control form-control-sm"
                            required></input>
                    </div>
                    <div class="mb-2">
                        <label for="coordenadas_dom" class="form-label">Coordenadas:</label>
                        <input type="text" name="coordenadas_dom" id="coordenadas_dom"
                            class="form-control form-control-sm"></input>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion_dom" class="form-label">Descripcion:</label>
                        <input type="text" name="descripcion_dom" id="descripcion_dom"
                            class="form-control form-control-sm" required></input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="editar_dom" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar domicilio -->
<div class="modal fade" id="dom_eliminar" tabindex="-1" aria-labelledby="dom_eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="dom_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Seguro desea eliminar el domicilio?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="id_dom" id="id_dom" value="<?php echo $id_dom; ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="eliminar_dom" class="btn btn-danger">Eliminar</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal habilitar domicilio -->
<div class="modal fade" id="dom_habilitar" tabindex="-1" aria-labelledby="dom_habilitarLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="dom_habilitarLabel">Aviso</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea habiliar este domicilio?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="id_dom" id="id_dom" value="<?php echo $id_dom; ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="habilitar_dom" class="btn btn-success">Habiliar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal domicilios DESABILITADOS -->
<div class="modal fade" id="domicilios_desabilitados" tabindex="-1" aria-labelledby="domicilios_desabilitadosLabel"
    aria-hidden="true">
    <?php
    $sql_dom_desabilitadas = "SELECT personas.id_persona,id_dom,pais_dom,provincia_dom,calle_dom,altura_dom,descripcion_dom FROM domicilios INNER JOIN personas ON domicilios.id_persona = personas.id_persona WHERE estado_dom = 0 and personas.id_persona = $id";
    $result_dom_desab = mysqli_query($conexion, $sql_dom_desabilitadas);
    $row_cnt = mysqli_num_rows($result_dom_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="domicilios_desabilitadosLabel">Domicilios desabilitados</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay domicilios desabilitados';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_dom = mysqli_fetch_assoc($result_dom_desab)) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th width="70%">Direccion</th>
                                    <th width="20%">Descripcion</th>
                                    <th width="10%">Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                <td >
                                    <?= $row_dom['provincia_dom'] ?> -
                                    <?= $row_dom['calle_dom'] ?> -
                                    <?= $row_dom['altura_dom'] ?>
                                </td>
                                    <td>
                                        <?= $row_dom['descripcion_dom'] ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="domicilios[]"
                                                value="<?= $row_dom['id_dom'] ?>"
                                                id="<?= $row_dom['id_dom'] ?>">
                                                <input type="hidden" name="id_persona" value="<?= $row_dom['id_persona']?>">
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
                            echo '<button type="submit" name="habilitar_dom" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODALES DOMICILIO (FIN) -->