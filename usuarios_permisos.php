<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT modulos.id_modulo,nombre_modulo, fecha_creacion_modulo, estado_modulo 
            FROM modulos 
                INNER JOIN usuario_modulos ON modulos.id_modulo = usuario_modulos.id_modulo 
                    INNER JOIN usuarios ON usuario_modulos.id_usuario = usuarios.id_usuario
                            WHERE usuarios.id_usuario=$id AND estado=1";
    $resultado = mysqli_query($conexion, $sql);
} else {
    header('Location: usuarios.php');
}
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <?php include './includes/mensaje.php'; ?>

    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Permisos</li>
        </ol>
        <h2 class="text-center">Permisos</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <?php
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'permiso_asignar') {
                        ?>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#permiso_asignar"><i
                                class="fa-solid fa-list-check" style="color: #ffffff;"></i> Asignar permiso</a>
                        <?php
                    }
                }
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'permiso_asignar') {
                        ?>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#permisos_usuarios_desabilitados"> <i class="fa-solid fa-list-check"
                                style="color: #ffffff;"> </i> Permisos desabilitados</a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <hr>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Permiso</th>
                    <th class="text-center">Fecha de creacion</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                    <!-- <th width="45%">Descripción</th> -->
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nombre_modulo'] ?>
                        </td>
                        <td class="text-center">
                            <?= $row['fecha_creacion_modulo']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_modulo'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'permiso_eliminar_usuario') {
                                    ?> <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#permiso_eliminar_usuario" title="Eliminar" data-bs-id="<?= $row['id_modulo']?>"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a><?php
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
                <a href="usuarios.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './modal/modals_usuario_permiso.php'; ?>

    <script type="text/javascript">
        let permiso_eliminar_usuario = document.getElementById('permiso_eliminar_usuario')
        permiso_eliminar_usuario.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            permiso_eliminar_usuario.querySelector('.modal-footer #id_modulo').value = id
        })
        let permisos_usuarios_desabilitados = document.getElementById('permisos_usuarios_desabilitados')
        permisos_usuarios_desabilitados.addEventListener('hide.bs.modal', event => {
            permisos_usuarios_desabilitados.querySelector('.modal-body #nombre_permiso').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>