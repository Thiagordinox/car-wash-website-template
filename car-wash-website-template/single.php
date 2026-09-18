<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

$active_page = 'single';
$page_title = 'AutoLink+ - Profesionalismo en el lavado de carros y motos';
include __DIR__ . '/includes/header.php';
?>
        <!-- Encabezado de Página Inicio -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Profesionalismo en el lavado de carros y motos</h2>
                    </div>
                    <div class="col-12">
                        <a href="index.php">Inicio</a>
                        <span> / </span>
                        <a href="single.php">Detalle</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Encabezado de Página Fin -->


        <!-- Contenido Detalle Inicio-->
        <div class="single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-content">
                            <img src="img/single.jpg" alt="Lavado profesional" />
                            <h2>Compromiso y profesionalismo en cada servicio</h2>
                            <p>
                                En <strong>AutoLink</strong> nos destacamos por el profesionalismo y la dedicación con la que realizamos el lavado de carros y motos. Nuestro equipo está altamente capacitado para ofrecerte un servicio de calidad, cuidando cada detalle de tu vehículo.
                            </p>
                            <p>
                                Utilizamos <strong>productos de alta calidad</strong> que garantizan la protección de la pintura, tapicería y demás componentes de tu auto o moto. Trabajamos con marcas reconocidas en el mercado, asegurando resultados superiores y duraderos.
                            </p>
                            <h3>Procesos especializados para tu tranquilidad</h3>
                            <p>
                                Nuestro proceso de lavado incluye:
                            </p>
                            <ul>
                                <li>Lavado exterior con champús especiales que no dañan la pintura.</li>
                                <li>Limpieza y desinfección interior con productos ecológicos.</li>
                                <li>Aspirado profundo de alfombras y asientos.</li>
                                <li>Encerado y protección de superficies.</li>
                                <li>Secado manual para evitar rayones.</li>
                                <li>Revisión final para garantizar la satisfacción del cliente.</li>
                            </ul>
                            <h4>Calidad y economía gracias a nuestra aplicación</h4>
                            <p>
                                Gracias a nuestra aplicación <strong>AutoLink</strong>, puedes agendar tu servicio de manera rápida y sencilla, eligiendo el punto de lavado más cercano y el horario que más te convenga. Además, al optimizar nuestros procesos y recursos, logramos ofrecer <strong>costos accesibles</strong> sin sacrificar la calidad del servicio.
                            </p>
                            <p>
                                ¡Confía en AutoLink y vive la experiencia de un lavado profesional, seguro y económico para tu carro o moto!
                            </p>
                        </div>
                        <div class="single-tags">
                            <a href="">Lavado profesional</a>
                            <a href="">Carros</a>
                            <a href="">Motos</a>
                            <a href="">Productos de calidad</a>
                            <a href="">Economía</a>
                            <a href="">Aplicación</a>
                        </div>
                        <div class="single-related">
                            <h2>Artículos relacionados</h2>
                            <div class="owl-carousel related-slider">
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="img/post-1.jpg" />
                                    </div>
                                    <div class="post-text">
                                        <a href="">Tips para mantener tu auto como nuevo</a>
                                        <div class="post-meta">
                                            <p>Por <a href="">AutoLink</a></p>
                                            <p>En <a href="">Cuidado</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="img/post-2.jpg" />
                                    </div>
                                    <div class="post-text">
                                        <a href="">Productos recomendados para motos</a>
                                        <div class="post-meta">
                                            <p>Por <a href="">AutoLink</a></p>
                                            <p>En <a href="">Motos</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="img/post-3.jpg" />
                                    </div>
                                    <div class="post-text">
                                        <a href="">¿Por qué elegir un lavado profesional?</a>
                                        <div class="post-meta">
                                            <p>Por <a href="">AutoLink</a></p>
                                            <p>En <a href="">Servicios</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-comment">
                            <h2>3 Comentarios</h2>
                            <ul class="comment-list">
                                <li class="comment-item">
                                    <div class="comment-body">
                                        <div class="comment-img">
                                            <img src="img/user.jpg" />
                                        </div>
                                        <div class="comment-text">
                                            <h3><a href="">Juan Pérez</a></h3>
                                            <span>01 Ene 2025 a las 12:00pm</span>
                                            <p>
                                                Excelente servicio, mi carro quedó impecable y el precio fue muy justo. ¡Recomendado!
                                            </p>
                                            <a class="btn" href="">Responder</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="comment-item">
                                    <div class="comment-body">
                                        <div class="comment-img">
                                            <img src="img/user.jpg" />
                                        </div>
                                        <div class="comment-text">
                                            <h3><a href="">María Gómez</a></h3>
                                            <span>15 Feb 2025 a las 10:30am</span>
                                            <p>
                                                Me gustó mucho la facilidad para agendar desde la app y la atención del personal.
                                            </p>
                                            <a class="btn" href="">Responder</a>
                                        </div>
                                    </div>
                                    <ul class="comment-child">
                                        <li class="comment-item">
                                            <div class="comment-body">
                                                <div class="comment-img">
                                                    <img src="img/user.jpg" />
                                                </div>
                                                <div class="comment-text">
                                                    <h3><a href="">Carlos Ruiz</a></h3>
                                                    <span>15 Feb 2025 a las 11:00am</span>
                                                    <p>
                                                        Totalmente de acuerdo, la calidad de los productos es excelente.
                                                    </p>
                                                    <a class="btn" href="">Responder</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="comment-form">
                            <h2>Deja un comentario</h2>
                            <form>
                                <div class="form-group">
                                    <label for="name">Nombre *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo electrónico *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="website">Sitio web</label>
                                    <input type="url" class="form-control" id="website">
                                </div>

                                <div class="form-group">
                                    <label for="message">Mensaje *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Publicar comentario" class="btn btn-custom">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar-widget">
                                <div class="single-bio">
                                    <div class="single-bio-img">
                                        <img src="img/user.jpg" />
                                    </div>
                                    <div class="single-bio-text">
                                        <h3>AutoLink</h3>
                                        <p>
                                            Somos expertos en el cuidado y lavado profesional de carros y motos, utilizando productos de alta calidad y procesos eficientes para tu tranquilidad y economía.
                                        </p>
                                    </div>
                                    <div class="single-bio-social">
                                        <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                                        <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                                        <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="sidebar-widget">
                                <div class="search-widget">
                                    <form>
                                        <input class="form-control" type="text" placeholder="Buscar...">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Publicaciones recientes</h2>
                                <div class="recent-post">
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-1.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Cómo lavar tu auto correctamente</a>
                                            <div class="post-meta">
                                                <p>Por <a href="">AutoLink</a></p>
                                                <p>En <a href="">Cuidado</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-2.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Mantenimiento básico para motos</a>
                                            <div class="post-meta">
                                                <p>Por <a href="">AutoLink</a></p>
                                                <p>En <a href="">Motos</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-3.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Productos recomendados para el cuidado</a>
                                            <div class="post-meta">
                                                <p>Por <a href="">AutoLink</a></p>
                                                <p>En <a href="">Productos</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/blog-1.jpg" alt="Imagen"></a>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="tab-post">
                                    <ul class="nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#featured">Destacados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#popular">Populares</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#latest">Recientes</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="featured" class="container tab-pane active">
                                            <div class="post-item">
                                                <div class="post-img">
                                                    <img src="img/post-1.jpg" />
                                                </div>
                                                <div class="post-text">
                                                    <a href="">Tips para mantener tu auto como nuevo</a>
                                                    <div class="post-meta">
                                                        <p>Por <a href="">AutoLink</a></p>
                                                        <p>En <a href="">Cuidado</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-item">
                                                <div class="post-img">
                                                    <img src="img/post-2.jpg" />
                                                </div>
                                                <div class="post-text">
                                                    <a href="">Productos recomendados para motos</a>
                                                    <div class="post-meta">
                                                        <p>Por <a href="">AutoLink</a></p>
                                                        <p>En <a href="">Motos</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="popular" class="container tab-pane fade">
                                            <div class="post-item">
                                                <div class="post-img">
                                                    <img src="img/post-3.jpg" />
                                                </div>
                                                <div class="post-text">
                                                    <a href="">¿Por qué elegir un lavado profesional?</a>
                                                    <div class="post-meta">
                                                        <p>Por <a href="">AutoLink</a></p>
                                                        <p>En <a href="">Servicios</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="latest" class="container tab-pane fade">
                                            <div class="post-item">
                                                <div class="post-img">
                                                    <img src="img/post-1.jpg" />
                                                </div>
                                                <div class="post-text">
                                                    <a href="">Cómo lavar tu auto correctamente</a>
                                                    <div class="post-meta">
                                                        <p>Por <a href="">AutoLink</a></p>
                                                        <p>En <a href="">Cuidado</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/blog-2.jpg" alt="Imagen"></a>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Categorías</h2>
                                <div class="category-widget">
                                    <ul>
                                        <li><a href="">Lavado profesional</a><span>(98)</span></li>
                                        <li><a href="">Carros</a><span>(87)</span></li>
                                        <li><a href="">Motos</a><span>(76)</span></li>
                                        <li><a href="">Productos</a><span>(65)</span></li>
                                        <li><a href="">Economía</a><span>(54)</span></li>
                                        <li><a href="">Aplicación</a><span>(43)</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <div class="image-widget">
                                    <a href="#"><img src="img/blog-3.jpg" alt="Imagen"></a>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Nube de etiquetas</h2>
                                <div class="tag-widget">
                                    <a href="">Lavado</a>
                                    <a href="">Carros</a>
                                    <a href="">Motos</a>
                                    <a href="">Productos</a>
                                    <a href="">Economía</a>
                                    <a href="">Aplicación</a>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Texto informativo</h2>
                                <div class="text-widget">
                                    <p>
                                        En AutoLink nos esforzamos por ofrecerte el mejor servicio de lavado, combinando tecnología, productos de calidad y atención personalizada para tu comodidad y economía.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contenido Detalle Fin-->   


<?php include __DIR__ . '/includes/footer.php'; ?>
