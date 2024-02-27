<!-- Modal mostrar productos -->
<div class="modal fade" id="mostrar_producto" tabindex="-1" aria-labelledby="mostrar_productoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="mostrar_productoLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Seguro desea mostrar este producto?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_producto" id="id_producto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="mostrar_producto" class="btn btn-success">Mostrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal ocultar productos -->
<div class="modal fade" id="ocultar_producto" tabindex="-1" aria-labelledby="ocultar_productoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="ocultar_productoLabel">Aviso</h3>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                ¿Seguro desea quitar este producto?
            </div>
            <div class="modal-footer">
                <form action="modals_querys.php" method="post">
                    <input type="hidden" name="id_producto" id="id_producto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="ocultar_producto" class="btn btn-danger">Ocultar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal  FOTO -->
<div class="modal fade" id="fotos_agregar" tabindex="-1" aria-labelledby="fotos_agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="fotos_agregarLabel">AGREGAR FOTO</h5>
                <button type="button" class="fa-solid fa-xmark" style="border: none;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modals_querys.php" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="archivo" class="form-label">Ingresar imagen</label>
                        <input type="file" name="archivo" id="archivo">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_product" id="id_product">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="fotos_agregar" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>