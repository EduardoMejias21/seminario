<div class="menu__side">
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-12 col-sm-auto">
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <?php 
                    $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'productos_dashboard') {
                            echo'<a href="productos_dashboard.php"><i><img src="./img/bag-fill.svg" class="img_enlace"></i><span>Prod. Destacados</span></a>';
                        }
                    }
                    ?>
                    <?php 
                    $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'categorias') {
                            echo'<a href="categorias.php"><i><img src="./img/bag-fill.svg" class="img_enlace"></i><span>Categorias</span></a>';
                        }
                    }
                    ?>
                    <?php 
                    $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'stock') {
                            echo'<a href="stock.php"><i><img src="./img/list-check.svg" class="img_enlace"></i><span>Inventario</span></a>';
                           
                        }
                    }
                    ?>
                </nav>
                        
