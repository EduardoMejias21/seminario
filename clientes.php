<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
$sqlclientes = "SELECT personas.id_persona,id_cliente,nombre_persona, apellido_persona,cuil_persona,fecha_nac_persona,sexo_persona,domicilio_fiscal,condicion_iva,estado_cliente,fecha_creacion FROM personas INNER JOIN clientes ON personas.id_persona=clientes.id_persona WHERE estado_cliente = 1 ";
$resultado = mysqli_query($conexion, $sqlclientes);
?>

<?php include './includes/header.php'; ?>
    <?php include './includes/menu_nav.php'; ?>
    <!-- INICIO CONTENIDO -->
    <div class="container py-3">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <h2 class="text-center">CLIENTES</h2>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar_cliente" ><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Crear nuevo cliente</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clientes_desabilitados" ><i class="fa-solid fa-users-slash"></i> Clientes desabilitados</a>
            </div>
        </div>
        <hr>
        <?php include './includes/mensaje.php';?>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Razon Social</th>
                    <th class="text-center">Cuil/Cuit</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $row['nombre_persona'].' '.$row['apellido_persona'] ?>
                        </td>
                        <td class="text-center">
                            <?= $row['cuil_persona']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_cliente'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <!-- Ver Cliente -->
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ver_usuario" data-bs-id="<?= $row['id_persona']?>" title="Ver mas"> <i class="fa-solid fa-eye" style="color: #ffffff;"> </i> </a>
                            <!-- Editar Cliente-->
                            <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editar" data-bs-id="<?= $row['id_persona']?>" title="Editar"> <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"> </i> </a>
                            <!-- Eliminar Cliente -->
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#usuario_eliminar" data-bs-id="<?= $row['id_persona']; ?>"> <i class="fa-solid fa-trash"> </i> </a>
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
    <?php include './modal/modals_clientes.php'; ?>
    <script type="text/javascript">
        let agregar_cliente = document.getElementById('agregar_cliente')
        agregar_cliente.addEventListener('shown.bs.modal', event => {
            agregar_cliente.querySelector('.modal-body #nombre_persona').focus()
        })
        let ver_usuario = document.getElementById('ver_usuario')
        ver_usuario.addEventListener('hide.bs.modal', event => {
            ver_usuario.querySelector('.modal-body #nombre_persona').value = ""
            ver_usuario.querySelector('.modal-body #apellido_persona').value = ""
            ver_usuario.querySelector('.modal-body #cuil_persona').value = ""
            ver_usuario.querySelector('.modal-body #fecha_nac_persona').value = ""
            ver_usuario.querySelector('.modal-body #sexo_persona').value = ""
            ver_usuario.querySelector('.modal-body #num_telefono').value = ""
            ver_usuario.querySelector('.modal-body #correo').value = ""
            ver_usuario.querySelector('.modal-body #domicilio_fiscal').value = ""
            ver_usuario.querySelector('.modal-body #condicion_iva').value = ""
        })
        ver_usuario.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_persona = ver_usuario.querySelector('.modal-body #id_cliente_mostrar')
            let nombre_persona = ver_usuario.querySelector('.modal-body #nombre_persona')
            let apellido_persona = ver_usuario.querySelector('.modal-body #apellido_persona')
            let cuil_persona = ver_usuario.querySelector('.modal-body #cuil_persona')
            let fecha_nac_persona =ver_usuario.querySelector('.modal-body #fecha_nac_persona')
            let sexo_persona =ver_usuario.querySelector('.modal-body #sexo_persona')
            let num_telefono = ver_usuario.querySelector('.modal-body #num_telefono')
            let correo = ver_usuario.querySelector('.modal-body #correo')
            let domicilio_fiscal = ver_usuario.querySelector('.modal-body #domicilio_fiscal')
            let condicion_iva = ver_usuario.querySelector('.modal-body #condicion_iva')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_cliente_mostrar', id)

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
                    domicilio_fiscal.value = data.domicilio_fiscal
                    condicion_iva.value = data.condicion_iva
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
            editar.querySelector('.modal-body #domicilio_fiscal').value = ""
            editar.querySelector('.modal-body #condicion_iva').value = ""
        })
        editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let id_persona = editar.querySelector('.modal-body #id_cliente_mostrar')
            let nombre_persona = editar.querySelector('.modal-body #nombre_persona')
            let apellido_persona = editar.querySelector('.modal-body #apellido_persona')
            let cuil_persona = editar.querySelector('.modal-body #cuil_persona')
            let fecha_nac_persona = editar.querySelector('.modal-body #fecha_nac_persona')
            let sexo_persona = editar.querySelector('.modal-body #sexo_persona')
            let num_telefono = editar.querySelector('.modal-body #num_telefono')
            let correo = editar.querySelector('.modal-body #correo')
            let domicilio_fiscal = editar.querySelector('.modal-body #domicilio_fiscal')
            let condicion_iva = editar.querySelector('.modal-body #condicion_iva')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_cliente_mostrar', id)

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
                    domicilio_fiscal.value = data.domicilio_fiscal
                    condicion_iva.value = data.condicion_iva

                }).catch(err => console.log(err))

        })
        let usuario_eliminar = document.getElementById('usuario_eliminar')
        usuario_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            usuario_eliminar.querySelector('.modal-footer #id_persona').value = id
        })
        let clientes_desabilitados = document.getElementById('clientes_desabilitados')
        clientes_desabilitados.addEventListener('hide.bs.modal', event => {
            clientes_desabilitados.querySelector('.modal-body #nombre_persona').value = ""
        })
    </script>
<?php include './includes/footer.php'; ?>