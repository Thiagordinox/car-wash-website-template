-- AutoLink+ — esquema de base de datos
-- Importar en phpMyAdmin (XAMPP): pestaña "Importar" -> seleccionar este archivo.
-- Este archivo se extiende en cada rama: feature/auth-usuarios crea "usuarios",
-- feature/planes-pagos agrega "planes"/"planes_precios"/"pedidos", y
-- feature/mapas-talleres agrega "puntos". Importarlo completo crea todo el esquema.

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS autolink_carwash
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE autolink_carwash;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario      INT AUTO_INCREMENT PRIMARY KEY,
    nombre          VARCHAR(100) NOT NULL,
    correo          VARCHAR(150) NOT NULL UNIQUE,
    telefono        VARCHAR(20)  NULL,
    password_hash   VARCHAR(255) NOT NULL,
    rol             ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    creado_en       DATETIME DEFAULT CURRENT_TIMESTAMP,
    actualizado_en  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- feature/planes-pagos ------------------------------------------------------
-- Los planes y precios ya están visualmente construidos en price.php (con su
-- propio JS de cliente) y no se tocan. Estas tablas son la fuente de verdad
-- del lado del servidor: pago.php jamás confía en un precio enviado por el
-- cliente, siempre lo recalcula consultando planes_precios.

CREATE TABLE IF NOT EXISTS planes (
    id_plan INT AUTO_INCREMENT PRIMARY KEY,
    slug    VARCHAR(20) NOT NULL UNIQUE,
    nombre  VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

INSERT IGNORE INTO planes (slug, nombre) VALUES
    ('basico', 'Plan Básico'),
    ('premium', 'Plan Premium'),
    ('completo', 'Plan Completo');

CREATE TABLE IF NOT EXISTS planes_precios (
    id_precio     INT AUTO_INCREMENT PRIMARY KEY,
    id_plan       INT NOT NULL,
    tipo_vehiculo ENUM('moto', 'carro', 'camioneta', 'bus_camion') NOT NULL,
    precio        INT NOT NULL,
    UNIQUE KEY uq_plan_vehiculo (id_plan, tipo_vehiculo),
    FOREIGN KEY (id_plan) REFERENCES planes(id_plan)
) ENGINE=InnoDB;

-- Precios idénticos a los ya escritos en el JS de price.php.
INSERT IGNORE INTO planes_precios (id_plan, tipo_vehiculo, precio)
SELECT p.id_plan, v.tipo_vehiculo, v.precio
FROM planes p
JOIN (
    SELECT 'basico' AS slug, 'moto' AS tipo_vehiculo, 30000 AS precio
    UNION ALL SELECT 'basico', 'carro', 35000
    UNION ALL SELECT 'basico', 'camioneta', 40000
    UNION ALL SELECT 'basico', 'bus_camion', 50000
    UNION ALL SELECT 'premium', 'moto', 90000
    UNION ALL SELECT 'premium', 'carro', 95000
    UNION ALL SELECT 'premium', 'camioneta', 100000
    UNION ALL SELECT 'premium', 'bus_camion', 110000
    UNION ALL SELECT 'completo', 'moto', 55000
    UNION ALL SELECT 'completo', 'carro', 60000
    UNION ALL SELECT 'completo', 'camioneta', 70000
    UNION ALL SELECT 'completo', 'bus_camion', 85000
) v ON v.slug = p.slug;

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido        INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario       INT NOT NULL,
    id_plan          INT NOT NULL,
    tipo_vehiculo    ENUM('moto', 'carro', 'camioneta', 'bus_camion') NOT NULL,
    precio_pagado    INT NOT NULL,
    metodo_pago      ENUM('tarjeta', 'efectivo') NOT NULL,
    tarjeta_titular  VARCHAR(100) NULL,
    tarjeta_ultimos4 CHAR(4) NULL,
    estado           ENUM('pendiente', 'confirmado', 'cancelado') NOT NULL DEFAULT 'pendiente',
    referencia_pago  VARCHAR(64) NULL,
    creado_en        DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_plan) REFERENCES planes(id_plan),
    INDEX idx_pedidos_usuario (id_usuario)
) ENGINE=InnoDB;

