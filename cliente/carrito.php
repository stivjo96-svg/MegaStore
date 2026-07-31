<?php

session_start();

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../includes/cliente/header.php';
require_once __DIR__ . '/../includes/cliente/navbar.php';

$modelo = new Producto();

$carrito = $_SESSION['carrito'] ?? [];

$total = 0;

?>

<div class="container mt-5">

<h2 class="mb-4">

🛒 Mi carrito

</h2>

<?php if(empty($carrito)){ ?>

<div class="alert alert-info">

Tu carrito está vacío.

</div>

<?php }else{ ?>

<table class="table table-bordered">

<thead>

<tr>

<th>Producto</th>

<th>Precio</th>

<th>Cantidad</th>

<th>Subtotal</th>

<th></th>

</tr>

</thead>

<tbody>

<?php

foreach($carrito as $id=>$cantidad){

    $producto = $modelo->obtenerPorId($id);

    $subtotal = $producto['precio'] * $cantidad;

    $total += $subtotal;

?>

<tr>

<td><?= $producto['nombre']; ?></td>

<td>$<?= number_format($producto['precio'],2); ?></td>

<td><?= $cantidad; ?></td>

<td>$<?= number_format($subtotal,2); ?></td>

<td>

<form
method="POST"
action="/MegaStore/controllers/CarritoController.php">

<input
type="hidden"
name="accion"
value="eliminar">

<input
type="hidden"
name="producto_id"
value="<?= $id; ?>">

<button
class="btn btn-danger btn-sm">

Eliminar

</button>

</form>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="text-end">

<h3>

Total:

$<?= number_format($total,2); ?>

</h3>

<a
href="/MegaStore/cliente/checkout.php"
class="btn btn-success">

Continuar compra

</a>

</div>

<?php } ?>

</div>

<?php require_once __DIR__ . '/../includes/cliente/footer.php'; ?>