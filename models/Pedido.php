<?php

require_once __DIR__ . '/../config/conexion.php';

class Pedido
{
    private $conexion;

    public function __construct()
    {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function guardarPedido(
        $usuario_id,
        $codigo,
        $subtotal,
        $iva,
        $total,
        $metodo_pago
    )
    {
        $sql = "INSERT INTO pedidos
                (
                    usuario_id,
                    codigo,
                    subtotal,
                    iva,
                    total,
                    metodo_pago
                )
                VALUES
                (
                    :usuario_id,
                    :codigo,
                    :subtotal,
                    :iva,
                    :total,
                    :metodo_pago
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':iva', $iva);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':metodo_pago', $metodo_pago);

        $stmt->execute();

        return $this->conexion->lastInsertId();
    }

    public function guardarDetalle(
        $pedido_id,
        $producto_id,
        $cantidad,
        $precio,
        $subtotal
    )
    {
        $sql = "INSERT INTO detalle_pedidos
                (
                    pedido_id,
                    producto_id,
                    cantidad,
                    precio,
                    subtotal
                )
                VALUES
                (
                    :pedido_id,
                    :producto_id,
                    :cantidad,
                    :precio,
                    :subtotal
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->bindParam(':producto_id', $producto_id);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':subtotal', $subtotal);

        return $stmt->execute();
    }

    public function obtenerPedido($id)
    {
        $sql = "SELECT *
                FROM pedidos
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalle($pedido_id)
    {
        $sql = "SELECT
                    dp.*,
                    p.nombre
                FROM detalle_pedidos dp
                INNER JOIN productos p
                    ON dp.producto_id = p.id
                WHERE dp.pedido_id = :pedido_id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':pedido_id', $pedido_id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}