<?php

require_once '../../config/auth.php';
require_once '../../config/conexion.php';

$database = new Conexion();
$conexion = $database->conectar();

$categorias = $conexion->query("SELECT * FROM categorias WHERE estado=1")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "INSERT INTO productos
    (categoria_id,codigo,nombre,marca,descripcion,unidad_medida,precio,stock,imagen,estado)
    VALUES
    (:categoria,:codigo,:nombre,:marca,:descripcion,:unidad,:precio,:stock,'default.png',1)";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':categoria', $_POST['categoria']);
    $stmt->bindParam(':codigo', $_POST['codigo']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':marca', $_POST['marca']);
    $stmt->bindParam(':descripcion', $_POST['descripcion']);
    $stmt->bindParam(':unidad', $_POST['unidad']);
    $stmt->bindParam(':precio', $_POST['precio']);
    $stmt->bindParam(':stock', $_POST['stock']);

    $stmt->execute();

    header("Location:index.php");
    exit;
}

require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
?>

<div class="d-flex">

<?php require_once '../../includes/sidebar.php'; ?>

<div class="container p-4">

<h2>Nuevo Producto</h2>

<form method="POST">

<div class="mb-3">
<label>Categoría</label>

<select name="categoria" class="form-control">

<?php foreach($categorias as $cat){ ?>

<option value="<?= $cat['id']; ?>">

<?= $cat['nombre']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Código</label>

<input type="text"
name="codigo"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nombre</label>

<input type="text"
name="nombre"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Marca</label>

<input type="text"
name="marca"
class="form-control">

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Unidad de medida</label>

<input type="text"
name="unidad"
class="form-control">

</div>

<div class="row">

<div class="col">

<label>Precio</label>

<input
type="number"
step="0.01"
name="precio"
class="form-control">

</div>

<div class="col">

<label>Stock</label>

<input
type="number"
name="stock"
class="form-control">

</div>

</div>

<br>

<button class="btn btn-success">

Guardar

</button>

<a href="index.php"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

<?php require_once '../../includes/footer.php'; ?>