<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-5" href="principal.php">RIXER</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">INICIO</div>
                    <a class="nav-link" href="principal.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Principal
                    </a>
                    <?php
                    $modulo = $nombre_modulo[] = $_SESSION['nombre_modulo'];
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'usuarios') {
                            ?>
                            <div class="sb-sidenav-menu-heading">Usuarios</div>
                            <a class="nav-link" href="usuarios.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map"></i></div>
                                Usuarios
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'permisos') {
                            ?>
                            <a class="nav-link" href="permisos.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location"></i></div>
                                Permisos
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'proveedores') {
                            ?>
                            <div class="sb-sidenav-menu-heading">Proveedores</div>
                            <a class="nav-link" href="proveedores.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map"></i></div>
                                Proveedores
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'compras') {
                            ?>
                            <a class="nav-link" href="compras.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location"></i></div>
                                Compras
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'clientes') {
                            ?>
                            <div class="sb-sidenav-menu-heading">Clientes</div>
                            <a class="nav-link" href="clientes.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map"></i></div>
                                Clientes
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'ventas') {
                            ?>
                            <a class="nav-link" href="ventas.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location"></i></div>
                                Ventas
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'productos_dashboard') {
                            ?>
                            <div class="sb-sidenav-menu-heading">Productos</div>
                            <a class="nav-link" href="productos_dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map"></i></div>
                                Productos Destacados
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'categorias') {
                            ?>
                            <a class="nav-link" href="categorias.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location"></i></div>
                                Categorias
                            </a>
                            <?php
                        }
                    }
                    foreach ($modulo as $key => $value) {
                        if ($nombre_modulo[$key] = $value == 'stock') {
                            ?>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location"></i></div>
                                Inventario
                            </a>
                            <?php

                        }
                    }
                    ?>
                </div>
            </div>
            <a class="btn btn-outline-danger my-2 my-sm-0" href="includes/cerrar.php">CERRAR SESION</a>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>