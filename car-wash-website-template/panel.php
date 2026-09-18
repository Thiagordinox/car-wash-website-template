<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/planes.php';
require_login();
$usuario = current_user();

$stmt = db()->prepare(
    'SELECT pe.id_pedido, pl.nombre AS plan_nombre, pe.tipo_vehiculo, pe.precio_pagado,
            pe.metodo_pago, pe.estado, pe.creado_en
     FROM pedidos pe
     JOIN planes pl ON pl.id_plan = pe.id_plan
     WHERE pe.id_usuario = ?
     ORDER BY pe.creado_en DESC'
);
$stmt->execute([$usuario['id_usuario']]);
$pedidos = $stmt->fetchAll();

$active_page = 'panel';
$page_title = 'Mi panel - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Mi panel</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="panel.php">Mi panel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Panel Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Bienvenido</p>
                    <h2>Hola, <?= htmlspecialchars($usuario['nombre']) ?></h2>
                </div>
                <?php if (isset($_GET['confirmacion'])): ?>
                    <div class="alert alert-success text-center">¡Tu plan se registró correctamente!</div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="contact-info">
                            <h2>Datos de tu cuenta</h2>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="far fa-envelope"></i></div>
                                <div class="contact-info-text">
                                    <h3>Correo</h3>
                                    <p><?= htmlspecialchars($usuario['correo']) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="fa fa-phone-alt"></i></div>
                                <div class="contact-info-text">
                                    <h3>Teléfono</h3>
                                    <p><?= htmlspecialchars($usuario['telefono'] ?: 'No registrado') ?></p>
                                </div>
                            </div>
                        </div>
                        <a href="perfil.php" class="btn btn-custom mt-3">Editar mi perfil</a>
                        <a href="price.php" class="btn btn-custom mt-3">Ver planes disponibles</a>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-header text-center">
                            <p>Historial</p>
                            <h2>Mis planes contratados</h2>
                        </div>
                        <?php if (!$pedidos): ?>
                            <p class="text-center">Todavía no has contratado ningún plan.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Plan</th>
                                            <th>Vehículo</th>
                                            <th>Precio</th>
                                            <th>Método de pago</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pedidos as $pedido): ?>
                                            <tr>
                                                <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($pedido['creado_en']))) ?></td>
                                                <td><?= htmlspecialchars($pedido['plan_nombre']) ?></td>
                                                <td><?= htmlspecialchars(VEHICULOS_NOMBRES[$pedido['tipo_vehiculo']] ?? $pedido['tipo_vehiculo']) ?></td>
                                                <td>$<?= number_format((float) $pedido['precio_pagado'], 0, ',', '.') ?></td>
                                                <td><?= $pedido['metodo_pago'] === 'tarjeta' ? 'Tarjeta' : 'Efectivo' ?></td>
                                                <td><?= htmlspecialchars(ucfirst($pedido['estado'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Panel End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
