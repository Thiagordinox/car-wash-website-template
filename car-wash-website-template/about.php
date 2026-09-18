<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'about';
$page_title = 'Sobre nosotros - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Sobre nosotros</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="about.php">Sobre nosotros</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        

        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="img/lavadero.jpg" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header text-left">
                            <p>Sobre nosotros</p>
                            <h2>Servicios para tu vehículo y motocicleta</h2>
                        </div>
                        <div class="about-content">
                            <p>
                                En AutoLink+, conectamos a los propietarios de autos y motos con los mejores servicios de lavado, mantenimiento, repuestos y productos. 
                                Todo en un solo lugar, con beneficios y descuentos exclusivos para nuestros suscriptores.
                            </p>
                            <ul>
                                <li><i class="far fa-check-circle"></i>Lavado y detallado profesional</li>
                            <li><i class="far fa-check-circle"></i>Mantenimiento preventivo y correctivo</li>
                            <li><i class="far fa-check-circle"></i>Compra de repuestos y accesorios</li>
                            <li><i class="far fa-check-circle"></i>Promociones y beneficios exclusivos</li>
                            </ul>
                            <a class="btn btn-custom" href="">Más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        
        
        <!-- Facts Start -->
<div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">8</h3>
                        <p>Puntos de servicio en Rionegro</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-car"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">800</h3>
                        <p>Vehículos atendidos</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-users"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">650</h3>
                        <p>Clientes felices</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-star"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">95</h3>
                        <p>% de satisfacción</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Facts End -->


        <!-- Productos Start -->
<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Productos Recomendados</p>
            <h2>Limpieza de Carros y Cuidado de Motos</h2>
        </div>
        <div class="row">

            <!-- Producto 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="img/shampoo.jpg" alt="Shampoo para carro">
                    </div>
                    <div class="team-text">
                        <h2>Shampoo Premium</h2>
                        <p>Brillo y protección para pintura automotriz</p>
                    </div>
                </div>
            </div>

            <!-- Producto 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="img/cera.jpg" alt="Cera líquida">
                    </div>
                    <div class="team-text">
                        <h2>Cera Líquida</h2>
                        <p>Protección contra rayos UV y suciedad</p>
                    </div>
                </div>
            </div>

            <!-- Producto 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="img/tapiceria.jpg" alt="Limpiador de tapicería">
                    </div>
                    <div class="team-text">
                        <h2>Limpiador de Tapicería</h2>
                        <p>Elimina manchas y olores del interior</p>
                    </div>
                </div>
            </div>

            <!-- Producto 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="img/lubricantecadena.jpg" alt="Lubricante para moto">
                    </div>
                    <div class="team-text">
                        <h2>Lubricante de Cadenas</h2>
                        <p>Protege y alarga la vida de tu moto</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Productos End -->

<?php include __DIR__ . '/includes/footer.php'; ?>
