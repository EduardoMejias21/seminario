<?php
session_start();
require 'includes/conexion.php';
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
    header("location:login.php");
}
function F_gen_password($Paswd_Length)
{
    // set ASCII range for random character generation  
    $lower_ascii_bound = 50; // "2"
    $upper_ascii_bound = 122; // "z"
    // Exclude special characters and some confusing alphanumerics
    // o,O,0,I,1,l etc
    $notuse = array(58, 59, 60, 61, 62, 63, 64, 73, 79, 91, 92, 93, 94, 95, 96, 108, 111);
    $i = 0;
    $password = '';
    while ($i < $Paswd_Length) {
        mt_srand((double) microtime() * 1000000);
        // random limits within ASCII table
        $randnum = mt_rand($lower_ascii_bound, $upper_ascii_bound);
        if (!in_array($randnum, $notuse)) {
            $password = $password . chr($randnum);
            $i++;
        }
        ;
    }
    ;
    return $password;
}
//Domicilios
if (isset($_POST['id_dom_editar'])) {
    $id_dom = $_POST['id_dom_editar'];
    $sql = "SELECT pais_dom,provincia_dom,calle_dom,altura_dom,coordenadas_dom,descripcion_dom,estado_dom,id_persona FROM domicilios WHERE id_dom='$id_dom' LIMIT 1";

    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $domicilio = [];

    if ($rows > 0) {
        $domicilio = $resultado->fetch_array();
    }

    echo json_encode($domicilio, JSON_UNESCAPED_UNICODE);
}
if (isset($_POST['eliminar_dom'])) {
    $id = $_POST['id'];
    $id_dom = $_POST['id_dom'];
    $sql = "UPDATE domicilios SET estado_dom = 0 WHERE id_dom='$id_dom' and id_persona='$id'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Domicilio eliminado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar el domicilio";
    }
    header("location:usuarios_domicilio.php?id=$id");
}
if (isset($_POST['editar_dom'])) {
    $id = $_POST['id'];
    $id_dom = $_POST['id_dom_editar'];
    $pais_dom = strtoupper($_POST['pais_dom']);
    $provincia_dom = strtoupper($_POST['provincia_dom']);
    $calle_dom = strtoupper($_POST['calle_dom']);
    $altura_dom = strtoupper($_POST['altura_dom']);
    $coordenadas_dom = strtoupper($_POST['coordenadas_dom']);
    $descripcion_dom = strtoupper($_POST['descripcion_dom']);

    $sql = "UPDATE domicilios SET pais_dom ='$pais_dom', provincia_dom = '$provincia_dom', calle_dom='$calle_dom',altura_dom='$altura_dom',coordenadas_dom='$coordenadas_dom',descripcion_dom='$descripcion_dom',estado_dom='1',id_persona='$id' WHERE id_dom='$id_dom'";
    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Domicilio actualizado";

    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al actualizar el domicilio";
    }
    header("location:usuarios_domicilio.php?id=$id");
}
if (isset($_POST['habilitar_dom'])) {
    $id_dom = $_POST['domicilios'];
    foreach ($id_dom as $id_d) {
        $id_persona = $_POST['id_persona'];
        $sql = "UPDATE domicilios SET estado_dom = 1 WHERE id_dom='$id_d' and id_persona='$id_persona'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Domicilio habilitado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar domicilio";
        }
    }
    header("location:usuarios_domicilio.php?id=$id_persona");
}
if (isset($_POST['guardar_dom'])) {
    $id = $_POST['id'];
    $pais_dom = strtoupper($_POST['pais_dom']);
    $provincia_dom = strtoupper($_POST['provincia_dom']);
    $calle_dom = strtoupper($_POST['calle_dom']);
    $altura_dom = strtoupper($_POST['altura_dom']);
    $coordenadas_dom = strtoupper($_POST['coordenadas_dom']);
    $descripcion_dom = strtoupper($_POST['descripcion_dom']);

    $sql = "INSERT INTO domicilios (pais_dom, provincia_dom, calle_dom, altura_dom,coordenadas_dom,descripcion_dom,estado_dom,id_persona) VALUES ('$pais_dom', '$provincia_dom', '$calle_dom', '$altura_dom','$coordenadas_dom','$descripcion_dom','1',$id)";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Domicilio cargado correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al guardar el domicilio";
    }
    header("location:usuarios_domicilio.php?id=$id");
}
//Usuarios
if (isset($_POST['id_persona_mostrar'])) {
    $id_persona = $_POST['id_persona_mostrar'];

    $sql = "SELECT personas.id_persona, nombre_persona, apellido_persona, cuil_persona,fecha_nac_persona,sexo_persona,num_telefono,correo,nombre_usuario,fecha_creacion_usuario FROM personas INNER JOIN usuarios ON personas.id_persona = usuarios.id_persona WHERE personas.id_persona=$id_persona LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $persona = [];

    if ($rows > 0) {
        $persona = $resultado->fetch_array();
    }

    echo json_encode($persona, JSON_UNESCAPED_UNICODE);
}
if (isset($_POST['guardar_usuario'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $nombre_persona = strtoupper($_POST['nombre_persona']);
    $apellido_persona = strtoupper($_POST['apellido_persona']);
    $cuil_persona = $_POST['cuil_persona'];
    $fecha_nac_persona = $_POST['fecha_nac_persona'];
    $sexo_persona = strtoupper($_POST['sexo_persona']);
    $clave_usuario = md5($_POST['clave_usuario']);

    $sql = "INSERT INTO personas (nombre_persona, apellido_persona, cuil_persona, fecha_nac_persona,sexo_persona)
    VALUES ('$nombre_persona', '$apellido_persona', $cuil_persona, '$fecha_nac_persona','$sexo_persona')";
    if ($resultado = mysqli_query($conexion, $sql)) {
        $id_persona = mysqli_insert_id($conexion);
        $sql_usuario = "INSERT INTO usuarios (nombre_usuario,clave_usuario,fecha_creacion_usuario,estado_usuario,id_persona)
            VALUES ('$nombre_usuario','$clave_usuario', NOW(),1,$id_persona)";
        if ($resultado_usuario = mysqli_query($conexion, $sql_usuario)) {
            $id = mysqli_insert_id($conexion);
            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Usuario guardado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al guardar el usuario";
        }

    }
    header("location:usuarios.php");
}
if (isset($_POST['usuario_editar'])) {
    $id_persona = $_POST['id_persona_mostrar'];
    $nombre_persona = strtoupper($_POST['nombre_persona']);
    $apellido_persona = strtoupper($_POST['apellido_persona']);
    $cuil_persona = $_POST['cuil_persona'];
    $fecha_nac_persona = $_POST['fecha_nac_persona'];
    $sexo_persona = strtoupper($_POST['sexo_persona']);
    $num_telefono = $_POST['num_telefono'];
    $correo = $_POST['correo'];

    $sql = "UPDATE personas SET nombre_persona ='$nombre_persona', apellido_persona = '$apellido_persona', cuil_persona=$cuil_persona,fecha_nac_persona='$fecha_nac_persona',sexo_persona='$sexo_persona',num_telefono='$num_telefono',correo='$correo'   WHERE id_persona=$id_persona";
    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Usuario actualizado";

    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al actualizar el usuario";
    }

    header('Location: usuarios.php');
}
if (isset($_POST['usuario_editar_perfil'])) {
    $id_persona = $_POST['id_persona'];
    $nombre_persona = strtoupper($_POST['nombre_persona']);
    $apellido_persona = strtoupper($_POST['apellido_persona']);
    $cuil_persona = $_POST['cuil_persona'];
    $fecha_nac_persona = $_POST['fecha_nac_persona'];
    $sexo_persona = strtoupper($_POST['sexo_persona']);

    $sql = "UPDATE personas SET nombre_persona ='$nombre_persona', apellido_persona = '$apellido_persona', cuil_persona=$cuil_persona,fecha_nac_persona='$fecha_nac_persona',sexo_persona='$sexo_persona' WHERE id_persona=$id_persona";
    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Datos actualizados";

    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al actualizar los datos";
    }

    header('Location: perfil.php');
}
if (isset($_POST['eliminar_usuario'])) {
    $id_persona = $_POST['id_persona'];
    $sql = "UPDATE usuarios SET estado_usuario = 0 WHERE id_persona=$id_persona";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Registro eliminado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar registro";
    }

    header('Location: usuarios.php');
}
if (isset($_POST['habilitar_usuario'])) {
    $id_persona = $_POST['personas'];
    foreach ($id_persona as $id_per) {
        $sql = "UPDATE usuarios SET estado_usuario = 1 WHERE id_persona ='$id_per'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Usuario habilitado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el usuario";
        }
    }
    header('Location: usuarios.php');
}
if (isset($_POST['id_persona_contacto'])) {
    $id_persona = $_POST['id_persona_contacto'];
    $sql_dom = "SELECT personas.id_persona,pais_dom,provincia_dom,calle_dom,altura_dom FROM personas INNER JOIN domicilios ON personas.id_persona = personas.id_persona WHERE personas.id_persona = $id_persona LIMIT 1";
    $result_dom = mysqli_query($conexion, $sql_dom);
    $rows = $result_dom->num_rows;

    $dom = [];

    if ($rows > 0) {
        $dom = $result_dom->fetch_array();
    }

    echo json_encode($dom, JSON_UNESCAPED_UNICODE);
}
//Permisos
if (isset($_POST['permiso_habilitar'])) {
    $id_modulo = $_POST['permisos'];
    foreach ($id_modulo as $id_mod) {
        $sql = "UPDATE modulos SET estado_modulo = 1 WHERE id_modulo ='$id_mod'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Permiso habiltado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el permiso";
        }
    }

    header("location:permisos.php");
}
if (isset($_POST['permiso_eliminar'])) {
    //$id = $_POST['id'];
    $id_modulo = $_POST['id_modulo'];
    //$sql = "UPDATE modulos SET estado_modulo = 0 WHERE id_modulo='$id_modulo'";
    $sql = "UPDATE modulos 
                INNER JOIN usuario_modulos ON modulos.id_modulo = usuario_modulos.id_modulo  
                    SET modulos.estado_modulo = 0, usuario_modulos.estado = 0
                        WHERE modulos.id_modulo ='$id_modulo'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Permiso eliminado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar el permiso";
    }
    // header("location:permisos.php?id=$id");
    header("location:permisos.php");
}
if (isset($_POST['permiso_agregar'])) {
    $id = $_POST['id'];
    $id_modulo = $_POST['id_modulo'];
    $nombre_modulo = strtolower($_POST['nombre_modulo']);

    $sql = "INSERT INTO modulos (nombre_modulo,fecha_creacion_modulo,estado_modulo) VALUES ('$nombre_modulo',  NOW(), '1')";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Permiso cargado correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al guardar el permiso";
    }
    header("location:permisos.php?id=$id");
}
if (isset($_POST['permiso_asignar'])) {
    $id = $_POST['id'];
    $datos = $_REQUEST['modulos'];
    list($id_modulo,$nombre_modulo) = explode(",",$datos);

    //$sql = "INSERT INTO usuario_modulos (id_usuario,id_modulo) VALUES ('$id', '$id_modulo')";
    $sql = "INSERT INTO `usuario_modulos` (`id_usuario`, `id_modulo`,`estado`) VALUES ('$id', '$id_modulo','1');";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Permiso asignado correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al asignar el permiso";
    }
    header("location:usuarios_permisos.php?id=$id");
}
if (isset($_POST['permiso_eliminar_usuario'])) {
    $id = $_POST['id'];
    $id_modulo = $_POST['id_modulo'];
    $sql = "UPDATE usuario_modulos SET estado = 0 WHERE id_modulo='$id_modulo' AND id_usuario='$id'";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Permiso desabilitado correctamente";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al desabilitar el permiso";
    }
    header("location:usuarios_permisos.php?id=$id");
}
if (isset($_POST['permiso_habilitar_usuario'])) {
    $id_modulo = $_POST['permisos'];
    foreach ($id_modulo as $id_mod) {
        $id = $_POST['id_usuario'];
        $sql = "UPDATE usuario_modulos SET estado = 1 WHERE id_modulo='$id_mod' AND id_usuario='$id'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Permiso habiltado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el permiso";
        }
    }

    header("location:usuarios_permisos.php?id=$id");
}

