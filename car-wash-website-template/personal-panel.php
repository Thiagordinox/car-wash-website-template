<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/reservas.php';
require_personal();
$personal = current_personal();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (csrf_check()) {
        $idReserva = (int) ($_POST['reserva'] ?? 0);

        // Nunca se confía en el id que llega por POST: solo se actualiza si
        // la reserva es realmente de este miembro del personal.
        $stmt = db()->prepare(
            "UPDATE reservas SET estado = 'completada'
             WHERE id_reserva = ? AND id_personal = ? AND estado = 'confirmada'"
        );
        $stmt->execute([$idReserva, $personal['id_personal']]);
    }

    header('Location: personal-panel.php');
    exit;
}

$stmt = db()->prepare(
    "SELECT r.id_reserva, r.tipo_servicio, r.fecha, r.hora, r.estado,
            u.nombre AS cliente_nombre, u.telefono AS cliente_telefono
     FROM reservas r
     JOIN usuarios u ON u.id_usuario = r.id_usuario
     WHERE r.id_personal = ?
     ORDER BY r.fecha ASC, r.hora ASC"
);
$stmt->execute([$personal['id_personal']]);
$reservas = $stmt->fetchAll();

$active_page = 'personal-panel';
$page_title = 'Mis citas asignadas - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Mis citas asignadas</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="personal-panel.php">Mis citas asignadas</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Personal Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p><?= htmlspecialchars($personal['cargo']) ?></p>
                    <h2>Citas en tu punto</h2>
                </div>
                <?php if (!$reservas): ?>
                    <p class="text-center">No tienes citas asignadas todavía.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Servicio</th>
                                    <th>Cliente</th>
                                    <th>Teléfono</th>
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
                                        <td><?= htmlspecialchars($reserva['cliente_nombre']) ?></td>
                                        <td><?= htmlspecialchars($reserva['cliente_telefono'] ?: '—') ?></td>
                                        <td><?= htmlspecialchars(ucfirst($reserva['estado'])) ?></td>
                                        <td>
                                            <?php if ($reserva['estado'] === 'confirmada'): ?>
                                                <form method="post" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="reserva" value="<?= (int) $reserva['id_reserva'] ?>">
                                                    <button class="btn btn-custom" type="submit">Marcar completada</button>
                                                </form>
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
        <!-- Personal End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
