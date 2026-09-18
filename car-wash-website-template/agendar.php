<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/reservas.php';
require_once __DIR__ . '/includes/puntos.php';
require_login();
$usuario = current_user();

// --- POST final: crear la reserva ---------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPedido = (int) ($_POST['pedido'] ?? 0);
    $tipo = (string) ($_POST['tipo'] ?? '');
    $idPunto = (int) ($_POST['punto'] ?? 0);
    $fecha = (string) ($_POST['fecha'] ?? '');
    $hora = (string) ($_POST['hora'] ?? '');

    $pedidoValido = pedido_agendable_de_usuario($idPedido, $usuario['id_usuario']);
    $puntoValido = in_array($tipo, SERVICIOS_VALIDOS, true) ? punto_valido_para_servicio($idPunto, $tipo) : null;

    $esValido = csrf_check()
        && $pedidoValido !== null
        && in_array($tipo, SERVICIOS_VALIDOS, true)
        && tipo_disponible_para_pedido($idPedido, $tipo)
        && $puntoValido !== null
        && fecha_valida($fecha)
        && preg_match('/^([01]\d|2[0-3]):00$/', $hora) === 1
        && in_array($hora, slots_disponibles($idPunto, $fecha), true);

    if ($esValido) {
        try {
            $stmt = db()->prepare(
                'INSERT INTO reservas (id_pedido, id_usuario, id_punto, tipo_servicio, fecha, hora)
                 VALUES (?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$idPedido, $usuario['id_usuario'], $idPunto, $tipo, $fecha, $hora . ':00']);
            header('Location: panel.php?agendado=1');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                header(
                    'Location: agendar.php?pedido=' . $idPedido .
                    '&tipo=' . urlencode($tipo) .
                    '&punto=' . $idPunto .
                    '&fecha=' . urlencode($fecha) .
                    '&error=ocupado'
                );
                exit;
            }
            throw $e;
        }
    }

    header('Location: agendar.php');
    exit;
}

// --- Determinar el paso actual, re-validando en cada nivel ---------------
// Nunca se confía en los parámetros de la URL: cada uno se vuelve a
// verificar contra la base de datos antes de usarse para decidir el
// siguiente paso.
$idPedido = isset($_GET['pedido']) ? (int) $_GET['pedido'] : null;
$tipo = isset($_GET['tipo']) ? (string) $_GET['tipo'] : null;
$idPunto = isset($_GET['punto']) ? (int) $_GET['punto'] : null;
$fecha = isset($_GET['fecha']) ? (string) $_GET['fecha'] : null;

$pedido = null;
$punto = null;

if ($idPedido !== null) {
    $pedido = pedido_agendable_de_usuario($idPedido, $usuario['id_usuario']);
    if ($pedido === null) {
        header('Location: agendar.php');
        exit;
    }
}

if ($pedido !== null && $tipo !== null) {
    if (!in_array($tipo, SERVICIOS_VALIDOS, true) || !tipo_disponible_para_pedido($idPedido, $tipo)) {
        header('Location: agendar.php?pedido=' . $idPedido);
        exit;
    }
}

if ($pedido !== null && $tipo !== null && $idPunto !== null) {
    $punto = punto_valido_para_servicio($idPunto, $tipo);
    if ($punto === null) {
        header('Location: agendar.php?pedido=' . $idPedido . '&tipo=' . urlencode($tipo));
        exit;
    }
}

if ($pedido !== null && $tipo !== null && $punto !== null && $fecha !== null) {
    if (!fecha_valida($fecha)) {
        header('Location: agendar.php?pedido=' . $idPedido . '&tipo=' . urlencode($tipo) . '&punto=' . $idPunto);
        exit;
    }
}

$paso = 1;
if ($pedido !== null) {
    $paso = 2;
}
if ($pedido !== null && $tipo !== null) {
    $paso = 3;
}
if ($pedido !== null && $tipo !== null && $punto !== null) {
    $paso = 4;
}
if ($pedido !== null && $tipo !== null && $punto !== null && $fecha !== null) {
    $paso = 5;
}

$hoy = (new DateTimeImmutable('today'))->format('Y-m-d');
$fechaLimite = (new DateTimeImmutable('today'))->modify('+' . RESERVAS_DIAS_ADELANTE . ' days')->format('Y-m-d');

