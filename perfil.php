<?php
session_start();
require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sql = "SELECT personas.id_persona,id_usuario,nombre_usuario,nombre_persona,apellido_persona, cuil_persona,fecha_nac_persona,sexo_persona,num_telefono,correo,estado_usuario FROM personas INNER JOIN usuarios ON personas.id_persona=usuarios.id_persona WHERE nombre_usuario = '$nombre_usuario'";
$resultado = mysqli_query($conexion, $sql);

$separar = mysqli_fetch_array($resultado);
?>
<?php include './includes/header.php'; ?>
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Mi perfil</li>
        </ol>
        <h3 class="text-center" >MIS DATOS</h3>
        <?php include './includes/mensaje.php'; ?>
        <table  class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>USUARIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>CUIL</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>
                        <?= $separar['nombre_usuario']; ?>
                    </td>
                    <td>
                        <?= $separar['nombre_persona']; ?>
                    </td>
                    <td>
                        <?= $separar['apellido_persona']; ?>
                    </td>
                    <td>
                        <?= $separar['cuil_persona']; ?>
                    </td>
                    <td>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ver_usuario" data-bs-id="<?=$separar['id_persona'];?>" title="Ver mas"><i class="fa-solid fa-eye" style="color: #ffffff;"> </i> </a>
                    <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#editar" data-bs-id="<?=$separar['id_persona'];?>" title="Editar"><i class="fa-solid fa-pen-to-square"> </i> </a>
                    <a href="usuarios_domicilio.php?id=<?=$separar['id_persona']?>" class="btn btn-sm btn-success" title="Datos de contacto"><i class="fa-solid fa-address-book" style="color: #ffffff;"></i></a>
                    
                    </td>
                </tr>
            </tbody>
    </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="principal.php" class="btn btn-primary" >Volver</a>
            </div>
        </div>

    </div>
    
    <?php include './modal/modals_usuario.php'; ?>

    <script type="text/javascript">
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
            let fecha_nac_persona =ver_usuario.querySelector('.modal-body #fecha_nac_persona')
            let sexo_persona =ver_usuario.querySelector('.modal-body #sexo_persona')
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
    </script>
<?php include './includes/footer.php'; ?>