<?php

require_once '../../config/auth.php';
require_once '../../config/conexion.php';

$database = new Conexion();
$conexion = $database->conectar();

$sql = "SELECT p.*, c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c
        ON p.categoria_id = c.id
        ORDER BY p.id DESC";

$stmt = $conexion->prepare($sql);
$stmt->execute();

$productos = $stmt->fetchAll();

require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

?>

<div class="d-flex">

<?php require_once '../../includes/sidebar.php'; ?>

<div class="container-fluid p-4">

<h2>Productos</h2>

<a href="crear.php" class="btn btn-success mb-3">

Nuevo Producto

</a>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Categoría</th>

<th>Código</th>

<th>Nombre</th>

<th>Marca</th>

<th>Precio</th>

<th>Stock</th>

<th>Estado</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php foreach($productos as $producto){ ?>

<tr>

<td><?= $producto['id']; ?></td>

<td><?= $producto['categoria']; ?></td>

<td><?= $producto['codigo']; ?></td>

<td><?= $producto['nombre']; ?></td>

<td><?= $producto['marca']; ?></td>

<td>$<?= $producto['precio']; ?></td>

<td><?= $producto['stock']; ?></td>

<td><?= $producto['estado']==1 ? "Activo":"Inactivo"; ?></td>

<td>

<a href="editar.php?id=<?= $producto['id']; ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<a href="eliminar.php?id=<?= $producto['id']; ?>"
class="btn btn-danger btn-sm">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<?php require_once '../../includes/footer.php'; ?>