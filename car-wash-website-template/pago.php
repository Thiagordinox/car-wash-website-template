<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/planes.php';
require_login();
$usuario = current_user();

$errores = [];

$plan = (string) ($_POST['plan'] ?? $_GET['plan'] ?? '');
$vehiculo = (string) ($_POST['vehiculo'] ?? $_GET['vehiculo'] ?? '');

if (!in_array($plan, PLANES_VALIDOS, true) || !in_array($vehiculo, VEHICULOS_VALIDOS, true)) {
    header('Location: price.php');
    exit;
}

$precio = precio_plan($plan, $vehiculo);
if ($precio === null) {
    header('Location: price.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $metodoPago = (string) ($_POST['metodo_pago'] ?? '');
        $titular = trim($_POST['tarjeta_titular'] ?? '');
        $ultimos4 = trim($_POST['tarjeta_ultimos4'] ?? '');

        if (!in_array($metodoPago, ['tarjeta', 'efectivo'], true)) {
            $errores[] = 'Selecciona un método de pago.';
        }

        if ($metodoPago === 'tarjeta') {
            if ($titular === '') {
                $errores[] = 'Ingresa el nombre del titular de la tarjeta.';
            }
            if (!preg_match('/^\d{4}$/', $ultimos4)) {
                $errores[] = 'Ingresa los últimos 4 dígitos de tu tarjeta.';
            }
        }

        if (!$errores) {
            $idPlan = id_plan_por_slug($plan);
            $estado = $metodoPago === 'tarjeta' ? 'confirmado' : 'pendiente';
            $referencia = $metodoPago === 'tarjeta' ? strtoupper(bin2hex(random_bytes(6))) : null;

            $stmt = db()->prepare(
                'INSERT INTO pedidos
                    (id_usuario, id_plan, tipo_vehiculo, precio_pagado, metodo_pago, tarjeta_titular, tarjeta_ultimos4, estado, referencia_pago)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $usuario['id_usuario'],
                $idPlan,
                $vehiculo,
                $precio,
                $metodoPago,
                $metodoPago === 'tarjeta' ? $titular : null,
                $metodoPago === 'tarjeta' ? $ultimos4 : null,
                $estado,
                $referencia,
            ]);

            header('Location: panel.php?confirmacion=1');
            exit;
        }
    }
}

$active_page = 'price';
$page_title = 'Confirmar pago - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Confirmar pago</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="price.php">Planes</a>
                        <span> / </span>
                        <a href="pago.php">Pago</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Pago Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Ya casi terminas</p>
                    <h2>Confirma tu plan</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php foreach ($errores as $error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>

                        <div class="contact-info mb-4">
                            <h2>Resumen del plan</h2>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="far fa-check-circle"></i></div>
                                <div class="contact-info-text">
                                    <h3><?= htmlspecialchars(PLANES_NOMBRES[$plan]) ?></h3>
                                    <p>Vehículo: <?= htmlspecialchars(VEHICULOS_NOMBRES[$vehiculo]) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="fa fa-tag"></i></div>
                                <div class="contact-info-text">
                                    <h3>Total a pagar</h3>
                                    <p>$<?= number_format($precio, 0, ',', '.') ?> COP</p>
                                </div>
                            </div>
                        </div>

                        <div class="contact-form">
                            <div class="alert alert-info">
                                Modo de prueba: esta es una pasarela simulada con fines académicos, no se realizará ningún cobro real.
                            </div>
                            <form method="post" novalidate>
                                <?= csrf_field() ?>
                                <input type="hidden" name="plan" value="<?= htmlspecialchars($plan) ?>">
                                <input type="hidden" name="vehiculo" value="<?= htmlspecialchars($vehiculo) ?>">

                                <div class="control-group">
                                    <label>Método de pago</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="metodo_pago" id="metodo-tarjeta" value="tarjeta" checked>
                                        <label class="form-check-label" for="metodo-tarjeta">Tarjeta</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="metodo_pago" id="metodo-efectivo" value="efectivo">
                                        <label class="form-check-label" for="metodo-efectivo">Efectivo (pagar en el punto de lavado)</label>
                                    </div>
                                </div>

                                <div id="datos-tarjeta">
                                    <div class="control-group">
                                        <input type="text" name="tarjeta_titular" class="form-control" placeholder="Nombre del titular de la tarjeta">
                                    </div>
                                    <div class="control-group">
                                        <input type="text" name="tarjeta_ultimos4" class="form-control" placeholder="Últimos 4 dígitos de la tarjeta" maxlength="4" pattern="\d{4}">
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-custom" type="submit">Confirmar plan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pago End -->

        <script>
            (function () {
                var tarjeta = document.getElementById('metodo-tarjeta');
                var efectivo = document.getElementById('metodo-efectivo');
                var datosTarjeta = document.getElementById('datos-tarjeta');

                function actualizar() {
                    datosTarjeta.style.display = tarjeta.checked ? '' : 'none';
                }

                tarjeta.addEventListener('change', actualizar);
                efectivo.addEventListener('change', actualizar);
                actualizar();
            })();
        </script>
<?php include __DIR__ . '/includes/footer.php'; ?>
