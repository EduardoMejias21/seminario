<div class="slide-container swiper" id="productos">
    <div class="slide-content">
        <h2 class="titulo">PRODUCTOS DESTACADOS</h2>
            <div class="card-wrapper swiper-wrapper">
            <?php
            $sql="SELECT nombre_producto,descripcion_producto,img_foto FROM productos LEFT JOIN productos_fotos ON productos.id_producto = productos_fotos.id_producto WHERE mostrar_producto = 1 GROUP BY productos.id_producto ";
            $query = mysqli_query($conexion,$sql);
            //var_dump(mysqli_fetch_array($query));
            while($consulta = mysqli_fetch_array($query)){
            echo '
                <div class="card swiper-slide">
                    <div class="card-content">
                        <h5" class="name">'.$consulta['nombre_producto'].'</h5>
                    </div>
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="'.$consulta['img_foto'].'" class="card-img">
                        </div>
                    </div>
                    <div class="card-content">
                        <p class="description">'.$consulta['descripcion_producto'].'</p>
                        <a class="button" href="formulario.php">Solicitar cotizacion</a>
                    </div>
                </div>
            ';
            }
            ?>
        </div>
    </div>
    <div class="swiper-button-next swiper-navBtn"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
</div>
<style>
    .button{
        font-weight: 500;
        text-decoration: none;
        text-align: center;
    }
    .button:hover{
        text-decoration: none;
        color:white;
    }
</style>
        
 