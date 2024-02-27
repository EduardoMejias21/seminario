<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
// $sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
// $result_sql_id = mysqli_query($conexion,$sql_id);

// $row_id = mysqli_fetch_array($result_sql_id);
$sql_categorias = "SELECT id_categoria,nombre_categoria,descripcion_categoria, estado_categoria, DATE_FORMAT(fecha_creacion_categoria,'%d-%m-%Y %h:%m %p') AS fecha_creacion_categoria  FROM categorias WHERE estado_categoria = 1";
$resultado = mysqli_query($conexion, $sql_categorias);

?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Categorias</li>
        </ol>
        <h2 class="text-center">CATEGORIAS</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categorias_agregar"><i class="fa-solid fa-bag-shopping"> </i> Crear nueva categoria</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categorias_desabilitadas"><i class="fa-solid fa-bag-shopping"> </i> Categorias desabilitadas</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php';?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Alta</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr class="text-center">
                        <td >
                            <?= $row['nombre_categoria']; ?>
                        </td>
                        <td>
                            <?= $row['descripcion_categoria']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_categoria'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td>
                            <?= $row['fecha_creacion_categoria']; ?>
                        </td>
                        <td>
                            <!-- Editar categorias -->
                            <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#categorias_editar" data-bs-id="<?=$row['id_categoria']?>" title="Editar"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                            <!-- Eliminar categorias -->
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#categorias_eliminar" data-bs-id="<?=$row['id_categoria']?>" title="Eliminar"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                            
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
    <?php include './modal/modals_categorias.php'; ?>
    <script type="text/javascript">
        let categorias_agregar = document.getElementById('categorias_agregar')
        categorias_agregar.addEventListener('shown.bs.modal', event => {
            categorias_agregar.querySelector('.modal-body #nombre_categoria').focus()
        })

        categorias_agregar.addEventListener('hide.bs.modal', event => {
            categorias_agregar.querySelector('.modal-body #nombre_categoria').value = ""
            categorias_agregar.querySelector('.modal-body #descripcion_categoria').value = ""
        })
        
        let categorias_editar = document.getElementById('categorias_editar')
        categorias_editar.addEventListener('hide.bs.modal', event => {
            categorias_editar.querySelector('.modal-body #nombre_categoria').value = ""
        })
        categorias_editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_categoria = categorias_editar.querySelector('.modal-body #id_categoria')
            let nombre_categoria = categorias_editar.querySelector('.modal-body #nombre_categoria')
            let descripcion_categoria = categorias_editar.querySelector('.modal-body #descripcion_categoria')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_categoria', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_categoria.value = data.id_categoria
                    nombre_categoria.value = data.nombre_categoria
                    descripcion_categoria.value = data.descripcion_categoria
                }).catch(err => console.log(err))
        })

        let categorias_eliminar = document.getElementById('categorias_eliminar')
        categorias_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            categorias_eliminar.querySelector('.modal-footer #id_categoria').value = id
        })

        let categorias_desabilitadas = document.getElementById('categorias_desabilitadas')
        categorias_desabilitadas.addEventListener('shown.bs.modal', event => {
            categorias_desabilitadas.querySelector('.modal-body #nombre_categoria').focus()
        })

        categorias_desabilitadas.addEventListener('hide.bs.modal', event => {
            categorias_desabilitadas.querySelector('.modal-body #nombre_categoria').value = ""
            categorias_desabilitadas.querySelector('.modal-body #descripcion_categoria').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>