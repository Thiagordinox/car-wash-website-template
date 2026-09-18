<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'inicio';
$page_title = 'AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Carousel Start -->
        <div class="carousel">
    <div class="container-fluid">
        <div class="owl-carousel">
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-1.jpg" alt="Lavado y detallado">
                </div>
                <div class="carousel-text">
                    <h3>Lavado y detallado</h3>
                    <h1>Mantén tu vehículo como nuevo</h1>
                    <p>
                        En AutoLink+, accede a los mejores servicios de lavado y detallado para que tu vehículo siempre luzca como nuevo, con beneficios exclusivos para suscriptores.
                    </p>
                    <a class="btn btn-custom" href="">Descubre más</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-2.jpg" alt="Mantenimiento de calidad">
                </div>
                <div class="carousel-text">
                    <h3>Mantenimiento confiable</h3>
                    <h1>Cuida tu carro o moto con expertos</h1>
                    <p>
                        Encuentra talleres certificados cerca de ti para revisiones, reparaciones y servicios preventivos, con pagos seguros y promociones exclusivas para miembros.
                    </p>
                    <a class="btn btn-custom" href="">Ver beneficios</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-3.jpg" alt="Productos y repuestos">
                </div>
                <div class="carousel-text">
                    <h3>Productos y repuestos</h3>
                    <h1>Todo lo que tu vehículo necesita</h1>
                    <p>
                        Compra fácilmente repuestos y accesorios de calidad para tu carro o moto desde nuestra app, con entrega rápida y precios especiales para suscriptores.
                    </p>
                    <a class="btn btn-custom" href="">Explorar catálogo</a>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Carousel End -->
        

        <!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">

            <!-- Imagen -->
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="img/lavadero.jpg" alt="AutoLink+ servicios">
                </div>
            </div>

            <!-- Texto -->
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
                        <li><i class="far fa-check-circle"></i> Lavado y detallado profesional</li>
                        <li><i class="far fa-check-circle"></i> Mantenimiento preventivo y correctivo</li>
                        <li><i class="far fa-check-circle"></i> Compra de repuestos y accesorios</li>
                        <li><i class="far fa-check-circle"></i> Promociones y beneficios exclusivos</li>
                    </ul>
                    <a class="btn btn-custom" href="">Conoce más</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- About End -->



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

        
        
        <!-- Facts Start -->
