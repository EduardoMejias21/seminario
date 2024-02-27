<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sqlpersonas = "SELECT personas.id_persona,id_usuario,nombre_persona, apellido_persona,cuil_persona,fecha_nac_persona,sexo_persona,nombre_usuario,estado_usuario FROM personas INNER JOIN usuarios ON personas.id_persona=usuarios.id_persona WHERE estado_usuario = 1 ";
$resultado = mysqli_query($conexion, $sqlpersonas);
?>
<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
        <h2 class="text-center">USUARIOS</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <?php
                $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'persona_agregar_usuario') {
                        ?><a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#agregar_usuario"><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                            Crear nuevo usuario</a>
                        <?php
                    }
                }
                foreach ($modulo as $key => $value) {
                    if ($nombre_modulo[$key] = $value == 'usuarios_desabilitados') {
                        ?>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#usuarios_desabilitados"><i
                                class="fa-solid fa-users-slash"></i> Usuarios desabilitados</a>
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
                <tr class="text-center">
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nombre_usuario']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['nombre_persona']; ?>
                        </td>
                        <td class="text-center">
                            <?= $row['apellido_persona']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_usuario'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <!-- Ver usuarios -->
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ver_usuario"
                                data-bs-id="<?= $row['id_persona'] ?>" title="Ver mas"> <i class="fa-solid fa-eye"
                                    style="color: #ffffff;"> </i> </a>
                            <?php
                            //Editar usuarios
                            $b = 0;
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'usuario_editar') {
                                    ?>
                                    <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editar"
                                        data-bs-id="<?= $row['id_persona'] ?>" title="Editar"> <i class="fa-solid fa-pen-to-square"
                                            style="color: #ffffff;"> </i> </a>
                                    <?php
                                    $b = 1;
                                }
                            }
                            if ($row['nombre_usuario'] == $nombre_usuario && $b == 0) {
                                ?>
                                <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editar"
                                    data-bs-id="<?= $row['id_persona'] ?>" title="Editar"> <i class="fa-solid fa-pen-to-square"
                                        style="color: #ffffff;"> </i> </a>
                                <?php
                            }
                            //Eliminar usuarios
                            $c = 0;
                            foreach ($modulo as $key => $value) {
                                if ($row['nombre_usuario'] == $nombre_usuario) {
                                    ?><a></a>
                                    <?php
                                } else {
                                    if ($nombre_modulo[$key] = $value == 'usuario_eliminar') {
                                        ?>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#usuario_eliminar" data-bs-id="<?= $row['id_persona']; ?>"><i
                                                class="fa-solid fa-trash"> </i> </i> </a>
                                        <?php
                                        $c = 1;
                                    }
                                }
                            }
                            //Ver datos contacto
                            $d = 0;
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'usuario_contacto') {
                                    ?>
                                    <a href="usuarios_domicilio.php?id=<?= $row['id_persona'] ?>" class="btn btn-sm btn-success"
                                        title="Datos de contacto"> <i class="fa-solid fa-location-dot" style="color: #ffffff;"> </i>
                                    </a>
                                    <?php
                                    $d = 1;
                                }
                            }
                            if ($row['nombre_usuario'] == $nombre_usuario && $d == 0) {
                                ?>
                                <a href="usuarios_domicilio.php?id=<?= $row['id_persona'] ?>" class="btn btn-sm btn-success"
                                    title="Datos de contacto"> <i class="fa-solid fa-location-dot" style="color: #ffffff;"> </i>
                                </a>
                                <?php
                            }
                            //Ver permisos 
                            $e = 0;
                            foreach ($modulo as $key => $value) {
                                if ($nombre_modulo[$key] = $value == 'permisos_usuarios') {
                                    ?>
                                    <a href="usuarios_permisos.php?id=<?= $row['id_usuario'] ?>" class="btn btn-sm btn-info"
                                        title="Permisos"> <i class="fa-solid fa-list-check" style="color: #ffffff;"> </i> </a>
                                    <?php
                                    $e = 1;
                                }
                            }
                            if ($row['nombre_usuario'] == $nombre_usuario && $e == 0) {
                                ?>
                                <a href="usuarios_permisos.php?id=<?= $row['id_usuario'] ?>" class="btn btn-sm btn-info"
                                    title="Permisos"> <i class="fa-solid fa-list-check" style="color: #ffffff;"> </i> </a>
                                <?php
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
    <?php include './modal/modals_usuario.php'; ?>

    <script type="text/javascript">
        let usuario_eliminar = document.getElementById('usuario_eliminar')
        usuario_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            usuario_eliminar.querySelector('.modal-footer #id_persona').value = id
        })
        let ver_usuario = document.getElementById('ver_usuario')
        ver_usuario.addEventListener('hide.bs.modal', event => {
            ver_usuario.querySelector('.modal-body #nombre_usuario').value = ""
            ver_usuario.querySelector('.modal-body #nombre_persona').value = ""
            ver_usuario.querySelector('.modal-body #apellido_persona').value = ""
            ver_usuario.querySelector('.modal-body #cuil_persona').value = ""
            ver_usuario.querySelector('.modal-body #fecha_nac_persona').value = ""
            ver_usuario.querySelector('.modal-body #sexo_persona').value = ""
            ver_usuario.querySelector('.modal-body #num_telefono').value = ""
            ver_usuario.querySelector('.modal-body #correo').value = ""
            ver_usuario.querySelector('.modal-body #fecha_creacion_usuario').value = ""
        })
        ver_usuario.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_persona = ver_usuario.querySelector('.modal-body #id_persona_mostrar')
            let nombre_usuario = ver_usuario.querySelector('.modal-body #nombre_usuario')
            let nombre_persona = ver_usuario.querySelector('.modal-body #nombre_persona')
            let apellido_persona = ver_usuario.querySelector('.modal-body #apellido_persona')
            let cuil_persona = ver_usuario.querySelector('.modal-body #cuil_persona')
            let fecha_nac_persona = ver_usuario.querySelector('.modal-body #fecha_nac_persona')
            let sexo_persona = ver_usuario.querySelector('.modal-body #sexo_persona')
            let num_telefono = ver_usuario.querySelector('.modal-body #num_telefono')
            let correo = ver_usuario.querySelector('.modal-body #correo')
            let fecha_creacion_usuario = ver_usuario.querySelector('.modal-body #fecha_creacion_usuario')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_persona_mostrar', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_persona.value = data.id_persona
                    nombre_usuario.value = data.nombre_usuario
                    nombre_persona.value = data.nombre_persona
                    apellido_persona.value = data.apellido_persona
                    cuil_persona.value = data.cuil_persona
                    fecha_nac_persona.value = data.fecha_nac_persona
                    sexo_persona.value = data.sexo_persona
                    num_telefono.value = data.num_telefono
                    correo.value = data.correo

                    fecha_creacion_usuario.value = data.fecha_creacion_usuario

                }).catch(err => console.log(err))

        })
        let editar = document.getElementById('editar')
        editar.addEventListener('hide.bs.modal', event => {
            editar.querySelector('.modal-body #nombre_persona').value = ""
            editar.querySelector('.modal-body #apellido_persona').value = ""
            editar.querySelector('.modal-body #cuil_persona').value = ""
            editar.querySelector('.modal-body #fecha_nac_persona').value = ""
            editar.querySelector('.modal-body #sexo_persona').value = ""
            editar.querySelector('.modal-body #num_telefono').value = ""
            editar.querySelector('.modal-body #correo').value = ""
        })
        editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_persona = editar.querySelector('.modal-body #id_persona_mostrar')
            let nombre_persona = editar.querySelector('.modal-body #nombre_persona')
            let apellido_persona = editar.querySelector('.modal-body #apellido_persona')
            let cuil_persona = editar.querySelector('.modal-body #cuil_persona')
            let fecha_nac_persona = editar.querySelector('.modal-body #fecha_nac_persona')
            let sexo_persona = editar.querySelector('.modal-body #sexo_persona')
            let num_telefono = editar.querySelector('.modal-body #num_telefono')
            let correo = editar.querySelector('.modal-body #correo')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_persona_mostrar', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_persona.value = data.id_persona
                    nombre_persona.value = data.nombre_persona
                    apellido_persona.value = data.apellido_persona
                    cuil_persona.value = data.cuil_persona
                    fecha_nac_persona.value = data.fecha_nac_persona
                    sexo_persona.value = data.sexo_persona
                    num_telefono.value = data.num_telefono
                    correo.value = data.correo
                }).catch(err => console.log(err))

        })


        let usuario_agregar = document.getElementById('agregar_usuario')
        usuario_agregar.addEventListener('shown.bs.modal', event => {
            usuario_agregar.querySelector('.modal-body #nombre_persona').focus()
        })
        let persona_agregar_usuario = document.getElementById('persona_agregar_usuario')
        let persona_agregar = document.getElementById('persona_agregar')

        let usuarios_desabilitados = document.getElementById('usuarios_desabilitados')
        usuarios_desabilitados.addEventListener('hide.bs.modal', event => {
            usuarios_desabilitados.querySelector('.modal-body #nombre_usuario').value = ""
        })
    </script>
    <script type="text/javascript">
        const mostrar_contrasena = document.querySelector("#mostrar_contrasena")
        const password = document.querySelector("#clave_usuario");
        mostrar_contrasena.addEventListener("click", () => {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        })
    </script>
<?php include './includes/footer.php'; ?>