<?php
session_start();
require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
$result_sql_id = mysqli_query($conexion,$sql_id);

$row_id = mysqli_fetch_array($result_sql_id);
$sqlproductos = "SELECT * FROM productos INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria  WHERE estado_producto = 1";
$resultado = mysqli_query($conexion, $sqlproductos);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        <h2 class="text-center">PRODUCTOS DESTACADOS</h2>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <div class="row justify-content-center">
            <div class="col-auto">
            <strong>EN ESTA SESION PODRAS ELEGIR LOS PRODUCTOS DESTACADOS QUE DESEAS MOSTRAR EN EL INICIO</strong>
            </div>
        </div>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Tipo de Producto</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                    <!-- <th width="45%">Descripción</th> -->
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nombre_producto']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['nombre_categoria']; ?>
                        </td>
                        <td class="text-center">
                            <?php 
                            $sql_foto = "SELECT id_foto,img_foto, estado_foto FROM productos_fotos WHERE id_producto = $row[id_producto] GROUP BY id_producto";
                            $result_foto = mysqli_query($conexion, $sql_foto);
                            $fila = mysqli_fetch_assoc($result_foto);
                            if($fila['img_foto']== NULL || $fila['estado_foto']==0){
                                echo 'Sin fotos';
                            }else{
                                echo '<img src="'.$fila['img_foto'].'" width="50" height="50">';
                            }
                            ?>
                        </td class="text-center">
                        <td class="text-center">
                            <?php
                            if ($row['mostrar_producto'] == 1) {
                                ?><i class="fa-solid fa-circle" style="color: #2bff00;"></i><?php $c=1;
                            } else {
                                ?><i class="fa-solid fa-circle" style="color: #ff0000;"></i><?php $c=0;
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <!-- Mostrar en index -->
                            <?php 
                            if($c == 1){
                                ?>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ocultar_producto" data-bs-id="<?= $row['id_producto']?>"
                                title="Ocultar"><i class="fa-solid fa-trash" style="color: #ffffff;"> </i></a>
                                <?php
                            }else{
                                ?>
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#mostrar_producto" data-bs-id="<?= $row['id_producto']?>"
                                title="Mostrar"><i class="fa-solid fa-trash" style="color: #ffffff;"> </i></a>
                                <?php
                            }?>
                            <!-- Ver fotos -->
                            <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fotos_agregar" data-bs-id="<?= $row['id_producto']?>"
                                title="Agregar"><i class="fa-solid fa-image" style="color: #ffffff;"> </i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="principal.php" class="btn btn-primary" >Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './modal/modals_productos_dest.php'; ?>

    <script type="text/javascript">
        let mostrar_producto = document.getElementById('mostrar_producto')
        mostrar_producto.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            mostrar_producto.querySelector('.modal-footer #id_producto').value = id
        })
        let ocultar_producto = document.getElementById('ocultar_producto')
        ocultar_producto.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            ocultar_producto.querySelector('.modal-footer #id_producto').value = id
        })
        let fotos_agregar = document.getElementById('fotos_agregar')
        fotos_agregar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            fotos_agregar.querySelector('.modal-footer #id_product').value = id
        })
    </script>
<?php include './includes/footer.php'; ?>