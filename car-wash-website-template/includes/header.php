<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

if (!isset($active_page)) {
    $active_page = '';
}
if (!isset($page_title)) {
    $page_title = 'AutoLink+';
}

function nav_active(string $page, string $active): string
{
    return $page === $active ? ' active' : '';
}

$usuario_actual = current_user();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?= htmlspecialchars($page_title) ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="lavado de autos, lavado de motos, mantenimiento vehicular, Rionegro" name="keywords">
        <meta content="AutoLink+: planes de lavado y mantenimiento para tu carro o moto en Rionegro, Antioquia" name="description">

        <!-- Favicon -->
        <link href="img/favicon.svg" rel="icon" type="image/svg+xml">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.php">
                                <h1>Auto<span>Link+</span></h1>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Abierto desde</h3>
                                        <p>Lun - Dom, 8:00 - 19:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Contacto</h3>
                                        <p>3014680412</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Correo</h3>
                                        <p>autolink+@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="index.php" class="navbar-brand">Menú</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link<?= nav_active('inicio', $active_page) ?>">Inicio</a>
                            <a href="about.php" class="nav-item nav-link<?= nav_active('about', $active_page) ?>">Sobre nosotros</a>
                            <a href="service.php" class="nav-item nav-link<?= nav_active('service', $active_page) ?>">Servicios</a>
                            <a href="price.php" class="nav-item nav-link<?= nav_active('price', $active_page) ?>">Planes</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle<?= nav_active('talleres', $active_page) . nav_active('lavaderos', $active_page) ?>" data-toggle="dropdown">Talleres y lavaderos</a>
                                <div class="dropdown-menu">
                                    <a href="talleres.php" class="dropdown-item">Talleres</a>
                                    <a href="lavaderos.php" class="dropdown-item">Puntos de lavado</a>
                                </div>
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle<?= nav_active('blog', $active_page) . nav_active('single', $active_page) ?>" data-toggle="dropdown">Blog</a>
                                <div class="dropdown-menu">
                                    <a href="blog.php" class="dropdown-item">Tips de cuidado de carros y motos</a>
                                    <a href="single.php" class="dropdown-item">Detalle de artículo</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link<?= nav_active('contact', $active_page) ?>">Contacto</a>
                        </div>
                        <div class="ml-auto d-flex align-items-center flex-wrap navbar-auth">
                            <?php if ($usuario_actual): ?>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                        Hola, <?= htmlspecialchars(explode(' ', $usuario_actual['nombre'])[0]) ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="panel.php" class="dropdown-item">Mi panel</a>
                                        <a href="perfil.php" class="dropdown-item">Mi perfil</a>
                                        <a href="logout.php" class="dropdown-item">Cerrar sesión</a>
                                    </div>
                                </div>
                                <a class="btn btn-custom ml-lg-3" href="price.php">Ver planes</a>
                            <?php else: ?>
                                <a href="login.php" class="nav-item nav-link<?= nav_active('login', $active_page) ?>">Iniciar sesión</a>
                                <a class="btn btn-custom ml-lg-2" href="registro.php">Registrarse</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->
