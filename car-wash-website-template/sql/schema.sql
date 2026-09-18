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
