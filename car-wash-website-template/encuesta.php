<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/reservas.php';
require_login();
$usuario = current_user();

function reserva_calificable(int $idReserva, int $idUsuario): ?array
{
    $stmt = db()->prepare(
        "SELECT r.id_reserva, r.tipo_servicio, r.fecha, pu.nombre AS punto_nombre
         FROM reservas r
         JOIN puntos pu ON pu.id_punto = r.id_punto
         LEFT JOIN encuestas e ON e.id_reserva = r.id_reserva
         WHERE r.id_reserva = ? AND r.id_usuario = ? AND r.estado = 'completada' AND e.id_encuesta IS NULL"
    );
    $stmt->execute([$idReserva, $idUsuario]);

    return $stmt->fetch() ?: null;
}

$idReserva = (int) ($_GET['reserva'] ?? $_POST['reserva'] ?? 0);
$reserva = reserva_calificable($idReserva, $usuario['id_usuario']);

if ($reserva === null) {
    header('Location: panel.php');
    exit;
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $calificacion = (int) ($_POST['calificacion'] ?? 0);
        $comentario = trim($_POST['comentario'] ?? '');

        if ($calificacion < 1 || $calificacion > 5) {
            $errores[] = 'Selecciona una calificación de 1 a 5.';
        }
        if (mb_strlen($comentario) > 500) {
            $errores[] = 'El comentario no puede superar 500 caracteres.';
        }

        if (!$errores) {
            try {
                $stmt = db()->prepare(
                    'INSERT INTO encuestas (id_reserva, calificacion, comentario) VALUES (?, ?, ?)'
                );
                $stmt->execute([$idReserva, $calificacion, $comentario !== '' ? $comentario : null]);

                header('Location: panel.php?encuesta=1');
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') {
                    // Ya se envió una encuesta para esta reserva (doble clic o dos pestañas).
                    header('Location: panel.php');
                    exit;
                }
                throw $e;
            }
        }
    }
}

$active_page = 'panel';
$page_title = 'Calificar servicio - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Calificar servicio</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="panel.php">Mi panel</a>
                        <span> / </span>
                        <a href="encuesta.php">Calificar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Encuesta Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p><?= htmlspecialchars($reserva['punto_nombre']) ?> &mdash; <?= htmlspecialchars(date('d/m/Y', strtotime($reserva['fecha']))) ?></p>
                    <h2>¿Cómo estuvo tu servicio de <?= htmlspecialchars(mb_strtolower(SERVICIOS_NOMBRES[$reserva['tipo_servicio']] ?? $reserva['tipo_servicio'])) ?>?</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php foreach ($errores as $error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                        <form method="post" class="contact-form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="reserva" value="<?= $idReserva ?>">
                            <div class="control-group text-center">
                                <label>Calificación</label><br>
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacion" id="cal-<?= $i ?>" value="<?= $i ?>" <?= $i === 5 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="cal-<?= $i ?>"><?= str_repeat('★', $i) ?></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div class="control-group">
                                <textarea name="comentario" class="form-control" placeholder="Cuéntanos más (opcional)" maxlength="500"></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-custom" type="submit">Enviar calificación</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Encuesta End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