<div class="facts">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">8</h3>
                        <p>Puntos de servicio en Rionegro</p> <!-- Corregido "in" por "en" -->
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

        
        
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Planes de Membresía</p>
            <h2>Elige tu Plan</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Plan Básico</h3>
                        <div class="price-select mb-3">
                            <label for="basic-vehicle">Tipo de vehículo:</label>
                            <select id="basic-vehicle" class="form-control">
                                <option value="30000" data-moto="true">Moto - $30.000</option>
                                <option value="35000" data-moto="false">Carro - $35.000</option>
                                <option value="40000" data-moto="false">Camioneta - $40.000</option>
                                <option value="50000" data-moto="false">Bus/Camión - $50.000</option>
                            </select>
                        </div>
                        <h2><span>$</span><strong id="basic-price">30.000</strong></h2>
                    </div>
                    <div class="price-body">
                        <ul id="basic-features">
                            <li><i class="far fa-check-circle"></i> 50% de descuento en mantenimiento</li>
                            <li><i class="far fa-check-circle"></i> Limpieza de asientos</li>
                            <li><i class="far fa-check-circle"></i> Aspirado</li>
                            <li><i class="far fa-check-circle"></i> Limpieza exterior</li>
                            <li class="basic-moto-only d-none"><i class="far fa-check-circle"></i> Limpieza de tapas y farolas</li>
                            <li class="basic-moto-only d-none"><i class="far fa-times-circle"></i> Limpieza interior húmeda</li>
                            <li class="basic-moto-only d-none" id="basic-kit-arrastre"><i class="far fa-check-circle"></i> Limpieza de kit de arrastre</li>
                            <li class="full-not-moto full-not-moto-windows"><i class="far fa-check-circle"></i> Limpieza de ventanas</li>
                            <li class="basic-not-moto"><i class="far fa-times-circle"></i> Limpieza interior húmeda</li>
                            <li class="basic-not-moto"><i class="far fa-times-circle"></i> Lavado a motor</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="#" id="basic-reservar">Reservar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item featured-item">
                    <div class="price-header">
                        <h3>Plan Premium</h3>
                        <div class="price-select mb-3">
                            <label for="premium-vehicle">Tipo de vehículo:</label>
                            <select id="premium-vehicle" class="form-control">
                                <option value="90000" data-moto="true">Moto - $90.000</option>
                                <option value="95000" data-moto="false">Carro - $95.000</option>
                                <option value="100000" data-moto="false">Camioneta - $100.000</option>
                                <option value="110000" data-moto="false">Bus/Camión - $110.000</option>
                            </select>
                        </div>
                        <h2><span>$</span><strong id="premium-price">90.000</strong></h2>
                    </div>
                    <div class="price-body">
                        <ul id="premium-features">
                            <li><i class="far fa-check-circle"></i> 100% de descuento en mantenimiento</li>
                            <li><i class="far fa-check-circle"></i> Limpieza de asientos</li>
                            <li><i class="far fa-check-circle"></i> Aspirado</li>
                            <li><i class="far fa-check-circle"></i> Limpieza exterior</li>
                            <li class="premium-moto-only"><i class="far fa-check-circle"></i> Limpieza de tapas y farolas</li>
                            <li class="premium-moto-only"><i class="far fa-check-circle"></i> Limpieza interior húmeda</li>
                            <li class="premium-moto-only d-none" id="premium-kit-arrastre"><i class="far fa-check-circle"></i> Limpieza de kit de arrastre</li>
                            <li class="full-not-moto full-not-moto-windows"><i class="far fa-check-circle"></i> Limpieza de ventanas</li>
                            <li class="premium-not-moto"><i class="far fa-check-circle"></i> Limpieza interior húmeda</li>
                            <li class="premium-not-moto"><i class="far fa-check-circle"></i> Lavado a motor</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="#" id="premium-reservar">Reservar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Plan Completo</h3>
                        <div class="price-select mb-3">
                            <label for="full-vehicle">Tipo de vehículo:</label>
                            <select id="full-vehicle" class="form-control">
                                <option value="55000" data-moto="true">Moto - $55.000</option>
                                <option value="60000" data-moto="false">Carro - $60.000</option>
                                <option value="70000" data-moto="false">Camioneta - $70.000</option>
                                <option value="85000" data-moto="false">Bus/Camión - $85.000</option>
                            </select>
                        </div>
                        <h2><span>$</span><strong id="full-price">55.000</strong></h2>
                    </div>
                    <div class="price-body">
                        <ul id="full-features">
                            <li><i class="far fa-check-circle"></i> 70% de descuento en mantenimiento</li>
                            <li><i class="far fa-check-circle"></i> Limpieza de asientos</li>
                            <li><i class="far fa-check-circle"></i> Aspirado</li>
                            <li><i class="far fa-check-circle"></i> Limpieza exterior</li>
                            <li class="full-moto-only"><i class="far fa-check-circle"></i> Limpieza de tapas y farolas</li>
                            <li class="full-moto-only"><i class="far fa-check-circle"></i> Limpieza interior húmeda</li>
                            <li class="full-moto-only d-none" id="full-kit-arrastre"><i class="far fa-check-circle"></i> Limpieza de kit de arrastre</li>
                            <li class="full-not-moto full-not-moto-windows"><i class="far fa-check-circle"></i> Limpieza de ventanas</li>
                            <li class="full-not-moto"><i class="far fa-times-circle"></i> Limpieza interior húmeda</li>
                            <li class="full-not-moto"><i class="far fa-times-circle"></i> Lavado a motor</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="#" id="full-reservar">Reservar ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Price End -->

