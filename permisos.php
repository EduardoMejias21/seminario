<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql = "SELECT id_modulo,nombre_modulo,estado_modulo,fecha_creacion_modulo FROM  modulos WHERE estado_modulo = 1 ";
$resultado = mysqli_query($conexion, $sql);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Permisos</li>
        </ol>
        <h2 class="text-center">PERMISOS</h2>

        <div class="row justify-content-end">
            <div class="col-auto">
                <?php
                $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'permiso_agregar') {
                        ?>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permiso_agregar"><i
                                class="fa-solid fa-list-check" style="color: #ffffff;"></i> Nuevo permiso</a>
                        <?php
                    }
                }
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'permisos_desabilitados') {
                        ?>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#permisos_desabilitados"><i
                                class="fa-solid fa-list-check" style="color: #ffffff;"></i> Permisos desabilitados</a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php'; ?>

        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Permiso</th>
                    <th class="text-center">Fecha de creacion</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nombre_modulo']; ?>
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
                            //Eliminar permisos
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'permiso_eliminar') {
                                    ?>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#permiso_eliminar" title="Eliminar" data-bs-id="<?= $row['id_modulo'] ?>"><i
                                            class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
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
                <a href="principal.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './modal/modals_permisos.php'; ?>

    <script type="text/javascript">

        let permiso_agregar = document.getElementById('permiso_agregar')
        permiso_agregar.addEventListener('shown.bs.modal', event => {
            permiso_agregar.querySelector('.modal-body #nombre_modulo').focus()
        })
        permiso_agregar.addEventListener('hide.bs.modal', event => {
            permiso_agregar.querySelector('.modal-body #nombre_modulo').value = ""
        })

        let permiso_eliminar = document.getElementById('permiso_eliminar')
        permiso_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            permiso_eliminar.querySelector('.modal-footer #id_modulo').value = id
        })

        let permisos_desabilitados = document.getElementById('permisos_desabilitados')
        permisos_desabilitados.addEventListener('hide.bs.modal', event => {
            permisos_desabilitados.querySelector('.modal-body #nombre_permiso').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>