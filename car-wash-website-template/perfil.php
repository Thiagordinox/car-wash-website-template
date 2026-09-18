<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_login();
$usuario = current_user();

$mensajes = [];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'datos') {
            $nombre = trim($_POST['nombre'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            if ($nombre === '') {
                $errores[] = 'El nombre no puede estar vacío.';
            } else {
                $stmt = db()->prepare('UPDATE usuarios SET nombre = ?, telefono = ? WHERE id_usuario = ?');
                $stmt->execute([$nombre, $telefono !== '' ? $telefono : null, $usuario['id_usuario']]);
                $mensajes[] = 'Tus datos se actualizaron correctamente.';
                $usuario['nombre'] = $nombre;
                $usuario['telefono'] = $telefono;
            }
        } elseif ($accion === 'password') {
            $actual = (string) ($_POST['password_actual'] ?? '');
            $nueva = (string) ($_POST['password_nueva'] ?? '');
            $confirmar = (string) ($_POST['password_confirmar'] ?? '');

            $stmt = db()->prepare('SELECT password_hash FROM usuarios WHERE id_usuario = ?');
            $stmt->execute([$usuario['id_usuario']]);
            $hashActual = $stmt->fetchColumn();

            if (!password_verify($actual, (string) $hashActual)) {
                $errores[] = 'La contraseña actual no es correcta.';
            } elseif (strlen($nueva) < 8) {
                $errores[] = 'La nueva contraseña debe tener al menos 8 caracteres.';
            } elseif ($nueva !== $confirmar) {
                $errores[] = 'Las contraseñas nuevas no coinciden.';
            } else {
                $stmt = db()->prepare('UPDATE usuarios SET password_hash = ? WHERE id_usuario = ?');
                $stmt->execute([password_hash($nueva, PASSWORD_DEFAULT), $usuario['id_usuario']]);
                $mensajes[] = 'Tu contraseña se actualizó correctamente.';
            }
        }
    }
}

$active_page = 'perfil';
$page_title = 'Mi perfil - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Mi perfil</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="perfil.php">Mi perfil</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Perfil Start -->
        <div class="contact">
            <div class="container">
                <?php foreach ($mensajes as $m): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($m) ?></div>
                <?php endforeach; ?>
                <?php foreach ($errores as $e): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form">
                            <h2>Datos personales</h2>
                            <form method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="accion" value="datos">
                                <div class="control-group">
                                    <label>Nombre completo</label>
                                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                                </div>
                                <div class="control-group">
                                    <label>Correo electrónico</label>
                                    <input type="email" class="form-control" value="<?= htmlspecialchars($usuario['correo']) ?>" disabled>
                                </div>
                                <div class="control-group">
                                    <label>Teléfono</label>
                                    <input type="tel" name="telefono" class="form-control" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>">
                                </div>
                                <button class="btn btn-custom" type="submit">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            <h2>Cambiar contraseña</h2>
                            <form method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="accion" value="password">
                                <div class="control-group">
                                    <input type="password" name="password_actual" class="form-control" placeholder="Contraseña actual" required>
                                </div>
                                <div class="control-group">
                                    <input type="password" name="password_nueva" class="form-control" placeholder="Nueva contraseña" required minlength="8">
                                </div>
                                <div class="control-group">
                                    <input type="password" name="password_confirmar" class="form-control" placeholder="Confirmar nueva contraseña" required minlength="8">
                                </div>
                                <button class="btn btn-custom" type="submit">Actualizar contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Perfil End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
