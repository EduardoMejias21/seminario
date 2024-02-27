<?php
error_reporting(0);
// llamar ala conexión de base de datos
include 'includes/conexion.php';
$c=0;
$result=false;
if(isset($_POST['registrar'])){
	$nombrePersona=$_POST['nombrePersona'];
    $apellidoPersona=$_POST['apellidoPersona'];
    $cuilPersona=$_POST['cuilPersona'];
    $fecNacPersona=$_POST['fecNacPersona'];
    $sexoPersona=$_POST['sexoPersona'];
    $correo=$_POST['correo'];
    $nombreUsuario=$_POST['nombreUsuario'];
	$claveUsuario = md5($_POST['claveUsuario']);
	//Verifico que el NOMBRE sea un dato valido
	if(trim($nombrePersona)==''){
		$c=1;
		$error_nombre='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^[a-zA-ZÀ-ÿ\s]{4,40}$/",$nombrePersona)){
		$c=1;
		$error_nombre.='<p>*El nombre tiene que ser de 4 a 40 dígitos y solo puede contener letras.</p>';
		}
	}
	//Verifico que el APELLIDO sea un dato valido
	if(trim($apellidoPersona)==''){
		$c=1;
		$error_apellido='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^[a-zA-ZÀ-ÿ\s]{4,40}$/",$apellidoPersona)){
		$c=1;
		$error_apellido.='<p>*El apellido tiene que ser de 4 a 40 dígitos y solo puede contener letras.</p>';
		}
	}
	//Verifico que el CUIL sea un dato valido y que no este cargado en el sistema
	if(trim($cuilPersona)==''){
		$c=1;
		$error_cuil='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^[0-9]{8,11}$/",$cuilPersona)){
		$c=1;
		$error_cuil.='<p>*El cuil o dni tiene que ser de 8 a 11 dígitos y solo puede contener numeros.</p>';
		}
	}
    $verificarCuil = mysqli_query($conexion,"SELECT cuilPersona FROM personas WHERE cuilPersona='$cuilPersona'");
	if(mysqli_num_rows($verificarCuil)>0){
		$c=1;
		$error_cuil.='<p style="color:red; font-weight: bold;">*CUIL/CUIT/DNI existente.</p>';
	}
	//Verifico que la FECHA no este vacia
	if(trim($fecNacPersona)==''){
		$c=1;
		$error_fecha='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}
	//Verifico que el SEXO este seleccionado
	if(trim($sexoPersona)==''){
		$c=1;
		$error_sexo='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}
	//Verifico que el CORREO sea un dato valido
	if(trim($correo)==''){
		$c=1;
		$error_correo='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$correo)){
		$c=1;
		$error_correo.='<p>*El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>';
		}
	}
	$verificar_correo = mysqli_query($conexion,"SELECT correo FROM correos WHERE correo='$correo'");
	if(mysqli_num_rows($verificar_correo)>0){
		$c=1;
		$error_correo.='<p style="color:red; font-weight: bold;">*CORREO existente.</p>';
	}
	//Verifico que el USUARIO sea un dato valido y que no este cargado en el sistema
	if(trim($nombreUsuario)==''){
		$c=1;
		$error_nombre_usuario='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^[a-zA-Z0-9\_\-]{4,16}$/",$nombreUsuario)){
		$c=1;
		$error_nombre_usuario.='<p>*El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>';
		}
	}
	$verificar_nombre_usuario = mysqli_query($conexion,"SELECT nombreUsuario FROM usuarios WHERE nombreUsuario='$nombreUsuario'");
	if(mysqli_num_rows($verificar_nombre_usuario)>0){
		$c=1;
		$error_nombre_usuario.='<p style="color:red; font-weight: bold;">*USUARIO existente.</p>';
	}
	//Verifico que la CONTRASEÑA sea un dato valido 
	if(trim($_POST['claveUsuario'])==''){
		$c=1;
		$error_clave='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if(!preg_match("/^(?=.*((\S*\d)))(?=.*((\S*[A-Z])))(?=.*((\S*[a-z])))(?=.*[\W])\S{8,20}$/",$_POST['claveUsuario'])){
		$c=1;
		$error_clave.='<p>*La contraseña tiene que ser de 8 a 20 dígitos, tiene que tener al menos: 1 miniscula, 1 mayuscula, 1 numero y 1 caracter especial.</p>';
		}
	}
	if(trim($_POST['password2'])==''){
		$c=1;
		$error_clave2='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
	}else{
		if($_POST['password2']!=$_POST['claveUsuario']){
			$c=1;
			$error_clave2='<p>*Ambas claves deben ser iguales</p>';
		}
	}
	if(isset($_POST['g-recaptcha-response'])){

	//La respuesta del recaptcha
	$respuesta=$_POST['g-recaptcha-response'];
	//La ip del usuario
	$ipuser=$_SERVER['REMOTE_ADDR'];
	//Tu clave secretra de recaptcha
	$clavesecreta='6LfHCdgnAAAAABZaJfy-CDHvLSDBNLo_xUcoUEPS';
	//La url preparada para enviar
	$urlrecaptcha="https://www.google.com/recaptcha/api/siteverify?secret=$clavesecreta&response=$respuesta&remoteip=$ipuser";
	
	//Leemos la respuesta (suele funcionar solo en remoto)
	$respuesta = file_get_contents($urlrecaptcha) ;
	
	//Comprobamos el success
	$dividir=explode('"success":',$respuesta);
	$obtener=explode(',',$dividir[1]);
	
	//Obtenemos el estado
	$estado=trim($obtener[0]);
	
	
	if ($estado=='true'){
		//Si es ok
		$c=0;
		$result=true;
	} else if ($estado=='false'){
		$c=1;
		$result=false;
		$error_captcha.='<p style="color:red; font-weight: bold; ">*Completar captcha</p>';
	}
	
	}
	if($c==0 && $result == true){
		// generar una consulta que extraigo los datos de la bd
		$consulta="INSERT INTO `personas`(`nombrePersona`, `apellidoPersona`, `cuilPersona`, `fecNacPersona`, `sexoPersona`) VALUES ('$nombrePersona','$apellidoPersona','$cuilPersona','$fecNacPersona','$sexoPersona')";
		$resultado = mysqli_query($conexion,$consulta);
		if (mysqli_errno($conexion)==0){
			$id=mysqli_insert_id($conexion);
			$sql_correo = "INSERT INTO correos(correo, id_PersonaCorreo) VALUES ('$correo', '$id')";
			$result_correo = mysqli_query($conexion,$sql_correo);
			$id_Rol = 2;
			$sql_usuarios="INSERT INTO `usuarios`(`nombreUsuario`, `claveUsuario`, `id_Persona`, `id_Rol`) VALUES ('$nombreUsuario','$claveUsuario','$id','$id_Rol')";
			$result_usuarios = mysqli_query($conexion,$sql_usuarios);			
		}else
		{
			$mensajeFinal.='Ocurrio un error';
		}
		mysqli_close($conexion);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="css/estilos2.css">
</head>
<body>
	<main>
		<h3 class="titulo__form">FORMULARIO DE REGISTRO</h3>
		<hr>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="formulario" id="formulario">
			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombrePersona">
				<label for="nombrePersona" class="formulario__label">Nombre</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombrePersona" id="nombrePersona" placeholder="Eduardo">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_nombre; ?>
			</div>
			<!-- Grupo: Usuario -->
			<div class="formulario__grupo" id="grupo__nombreUsuario">
				<label for="nombreUsuario" class="formulario__label">Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombreUsuario" id="nombreUsuario" placeholder="Eduardo21">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_nombre_usuario; ?>
			</div>
            <!-- Grupo: Apellido -->
			<div class="formulario__grupo" id="grupo__apellidoPersona">
				<label for="apellidoPersona" class="formulario__label">Apellido</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidoPersona" id="apellidoPersona" placeholder="Mejias">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_apellido;?>
			</div>
			<!-- Grupo: Correo Electronico -->
			<div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label">Correo Electrónico</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_correo; ?>
			</div>
            
            <!-- Grupo: Fecha de Nacimiento -->
			<div class="formulario__grupo" id="grupo__fecNacPersona">
				<label for="fecNacPersona" class="formulario__label">Fecha de nacimiento</label>
				<div class="formulario__grupo-input">
					<input type="date" class="formulario__input" name="fecNacPersona" id="fecNacPersona">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_fecha;?>
			</div>
			<!-- Grupo: Contraseña -->
			<div class="formulario__grupo" id="grupo__claveUsuario">
				<label for="claveUsuario" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="claveUsuario" id="claveUsuario">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_clave;?>
			</div>
			<!-- Grupo: Cuil -->
			<div class="formulario__grupo" id="grupo__cuilPersona">
				<label for="cuilPersona" class="formulario__label">Cuil/DNI</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="cuilPersona" id="cuilPersona" placeholder="20435321322">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_cuil;?>
				<p class="formulario__input-error">El cuil o dni tiene que ser de 8 a 11 dígitos y solo puede contener numeros.</p>
			</div>
            
			<!-- Grupo: Contraseña 2 -->
			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Repetir Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password2" id="password2">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_clave2;?>
			</div>

            <!-- Grupo: Genero -->
			<div class="formulario__grupo" id="grupo__sexoPersona">
				<label for="sexoPersona" class="formulario__label">Genero</label>
				<div class="formulario__grupo-input">
					<input type="radio" class="formulario__radio" name="sexoPersona" id="Masculino" value="Masculino"><label for="Masculino">Masculino</label>
					<br>
					<input type="radio" class="formulario__radio" name="sexoPersona" id="Femenino" value="Femenino"><label for="Femenino">Femenino</label>
					<br>
					<input type="radio" class="formulario__radio" name="sexoPersona" id="Indefinido" value="Indefinido"><label for="Indefinido">Indefinido</label>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php echo $error_sexo;?>
			</div>
			 <!-- Grupo: recaptcha -->
			 <div class="formulario__grupo" id="grupo__recaptcha">
				<label for="recaptcha" class="formulario__label">Recaptcha</label>
				<div class="formulario__grupo-input">
					<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfHCdgnAAAAALe5XZlWVAvpvaYZAWpvdzRjBGJm">
			
					</div>
				</div>
				<?php echo $error_captcha;?>
			</div>

            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" name="registrar" value="Registrar Usuario" class="formulario__btn">
				<br>
				<a href="principal.php" role="button" class="formulario__btn__a">Volver</a>
				<!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
				<?php echo $mensajeFinal;?>
			</div>

		</form>
	</main>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>