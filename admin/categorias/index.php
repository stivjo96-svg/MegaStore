<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../../config/auth.php';
require_once '../../config/conexion.php';

$database = new Conexion();
$conexion = $database->conectar();

$sql = "SELECT * FROM categorias ORDER BY id ASC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$categorias = $stmt->fetchAll();

?>

<?php require_once '../../includes/header.php'; ?>
<?php require_once '../../includes/navbar.php'; ?>

<div class="d-flex">

<?php require_once '../../includes/sidebar.php'; ?>

<div class="container-fluid p-4">

<h2>Categorías</h2>

<a href="crear.php" class="btn btn-success mb-3">

Nueva Categoría

</a>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Descripción</th>

<th>Estado</th>

<th width="180">Acciones</th>

</tr>

</thead>

<tbody>

<?php foreach($categorias as $categoria){ ?>

<tr>

<td><?= $categoria['id']; ?></td>

<td><?= $categoria['nombre']; ?></td>

<td><?= $categoria['descripcion']; ?></td>

<td>

<?= $categoria['estado']==1 ? "Activo" : "Inactivo"; ?>

</td>

<td>

<a href="editar.php?id=<?= $categoria['id']; ?>" class="btn btn-warning btn-sm">

Editar

</a>

<a href="eliminar.php?id=<?= $categoria['id']; ?>" class="btn btn-danger btn-sm">

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