//Productos
//ver productos
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    $sql = "SELECT productos.id_producto, nombre_producto, nombre_categoria, descripcion_producto,DATE_FORMAT(fecha_creacion_producto,'%d-%m-%Y %H:%m:%S') as fecha_creacion_producto, nombre_usuario FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria INNER JOIN usuarios ON productos.id_usuario_creacion = usuarios.id_usuario WHERE productos.id_producto=$id_producto LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $producto = [];

    if ($rows > 0) {
        $producto = $resultado->fetch_array();
    }

    echo json_encode($producto, JSON_UNESCAPED_UNICODE);
}
//editar productos
if (isset($_POST['editar_productos'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = strtoupper($_POST['nombre_producto']);
    $descripcion_producto = strtoupper($_POST['descripcion_producto']);
    $id_categoria = $_REQUEST['categorias'];

    $sql = "UPDATE productos SET nombre_producto ='$nombre_producto', descripcion_producto = '$descripcion_producto',id_categoria='$id_categoria' WHERE id_producto='$id_producto'";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Producto modificado correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al modificar el producto";
    }
    header("location:stock.php");
}
//eliminar productos
if (isset($_POST['productos_eliminar'])) {
    $id_producto = $_POST['id_producto'];

    $sql = "UPDATE productos SET estado_producto = 0 WHERE id_producto ='$id_producto'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Producto eliminado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar el producto";
    }
    header("location:stock.php");
}
//habilitar proveedor
if (isset($_POST['producto_habilitar'])) {
    $id_producto = $_POST['productos'];
    foreach ($id_producto as $id_prod) {
        $sql = "UPDATE productos SET estado_producto = 1 WHERE id_producto ='$id_prod'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Producto habiltado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el producto";
        }
    }

    header("location:stock.php");
}
//mostrar productos
if (isset($_POST['mostrar_producto'])) {
    $id_producto = $_POST['id_producto'];

    $sql = "UPDATE productos SET mostrar_producto = 1 WHERE id_producto ='$id_producto'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Exito... producto agregado a destacados";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error... no se pudo agregar el producto a destacados";
    }
    header("location:productos_dashboard.php");
}
//ocultar productos
if (isset($_POST['ocultar_producto'])) {
    $id_producto = $_POST['id_producto'];

    $sql = "UPDATE productos SET mostrar_producto = 0 WHERE id_producto ='$id_producto'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Exito... se quito el producto de destacados";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error... no se pudo quitar el producto de destacados";
    }
    header("location:productos_dashboard.php");
}
//agregar productos
if (isset($_POST['productos_agregar'])) {
    //nombre del archivo
    $name_archivo = $_FILES['archivo']['name'];
    //tipo de archivo
    $tipo_archivo = $_FILES['archivo']['type'];
    //tamaño del archivo
    $tamano_archivo = $_FILES['archivo']['size'];

    $nombre_producto = strtoupper($_POST['nombre_producto']);
    $descripcion_producto = strtoupper($_POST['descripcion_producto']);
    $precio_producto = $_POST['precio_producto'];
    $id_categoria = $_REQUEST['categorias'];
    $id_usuario = $_POST['id_usuario'];
    //


    //
    $sql = "INSERT INTO productos (nombre_producto,descripcion_producto,precio_producto,estado_producto,fecha_creacion_producto,id_categoria,id_usuario_creacion) VALUES ('$nombre_producto','$descripcion_producto','$precio_producto', '1', NOW(), '$id_categoria','$id_usuario')";

    if ($resultado = mysqli_query($conexion, $sql)) {
        if ($_FILES['archivo']['type'] != '') {
            //directorio en el servidor donde guardo las imagenes
            $path = "fotos/";
            //aqui genero el nuevo nombre del archivo en caso de que quiera cambiarle el nombre del archivo ingresado
            $nomdig = F_gen_password(13);
            //Verifico el tipo de archivo ingresado y y le asigno la extension a una variable
            if ($_FILES['archivo']['type'] == "image/pjpeg" or $_FILES['archivo']['type'] == "image/jpeg") {
                $extension = '.jpg';
            } else {
                if ($_FILES['archivo']['type'] == "image/png") {
                    $extension = '.png';
                } else {
                    if ($_FILES['archivo']['type'] == "image/gif") {
                        $extension = '.gif';
                    }
                }
            }
            $id_producto = mysqli_insert_id($conexion);
            //
            $nomdig .= $extension;
            $nuevo_nombre = $path . $nomdig;

            $sql_foto = "INSERT INTO productos_fotos(img_foto,fecha_creacion_foto,estado_foto, id_producto) VALUES ('$nuevo_nombre',NOW(),'1','$id_producto')";

            //
            if ($result_foto = mysqli_query($conexion, $sql_foto)) {
                copy($_FILES['archivo']['tmp_name'], $nuevo_nombre);

                $_SESSION['color'] = "success";
                $_SESSION['msg'] = "Producto guardado";
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error al guardar el producto";
            }
        }

    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al guardar el producto";
    }
    header("location:productos_dashboard.php");
}
//agregar fotos
if (isset($_POST['fotos_agregar'])) {
    //nombre del archivo
    $name_archivo = $_FILES['archivo']['name'];
    //tipo de archivo
    $tipo_archivo = $_FILES['archivo']['type'];
    //tamaño del archivo
    $tamano_archivo = $_FILES['archivo']['size'];

    if ($_FILES['archivo']['type'] != '') {
        //directorio en el servidor donde guardo las imagenes
        $path = "fotos/";
        //aqui genero el nuevo nombre del archivo en caso de que quiera cambiarle el nombre del archivo ingresado
        $nomdig = F_gen_password(13);
        //Verifico el tipo de archivo ingresado y y le asigno la extension a una variable
        if ($_FILES['archivo']['type'] == "image/pjpeg" or $_FILES['archivo']['type'] == "image/jpeg") {
            $extension = '.jpg';
        } else {
            if ($_FILES['archivo']['type'] == "image/png") {
                $extension = '.png';
            } else {
                if ($_FILES['archivo']['type'] == "image/gif") {
                    $extension = '.gif';
                }
            }
        }

        $id_producto = $_POST['id_product'];
        $nomdig .= $extension;
        $nuevo_nombre = $path . $nomdig;

        $select_foto = "SELECT id_foto FROM productos_fotos WHERE id_producto = $id_producto";
        $result_select = mysqli_query($conexion, $select_foto);
        $row_cnt = mysqli_num_rows($result_select);

        if ($row_cnt > 0) {
            $sql_foto = "UPDATE productos_fotos SET img_foto = '$nuevo_nombre',fecha_creacion_foto = NOW() WHERE id_producto ='$id_producto'";
            if ($result_foto = mysqli_query($conexion, $sql_foto)) {
                copy($_FILES['archivo']['tmp_name'], $nuevo_nombre);

                $_SESSION['color'] = "success";
                $_SESSION['msg'] = "Exito... imagen reemplazada correctamente";
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al reemplazar imagen";
            }
        } else {
            $sql_foto = "INSERT INTO productos_fotos (`img_foto`,fecha_creacion_foto,estado_foto,id_producto) VALUES ('$nuevo_nombre',NOW(),'1',$id_producto)";
            if ($result_foto = mysqli_query($conexion, $sql_foto)) {
                copy($_FILES['archivo']['tmp_name'], $nuevo_nombre);

                $_SESSION['color'] = "success";
                $_SESSION['msg'] = "Exito... imagen reemplazada correctamente";
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al reemplazar imagen";
            }
        }

    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error... al reemplazar imagen";
    }
    header("location:productos_dashboard.php");
}
//CATEGORIAS
if (isset($_POST['id_categoria'])) {
    $id_categoria = $_POST['id_categoria'];

    $sql = "SELECT * FROM categorias WHERE id_categoria='$id_categoria' LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $categoria = [];

    if ($rows > 0) {
        $categoria = $resultado->fetch_array();
    }

    echo json_encode($categoria, JSON_UNESCAPED_UNICODE);
}
//agregar categorias
if (isset($_POST['categorias_agregar'])) {

    $nombre_categoria = strtoupper($_POST['nombre_categoria']);
    $descripcion_categoria = strtoupper($_POST['descripcion_categoria']);

    $sql = "INSERT INTO categorias (nombre_categoria,descripcion_categoria,estado_categoria,fecha_creacion_categoria) VALUES ('$nombre_categoria','$descripcion_categoria', '1', NOW())";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Categoria guardado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al cargar la categoria";
    }
    header("location:categorias.php");
}
//editar categorias
if (isset($_POST['categorias_editar'])) {
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = strtoupper($_POST['nombre_categoria']);
    $descripcion_categoria = strtoupper($_POST['descripcion_categoria']);

    $sql = "UPDATE categorias SET nombre_categoria ='$nombre_categoria', descripcion_categoria = '$descripcion_categoria' WHERE id_categoria='$id_categoria'";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Categoria modificada correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al modificar la categoria";
    }
    header("location:categorias.php");
}
//eliminar categorias
if (isset($_POST['categorias_eliminar'])) {
    $id_categoria = $_POST['id_categoria'];

    $sql = "UPDATE categorias SET estado_categoria = 0 WHERE id_categoria ='$id_categoria'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Categoria eliminada";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar la categoria";
    }
    header("location:categorias.php");
}
//habilitar categorias
if (isset($_POST['categorias_habilitar'])) {
    $id_categoria = $_POST['frutas'];
    foreach ($id_categoria as $id_cat) {
        $sql = "UPDATE categorias SET estado_categoria = 1 WHERE id_categoria ='$id_cat'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Categoria habiltada";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar la categoria";
        }
    }
    header("location:categorias.php");
}
//PROVEEDORES
if (isset($_POST['id_proveedor'])) {
    $id_proveedor = $_POST['id_proveedor'];

    $sql = "SELECT id_proveedor,razon_social_proveedor,cuit_proveedor, condicion_iva_proveedor,telefono_proveedor,correo_proveedor,domicilio_proveedor,pais_proveedor,provincia_proveedor,localidad_proveedor, DATE_FORMAT(fecha_alta_proveedor,'%d-%m-%Y %H:%m:%S') AS fecha_alta_proveedor, estado_proveedor, nombre_usuario  FROM proveedores INNER JOIN usuarios ON proveedores.id_usuario_creacion = usuarios.id_usuario WHERE id_proveedor='$id_proveedor' LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $proveedor = [];

    if ($rows > 0) {
        $proveedor = $resultado->fetch_array();
    }

    echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);
}
//agregar proveedor
if (isset($_POST['proveedor_agregar'])) {

    $razon_social_proveedor = strtoupper($_POST['razon_social_proveedor']);
    $cuit_proveedor = $_POST['cuit_proveedor'];
    $condicion_iva_proveedor = strtoupper($_POST['condicion_iva_proveedor']);
    $telefono_proveedor = $_POST['telefono_proveedor'];
    $correo_proveedor = $_POST['correo_proveedor'];
    $domicilio_proveedor = strtoupper($_POST['domicilio_proveedor']);
    $pais_proveedor = strtoupper($_POST['pais_proveedor']);
    $provincia_proveedor = strtoupper($_POST['provincia_proveedor']);
    $localidad_proveedor = strtoupper($_POST['localidad_proveedor']);
    $id_usuario = $_POST['id_usuario'];

    $sql = "INSERT INTO proveedores (razon_social_proveedor,cuit_proveedor,condicion_iva_proveedor,telefono_proveedor,correo_proveedor,domicilio_proveedor,pais_proveedor,provincia_proveedor,localidad_proveedor,fecha_alta_proveedor,estado_proveedor,id_usuario_creacion) VALUES ('$razon_social_proveedor','$cuit_proveedor','$condicion_iva_proveedor','$telefono_proveedor','$correo_proveedor','$domicilio_proveedor','$pais_proveedor','$provincia_proveedor','$localidad_proveedor',NOW(), '1',$id_usuario)";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Proveedor guardado con exito";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al guardar el proveedor";
    }
    header("location:proveedores.php");
}
//editar proveedor
if (isset($_POST['proveedor_editar'])) {
    $id_proveedor = $_POST['id_proveedor'];
    $razon_social_proveedor = strtoupper($_POST['razon_social_proveedor']);
    $cuit_proveedor = $_POST['cuit_proveedor'];
    $condicion_iva_proveedor = strtoupper($_POST['condicion_iva_proveedor']);
    $telefono_proveedor = $_POST['telefono_proveedor'];
    $correo_proveedor = $_POST['correo_proveedor'];
    $domicilio_proveedor = strtoupper($_POST['domicilio_proveedor']);
    $pais_proveedor = strtoupper($_POST['pais_proveedor']);
    $provincia_proveedor = strtoupper($_POST['provincia_proveedor']);
    $localidad_proveedor = strtoupper($_POST['localidad_proveedor']);

    $sql = "UPDATE proveedores SET razon_social_proveedor ='$razon_social_proveedor', cuit_proveedor = '$cuit_proveedor', condicion_iva_proveedor = '$condicion_iva_proveedor', telefono_proveedor = '$telefono_proveedor', correo_proveedor = '$correo_proveedor', domicilio_proveedor = '$domicilio_proveedor', pais_proveedor = '$pais_proveedor', provincia_proveedor = '$provincia_proveedor', localidad_proveedor = '$localidad_proveedor' WHERE id_proveedor='$id_proveedor'";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Proveedor modificado correctamente ";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al modificar el proveedor";
    }
    header("location:proveedores.php");
}
//eliminar proveedor
if (isset($_POST['proveedor_eliminar'])) {
    $id_proveedor = $_POST['id_proveedor'];

    $sql = "UPDATE proveedores SET estado_proveedor = 0 WHERE id_proveedor ='$id_proveedor'";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Proveedor eliminado";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al eliminar el proveedor";
    }
    header("location:proveedores.php");
}
//habilitar proveedor
if (isset($_POST['proveedor_habilitar'])) {
    $id_proveedor = $_POST['proveedores'];
    foreach ($id_proveedor as $id_prov) {
        $sql = "UPDATE proveedores SET estado_proveedor = 1 WHERE id_proveedor ='$id_prov'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Proveedor habiltado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el proveedor";
        }
    }
    header("location:proveedores.php");
}
//CLIENTES
//Clientes ver
if (isset($_POST['id_cliente_mostrar'])) {
    $id_persona = $_POST['id_cliente_mostrar'];

    $sql = "SELECT personas.id_persona, nombre_persona, apellido_persona, cuil_persona,fecha_nac_persona,sexo_persona,num_telefono,correo, domicilio_fiscal,condicion_iva FROM personas INNER JOIN clientes ON personas.id_persona = clientes.id_persona WHERE personas.id_persona=$id_persona LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    $rows = $resultado->num_rows;

    $persona = [];

    if ($rows > 0) {
        $persona = $resultado->fetch_array();
    }

    echo json_encode($persona, JSON_UNESCAPED_UNICODE);
}
//Cliente nuevo
if (isset($_POST['guardar_cliente'])) {
    $nombre_persona = strtoupper($_POST['nombre_persona']);
    $apellido_persona = strtoupper($_POST['apellido_persona']);
    $cuil_persona = $_POST['cuil_persona'];
    $fecha_nac_persona = $_POST['fecha_nac_persona'];
    $sexo_persona = strtoupper($_POST['sexo_persona']);
    $num_telefono = $_POST['num_telefono'];
    $correo = $_POST['correo'];
    $domicilio_fiscal = strtoupper($_POST['domicilio_fiscal']);
    $condicion_iva = strtoupper($_POST['condicion_iva']);

    $sql = "INSERT INTO personas (nombre_persona, apellido_persona, cuil_persona, fecha_nac_persona,sexo_persona,num_telefono,correo)
    VALUES ('$nombre_persona', '$apellido_persona', $cuil_persona, '$fecha_nac_persona','$sexo_persona','$num_telefono','$correo')";
    if ($resultado = mysqli_query($conexion, $sql)) {
        $id_persona = mysqli_insert_id($conexion);
        $sql_cli = "INSERT INTO clientes (id_persona,domicilio_fiscal,condicion_iva,estado_cliente,fecha_creacion) VALUES ('$id_persona','$domicilio_fiscal','$condicion_iva','1', NOW())";
        if ($result_cli = mysqli_query($conexion, $sql_cli)) {
            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Cliente cargado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al cargar el cliente";
        }
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al guardar la persona";
    }
    header("location:clientes.php");
}
//Cliente editar
if (isset($_POST['cliente_editar'])) {
    $id_persona = $_POST['id_cliente_mostrar'];
    $nombre_persona = strtoupper($_POST['nombre_persona']);
    $apellido_persona = strtoupper($_POST['apellido_persona']);
    $cuil_persona = $_POST['cuil_persona'];
    $fecha_nac_persona = $_POST['fecha_nac_persona'];
    $sexo_persona = strtoupper($_POST['sexo_persona']);
    $num_telefono = $_POST['num_telefono'];
    $correo = $_POST['correo'];
    $domicilio_fiscal = strtoupper($_POST['domicilio_fiscal']);
    $condicion_iva = strtoupper($_POST['condicion_iva']);

    $sql = "UPDATE personas SET nombre_persona ='$nombre_persona', apellido_persona = '$apellido_persona', cuil_persona=$cuil_persona,fecha_nac_persona='$fecha_nac_persona',sexo_persona='$sexo_persona',num_telefono='$num_telefono',correo='$correo'   WHERE id_persona=$id_persona";
    if ($resultado = mysqli_query($conexion, $sql)) {
        $sql_cliente = "UPDATE clientes SET domicilio_fiscal ='$domicilio_fiscal', condicion_iva = '$condicion_iva' WHERE id_persona=$id_persona";
        if ($result = mysqli_query($conexion, $sql_cliente)) {
            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Cliente actualizado";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al actualizar el cliente";
        }
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al actualizar la persona";
    }

    header('Location: clientes.php');
}
//Cliente eliminar
if (isset($_POST['eliminar_cliente'])) {
    $id_persona = $_POST['id_persona'];
    $sql = "UPDATE clientes SET estado_cliente = 0 WHERE id_persona=$id_persona";

    if ($resultado = mysqli_query($conexion, $sql)) {

        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Cliente desabilitado correctamente";
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al desabilitar el cliente";
    }

    header('Location: clientes.php');
}
//Cliente habilitar
if (isset($_POST['habilitar_cliente'])) {
    $id_persona = $_POST['personas'];
    foreach ($id_persona as $id_per) {
        $sql = "UPDATE clientes SET estado_cliente = 1 WHERE id_persona ='$id_per'";

        if ($resultado = mysqli_query($conexion, $sql)) {

            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Cliente habilitado correctamente";
        } else {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error al habilitar el cliente";
        }
    }
    header('Location: clientes.php');
}
//COMPRAS
//Compras agregar
if (isset($_POST['compras_agregar'])) {
    //campos de tabla compras
    $fecha_compra = $_POST['fecha_compra'];
    $nro_comprobante = $_POST['nro_comprobante'];
    $id_proveedor = $_REQUEST['proveedores'];
    $id_usuario = $_POST['id_usuario'];
    $cantidad_compra = $_POST['cantidad_compra'];
    $precio_unitario = $_POST['precio_unitario'];
    $id_producto = $_REQUEST['productos'];

    $sql = "INSERT INTO compras (fecha_compra,nro_comprobante,id_producto,cantidad_compra,precio_unitario,estado_compra,id_proveedor,id_usuario)
    VALUES ('$fecha_compra','$nro_comprobante','$id_producto','$cantidad_compra','$precio_unitario',1,'$id_proveedor','$id_usuario')";

    if ($resultado = mysqli_query($conexion, $sql)) {
        $sql_stock = "SELECT id_producto,cantidad FROM stock WHERE id_producto = $id_producto";
        if ($result_stock = mysqli_query($conexion, $sql_stock)) {
            $count = mysqli_num_rows($result_stock);

            if ($count > 0) {
                $update_stock = "UPDATE stock SET cantidad = cantidad + $cantidad_compra WHERE id_producto=$id_producto";
                if ($resultado_update = mysqli_query($conexion, $update_stock)) {
                    $_SESSION['color'] = "success";
                    $_SESSION['msg'] = "Compra cargada correctamente actualizando el stock";

                }
            } else {
                $insert_stock = "INSERT INTO stock (id_producto,cantidad) VALUES ($id_producto,$cantidad_compra)";
                $resultado_insert = mysqli_query($conexion, $insert_stock);
                $_SESSION['color'] = "success";
                $_SESSION['msg'] = "Compra cargada correctamente insertando el stock";
            }
        }
    } else {
        $_SESSION['color'] = "error";
        $_SESSION['msg'] = "Error al cargar la compra";
    }
    header("location:compras.php");
}
if (isset($_POST['venta_agregar'])) {
    //$id_producto = $_POST['id_producto'];
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $cantidad = $_POST['cantidad'];
    $cantidad_venta = $_POST['cantidad_venta'];
    $id_usuario = $_POST['id_usuario'];

    if (!isset($_SESSION['venta'])) {
        $producto = array(
            'id_producto' => $id_producto,
            'nombre_producto' => $nombre_producto,
            'precio_producto' => $precio_producto,
            'cantidad' => $cantidad,
            'cantidad_venta' => $cantidad_venta,
            'id_usuario' => $id_usuario
        );
        $_SESSION['venta'][0] = $producto;
    } else {
        $idProductos = array_column($_SESSION['venta'], "id_producto");
        if (in_array($id_producto, $idProductos)) {
            $_SESSION['color'] = "error";
            $_SESSION['msg'] = "Error... el producto ya fue seleccionado";
        } else {
            $numero_productos = count($_SESSION['venta']);
            $producto = array(
                'id_producto' => $id_producto,
                'nombre_producto' => $nombre_producto,
                'precio_producto' => $precio_producto,
                'cantidad' => $cantidad,
                'cantidad_venta' => $cantidad_venta,
                'id_usuario' => $id_usuario
            );
            $_SESSION['venta'][$numero_productos] = $producto;


        }
    }
    header("location:ventas_generar.php");
}
//VENTAS
//Querys session ventas
if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'venta_agregar':
            if (is_numeric($_POST['id_prod'])) {
                $id_producto = $_POST['id_prod'];
            } else {
                break;
            }
            if (is_string($_POST['nombre_producto'])) {
                $nombre_producto = $_POST['nombre_producto'];
            } else {
                break;
            }
            if (is_numeric($_POST['precio_venta'])) {
                $precio_venta = $_POST['precio_venta'];
            } else {
                break;
            }
            if (is_numeric($_POST['cantidad'])) {
                $cantidad = $_POST['cantidad'];
            } else {
                break;
            }
            if (is_numeric($_POST['cantidad_venta'])) {
                if ($_POST['cantidad_venta'] > $cantidad) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... la cantidad de venta no puede ser mayor al stock";
                    header("location:ventas.php");
                    break;
                } else {
                    $cantidad_venta = $_POST['cantidad_venta'];
                }
            } else {
                break;
            }

            if (is_numeric($_POST['id_usuario'])) {
                $id_usuario = $_POST['id_usuario'];
            } else {
                break;
            }
            if (!isset($_SESSION['venta'])) {
                $producto = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_venta' => $precio_venta,
                    'cantidad' => $cantidad,
                    'cantidad_venta' => $cantidad_venta,
                    'id_usuario' => $id_usuario
                );
                $_SESSION['venta'][0] = $producto;
            } else {
                $idProductos = array_column($_SESSION['venta'], "id_producto");
                if (in_array($id_producto, $idProductos)) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... el producto ya fue seleccionado";
                } else {
                    $numero_productos = count($_SESSION['venta']);
                    $producto = array(
                        'id_producto' => $id_producto,
                        'nombre_producto' => $nombre_producto,
                        'precio_venta' => $precio_venta,
                        'cantidad' => $cantidad,
                        'cantidad_venta' => $cantidad_venta,
                        'id_usuario' => $id_usuario
                    );
                    $_SESSION['venta'][$numero_productos] = $producto;

                }
            }
            header("location:ventas_generar.php");
            break;

        case 'agregar_persona':
            if (is_numeric(openssl_decrypt($_POST['id_persona'], COD, KEY))) {
                $id_persona = openssl_decrypt($_POST['id_persona'], COD, KEY);
            } else {
                break;
            }
            $nombre_persona = $_POST['nombre_persona'];
            $apellido_persona = $_POST['apellido_persona'];
            $cuil_persona = $_POST['cuil_persona'];
            $correo = $_POST['correo'];
            $num_telefono = $_POST['num_telefono'];
            $domicilio_fiscal = $_POST['domicilio_fiscal'];
            $condicion_iva = $_POST['condicion_iva'];
            if (!isset($_SESSION['persona_venta'])) {
                $persona = array(
                    'id_persona' => $id_persona,
                    'nombre_persona' => $nombre_persona,
                    'apellido_persona' => $apellido_persona,
                    'cuil_persona' => $cuil_persona,
                    'correo' => $correo,
                    'num_telefono' => $num_telefono,
                    'domicilio_fiscal' => $domicilio_fiscal,
                    'condicion_iva' => $condicion_iva

                );
                $_SESSION['persona_venta'][0] = $persona;
            } else {
                if ($_SESSION['persona_venta'] > 0) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... ya fue seleccionada una persona";
                }
            }
            header("location:ventas_generar.php");
            break;
        case 'Eliminar':
            if (is_numeric($_POST['id_prod'])) {
                $id_producto = $_POST['id_prod'];
                foreach ($_SESSION['venta'] as $indice => $producto) {
                    if ($producto['id_producto'] == $id_producto) {
                        unset($_SESSION['venta'][$indice]);
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Producto eliminado correctamente del detalle de venta";
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al eliminar el producto del detalle de venta";
                break;
            }
            header("location:ventas_generar.php");
            break;
        case 'limpiar_campo':
            if (is_numeric(openssl_decrypt($_POST['id_persona'], COD, KEY))) {
                $id_persona = openssl_decrypt($_POST['id_persona'], COD, KEY);
                foreach ($_SESSION['persona_venta'] as $indice => $persona) {
                    if ($persona['id_persona'] == $id_persona) {
                        unset($_SESSION['persona_venta']);
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Campo limpiado correctamente";
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al limpiar campo";
                break;
            }
            header("location:ventas_generar.php");
            break;
        case 'proceder':
            foreach ($_SESSION['persona_venta'] as $indice => $persona) {
                $id_persona = $persona['id_persona'];
            }
            foreach ($_SESSION['venta'] as $indice => $producto) {
                $total = $total + ($producto['precio_venta'] * $producto['cantidad_venta']);
                $id_usuario = $producto['id_usuario'];
            }

            $sql_insertar_venta = "INSERT INTO `ventas` (`id_venta`,`fecha_venta`,`total_venta`,`id_persona`, `id_usuario`) VALUES (NULL,  NOW(), '$total', '$id_persona', '1');";
            if ($result_insertar_venta = mysqli_query($conexion, $sql_insertar_venta)) {
                $id_venta = mysqli_insert_id($conexion);
                foreach ($_SESSION['venta'] as $indice => $producto) {

                    $id_producto = $producto['id_producto'];
                    $cantidad_venta = $producto['cantidad_venta'];
                    $precio_venta = $producto['precio_venta'];

                    $sql_insertar_detalle_venta = "INSERT INTO `detalle_ventas` (`id_detalle_venta`, `id_venta`, `id_producto`, `cantidad_producto`,`precio_unitario`) VALUES (NULL, $id_venta, $id_producto,$cantidad_venta, $precio_venta);";
                    if ($result_insertar_detalle_venta = mysqli_query($conexion, $sql_insertar_detalle_venta)) {
                        unset($_SESSION['venta'][$indice]);
                        unset($_SESSION['persona_venta']);
                        $sql_stock = "SELECT id_producto,cantidad FROM stock WHERE id_producto = $id_producto";
                        if ($result_stock = mysqli_query($conexion, $sql_stock)) {
                            $update_stock = "UPDATE stock SET cantidad = cantidad - $cantidad_venta WHERE id_producto=$id_producto";
                            if ($resultado_update = mysqli_query($conexion, $update_stock)) {
                                $_SESSION['color'] = "success";
                                $_SESSION['msg'] = "Venta cargada correctamente actualizando el stock";
                            }
                        }
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Exito... comprobante generado correctamente";
                        header("location:ventas.php");
                    } else {
                        $_SESSION['color'] = "error";
                        $_SESSION['msg'] = "Error... algo salio mal";
                        header("location:ventas_generar.php");
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al ingresar la venta";
            }
            break;
    }
}
//COMPRAS
//Querys session compras
if (isset($_POST['btnAgregar'])) {
    switch ($_POST['btnAgregar']) {
        case 'agregar':
            if (is_numeric($_POST['id_product'])) {
                $id_producto = $_POST['id_product'];
            } else {
                break;
            }
            if (is_string($_POST['nombre_producto'])) {
                $nombre_producto = $_POST['nombre_producto'];
            } else {
                break;
            }
            if (is_numeric($_POST['precio_unitario'])) {
                $precio_unitario = $_POST['precio_unitario'];
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... el precio del producto tiene que ser numerico";
                header("location:compras_generar.php");
                break;
            }
            if (is_numeric($_POST['cantidad_compra'])) {
                $cantidad_compra = $_POST['cantidad_compra'];
            } else {
                break;
            }
            if (is_numeric($_POST['id_usuario'])) {
                $id_usuario = $_POST['id_usuario'];
            } else {
                break;
            }
            if (!isset($_SESSION['compra'])) {
                $producto_compra = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_unitario' => $precio_unitario,
                    'cantidad_compra' => $cantidad_compra,
                    'id_usuario' => $id_usuario
                );
                $_SESSION['compra'][0] = $producto_compra;
            } else {
                $idProductoCompra = array_column($_SESSION['compra'], "id_producto");
                if (in_array($id_producto, $idProductoCompra)) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... el producto ya fue seleccionado";
                } else {
                    $numero_productos = count($_SESSION['compra']);
                    $producto_compra = array(
                        'id_producto' => $id_producto,
                        'nombre_producto' => $nombre_producto,
                        'precio_unitario' => $precio_unitario,
                        'cantidad_compra' => $cantidad_compra,
                        'id_usuario' => $id_usuario
                    );
                    $_SESSION['compra'][$numero_productos] = $producto_compra;

                }
            }
            header("location:compras_generar.php");
            break;

        case 'agregar_proveedor':
            if (is_numeric(openssl_decrypt($_POST['id_proveedor'], COD, KEY))) {
                $id_proveedor = openssl_decrypt($_POST['id_proveedor'], COD, KEY);
            } else {
                break;
            }
            $razon_social_proveedor = $_POST['razon_social_proveedor'];
            $cuit_proveedor = $_POST['cuit_proveedor'];
            if (!isset($_SESSION['proveedor'])) {
                $proveedor = array(
                    'id_proveedor' => $id_proveedor,
                    'razon_social_proveedor' => $razon_social_proveedor,
                    'cuit_proveedor' => $cuit_proveedor

                );
                $_SESSION['proveedor'][0] = $proveedor;
            } else {
                if ($_SESSION['proveedor'] > 0) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... ya fue seleccionado un proveedor";
                }
            }
            header("location:compras_generar.php");
            break;
        case 'eliminar':
            if (is_numeric($_POST['id_product'])) {
                $id_producto = $_POST['id_product'];
                foreach ($_SESSION['compra'] as $indice => $producto) {
                    if ($producto['id_producto'] == $id_producto) {
                        unset($_SESSION['compra'][$indice]);
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Producto eliminado correctamente del detalle";
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al eliminar el producto del detalle";
                break;
            }
            header("location:compras_generar.php");
            break;
        case 'eliminar_nuevo':
            if (is_numeric($_POST['id_product'])) {
                $id_producto = $_POST['id_product'];
                foreach ($_SESSION['nuevo_producto'] as $indice => $producto) {
                    if ($producto['id_producto'] == $id_producto) {
                        unset($_SESSION['nuevo_producto'][$indice]);
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Producto eliminado correctamente del detalle";
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al eliminar el producto del detalle";
                break;
            }
            header("location:compras_generar.php");
            break;
        case 'limpiar_campo':
            if (is_numeric(openssl_decrypt($_POST['id_proveedor'], COD, KEY))) {
                $id_proveedor = openssl_decrypt($_POST['id_proveedor'], COD, KEY);
                foreach ($_SESSION['proveedor'] as $indice => $proveedor) {
                    if ($proveedor['id_proveedor'] == $id_proveedor) {
                        unset($_SESSION['proveedor']);
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Campo limpiado correctamente";
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al limpiar campo";
                break;
            }
            header("location:compras_generar.php");
            break;
        case 'guardar_producto':
            if (is_string($_POST['nombre_producto'])) {
                $nombre_producto = $_POST['nombre_producto'];
            } else {
                break;
            }
            if (is_string($_POST['descripcion_producto'])) {
                $descripcion_producto = $_POST['descripcion_producto'];
            } else {
                break;
            }
            if (is_numeric($_POST['precio_unitario'])) {
                $precio_unitario = $_POST['precio_unitario'];
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... el precio del producto tiene que ser numerico";
                header("location:compras_generar.php");
                break;
            }
            if (is_numeric($_POST['cantidad_compra'])) {
                $cantidad_compra = $_POST['cantidad_compra'];
            } else {
                break;
            }
            if (is_numeric($_REQUEST['categorias'])) {
                $id_categoria = $_REQUEST['categorias'];
            } else {
                break;
            }
            if (is_numeric($_POST['id_usuario'])) {
                $id_usuario = $_POST['id_usuario'];
            } else {
                break;
            }
            $id_producto = rand(1000, 1100);
            if (!isset($_SESSION['nuevo_producto'])) {
                $nuevo_prod = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'descripcion_producto' => $descripcion_producto,
                    'id_categoria' => $id_categoria,
                    'id_usuario_creacion' => $id_usuario,
                    'precio_unitario' => $precio_unitario,
                    'cantidad_compra' => $cantidad_compra
                );
                $_SESSION['nuevo_producto'][0] = $nuevo_prod;

            } else {

                $numero_prod = count($_SESSION['nuevo_producto']);

                $nuevo_prod = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'descripcion_producto' => $descripcion_producto,
                    'id_categoria' => $id_categoria,
                    'id_usuario_creacion' => $id_usuario,
                    'precio_unitario' => $precio_unitario,
                    'cantidad_compra' => $cantidad_compra,
                );
                $_SESSION['nuevo_producto'][$numero_prod] = $nuevo_prod;

            }
            header("location:compras_generar.php");
            break;

        case 'proceder':
            foreach ($_SESSION['proveedor'] as $indice => $proveedor) {
                $id_proveedor = $proveedor['id_proveedor'];
            }
            foreach ($_SESSION['compra'] as $indice => $producto_compra) {
                $total1 = $total1 + ($producto_compra['precio_unitario'] * $producto_compra['cantidad_compra']);
                $id_usuario = $producto_compra['id_usuario'];
            }
            foreach ($_SESSION['datos_compra'] as $indice => $datos) {
                $fecha_compra = $datos['fecha_compra'];
                $nro_comprobante = $datos['nro_comprobante'];
            }
            foreach ($_SESSION['nuevo_producto'] as $indice => $nuevo_prod) {
                $total2 = $total2 + ($nuevo_prod['precio_unitario'] * $nuevo_prod['cantidad_compra']);
                $id_usuario = $nuevo_prod['id_usuario_creacion'];
            }
            $total = $total1 + $total2;
            $sql_insertar_compra = "INSERT INTO `compras` (`id_compra`, `fecha_compra`, `nro_comprobante`, `total_compra`, `estado_compra`, `id_proveedor`, `id_usuario`) VALUES (NULL, '$fecha_compra', '$nro_comprobante', $total, '1',$id_proveedor, '$id_usuario');";
            if ($result_insertar_compra = mysqli_query($conexion, $sql_insertar_compra)) {
                $id_compra = mysqli_insert_id($conexion);

                foreach ($_SESSION['nuevo_producto'] as $indice => $nuevo_prod) {

                    $id_producto = $nuevo_prod['id_producto'];
                    $nombre_producto = $nuevo_prod['nombre_producto'];
                    $descripcion_producto = $nuevo_prod['descripcion_producto'];
                    $id_categoria = $nuevo_prod['id_categoria'];
                    $id_usuario_creacion = $nuevo_prod['id_usuario_creacion'];

                    $sql_prod = "INSERT INTO `productos` (`id_producto`,`nombre_producto`,`descripcion_producto`,`estado_producto`,`id_categoria`,`id_usuario_creacion`) VALUES (NULL,'$nombre_producto','$descripcion_producto','1','$id_categoria','$id_usuario_creacion')";

                    if ($result_prod = mysqli_query($conexion, $sql_prod)) {
                        $_SESSION['color'] = "success";
                        $_SESSION['msg'] = "Compra cargada correctamente actualizando el stock";
                        $id_producto = mysqli_insert_id($conexion);
                        $cantidad_compra = $nuevo_prod['cantidad_compra'];
                        $precio_unitario = $nuevo_prod['precio_unitario'];
                        $sql_insertar_detalle_compra = "INSERT INTO `detalle_compras` (`id_detalle_compra`, `id_compra`, `id_producto`, `cantidad_compra`,`precio_unitario`) VALUES (NULL, $id_compra, $id_producto,$cantidad_compra, $precio_unitario);";
                        if ($result_insertar_detalle_compra = mysqli_query($conexion, $sql_insertar_detalle_compra)) {
                            $sql_stock = "SELECT id_producto,cantidad FROM stock WHERE id_producto = $id_producto";
                            if ($result_stock = mysqli_query($conexion, $sql_stock)) {
                                $count = mysqli_num_rows($result_stock);

                                if ($count > 0) {
                                    $update_stock = "UPDATE stock SET cantidad = cantidad + $cantidad_compra WHERE id_producto=$id_producto";
                                    if ($resultado_update = mysqli_query($conexion, $update_stock)) {
                                        $_SESSION['color'] = "success";
                                        $_SESSION['msg'] = "Compra cargada correctamente actualizando el stock";

                                    }
                                } else {
                                    $insert_stock = "INSERT INTO stock (id_producto,cantidad) VALUES ($id_producto,$cantidad_compra)";
                                    $resultado_insert = mysqli_query($conexion, $insert_stock);
                                    $_SESSION['color'] = "success";
                                    $_SESSION['msg'] = "Compra cargada correctamente insertando el stock";
                                }
                                if (empty($_SESSION['compra'])) {
                                    unset($_SESSION['compra'][$indice]);
                                    unset($_SESSION['proveedor']);
                                    unset($_SESSION['datos_compra']);
                                    unset($_SESSION['nuevo_producto']);
                                } else {
                                    unset($_SESSION['nuevo_producto']);
                                }

                                $_SESSION['color'] = "success";
                                $_SESSION['msg'] = "Compra cargada correctamente";
                                header("location:compras_generar.php");
                            }
                        } else {
                            $_SESSION['color'] = "error";
                            $_SESSION['msg'] = "Error... algo salio mal";
                            header("location:compras_generar.php");
                        }

                    } else {
                        $_SESSION['color'] = "error";
                        $_SESSION['msg'] = "Compra cargada correctamente actualizando el stock";
                    }

                }
                foreach ($_SESSION['compra'] as $indice => $producto_compra) {

                    $id_producto = $producto_compra['id_producto'];
                    $cantidad_compra = $producto_compra['cantidad_compra'];
                    $precio_unitario = $producto_compra['precio_unitario'];

                    $sql_insertar_detalle_compra = "INSERT INTO `detalle_compras` (`id_detalle_compra`, `id_compra`, `id_producto`, `cantidad_compra`,`precio_unitario`) VALUES (NULL, $id_compra, $id_producto,$cantidad_compra, $precio_unitario);";
                    if ($result_insertar_detalle_compra = mysqli_query($conexion, $sql_insertar_detalle_compra)) {
                        $sql_stock = "SELECT id_producto,cantidad FROM stock WHERE id_producto = $id_producto";
                        if ($result_stock = mysqli_query($conexion, $sql_stock)) {
                            $count = mysqli_num_rows($result_stock);

                            if ($count > 0) {
                                $update_stock = "UPDATE stock SET cantidad = cantidad + $cantidad_compra WHERE id_producto=$id_producto";
                                if ($resultado_update = mysqli_query($conexion, $update_stock)) {
                                    $_SESSION['color'] = "success";
                                    $_SESSION['msg'] = "Compra cargada correctamente actualizando el stock";

                                }
                            } else {
                                $insert_stock = "INSERT INTO stock (id_producto,cantidad) VALUES ($id_producto,$cantidad_compra)";
                                $resultado_insert = mysqli_query($conexion, $insert_stock);
                                $_SESSION['color'] = "success";
                                $_SESSION['msg'] = "Compra cargada correctamente insertando el stock";
                            }
                            unset($_SESSION['compra'][$indice]);
                            unset($_SESSION['proveedor']);
                            unset($_SESSION['datos_compra']);
                            $_SESSION['color'] = "success";
                            $_SESSION['msg'] = "Compra cargada correctamente";
                            header("location:compras_generar.php");
                        }
                    } else {
                        $_SESSION['color'] = "error";
                        $_SESSION['msg'] = "Error... algo salio mal";
                        header("location:compras_generar.php");
                    }
                }
            } else {
                $_SESSION['color'] = "error";
                $_SESSION['msg'] = "Error... al ingresar la compra";
            }
            break;
        case 'fecha_comprobante':
            $fecha_compra = $_POST['fecha_compra'];
            $nro_comprobante = $_POST['nro_comprobante'];
            if (!isset($_SESSION['datos_compra'])) {
                $datos = array(
                    'fecha_compra' => $fecha_compra,
                    'nro_comprobante' => $nro_comprobante
                );
                $_SESSION['datos_compra'][0] = $datos;
            } else {
                if ($_SESSION['datos_compra'] > 0) {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error... ya fueron ingresados los datos";
                }
            }
            header("location:compras_generar.php");
            break;
        case 'limpiar_fecha_comprobante':
            $nro_comprobante = openssl_decrypt($_POST['nro_comprobante'], COD, KEY);
            foreach ($_SESSION['datos_compra'] as $indice => $datos) {
                if ($datos['nro_comprobante'] == $nro_comprobante) {
                    unset($_SESSION['datos_compra']);
                    $_SESSION['color'] = "success";
                    $_SESSION['msg'] = "Campo limpiado correctamente";
                } else {
                    $_SESSION['color'] = "error";
                    $_SESSION['msg'] = "Error no se pudieron borrar los datos";
                }
            }
            header("location:compras_generar.php");
            break;
    }
}