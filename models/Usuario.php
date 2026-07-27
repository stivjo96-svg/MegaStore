<?php

require_once __DIR__ . '/../config/conexion.php';

class Usuario
{
    private $conexion;
    private $tabla = "usuarios";

    public function __construct()
    {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    public function registrar($datos)
    {
        $sql = "INSERT INTO usuarios
                (rol_id, cedula, nombres, apellidos, email, password, telefono, direccion)
                VALUES
                (:rol_id, :cedula, :nombres, :apellidos, :email, :password, :telefono, :direccion)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':rol_id', $datos['rol_id']);
        $stmt->bindParam(':cedula', $datos['cedula']);
        $stmt->bindParam(':nombres', $datos['nombres']);
        $stmt->bindParam(':apellidos', $datos['apellidos']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':password', $datos['password']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':direccion', $datos['direccion']);

        return $stmt->execute();
    }
}