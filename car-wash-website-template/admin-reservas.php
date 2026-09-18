<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/reservas.php';
require_admin();

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $idReserva = (int) ($_POST['reserva'] ?? 0);
        $idPersonalNuevo = $_POST['personal'] === '' ? null : (int) $_POST['personal'];

        $stmt = db()->prepare('SELECT id_reserva, id_punto FROM reservas WHERE id_reserva = ?');
        $stmt->execute([$idReserva]);
        $reservaObjetivo = $stmt->fetch();

        if ($reservaObjetivo === false) {
            $errores[] = 'Esa reserva no existe.';
        } elseif ($idPersonalNuevo !== null) {
            $stmt = db()->prepare(
                'SELECT id_personal FROM personal WHERE id_personal = ? AND id_punto = ? AND activo = 1'
            );
            $stmt->execute([$idPersonalNuevo, $reservaObjetivo['id_punto']]);
            if ($stmt->fetch() === false) {
                $errores[] = 'Ese miembro del personal no trabaja en el punto de esa reserva.';
            }
        }

        if (!$errores) {
            $stmt = db()->prepare('UPDATE reservas SET id_personal = ? WHERE id_reserva = ?');
            $stmt->execute([$idPersonalNuevo, $idReserva]);
            header('Location: admin-reservas.php');
            exit;
        }
    }
}

$filtroEstado = (string) ($_GET['estado'] ?? '');
$estadosValidos = ['confirmada', 'completada', 'cancelada'];

$sql = "SELECT r.id_reserva, r.tipo_servicio, r.fecha, r.hora, r.estado, r.id_punto,
               u.nombre AS cliente_nombre, u.correo AS cliente_correo,
               pu.nombre AS punto_nombre, r.id_personal
        FROM reservas r
        JOIN usuarios u ON u.id_usuario = r.id_usuario
        JOIN puntos pu ON pu.id_punto = r.id_punto";
$params = [];
if (in_array($filtroEstado, $estadosValidos, true)) {
    $sql .= ' WHERE r.estado = ?';
    $params[] = $filtroEstado;
}
$sql .= ' ORDER BY r.fecha DESC, r.hora DESC';

$stmt = db()->prepare($sql);
$stmt->execute($params);
$reservas = $stmt->fetchAll();

// Personal activo por punto, para armar el <select> de cada fila sin una
// consulta por reserva.
$stmt = db()->prepare(
    'SELECT p.id_personal, p.id_punto, u.nombre
     FROM personal p
     JOIN usuarios u ON u.id_usuario = p.id_usuario
     WHERE p.activo = 1'
);
$stmt->execute();
$personalPorPunto = [];
foreach ($stmt->fetchAll() as $p) {
    $personalPorPunto[(int) $p['id_punto']][] = $p;
}

$active_page = 'admin-reservas';
$page_title = 'Reservas - Administración - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Reservas</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="admin-reservas.php">Administración</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Admin Reservas Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Panel de administración</p>
                    <h2>Todas las reservas</h2>
                </div>
                <?php foreach ($errores as $error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
                <div class="text-center mb-3">
                    <a href="admin-reservas.php" class="<?= $filtroEstado === '' ? 'font-weight-bold' : '' ?>">Todas</a>
                    &nbsp;|&nbsp;
                    <a href="admin-reservas.php?estado=confirmada" class="<?= $filtroEstado === 'confirmada' ? 'font-weight-bold' : '' ?>">Confirmadas</a>
                    &nbsp;|&nbsp;
                    <a href="admin-reservas.php?estado=completada" class="<?= $filtroEstado === 'completada' ? 'font-weight-bold' : '' ?>">Completadas</a>
                    &nbsp;|&nbsp;
                    <a href="admin-reservas.php?estado=cancelada" class="<?= $filtroEstado === 'cancelada' ? 'font-weight-bold' : '' ?>">Canceladas</a>
                </div>
                <?php if (!$reservas): ?>
                    <p class="text-center">No hay reservas para mostrar.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Servicio</th>
                                    <th>Cliente</th>
                                    <th>Punto</th>
                                    <th>Personal asignado</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservas as $reserva): ?>
                                    <tr>
                                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($reserva['fecha']))) ?></td>
                                        <td><?= htmlspecialchars(substr($reserva['hora'], 0, 5)) ?></td>
                                        <td><?= htmlspecialchars(SERVICIOS_NOMBRES[$reserva['tipo_servicio']] ?? $reserva['tipo_servicio']) ?></td>
                                        <td><?= htmlspecialchars($reserva['cliente_nombre']) ?><br><small><?= htmlspecialchars($reserva['cliente_correo']) ?></small></td>
                                        <td><?= htmlspecialchars($reserva['punto_nombre']) ?></td>
                                        <td>
                                            <form method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="reserva" value="<?= (int) $reserva['id_reserva'] ?>">
                                                <select name="personal" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="">Sin asignar</option>
                                                    <?php foreach ($personalPorPunto[(int) $reserva['id_punto']] ?? [] as $p): ?>
                                                        <option value="<?= (int) $p['id_personal'] ?>" <?= (int) $reserva['id_personal'] === (int) $p['id_personal'] ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($p['nombre']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <noscript><button class="btn btn-custom btn-sm mt-1" type="submit">Guardar</button></noscript>
                                            </form>
                                        </td>
                                        <td><?= htmlspecialchars(ucfirst($reserva['estado'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Admin Reservas End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
