<?php

session_start();

require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Producto.php';

class PedidoController
{
    private $pedido;
    private $producto;

    public function __construct()
    {
        $this->pedido = new Pedido();
        $this->producto = new Producto();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $accion = $_POST['accion'] ?? '';

            switch ($accion) {

                case 'guardar':
                    $this->guardar();
                    break;

            }

        }
    }

    private function guardar()
    {
        $carrito = $_SESSION['carrito'] ?? [];

        if (empty($carrito)) {

            die("El carrito está vacío.");

        }

        $subtotal = 0;

        foreach ($carrito as $id => $cantidad) {

            $producto = $this->producto->obtenerPorId($id);

            $subtotal += ($producto['precio'] * $cantidad);

        }

        $iva = $subtotal * 0.15;

        $total = $subtotal + $iva;

        $codigo = "PED-" . date("YmdHis");

        $metodo = $_POST['metodo_pago'];

        $pedido_id = $this->pedido->guardarPedido(

            $_SESSION['id'],

            $codigo,

            $subtotal,

            $iva,

            $total,

            $metodo

        );

        foreach ($carrito as $id => $cantidad) {

            $producto = $this->producto->obtenerPorId($id);

            $precio = $producto['precio'];

            $sub = $precio * $cantidad;

            $this->pedido->guardarDetalle(

                $pedido_id,

                $id,

                $cantidad,

                $precio,

                $sub

            );

        }

        unset($_SESSION['carrito']);

        header("Location: /MegaStore/cliente/compra_exitosa.php");

        exit;
    }
}

new PedidoController();