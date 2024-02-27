<?php
session_start();
error_reporting(0);
// llamar ala conexión de base de datos
include 'includes/conexion.php';
$result=false;
$c=0;

if(isset($_POST['cambiar'])){
    $idUsuario = $_REQUEST['idUsuario'];

    // generar una consulta que extraigo los datos de la bd
    $consulta = "SELECT idUsuario,tokenUsuario FROM usuarios WHERE idUsuario = '$idUsuario'";
    if($resultado = mysqli_query($conexion,$consulta)){
        while($row= mysqli_fetch_array($resultado)){
            $idok = $row['idUsuario'];
            $tokenok = $row['tokenUsuario'];
        }
    }
    if($_REQUEST['idUsuario'] ==$idok && $_REQUEST['tokenUsuario'] ==$tokenok){
        $c=0;
    }else{
        $c=1;
    }

    $tokenUsuario = $_REQUEST['tokenUsuario'];
    $claveUsuario = md5($_POST['claveUsuario']);
    if(trim($tokenUsuario)==NULL || trim($tokenUsuario =='')){
        $c=1;
        $mensaje.='<p style="color:red; font-weight: bold;">null o vacio dada</p>';
    }else{
        if(!preg_match("/^[a-zA-Z0-9]{9}$/",$tokenUsuario)){
            $c=1;
            $mensaje.='<p style="color:red; font-weight: bold;">corto dada</p>';
        }
    }
   	//Verifico que la CONTRASEÑA sea un dato valido 
    if(trim($_POST['claveUsuario'])==''){
      $c=1;
      $error_clave='<p style="color:red; font-weight: bold;">*CAMPO OBLIGATORIO</p>';
    }else{
      if(!preg_match("/^(?=.*((\S*\d)))(?=.*((\S*[A-Z])))(?=.*((\S*[a-z])))(?=.*[\W])\S{8,20}$/",$_POST['claveUsuario'])){
      $c=1;
      $error_clave.='<p style="color:red; font-weight: bold;">*La contraseña tiene que ser de 8 a 20 dígitos, tiene que tener al menos: 1 miniscula, 1 mayuscula, 1 numero y 1 caracter especial.</p>';
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
            //echo $estado;
            $result=true;
        } else if ($estado=='false'){
            //Si es error
            //echo $estado;
            $result=false;
        }
    }
    if($c==0 && $result == true ){
        $update_clave = "UPDATE usuarios SET claveUsuario='$claveUsuario', tokenUsuario = NULL WHERE idUsuario = '".$idUsuario."' ";
        $result_clave = mysqli_query($conexion,$update_clave);
        header("location:login.php");
        mysqli_close($conexion);
    }
    else{
        if($result==false){
        $error_captcha.='<p style="color:red; font-weight: bold; padding: 10px 0px 0px 160px;">*Completar captcha</p>';
        }else{

        $mensaje.='<p style="color:red; font-weight: bold;"></strong>Clave invalida.</strong></p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cambiar clave</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="./css/estilos.css">
  </head>
  <body>
    <main>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="form1" class="formulario" name="form1" method="post">
      
      <div class="formulario__grupo formulario__grupo-btn-enviar">
        <h3 class="titulo__form">Cambiar clave</h3>
        <input type="text" name="idUsuario" value="<?php echo $_REQUEST['idUsuario']; ?>" style="display:none;">
        <input type="text" name="tokenUsuario" value="<?php echo $_REQUEST['tokenUsuario']; ?>" style="display:none;">
        <div class="formulario__grupo" id="grupo__claveUsuario">
          <label for="claveUsuario" class="formulario__label">Nueva Clave</label>
          <div class="formulario__grupo-input">
            <input type="password" class="formulario__input" name="claveUsuario" id="claveUsuario">
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
        </div><?php echo $error_clave;?>
        <div class="formulario__grupo">
              <label for=""></label>
              <!-- checkbox que nos permite activar o desactivar la opcion -->
              <div class="formulario__grupo-input" style="margin-right: 68px;">
                <input type="checkbox" id="mostrar_contrasena" title="click para mostrar contraseña" ><label for="">Mostrar Contraseña</label>
              </div>
            </div>
        <div class="formulario__grupo" >
          <div class="formulario__grupo-input">
            <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfHCdgnAAAAALe5XZlWVAvpvaYZAWpvdzRjBGJm">
           
            </div> <?php echo $error_captcha;?>
          </div>
        </div><br>
        
          <input type="submit" name="cambiar" value="Guardar" class="formulario__btn__a">
          <?php echo $mensaje; ?>
          <br>
          
        </div>
      </form>
    </main>
    <script type="text/javascript">
      const mostrar_contrasena =document.querySelector("#mostrar_contrasena")
      const password =document.querySelector("#claveUsuario");
      mostrar_contrasena.addEventListener("click",()=>{
        if(password.type == "password"){
          password.type = "text";
        }else{
          password.type = "password";
        }
      })
      </script>
  </body>
</html>
