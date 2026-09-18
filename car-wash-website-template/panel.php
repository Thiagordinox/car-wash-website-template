<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_login();
$usuario = current_user();

$active_page = 'panel';
$page_title = 'Mi panel - AutoLink+';
include __DIR__ . '/includes/header.php';
?>
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Mi panel</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="panel.php">Mi panel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Panel Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Bienvenido</p>
                    <h2>Hola, <?= htmlspecialchars($usuario['nombre']) ?></h2>
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="contact-info">
                            <h2>Datos de tu cuenta</h2>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="far fa-envelope"></i></div>
                                <div class="contact-info-text">
                                    <h3>Correo</h3>
                                    <p><?= htmlspecialchars($usuario['correo']) ?></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon"><i class="fa fa-phone-alt"></i></div>
                                <div class="contact-info-text">
                                    <h3>Teléfono</h3>
                                    <p><?= htmlspecialchars($usuario['telefono'] ?: 'No registrado') ?></p>
                                </div>
                            </div>
                        </div>
                        <a href="perfil.php" class="btn btn-custom mt-3">Editar mi perfil</a>
                        <a href="price.php" class="btn btn-custom mt-3">Ver planes disponibles</a>
                    </div>
                </div>
                <!-- El historial de pedidos se agrega en la rama feature/planes-pagos -->
            </div>
        </div>
        <!-- Panel End -->
<?php include __DIR__ . '/includes/footer.php'; ?>