-- feature/mapas-talleres -----------------------------------------------------
-- Un solo catálogo para talleres y lavaderos (misma forma de datos). El mapa
-- de cada punto se genera en PHP a partir de "direccion" con el embed público
-- de Google Maps que no requiere clave de API (?q=...&output=embed); la
-- columna mapa_embed_url solo existe por si algún punto necesita a futuro una
-- URL de mapa hecha a mano en vez de la generada automáticamente.

CREATE TABLE IF NOT EXISTS puntos (
    id_punto       INT AUTO_INCREMENT PRIMARY KEY,
    tipo           ENUM('taller', 'lavadero') NOT NULL,
    nombre         VARCHAR(100) NOT NULL,
    direccion      VARCHAR(200) NOT NULL,
    telefono       VARCHAR(20) NOT NULL,
    descripcion    VARCHAR(200) NULL,
    mapa_embed_url VARCHAR(500) NULL,
    orden          INT NOT NULL DEFAULT 0,
    activo         TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

INSERT IGNORE INTO puntos (tipo, nombre, direccion, telefono, descripcion, orden) VALUES
    ('lavadero', 'Autolavado El Progreso', 'Calle 48 #54-20, Rionegro, Antioquia', '+57 604 561 2345', 'Lavado exterior e interior para carro y moto.', 1),
    ('lavadero', 'Lavadero La Estación', 'Carrera 55 #48-15, Sector El Porvenir, Rionegro, Antioquia', '+57 310 456 7890', 'Lavado rápido y detallado, con zona de espera.', 2),
    ('lavadero', 'EcoWash Rionegro', 'Vía Llanogrande, frente al Mall Complex Llanogrande, Rionegro, Antioquia', '+57 314 789 6543', 'Lavado ecológico de bajo consumo de agua.', 3),
    ('lavadero', 'Lavadero Motocar', 'Carrera 46 #46-05, Sector El Tablazo, Rionegro, Antioquia', '+57 301 234 5678', 'Especialistas en lavado y encerado de motos.', 4),
    ('taller', 'Rionegro Motors', 'Calle 50 #52-30, Rionegro, Antioquia', '+57 604 532 1010', 'Mecánica general y mantenimiento preventivo para carro y camioneta.', 1),
    ('taller', 'MotoExpress Taller', 'Carrera 48 #45-10, Sector Belén, Rionegro, Antioquia', '+57 312 678 4321', 'Taller especializado en motos: frenos, cadena y motor.', 2),
    ('taller', 'Taller El Porvenir Diésel y Gasolina', 'Vía Aeropuerto José María Córdova, Rionegro, Antioquia', '+57 604 545 6767', 'Diagnóstico electrónico y motores diésel y a gasolina.', 3),
    ('taller', 'Suspensión y Frenos Llanogrande', 'Carrera 50 #40-22, Llanogrande, Rionegro, Antioquia', '+57 317 890 1234', 'Alineación, balanceo, suspensión y sistema de frenos.', 4);

-- feature/sistema-reservas ---------------------------------------------------
-- Una reserva agenda un pedido YA confirmado (no es un producto con precio
-- propio): el cliente elige qué plan comprado va a usar, en qué tipo de
-- punto (mantenimiento = taller, lavado = lavadero), cuál punto, qué día y
-- qué hora. Las columnas generadas slot_activo/pedido_tipo_key son la
-- defensa real contra condiciones de carrera (dos personas reservando la
-- misma hora, o el mismo pedido redimido dos veces para el mismo tipo de
-- servicio): se vuelven NULL en cuanto la reserva se cancela, así el
-- horario/beneficio queda libre para reservarse de nuevo. La verificación
-- de disponibilidad en PHP es solo para la interfaz; el INSERT siempre
-- puede chocar con estos índices y el código debe manejar ese error.

ALTER TABLE usuarios MODIFY COLUMN rol ENUM('cliente', 'admin', 'personal') NOT NULL DEFAULT 'cliente';

CREATE TABLE IF NOT EXISTS personal (
    id_personal INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario  INT NOT NULL UNIQUE,
    id_punto    INT NOT NULL,
    cargo       VARCHAR(80) NOT NULL,
    activo      TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_punto) REFERENCES puntos(id_punto)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS reservas (
    id_reserva      INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido       INT NOT NULL,
    id_usuario      INT NOT NULL,
    id_punto        INT NOT NULL,
    id_personal     INT NULL,
    tipo_servicio   ENUM('mantenimiento', 'lavado') NOT NULL,
    fecha           DATE NOT NULL,
    hora            TIME NOT NULL,
    estado          ENUM('confirmada', 'completada', 'cancelada') NOT NULL DEFAULT 'confirmada',
    creado_en       DATETIME DEFAULT CURRENT_TIMESTAMP,
    slot_activo     TIME GENERATED ALWAYS AS (IF(estado = 'cancelada', NULL, hora)) STORED,
    pedido_tipo_key VARCHAR(30) GENERATED ALWAYS AS (IF(estado = 'cancelada', NULL, CONCAT(id_pedido, '-', tipo_servicio))) STORED,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_punto) REFERENCES puntos(id_punto),
    FOREIGN KEY (id_personal) REFERENCES personal(id_personal),
    UNIQUE KEY uq_punto_fecha_slot (id_punto, fecha, slot_activo),
    UNIQUE KEY uq_pedido_tipo_activo (pedido_tipo_key),
    INDEX idx_reservas_usuario (id_usuario)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS encuestas (
    id_encuesta  INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva   INT NOT NULL UNIQUE,
    calificacion TINYINT NOT NULL,
    comentario   VARCHAR(500) NULL,
    creado_en    DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva)
) ENGINE=InnoDB;

