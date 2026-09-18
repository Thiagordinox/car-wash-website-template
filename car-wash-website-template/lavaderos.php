<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/puntos.php';

$lavaderos = listar_puntos('lavadero');

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
        <div class="section-header text-center">
            <p>Puntos de Lavado</p>
            <h2>Centros de Lavado de Carros y Motos</h2>
        </div>
        <div class="row">
            <?php foreach ($lavaderos as $lavadero): ?>
                <div class="col-lg-6 mb-4">
                    <div class="border rounded p-3 h-100">
                        <div class="location-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="location-text">
                                <h3><?= htmlspecialchars($lavadero['nombre']) ?></h3>
                                <p><?= htmlspecialchars($lavadero['direccion']) ?></p>
                                <p><strong>Tel:</strong> <?= htmlspecialchars($lavadero['telefono']) ?></p>
                                <?php if ($lavadero['descripcion']): ?>
                                    <p><?= htmlspecialchars($lavadero['descripcion']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <iframe
                            src="<?= htmlspecialchars(mapa_embed_url_de($lavadero)) ?>"
                            width="100%"
                            height="220"
                            style="border:0; border-radius: 10px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Location End -->
        
        
<?php include __DIR__ . '/includes/footer.php'; ?>