<script>
// Sincronizar selects de tipo de vehículo instantáneamente y evitar bucles infinitos
function syncVehicleSelects() {
    const selects = [
        document.getElementById('basic-vehicle'),
        document.getElementById('premium-vehicle'),
        document.getElementById('full-vehicle')
    ];

    let isSyncing = false;

    selects.forEach((select, idx) => {
        select.addEventListener('change', function() {
            if (isSyncing) return;
            isSyncing = true;
            const selectedIndex = select.selectedIndex;
            selects.forEach((otherSelect, otherIdx) => {
                if (otherIdx !== idx) {
                    otherSelect.selectedIndex = selectedIndex;
                    otherSelect.dispatchEvent(new Event('change', { bubbles: false }));
                }
            });
            isSyncing = false;
        });
    });
}

// Mostrar/ocultar "Limpieza de ventanas" y "Limpieza de kit de arrastre" según el tipo de vehículo seleccionado
function updateWindowAndKitCleaning(selectId, notMotoClass, kitArrastreId) {
    const select = document.getElementById(selectId);
    select.addEventListener('change', function() {
        const isMoto = select.options[select.selectedIndex].getAttribute('data-moto') === 'true';
        document.querySelectorAll('.' + notMotoClass).forEach(el => {
            el.style.display = isMoto ? 'none' : '';
        });
        // Mostrar/ocultar kit de arrastre solo para moto
        const kitArrastre = document.getElementById(kitArrastreId);
        if (kitArrastre) kitArrastre.classList.toggle('d-none', !isMoto);
    });
    // Inicializar
    const isMoto = select.options[select.selectedIndex].getAttribute('data-moto') === 'true';
    document.querySelectorAll('.' + notMotoClass).forEach(el => {
        el.style.display = isMoto ? 'none' : '';
    });
    const kitArrastre = document.getElementById(kitArrastreId);
    if (kitArrastre) kitArrastre.classList.toggle('d-none', !isMoto);
}

// Cambiar el precio automáticamente al seleccionar el tipo de vehículo
function updatePriceOnSelect(selectId, priceId) {
    const select = document.getElementById(selectId);
    const price = document.getElementById(priceId);
    select.addEventListener('change', function() {
        let value = select.value;
        value = Number(value).toLocaleString('es-CO');
        price.textContent = value;
    });
    // Inicializar
    let value = select.value;
    value = Number(value).toLocaleString('es-CO');
    price.textContent = value;
}

// Enlazar "Reservar ahora" con el checkout real (pago.php), según el vehículo elegido
const TIPOS_VEHICULO = ['moto', 'carro', 'camioneta', 'bus_camion'];
function updateReservarLink(selectId, linkId, planSlug) {
    const select = document.getElementById(selectId);
    const link = document.getElementById(linkId);
    function actualizar() {
        const tipo = TIPOS_VEHICULO[select.selectedIndex] || 'carro';
        link.href = 'pago.php?plan=' + planSlug + '&vehiculo=' + tipo;
    }
    select.addEventListener('change', actualizar);
    actualizar();
}

// Inicialización
syncVehicleSelects();
updateWindowAndKitCleaning('basic-vehicle', 'basic-not-moto-windows', 'basic-kit-arrastre');
updateWindowAndKitCleaning('premium-vehicle', 'premium-not-moto-windows', 'premium-kit-arrastre');
updateWindowAndKitCleaning('full-vehicle', 'full-not-moto-windows', 'full-kit-arrastre');
updatePriceOnSelect('basic-vehicle', 'basic-price');
updatePriceOnSelect('premium-vehicle', 'premium-price');
updatePriceOnSelect('full-vehicle', 'full-price');
updateReservarLink('basic-vehicle', 'basic-reservar', 'basico');
updateReservarLink('premium-vehicle', 'premium-reservar', 'premium');
updateReservarLink('full-vehicle', 'full-reservar', 'completo');
</script>
<div class="location">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-header text-left">
                    <p>Puntos de Lavado</p>
                    <h2>Centros de Lavado de Carros y Motos</h2> <!-- Corregido mayúsculas innecesarias -->
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





        <!-- Productos Start -->
