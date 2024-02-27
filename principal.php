<?php
// recordar la variable de sesion
session_start();
// se manda llamar el archivo de conexion a la base de datos
include 'includes/conexion.php';
// validar que se cree una variable de sesion al pasar por login
$nombre_usuario = $_SESSION['nombre_usuario'];
if (!isset($nombre_usuario)) {
  header("location:login.php");
}
?>
<?php include './includes/header.php'; ?>
  <?php include './includes/menu_nav.php'; ?>
  <!-- INICIO CONTENIDO -->
  <div class="container py-3">
    <div class="row">
        <img src="./img/logo.png" alt="">
    </div>
  </div>
  <!-- FIN CONTENIDO -->
  <?php include './includes/footer.php'; ?>