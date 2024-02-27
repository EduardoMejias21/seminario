<?php
define("KEY","rixer");
define("COD","AES-128-ECB");
// declarar las variables en donde se guardaran los valores de la conexión
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "proyecto";
//$conexion = mysqli_connect($servidor, $usuario,$password,$bd);
// if($conexion->connect_error){
//   die("Error al conectar la base de datos de la pagina".$conexion->connect_error);
// }
$conexion = mysqli_connect($servidor, $usuario,$password,$bd);
if(!$conexion){
  echo("Error: No se pudo comunicar a MySql.".PHP_EOL);
  echo("Error al conectar la base de datos de la pagina".mysqli_connect_errno().PHP_EOL);
  echo("Error de depuración: ".mysqli_connect_error().PHP_EOL);
  exit;
}

//echo("Conexion exitosa a MySql".PHP_EOL);
//echo("Informacion del host: ".mysqli_get_host_info($conexion).PHP_EOL);
// mysqli_close($conexion);
?>
