<?php

require_once '../../config/auth.php';
require_once '../../config/conexion.php';

$database = new Conexion();
$conexion = $database->conectar();

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id=:id";

$stmt = $conexion->prepare($sql);

$stmt->bindParam(':id', $id);

$stmt->execute();

header("Location:index.php");
exit;