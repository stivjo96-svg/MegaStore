<?php

session_start();

require_once __DIR__ . '/../models/Usuario.php';

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function procesarSolicitud()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $accion = $_POST['accion'] ?? '';

        switch ($accion) {

            case 'registro':
                $this->registrar();
                break;

            case 'login':
                $this->login();
                break;

            case 'logout':
                $this->logout();
                break;

            default:
                die("Acción no válida.");
        }
    }

    private function registrar()
    {
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

    private function login()
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $usuario = $this->usuario->buscarPorEmail($email);

        if (!$usuario) {
            die("El correo electrónico no está registrado.");
        }

        if (!password_verify($password, $usuario['password'])) {
            die("La contraseña es incorrecta.");
        }

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol_id'];
        $_SESSION['nombre'] = $usuario['nombres'];
        $_SESSION['email'] = $usuario['email'];

        if ($usuario['rol_id'] == 1) {

            header("Location: /MegaStore/admin/dashboard/index.php");

        } else {

            header("Location: /MegaStore/index.php");

        }

        exit;
    }

    private function logout()
    {

        session_unset();

        session_destroy();

        header("Location: /MegaStore/index.php");

        exit;

    }

}

$controller = new UsuarioController();
$controller->procesarSolicitud();