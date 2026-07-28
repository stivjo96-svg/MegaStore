<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container-fluid">

        <span class="navbar-brand">

            Sistema Administrativo

        </span>

        <div class="text-white">

            👤

            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            echo $_SESSION['nombre'] ?? 'Administrador';
            ?>

        </div>

    </div>

</nav>