-- Personal de prueba (contraseña de desarrollo para los 4: "Personal123!").
-- Repartidos entre talleres y lavaderos para que agendar.php sea probable de
-- inmediato, sin depender todavía del panel de administrador (feature/panel-administrador).
INSERT IGNORE INTO usuarios (nombre, correo, password_hash, rol) VALUES
    ('Julián Restrepo', 'julian.personal@autolink.test', '$2y$10$4EdNE60X3iLB58V9BtPp0eyRG7LOPjd26coGsyPmVHAOKqjr3TpLi', 'personal'),
    ('Valentina Gómez', 'valentina.personal@autolink.test', '$2y$10$4EdNE60X3iLB58V9BtPp0eyRG7LOPjd26coGsyPmVHAOKqjr3TpLi', 'personal'),
    ('Andrés Zapata', 'andres.personal@autolink.test', '$2y$10$4EdNE60X3iLB58V9BtPp0eyRG7LOPjd26coGsyPmVHAOKqjr3TpLi', 'personal'),
    ('Laura Montoya', 'laura.personal@autolink.test', '$2y$10$4EdNE60X3iLB58V9BtPp0eyRG7LOPjd26coGsyPmVHAOKqjr3TpLi', 'personal');

INSERT IGNORE INTO personal (id_usuario, id_punto, cargo)
SELECT u.id_usuario, p.id_punto, asignacion.cargo
FROM usuarios u
JOIN (
    SELECT 'julian.personal@autolink.test' AS correo, 'Rionegro Motors' AS punto, 'Técnico mecánico' AS cargo
    UNION ALL SELECT 'valentina.personal@autolink.test', 'MotoExpress Taller', 'Técnica de motos'
    UNION ALL SELECT 'andres.personal@autolink.test', 'Autolavado El Progreso', 'Operario de lavado'
    UNION ALL SELECT 'laura.personal@autolink.test', 'Lavadero La Estación', 'Operaria de lavado'
) asignacion ON asignacion.correo = u.correo
JOIN puntos p ON p.nombre = asignacion.punto;

-- feature/panel-administrador -------------------------------------------
-- Cuenta de administrador de prueba (contraseña de desarrollo: "Admin123!").
-- Es la única forma de crear más cuentas admin o de personal: no existe (ni
-- debe existir) un formulario público para eso, a diferencia de
-- registro.php que siempre crea rol='cliente'. Borra o cambia esta cuenta
-- antes de cualquier uso real del sitio.
INSERT IGNORE INTO usuarios (nombre, correo, password_hash, rol) VALUES
    ('Administrador AutoLink+', 'admin@autolink.test', '$2y$10$.dwRAN5pB.fc5N/RuRIz5.3cWhq3lUh52ABGpNQjPRvh26a4Y5OnS', 'admin');
