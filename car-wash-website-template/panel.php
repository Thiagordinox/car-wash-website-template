<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/planes.php';
require_once __DIR__ . '/includes/reservas.php';
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

$stmt = db()->prepare(
    "SELECT r.id_reserva, r.tipo_servicio, r.fecha, r.hora, r.estado,
            pu.nombre AS punto_nombre, us.nombre AS personal_nombre,
            e.id_encuesta
     FROM reservas r
     JOIN puntos pu ON pu.id_punto = r.id_punto
     LEFT JOIN personal pr ON pr.id_personal = r.id_personal
     LEFT JOIN usuarios us ON us.id_usuario = pr.id_usuario
     LEFT JOIN encuestas e ON e.id_reserva = r.id_reserva
     WHERE r.id_usuario = ?
     ORDER BY r.fecha DESC, r.hora DESC"
);
$stmt->execute([$usuario['id_usuario']]);
$reservas = $stmt->fetchAll();

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
                <?php if (isset($_GET['agendado'])): ?>
                    <div class="alert alert-success text-center">¡Tu cita se agendó correctamente!</div>
                <?php endif; ?>
                <?php if (isset($_GET['encuesta'])): ?>
                    <div class="alert alert-success text-center">¡Gracias por tu calificación!</div>
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

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-header text-center">
                            <p>Agenda</p>
                            <h2>Mis citas</h2>
                        </div>
                        <p class="text-center">
                            <a href="agendar.php" class="btn btn-custom">Agendar una cita</a>
                        </p>
                        <?php if (!$reservas): ?>
                            <p class="text-center">Todavía no has agendado ninguna cita.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Servicio</th>
                                            <th>Punto</th>
                                            <th>Personal</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservas as $reserva): ?>
                                            <tr>
                                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($reserva['fecha']))) ?></td>
                                                <td><?= htmlspecialchars(substr($reserva['hora'], 0, 5)) ?></td>
                                                <td><?= htmlspecialchars(SERVICIOS_NOMBRES[$reserva['tipo_servicio']] ?? $reserva['tipo_servicio']) ?></td>
                                                <td><?= htmlspecialchars($reserva['punto_nombre']) ?></td>
                                                <td><?= htmlspecialchars($reserva['personal_nombre'] ?? 'Por asignar') ?></td>
                                                <td><?= htmlspecialchars(ucfirst($reserva['estado'])) ?></td>
                                                <td>
                                                    <?php if ($reserva['estado'] === 'completada' && $reserva['id_encuesta'] === null): ?>
                                                        <a class="btn btn-custom" href="encuesta.php?reserva=<?= (int) $reserva['id_reserva'] ?>">Calificar</a>
                                                    <?php endif; ?>
                                                </td>
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
