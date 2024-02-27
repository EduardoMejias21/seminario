<!DOCTYPE html>
<html lang="es">
<?php include './include/head.php'; ?>
<head>
    <style>
        body{
            background-color: rgb(240, 240, 235);
        }
        .formulario{
            background-color: #cecece;
        }
    </style>
</head>
<body>
    <?php include './include/header.php'; ?>

    <nav class="navegacion">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="href" href="index.php">INICIO</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">CONSULTAS
            </li>
        </ol>
    </nav>
    <section class="sectionConsultas" id="sectionConsultas">
        <form class="formulario" action="https://formsubmit.co/51a74455a6fb33c19efb3fadf4c3c3dc" method="POST">
            <h3>CONSULTA / AYUDA</h3>
            <div class="div-form">
                <label class="formlabel">Nombre y Apellido</label>
                <input class="formcontrol" type="text" name="name" required>
            </div>
            <div class="div-form">
                <label class="formlabel">Ingrese su correo</label>
                <input class="formcontrol" type="email" name="email" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            </div>
            <div class="div-form">
                <label class="formlabel">Asunto</label>
                <input class="formcontrol" type="text" name="asunto" required>
            </div>
            <div class="div-form">
                <label class="formlabel"> Escriba su consulta</label>
                <textarea class="formcontrol" style="height: 150px;" name="textarea" required></textarea>
            </div>
            <div class="div-form">
                <div class="g-recaptcha" data-sitekey="6Ld4V-IlAAAAAK4pZ02erJqIWF4avEBP7RJOBcj3"></div>
            </div>
            <div>
                <button type="submit" name="enviar" value="Enviar" class="btn_form">Enviar</button>
                <a type="submit" name="volver" role="button" href="index.php" class="btn_form">Cancelar</a>
                <input type="hidden" name="_next" value="http://localhost/seminario/index.php">
                <!-- Cambiar el input una vez que establezca el puerto de trabajo-->
                <input type="hidden" name="_captcha" value="false"></tipo>
            </div>
        </form>
    </section>
    <?php include './include/footer.php'; ?>
    <?php include './include/scrips.php'; ?>

</body>

</html>