<div class="team">
    <div class="container">
        <div class="section-header text-center">
            <p>Productos Recomendados</p>
            <h2>Limpieza de Carros y Cuidado de Motos</h2> <!-- Corregido mayúsculas innecesarias -->
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
                        <p>Brillo y protección para la pintura automotriz</p> <!-- Corregido "para pintura automotriz" por "para la pintura automotriz" -->
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
                        <p>Protege y prolonga la vida de tu moto</p> <!-- Corregido "alarga" por "prolonga" -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Productos End -->

        
        
        <!-- Reseñas Start -->
<div class="testimonial">
    <div class="container">
        <div class="section-header text-center">
            <p>Opiniones de Clientes</p>
            <h2>Lo que dicen sobre nuestro servicio</h2>
        </div>
        <div class="owl-carousel testimonials-carousel">

            <!-- Reseña 1 -->
            <div class="testimonial-item">
                <div class="testimonial-text">
                    <h3>Juan Pérez</h3>
                    <h4>Cliente frecuente</h4>
                    <p>
                        “Excelente servicio, mi carro quedó como nuevo. El personal es muy amable y cuidadoso con cada detalle.”
                    </p>
                </div>
            </div>

            <!-- Reseña 2 -->
            <div class="testimonial-item">
                <div class="testimonial-text">
                    <h3>María Gómez</h3>
                    <h4>Motociclista</h4>
                    <p>
                        “Traje mi moto y quedó impecable. Usan productos de alta calidad y la atención es increíble.”
                    </p>
                </div>
            </div>

            <!-- Reseña 3 -->
            <div class="testimonial-item">
                <div class="testimonial-text">
                    <h3>Carlos Rodríguez</h3>
                    <h4>Conductor de taxi</h4>
                    <p>
                        “Rápidos, eficientes y a buen precio. El interior del carro quedó libre de olores y manchas.”
                    </p>
                </div>
            </div>

            <!-- Reseña 4 -->
            <div class="testimonial-item">
                <div class="testimonial-text">
                    <h3>Laura Fernández</h3>
                    <h4>Cliente nueva</h4>
                    <p>
                        “No esperaba que el acabado fuera tan brillante. Sin duda volveré y recomendaré el lugar.”
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Reseñas End -->



      <!-- Blog Start -->
<div class="blog">
    <div class="container">
        <div class="section-header text-center">
            <p>Noticias y Consejos</p>
            <h2>Lo último sobre el cuidado vehicular</h2> <!-- Corregido "Lo último sobre cuidado vehicular" por "Lo último sobre el cuidado vehicular" -->
        </div>
        <div class="row">

            <!-- Artículo 1 -->
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="meta-date">
                            <span>08</span>
                            <strong>Ago</strong>
                            <span>2025</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">5 tips para mantener tu auto impecable</a></h3>
                        <p>
                            Aprende cómo proteger la pintura, evitar rayones y mantener el brillo de tu auto por más tiempo.
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Equipo de Lavado</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Consejos</a></p>
                        <p><i class="fa fa-comments"></i><a href="">12 Comentarios</a></p>
                    </div>
                </div>
            </div>

            <!-- Artículo 2 -->
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="meta-date">
                            <span>22</span>
                            <strong>Jul</strong>
                            <span>2025</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">Lavado ecológico: cuida tu auto y el planeta</a></h3>
                        <p>
                            Descubre cómo nuestros métodos de lavado ahorran agua y utilizan productos biodegradables.
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Equipo de Lavado</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Noticias</a></p>
                        <p><i class="fa fa-comments"></i><a href="">8 Comentarios</a></p>
                    </div>
                </div>
            </div>

            <!-- Artículo 3 -->
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="meta-date">
                            <span>10</span>
                            <strong>Jun</strong>
                            <span>2025</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">La importancia del pulido profesional</a></h3>
                        <p>
                            Un buen pulido elimina micro-rayas y devuelve el acabado brillante a la pintura de tu vehículo.
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Equipo de Lavado</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Mantenimiento</a></p>
                        <p><i class="fa fa-comments"></i><a href="">5 Comentarios</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Blog End -->



<?php include __DIR__ . '/includes/footer.php'; ?>
