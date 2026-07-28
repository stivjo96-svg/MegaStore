<?php

require_once '../../config/auth.php';
require_once '../../config/conexion.php';

$database = new Conexion();
$conexion = $database->conectar();

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD']=="POST"){

$sql="UPDATE categorias
SET nombre=:nombre,
descripcion=:descripcion
WHERE id=:id";

$stmt=$conexion->prepare($sql);

$stmt->bindParam(':nombre',$_POST['nombre']);
$stmt->bindParam(':descripcion',$_POST['descripcion']);
$stmt->bindParam(':id',$id);

$stmt->execute();

header("Location:index.php");
exit;

}

$sql="SELECT * FROM categorias WHERE id=:id";

$stmt=$conexion->prepare($sql);

$stmt->bindParam(':id',$id);

$stmt->execute();

$categoria=$stmt->fetch();

require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

?>

<div class="d-flex">

<?php require_once '../../includes/sidebar.php'; ?>

<div class="container p-4">

<h2>Editar Categoría</h2>

<form method="POST">

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?= $categoria['nombre']; ?>"
required>

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control"
required><?= $categoria['descripcion']; ?></textarea>

</div>

<button
class="btn btn-primary">

Actualizar

</button>

<a
href="index.php"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

<?php require_once '../../includes/footer.php'; ?>