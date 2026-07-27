<?php

require_once 'config/conexion.php';

$conexion = new Conexion();

$db = $conexion->conectar();

echo "<h2>✅ Conexión exitosa a MegaFerre</h2>";

?>