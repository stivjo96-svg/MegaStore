<?php

session_start();

require_once __DIR__ . '/../models/Producto.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$accion = $_POST['accion'] ?? '';

switch ($accion) {

    case 'agregar':

        $id = intval($_POST['producto_id']);

        if (isset($_SESSION['carrito'][$id])) {

            $_SESSION['carrito'][$id]++;

        } else {

            $_SESSION['carrito'][$id] = 1;

        }

        header("Location: /MegaStore/cliente/carrito.php");
        exit;

    case 'eliminar':

        $id = intval($_POST['producto_id']);

        unset($_SESSION['carrito'][$id]);

        header("Location: /MegaStore/cliente/carrito.php");
        exit;

}