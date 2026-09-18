<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'service';
$page_title = 'Servicios - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Servicios</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="service.php">Servicios</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>¿Qué ofrecemos?</p>
            <h2>Servicios para tu auto y moto</h2>
        </div>
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash-1"></i>
                    <h3>Lavado exterior</h3>
                    <p>Limpieza profesional para mantener el brillo y proteger la pintura de tu vehículo.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash"></i>
                    <h3>Lavado interior</h3>
                    <p>Eliminamos polvo, manchas y malos olores para un interior como nuevo.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-vacuum-cleaner"></i>
                    <h3>Aspirado profundo</h3>
                    <p>Limpieza detallada en cada rincón para mayor comodidad y salud al conducir.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-seat"></i>
                    <h3>Limpieza de tapicería</h3>
                    <p>Cuidado y mantenimiento de asientos para prolongar su vida útil y apariencia.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-service"></i>
                    <h3>Cambio de aceite</h3>
                    <p>Servicio rápido y de calidad para mantener el motor en óptimas condiciones.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-brush-1"></i>
                    <h3>Mantenimiento preventivo</h3>
                    <p>Revisiones periódicas para evitar fallas y mejorar el rendimiento de tu vehículo.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-service-2"></i>
                    <h3>Venta de repuestos</h3>
                    <p>Accede a repuestos y accesorios de calidad con descuentos para suscriptores.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="service-item">
                    <i class="flaticon-car-wash"></i>
                    <h3>Promociones exclusivas</h3>
                    <p>Beneficios y ofertas especiales solo para miembros de AutoLink+.</p>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Service End -->
        
        
        <!-- Location Start -->
<div class="location">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-header text-left">
                    <p>Puntos de Lavado</p>
                    <h2>Centros De Lavado De Carros Y Motos</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="location-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="location-text">
                                <h3>Autolavado El Progreso</h3>
                                <p>Calle 48 #54-20, Rionegro, Antioquia</p>
                                <p><strong>Tel:</strong> +57 604 561 2345</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="location-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="location-text">
                                <h3>Lavadero La Estación</h3>
                                <p>Carrera 55 #48-15, Sector El Porvenir, Rionegro</p>
                                <p><strong>Tel:</strong> +57 310 456 7890</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="location-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="location-text">
                                <h3>EcoWash Rionegro</h3>
                                <p>Vía Llanogrande, frente al Mall Complex Llanogrande</p>
                                <p><strong>Tel:</strong> +57 314 789 6543</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="location-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="location-text">
                                <h3>Lavadero MotoCar</h3>
                                <p>Carrera 46 #46-05, Sector El Tablazo, Rionegro</p>
                                <p><strong>Tel:</strong> +57 301 234 5678</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aquí reemplazamos el formulario por el mapa -->
            <div class="col-lg-5">
                <h3 style="
                    font-size: 1.8rem;
                    font-weight: bold;
                    color: #d32f2f;
                    margin-bottom: 15px;
                    border-bottom: 3px solid #d32f2f;
                    padding-bottom: 5px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                ">
                    Ubicación en el mapa
                </h3>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31735.155476197928!2d-75.39471760028651!3d6.144879175146065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e469f0f10c26bc9%3A0x76297df352b016c6!2sRionegro%2C%20Antioquia!5e0!3m2!1ses-419!2sco!4v1754666348851!5m2!1ses-419!2sco" 
                    width="100%" 
                    height="450" 
                    style="border:0; border-radius: 10px; box-shadow: 0px 4px 15px rgba(0,0,0,0.2);" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- Location End -->


<?php include __DIR__ . '/includes/footer.php'; ?>
