<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

function current_user(): ?array
{
    static $user = null;
    static $loaded = false;

    if (empty($_SESSION['user_id'])) {
        return null;
    }

    if (!$loaded) {
        $stmt = db()->prepare('SELECT id_usuario, nombre, correo, telefono, rol FROM usuarios WHERE id_usuario = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch() ?: null;
        $loaded = true;

        if ($user === null) {
            // La cuenta ya no existe: solo se limpia la referencia huérfana,
            // sin destruir toda la sesión (eso invalidaría a mitad de la
            // petición el token CSRF que la página está a punto de usar).
            unset($_SESSION['user_id']);
        }
    }

    return $user;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function require_login(): void
{
    if (!is_logged_in()) {
        $redirect = urlencode($_SERVER['REQUEST_URI'] ?? 'panel.php');
        header('Location: login.php?redirect=' . $redirect);
        exit;
    }
}

function require_guest(): void
{
    if (is_logged_in()) {
        header('Location: panel.php');
        exit;
    }
}

function require_admin(): void
{
    require_login();
    if (current_user()['rol'] !== 'admin') {
        header('Location: panel.php');
        exit;
    }
}

/**
 * Un miembro del personal, con sus datos de la tabla "personal" incluidos.
 * Exige personal.activo = 1: una cuenta desactivada no debe poder entrar al
 * portal aunque su usuarios.rol siga siendo 'personal'.
 */
function current_personal(): ?array
{
    static $personal = null;
    static $loaded = false;

    $usuario = current_user();
    if ($usuario === null || $usuario['rol'] !== 'personal') {
        return null;
    }

    if (!$loaded) {
        $stmt = db()->prepare(
            'SELECT id_personal, id_usuario, id_punto, cargo, activo
             FROM personal
             WHERE id_usuario = ? AND activo = 1'
        );
        $stmt->execute([$usuario['id_usuario']]);
        $personal = $stmt->fetch() ?: null;
        $loaded = true;
    }

    return $personal;
}

function require_personal(): void
{
    require_login();
    if (current_personal() === null) {
        header('Location: panel.php');
        exit;
    }
}

function login_user(array $usuario): void
{
    session_regenerate_id(true);
    $_SESSION['user_id'] = $usuario['id_usuario'];
}
