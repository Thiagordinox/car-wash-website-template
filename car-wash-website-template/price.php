<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'price';
$page_title = 'Planes - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Planes disponibles</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="price.php">Planes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Price Start -->
        <div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Planes de membresía</p> <!-- Corregido mayúsculas -->
            <h2>Elige tu plan</h2> <!-- Corregido mayúsculas -->
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
        
<?php include __DIR__ . '/includes/footer.php'; ?>
