<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_admin();

$errores = [];
$mensajes = [];
$nombre = $correo = $cargo = '';
$idPunto = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $accion = (string) ($_POST['accion'] ?? '');

        if ($accion === 'alternar_activo') {
            $idPersonal = (int) ($_POST['personal'] ?? 0);
            $stmt = db()->prepare('UPDATE personal SET activo = NOT activo WHERE id_personal = ?');
            $stmt->execute([$idPersonal]);
            header('Location: admin-personal.php');
            exit;
        }

        if ($accion === 'crear') {
            $nombre = trim($_POST['nombre'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $password = (string) ($_POST['password'] ?? '');
            $cargo = trim($_POST['cargo'] ?? '');
            $idPunto = (int) ($_POST['punto'] ?? 0);

            if ($nombre === '') {
                $errores[] = 'El nombre es obligatorio.';
            }
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores[] = 'Ingresa un correo electrónico válido.';
            }
            if (strlen($password) < 8) {
                $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
            }
            if ($cargo === '') {
                $errores[] = 'El cargo es obligatorio.';
            }

            $stmt = db()->prepare('SELECT id_punto FROM puntos WHERE id_punto = ? AND activo = 1');
            $stmt->execute([$idPunto]);
            if ($stmt->fetch() === false) {
                $errores[] = 'Selecciona un punto válido.';
            }

            if (!$errores) {
                $pdo = db();
                try {
                    $pdo->beginTransaction();

                    $stmt = $pdo->prepare(
                        "INSERT INTO usuarios (nombre, correo, password_hash, rol) VALUES (?, ?, ?, 'personal')"
                    );
                    $stmt->execute([$nombre, $correo, password_hash($password, PASSWORD_DEFAULT)]);
                    $idUsuario = (int) $pdo->lastInsertId();

                    $stmt = $pdo->prepare(
                        'INSERT INTO personal (id_usuario, id_punto, cargo) VALUES (?, ?, ?)'
                    );
                    $stmt->execute([$idUsuario, $idPunto, $cargo]);

                    $pdo->commit();

                    header('Location: admin-personal.php');
                    exit;
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    if ($e->getCode() === '23000') {
                        $errores[] = 'Ya existe una cuenta registrada con ese correo.';
                    } else {
                        throw $e;
                    }
                }
            }
        }
    }
}

$stmt = db()->prepare(
    'SELECT p.id_personal, p.cargo, p.activo, u.nombre, u.correo, pu.nombre AS punto_nombre
     FROM personal p
     JOIN usuarios u ON u.id_usuario = p.id_usuario
     JOIN puntos pu ON pu.id_punto = p.id_punto
     ORDER BY pu.nombre, u.nombre'
);
$stmt->execute();
$personal = $stmt->fetchAll();

$stmt = db()->prepare('SELECT id_punto, nombre, tipo FROM puntos WHERE activo = 1 ORDER BY tipo, orden');
$stmt->execute();
$puntos = $stmt->fetchAll();

$active_page = 'admin-personal';
$page_title = 'Personal - Administración - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Personal</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="admin-personal.php">Administración</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Admin Personal Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Panel de administración</p>
                    <h2>Personal</h2>
                </div>
                <?php foreach ($errores as $error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>

                <div class="table-responsive mb-5">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Punto</th>
                                <th>Cargo</th>
                                <th>Activo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($personal as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                                    <td><?= htmlspecialchars($p['correo']) ?></td>
                                    <td><?= htmlspecialchars($p['punto_nombre']) ?></td>
                                    <td><?= htmlspecialchars($p['cargo']) ?></td>
                                    <td><?= $p['activo'] ? 'Sí' : 'No' ?></td>
                                    <td>
                                        <form method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="accion" value="alternar_activo">
                                            <input type="hidden" name="personal" value="<?= (int) $p['id_personal'] ?>">
                                            <button class="btn btn-custom btn-sm" type="submit">
                                                <?= $p['activo'] ? 'Desactivar' : 'Activar' ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="contact-form">
                            <h2>Nuevo miembro del personal</h2>
                            <form method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="accion" value="crear">
                                <div class="control-group">
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" value="<?= htmlspecialchars($nombre) ?>" required>
                                </div>
                                <div class="control-group">
                                    <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" value="<?= htmlspecialchars($correo) ?>" required>
                                </div>
                                <div class="control-group">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña (mínimo 8 caracteres)" required minlength="8">
                                </div>
                                <div class="control-group">
                                    <input type="text" name="cargo" class="form-control" placeholder="Cargo (ej. Técnico mecánico)" value="<?= htmlspecialchars($cargo) ?>" required>
                                </div>
                                <div class="control-group">
                                    <select name="punto" class="form-control" required>
                                        <option value="">Selecciona un punto</option>
                                        <?php foreach ($puntos as $pt): ?>
                                            <option value="<?= (int) $pt['id_punto'] ?>" <?= $idPunto === (int) $pt['id_punto'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($pt['nombre']) ?> (<?= $pt['tipo'] === 'taller' ? 'Taller' : 'Lavadero' ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button class="btn btn-custom" type="submit">Crear cuenta de personal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Admin Personal End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
