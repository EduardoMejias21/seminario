<?php
session_start();

require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_domicilios = "SELECT id_dom,pais_dom,provincia_dom,calle_dom,altura_dom,coordenadas_dom,descripcion_dom,estado_dom FROM domicilios WHERE id_persona=$id and estado_dom=1";
    $resultado_domicilios = mysqli_query($conexion, $sql_domicilios);

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
            <li class="breadcrumb-item"><a href="usuarios.php">Usuarios</a></li>
            <li class="breadcrumb-item active">Datos de contacto</li>
        </ol>
        <h2 class="text-center">DATOS DE CONTACTO</h2>
        <h4 class="">DOMICILIOS</h4>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dom_agregar"><i
                        class="fa-solid fa-house" style="color: #ffffff;"></i> Agregar domicilio</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#domicilios_desabilitados"><i class="fa-solid fa-house"></i> Domicilios desabilitados</a>
            </div>
        </div>
        <hr>
        <table class="table table-sm table-striped table-hover mt-4" id="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Direccion</th>
                    <th class="text-center">Coordenadas</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                    <!-- <th width="45%">Descripción</th> -->
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado_domicilios)) { ?>
                    <tr>

                        <td class="text-center">
                            <?= $row['provincia_dom'] ?>-
                            <?= $row['calle_dom'] ?>-
                            <?= $row['altura_dom'] ?>
                        </td>
                        <td class="text-center">
                            <?= $row['coordenadas_dom']; ?>
                        </td>
                        <td>
                            <?= $row['descripcion_dom']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($row['estado_dom'] == 1) {
                                echo '<i class="fa-solid fa-circle" style="color: #2bff00;"></i>';
                            } else {
                                echo '<i class="fa-solid fa-circle" style="color: #ff0000;"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#dom_editar"
                                data-bs-id="<?= $row['id_dom']; ?>" title="Editar"><i
                                    class="fa-solid fa-pen-to-square"></i></a>

                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#dom_eliminar"
                                data-bs-id="<?= $row['id_dom']; ?>" title="Eliminar"><i class="fa-solid fa-trash"
                                    style="color: #ffffff;"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="usuarios_domicilio.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- FIN CONTENIDO -->
    <?php include './modal/modals_domicilio.php'; ?>

    <script type="text/javascript">
        //Domicilios
        let dom_agregar = document.getElementById('dom_agregar')
        let dom_editar = document.getElementById('dom_editar')
        let dom_eliminar = document.getElementById('dom_eliminar')

        dom_agregar.addEventListener('shown.bs.modal', event => {
            dom_agregar.querySelector('.modal-body #pais_dom').focus()
        })

        dom_agregar.addEventListener('hide.bs.modal', event => {

            dom_agregar.querySelector('.modal-body #pais_dom').value = ""
            dom_agregar.querySelector('.modal-body #provincia_dom').value = ""
            dom_agregar.querySelector('.modal-body #calle_dom').value = ""
            dom_agregar.querySelector('.modal-body #altura_dom').value = ""
            dom_agregar.querySelector('.modal-body #coordenadas_dom').value = ""
            dom_agregar.querySelector('.modal-body #descripcion_dom').value = ""
        })

        dom_editar.addEventListener('hide.bs.modal', event => {
            dom_editar.querySelector('.modal-body #pais_dom').value = ""
            dom_editar.querySelector('.modal-body #provincia_dom').value = ""
            dom_editar.querySelector('.modal-body #calle_dom').value = ""
            dom_editar.querySelector('.modal-body #altura_dom').value = ""
            dom_editar.querySelector('.modal-body #coordenadas_dom').value = ""
            dom_editar.querySelector('.modal-body #descripcion_dom').value = ""
        })

        dom_editar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            dom_editar.querySelector('.modal-body #id_dom_editar').value = id

            let id_dom = dom_editar.querySelector('.modal-body #id_dom_editar')
            let pais_dom = dom_editar.querySelector('.modal-body #pais_dom')
            let provincia_dom = dom_editar.querySelector('.modal-body #provincia_dom')
            let calle_dom = dom_editar.querySelector('.modal-body #calle_dom')
            let altura_dom = dom_editar.querySelector('.modal-body #altura_dom')
            let coordenadas_dom = dom_editar.querySelector('.modal-body #coordenadas_dom')
            let descripcion_dom = dom_editar.querySelector('.modal-body #descripcion_dom')
            let id_persona = dom_editar.querySelector('.modal-body #id_persona')

            let url = "modals_querys.php"
            let formData = new FormData()
            formData.append('id_dom_editar', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {

                    id_dom.value
                    pais_dom.value = data.pais_dom
                    provincia_dom.value = data.provincia_dom
                    calle_dom.value = data.calle_dom
                    altura_dom.value = data.altura_dom
                    coordenadas_dom.value = data.coordenadas_dom
                    descripcion_dom.value = data.descripcion_dom
                    id_persona.value = data.id_persona

                }).catch(err => console.log(err))
        })

        dom_eliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            dom_eliminar.querySelector('.modal-footer #id_dom').value = id
        })
        let domicilios_desabilitados = document.getElementById('domicilios_desabilitados')
        domicilios_desabilitados.addEventListener('hide.bs.modal', event => {
            domicilios_desabilitados.querySelector('.modal-body #nombre_usuario').value = ""
        })
        let dom_habilitar = document.getElementById('dom_habilitar')
        dom_habilitar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            dom_habilitar.querySelector('.modal-footer #id_dom').value = id
        })

        //Telefonos
        let tel_agregar = document.getElementById('tel_agregar')
        let tel_editar = document.getElementById('tel_editar')
        let tel_eliminar = document.getElementById('tel_eliminar')
        //Correos
        let correo_agregar = document.getElementById('correo_agregar')
        let correo_editar = document.getElementById('correo_editar')
        let correo_eliminar = document.getElementById('correo_eliminar')
    </script>
<?php include './includes/footer.php'; ?>