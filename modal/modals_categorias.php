<!-- CATEGORIAS -->
<!-- Modal nueva CATEGORIA -->
<div class="modal fade" id="categorias_agregar" tabindex="-1" aria-labelledby="categorias_agregarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="categorias_agregarLabel">CREAR NUEVA CATEGORIA</h5>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <div class="mb-2">
                        <label for="nombre_categoria" class="form-label">Nombre</label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion_categoria" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion_categoria" id="descripcion_categoria" class="form-control"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="categorias_agregar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar CATEGORIA-->
<div class="modal fade" id="categorias_editar" tabindex="-1" aria-labelledby="categorias_editarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="categorias_editarLabel">EDITAR CATEGORIA</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_categoria" id="id_categoria">

                    <div class="mb-2">
                        <label for="nombre_categoria" class="form-label">Nombre</label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="descripcion_categoria" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion_categoria" id="descripcion_categoria"
                            class="form-control form-control-sm" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="categorias_editar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal eliminar CATEGORIA -->
<div class="modal fade" id="categorias_eliminar" tabindex="-1" aria-labelledby="categorias_eliminarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="categorias_eliminarLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Desea eliminar esta categoria?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_categoria" id="id_categoria">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="categorias_eliminar" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal CATEGORIAS DESABILITADAS -->
<div class="modal fade" id="categorias_desabilitadas" tabindex="-1" aria-labelledby="categorias_desabilitadasLabel"
    aria-hidden="true">
    <?php
    $sql_categorias_desabilitadas = "SELECT id_categoria,nombre_categoria FROM categorias WHERE estado_categoria = 0";
    $result_cat_desab = mysqli_query($conexion, $sql_categorias_desabilitadas);
    $row_cnt = mysqli_num_rows($result_cat_desab);
    ?>
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="categorias_desabilitadasLabel">Categorias desabilitadas</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <?php
                    if ($row_cnt == 0) {
                        echo 'No hay categorias desabilitadas';
                    }
                    ?>
                </p>
                <form action="modals_querys.php" method="post">
                    <?php while ($row_cat = $result_cat_desab->fetch_assoc()) { ?>
                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Tipo de Categoria</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <?= $row_cat['nombre_categoria'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="frutas[]"
                                                value="<?= $row_cat['id_categoria'] ?>"
                                                id="<?= $row_cat['id_categoria'] ?>">
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
                            echo '<button type="submit" name="categorias_habilitar" class="btn btn-success">Guardar cambios</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>