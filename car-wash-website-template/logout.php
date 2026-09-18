<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
}

header('Location: index.php');
exit;
