<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

const SERVICIOS_VALIDOS = ['mantenimiento', 'lavado'];

const SERVICIO_A_PUNTO = [
    'mantenimiento' => 'taller',
    'lavado' => 'lavadero',
];

const SERVICIOS_NOMBRES = [
    'mantenimiento' => 'Mantenimiento',
    'lavado' => 'Lavado',
];

const RESERVAS_HORA_INICIO = 8;
const RESERVAS_HORA_FIN = 18; // última hora de inicio reservable
const RESERVAS_DIAS_ADELANTE = 30;

/**
 * Pedidos confirmados del usuario (los únicos que se pueden agendar).
 */
function pedidos_agendables(int $idUsuario): array
{
    $stmt = db()->prepare(
        "SELECT pe.id_pedido, pl.nombre AS plan_nombre, pe.tipo_vehiculo, pe.creado_en
         FROM pedidos pe
         JOIN planes pl ON pl.id_plan = pe.id_plan
         WHERE pe.id_usuario = ? AND pe.estado = 'confirmado'
         ORDER BY pe.creado_en DESC"
    );
    $stmt->execute([$idUsuario]);

    return $stmt->fetchAll();
}

/**
 * Un pedido confirmado, validado como propiedad del usuario. Se usa en cada
 * paso de agendar.php, no solo al final: nunca se confía en un id de la URL.
 */
function pedido_agendable_de_usuario(int $idPedido, int $idUsuario): ?array
{
    $stmt = db()->prepare(
        "SELECT pe.id_pedido, pl.nombre AS plan_nombre
         FROM pedidos pe
         JOIN planes pl ON pl.id_plan = pe.id_plan
         WHERE pe.id_pedido = ? AND pe.id_usuario = ? AND pe.estado = 'confirmado'"
    );
    $stmt->execute([$idPedido, $idUsuario]);

    return $stmt->fetch() ?: null;
}

/**
 * Un punto activo, validado contra el tipo de servicio pedido (mantenimiento
 * solo talleres, lavado solo lavaderos). Nunca se confía en que el punto
 * elegido en el paso anterior siga correspondiendo a ese tipo.
 */
function punto_valido_para_servicio(int $idPunto, string $tipoServicio): ?array
{
    if (!isset(SERVICIO_A_PUNTO[$tipoServicio])) {
        return null;
    }

    $stmt = db()->prepare(
        'SELECT id_punto, nombre, direccion, telefono
         FROM puntos
         WHERE id_punto = ? AND tipo = ? AND activo = 1'
    );
    $stmt->execute([$idPunto, SERVICIO_A_PUNTO[$tipoServicio]]);

    return $stmt->fetch() ?: null;
}

/**
 * Un pedido solo puede redimirse una vez por tipo de servicio (una visita de
 * lavado y una de mantenimiento). Esto es solo la validación para la
 * interfaz; el índice único pedido_tipo_key en la base de datos es la
 * defensa real.
 */
function tipo_disponible_para_pedido(int $idPedido, string $tipoServicio): bool
{
    $stmt = db()->prepare(
        "SELECT COUNT(*) FROM reservas
         WHERE id_pedido = ? AND tipo_servicio = ? AND estado <> 'cancelada'"
    );
    $stmt->execute([$idPedido, $tipoServicio]);

    return (int) $stmt->fetchColumn() === 0;
}

function fecha_valida(string $fecha): bool
{
    $hoy = new DateTimeImmutable('today');
    $limite = $hoy->modify('+' . RESERVAS_DIAS_ADELANTE . ' days');
    $dt = DateTimeImmutable::createFromFormat('Y-m-d', $fecha);

    return $dt !== false
        && $dt->format('Y-m-d') === $fecha
        && $dt >= $hoy
        && $dt <= $limite;
}

/**
 * Franjas de una hora entre RESERVAS_HORA_INICIO y RESERVAS_HORA_FIN que
 * todavía no tienen una reserva activa para ese punto y fecha. Es solo para
 * la interfaz: el INSERT final siempre puede chocar con uq_punto_fecha_slot
 * si alguien más reservó esa misma franja mientras tanto.
 */
function slots_disponibles(int $idPunto, string $fecha): array
{
    $stmt = db()->prepare(
        "SELECT TIME_FORMAT(hora, '%H:%i') AS hora
         FROM reservas
         WHERE id_punto = ? AND fecha = ? AND estado <> 'cancelada'"
    );
    $stmt->execute([$idPunto, $fecha]);
    $ocupadas = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $todas = [];
    for ($h = RESERVAS_HORA_INICIO; $h <= RESERVAS_HORA_FIN; $h++) {
        $todas[] = sprintf('%02d:00', $h);
    }

    return array_values(array_diff($todas, $ocupadas));
}
