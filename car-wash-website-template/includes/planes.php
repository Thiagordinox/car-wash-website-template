<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

const PLANES_VALIDOS = ['basico', 'premium', 'completo'];
const VEHICULOS_VALIDOS = ['moto', 'carro', 'camioneta', 'bus_camion'];

const PLANES_NOMBRES = [
    'basico' => 'Plan Básico',
    'premium' => 'Plan Premium',
    'completo' => 'Plan Completo',
];

const VEHICULOS_NOMBRES = [
    'moto' => 'Moto',
    'carro' => 'Carro',
    'camioneta' => 'Camioneta',
    'bus_camion' => 'Bus/Camión',
];

/**
 * Única fuente de verdad del precio de un plan: nunca se confía en un precio
 * enviado por el cliente. Devuelve null si el plan/vehículo no existe.
 */
function precio_plan(string $planSlug, string $tipoVehiculo): ?int
{
    if (!in_array($planSlug, PLANES_VALIDOS, true) || !in_array($tipoVehiculo, VEHICULOS_VALIDOS, true)) {
        return null;
    }

    $stmt = db()->prepare(
        'SELECT pp.precio
         FROM planes_precios pp
         JOIN planes p ON p.id_plan = pp.id_plan
         WHERE p.slug = ? AND pp.tipo_vehiculo = ?'
    );
    $stmt->execute([$planSlug, $tipoVehiculo]);
    $precio = $stmt->fetchColumn();

    return $precio !== false ? (int) $precio : null;
}

function id_plan_por_slug(string $planSlug): ?int
{
    $stmt = db()->prepare('SELECT id_plan FROM planes WHERE slug = ?');
    $stmt->execute([$planSlug]);
    $id = $stmt->fetchColumn();

    return $id !== false ? (int) $id : null;
}
