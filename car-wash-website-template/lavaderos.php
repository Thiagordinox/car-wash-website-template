<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'lavaderos';
$page_title = 'Puntos de lavado - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Encabezado de Página Inicio -->
        <div class="page-header">
            <div class="container">
            <div class="row">
                <div class="col-12">
                <h2>Puntos de lavado</h2>
                </div>
                <div class="col-12">
                <a href="index.php">Inicio</a>
                <span> / </span>
                <a href="lavaderos.php">Puntos de lavado</a>
                </div>
            </div>
            </div>
        </div>
        <!-- Encabezado de Página Fin -->
<div class="location">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-header text-left">
                    <p>Puntos de Lavado</p>
                    <h2>Centros de Lavado de Carros y Motos</h2> <!-- Corregido mayúsculas -->
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
                                <h3>Lavadero Motocar</h3> <!-- Corregido "MotoCar" por "Motocar" -->
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
