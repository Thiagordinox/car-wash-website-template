<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/reservas.php';
require_admin();

$pdo = db();

$totales = $pdo->query(
    "SELECT COUNT(*) AS n, COALESCE(SUM(precio_pagado), 0) AS total
     FROM pedidos WHERE estado = 'confirmado'"
)->fetch();

$serviciosCompletados = (int) $pdo->query(
    "SELECT COUNT(*) FROM reservas WHERE estado = 'completada'"
)->fetchColumn();

$ticketPromedio = $totales['n'] > 0 ? $totales['total'] / $totales['n'] : 0;

$porPlan = $pdo->query(
    "SELECT pl.nombre, COUNT(*) AS cantidad, SUM(pe.precio_pagado) AS total
     FROM pedidos pe
     JOIN planes pl ON pl.id_plan = pe.id_plan
     WHERE pe.estado = 'confirmado'
     GROUP BY pl.id_plan, pl.nombre
     ORDER BY total DESC"
)->fetchAll();

$porMetodo = $pdo->query(
    "SELECT metodo_pago, COUNT(*) AS cantidad, SUM(precio_pagado) AS total
     FROM pedidos WHERE estado = 'confirmado'
     GROUP BY metodo_pago"
)->fetchAll();

$porMes = $pdo->query(
    "SELECT DATE_FORMAT(creado_en, '%Y-%m') AS mes, COUNT(*) AS cantidad, SUM(precio_pagado) AS total
     FROM pedidos WHERE estado = 'confirmado'
     GROUP BY mes ORDER BY mes DESC"
)->fetchAll();

$serviciosPorPunto = $pdo->query(
    "SELECT pu.nombre AS punto_nombre, r.tipo_servicio, COUNT(*) AS cantidad
     FROM reservas r
     JOIN puntos pu ON pu.id_punto = r.id_punto
     WHERE r.estado = 'completada'
     GROUP BY pu.id_punto, r.tipo_servicio
     ORDER BY pu.nombre"
)->fetchAll();

$calificacionesPorPunto = $pdo->query(
    "SELECT pu.nombre AS punto_nombre, AVG(e.calificacion) AS promedio, COUNT(*) AS n
     FROM encuestas e
     JOIN reservas r ON r.id_reserva = e.id_reserva
     JOIN puntos pu ON pu.id_punto = r.id_punto
     GROUP BY pu.id_punto
     ORDER BY pu.nombre"
)->fetchAll();

$comentarios = $pdo->query(
    "SELECT e.calificacion, e.comentario, e.creado_en, u.nombre AS cliente_nombre, pu.nombre AS punto_nombre
     FROM encuestas e
     JOIN reservas r ON r.id_reserva = e.id_reserva
     JOIN usuarios u ON u.id_usuario = r.id_usuario
     JOIN puntos pu ON pu.id_punto = r.id_punto
     WHERE e.comentario IS NOT NULL AND e.comentario <> ''
     ORDER BY e.creado_en DESC"
)->fetchAll();

$active_page = 'admin-finanzas';
$page_title = 'Finanzas - Administración - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Finanzas</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="admin-finanzas.php">Administración</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Admin Finanzas Start -->
        <div class="facts" style="margin: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="fa fa-coins"></i>
                            <div class="facts-text">
                                <h3>$<?= number_format((float) $totales['total'], 0, ',', '.') ?></h3>
                                <p>Ingresos totales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="fa fa-file-invoice"></i>
                            <div class="facts-text">
                                <h3><?= (int) $totales['n'] ?></h3>
                                <p>Planes confirmados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="fa fa-check-circle"></i>
                            <div class="facts-text">
                                <h3><?= $serviciosCompletados ?></h3>
                                <p>Servicios completados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="fa fa-tag"></i>
                            <div class="facts-text">
                                <h3>$<?= number_format($ticketPromedio, 0, ',', '.') ?></h3>
                                <p>Ticket promedio</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Ingresos</p>
                    <h2>De los planes vendidos</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Por plan</h3>
                        <table class="table table-bordered text-center">
                            <thead><tr><th>Plan</th><th>Cant.</th><th>Total</th></tr></thead>
                            <tbody>
                                <?php foreach ($porPlan as $fila): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                                        <td><?= (int) $fila['cantidad'] ?></td>
                                        <td>$<?= number_format((float) $fila['total'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h3>Por método de pago</h3>
                        <table class="table table-bordered text-center">
                            <thead><tr><th>Método</th><th>Cant.</th><th>Total</th></tr></thead>
                            <tbody>
                                <?php foreach ($porMetodo as $fila): ?>
                                    <tr>
                                        <td><?= $fila['metodo_pago'] === 'tarjeta' ? 'Tarjeta' : 'Efectivo' ?></td>
                                        <td><?= (int) $fila['cantidad'] ?></td>
                                        <td>$<?= number_format((float) $fila['total'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h3>Por mes</h3>
                        <table class="table table-bordered text-center">
                            <thead><tr><th>Mes</th><th>Cant.</th><th>Total</th></tr></thead>
                            <tbody>
                                <?php foreach ($porMes as $fila): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($fila['mes']) ?></td>
                                        <td><?= (int) $fila['cantidad'] ?></td>
                                        <td>$<?= number_format((float) $fila['total'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="section-header text-center mt-5">
                    <p>Servicios prestados</p>
                    <h2>Citas completadas y satisfacción</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Por punto y tipo de servicio</h3>
                        <table class="table table-bordered text-center">
                            <thead><tr><th>Punto</th><th>Servicio</th><th>Completadas</th></tr></thead>
                            <tbody>
                                <?php foreach ($serviciosPorPunto as $fila): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($fila['punto_nombre']) ?></td>
                                        <td><?= htmlspecialchars(SERVICIOS_NOMBRES[$fila['tipo_servicio']] ?? $fila['tipo_servicio']) ?></td>
                                        <td><?= (int) $fila['cantidad'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3>Calificación promedio por punto</h3>
                        <table class="table table-bordered text-center">
                            <thead><tr><th>Punto</th><th>Promedio</th><th>Encuestas</th></tr></thead>
                            <tbody>
                                <?php foreach ($calificacionesPorPunto as $fila): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($fila['punto_nombre']) ?></td>
                                        <td><?= number_format((float) $fila['promedio'], 1) ?> / 5</td>
                                        <td><?= (int) $fila['n'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="section-header text-center mt-5">
                    <p>Comentarios de clientes</p>
                    <h2>Encuestas de satisfacción</h2>
                </div>
                <?php if (!$comentarios): ?>
                    <p class="text-center">Todavía no hay comentarios.</p>
                <?php else: ?>
                    <?php foreach ($comentarios as $c): ?>
                        <div class="contact-info mb-3">
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="fa fa-star"></i></div>
                                <div class="contact-info-text">
                                    <h3><?= str_repeat('★', (int) $c['calificacion']) ?> &mdash; <?= htmlspecialchars($c['punto_nombre']) ?></h3>
                                    <p><?= htmlspecialchars($c['comentario']) ?></p>
                                    <p><small><?= htmlspecialchars($c['cliente_nombre']) ?> &middot; <?= htmlspecialchars(date('d/m/Y', strtotime($c['creado_en']))) ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- Admin Finanzas End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
