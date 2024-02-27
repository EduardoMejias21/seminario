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

$sql_stock = "SELECT productos.id_producto,nombre_producto,nombre_categoria,estado_producto,cantidad FROM stock INNER JOIN productos ON stock.id_producto = productos.id_producto INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria  
        WHERE estado_producto = 1";
$resultado = mysqli_query($conexion, $sql_stock);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Inventario</li>
        </ol>
        <h2 class="text-center">INVENTARIO</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#productos_desabilitados"><i class="fa-solid fa-bag-shopping"></i> Productos desabilitados</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Tipo de Prodocto</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $num=0;
                while ($row = $resultado->fetch_assoc()){
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $num=$num+1;?>
                        </td>
                        <td class="text-center">
                            <?= $row['nombre_producto']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['nombre_categoria']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_producto'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?= $row['cantidad'];?>
                        </td>
                        <td class="text-center">
                            <!-- Ver mas productos -->
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#productos_ver" data-bs-id="<?= $row['id_producto']?>" title="Ver mas"><i class="fa-solid fa-eye" style="color: #ffffff;"> </i> </a>
                            <?php
                            //Editar productos
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'productos_editar') {
                                    ?>
                                    <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#productos_editar" data-bs-id="<?= $row['id_producto']?>" title="Editar"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"> </i> </a>
                                    <?php
                                }
                            }
                            //Eliminar productos
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'productos_eliminar') {
                                    ?>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#productos_eliminar" data-bs-id="<?= $row['id_producto']?>"
                                    title="Eliminar"><i class="fa-solid fa-trash" style="color: #ffffff;"> </i></a>
                                    <?php
                                }
                            }
                            ?>
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
    <?php include './modal/modals_inventario.php'; ?>
    
    <script type="text/javascript">
        let productos_ver = document.getElementById('productos_ver')
        productos_ver.addEventListener('hide.bs.modal', event => {
            productos_ver.querySelector('.modal-body #nombre_producto').value = ""
            productos_ver.querySelector('.modal-body #nombre_categoria').value = ""
            productos_ver.querySelector('.modal-body #descripcion_producto').value = ""
            productos_ver.querySelector('.modal-body #nombre_usuario').value = ""
            productos_ver.querySelector('.modal-body #fecha_creacion_producto').value = ""
        })
        productos_ver.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_producto = productos_ver.querySelector('.modal-body #id_producto')
            let nombre_producto = productos_ver.querySelector('.modal-body #nombre_producto')
            let nombre_categoria = productos_ver.querySelector('.modal-body #nombre_categoria')
            let descripcion_producto = productos_ver.querySelector('.modal-body #descripcion_producto')
            let nombre_usuario = productos_ver.querySelector('.modal-body #nombre_usuario')
            let fecha_creacion_producto = productos_ver.querySelector('.modal-body #fecha_creacion_producto')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_producto', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_producto.value = data.id_producto
                    nombre_producto.value = data.nombre_producto
                    nombre_categoria.value = data.nombre_categoria
                    descripcion_producto.value = data.descripcion_producto
                    nombre_usuario.value = data.nombre_usuario
                    fecha_creacion_producto.value = data.fecha_creacion_producto

                }).catch(err => console.log(err))

        })
        let productos_editar = document.getElementById('productos_editar')
        productos_editar.addEventListener('hide.bs.modal', event => {
            productos_editar.querySelector('.modal-body #nombre_producto').value = ""
            productos_editar.querySelector('.modal-body #descripcion_producto').value = ""
            productos_editar.querySelector('.modal-body #nombre_categoria').value = ""
        })
        productos_editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_producto = productos_editar.querySelector('.modal-body #id_producto')
            let nombre_producto = productos_editar.querySelector('.modal-body #nombre_producto')
            let descripcion_producto = productos_editar.querySelector('.modal-body #descripcion_producto')
            let nombre_categoria = productos_editar.querySelector('.modal-body #nombre_categoria')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_producto', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_producto.value = data.id_producto
                    nombre_producto.value = data.nombre_producto
                    descripcion_producto.value = data.descripcion_producto
                    nombre_categoria.value = data.nombre_categoria
                }).catch(err => console.log(err))
        })

        let productos_eliminar = document.getElementById('productos_eliminar')
        productos_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            productos_eliminar.querySelector('.modal-footer #id_producto').value = id
        })
        let productos_desabilitados = document.getElementById('productos_desabilitados')
        productos_desabilitados.addEventListener('hide.bs.modal', event => {
            productos_desabilitados.querySelector('.modal-body #nombre_producto').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>