$active_page = 'agendar';
$page_title = 'Agendar cita - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Agendar cita</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="panel.php">Mi panel</a>
                        <span> / </span>
                        <a href="agendar.php">Agendar cita</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Agendar Start -->
        <div class="contact">
            <div class="container">
                <?php if ($paso === 1): ?>
                    <div class="section-header text-center">
                        <p>Paso 1 de 4</p>
                        <h2>Elige el plan que quieres usar</h2>
                    </div>
                    <?php $pedidos = pedidos_agendables($usuario['id_usuario']); ?>
                    <?php if (!$pedidos): ?>
                        <p class="text-center">
                            Todavía no tienes ningún plan confirmado para agendar.
                            <a href="price.php">Ver planes disponibles</a>.
                        </p>
                    <?php else: ?>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <?php foreach ($pedidos as $p): ?>
                                    <div class="punto-card mb-3">
                                        <h3><?= htmlspecialchars($p['plan_nombre']) ?></h3>
                                        <p>Comprado el <?= htmlspecialchars(date('d/m/Y', strtotime($p['creado_en']))) ?></p>
                                        <a class="btn btn-custom" href="agendar.php?pedido=<?= (int) $p['id_pedido'] ?>">Usar este plan</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php elseif ($paso === 2): ?>
                    <div class="section-header text-center">
                        <p>Paso 2 de 4 &mdash; <?= htmlspecialchars($pedido['plan_nombre']) ?></p>
                        <h2>¿Qué tipo de servicio quieres agendar?</h2>
                    </div>
                    <div class="row justify-content-center">
                        <?php foreach (SERVICIOS_VALIDOS as $s): ?>
                            <div class="col-md-4">
                                <div class="punto-card text-center mb-3">
                                    <h3><?= htmlspecialchars(SERVICIOS_NOMBRES[$s]) ?></h3>
                                    <?php if (tipo_disponible_para_pedido($idPedido, $s)): ?>
                                        <a class="btn btn-custom" href="agendar.php?pedido=<?= $idPedido ?>&tipo=<?= urlencode($s) ?>">Elegir</a>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">Ya usaste este beneficio con este plan.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php elseif ($paso === 3): ?>
                    <div class="section-header text-center">
                        <p>Paso 3 de 4 &mdash; <?= htmlspecialchars(SERVICIOS_NOMBRES[$tipo]) ?></p>
                        <h2>Elige el punto más cercano</h2>
                    </div>
                    <div class="row">
                        <?php foreach (listar_puntos(SERVICIO_A_PUNTO[$tipo]) as $pt): ?>
                            <div class="col-lg-6 mb-4">
                                <div class="punto-card h-100">
                                    <div class="location-item">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <div class="location-text">
                                            <h3><?= htmlspecialchars($pt['nombre']) ?></h3>
                                            <p><?= htmlspecialchars($pt['direccion']) ?></p>
                                            <p><strong>Tel:</strong> <?= htmlspecialchars($pt['telefono']) ?></p>
                                        </div>
                                    </div>
                                    <iframe
                                        src="<?= htmlspecialchars(mapa_embed_url_de($pt)) ?>"
                                        width="100%"
                                        height="180"
                                        style="border:0; border-radius: 10px;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                    <a class="btn btn-custom mt-3" href="agendar.php?pedido=<?= $idPedido ?>&tipo=<?= urlencode($tipo) ?>&punto=<?= (int) $pt['id_punto'] ?>">Elegir este punto</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php elseif ($paso === 4): ?>
                    <div class="section-header text-center">
                        <p>Paso 4 de 4 &mdash; <?= htmlspecialchars($punto['nombre']) ?></p>
                        <h2>Elige el día</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <form method="get" class="contact-form">
                                <input type="hidden" name="pedido" value="<?= $idPedido ?>">
                                <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">
                                <input type="hidden" name="punto" value="<?= (int) $idPunto ?>">
                                <div class="control-group">
                                    <input type="date" name="fecha" class="form-control" min="<?= $hoy ?>" max="<?= $fechaLimite ?>" required>
                                </div>
                                <button class="btn btn-custom" type="submit">Ver horarios disponibles</button>
                            </form>
                        </div>
                    </div>

                <?php else: /* paso 5 */ ?>
                    <div class="section-header text-center">
                        <p>Confirmar &mdash; <?= htmlspecialchars($punto['nombre']) ?>, <?= htmlspecialchars(date('d/m/Y', strtotime($fecha))) ?></p>
                        <h2>Elige la hora</h2>
                    </div>
                    <?php if (isset($_GET['error']) && $_GET['error'] === 'ocupado'): ?>
                        <div class="alert alert-danger text-center">Ese horario ya se acaba de reservar, elige otro.</div>
                    <?php endif; ?>
                    <?php $slots = slots_disponibles($idPunto, $fecha); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <?php if (!$slots): ?>
                                <p class="text-center">
                                    No quedan horarios disponibles ese día.
                                    <a href="agendar.php?pedido=<?= $idPedido ?>&tipo=<?= urlencode($tipo) ?>&punto=<?= $idPunto ?>">Elegir otro día</a>.
                                </p>
                            <?php else: ?>
                                <form method="post" class="contact-form">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="pedido" value="<?= $idPedido ?>">
                                    <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">
                                    <input type="hidden" name="punto" value="<?= (int) $idPunto ?>">
                                    <input type="hidden" name="fecha" value="<?= htmlspecialchars($fecha) ?>">
                                    <div class="control-group d-flex flex-wrap" style="gap: 10px;">
                                        <?php foreach ($slots as $i => $hora): ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="hora" id="hora-<?= $i ?>" value="<?= htmlspecialchars($hora) ?>" <?= $i === 0 ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="hora-<?= $i ?>"><?= htmlspecialchars($hora) ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="btn btn-custom mt-3" type="submit">Confirmar reserva</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Agendar End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
