-- AutoLink+ — esquema de base de datos
-- Importar en phpMyAdmin (XAMPP): pestaña "Importar" -> seleccionar este archivo.
-- Esta rama (feature/auth-usuarios) solo crea la base de datos y la tabla de usuarios.
-- Ramas posteriores (feature/planes-pagos, feature/mapas-talleres) añaden más tablas
-- con sentencias ALTER/CREATE adicionales en este mismo archivo.

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
