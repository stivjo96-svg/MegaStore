<?php

require_once __DIR__ . '/../config/conexion.php';

class Producto
{
    private $conexion;

    public function __construct()
    {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    // Obtener todos los productos activos
    public function obtenerActivos()
    {
        $sql = "SELECT
                    p.*,
                    c.nombre AS categoria
                FROM productos p
                INNER JOIN categorias c
                    ON p.categoria_id = c.id
                WHERE p.estado = 1
                ORDER BY p.id DESC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto por su ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT
                    p.*,
                    c.nombre AS categoria
                FROM productos p
                INNER JOIN categorias c
                    ON p.categoria_id = c.id
                WHERE p.id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}