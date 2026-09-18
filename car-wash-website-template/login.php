<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_guest();

$error = '';
$correo = '';
$redirect_input = (string) ($_GET['redirect'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $error = 'Tu sesión expiró, por favor intenta de nuevo.';
    } else {
        $correo = trim($_POST['correo'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        $stmt = db()->prepare(
            'SELECT id_usuario, nombre, correo, telefono, rol, password_hash FROM usuarios WHERE correo = ?'
        );
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            unset($usuario['password_hash']);
            login_user($usuario);

            $redirect = (string) ($_POST['redirect'] ?? '');
            if (!preg_match('#^[a-zA-Z0-9_\-]+\.php(\?[a-zA-Z0-9_\-=&%.]*)?$#', $redirect)) {
                $redirect = 'panel.php';
            }
            header('Location: ' . $redirect);
            exit;
        }

        $error = 'Correo o contraseña incorrectos.';
    }
}

$active_page = 'login';
$page_title = 'Iniciar sesión - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Iniciar sesión</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="login.php">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Login Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Bienvenido de nuevo</p>
                    <h2>Inicia sesión en tu cuenta</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="contact-form">
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form method="post" novalidate>
                                <?= csrf_field() ?>
                                <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect_input) ?>">
                                <div class="control-group">
                                    <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required value="<?= htmlspecialchars($correo) ?>">
                                </div>
                                <div class="control-group">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit">Iniciar sesión</button>
                                </div>
                            </form>
                            <p class="mt-3">¿Aún no tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
