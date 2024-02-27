<?php 
session_start();
error_reporting(0);
// llamar ala conexión de base de datos
include 'includes/conexion.php';
include 'phpmailer/PHPMailer.php';
include 'phpmailer/Exception.php';
include 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$result=false;
$c=0;
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
    //echo $estado;
    $result=true;
  } else if ($estado=='false'){
    //Si es error
    //echo $estado;
    $result=false;
  }
  
}
if(isset($_POST['recuperar'])){
    $nombreUsuario = $_POST['nombreUsuario'];
    $correo = $_POST['correo'];
    //$correo_from = 'eduardomejiasamador@gmail.com';
    //$nombre_from = 'RIXER';
    //Verifico que el USUARIO sea un dato valido
	if(trim($nombreUsuario)==''){
		$c=1;
		$error_nombre_usuario.='<h7 style="color:red; font-weight: bold; ">*CAMPO OBLIGATORIO</h7>';
	}
    //Verifico que el CORREO sea un dato valido
    if(trim($correo)==''){
        $c=1;
        $error_correo.='<h7 style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</h7>';
    }else{
        if(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$correo)){
        $c=1;
        $error_correo.='<h7 style="color:red; font-weight: bold; ">*FORMATO INCORRECTO.</h7>';
        }
    }
    function generar_token($length = 9) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
    }
    $token = generar_token();
    if($c==0){
        // generar una consulta que extraigo los datos de la bd
        $consulta = "SELECT idUsuario,nombreUsuario,tokenUsuario, correo, nombrePersona FROM usuarios  INNER JOIN correos ON usuarios.id_Persona = correos.id_PersonaCorreo INNER JOIN personas ON correos.id_PersonaCorreo = personas.idPersona WHERE nombreUsuario = '$nombreUsuario' and correo='$correo'";
        
        if($resultado = mysqli_query($conexion,$consulta)){
            while($row= mysqli_fetch_array($resultado)){
                $idok = $row['idUsuario'];
                $userok = $row['nombreUsuario'];
                $correok = $row['correo'];
                $nombreok = $row['nombrePersona'];
                $tokenok = $row['tokenUsuario'];
            }
        }
        $update_clave = "UPDATE usuarios SET tokenUsuario='$token' WHERE nombreUsuario = '".$nombreUsuario."' ";
        $result_clave = mysqli_query($conexion,$update_clave);

        $link = "localhost/seminario/cambiar_clave.php?idUsuario=".$idok."&tokenUsuario=".$token;
        mysqli_close($conexion);
        if(isset($nombreUsuario) && isset($correo)){
            if($nombreUsuario == $userok &&  $correo == $correok && $result == true ){

                
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'rixerinfo@gmail.com';                     //SMTP username
                    $mail->Password   = 'azstgespdxrufhbv';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('rixerinfo@gmail.com', 'RIXER');
                    $mail->addAddress($correok);     //Add a recipient

                    //Attachments /* ENVIAR CONTENIDO */
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Recuperar contraseña';
                    $mail->Body    = '<a href='.$link.' type="button">Recuperar mi clave</a>';
                    $mail->CharSet = 'UTF-8';
                    $mail->send();
                    $mensaje.='<h7 style="color:green; font-weight: bold; ">REVISA TU CASILLA DE CORREO.</h7>';
                } catch (Exception $e) {
                    $mensaje.='<h7 style="color:red; font-weight: bold; ">*Hubo un error al enviar el mensaje: '.$mail->ErrorInfo.'</h7>';
                }
            }else{
                if($result==false){
                $error_captcha.='<p style="color:red; font-weight: bold;padding: 10px 0px 0px 160px;">*Completar captcha</p>';
                }else{
                $mensaje.='<p style="color:red; font-weight: bold;"></strong>Usuario/Correo invalidos.</strong></p>';
                }
            }
        }
        else{
        $mensaje.='<p style="color:red; font-weight: bold;"></strong>Usuario/Correo invalidos.</strong></p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recuperar</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="./css/estilos.css">
  </head>
  <body>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form1" class="formulario" name="form1" method="post">    
            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <h3 class="titulo__form">Recuperar cuenta</h3>
                <div class="formulario__grupo" id="grupo__correo">
                <label for="correo" class="formulario__label">Usuario</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="nombreUsuario" id="nombreUsuario" placeholder="Juan23" autocomplete="off">
                </div>
                <?php echo $error_nombre_usuario;?>
            </div><br>
            <div class="formulario__grupo" id="grupo__correo">
                <label for="correo" class="formulario__label">Email</label>
                <div class="formulario__grupo-input">
                    <input type="email" class="formulario__input" name="correo" id="correo" autocomplete="off" placeholder="juan_perez@gmail.com">
                </div>
                <?php echo $error_correo;?>
            </div><br>
            <div class="formulario__grupo" >
                <div class="formulario__grupo-input">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfHCdgnAAAAALe5XZlWVAvpvaYZAWpvdzRjBGJm">

                    </div><?php echo $error_captcha;?>
                </div>
            </div><br>
            <input type="submit" name="recuperar" value="Recuperar" class="formulario__btn">
            <?php echo $mensaje; ?>
            <br>
            <a href="login.php" role="button" class="formulario__btn__a">Volver</a>  <br>
        </div>
      </form>
    </main>
  </body>
</html>