<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

/**
 * @return array<int, array<string, mixed>>
 */
function listar_puntos(string $tipo): array
{
    $stmt = db()->prepare(
        'SELECT id_punto, nombre, direccion, telefono, descripcion, mapa_embed_url
         FROM puntos
         WHERE tipo = ? AND activo = 1
         ORDER BY orden ASC, nombre ASC'
    );
    $stmt->execute([$tipo]);

    return $stmt->fetchAll();
}

/**
 * URL de mapa embebido de Google Maps sin necesidad de una clave de API:
 * usa el modo de búsqueda por texto (?q=...&output=embed). Si el punto ya
 * trae su propia mapa_embed_url guardada, se respeta esa en su lugar.
 */
function mapa_embed_url_de(array $punto): string
{
    if (!empty($punto['mapa_embed_url'])) {
        return $punto['mapa_embed_url'];
    }

    return 'https://www.google.com/maps?q=' . urlencode($punto['nombre'] . ', ' . $punto['direccion']) . '&output=embed';
}
