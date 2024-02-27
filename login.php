<?php
session_start();
error_reporting(0);
// llamar ala conexión de base de datos
include 'includes/conexion.php';
$result_recaptcha = false;
if (isset($_POST['g-recaptcha-response'])) {

  //La respuesta del recaptcha
  $respuesta = $_POST['g-recaptcha-response'];
  //La ip del usuario
  $ipuser = $_SERVER['REMOTE_ADDR'];
  //Tu clave secretra de recaptcha
  $clavesecreta = '6LfHCdgnAAAAABZaJfy-CDHvLSDBNLo_xUcoUEPS';
  //La url preparada para enviar
  $urlrecaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=$clavesecreta&response=$respuesta&remoteip=$ipuser";

  //Leemos la respuesta (suele funcionar solo en remoto)
  $respuesta = file_get_contents($urlrecaptcha);

  //Comprobamos el success
  $dividir = explode('"success":', $respuesta);
  $obtener = explode(',', $dividir[1]);

  //Obtenemos el estado
  $estado = trim($obtener[0]);


  if ($estado == 'true') {
    //Si es ok
    //echo $estado;
    $result_recaptcha = true;
  } else if ($estado == 'false') {
    //Si es error
    //echo $estado;
    $result_recaptcha = false;
  }

}
if (isset($_POST['ingresar'])) {
  $nombre_usuario = $_POST['nombre_usuario'];
  $clave_usuario = md5($_POST['clave_usuario']);

  // generar una consulta que extraigo los datos de la bd
  $consulta = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' and clave_usuario = '$clave_usuario'";
  if ($resultado = mysqli_query($conexion, $consulta)) {
    while ($row = mysqli_fetch_array($resultado)) {
      $userid = $row['id_usuario'];
      $userok = $row['nombre_usuario'];
      $passwordok = $row['clave_usuario'];
    }
    
  }
  
  $sql = "SELECT id_usuario,nombre_modulo,estado FROM usuario_modulos INNER JOIN modulos ON usuario_modulos.id_modulo = modulos.id_modulo WHERE id_usuario='$userid' and estado_modulo = 1 and estado = 1";
  // $result = mysqli_query($conexion, $sql);
  if ($result = mysqli_query($conexion, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
      $nombre_modulo[] = $row['nombre_modulo'];
    }
  }
  mysqli_close($conexion);
  if (isset($nombre_usuario) && isset($clave_usuario)) {
    if ($nombre_usuario == $userok && $clave_usuario == $passwordok && $result_recaptcha == true) {
      $_SESSION['login'] = TRUE;
      $_SESSION['nombre_usuario'] = $nombre_usuario;
      $_SESSION['id_usuario'] = $userid;
      $_SESSION['nombre_modulo'] = $nombre_modulo;
      header("location:principal.php");
    } else {
      if ($result_recaptcha == false) {
        $error_captcha .= '<p style="color:red; font-weight: bold; padding: 10px 0px 0px 160px;">*Completar captcha</p>';
      } else {

        $mensaje .= '<p style="color:red; font-weight: bold;"></strong>Usuario/Contraseña invalidos.</strong></p>';
      }
    }
  } else {
    $mensaje .= '<p style="color:red; font-weight: bold;"></strong>Usuario/Contraseña invalidos.</strong></p>';
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <main>
    
    
    <script>
      $(".alert").alert();
    </script>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form1" class="formulario" name="form1" method="post">
      <div class="formulario__grupo formulario__grupo-btn-enviar">
        <h3 class="titulo__form">INICIO DE SESION</h3>
        <div class="formulario__grupo" id="grupo__correo">
          <label for="correo" class="formulario__label">Usuario</label>
          <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" name="nombre_usuario" id="nombre_usuario" placeholder="Juan23">
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
        </div><br>
        <div class="formulario__grupo" id="grupo__claveUsuario">
          <label for="clave_usuario" class="formulario__label">Contraseña</label>
          <div class="formulario__grupo-input">
            <input type="password" class="formulario__input" name="clave_usuario" id="clave_usuario">
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
        </div>
        <div class="formulario__grupo">
          <label for=""></label>
          <!-- checkbox que nos permite activar o desactivar la opcion -->
          <div class="formulario__grupo-input" style="margin-right: 68px;">
            <input type="checkbox" id="mostrar_contrasena" title="click para mostrar contraseña"><label for="">Mostrar Contraseña</label>
          </div>
        </div><br>
        <div class="formulario__grupo">
          <div class="formulario__grupo-input">
            <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfHCdgnAAAAALe5XZlWVAvpvaYZAWpvdzRjBGJm">

            </div>
            <?php echo $error_captcha; ?>
          </div>
        </div><br>
        <div>
          <a type="subtmit" name="volver" role="button" href="index.php" class="btn">Volver</a>
          <input type="submit" name="ingresar" value="Ingresar" class="btn">
        </div>
        <?php echo $mensaje; ?>
        <br>
        <a type="submit" name="recuperar" role="button" href="recuperar.php" class="href__recuperar">¿Olvidaste tu contraseña?</a>
      </div>
    </form>
  </main>
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
</body>

</html>