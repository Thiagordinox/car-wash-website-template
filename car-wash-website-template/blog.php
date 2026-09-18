<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'blog';
$page_title = 'AutoLink+ - Tips de cuidado de carros y motos';
include __DIR__ . '/includes/header.php';
?>
        <!-- Encabezado de Página Inicio -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Tips de cuidado de carros y motos</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="blog.php">Tips de cuidado de carros y motos</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Encabezado de Página Fin -->
        
        
        <!-- Blog Inicio -->
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Nuestro Blog</p>
                    <h2>Tips de cuidado de carros y motos</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-1.jpg" alt="Imagen">
                                <div class="meta-date">
                                    <span>01</span>
                                    <strong>Ene</strong>
                                    <span>2025</span>
                                </div>
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Cómo lavar tu auto correctamente</a></h3>
                                <p>
                                    Descubre los pasos esenciales para un lavado eficiente y seguro, cuidando la pintura y el interior de tu vehículo.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">AutoLink</a></p>
                                <p><i class="fa fa-folder"></i><a href="">Cuidado</a></p>
                                <p><i class="fa fa-comments"></i><a href="">10 Comentarios</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-2.jpg" alt="Imagen">
                                <div class="meta-date">
                                    <span>15</span>
                                    <strong>Feb</strong>
                                    <span>2025</span>
                                </div>
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Mantenimiento básico para motos</a></h3>
                                <p>
                                    Aprende a realizar revisiones periódicas y cuidados esenciales para prolongar la vida útil de tu moto.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">AutoLink</a></p>
                                <p><i class="fa fa-folder"></i><a href="">Motos</a></p>
                                <p><i class="fa fa-comments"></i><a href="">8 Comentarios</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/blog-3.jpg" alt="Imagen">
                                <div class="meta-date">
                                    <span>28</span>
                                    <strong>Mar</strong>
                                    <span>2025</span>
                                </div>
                            </div>
                            <div class="blog-text">
                                <h3><a href="#">Productos recomendados para el cuidado</a></h3>
                                <p>
                                    Conoce los mejores productos para limpiar, proteger y mantener tu auto o moto en óptimas condiciones.
                                </p>
                            </div>
                            <div class="blog-meta">
                                <p><i class="fa fa-user"></i><a href="">AutoLink</a></p>
                                <p><i class="fa fa-folder"></i><a href="">Productos</a></p>
                                <p><i class="fa fa-comments"></i><a href="">12 Comentarios</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Fin -->


<?php include __DIR__ . '/includes/footer.php'; ?>
