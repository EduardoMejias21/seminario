<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
$result_sql_id = mysqli_query($conexion, $sql_id);

$row_id = mysqli_fetch_array($result_sql_id);
// $sql_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
// $result_sql_id = mysqli_query($conexion,$sql_id);

// $row_id = mysqli_fetch_array($result_sql_id);
$sql_proveedores = "SELECT id_proveedor,razon_social_proveedor,cuit_proveedor, condicion_iva_proveedor,telefono_proveedor,correo_proveedor,domicilio_proveedor,pais_proveedor,provincia_proveedor,localidad_proveedor, DATE_FORMAT(fecha_alta_proveedor,'%d-%m-%Y %h:%m %p') AS fecha_alta_proveedor, estado_proveedor, nombre_usuario  FROM proveedores INNER JOIN usuarios ON proveedores.id_usuario_creacion = usuarios.id_usuario WHERE estado_proveedor = 1";
$resultado = mysqli_query($conexion, $sql_proveedores);

?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Proveedores</li>
        </ol>
        <h2 class="text-center">PROVEEEDORES</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#proveedor_agregar"><i
                        class="fa-solid fa-bag-shopping"> </i> Crear nuevo proveedor</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#proveedores_desabilitados"><i
                        class="fa-solid fa-bag-shopping"> </i> Proveedores desabilitados</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php'; ?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Razon Social</th>
                    <th class="text-center">Cuit</th>
                    <th class="text-center">Domicilio</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['razon_social_proveedor']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['cuit_proveedor']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['domicilio_proveedor']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_proveedor'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <!-- Ver mas proveedor -->
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#proveedor_ver" data-bs-id="<?= $row['id_proveedor'] ?>" title="Ver mas"><i
                                    class="fa-solid fa-eye" style="color: #ffffff;"> </i> </a>
                            <!-- Editar proveedor -->
                            <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#proveedor_editar" data-bs-id="<?= $row['id_proveedor'] ?>" title="Editar"><i
                                    class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                            <!-- Eliminar proveedor -->
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#proveedor_eliminar" data-bs-id="<?= $row['id_proveedor'] ?>"
                                title="Eliminar"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="principal.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './modal/modals_proveedores.php'; ?>
    <script type="text/javascript">
        let proveedor_agregar = document.getElementById('proveedor_agregar')
        proveedor_agregar.addEventListener('shown.bs.modal', event => {
            proveedor_agregar.querySelector('.modal-body #razon_social_proveedor').focus()
        })

        proveedor_agregar.addEventListener('hide.bs.modal', event => {
            proveedor_agregar.querySelector('.modal-body #razon_social_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #cuit_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #condicion_iva_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #telefono_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #correo_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #domicilio_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #pais_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #provincia_proveedor').value = ""
            proveedor_agregar.querySelector('.modal-body #localidad_proveedor').value = ""
        })

        let proveedor_ver = document.getElementById('proveedor_ver')
        proveedor_ver.addEventListener('hide.bs.modal', event => {
            proveedor_ver.querySelector('.modal-body #razon_social_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #cuit_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #condicion_iva_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #telefono_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #correo_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #domicilio_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #pais_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #provincia_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #localidad_proveedor').value = ""
            proveedor_ver.querySelector('.modal-body #fecha_alta_proveedor').value = ""
        })
        proveedor_ver.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_proveedor = proveedor_ver.querySelector('.modal-body #id_proveedor')
            let razon_social_proveedor = proveedor_ver.querySelector('.modal-body #razon_social_proveedor')
            let cuit_proveedor = proveedor_ver.querySelector('.modal-body #cuit_proveedor')

            let condicion_iva_proveedor = proveedor_ver.querySelector('.modal-body #condicion_iva_proveedor')
            let telefono_proveedor = proveedor_ver.querySelector('.modal-body #telefono_proveedor')

            let correo_proveedor = proveedor_ver.querySelector('.modal-body #correo_proveedor')
            let domicilio_proveedor = proveedor_ver.querySelector('.modal-body #domicilio_proveedor')
            let pais_proveedor = proveedor_ver.querySelector('.modal-body #pais_proveedor')
            let provincia_proveedor = proveedor_ver.querySelector('.modal-body #provincia_proveedor')
            let localidad_proveedor = proveedor_ver.querySelector('.modal-body #localidad_proveedor')
            let nombre_usuario = proveedor_ver.querySelector('.modal-body #nombre_usuario')
            let fecha_alta_proveedor = proveedor_ver.querySelector('.modal-body #fecha_alta_proveedor')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_proveedor', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_proveedor.value = data.id_proveedor
                    razon_social_proveedor.value = data.razon_social_proveedor
                    cuit_proveedor.value = data.cuit_proveedor

                    condicion_iva_proveedor.value = data.condicion_iva_proveedor
                    telefono_proveedor.value = data.telefono_proveedor

                    correo_proveedor.value = data.correo_proveedor
                    domicilio_proveedor.value = data.domicilio_proveedor
                    pais_proveedor.value = data.pais_proveedor
                    provincia_proveedor.value = data.provincia_proveedor
                    localidad_proveedor.value = data.localidad_proveedor

                    nombre_usuario.value = data.nombre_usuario

                    fecha_alta_proveedor.value = data.fecha_alta_proveedor
                }).catch(err => console.log(err))
        })
        let proveedor_editar = document.getElementById('proveedor_editar')
        proveedor_editar.addEventListener('hide.bs.modal', event => {
            proveedor_editar.querySelector('.modal-body #razon_social_proveedor').value = ""
        })
        proveedor_editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_proveedor = proveedor_editar.querySelector('.modal-body #id_proveedor')
            let razon_social_proveedor = proveedor_editar.querySelector('.modal-body #razon_social_proveedor')
            let cuit_proveedor = proveedor_editar.querySelector('.modal-body #cuit_proveedor')
            let condicion_iva_proveedor = proveedor_editar.querySelector('.modal-body #condicion_iva_proveedor')
            let telefono_proveedor = proveedor_editar.querySelector('.modal-body #telefono_proveedor')
            let correo_proveedor = proveedor_editar.querySelector('.modal-body #correo_proveedor')
            let domicilio_proveedor = proveedor_editar.querySelector('.modal-body #domicilio_proveedor')
            let pais_proveedor = proveedor_editar.querySelector('.modal-body #pais_proveedor')
            let provincia_proveedor = proveedor_editar.querySelector('.modal-body #provincia_proveedor')
            let localidad_proveedor = proveedor_editar.querySelector('.modal-body #localidad_proveedor')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_proveedor', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_proveedor.value = data.id_proveedor
                    razon_social_proveedor.value = data.razon_social_proveedor
                    cuit_proveedor.value = data.cuit_proveedor
                    condicion_iva_proveedor.value = data.condicion_iva_proveedor
                    telefono_proveedor.value = data.telefono_proveedor
                    correo_proveedor.value = data.correo_proveedor
                    domicilio_proveedor.value = data.domicilio_proveedor
                    pais_proveedor.value = data.pais_proveedor
                    provincia_proveedor.value = data.provincia_proveedor
                    localidad_proveedor.value = data.localidad_proveedor
                }).catch(err => console.log(err))
        })
        let proveedor_eliminar = document.getElementById('proveedor_eliminar')
        proveedor_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            proveedor_eliminar.querySelector('.modal-footer #id_proveedor').value = id
        })

        let proveedores_desabilitados = document.getElementById('proveedores_desabilitados')
        proveedores_desabilitados.addEventListener('shown.bs.modal', event => {
            proveedores_desabilitados.querySelector('.modal-body #razon_social_proveedor').focus()
        })

        proveedores_desabilitados.addEventListener('hide.bs.modal', event => {
            proveedores_desabilitados.querySelector('.modal-body #razon_social_proveedor').value = ""
            proveedores_desabilitados.querySelector('.modal-body #cuit_proveedor').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>