<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_guest();

$errores = [];
$nombre = $correo = $telefono = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errores[] = 'Tu sesión expiró, por favor intenta de nuevo.';
    }

    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $confirmar = (string) ($_POST['confirmar_password'] ?? '');

    if ($nombre === '') {
        $errores[] = 'El nombre es obligatorio.';
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresa un correo electrónico válido.';
    }
    if (strlen($password) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
    }
    if ($password !== $confirmar) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    if (!$errores) {
        try {
            $stmt = db()->prepare(
                'INSERT INTO usuarios (nombre, correo, telefono, password_hash) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$nombre, $correo, $telefono !== '' ? $telefono : null, password_hash($password, PASSWORD_DEFAULT)]);

            $stmt = db()->prepare('SELECT id_usuario, nombre, correo, telefono, rol FROM usuarios WHERE id_usuario = ?');
            $stmt->execute([db()->lastInsertId()]);
            login_user($stmt->fetch());

            header('Location: panel.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errores[] = 'Ya existe una cuenta registrada con ese correo.';
            } else {
                $errores[] = 'No se pudo completar el registro. Intenta de nuevo más tarde.';
            }
        }
    }
}

$active_page = 'registro';
$page_title = 'Crear cuenta - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Crear cuenta</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="registro.php">Registro</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Registro Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Únete a AutoLink+</p>
                    <h2>Crea tu cuenta</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="contact-form">
                            <?php if ($errores): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php foreach ($errores as $error): ?>
                                            <li><?= htmlspecialchars($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form method="post" novalidate>
                                <?= csrf_field() ?>
                                <div class="control-group">
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required value="<?= htmlspecialchars($nombre) ?>">
                                </div>
                                <div class="control-group">
                                    <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required value="<?= htmlspecialchars($correo) ?>">
                                </div>
                                <div class="control-group">
                                    <input type="tel" name="telefono" class="form-control" placeholder="Teléfono (opcional)" value="<?= htmlspecialchars($telefono) ?>">
                                </div>
                                <div class="control-group">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña (mínimo 8 caracteres)" required minlength="8">
                                </div>
                                <div class="control-group">
                                    <input type="password" name="confirmar_password" class="form-control" placeholder="Confirmar contraseña" required minlength="8">
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit">Registrarme</button>
                                </div>
                            </form>
                            <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registro End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
