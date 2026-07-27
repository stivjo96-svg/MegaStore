<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | MegaFerre</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">

                    <h3>🔩 MegaFerre</h3>

                    <p class="mb-0">Inicio de Sesión</p>

                </div>

                <div class="card-body">

                    <form action="../controllers/UsuarioController.php" method="POST">

                        <input type="hidden" name="accion" value="login">

                        <div class="mb-3">

                            <label>Correo electrónico</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Contraseña</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="d-grid">

                            <button
                                class="btn btn-dark">

                                Iniciar sesión

                            </button>

                        </div>

                    </form>

                    <div class="text-center mt-3">

                        <a href="registro.php">

                            ¿No tienes cuenta? Regístrate

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>