<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // Validación básica
        if ($_POST['password'] !== $_POST['confirmar_password']) {
            die("Las contraseñas no coinciden.");
        }

        $datos = [
            'rol_id' => 2,
            'cedula' => trim($_POST['cedula']),
            'nombres' => trim($_POST['nombres']),
            'apellidos' => trim($_POST['apellidos']),
            'email' => trim($_POST['email']),
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'telefono' => trim($_POST['telefono']),
            'direccion' => trim($_POST['direccion'])
        ];

        if ($this->usuario->registrar($datos)) {
            header("Location: ../views/login.php?registro=ok");
            exit;
        } else {
            die("No fue posible registrar el usuario.");
        }
    }
}

$controller = new UsuarioController();
$controller->registrar();